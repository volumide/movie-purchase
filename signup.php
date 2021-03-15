<?php
	require_once '../connections/connection.php';
	$dbConnection = (new Conn())->connect();

	$name ="";
	$email = "";
	$password = "";
	$phone = "";
	$gender = "";
	$dateOfBirth = "";
	$confirmPassword = "";

	$query = "INSERT into `users` 
		(`fullname`, `email`, `password`, `phone`, `gender`, `dob`) VALUES 
		($name, $email, $password, $phone, $gender, $dateOfBirth)";
	echo ($dbConnection->query($query)) ? "Registeration successful" : "Error $dbConnection->error" ;

	$dbConnection->close()
?>