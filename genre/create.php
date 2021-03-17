<?php
	session_start();
	require_once '../connections/connection.php';
	require_once '../models/isadmin.php';

	if (getSession($_SESSION['status']) === 'eligible'){
		header("Location: ../");
		exit();
	}
	// error_reporting(0);
	$dbConnection = (new Conn())->connect();
	if (isset($_POST['title'])) {
		$title = $_POST['title'];
		$message;
		$query = "INSERT INTO `genre` (`name`) VALUES ('$title')";
		$message = ($dbConnection->query($query)) ? "$title genre created successfully" : "Error $dbConnection->error";
		echo $message;	
	}
?>

<form action="" method="POST">
	<div>
		<label for="title">Genre Title</label>
		<input type="text" name="title" id="title">
	</div>

	<button type="submit">Create</button>
</form>

<?php $dbConnection->close() ?>