var clicked=false;
function loader(){
	imageMapResize();
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
	var slides = document.getElementsByClassName("mySlides");
	for (i = 0; i < slides.length; i++) {
		if(i!=0){
			slides[i].style.display = "none";
		}  
	}
	

	//fade in
	$("#overlay").playKeyframe({
				name: 'hide',
				duration: '1s',
				iterationCount: 1,
				complete: function(){
					$("#overlay").css("display", "none"); 
				}
			});
	//$("#overlay").delay(1000).display("none");
	//fit buttons
	
/*	var maxHeight=0;
	jQuery('.headerBtn').each(function() {
		var currentElement = $(this);

		var value = currentElement.height(); // if it is an input/select/textarea field
		if(value>maxHeight){
				maxHeight=value;
		}
	});
	jQuery('.headerBtn').each(function() {
		var currentElement = $(this);
		
		var value = currentElement.height(); // if it is an input/select/textarea field
		if(value!=maxHeight){
				$(this).height(maxHeight);
		}
	});*/
	//fadeBody(true);
	
}

function resizer(){
	imageMapResize();
	setSidenavWith();
	var width=$(window).width();
	if(width>699){
			$("#header").css("background-color", "#F0F0F0"); 
			resetSidenav();
		
	}else{
		if($("#mySidenav").is(":visible") ){
			setSidenavWith();
			
		}
	}
}

function scroller(){
	manageHeader();
	
}







