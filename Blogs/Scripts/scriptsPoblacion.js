
function loader(id){
	getBlog(id);
	getAllPOI(id);
	var maxWidth=0;
	
	
	//get pertinent measurements
	var width = $(window).width();
	var height = $(window).height();

	var menubar=$("#wholeHeader").height();
	//fit overlay
	$("#overlay").width(width).height(height);
	
	
}
function getBlog(id){
   $.ajax({
		type: "POST",
		url: "/trabajo-rivera/Blogs/Scripts/phpConectionVilages.php", //the page containing php script
		dataType: 'json',
		data: {
			functionname: "getBlog",
			arguments: id,
		},
		success: function (response) {
		
			var blog=JSON.parse(response);
			 getBlogData(blog);
			
			
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
function getBlogData(blogJson){
	for (var k in blogJson) {
		if (blogJson[k]instanceof Object) {
		
			for (key in blogJson[k]) {
				var blog = blogJson[k][key];
				var id=blog["id"];
				var name=blog["name"];
				var desc = blog["desc"];
				var history = blog["history"];
				var map = blog["map"];
				var poiText=blog["poiText"];
				
			
				
				var raw='<h1 class="seccionTitle">Conoce el Pueblo</h1>'+
				'<p>'+desc+'</p>'+
				'<h1 class="seccionTitle">Historia del Pueblo</h1>'+
				'<p>'+history+'</p>';
				updateElement("bodyContent",raw);
				updateElement("POIText",poiText);
				
				
			}
			//document.write(data[k] + "<br>");
		};
	}
}
function getAllPOI(id){
	 $.ajax({
		type: "POST",
		url: "/trabajo-rivera/Blogs/Scripts/phpConectionVilages.php", //the page containing php script
		dataType: 'json',
		data: {
			functionname: "getAllPOI",
			arguments: id,
		},
		success: function (response) {
		
			var POI=JSON.parse(response);
			
			 getPOI(POI);
			
			
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
function getPOI(blogJson){
	var items=' <div class="POI">	<div class="imagesBackground"> <div class="POIimageContainer">';
	var counter=0;
	var right=true;
	var switcheroo=true;
	for (var k in blogJson) {
		if (blogJson[k]instanceof Object) {
			
			for (key in blogJson[k]) {
				var blog = blogJson[k][key];
				var id=blog["id"];
				var text=blog["text"];
				var image = blog["image"];

				if(counter==0){
					items+='<div class="pair">';
				
				}
				var clas="";
				if(switcheroo){
					if(right){
						clas="rotate_right";
						right=false;
					}else{
						clas="rotate_left";
						right=true;
					}
				}else{
					if(right){
						clas="rotate_left";
						right=false;
					}else{
						clas="rotate_right";
						right=true;
					}
				}
				var raw=
					'<div class="polaroid '+clas+'">'+
						'<img class="polaroidImg" src="Imagenes/'+image+'">'+
						'<p class="caption">'+text+'</p>'+
					'</div>';
				items+=raw;
				if(counter==1){
					counter=0;
					items+='</div>';
					if(switcheroo){
						switcheroo=false;
					}else{
						switcheroo=true;
					}
				}
				counter+=1;
				
			}
			
			//document.write(data[k] + "<br>");
		};
	}
	items+='</div> </div><div class="clear"> </div> </div>';
	

	updateElement("POIContainer",items);
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
