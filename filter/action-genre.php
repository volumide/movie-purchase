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
	$products = (new Products($dbConnection))->productQUery();
	$response = [];
		foreach ($products as $product) if ($product['name'] === 'action') array_push($response, $product);

	?> <h1>Films with genre action</h1> <?php
	foreach ($response as $value) {
		?>
			<p>
				<?php echo $value['title'] ." ". $value['name'] . "<br>". $value['description']; ?>
			</p>
		<?php
	}
?>