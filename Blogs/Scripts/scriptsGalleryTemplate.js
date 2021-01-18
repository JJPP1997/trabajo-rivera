var currentImg=0;
	var all =null;
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
	var Bheight = $(imagesContainer).height();
	var menubar=$("#wholeHeader").height();
	
	//fit overlay
	$("#focusImage").width(width).height(Bheight);
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
	
	 all = $(".PolaroidImage").map(function() {
		return this.src;
	}).get();
		
	$("#focusedImage").attr("src",src);
	for(var i=0;i<all.length;i++){
		if( all[i].indexOf($("#focusedImage").attr('src') )>=0 ){
			currentImg=i;
		
		}
	}
	$("#focusImagePolaroidContainer").next(".caption").text(text);
	$("#focusImage").css("display", "inline");
	fitMargins();
}
function fitMargins(){
	$(".focusImageMargin").height($("#focusedImage").height());
		console.log("lol");
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
