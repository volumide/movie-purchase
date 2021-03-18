<?php
	session_start();
	require_once '../connections/connection.php';
	require_once '../models/isadmin.php';


	if (getSession($_SESSION['status']) !== 'not eligible'){
		header("Location: ../");
		exit();
	}

	$dbConnection = (new Conn())->connect();
	$responses = [];
	$dateCategory = [];
	// $finalResult = [];
	$query = "SELECT   purchases.* ,users.* FROM `users` LEFT JOIN purchases ON users.id = purchases.user_id" ;
	
	$result = $dbConnection->query($query) or die($dbConnection->error);

	while ($rows = $result->fetch_assoc()) array_push($responses, $rows);
	
	// var_dump($responses)
	// echo json_encode(($responses));
	// echo "<br> ". count($responses);
	// return;
	// collect all dates on database
	foreach ($responses as $response){
		if ($response['purchase_date']) array_push($dateCategory, substr($response['purchase_date'], 0, -3));
	} 

	
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
	
	// push all values to there corresponding purchases to calculate number of sales per day
	foreach($uniqCategory as $cat)
		foreach($responses as $response){
			if(substr($response['purchase_date'], 0, -3) === $cat) array_push($makeDateKey[$cat], $response);
		}
	
		// echo count($makeDateKey['2021-03']);
	echo "<h1> Monthly sales </h1>";
	foreach ($uniqCategory as $key => $value) {
		?>
			<p><?php echo $value; ?></p>
			<p>Total monthly sales : <?php echo count($makeDateKey[$value]); ?></p>
		<?php

		foreach($makeDateKey[$value] as $monthlySales){
			?> 
				<p> <?php echo $monthlySales['product'] ." -> ". $monthlySales['fullname']; ?></p>  
			<?php
		}
	}
?>