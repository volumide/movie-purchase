<?php  
	class Conn{
		private string $port = 'localhost';
		private string $username = 'root';
		private string $password = '';
		private string $db = 'moviedb';

		public function connect(){
			$con = new mysqli($this->port, $this->username, $this->password, $this->db);
			if ($con->connect_error) die("connection fail". $con->connect_error);
			return $con;
		}
	}
?>