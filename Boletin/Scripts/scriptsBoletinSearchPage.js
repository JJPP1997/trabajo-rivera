
function resizer(){
	
	if($("#headerSearch").css("visibility")=="hidden"){
	var height = $("#headerSearch").height();
	height= (-height);
	$("#headerSearch").css("visibility", "hidden");
	$("#headerSearch").css("transform", "translate(0,"+height+"px)");

	$("#results").css("transform", "translate(0,"+height+"px)");
	$("#headerButton").css("transform", "translate(0,"+height+"px)");

	}
}
function getArticlesHtml4Main(articlesJson){
	var items ="";
	console.log(articlesJson);
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
					items+=rawHTML;
					
					
				
                }
				updateElement("newsContainer",items);
				
				
				
                
            } else {
				return "";
                //document.write(data[k] + "<br>");
            };
        }
}
function capitalizeFirstLetter(string) {
  return string.charAt(0).toUpperCase() + string.slice(1);
}
function manageHeader(isHidden) {
	$.keyframe.define([{
		name: 'show',
		from: {
			"transform": "translate(0px,-100%)"
		},
		to: {
			"transform": "translate(0px,0px)"
		}
	}]);
	$.keyframe.define([{
		name: 'hide',
		
		from: {
			"transform": "translate(0px,0px)"
		},
		to: {
			"transform": "translate(0px,-100%)"
		}
		
	}]);
	var height = $("#headerSearch").height();
	height= (-height);
  /*var supportedFlag = $.keyframe.isSupported();*/

	
	if(!isHidden) {
		/*setTimeout(
		  function() 
		  {
			//$("#headerSearch").css("visibility", "hidden");
			//$("#headerSearch").css("transform", "translate(0,"+height+")px");
			//$("#headerButton").css("transform", "translate(0,"+height+")px");
		}, 800);*/
		$("#headerButton").css("visibility", "hidden");
		$("#results").css("visibility", "hidden");
		$("#footer").css("visibility", "hidden");

		$("#headerSearch").removeClass( "show" );
		//$("#headerButton").removeClass( "show" ).addClass( "hide" );
		$("#headerSearch").playKeyframe({
			name: 'hide',
			duration: '1s',
			iterationCount: 1,
			complete: function(){
				$("#headerSearch").css("visibility", "hidden");
				$("#headerSearch").css("transform", "translate(0,"+height+"px)");
				
				$("#results").css("visibility", "visible");
				$("#results").css("transform", "translate(0,"+height+"px)");
				
				$("#footer").css("visibility", "visible");
			//	$("#footer").css("transform", "translate(0,"+height+"px)");
				
				$("#headerButton").css("transform", "translate(0,"+height+"px)");
				$("#headerButton").css("visibility", "visible");
				$("#headerButton" ).attr("onclick","manageHeader(true)");
				$("#headerButton").text("Abrir ᐯ");
				isHidden=true;
			}
		});
	}else{
		/*	 
		setTimeout(
		
			function() 
			  {
				$("#headerSearch").css("transform", "translate(0,0)");
				$("#headerButton").css("transform", "translate(0,0)");
			}, 800);*/	
		
		//$("#headerSearch").removeClass( "hide" ).addClass( "show" );
		//$("#headerButton").removeClass( "hide" ).addClass( "show" );
		$("#headerSearch").css("visibility", "visible");
		$("#results").css("visibility", "hidden");
		$("#headerButton").css("visibility", "hidden");
		$("#footer").css("visibility", "hidden");
		$("#headerSearch").playKeyframe({
			name: 'show',
			duration: '1s',
			iterationCount: 1,
			complete: function(){
				$("#headerSearch").css("transform", "translate(0,0)");
				
				$("#results").css("visibility", "visible");
				$("#results").css("transform", "translate(0,0)");
				
				$("#footer").css("visibility", "visible");
				//$("#footer").css("transform", "translate(0,0)");
				
				$("#headerButton").css("transform", "translate(0,0)");
				$("#headerButton").text("Cerrar ˄");
				$("#headerButton").css("visibility", "visible");
				$("#headerButton" ).attr("onclick","manageHeader(false)");
				isHidden=false;
			}
		});
		
		
	}
    
}
function forceCloseHeader(){
	manageHeader(false);
	
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
	var dir="/trabajo-rivera/Boletin/Secciones/"+capitalizeFirstLetter(tag)+"/"+articleFileName+"/";
	return dir;
}
function updateElement(id, rawHTML) {

    var element = document.getElementById(id);
    element.innerHTML = rawHTML;

}
function getArticles(){
	forceCloseHeader();
	var data=$('#searchBar').serializeArray();
	//console.log(data);
		$.ajax({
			type: "POST",
			url: "/trabajo-rivera/Boletin/Scripts/phpConectionBoletin.php", //the page containing php script
			dataType: 'json',
			data: {
				functionname: "searchArticles",
				args: data,
				
			},
			beforeSend: function() {
				$("#ArticleOverlay").show();
			},
			success: function (response) {
				console.log(response);
				var articles=JSON.parse(response);
				console.log(jQuery.isEmptyObject(articles));
				if(response=='{ "items":[]}'){
					updateElement("newsContainer","no se han encontrado resultados");
				}else{
					getArticlesHtml4Main(articles);
				}
				$("#ArticleOverlay").hide();
				//console.log(matches.items[0].idMatch);
				//return  getTitles(articles);
			},
			error: function (XMLHttpRequest, textStatus, errorThrown) {
				alert("Status: " + textStatus);
				alert("Error: " + errorThrown);
				$("#ArticleOverlay").hide();
			}

		});
	
}  


