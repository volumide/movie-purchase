<?php
	require_once '../connections/connection.php';
	$dbConnection = (new Conn())->connect();
	
	$title = "";
	$genre = "";
	$cover = "";
	$price = "";
	$description = "";
	$message;
	
	if (!isset($_GET['id'])) {
		$message = "unable to perfom the operation";
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
	$message = ($this->dbConnection->query($query)) ? "Record Updated successfully": "No result found";
?>