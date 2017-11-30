<?php
	class UsersModel extends Model {
		public function getUsers(){
			return $this->db->query("SELECT * FROM users;")->fetchAll();
		}
	}
?>