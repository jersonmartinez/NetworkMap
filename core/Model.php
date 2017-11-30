<?php

class Model {
	public $db = null;

	function __construct(){
		try {
			$this->db = $this->getConnection();
		} catch (PDOException $e) {
		    die("Falló la conexión: ".$e->getMessage());
		}
	}

	public function getConnection(){
		$host = "127.0.0.1";
		$user = "SideMaster";
		$pass = "Inform@tico";
		$database = "mvc";
		$charset = "utf8";

		$dsn = "mysql:dbname={$database};host={$host};charset={$charset}";
		
		$opt = [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];
		return (new PDO($dsn, $user, $pass, $opt));
	}

}