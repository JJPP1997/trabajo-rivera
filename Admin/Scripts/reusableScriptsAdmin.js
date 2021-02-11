data="";

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
		//btn.remove();
	
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
function setCurrentVillage(num){
	window.open("Pueblos.html");
	$.ajax({
		type: "POST",
		url: "Scripts/phpConection.php", //the page containing php script
		dataType: 'json',
		data: {
			functionname: "setCurrentVillage",
			arguments: num,
			
		},
		success: function (response) {
		   window.open("Pueblos.html");
		   console.log(response);
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			alert("Status: " + textStatus);
			alert("Error: " + errorThrown);
		}

    });
	
}
function setCurrentArticle(num){
	$.ajax({
		type: "POST",
		url: "Scripts/phpConection.php", //the page containing php script
		dataType: 'text',
		data: {
			functionname: "setCurrentArticle",
			arguments: num,
			
		},
		success: function (response) {
		   console.log(response);
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
        url: "Scripts/phpConection.php", //the page containing php script
        dataType: 'json',
        data: {
            functionname: "getAllArticles",
			
        },
        success: function (response) {
			//console.log(response);
            var articles=JSON.parse(response);
			data=articles;
			//console.log(articles);
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
	   $.ajax({
        type: "POST",
        url: "Scripts/phpConection.php", //the page containing php script
        dataType: 'text',
        data: {
            functionname: "deleteArticle",
			arguments: id,tag,title,
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
function getTitles(articlesJson){
		var items = [];
	    for (var k in articlesJson) {
            if (data[k]instanceof Object) {
                //console.log(Object.values(data[k]));
                for (key in data[k]) {
                    var article = data[k][key];
                    var title = article["title"];
                    items.push(title);
				
                }
				insertTitles(items);
                
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
function updateElement(id, rawHTML) {

    var element = document.getElementById(id);
    element.innerHTML = rawHTML;

}
function insertElement(id, rawHTML) {
    $(id).append(rawHTML);

}
