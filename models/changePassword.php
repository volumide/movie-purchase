<?php
	require_once '../connections/connection.php';
	$dbConnection = (new Conn())->connect();
	
	$oldPassword = "";
	$newPassword = "";
	$confirmPassword = "";
	if (!isset($_GET['id'])) {
		echo "unable to perfom the operation";
		return;
	}

	$query = "SELECT `password` FROM `users` WHERE id = $id LIMIT 1";
	$result = $dbConnection->query($query);

	if($result->num_rows < 1) throw new Exception("Error Processing Request", 1);
	$password = $result;

	if ($password !== $oldPassword){
		echo "Your password does not match";
		return;
	}

	$id = $_GET['id'];
	if ($newPassword !== $confirmPassword) {
		echo "Password does not match";
		return;
	}

	$query = "UPDATE `movies` SET 
		`password` = `$newPassword`,
	WHERE id = `$id`";
	// return result by id based on query
	return ($this->dbConnection->query($query)) ? "Record Updated successfully": "No result found";
?>