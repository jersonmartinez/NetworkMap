<?php

class Model {
	public $db = null;

	function __construct(){

		$this->db = 1;

		// try {
		// 	$this->db = $this->getConnection();
		// } catch (PDOException $e) {
		//     die("Falló la conexión: ".$e->getMessage());
		// }
	}
}