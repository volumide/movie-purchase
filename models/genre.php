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

		public function getGenre(){
			$query = "SELECT * FROM `genre`";
			if ($this->id && $this->id !== "") $query .= "WHERE `id` = {$this->id}";

			$result = $this->dbConnection->query($query);
			
			if ($result->num_rows > 0) while ($rows = $result->fetch_assoc()) array_push($this->results, $rows);
			else $this->results = "Not result found";

			return $this->results;
		}

		public function deleteGenre(){
			$query = "DELETE FROM `genre` WHERE id = `$this->id`";
			// return result based on query
			return ($this->dbConnection->query($query)) ? "Record Updates successfully": "Not result found";
		}

		public function updateGenre(){
			$query = "UPDATE `genre` SET title = `$this->genreTitle` WHERE id = `$this->id`";
			// return result by id based on query
			return ($this->dbConnection->query($query)) ? "Record Updated successfully": "No result found";
		}
	}

?>