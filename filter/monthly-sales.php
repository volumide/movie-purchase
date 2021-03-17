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
	$authenticate = getSession($_SESSION['status']);
	$responses = [];
	$dateCategory = [];
	// $finalResult = [];
	$query = "SELECT * FROM `purchases`";
	
	$result = $dbConnection->query($query);

	if ($result->num_rows > 0) while ($rows = $result->fetch_assoc()) array_push($responses, $rows);


	// collect all dates on database
	foreach ($responses as $response) array_push($dateCategory, substr($response['purchase_date'], 0, -3));
	
	// remove duplicate values from date array
	$uniqCategory = array_unique($dateCategory);

	/*
		make a key value array from simplified array from field based on product days
		[
			"21-10-16" => [],
			"21-10-17" => [],
			"21-10-18" => [],
		]
	*/
	$makeDateKey = array_fill_keys($uniqCategory, []);

	// push all values to there corresponding purchased fate to calculate number of sales per day
	foreach($uniqCategory as $cat)
		foreach($responses as $response)
			if(substr($response['purchase_date'], 0, -3) === $cat) array_push($makeDateKey[$cat], $response);
		
	var_dump($uniqCategory);
	var_dump($makeDateKey);
?>