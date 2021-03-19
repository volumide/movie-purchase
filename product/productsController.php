<?php  
	class Products{
		protected $dbConnection ;
		private $id;
		private $results = [];

		public function __construct($dbConnection, $id = null) {
			$this->dbConnection = $dbConnection;
			$this->id = $id;
		}

		public function productQUery(){
			$query = "SELECT genre.*, movies.* FROM `movies` LEFT JOIN genre ON  genre.id =  movies.genre_id";
			// if ($this->id && $this->id !== "") $query .= "WHERE id = '{$this->id}'";

			$result = $this->dbConnection->query($query) or die($this->dbConnection->error);
			while ($rows = $result->fetch_assoc()) array_push($this->results, $rows);	
			if ($this->id) {
				echo $this->id;
				foreach ($this->results as $result) 
					if ($result['id'] === $this->id){
						// var_dump($result);
						// echo $result;
						return $result;
					} 
					return "no mtach". $this->dbConnection->error;
			}
			// else $this->results = "Not result found";
			return $this->results;
		}

		public function deleteProduct($id){
			$query = "DELETE FROM `movies` WHERE id = '$id'";
			// return result based on query
			return ($this->dbConnection->query($query)) ? "Record Deleted successfully": "Not result found ".$this->dbConnection->error;
		}

		public function productEndWithS(){
			$query = "SELECT * FROM `movies` WHERE substr(`title`, -1) = 's'";

			$result = $this->dbConnection->query($query);
			if ($result->num_rows > 0) while ($rows = $result->fetch_assoc()) array_push($this->results, $rows);	
			else $this->results = "Not result found";
			return $this->results;

		}
	}

?>