<?php  
	class Products{
		protected $dbConnection ;
		private $id;
		public $results = [];

		public function __construct($dbConnection, $id = null) {
			$this->dbConnection = $dbConnection;
			$this->id = $id;
		}

		public function productQUery(){
			$query = "SELECT * FROM `movies`";
			if ($this->id && $this->id !== "") $query .= "WHERE `id` = {$this->id}";

			$result = $this->dbConnection->query($query);
			if ($result->num_rows > 0) while ($rows = $result->fetch_assoc()) array_push($this->results, $rows);	
			else $this->return = "Not result found";
			return $this->return;
		}
	}

?>