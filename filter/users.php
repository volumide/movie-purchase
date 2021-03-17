<?php
	session_start();
	require_once '../connections/connection.php';
	require_once '../models/isadmin.php';

	$authenticate = getSession($_SESSION['status']);
	if ($authenticate === 'not eligible'){
		header("Location: ../");
		exit();
	}

	$dbConnection = (new Conn())->connect();
	$responses = [];
	$ageFilter = [];
	$query = "SELECT * FROM `users`";
	
	$result = $dbConnection->query($query);
	if ($result->num_rows > 0) while ($rows = $result->fetch_assoc()) array_push($responses, $rows);


	if (isset($_POST['age'])) {
		$ageAbove50 = $_POST['age'];
		foreach ($responses as $response) {
			$currentDate = new DateTime(strval(date('Y-m-d')));
			$userYear = new DateTime($response['dob']);
			$ageDiff = ($userYear->diff($currentDate))->format('%Y');
			if ($ageDiff > 50) {
				array_push($ageFilter, $response);
			}
		}
		foreach ($ageFilter as$user) {
			echo '$user["fullname"]';
		}
		return;
	}

	// total number of film purchase by customer
	foreach ($responses as $response) {
		$id = $response['id'];
		$query = "SELECT * FROM `purchases` WHERE `user_id` = '$id'";
		$result = $dbConnection->query($query);
		if ($result->num_rows > 0){
			$count = 0;
			while ($rows = $result->fetch_assoc()){
				$count+= 1;
			}
			echo $response['fullname'] ." ". $count . "<br>";
		}else echo $response['fullname']. "  ". 0  . "<br>";
	}
	
		// $query = "SELECT users.* , purchases.* FROM  `users` LEFT JOIN purchases ON  users.id = purchases.user_id ";
		// $allResult = [];
		// $inPurcahse =[];

		// $result = $dbConnection->query($query) or die($dbConnection->error);
		// while ($rows = $result->fetch_assoc()) array_push($allResult, $rows);

		// foreach ($allResult as $value) 
		// if ($value['id']) array_push($inPurcahse, $value['fullname']);
		
		// $count = array_count_values($inPurcahse);
		// var_dump($count);

		
		// echo "<br>". json_encode($allResult);
		

?>