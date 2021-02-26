var clicked=false;
var ads=[];
var currentAd=0;
var tid = setTimeout(setAds, 30000);
class Ad {
  constructor(id,text,image) {
    this.id = id;
	this.text = text;
    this.image = image;
	}
   getId(){
	  return this.id;
	}
   getText(){
	    return this.text;
	}
   getImage(){
	    return this.image;
	}
    setId(i){
		this.id=i;
	}
   setText(txt){
	    this.text=txt;
	}
   setImage(img){
	     this.image=img;
	}
   getRawHtml(){
	  var raw='<a href="javascript:void(0)" class="closeBtnAd" onclick="closeThis(this)"> &times;</a>'+
		"<p>"+this.text+"</p>";
		return raw;
  }
}
function loader(){
	getArticlesForMain();
	imageMapResize();
	
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
function getArticlesForMain(){
	var ads=getAllAds();
	getAllArticles();
	getAllAds();
}
function resizer(){
	imageMapResize();
	fitVerticalAds();
	fitMapSidenav();
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

function getArticlesHtml4Main(articlesJson){
	var items ="";
	var recentItems="";
	var counter=0;
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
					var fulldir=getArticleDir(title,tag);
					var imageHTML="";
					var textHTML="";
					if(text.length>100){
						textHTML=text.substring(0, 100);
					}else{
						textHTML=text;
					}
					if(image!=null && image!=""){
						imageHTML='<img src="'+fulldir+image+'"></img>';
					}
					rawHTML="<div class=\"article\" onclick=\"location.href=\'"+fulldir+"articulo.html"+"\';\" >"+
			
					'<div class="articleTags" >'+
						capitalizeFirstLetter(tag)+
					"</div>"+
					'<div class="imageContainer" >'+
						imageHTML+
					'</div>'+
						'<h1>'+title +'</h1>'+
					'<div class="articleData" >'+
						'<p class="articleAutor" >'+ autor +'</p>'+
						'<p class="articleDate" >'+date.slice(0,-8)+'</p>'+
					'</div>'+
					'<p class="articleSample" >'+
						textHTML+
					'</p>'+
					'</div>';
					counter=counter+1;
					if(counter>3){
						items+=rawHTML;
					}else{
						recentItems+=rawHTML;
					}
					
				
                }
				updateElement("recentNewsContainer",recentItems);
				updateElement("allNewsContainer",items);
				
				
                
            } else {
				return "";
                //document.write(data[k] + "<br>");
            };
        }
}
function getAllAds(){
	   $.ajax({
			type: "POST",
			url: "Scripts/phpConectionBoletin.php", //the page containing php script
			dataType: 'json',
			data: {
				functionname: "getAllAds",
				
			},
			success: function (response) {
			
				var adverts=JSON.parse(response);
				getAds(adverts);
				
				//console.log(matches.items[0].idMatch);
				//return  getTitles(articles);
			},
			error: function (XMLHttpRequest, textStatus, errorThrown) {
				alert("Status: " + textStatus);
				alert("Error: " + errorThrown);
			}

		});
}
function getAllArticles(){
	   $.ajax({
        type: "POST",
        url: "Scripts/phpConectionBoletin.php", //the page containing php script
        dataType: 'json',
        data: {
            functionname: "getAllArticles",
			
        },
        success: function (response) {
			
            var articles=JSON.parse(response);
			getArticlesHtml4Main(articles);
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
					fitVerticalAds();
					$("#overlay").css("display", "none"); 
				}
			});
			
			//console.log(matches.items[0].idMatch);
            //return  getTitles(articles);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert("Status: " + textStatus);
            alert("Error: " + errorThrown);
        }

    });
}
function getArticleDir(title,tag){
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
	var dir="Secciones/"+capitalizeFirstLetter(tag)+"/"+articleFileName+"/";
	return dir;
}
function getAds(articlesJson){
	var items =[];
	
	var	counter=1;
	    for (var k in articlesJson) {
            if (articlesJson[k]instanceof Object) {
				counter=counter+1;
                for (key in articlesJson[k]) {
                    var ad = articlesJson[k][key];
					var id=ad["id"];
					var text = ad["text"];
					var image = ad["image"];
					
					var newAd= new Ad(id,text,image);
					items.push(newAd);
					
                }
				ads=items;		
                setAds();
				fitVerticalAds();
            } else {
				return "";
                //document.write(data[k] + "<br>");
            };
        }
}

function setAds(){
	if(ads.length>0){
		for(var i=0;i<4;i++){
			insertAd(i);
			currentAd=currentAd+1;
		}
	}
	tid = setTimeout(setAds, 30000);
}
function insertAd(num){
	if(currentAd>=ads.length){
		currentAd=0;
	}
	var id="";
	switch(num){
		case 0:
			id="hAdd1";
		break;
		case 1:
			id="hAdd2";
		break;
		case 2:
			id="vAdd1";
		break;
		case 3:
			id="vAdd2";
		break;
	}
	
	html=ads[currentAd].getRawHtml();
	img=ads[currentAd].getImage();
	updateElement(id,html);
	$('#'+id).css('background-image', 'url("' +"Imagenes/"+img+ '")');
	
}

function scroller(){
	manageHeader();
	fitVerticalAds();
}







