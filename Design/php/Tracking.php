<h3 ondblclick="javascript: CloseModal();">Rastreo de Hosts</h3>
<div>
	<p>Se realiza una búsqueda de nodos en todos los adaptadores disponibles</p>
	<table ondblclick="javascript: CloseModal();" style="width: 100%;">
		<!-- <tr>
			<td style="width: 100%; padding: 10px;"><b>Hosts encontrados</b></td>
		</tr> -->

		<?php
			include ("ssh.class.php");
			$CN = new ConnectSSH();

			// echo "Aplicando limpieza...".$CN->InitTables()."<br/>";
			
			$time_start = microtime(true);

			$CN->SpaceTest();

			$time_end = microtime(true);
			$time = $time_end - $time_start;


			echo "<br/><br/> <b>Retardo:</b> ".number_format($time, 2, '.', '')." segundos\n";



			// // Dormir por un momento
			// usleep(100);



			// echo "IP de red Local: ".$CN->getIpRouteLocal()."<br/>";

			// $IP = "192.168.100.1";

			// if ($CN->IsRouter($IP)){
			// 	echo "<br/>Es un enrutador<br/>";
			// } else {
			// 	echo "<br/>Es un host<br/>";
			// }

			// echo "IP es esta: ".$CN->getIpRouteRemote($IP);
			


			// echo "IP es: ".$CN->getIpRouteLocal();
			// list ($AHost, $ANetwork) = $CN->Tracking();

			// print_r($AHost);
			// print_r($ANetwork);

		?>

		<!-- <tr>
			<td style="width: 100%; padding: 10px;"><b>Hosts encontrados</b></td>
		</tr> -->
	</table>
	<br>
</div>

<style>
	.show_elements {
	  padding: 10px; background-color: rgba(0,0,0,.1);
	}
	.show_elements:hover {
	  cursor: pointer;
	  background-color: rgba(0,0,0,.2);
	}
</style>