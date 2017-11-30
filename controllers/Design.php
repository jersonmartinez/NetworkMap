<?php
	class Design extends Controller {

		function __construct(){
			parent::__construct();
		}

		public function index(){

			$Loader = new LoadModel("DesignModel");

			$Return = new DesignModel();
			// $LstReturn = $Return->getContacts();

			(new View("Design/index.php", compact("LstReturn")));
		}

		public function networkmap(){

			$Loader = new LoadModel("DesignModel");

			$Return = new DesignModel();
			$LstReturn = $Return->getContacts();

			(new View("Design/networkmap.php", compact("LstReturn")));
		}

	}
?>