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
	
	
	//get pertinent measurements
	var width = $(window).width();
	var height = $(window).height();

	var menubar=$("#wholeHeader").height();
	//fit overlay
	$("#overlay").width(width).height(height);
	//hide slides
	
	
	
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
	
	var header = document.getElementById("header");
	var sticky = header.offsetTop;
		 if (window.pageYOffset > sticky) {
		header.classList.add("sticky");
	  } else {
		header.classList.remove("sticky");
	  }
}
function toggle() {
    if(!$('#yourID').is(':visible')){
		$("submenu").show();
	}else{
		$("submenu").hide();
	}
};