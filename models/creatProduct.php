<?php
	// admin create new product
	require_once '../connections/connection.php';
	$dbConnection = (new Conn())->connect();
	$title = "";
	$genre = "";
	$cover = "";
	$description = "";

	$query = "INSERT INTO `movies` (`title`, `genre`, `cover`, 'description') VALUES ($title, $genre, $cover, $description)";
	echo ($dbConnection->query($query)) ? "Movie created successfully" : "Error $dbConnection->error" ;

	$dbConnection->close()
?>