<?php
	include ("./core/Controller.php");
	include ("./core/Config.php");
	include ("./core/View.php");
	include ("./core/Model.php");
	include ("./core/LoadModel.php");

	if ($_GET && isset($_GET['controller']))
		$default_controller = $_GET['controller'];

	if (file_exists("controllers/".$default_controller.".php"))
		include ("controllers/".$default_controller.".php");
	else
		die("Controlador no encontrado!");

	(new $default_controller());
?>