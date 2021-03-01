function isHeaderSticky(){
	var header = document.getElementById("header");
	var sticky = header.offsetTop;
	 if (window.pageYOffset > sticky) {
		return true;
	  } else {
		return false;
	  }
}
function manageHeader(){
	
	 if (isHeaderSticky()) {
		header.classList.add("sticky");
	  } else {
		 if(!$('#submenu').is(':visible')){
			header.classList.remove("sticky");
		 }
	  }
}

function toggleSubmenu() {
	$("#submenu").toggle(0);
	//var height = $("#wholeHeader").height();
	//var submenuH=$("#submenu").height();
	var header = document.getElementById("header");
    if(!$('#submenu').is(':visible')){
		//$("#wholeHeader").height((height-submenuH));
		
		var sticky = header.offsetTop;
		 if (!isHeaderSticky()) {
			header.classList.remove("sticky");
		 }
		
	}else{
		header.classList.add("sticky");
		//$("#wholeHeader").height((height+submenuH));
	}
}
function resetSidenav(){
	$("#header").css("background-color", "#F0F0F0"); 
	$("#containerBtn" ).attr("onclick","openNav(this)");
	document.getElementById("containerBtn").classList.remove("openSN");
	 document.getElementById("mySidenav").style.display = "none";
	 //why does this work
	$.keyframe.define([{
		name: 'changeToWhite',
		from: {
			"backgroundColor": "black"
		},
		to: {
			"backgroundColor": "#F0F0F0"
		}
	}]);
	
	$("#header").playKeyframe({
			name: 'changeToWhite',
			duration: '0s',
			iterationCount: 1,
			complete: function(){
				$("#header").css("background-color", "#F0F0F0"); 
			}
		});
}
function closeNav(x) {
	$("#containerBtn" ).attr("onclick","");
	$.keyframe.define([{
		name: 'changeToWhite',
		from: {
			"backgroundColor": "black"
		},
		to: {
			"backgroundColor": "#F0F0F0"
		}
	}]);

	$.keyframe.define([{
		name: 'hide',
		
		from: {
			"transform": "translate(0px,0px)"
		},
		to: {
			"transform": "translate(-100%,0px)"
		}
		
	}]);
	x.classList.toggle("openSN");
	$("#header").playKeyframe({
			name: 'changeToWhite',
			duration: '1s',
			iterationCount: 1,
			complete: function(){
				$("#header").css("background-color", "#F0F0F0"); 
			}
		});
	$("#mySidenav").playKeyframe({
			name: 'hide',
			duration: '1s',
			iterationCount: 1,
			complete: function(){
				  document.getElementById("mySidenav").style.display = "none";
				$("#containerBtn" ).attr("onclick","openNav(this)");
			}
		});  
    
}
function setSidenavWith(){
	var width=$(window).width();
	if(width<400){
		$("#mySidenav").width( width-($("#containerBtn").width()+10));
	}else{
		$("#mySidenav").width(300);
	}
}

function openNav(x) {
	$("#containerBtn" ).attr("onclick","");
	
	$.keyframe.define([{
		name: 'changeToBlack',
		from: {
			"backgroundColor": "#F0F0F0"
		},
		to: {
			"backgroundColor": "black"
		}
	}]);
	$.keyframe.define([{
		name: 'show',
		from: {
			"transform": "translate(-100%,0px)"
		},
		to: {
			"transform": "translate(0px,0px)"
		}
	}]);
    
	x.classList.toggle("openSN");
	$("#header").playKeyframe({
			name: 'changeToBlack',
			duration: '1s',
			iterationCount: 1,
			complete: function(){
				$("#header").css("background-color", "black"); 
			}
		});
		
	document.getElementById("mySidenav").style.display = "inline";
	setSidenavWith();
	
	$("#mySidenav").playKeyframe({
		name: 'show',
		duration: '1s',
		iterationCount: 1,
		complete: function(){
			
			$("#containerBtn" ).attr("onclick","closeNav(this)");
		}
	});
	  
    

}
function titleToDir(title){
	var ilegalChars = new Array(
		"#","%","&","{","}","\\","<",">","*","?","/","+","`","|","=","$","!","¿","¡","'",'"',":","@"
	);
	var articleFileName=title.toLowerCase();
	articleFileName=articleFileName.trim();
	articleFileName= articleFileName.replace(/" /g,'');
	articleFileName= articleFileName.replace(/ /g,'-');
	ALen = ilegalChars.length;
	for (i = 0; i < ALen; i++) {
		articleFileName= articleFileName.replace(ilegalChars[i],"");
	}
	articleFileName
	return articleFileName;
}
//db conection

function getAllImagesFromGalery(id){
   $.ajax({
		type: "POST",
		url: "/trabajo-rivera/Blogs/Scripts/phpConectionVilages.php", //the page containing php script
		dataType: 'json',
		data: {
			functionname: "getAllImagesFromGalery",
			arguments: id,
		},
		success: function (response) {
		
			var images=JSON.parse(response);
			return images;
			
			//console.log(matches.items[0].idMatch);
			//return  getTitles(articles);
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			alert("Status: " + textStatus);
			alert("Error: " + errorThrown);
		}

	});
}

function getAllBussines(id){
   $.ajax({
		type: "POST",
		url: "/trabajo-rivera/Blogs/Scripts/phpConectionVilages.php", //the page containing php script
		dataType: 'json',
		data: {
			functionname: "getAllBussines",
			arguments: id,
		},
		success: function (response) {
		
			var bussines=JSON.parse(response);
			return bussines;
			
			//console.log(matches.items[0].idMatch);
			//return  getTitles(articles);
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			alert("Status: " + textStatus);
			alert("Error: " + errorThrown);
		}

	});
}

function capitalizeFirstLetter(string) {
  return string.charAt(0).toUpperCase() + string.slice(1);
}
function updateElement(id, rawHTML) {

    var element = document.getElementById(id);
    element.innerHTML = rawHTML;

}
function insertElement(id, rawHTML) {
    $(id).append(rawHTML);

}
