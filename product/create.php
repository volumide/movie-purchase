<?php
// admin create new product
	require_once '../connections/connection.php';
	error_reporting(0);
	$dbConnection = (new Conn())->connect();
	$title = $_POST['title'];
	$genre = $_POST['genre'];
	$cover = $_POST['cover'];
	$price = $_POST['price'];
	$description = $_POST['desc'];
	$message;

	$query = "INSERT INTO `movies` (`title`, `genre`, `cover`,`price`, `description`) VALUES ('$title', '$genre', '$cover', '$price', '$description')";

	if ($dbConnection->query($query)) $message = "Movie created successfully";
	else $message = "Error $dbConnection->error";

	echo $message;
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
	<button type="submit">Add movie</button>
</form>