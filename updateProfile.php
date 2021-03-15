<?php
	require_once '../connections/connection.php';
	$dbConnection = (new Conn())->connect();
	$name ="";
	$email = "";
	$phone = "";
	$id;
	
	if (isset($_GET['id'])) $id = $_GET['id'];
	$query = "UPDATE `users` SET 
		fullname = `$name`,
		email = `$email`,
		phone = $phone,
	  	WHERE id = `$id` LIMIT 1";

	echo ($dbConnection->query($query)) ? "Record Update successfully": "Not result found";
	$dbConnection->close();
?>