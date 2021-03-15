<?php  
	class Products{
		private $dbConnection ;
		private $id;
		private $results = [];
		public $genreTitle;

		public function __construct($dbConnection, $id = null) {
			$this->dbConnection = $dbConnection;
			$this->id = $id;
		}

		public function getAllAdmin(){
			$query = "SELECT `admin.id`, * FROM `admin` LEFT JOIN `users` ON  `admin.user_id` = `users.id`";
			if ($this->id && $this->id !== "") $query .= "WHERE `id` = {$this->id}";

			$result = $this->dbConnection->query($query);
			
			if ($result->num_rows > 0) while ($rows = $result->fetch_assoc()) array_push($this->results, $rows);
			else $this->results = "Not result found";

			return $this->results;
		}

		public function deleteAdmin($user_id){
			$query = "DELETE FROM `admin` WHERE id = `$user_id`";
			if($this->dbConnection->query($query)){
				$query = "UPDATE `users` SET `is_admin` = 'no'";
				return $this->dbConnection->query($query) ? "Record Updates successfully": "Not result found";
			} 
			else return "Not result found";
		}

		// function to make a normal user an admin
		public function UpdateAdmin(){
			$query = "UPDATE `genre` SET title = `$this->genreTitle` WHERE id = `$this->id`";
			// return result by id based on query
			return ($this->dbConnection->query($query)) ? "Record Updated successfully": "No result found";
		}
	}

?>