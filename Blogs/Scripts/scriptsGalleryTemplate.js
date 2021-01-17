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
