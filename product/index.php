<?php
	session_start();

	require_once '../connections/connection.php';
	require_once './productsController.php';
	require_once '../models/isadmin.php';

	$authenticate = getSession($_SESSION['status']);
	if ($authenticate === 'not eligible') {
		echo $authenticate;
		sleep(5);
		header("Location: ../");
		return;
	}

	$dbConnection = (new Conn())->connect();
	$products = new Products($dbConnection);

	if (isset($_POST['delete'])) {
		$delete = $_POST['delete'];
		echo $products->deleteProduct($delete);
	}

	$allProduct = $products->productQUery();

	if (is_array($allProduct)) {
		?>
			<ul>
		<?php
		foreach ($allProduct as $product){
			?>
				<li>
					<p> <?php echo $product['title'] ?> </p>
					<p> <?php echo $product['description'] ?> </p>
					<form action="" method="post">
						<input type="text" name="delete"  
							value="<?php echo $product['id'] ?>" 
							style="display: none;"
						>
						<input type="submit" value="Delete" >
					</form>
					<a href="update.php?id=<?php echo $product['id'] ?>">Update Product</a>
				</li>
			<?php
		}
	}
	else echo "<p> $allgenre </p>";
?>