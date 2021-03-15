<?php
	require_once '../connections/connection.php';
	$dbConnection = (new Conn())->connect();
	
	$title = "";
	$genre = "";
	$cover = "";
	$price = "";
	$description = "";
	
	if (!isset($_GET['id'])) {
		echo "unable to perfom the operation";
		return;
	}

	$id = $_GET['id'];
	$query = "UPDATE `movies` SET 
		`title` = `$title`,
		`genre` = $genre,
		`conver` = $cover,
		`price` = $price,
		`description` = $description
	WHERE id = `$this->id`";
	// return result by id based on query
	return ($this->dbConnection->query($query)) ? "Record Updated successfully": "No result found";
?>