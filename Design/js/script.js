var myVar = 0;

function StartTracking(){
	myVar = setInterval(function(){ LoadNetworkMap() }, 2000);

	// setInterval(LoadNetworkMap, 3000);

	$(".btn_tracking span").html("SONDEANDO INFRAESTRUCTURA DE RED...");
	$.ajax({
	    url: "php/Tracking.php",
	    success: function(data){
	    	$(".here_write").html(data);
			$(".btn_tracking span").html("SONDEAR INFRAESTRUCTURA DE RED");
			
			$("#ClickSondeoFinal").click();

			clearInterval(myVar);

			// draw();
	    	// setTimeout(function(){
	    	// 	$("#SondeoModal").click();
	    	// }, 200);
	    }
	});
}

function LoadNetworkMap(){
	$.ajax({
	    url: "network/nodeStyles/return.php",
	    success: function(data){
	    	$(".here_write").html(data);
			// $(".btn_tracking span").html("SONDEAR INFRAESTRUCTURA DE RED");
			
			$("#ClickSondeoFinal").click();

			// clearInterval(myVar);

			// draw();
	    	// setTimeout(function(){
	    	// 	$("#SondeoModal").click();
	    	// }, 200);
	    }
	});
}