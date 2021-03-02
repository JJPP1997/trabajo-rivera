function loader(id,type){
	
	
	var maxWidth=0;
	
	getAllBussinesByType(id,type);
	//get pertinent measurements
	var width = $(window).width();
	var height = $(window).height();

	var menubar=$("#wholeHeader").height();
	//fit overlay
	$("#overlay").width(width).height(height);

}
function getAllBussinesByType(id,type){
   $.ajax({
	  
		type: "POST",
		url: "/trabajo-rivera/Blogs/Scripts/phpConectionVilages.php", //the page containing php script
		dataType: 'json',
		data: {
			functionname: "getAllBussinesByType",
			arguments: new Array(id,type),
		},
		success: function (response) {
			
			var d=JSON.parse(response);
			
			getBussinesData(d);
			
			
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
function getBussinesData(blogJson){
	var items="";
	for (var k in blogJson) {
		if (blogJson[k]instanceof Object) {
		
			for (key in blogJson[k]) {
				var blog = blogJson[k][key];
				var id=blog["id"];
				var title=blog["title"];
				var image = blog["image"];
				var type = blog["type"];
				var telf = blog["telf"];
				var desc = blog["desc"];
				var addres = blog["addres"];
				
				var raw='<div class="bussinessContaner">'+
				'<div class="leftContainer">'+
					'<img src="Imagenes/'+image+'" ></img>'+
				'</div>'+
				'<div class="rightContainer">'+
					'<h1><b>'+title+'</b></h1>'+
					'<p><b>Dirección:</b> '+addres+'</p>'+
					'<p><b>telf: </b>'+telf+'</p>'+
					'<p>'+desc+'</p>'+
				'</div>'+
				'<div class="clearer"></div>'+
				'</div>';
				
				items+=raw;
				
			}
			//document.write(data[k] + "<br>");
		};
	}
	updateElement("container",items);
	
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
}
function scroller(){
	manageHeader();
}
