var isHidden=false;
function manageHeader() {
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
	var height = $("#header").height();
	height= (-height);
  /*var supportedFlag = $.keyframe.isSupported();*/
  console.log($("#header").is(":visible"));
	
	if(!isHidden) {
		/*setTimeout(
		  function() 
		  {
			//$("#header").css("visibility", "hidden");
			//$("#header").css("transform", "translate(0,"+height+")px");
			//$("#headerButton").css("transform", "translate(0,"+height+")px");
		}, 800);*/
		$("#headerButton").css("visibility", "hidden");
		$("#header").removeClass( "show" );
		 console.log("in");
		//$("#headerButton").removeClass( "show" ).addClass( "hide" );
		$("#header").playKeyframe({
			name: 'hide',
			duration: '1s',
			iterationCount: 1,
			complete: function(){
				$("#header").css("visibility", "hidden");
				$("#header").css("transform", "translate(0,"+height+"px)");
				$("#headerButton").css("transform", "translate(0,"+height+"px)");
				$("#headerButton").css("visibility", "visible");
				$("#headerButton").text("Abrir ᐯ");
				isHidden=true;
			}
		});
	}else{
		/*	 
		setTimeout(
		
			function() 
			  {
				$("#header").css("transform", "translate(0,0)");
				$("#headerButton").css("transform", "translate(0,0)");
			}, 800);*/	
		
		//$("#header").removeClass( "hide" ).addClass( "show" );
		//$("#headerButton").removeClass( "hide" ).addClass( "show" );
		$("#header").css("visibility", "visible");
		console.log("out");
		$("#headerButton").css("visibility", "hidden");
		$("#header").playKeyframe({
			name: 'show',
			duration: '1s',
			iterationCount: 1,
			complete: function(){
				$("#header").css("transform", "translate(0,0)");
				$("#headerButton").css("transform", "translate(0,0)");
				
				$("#headerButton").text("Cerrar ˄");
				$("#headerButton").css("visibility", "visible");
				isHidden=false;
			}
		});
		
		
	}
    
}