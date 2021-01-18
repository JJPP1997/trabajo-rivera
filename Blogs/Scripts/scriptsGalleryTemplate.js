var currentImg=0;
function loader(){
	$.keyframe.define([{
		name: 'hide',
		from: {
			"opacity": "1"
		},
		to: {
			"opacity": "0"
		}
	}]);
	var maxWidth=0;
	
	
	//get pertinent measurements
	var width = $(window).width();
	var height = $(window).height();

	var menubar=$("#wholeHeader").height();
	//fit overlay
	$("#overlay").width(width).height(height);
	//hide slides
	
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
function openImage(src,text){
	
	
	$("#focusedImage").attr("src",src);
	
	$("#focusImagePolaroidContainer").next(".caption").text(text);
	$("#focusImage").css("display", "inline");
	
	
}