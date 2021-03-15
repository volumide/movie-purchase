<?php
	require_once '../connections/connection.php';
	$dbConnection = (new Conn())->connect();
	$message;
	// for admin 
	$query = "SELECT * FROM `users`";
	$result = $dbConnection->query($query);
	if ($result->num_rows > 0) while ($rows = $result->fetch_assoc()) echo $rows;	
	else $message = "Not result found";

	$dbConnection->close();
?>