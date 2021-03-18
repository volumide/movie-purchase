<?php
	session_start();
	require_once '../connections/connection.php';
	if ($_SESSION['id']) header('Location: ../');

	$dbConnection = (new Conn())->connect();
	
	$email = $_POST['email'];
	$password = $_POST['password'];

	$query = "SELECT * FROM `users` WHERE `email` = '$email' LIMIT 1";
	$result = $dbConnection->query($query);

	if($result->num_rows > 0){
		$row = $result->fetch_assoc();
		$verify = password_verify($password, $row['password']);
		if (!$verify) {
			echo "Invalid password";
			return;
		}

		$_SESSION['id'] = $row['id'];
		$_SESSION['name'] = $row['fullname'];
		$_SESSION['status'] = $row['is_admin'];
		echo "successful";
		sleep(5);
		header("Location: ../");
		exit();
	} else echo "email not found in our database"; 

	$dbConnection->close()
?>