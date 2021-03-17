<?php
	session_start();
	require_once "./connections/connection.php";
	require_once "./product/productsController.php";
	
	$dbConnection = ((new Conn))->connect();
	if (!isset($_GET['id'])) header("Location: index.php");
	
	$productId = $_GET['id'];
	$currentDate = strval(date('Y-m-d'));
	$session_name = "";
	$status = "";
	if ($_SESSION){
		$session_name = $_SESSION['name'];
		$status = $_SESSION['status'];
	}

	$products = (new Products($dbConnection, $_GET['id']))->productQUery();

	if (is_array($products)) {
		$product = $products[0];
		?>
			<h1> <?php echo $product['title'] ?> </h1>
			<p> <?php echo $product['description'] ?> </p>
			<h3> <?php echo $product['price'] ?> </h3>
			<form action="" method="post">
				<input type="submit" value="Purchase" name="purchase">
			</form>
		<?php
	}

	if (isset($_POST['purchase'])) {
		if(!$session_name){
			echo "Sign up to purchase this app";
			return;
		}
		
		if ($status === 'yes') {
			echo "In eligigible to purchase this item";
			return;
		}
		$query = "INSERT INTO `purchases` (`user_id`, `product_id`, `purchase_date`) VALUES ('1', '$productId', '$currentDate' )";
		$message = ($dbConnection->query($query)) ? "purchase successfull" : "Error $dbConnection->error";
		echo $message;
	}