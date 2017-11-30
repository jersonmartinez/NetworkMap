<?php
	class Users extends Controller {

		function __construct(){
			parent::__construct();
		}

		public function index(){
			
			$Loader = new LoadModel("UsersModel");

			$Users = new UsersModel();
			$ListUsers = $Users->getUsers();

			(new View("Users/index.php", compact("ListUsers")));

		}

		public function getUsers(){
			$ArrayUsers = array("José", "Pedro", "Santiago", "Jerson");
			(new View("Users/UserList.php", $ArrayUsers));
		}

	}
?>