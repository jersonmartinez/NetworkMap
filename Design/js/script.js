function StartTracking(){
	$(".btn_tracking span").html("SONDEANDO INFRAESTRUCTURA DE RED...");
	$.ajax({
	    url: "php/Tracking.php",
	    success: function(data){
	    	$(".here_write").html(data);
			$(".btn_tracking span").html("SONDEAR INFRAESTRUCTURA DE RED");
			
			$("#ClickSondeoFinal").click();

			// draw();
	    	// setTimeout(function(){
	    	// 	$("#SondeoModal").click();
	    	// }, 200);
	    }
	});
}