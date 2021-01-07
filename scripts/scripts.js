function loader(){
	
	var width = $(window).width();
	var height = $(window).height();
	
	$("#title_background").width(width).height(height);
	$("#overlay_center").width(width-100).height(height);
	$(".overlay_margin").width(50).height(height-70);
	$(".polaroid >img").height(height-70);
	$("#title_overlay").height(height);
	$("#blog>div").width(width-100);
	$("#overlay").delay(1000).animate({opacity: '0' });
	var slides = document.getElementsByClassName("mySlides");
	for (i = 0; i < slides.length; i++) {
		if(i!=0){
			slides[i].style.display = "none";
		}  
	}
	fadeBody(true);
	
}
function closeNav() {
    var width = $(window).width();
    document.getElementById("mySidenav").style.display = "none";
    document.getElementById("leftSide").style.width = "100%";
    document.getElementById("leftSide").style.paddingRight = "0%";
    
}
function openNav() {
    var width = $(window).width();
    document.getElementById("mySidenav").style.display = "inline";
	document.getElementById("leftSide").style.paddingRight = "300px";
	document.getElementById("mySidenav").style.width = "300px";
	document.getElementsByClassName("closebtn").display = "none";
    

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
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
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