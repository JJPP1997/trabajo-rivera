var clicked=false;
function loader(){
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
	
	setInterval(function() {
		if(!clicked){
			AutoPlusSlides();
			
		}else{
			clicked=false;
		}
	}, 10000);
	//fade in
	$("#overlay").delay(10000).animate({opacity: '0' });
	$("#overlay").delay(10000).css("display", "none");
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



function fadeBody(fade) {
	//hides t shows the ovverlay to hide the loading of elements
	if(fade){
		 $("#overlay").css({
            "display": "none"
			
        });
	}else{
		 $("#overlay").css({
            "display": "inline"
        });
	}
}
function openNav(x) {
  x.classList.toggle("change");
}
function resizer(){
	
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
