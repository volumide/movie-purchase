<?php
	require_once '../connections/connection.php';
	$dbConnection = (new Conn())->connect();

	$name ="";
	$email = "";
	$password = "";
	$country = "";
	$isAdmin = (isset($_GET['admin']) && isset($_GET['admin']) === 'admin') ? "yes" : "no";
	$phone = "";
	$gender = "";
	$dateOfBirth = "";
	$confirmPassword = "";
	$last_id;

	$query = "INSERT INTO `users` 
		(`fullname`, `email`, `password`, `phone`, `gender`, `dob`, `is_admin`) VALUES 
		($name, $email, $password, $phone, $gender, $dateOfBirth, $isAdmin)";
	($dbConnection->query($query)) ? $last_id = $dbConnection->insert_id : "Error $dbConnection->error" ;
	if ($isAdmin === "yes") {
		$query = "INSERT INTO `admin` (`user_id`) VALUES ($last_id)";
		echo ($dbConnection->query($query)) ? "You are now an admin" : "Error $dbConnection->error";
	}
	else echo "registeration successfull";

	$dbConnection->close()
?>