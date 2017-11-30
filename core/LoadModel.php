<?php
	class LoadModel {
		function __construct($model){
			include ("./models/".$model.".php");
		}
	}
?>