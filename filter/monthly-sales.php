<?php
	session_start();
	require_once '../connections/connection.php';
	require_once '../models/isadmin.php';

	if (!$_SESSION) header("Location: ../");

	if (getSession($_SESSION['status']) !== 'eligible'){
		header("Location: ../");
		exit();
	}
	require  '../admin/header.php';
	$dbConnection = (new Conn())->connect();
	$responses = [];
	$dateCategory = [];

	$query = "SELECT   purchases.* ,users.* FROM `users` LEFT JOIN purchases ON users.id = purchases.user_id" ;
	
	$result = $dbConnection->query($query) or die($dbConnection->error);
	?> 
		<div class="flex flex-col items-center w-full ">
		<h1 class="py-5 text-3xl font-semibold">Monthly sales</h1> 
		<div class=" w-1/3 px-6" >
	<?php
	while ($rows = $result->fetch_assoc()) array_push($responses, $rows);
	
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
	foreach ($uniqCategory as $key => $value) {
		?>
			<div>
				<p class="text-2xl font-semibold text-blue-800"><?php echo $value; ?></p>
				<p class="py-3 px-3 rounded bg-blue-800 w-1/2 text-white text-2xl mb-3">Total sales : <?php echo count($makeDateKey[$value]); ?></p>
			</div>
		<?php

		foreach($makeDateKey[$value] as $monthlySales){
			?> 
				<div class="flex border-b-2">
					<p class="text-lg p-3 font-semibold flex-auto"> <?php echo $monthlySales['fullname'] ; ?></p>  
					<p class="p-3 font-semibold"> <?php echo  $monthlySales['product']; ?></p>
				</div>
			<?php
		}
	}
?>
		</div>
		</div>