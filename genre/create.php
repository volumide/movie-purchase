<?php
	require_once '../connections/connection.php';
	
	$dbConnection = (new Conn())->connect();
	$title = "";
	$message;
	$query = "INSERT INTO `genre` (`title`) VALUES ($title)";
	$message = ($dbConnection->query($query)) ? "genre created successfully" : "Error $dbConnection->error";
	echo $message;

	$dbConnection->close()
?>

<form action="" method="POST">
	<div>
		<label for="title">Genre Title</label>
		<input type="text" name="title" id="title">
	</div>

	<button type="submit">Create</button>
</form>