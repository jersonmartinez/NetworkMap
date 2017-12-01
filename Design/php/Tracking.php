<h3 ondblclick="javascript: CloseModal();">Rastreo de Hosts</h3>
<div>
	<p>Se realiza una búsqueda de nodos en todos los adaptadores disponibles</p>
	<table ondblclick="javascript: CloseModal();" style="width: 100%;">
		<tr>
			<td style="width: 100%; padding: 10px;"><b>Hosts encontrados</b></td>
		</tr>

		<?php
			include ("ssh.class.php");
			$CN = new ConnectSSH();
			
			echo "Dato: ".$CN->Tracking();
		?>

		<tr>
			<td style="width: 100%; padding: 10px;"><b>Hosts encontrados</b></td>
		</tr>
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