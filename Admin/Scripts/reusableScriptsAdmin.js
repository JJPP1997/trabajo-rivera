data="";
function villageLoader(){
	$('input[type=radio][name=selectVillage]').change(function() {
		setCurrentVillage(this.value);
		//console.log(this.value);
	});
	checkCookie();
}
function articleLoader(){
	checkCookie();
	getAllArticles();
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
	console.log(data);
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
		if(article["image"].length==0 ){
			
			$('#previousImg').text( "no hay imagen en este articulo");
		}else{
			$('#previousImg').text( "la imagen anterior era "+article["image"]);
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
function setCurrentVillage(num){
	document.cookie = "CurrentVillage="+num;
	
	// console.log("in");
	$("#changesPanel").show();
	getHistory(num);
	//getMTV();
	//getAllBussines();
	//getAllAgendas();
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
function setCurrentArticle(num){
	$.ajax({
		type: "POST",
		url: "Scripts/phpConectionArticles.php", //the page containing php script
		dataType: 'text',
		data: {
			functionname: "setCurrentArticle",
			arguments: num,
			
		},
		success: function (response) {
		 
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			alert("Status: " + XMLHttpRequest);
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
			//console.log(response);
           
			
			//console.log(matches.items[0].idMatch);
            //return  getTitles(articles);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert("Status: " + textStatus);
            alert("Error: " + errorThrown);
        }

    });
}
//village
function deleteAgendaEntry(id,image){
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
			//console.log(response);
           
			
			//console.log(matches.items[0].idMatch);
            //return  getTitles(articles);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert("Status: " + textStatus);
            alert("Error: " + errorThrown);
        }

    });
}
function deleteBussines(id,image){
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
			console.log(response);
           
			
			//console.log(matches.items[0].idMatch);
            //return  getTitles(articles);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert("Status: " + textStatus);
            alert("Error: " + errorThrown);
        }

    });
}
function getHistory(id){
	
	 $.ajax({
        type: "POST",
        url: "Scripts/phpConectionVillages.php", //the page containing php script
        dataType: 'text',
        data: {
            functionname: "getHistory",
			arguments:id,
        },
        success: function (response) {
			console.log("history"+response);
           $("#historyText").val(response);
			
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
		console.log("nussines");
	  $.ajax({
        type: "POST",
        url: "Scripts/phpConectionVillages.php", //the page containing php script
        dataType: 'json',
        data: {
            functionname: "getAllBussines",
			
        },
        success: function (response) {
			console.log(response);
            var bussineses=JSON.parse(response);
			data=bussineses;
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
	console.log("agendas");	  
	  $.ajax({
        type: "POST",
        url: "Scripts/phpConectionVillages.php", //the page containing php script
        dataType: 'json',
        data: {
            functionname: "getAllAgendas",
			
        },
        success: function (response) {
			console.log(response);
            var entries=JSON.parse(response);
			insertAgendaEntry(entries);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert("Status: " + textStatus);
            alert("Error: " + errorThrown);
			console.log("fallo en 339");
        }

    });
}
function insertAgendaEntry(items){
	var items = [];
	    for (var k in articlesJson) {
            if (data[k]instanceof Object) {
                //console.log(Object.values(data[k]));
                for (key in data[k]) {
                    var bussines = data[k][key];
					var id=bussines["id"];
                    var title = bussines["title"];
					rawHTML='<button class="articleBTN" onclick="deleteAgendaEntry('+id+',\''+title+' \')">'+title+'</button>';
					insertElement("#articleContainer",rawHTML);
				
                }
				
                
            } else {
                //document.write(data[k] + "<br>");
            };
        }
}
function insertBussines(items){
	var items = [];
	    for (var k in articlesJson) {
            if (data[k]instanceof Object) {
                //console.log(Object.values(data[k]));
                for (key in data[k]) {
                    var bussines = data[k][key];
					var id=bussines["id"];
                    var title = bussines["title"];
					rawHTML='<button class="articleBTN" onclick="deleteBussines('+id+',\''+title+' \')">'+title+'</button>';
					insertElement("#articleContainer",rawHTML);
				
                }
				
                
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
		
		var items = [];
	    for (var k in articlesJson) {
			
            if (articlesJson[k]instanceof Object) {
               
                for (key in articlesJson[k]) {
                    var article = articlesJson[k][key];
                    var title = article["title"];
					
					rawHTML='<button class="articleBTN" onclick="editArticles(this,\''+title+' \')">'+title+'</button>';
					insertElement("#articleContainer",rawHTML);
                    items.push(title);
				
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