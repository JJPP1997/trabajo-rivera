var clicked=false;
function loader(){
	//get pertinent measurements
	var width = $(window).width();
	var height = $(window).height();
	var menubar=$("#wholeHeader").height();
	//fit overlay
	$("#title_overlay").height($("#title_background").height);
	$("#title_overlay").css('top', menubar+5);
	$("#title_background").width(width).height(height);
	$("#overlay").width(width).height(height);
	$("#overlay_center").width(width-100).height($("#title_background").height);
	$(".overlay_margin").width(50).height($("#title_background").height);
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
var slideIndex = 1;
showSlides(slideIndex);

function AutoPlusSlides() {
  showSlides(slideIndex += 1);
   triggerTitleAnimation();
	
}
function plusSlides(n) {
	showSlides(slideIndex += n);
	 triggerTitleAnimation();
	clicked=true;
}

function currentSlide(n) {
  showSlides(slideIndex = n);
 
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  slides[slideIndex-1].style.display = "block";  

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
function triggerTitleAnimation(){
	var tlt=$( "#title" ).clone();
	$( "#title" ).remove();
	tlt.appendTo( "#overlay_center" );

}
function readMore(container,open){
	console.log(container);
	if(open){
		$( "#"+ container ).find("p").css({"overflow": "auto", "display": "inline"});
		$( "#"+ container ).find("button").attr("onclick","readMore('"+container+"',false)");
		$( "#"+ container ).find("button").text("Leer menos");
		
	}else{
		$( "#"+ container ).find("p").css({"overflow": "hidden","display": "block" });
		$( "#"+ container ).find("button").attr("onclick","readMore('"+container+"',true)");
		$( "#"+ container ).find("button").text("Leer más");
	}
	
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
