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
function closeMapNav(){
	$.keyframe.define([{
		name: 'hide',
		
		from: {
			"transform": "translate(0px,0px)"
		},
		to: {
			"transform": "translate(-100%,0px)"
		}
		
	}]);
	$("#mapSidenav").playKeyframe({
			name: 'hide',
			duration: '1s',
			iterationCount: 1,
			complete: function(){
				document.getElementById("mapSidenav").style.display = "none";
				
			}
		});  
	
}
function openMapNav(){
	resetSidenav();
	
	$("#header").css("background-color", "#F0F0F0"); 
	$.keyframe.define([{
		name: 'show',
		from: {
			"transform": "translate(-100%,0px)"
		},
		to: {
			"transform": "translate(0px,0px)"
		}
	}]);
	document.getElementById("mapSidenav").style.display = "inline";
	$("#mapSidenav").playKeyframe({
		name: 'show',
		duration: '1s',
		iterationCount: 1
		
	});
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
function setSidenavWith(){
	var width=$(window).width();
	if(width<400){
		$("#mySidenav").width( width-($("#containerBtn").width()+10));
	}else{
		$("#mySidenav").width(300);
	}
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
function openNav(x) {
	document.getElementById("mapSidenav").style.display = "none";
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
function closeThis(obj){
	obj.parentElement.style.display="none";
	
}
function openMap(){
	$('#mapMenu').show()
	$('#mapSidenav').hide()
	
	fitVerticalAds()
	//$(".verticalAd").hide();
	resetSidenav();
	imageMapResize();
	fitMapSidenav();
}
function closeMap(){
	$('#mapSidenav').hide()
	$('#mapMenu').hide()
	
	//$(".verticalAd").show();
	fitVerticalAds()
}
function fitVerticalAds(){
	width=$(window).width()*0.1;
	first=wh=$( ".article" ).first();
	offset=first.offset();
	wh=first.height();
	
	$(".verticalAd").css({"width": width+"px"});
	$(".verticalAd").css({"height": wh+"px"});
	$(".verticalAd").css({"top": offset.top+"px"});
	/*if($("#mapMenu").is(":visible")){
		height=$("#mapMenu").height()+450;
		$(".verticalAd").css({"top": height+"px"});
	}
	else{
		$(".verticalAd").css({"top": "450px"});
	}*/
}
function fitMapSidenav(){
	height=$("#mapBackground").height();
	$("#mapSidenav").height(height);
}
//PHP CONECTION

function getArticlesByTag(tags){
	getAllAds();
	getAllArticles();
}


function getAllArticlesByTag(tag){
	   $.ajax({
        type: "POST",
        url: "Scripts/phpConectionBoletin.php", //the page containing php script
        dataType: 'json',
        data: {
            functionname: "getAllArticles",
			arguments: tag,
        },
        success: function (response) {
			
            var articles=JSON.parse(response);
			return articles;
			
			//console.log(matches.items[0].idMatch);
            //return  getTitles(articles);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert("Status: " + textStatus);
            alert("Error: " + errorThrown);
        }

    });
}
function getArticlesHtml(articlesJson){
	var items ="";
	
	    for (var k in articlesJson) {
            if (articlesJson[k]instanceof Object) {
            
                for (key in articlesJson[k]) {
                    var article = articlesJson[k][key];
					var id=article["id"];
					var date=article["date"];
                    var title = article["title"];
					var text = article["text"];
					var image = article["image"];
					var imageDesc=article["imageDesc"];
					var autor=article["autor"];
					var tag=article["tag"];
					
					rawHTML="<div class=\"article\" onclick=\"location.href=\'"+getArticleDir(title,tag)+"\';\" >"+
			
					'<div class="articleTags">'+
						capitalizeFirstLetter(tag)+
					"</div>"+
					'<div class="imageContainer">'+
						'<img src="Secciones/articleExample/placeholder1.gif"></img>'+
					'</div>'+
						'<h1>'+title +'</h1>'+
					'<div class="articleData">'+
						'<p class="articleAutor">'+ autor +'</p>'+
						'<p class="articleDate">'+date+'</p>'+
					'</div>'+
					'<p class="articleSample">'+
						text+
					'</p>'+
					'</div>';
				
					items+=rawHTML;
				
                }
				return items;
                
            } else {
				return "";
                //document.write(data[k] + "<br>");
            };
        }
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