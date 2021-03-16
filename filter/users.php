<?php
	require_once '../connections/connection.php';
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
?>