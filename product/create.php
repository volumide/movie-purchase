<?php
	session_start();
	// admin create new product
	require_once '../connections/connection.php';
	require_once '../models/isadmin.php';

	$authenticate = getSession($_SESSION['status']);
	if ($authenticate === 'not eligible'){
		header("Location: ../");
		exit();
	}

	// error_reporting(0);
	$dbConnection = (new Conn())->connect();
	if (isset($_POST['submit'])) {
		$title = $_POST['title'];
		$genre = $_POST['genre'];
		$price = $_POST['price'];
		$description = $_POST['desc'];
		$dir = 'covers/';
		$tempName = "";
		$error = [];
		$message;

		if ($_POST['cover']){
			$cover = $_FILES['cover']['name'];
			$tempName = $_FILES['cover']['tmp_name'];
			$fileType = strtolower(pathinfo(basename($dir .$cover),PATHINFO_EXTENSION));
			if (!getimagesize($tempName)) array_push($error, "file is not an image type"); 
			if (!$fileType != "jpg" || !$fileType != "jpeg" || !$fileType != "png") array_push($error, "Only JPEG PNG and JPG file are accepted" );
			if (($_FILES['cover']['size']) > 20000) array_push($error, "file size is too large");
		}
		
		if (count($error) > 0) {
			foreach ($error as $value) {
				echo $value;
				return;
			}
		}

		$query = "INSERT INTO `movies` (`title`, `genre`, `cover`,`price`, `description`) VALUES ('$title', '$genre', '$cover', '$price', '$description')";
	
		if ($dbConnection->query($query) && move_uploaded_file($tempName, $dir))$message = "Movie created successfully";
		else $message = "Error $dbConnection->error";
	
		echo $message;
	}
	$dbConnection->close()
?>

<form action="" method="POST">
	<div>
		<label for="title">Film Title</label>
		<input type="text" name="title" id="title">
	</div>
	<div>
		<label for="genre">Genre</label>
		<input type="genre" name="genre" id="genre">
	</div>
	<div>
		<label for="cover">cover</label>
		<input type="text" name="cover" id="cover">
	</div>
	<div>
		<label for="price">Price</label>
		<input type="number" name="price" id="price">
	</div>
	<div>
		<label for="desc">Brief description</label>
		<textarea name="desc" id="desc"></textarea>
	</div>
	<button type="submit" name="submit">Add movie</button>
</form>