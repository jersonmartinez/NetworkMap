var myVar = 0;

function StartTracking(){
	myVar = setInterval(function(){ LoadNetworkMap() }, 2000);

	// setInterval(LoadNetworkMap, 3000);


	$(".btn_tracking span").html("SONDEANDO...");
	$(".network_map_loader").fadeIn(500).show();
	$.ajax({
	    url: "php/Tracking.php",
	    success: function(data){
	    	$(".here_write").html(data);
			$(".btn_tracking span").fadeIn(500).html("SONDEAR INFRAESTRUCTURA DE RED");
			
			$("#ClickSondeoFinal").click();
			$(".network_map_loader").fadeOut("slow");
			clearInterval(myVar);

			$("#retardo_temporal").fadeIn(500).html($("#input_retardo").val());

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