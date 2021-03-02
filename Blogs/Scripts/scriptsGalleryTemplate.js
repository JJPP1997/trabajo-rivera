var currentImg=0;
	var all =null;
function loader(name){

	var maxWidth=0;
	
	
	//get pertinent measurements
	var width = $(window).width();
	var height = $(window).height();
	var Bheight = $(imagesContainer).height();
	var menubar=$("#wholeHeader").height();
	
	//fit overlay
	//$("#focusImage").width(width).height(height);
	$("#overlay").width(width).height(height);
	//hide slides
	getIDGalery(name);
	
	/*
   var anchors = document.getElementsByClassName('polaroid');
	for(var i = 0; i < anchors.length; i++) {
		var polaroid = anchors[i];
		polaroid.onclick = function() {
			var trial = polaroid.src;
			$('#focusedImage').attr("src", trial);
			$("#focusImage").show();
		}
	}*/
	//fade in
	
        
	
}
function getIDGalery(name){
   $.ajax({
		type: "POST",
		url: "/trabajo-rivera/Blogs/Scripts/phpConectionVilages.php", //the page containing php script
		dataType: 'text',
		data: {
			functionname: "getIDGalery",
			arguments: name,
		},
		success: function (response) {
			
			var id= response;
			
			 $.ajax({
				type: "POST",
				url: "/trabajo-rivera/Blogs/Scripts/phpConectionVilages.php", //the page containing php script
				dataType: 'json',
				data: {
					functionname: "getAllImagesFromGalery",
				arguments: id,
				},
				success: function (response) {
					
					var g=JSON.parse(response);
					getImages(g);
					
					
					//return  getTitles(articles);
				},
				error: function (XMLHttpRequest, textStatus, errorThrown) {
					alert("Status: " + textStatus);
					alert("Error: " + errorThrown);
					return "";
				}

			});
			
			//return  getTitles(articles);
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			alert("Status: " + textStatus);
			alert("Error: " + errorThrown);
			return "0";
		}

	});
	
}

function getImages(blogJson){
	var items="";
	for (var k in blogJson) {
		if (blogJson[k]instanceof Object) {
		
			for (key in blogJson[k]) {
				var blog = blogJson[k][key];
				var id=blog["id"];
				var image=blog["image"];
				var text = blog["text"];
				if(text==null || text==""){
					text="";
				}
				//console.log(text);
				var raw='<div class="polaroid " onclick="openImage(\'Imagenes/'+image+'\',\''+text+'\')" >'+
				
					'<img class="PolaroidImage" src="Imagenes/'+image+'">'+
				
				'<p class="caption">'+text+'</p>'+
				'<div class="clear"></div>'+
				'</div>';
				
				items+=raw;
				
				
			}
			//document.write(data[k] + "<br>");
		};
	}
	
	updateElement("imagesContainer",items);
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
		var menubar=$("#wholeHeader").height();
	var offset=$(window).scrollTop()+menubar;
	
	manageHeader();
	closeFocusImg();	$("#focusImage").css("top",offset+"px");
}
function openImage(src,text){
	
	 all = $(".PolaroidImage").map(function() {
		return this.src;
	}).get();
		
	$("#focusedImage").attr("src",src);
	for(var i=0;i<all.length;i++){
		if( all[i].indexOf($("#focusedImage").attr('src') )>=0 ){
			currentImg=i;
		
		}
	}
	
	$("#FICaption").text(text);
	$("#focusImage").css("display", "inline");
	fitMargins();
}
function fitMargins(){
	$(".focusImageMargin").height($("#focusedImage").height());
	
}
function plusImage(num){
	
	currentImg+=num;
	if(currentImg>=all.length){
		currentImg=0;
		
	}
	if(currentImg<0){
		currentImg=(all.length-1);
		
	}
	$("#focusedImage").attr("src",all[currentImg]);
	fitMargins();
}
function closeFocusImg(){
	$("#focusImage").css("display", "none");
}
