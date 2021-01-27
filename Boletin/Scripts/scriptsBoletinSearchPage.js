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