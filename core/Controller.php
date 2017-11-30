<?php
	class Controller {

		function __construct(){

			if ($_REQUEST && isset($_REQUEST['action'])){
				$action = $_REQUEST['action'];

				if (method_exists($this, $action))
					$this->$action();
				else
					echo "Error 404, Not found.";
			} else {
				if (method_exists($this, "index"))
					$this->index();
				else
					echo "Index not defined!";
			}
		}
	}
?>