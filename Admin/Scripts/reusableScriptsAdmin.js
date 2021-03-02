data="";
bussines="";
agendas="";
ads="";
CImages="";
galeries="";
GImages="";
POIS="";
function villageLoader(){
	checkCookie();
	$('input[type=radio][name=selectVillage]').change(function() {
		setCurrentVillage(this.value);
		
		
	});
	$('input[type=radio][name=selectVillage]').prop( "checked", false );
	
	
	
}
function articleLoader(){
	checkCookie();
	getAllArticles();
	getAllAds();
	$( "#SearchArticleInput" ).change(function() {
		if($("#SearchArticleInput").val()==""){
			getAllArticles();
		}else{
			searchArticlesTitles($("#SearchArticleInput").val());
		}
	});
	$( "#SearchAdInput" ).change(function() {
		console.log("lol");
		if($("#SearchAdInput").val()==""){
			getAllAds();
		}else{
			searchAdText($("#SearchAdInput").val());
			
		}
	});
}
function getCookie(c_name) {
    var c_value = document.cookie,
        c_start = c_value.indexOf(" " + c_name + "=");
    if (c_start == -1) c_start = c_value.indexOf(c_name + "=");
    if (c_start == -1) {
        c_value = null;
    } else {
        c_start = c_value.indexOf("=", c_start) + 1;
        var c_end = c_value.indexOf(";", c_start);
        if (c_end == -1) {
            c_end = c_value.length;
        }
        c_value = unescape(c_value.substring(c_start, c_end));
    }
    return c_value;
}
function checkCookie(){
		
	var acookie = getCookie("Rights");;
    if (!acookie) {
      window.open("LogIn.html","_self");
    }
		
}
function manageAccordion(obj){
	  obj.classList.toggle("active");
    var panel = obj.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
 
}
function editArticles(btn,txt){
	txt=txt.trim();
	//console.log(data);
	article="";
	for (var k in data) {
		if (data[k]instanceof Object) {
			//console.log(Object.values(data[k]));
			for (key in data[k]) {
				var art = data[k][key];
				var title = art["title"];
				if (title==txt){
					article=art;
					
				}		

			}
			
		} else {
			//document.write(data[k] + "<br>");
		};
	}
	
	if($("#deleteRB").is(":checked")) {
		deleteArticle(article["id"],article["tag"],article["title"]);
		//console.log(article["id"],article["tag"],article["title"]);
		//console.log("sadfsad");
		btn.remove();
		$("#updateArticle").hide();
	}
	if($("#editRB").is(":checked")) {
		aDate= new Date(article["date"]);
		setCurrentArticle(article["id"]);
		var day = ("0" + aDate.getDate()).slice(-2);
		var month = ("0" + (aDate.getMonth() + 1)).slice(-2);
		var fulldate = aDate.getFullYear()+"-"+(month)+"-"+(day) ;
		$("#updateArticle").show();

		$('#articleUpdateTitle').val(article["title"]);		
		$('#articleUpdateAutor').val( article["autor"]);
		$('#articleUpdateText').val( article["text"]);
		$('#articleUpdateDate').val(fulldate);
		if(article["image"].length==null ||article["image"].length==0 ){
			
			$('#previousImg').text( "no hay imagen en este articulo");
		}else{
			$('#previousImg').text( "la imagen anterior era "+ article["image"]);
			
		}
		switch( article["tag"]){
			case "cultura":
				$('select.articleUpdateTag').val(0);
			break;
			case "opinion":
				$('select.articleUpdateTag').val(1);
			break;
			case "deportes":
				$('select.articleUpdateTag').val(2);
			break;
			case "politica":
				$('select.articleUpdateTag').val(3);
			break;
			case "entrevistas":
				$('select.articleUpdateTag').val(4);
			break;
		}
		
	}
}
//BDD
//articles

function setCurrentArticle(num){
	document.cookie = "CurrentArticle="+num;
	
}
function setCurrentAd(num){
	document.cookie = "CurrentAdvert="+num;
	
}
function getAllAds(){
	   $.ajax({
        type: "POST",
        url: "Scripts/phpConectionArticles.php", //the page containing php script
        dataType: 'json',
        data: {
            functionname: "getAllAds",
			
        },
        success: function (response) {
		
            var adverts=JSON.parse(response);
			ads=adverts;
			
			
			getAdText(adverts);
			
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
        url: "Scripts/phpConectionArticles.php", //the page containing php script
        dataType: 'json',
        data: {
            functionname: "getAllArticles",
			
        },
        success: function (response) {
			
            var articles=JSON.parse(response);
			data=articles;
			
			
			getTitles(articles);
			
			//console.log(matches.items[0].idMatch);
            //return  getTitles(articles);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert("Status: " + textStatus);
            alert("Error: " + errorThrown);
        }

    });
}
function deleteArticle(id,tag,title){
		var args=[id,tag,title];
		//console.log(args);
	   $.ajax({
        type: "POST",
        url: "Scripts/phpConectionArticles.php", //the page containing php script
        dataType: 'text',
        data: {
            functionname: "deleteArticle",
			arguments: args,
        },
        success: function (response) {
			  alert(response);
         
			
			//console.log(matches.items[0].idMatch);
            //return  getTitles(articles);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert("Status: " + textStatus);
            alert("Error: " + errorThrown);
        }

    });
}
function deleteAd(btn,id,image){

	   $.ajax({
        type: "POST",
        url: "Scripts/phpConectionArticles.php", //the page containing php script
        dataType: 'text',
        data: {
            functionname: "deleteAd",
			arguments: new Array(id, image),
        },
        success: function (response) {
			  alert(response);
			  btn.remove();
        
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert("Status: " + textStatus);
            alert("Error: " + errorThrown);
        }

    });
}
function searchArticlesTitles(text){
	  $.ajax({
        type: "POST",
        url: "Scripts/phpConectionArticles.php", //the page containing php script
        dataType: 'json',
        data: {
            functionname: "searchArticlesTitles",
			arguments: text,
        },
        success: function (response) {
			 var articles=JSON.parse(response);
			data=articles;
			getTitles(articles);
        
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert("Status: " + textStatus);
            alert("Error: " + errorThrown);
        }

    });
}
function searchAdText(text){
	  $.ajax({
        type: "POST",
        url: "Scripts/phpConectionArticles.php", //the page containing php script
        dataType: 'json',
        data: {
            functionname: "searchAdText",
			arguments: text,
        },
        success: function (response) {
			 var ads=JSON.parse(response);
			data=ads;
			getAdText(ads);
        
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert("Status: " + textStatus);
            alert("Error: " + errorThrown);
        }

    });
}
//village
function setCurrentVillage(num){
	document.cookie = "CurrentVillage="+num;
	
	// console.log("in");
	$("#changesPanel").show();
	getBlog();
	//getMTV();
	getAllBussines();
	getAllAgendas();
	getAllCarrouselImages();
	getAllGaleries();
	getAllPOI();
	/*$.ajax({
		type: "POST",
		url: "Scripts/phpConection.php", //the page containing php script
		dataType: 'json',
		data: {
			functionname: "setCurrentVillage",
			arguments: num,
			
		},
		success: function (response) {
		
		   console.log(response);
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			alert("Status: " + textStatus);
			alert("Error: " + errorThrown);
		}

    });
	*/
}
function deleteAgendaEntry(id,image,btn){
		var args=[id,image];
	   $.ajax({
        type: "POST",
        url: "Scripts/phpConectionVillages.php", //the page containing php script
        dataType: 'text',
        data: {
            functionname: "deleteAgendaEntry",
			arguments: args,
        },
        success: function (response) {
			  alert(response);
			//console.log("borrada con exito");
			  $(btn).remove();
			//console.log(matches.items[0].idMatch);
            //return  getTitles(articles);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert("Status: " + textStatus);
            alert("Error: " + errorThrown);
        }

    });
}
function deleteBussines(id,image,type,btn){
		var args=[id,image,type];
	   $.ajax({
        type: "POST",
        url: "Scripts/phpConectionVillages.php", //the page containing php script
        dataType: 'text',
        data: {
            functionname: "deleteBussines",
			arguments: args,
        },
        success: function (response) {
		  alert(response);			
		  $(btn).remove();
			//console.log(matches.items[0].idMatch);
            //return  getTitles(articles);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert("Status: " + textStatus);
            alert("Error: " + errorThrown);
        }

    });
}
function deleteCarrouselImage(id,image,btn){
		var args=[id,image];
	   $.ajax({
        type: "POST",
        url: "Scripts/phpConectionVillages.php", //the page containing php script
        dataType: 'text',
        data: {
            functionname: "deleteCarrouselImage",
			arguments: args,
        },
        success: function (response) {
			//console.log(response);
			alert(response);			
			$(btn).remove();
			//console.log(matches.items[0].idMatch);
            //return  getTitles(articles);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert("Status: " + textStatus);
            alert("Error: " + errorThrown);
        }

    });
}
function deletePOI(id,image,btn){
		var args=[id,image];
	   $.ajax({
        type: "POST",
        url: "Scripts/phpConectionVillages.php", //the page containing php script
        dataType: 'text',
        data: {
            functionname: "deletePOI",
			arguments: args,
        },
        success: function (response) {
			//console.log(response);
			alert(response);			
			$(btn).remove();
			//console.log(matches.items[0].idMatch);
            //return  getTitles(articles);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert("Status: " + textStatus);
            alert("Error: " + errorThrown);
        }

    });
}
function deleteGaleryImage(id,image,btn){
		var args=[id,image];
	   $.ajax({
        type: "POST",
        url: "Scripts/phpConectionVillages.php", //the page containing php script
        dataType: 'text',
        data: {
            functionname: "deleteGaleryImage",
			arguments: args,
        },
        success: function (response) {
			alert(response);
			// alert(response);			
			$(btn).remove();
			//console.log(matches.items[0].idMatch);
            //return  getTitles(articles);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert("Status: " + textStatus);
            alert("Error: " + errorThrown);
        }

    });
}
function deleteGalery(id,name,btn){
		var args=[id,name];
	   $.ajax({
        type: "POST",
        url: "Scripts/phpConectionVillages.php", //the page containing php script
        dataType: 'text',
        data: {
            functionname: "deleteGalery",
			arguments: args,
        },
        success: function (response) {
			console.log(response);
			 alert(response);			
			$(btn).remove();
			//console.log(matches.items[0].idMatch);
            //return  getTitles(articles);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert("Status: " + textStatus);
            alert("Error: " + errorThrown);
        }

    });
}

function getBlog(){
	
	 $.ajax({
        type: "POST",
        url: "Scripts/phpConectionVillages.php", //the page containing php script
        dataType: 'json',
        data: {
            functionname: "getBlog",
			
        },
        success: function (response) {
			var blog=JSON.parse(response);
			getBlogData(blog);
			
			//console.log(matches.items[0].idMatch);
            //return  getTitles(articles);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert("Status: " + textStatus);
            alert("Error: " + errorThrown);
        }

    });
}
function getMTV(){
	console.log("mtv");
	 $.ajax({
        type: "POST",
        url: "Scripts/phpConectionVillages.php", //the page containing php script
        dataType: 'text',
        data: {
            functionname: "getMTV",
			
        },
        success: function (response) {
			console.log(response);
           $("#meetTheVillageText").val(response);
			
			//console.log(matches.items[0].idMatch);
            //return  getTitles(articles);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert("Status: " + textStatus);
            alert("Error: " + errorThrown);
        }

    });
}
function getAllBussines(){

	  $.ajax({
        type: "POST",
        url: "Scripts/phpConectionVillages.php", //the page containing php script
        dataType: 'json',
        data: {
            functionname: "getAllBussines",
			
        },
        success: function (response) {
			//console.log("lol"+response);
            var bussineses=JSON.parse(response);
			bussines=bussineses;
			//console.log(articles);
			insertBussines(bussineses);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert("Status: " + textStatus);
            alert("Error: " + errorThrown);
			
        }

    });
}
function getAllAgendas(){
	
	  $.ajax({
        type: "POST",
        url: "Scripts/phpConectionVillages.php", //the page containing php script
        dataType: 'json',
        data: {
            functionname: "getAllAgendas",
			
        },
        success: function (response) {
			
            var entries=JSON.parse(response);
			CImages=entries;
			
			insertAgendaEntry(entries);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert("Status: " + textStatus);
            alert("Error: " + errorThrown);
			console.log("fallo en 339");
        }

    });
}
function getAllGaleries(){
	
	  $.ajax({
        type: "POST",
        url: "Scripts/phpConectionVillages.php", //the page containing php script
        dataType: 'json',
        data: {
            functionname: "getAllGaleries",
			
        },
        success: function (response) {
			//console.log(response);
            var entries=JSON.parse(response);
			galeries=entries;
			//console.log(response);
			insertGaleries(entries);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert("Status: " + textStatus);
            alert("Error: " + errorThrown);
			console.log("fallo en galeries");
        }

    });
}
function getAllGaleryImages(){
	
	  $.ajax({
        type: "POST",
        url: "Scripts/phpConectionVillages.php", //the page containing php script
        dataType: 'json',
        data: {
            functionname: "getAllImagesFromGalery",
			
        },
        success: function (response) {
			console.log(response);
            var images=JSON.parse(response);
			GImages=images;
			
			insertGaleryImages(images);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert("Status: " + textStatus);
            alert("Error: " + errorThrown);
			console.log("fallo en galeriy images");
        }

    });
}
function getAllPOI(){
	
	  $.ajax({
        type: "POST",
        url: "Scripts/phpConectionVillages.php", //the page containing php script
        dataType: 'json',
        data: {
            functionname: "getAllPOI",
			
        },
        success: function (response) {
			
            var POI=JSON.parse(response);
			POIS=POI;
			
			insertPOI(POI);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert("Status: " + textStatus);
            alert("Error: " + errorThrown);
			console.log("fallo en galeriy images");
        }

    });
}

function getAllCarrouselImages(){
	
	  $.ajax({
        type: "POST",
        url: "Scripts/phpConectionVillages.php", //the page containing php script
        dataType: 'json',
        data: {
            functionname: "getAllCarrouselImages",
			
        },
        success: function (response) {
			
            var images=JSON.parse(response);
			CImages=images;
			
			insertCarrouselImages(images);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert("Status: " + textStatus);
            alert("Error: " + errorThrown);
			
        }

    });
}
function insertAgendaEntry(articlesJson){
	var items ="";
	
	    for (var k in articlesJson) {
            if (articlesJson[k]instanceof Object) {
            
                for (key in articlesJson[k]) {
                    var agenda = articlesJson[k][key];
					var id=agenda["id"];
                    var title = agenda["title"];
					var image = agenda["image"];
					rawHTML='<button class="articleBTN" onclick="deleteAgendaEntry('+id+',\''+image+'\',this)">'+title+'</button>';
					items+=rawHTML;
				
                }
				updateElement("agendaContainer",items);
                
            } else {
                //document.write(data[k] + "<br>");
            };
        }
}
function insertCarrouselImages(articlesJson){
	var items ="";
	
	    for (var k in articlesJson) {
            if (articlesJson[k]instanceof Object) {
            
                for (key in articlesJson[k]) {
                    var image = articlesJson[k][key];
					var id=image["id"];
                    var imageName = image["image"];
					rawHTML='<button class="articleBTN" onclick="deleteCarrouselImage('+id+',\''+imageName+'\',this)">'+imageName+'</button>';
					items+=rawHTML;
				
                }
				updateElement("carruselContainer",items);
                
            } else {
                //document.write(data[k] + "<br>");
            };
        }
}
function insertBussines(articlesJson){
	var items = "";
	    for (var k in articlesJson) {
            if (articlesJson[k]instanceof Object) {
                //console.log(Object.values(data[k]));
                for (key in articlesJson[k]) {
                    var bussines = articlesJson[k][key];
					var id=bussines["id"];
                    var title = bussines["title"];
					var image = bussines["image"];
					var type=bussines["type"];
					rawHTML='<button class="articleBTN" onclick="deleteBussines('+id+',\''+image+'\',\''+type+'\',this)">'+title+'</button>';
					items+=rawHTML;
				
                }
				updateElement("bussinesContainer",items);
                
            } else {
                //document.write(data[k] + "<br>");
            };
        }
}
function insertGaleries(articlesJson){
	var items4delete = "";
	var items4insert = "";
	
	    for (var k in articlesJson) {
			//console.log(k);
            if (articlesJson[k]instanceof Object) {
				//console.log(articlesJson[k]);
             //   console.log(Object.values(data[k]));
                for (key in articlesJson[k]) {
					//console.log(key);
                    var galery = articlesJson[k][key];
					//console.log(galery);
					var id= galery["id"];
                    var title = galery["title"];
					//console.log(title);
					var rawHTMLDelete='<button class="articleBTN" onclick="deleteGalery('+id+',\''+title+'\',this)" > '+title+'</button>';
					var rawHTMLInsert='<button class="articleBTN" onclick="setCurrentGalery('+id+',\''+title+'\',this)" > '+title+'</button>';
					
					
					items4delete+=rawHTMLDelete;
					items4insert+=rawHTMLInsert;
					
                }
			
				updateElement("addToGaleryContainer",items4insert);
				updateElement("deleteGaleryContainer",items4delete);
				updateElement("deleteImageFromGaleryContainer",items4insert);
                
            } else {
               console.log("NO INSTANCE OF ONJECT FOUND");
            };
        }
}
function insertGaleryImages(articlesJson){
	var items = "";
	    for (var k in articlesJson) {
            if (articlesJson[k]instanceof Object) {
                console.log(articlesJson[k]);
                for (key in articlesJson[k]) {
                    var image = articlesJson[k][key];
					var id= image["id"];
                    var imageName = image["image"];
					rawHTML='<button class="articleBTN" onclick="deleteGaleryImage('+id+',\''+imageName+'\',this)" >'+imageName+'</button>';
					items+=rawHTML;
					
                }
				
			
                
            } else {
                //document.write(data[k] + "<br>");
            };
        }
		
		updateElement("imageToDeleteContainer",items);
}
function insertPOI(articlesJson){
	var items = "";
	    for (var k in articlesJson) {
            if (articlesJson[k]instanceof Object) {
            //    console.log(articlesJson[k]);
                for (key in articlesJson[k]) {
                    var image = articlesJson[k][key];
					var id= image["id"];
                    var imageName = image["image"];
					rawHTML='<button class="articleBTN" onclick="deletePOI('+id+',\''+imageName+'\',this)" >'+imageName+'</button>';
					items+=rawHTML;
					
                }
				updateElement("POIContainer",items);
			
                
            } else {
                //document.write(data[k] + "<br>");
            };
        }
}
function setCurrentGalery(id,title,btn){

	setCurrentGaleryCookie(title);
	setCurrentGaleryIdCookie(id);
	$(".articleBTN").css("background-color", "#eee");
	$(btn).css("background-color", "#add8e6");
	getAllGaleryImages();
}
function setCurrentGaleryCookie(name){
	document.cookie = "CurrentGalery="+name;
}
function setCurrentGaleryIdCookie(id){
	document.cookie = "CurrentGaleryId="+id;
}
//utility

function updateElement(id, rawHTML) {

    var element = document.getElementById(id);
    element.innerHTML = rawHTML;

}
function insertElement(id, rawHTML) {
    $(id).append(rawHTML);

}

function getTitles(articlesJson){
		
		var items = "";
	    for (var k in articlesJson) {
			
            if (articlesJson[k]instanceof Object) {
               
                for (key in articlesJson[k]) {
                    var article = articlesJson[k][key];
                    var title = article["title"];
					
					rawHTML='<button class="articleBTN" onclick="editArticles(this,\''+title+' \')">'+title+'</button>';
					//insertElement("#articleContainer",rawHTML);
                    items+=rawHTML;
				
                }
				updateElement("articleContainer",items);
				//insertTitles(items);
                
            } else {
                //document.write(data[k] + "<br>");
            };
        }
}
function getAdText(adsJson){
		
		var items ="";
	    for (var k in adsJson) {
			
            if (adsJson[k]instanceof Object) {
               
                for (key in adsJson[k]) {
                    var ad = adsJson[k][key];
                    var text = ad["text"];
					var id=ad["id"];
					var image=ad["image"];
					rawHTML='<button class="articleBTN" onclick="deleteAd(this,'+id+',\''+image+'\')">'+text+'</button>';
					//insertElement("#adContainer",rawHTML);
                     items+=rawHTML;
				
                }
				updateElement("adContainer",items);
				//insertTitles(items);
                
            } else {
                //document.write(data[k] + "<br>");
            };
        }
}

function getBlogData(articlesJson){
		
		var items = [];
	    for (var k in articlesJson) {
			
            if (articlesJson[k]instanceof Object) {
               
                for (key in articlesJson[k]) {
                    var blog = articlesJson[k][key];
					var history=blog["history"];
					var desc=blog["desc"];
					var name=blog["name"];
					var poitext=blog["poiText"];
					
					$("#meetTheVillageText").val(desc);
					$("#historyText").val(history);
					$("#POIText").val(poitext);
				
                }
				
				//insertTitles(items);
                
            } else {
                //document.write(data[k] + "<br>");
            };
        }
}
function insertTitles(items){
	 for (var k in items) {
		 rawHTML='<button class="articleBTN" onclick="editArticles(this,\''+items[k]+' \')">'+items[k]+'</button>';
		insertElement("#articleContainer",rawHTML);
	 }
	
}