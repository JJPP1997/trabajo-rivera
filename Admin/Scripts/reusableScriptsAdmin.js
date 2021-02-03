
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
function editArticles(btn){
	if($("#deleteRB").is(":checked")) {
		btn.remove();
	}
	if($("#editRB").is(":checked")) {
		$("#editForm").show();
	}
}
//BDD
function setCurrentVillage(num){
	window.open("Pueblos.html");
	$.ajax({
		type: "POST",
		url: "phpConection.php", //the page containing php script
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
function getAllArticles(){
	   $.ajax({
        type: "POST",
        url: "phpConection.php", //the page containing php script
        dataType: 'json',
        data: {
            functionname: "getAllArticles",

        },
        success: function (response) {
            var articles=JSON.parse(response);
			
			console.log(articles);
			//console.log(matches.items[0].idMatch);
            return articles;
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert("Status: " + textStatus);
            alert("Error: " + errorThrown);
        }

    });
}

function updateElement(id, rawHTML) {

    var element = document.getElementById(id);
    element.innerHTML = rawHTML;

}
function insertElement(id, rawHTML) {
    $(id).append(rawHTML);

}
