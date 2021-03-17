<?php
	require_once '../connections/connection.php';
	$dbConnection = (new Conn())->connect();
	
	$message;
	$oldPassword = "";
	$newPassword = "";
	$confirmPassword = "";
	if (!isset($_GET['id'])) {
		echo "unable to perfom the operation";
		return;
	}
	$id = $_GET['id'];
	$verify = "";
	
	$query = "SELECT `password` FROM `users` WHERE id = $id LIMIT 1";
	$result = $dbConnection->query($query);
	
	if($result->num_rows > 0){
		$row = $result->fetch_assoc();
		$verify = password_verify($password, $row['password']);
	}

	if (!$verify){
		$message = "Your password does not match";
		return;
	}

	if ($newPassword !== $confirmPassword) {
		$message = "Password does not match";
		return;
	}

	$newPassword = password_hash($newPassword, PASSWORD_BCRYPT);
	$query = "UPDATE `movies` SET `password` =  `$newPassword` WHERE id = `$id`";
	$message =  ($this->dbConnection->query($query)) ? "Record Updated successfully": "No result found";
?>