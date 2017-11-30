<?php
	class View {
		function __construct($view, $data = null){
			if (file_exists("./views/".$view)){
				include ("./views/".$view);
			} else {
				die("Web site (view), not found (404)");
			}
		}
	}
?>