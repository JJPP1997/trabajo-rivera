data="";
bussines="";
agendas="";
ads="";

function villageLoader(){
	$('input[type=radio][name=selectVillage]').change(function() {
		setCurrentVillage(this.value);
		
		//console.log(this.value);
	});
	$('input[type=radio][name=selectVillage]').prop( "checked", false );
	
	
	checkCookie();
}
function articleLoader(){
	checkCookie();
	getAllArticles();
	getAllAds();
}
function checkCookie(){
	return true;
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
	console.log(num);
}
function setCurrentAd(num){
	document.cookie = "CurrentAdvert="+num;
	console.log(num);
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
//village
function setCurrentVillage(num){
	document.cookie = "CurrentVillage="+num;
	
	// console.log("in");
	$("#changesPanel").show();
	getBlog();
	//getMTV();
	getAllBussines();
	getAllAgendas();
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
function deleteBussines(id,image,btn){
		var args=[id,image];
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
			//console.log(response);
            var bussineses=JSON.parse(response);
			bussines=bussineses;
			//console.log(articles);
			insertBussines(bussineses);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert("Status: " + textStatus);
            alert("Error: " + errorThrown);
			console.log("fallo en 316");
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
			agendas=entries;
			
			insertAgendaEntry(entries);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert("Status: " + textStatus);
            alert("Error: " + errorThrown);
			console.log("fallo en 339");
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
					rawHTML='<button class="articleBTN" onclick="deleteAgendaEntry('+id+',\''+title+' \',this)">'+title+'</button>';
					items+=rawHTML;
				
                }
				updateElement("agendaContainer",items);
                
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
					rawHTML='<button class="articleBTN" onclick="deleteBussines('+id+',\''+image+' \',this)">'+title+'</button>';
					items+=rawHTML;
				
                }
				updateElement("bussinesContainer",items);
                
            } else {
                //document.write(data[k] + "<br>");
            };
        }
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