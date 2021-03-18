<?php
	session_start();
	require_once '../connections/connection.php';
	require_once './productsController.php';
	require_once '../models/isadmin.php';

	if (getSession($_SESSION['status']) !== 'not eligible'){
		header("Location: ../");
		exit();
	}

	require  '../admin/header.php';
	echo "<div><h1>All available Films</h1>";

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