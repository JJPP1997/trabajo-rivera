function isHeaderSticky(){
	var header = document.getElementById("header");
	var sticky = header.offsetTop;
	 if (window.pageYOffset > sticky) {
		return true;
	  } else {
		return false;
	  }
}
function manageHeader(){
	
	 if (isHeaderSticky()) {
		header.classList.add("sticky");
	  } else {
		 if(!$('#submenu').is(':visible')){
			header.classList.remove("sticky");
		 }
	  }
}
function toggleSubmenu() {
	$("#submenu").toggle(0);
	//var height = $("#wholeHeader").height();
	//var submenuH=$("#submenu").height();
	var header = document.getElementById("header");
    if(!$('#submenu').is(':visible')){
		//$("#wholeHeader").height((height-submenuH));
		
		var sticky = header.offsetTop;
		 if (!isHeaderSticky()) {
			header.classList.remove("sticky");
		 }
		
	}else{
		header.classList.add("sticky");
		//$("#wholeHeader").height((height+submenuH));
	}
};