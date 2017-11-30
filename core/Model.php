<?php

class Model {
	public $db = null;

	function __construct(){

		$this->db = $this->getConnection();

		// try {
		// 	$this->db = $this->getConnection();
		// } catch (PDOException $e) {
		//     die("Falló la conexión: ".$e->getMessage());
		// }
	}

	public function getConnection(){
		$host = "127.0.0.1";
		$user = "root";
		$pass = "root";
		$database = "monitorizador";
		$charset = "utf8";

		return (new mysqli($host, $user, $pass, $database));

		// $dsn = "mysql:dbname={$database};host={$host};charset={$charset}";
		
		// $opt = [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];
		// return (new PDO($dsn, $user, $pass, $opt));
	}

}