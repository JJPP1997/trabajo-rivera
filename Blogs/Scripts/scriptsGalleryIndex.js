function loader(id){
	var maxWidth=0;
	var width = $(window).width();
	var height = $(window).height();

	var menubar=$("#wholeHeader").height();
	//fit overlay
	$("#overlay").width(width).height(height);
	getAllGaleries(id);
}
function getAllGaleries(id){
   $.ajax({
		type: "POST",
		url: "/trabajo-rivera/Blogs/Scripts/phpConectionVilages.php", //the page containing php script
		dataType: 'json',
		data: {
			functionname: "getAllGaleries",
			arguments: id,
		},
		success: function (response) {
			//console.log(response);
			var g=JSON.parse(response);
			console.log(g);
			 getGaleries(g);
			
			
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

function getGaleries(blogJson){
	var items="";
	for (var k in blogJson) {
		if (blogJson[k]instanceof Object) {
		
			for (key in blogJson[k]) {
				var blog = blogJson[k][key];
				var id=blog["id"];
				
				var title=blog["title"];
				var date = blog["date"];
				
				var thumbnail=blog["thumbnail"];
				var galeryDir=titleToDir(title);
			
				
				var raw='<div class="galleryThumbnail"  onclick="location.href=\'Galerias/'+galeryDir+'/'+title+'.html\';">'+
				'<div class="galleryImgContainer" >'+
					'<img src="Galerias/'+galeryDir+'/Imagenes/'+thumbnail+'" >'+
				'</div>'+
				'<div class="galleryDesc">'+title+'</div>'+
				'<div class="clear"></div>'+
				'</div>';
				
				items+=raw;
				
				
			}
			//document.write(data[k] + "<br>");
		};
	}
	items+='<div class="clear"></div>';
	updateElement("galleryContainer",items);
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
