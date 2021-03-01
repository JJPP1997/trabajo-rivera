var clicked=false;
var CImageText=[];
function loader(blogId){
	getBlog(blogId);
	getAllAgendas(blogId);
	getAllCarrouselImages(blogId);
	
	
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
function getAllCarrouselImages(id){
   $.ajax({
		type: "POST",
		url: "/trabajo-rivera/Blogs/Scripts/phpConectionVilages.php", //the page containing php script
		dataType: 'json',
		data: {
			functionname: "getAllCarrouselImages",
			arguments: id,
		},
		success: function (response) {
		
			var images=JSON.parse(response);

			getCIData4Main(images);
		
			
			//return  getTitles(articles);
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			alert("Status: " + textStatus);
			alert("Error: " + errorThrown);
			return "";
		}

	});
	return "";
}
function getAllAgendas(id){
   $.ajax({
		type: "POST",
		url: "/trabajo-rivera/Blogs/Scripts/phpConectionVilages.php", //the page containing php script
		dataType: 'json',
		data: {
			functionname: "getAllAgendas",
			arguments: id,
		},
		success: function (response) {
		
			var agenda=JSON.parse(response);
			//console.log(agenda);
			 getAnouncementData4Main(agenda);
			
			
			//return  getTitles(articles);
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			alert("Status: " + textStatus);
			alert("Error: " + errorThrown);
			return "";
		}

	});
	return "";
}
function getBlog(id){
   $.ajax({
		type: "POST",
		url: "/trabajo-rivera/Blogs/Scripts/phpConectionVilages.php", //the page containing php script
		dataType: 'json',
		data: {
			functionname: "getBlog",
			arguments: id,
		},
		success: function (response) {
		
			var blog=JSON.parse(response);
			//console.log(blog);
			 getBlogData4Main(blog);
			
			
			//return  getTitles(articles);
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			alert("Status: " + textStatus);
			alert("Error: " + errorThrown);
			return "";
		}

	});
	return "";
}
function getBlogData4Main(blogJson){
	for (var k in blogJson) {
		if (blogJson[k]instanceof Object) {
		
			for (key in blogJson[k]) {
				var blog = blogJson[k][key];
				var id=blog["id"];
				var name=blog["name"];
				var desc = blog["desc"];
				var history = blog["history"];
				var map = blog["map"];
				var poiText=blog["poiText"];
		
				updateElement("descriptionContainer",desc);
			}
			//document.write(data[k] + "<br>");
		};
	}
}
function getAnouncementData4Main(anouncementsJson){
	var items="";
	for (var k in anouncementsJson) {
		
		if (anouncementsJson[k]instanceof Object) {
		
			for (key in anouncementsJson[k]) {
				var blog = anouncementsJson[k][key];
				var id=blog["id"];
				var title=blog["title"];
				var image = blog["image"];
				var text = blog["text"];
				var rawHtml=
			'<div class="anouncement">'+
				'<h1>'+ title+'</h1>'+
				'<img src="Imagenes/'+image+'"></img>'+
				'<p class="anouncementDesc">'+
					text+
				'</p>'+
			'</div>';
				items+=rawHtml;
			}
			
			//document.write(data[k] + "<br>");
		};		
	}
	updateElement("anouncementsContainer",items);
}
function getCIData4Main(carrouselImagesJson){
	
	var images="";
	for (var k in carrouselImagesJson) {
		
		if (carrouselImagesJson[k]instanceof Object) {
		
			for (key in carrouselImagesJson[k]) {
				var img = carrouselImagesJson[k][key];
				var src=img["image"];
				var text=img["text"];
				
				var rawHtml=
				'<div class="mySlides fade">'+
					'<img class="slidesImage" src="Imagenes/'+src+'">'+
				'</div>';
				images+=rawHtml;
				CImageText.push(text);
				
			}
			
			//document.write(data[k] + "<br>");
		};
	}
	
	
	updateElement("title_background",images);
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
	showSlides(1);
}
var slideIndex = 1;


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
	try{
		
		if(n===1){
			var text="<p>"+CImageText[(n-1)]+"</p>";
			updateElement("title",text);
		}else{
			var text="<p>"+CImageText[(n-2)]+"</p>";
				updateElement("title",text);
		}
		
	
	}catch{
		var text="<p>"+CImageText[0]+"</p>";
		updateElement("title",text);
	}
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

