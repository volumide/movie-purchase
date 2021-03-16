<?php
	// admin create new genre
	require_once '../connections/connection.php';
	$dbConnection = (new Conn())->connect();
	$title = "";
	$message;
	$query = "INSERT INTO `genre` (`title`) VALUES ($title)";
	$message = ($dbConnection->query($query)) ? "genre created successfully" : "Error $dbConnection->error" ;

	$dbConnection->close()
?>