<?php
	// admin create new product
	require_once '../connections/connection.php';
	$dbConnection = (new Conn())->connect();
	$title = "";
	$genre = "";
	$cover = "";
	$price = "";
	$description = "";
	$message; 
	
	$query = "INSERT INTO `movies` (`title`, `genre`, `cover`,`price`, 'description') VALUES ($title, $genre, $cover, $description)";
	$message = ($dbConnection->query($query)) ? "Movie created successfully" : "Error $dbConnection->error" ;

	$dbConnection->close()
?>