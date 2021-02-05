var clicked=false;
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
	
	fitTitleOverlay();
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
function fitTitleOverlay(){
	var width = $(window).width();
	var height = $(window).height();
	var menubar=$("#wholeHeader").height();
	
	$("#title_background").width(width);
	
	if(width>651){
		$("#title_background").height(height);
		$("#overlay_center").width(width-100);
		$("#title").width("50%");
		$(".overlay_margin").width(50).height($("#title_img").height());
		$("#overlay_center").height(height);
		
		
	}else{
		$("#title_background").height(200);
		$("#overlay_center").width(width-200);
		$("#title").width(width-200);
		$(".overlay_margin").width(100).height(200);
		$("#overlay_center").height(200);
		
	}
	
	$("#title_overlay").height($("#title_background").height());
	$("#title_overlay").css('top', menubar);
	
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
	fitTitleOverlay();
	var width=$(window).width();
	if(width>651){
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
	fitTitleOverlay();
	offset=$("#description").offset();
	margin=parseInt($("#description").css('marginTop').replace("px",""));
	title=$("#description").first().height();
	
	if ($(window).scrollTop()<offset.top-margin-title-5){
		$("#title").css("visibility", "visible");
	

	}else{
		
		$("#title").css("visibility", "hidden");
	}
}

