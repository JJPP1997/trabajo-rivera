function loader(blogId){
	getAllAgendas(blogId);
	var maxWidth=0;
	
	
	//get pertinent measurements
	var width = $(window).width();
	var height = $(window).height();

	var menubar=$("#wholeHeader").height();
	//fit overlay
	$("#overlay").width(width).height(height);
	
        
	
}
function getAllAgendas(id){
   $.ajax({
		type: "POST",
		url: "/trabajo-rivera/Blogs/Scripts/phpConectionVilages.php", //the page containing php script
		dataType: 'json',
		data: {
			functionname: "getAllAgendas",
			arguments: id,
		},
		success: function (response) {
	
			var agenda=JSON.parse(response);
			
			 getAgendatData(agenda);
			
			
			//return  getTitles(articles);
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			alert("Status: " + textStatus);
			alert("Error: " + errorThrown);
			return "";
		}

	});
	return "";
}
function getAgendatData(anouncementsJson){
	var items='<h1 class="seccionTitle">Agenda Cultural</h1>';
	
	for (var k in anouncementsJson) {
		
		if (anouncementsJson[k]instanceof Object) {
		
			for (key in anouncementsJson[k]) {
				var blog = anouncementsJson[k][key];
				var id=blog["id"];
				var title=blog["title"];
				var image = blog["image"];
				var text = blog["text"];
				var date = blog["date"];
				var rawHtml=
			'<div class="agendaEntry">'+
				'<div class="left">'+
					'<div class="agendaDate">'+
						'<h1 class="date">'+date+'</h1>'+
					'</div>'+
					'<div class="ACImageContainer">'+
						'<img src="Imagenes/'+image+'"></img>'+
					'</div>'+
						'<h1>'+ title+'</h1>'+
				'</div>'+
				'<div class="right">'+
					text+
				'</div>'+
				'<div class="clear"></div>'+
			'</div>	';
				items+=rawHtml;
				
			}
			
			//document.write(data[k] + "<br>");
		};		
	}
	$.keyframe.define([{
		name: 'hide',
		from: {
			"opacity": "1"
		},
		to: {
			"opacity": "0"
		}
	}]);
	$("#overlay").playKeyframe({
			name: 'hide',
			duration: '1s',
			iterationCount: 1,
			complete: function(){
				$("#overlay").css("display", "none"); 
			}
		});
	updateElement("agendaContainer",items);
	
}
function scroller(){
	manageHeader();
}
