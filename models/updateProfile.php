<?php
	require_once '../connections/connection.php';
	$dbConnection = (new Conn())->connect();
	$name ="";
	$email = "";
	$phone = "";
	$country = "";
	$id;
	
	if (isset($_GET['id'])) $id = $_GET['id'];
	$query = "UPDATE `users` SET 
		fullname = `$name`,
		email = `$email`,
		phone = $phone,
		country = $country
	  	WHERE id = `$id` LIMIT 1";

	echo ($dbConnection->query($query)) ? "Record Updates successfully": "No result found";
	$dbConnection->close();
?>