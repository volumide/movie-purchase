<?php
	session_start();
	require_once '../connections/connection.php';
	require_once '../models/isadmin.php';

	$authenticate = getSession($_SESSION['status']);
	if ($authenticate !== 'not eligible'){
		header("Location: ../");
		exit();
	}
	require  '../admin/header.php';
	echo "<div>";
?>
	<form action="" method="POST">
		<h1>Filter age greater than 50 </h1>
		<button name="age" type="submit" >Filter</button>
	</form>

<?php

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
			// echo $response['dob'];
			// return;
			$userYear = new DateTime((strval($response['dob'])));
			$ageDiff = ($userYear->diff($currentDate))->format('%Y');
			// echo $ageDiff;
			// return;
			if ($ageDiff > 50) {
				array_push($ageFilter, $response);
			}
		}
		foreach ($ageFilter as$user) {
			echo $user["fullname"];
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
			if ($count > 0) {
				?>
					<p> <?php echo $response['fullname'] ."<br> No of film purchased : $count" ;  ?> </p>
				<?php
			}
				
		}
	}
?>