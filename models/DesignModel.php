<?php
	class DesignModel extends Model {
		public function getContacts(){
			$result = $this->db->query("SELECT * FROM contacts;");

			return $result->fetchAll();
		}
	}
?>