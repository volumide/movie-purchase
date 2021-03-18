<?php
	session_start();
	require_once '../connections/connection.php';
	require_once '../product/productsController.php';
	require_once '../models/isadmin.php';

	$authenticate = getSession($_SESSION['status']);
	if ($authenticate !== 'not eligible'){
		header("Location: ../");
		exit();
	}
	require  '../admin/header.php';
	echo "<div>";

	$dbConnection = (new Conn())->connect();
	$products = (new Products($dbConnection))->productEndWithS();
	if (is_array($products)) {
		foreach ($products as $product) {
			?>
				<p>
					<?php echo $product['title'] ."<br>". $product['description']; ?>
				</p>
			<?php
		}
	}
?>