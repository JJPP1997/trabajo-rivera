function manageHeader(){
	
	var header = document.getElementById("header");
	var sidenav = document.getElementById("mySidenav");
	var sticky = header.offsetTop;
	 if (window.pageYOffset > sticky) {
		header.classList.add("sticky");
	
	  } else {
		header.classList.remove("sticky");
		
		
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
function alignSidenav(){
	var sticky = header.offsetTop;
	 if (window.pageYOffset > sticky) {
		
		$("#mySidenav").css("top",$("#nonStickHeader").height()+"px")
		
	  } else {
		  if($("#header").hasClass("sticky")){
			if(window.pageYOffset < 1){
			  	
				offset=$("#wholeHeader").offset();
				$("#mySidenav").css("top",offset+"px");
			  }else{
					
				  $("#mySidenav").css("top",window.pageYOffset+"px");
			  }
		  }else{
				offset=$("#wholeHeader").offset();
				$("#mySidenav").css("top",offset+"px");
		  }
		
	  }
	
}
