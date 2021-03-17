<?php
	include_once './misc/header.php';
	require_once "./connections/connection.php";
	require_once "./product/productsController.php";
	$dbConnection = ((new Conn))->connect();
	$products = new Products($dbConnection);

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
								<a href="product.php?id=<?php echo $product['id'] ?>">View Product</a>
								<a href="#">Add to cart</a>
							</li>
						<?php
					}
				?> 
			</ul> 
		<?php
	}
	else echo "<p> $allgenre </p>";

	include_once './misc/footer.php';
?>