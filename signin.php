<?php
	require_once '../connections/connection.php';
	$dbConnection = (new Conn())->connect();
	$email = "";
	$password = "";

	$query = "SELECT * FROM `users` WHERE `email` = `$email` and `password` =`$password` LIMIT";
	$result = $dbConnection->query($query);

	if ($result->num_rows === 1){
		$_SESSION['online'] = true;
		header("Location: index.php");
		
		// closes php tag for localstorage storage and open on the other end 
		?>	<script> localStorage.setItem('online_status', true) </script> <?php
		echo $rows;	
	} 
	echo ($dbConnection->query($query)) ? "Registeration successful" : "Error $dbConnection->error" ;

	$dbConnection->close()
?>