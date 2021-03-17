<?php
	require_once '../connections/connection.php';
	require_once '../product/productsController.php';

	$dbConnection = (new Conn())->connect();
	$products = (new Products($dbConnection))->productEndWithS();
	
	var_dump($products);

?>