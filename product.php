<?php
	require_once "./connections/connection.php";
	require_once "./product/productsController.php";
	
	$dbConnection = ((new Conn))->connect();
	if (!isset($_GET['id'])) header("Location: index.php");

	$products = (new Products($dbConnection, $_GET['id']))->productQUery();
	if (is_array($products)) {
		$product = $products[0];
		?>
			<li> 
				<h1> <?php echo $product['title'] ?> </h1>
				<p> <?php echo $product['description'] ?> </p>
				<h3> <?php echo $product['price'] ?> </h3>
				<button> Purchase </button>
			</li>
		<?php
	}