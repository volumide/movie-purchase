<?php
	// error_reporting(0);
	require '../connections/connection.php';
	$dbConnection = (new Conn())->connect();
	
	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$country = $_POST['country'];
	$isAdmin = (isset($_GET['admin']) && isset($_GET['admin']) === 'admin') ? "yes" : "no";
	$phone = $_POST['phone'];
	$gender = $_POST['gender'];
	$dateOfBirth = $_POST['dob'];
	$confirmPassword = $_POST['cpassword'];
	$secretKey = rand(000, 999) . "$name" . rand(0000, 9999);
	$last_id;
	$message;

	if (!$name || !$email ||!$country || !$phone || !$gender || !$password || !$dateOfBirth ) {
		echo"All fields are required";
		return;
	}
	if ($password !== $confirmPassword) {
		echo"Password not match";
		return;
	}
	// echo "$name $email $country $phone $gender $dateOfBirth $secretKey $password $confirmPassword";
	$query = "INSERT INTO `users` (`fullname`, `email`, `password`, `phone`, `gender`, `dob`, `is_admin`,`country`) VALUES ('$name', '$email', '$password', '$phone', '$gender', '$dateOfBirth', '$isAdmin', '$country')";
	if ($dbConnection->query($query)){
		$last_id = $dbConnection->insert_id;
		if ($isAdmin === "yes") {
			$query = "INSERT INTO `admin` (`user_id`, `key`) VALUES ($last_id, $secretKey)";
			$message = ($dbConnection->query($query)) ? "You are now an admin" : "Error $dbConnection->error";
		} else echo "registeration successfull";
	}else  echo"Error $dbConnection->error";

	$dbConnection->close();
