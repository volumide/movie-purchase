<?php
	require_once '../connections/connection.php';
	$dbConnection = (new Conn())->connect();

	$query = "SELECT * FROM `users`";
	$result = $dbConnection->query($query);
	if ($result->num_rows > 0) while ($rows = $result->fetch_array()) echo $rows;	
	else echo "Not result found";

	$dbConnection->close();
?>