function checkUser(){
	
		
		var allOk=true;
		var name= $("#name").val();
		var pass= $("#pass").val();
		if(name=="" || name==null){
			allOk=false;
			alert("el nombre no puede estar vacio");
		}
		if(pass=="" || pass==null){
			allOk=false;
			alert("la contraseña no puede estar vacia");
		}
		var ilegalWords = new Array(
			"select","delete","where","all","and","any","between","exists","*","&","insert","set","value","(",")"
		);
		if(ilegalWords.includes(name.toLowerCase())){
			allOk=false;
			alert("el nombre contiene una palabra prohibida");
		}
		if(ilegalWords.includes(pass.toLowerCase())){
			allOk=false;
				alert("la contraseña contiene una palabra prohibida");
		}
		for(var i=0;i<ilegalWords.length;i++){
			if(name.includes(ilegalWords[i]) ||pass.includes(ilegalWords[i]) ){
				allOk=false;
				alert("se ha detectado un intento de insercion de codigo");
			}
		}
		if(allOk){
			var args=[name,pass];
			console.log("LOL"+args);
			callDb(args);
		}
}
function callDb(args){
	  $.ajax({
		type: "POST",
		url: "Scripts/phpConectionLogIn.php", //the page containing php script
		dataType: 'text',
		data: {
			functionname: "checkUser",
			arguments: args,
		},
		success: function (response) {
			console.log(response);
			if(response===""){
				alert("Usuario no registrado");
			}else{
				document.cookie = "Rights="+response;
				window.open("Selector.html","_self");
			}
			
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			console.log(XMLHttpRequest);
			console.log("Status: " + textStatus);
			console.log("Error: " + errorThrown);
		}

		});
}