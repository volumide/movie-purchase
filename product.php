<?php
	require_once "./connections/connection.php";
	require_once "./product/productsController.php";
	
	$dbConnection = ((new Conn))->connect();
	if (!isset($_GET['id'])) header("Location: index.php");
	
	$productId = $_GET['id'];
	$currentDate = strval(date('Y-m-d'));
	$online = "<script>
		if(localStorage.getItem('online_status'))document.write(localStorage.getItem('online_status'))
		else document.write('')
	</script>";
	$status = $online;
	

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
	// echo $online;
	// echo $status;

	if ($status == false) {
		echo 'wroking';
	}else{
		echo 'not working';
	}
	// if ($online) {
	// 	echo $online . "working";
	// }else{
	// 	echo "working";
	// }
	// if($online === 'hello') echo "offline";
	// else{
		// if (isset($_POST['purchase'])) {
			// echo $online;
			// if($online != ''){
			// 	echo $online;
			// 	// return;
			// }
	
			
			// if($online === 'not found'){
			// 	echo "Not a resgistered user. Register to purchase";
			// }else{
			// 	$query = "INSERT INTO `purchases` (`user_id`, `product_id`, `purchase_date`) VALUES ('1', '$productId', '$currentDate' )";
			// 	$message = ($dbConnection->query($query)) ? "purchase successfull" : "Error $dbConnection->error";
			// 	echo $message;
			// }
		// }
	// }