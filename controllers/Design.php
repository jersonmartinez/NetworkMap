<?php
	class Contacts extends Controller {

		function __construct(){
			parent::__construct();
		}

		public function index(){

			$Loader = new LoadModel("ContactsModel");

			$Contacts = new ContactsModel();
			$ListContacts = $Contacts->getContacts();

			(new View("Contacts/index.php", compact("ListContacts")));
		}
	}
?>