<?php
	session_start();
	require_once '../connections/connection.php';
	require_once './productsController.php';
	$authenticate = getSession($_SESSION['status']);
	if ($authenticate === 'not eligible') {
		echo $authenticate;
		sleep(5);
		header("Location: ../");
		return;
	}


	$dbConnection = (new Conn())->connect();
	if (!isset($_GET['id'])) {
		$message = "unable to perfom the operation";
		return;
	}

	$product;
	$id = $_GET['id'];

	// check if form values are set and ready for query
	if (isset($_POST['title']) || isset($_POST['genre']) || isset($_POST['cover']) || isset($_POST['desc']) ||isset($_POST['price'])) {
		$title = $_POST['title'];
		$genre = $_POST['genre'];
		$cover = $_POST['cover'];
		$price = $_POST['price'];
		$description = $_POST['desc'];
		if (intval($price)) {
			$query = "UPDATE `movies` SET 
				`title` = '$title',
				`genre` = '$genre',
				`cover` = '$cover',
				`price` = '$price',
				`description` = '$description'
			WHERE `id` = '$id'";
	
			$result = $dbConnection->query($query);
	
			if ($result) $message = "Record Updated successfully" ;
			else $message = "No result found $dbConnection->error";
		}else $message = "price must be an interger";
	
		echo $message;
	}

	// get data value from database
	$products = (new Products($dbConnection, $_GET['id']))->productQUery();
	if (is_array($products)) {
		$product = $products[0];
		?>
			<!-- form for updating the product -->
			<form action=""  method="POST">
				<div>
					<label for="title">Film Title</label>
					<input type="text" name="title" id="title" value="<?php echo trim($product['title'], " ");?>">
				</div>
				<div>
					<label for="genre">Genre</label>
					<input type="genre" name="genre" id="genre" value="<?php echo trim($product['genre'], " ");?>">
				</div>
				<div>
					<label for="cover">Cover</label>
					<input type="text" name="cover" id="cover" value="<?php echo trim($product['cover'], " ");?>">
				</div>
				<div>
					<label for="price">Price</label>
					<input type="text" name="price" id="cover" value="<?php echo trim($product['price'], " ");?>">
				</div>
				<div>
					<label for="desc">Brief description</label>
					<textarea name="desc" id="desc">
					<?php echo trim($product['description'], " ");?>
				</textarea>
				</div>
				<button type="submit">Update</button>
			</form>
		<?php

	} else echo $products;
?>