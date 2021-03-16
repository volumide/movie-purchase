<?php
	require_once '../connections/connection.php';
	require_once './products.php';

	$dbConnection = (new Conn())->connect();
	$products = new Products($dbConnection);

	$allProduct = $products->productQUery();
	if (is_array($allProduct)) 
		foreach ($allProduct as $product)
			echo $product["title"]. " => ". $product["id"] . "<br>";
	else echo $allgenre;
?>