<?php
	require_once '../connections/connection.php';
	$dbConnection = (new Conn())->connect();

	$responses = [];
	$query = "SELECT * FROM `genre` WHERE `genre` = 'action'";
	
	$result = $dbConnection->query($query);
	if ($result->num_rows > 0) while ($rows = $result->fetch_assoc()) array_push($responses, $rows);
		foreach ($responses as $response) {
			echo $response['title'] . " ".  $response['genre'] ."<br>";
		}
?>