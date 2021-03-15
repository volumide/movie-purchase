<?php
	// admin create new product
	require_once '../connections/connection.php';
	$dbConnection = (new Conn())->connect();
	$title = "";

	$query = "INSERT INTO `movies` (`title`) VALUES ($title)";
	echo ($dbConnection->query($query)) ? "genre created successfully" : "Error $dbConnection->error" ;

	$dbConnection->close()
?>