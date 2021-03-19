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
	?>
		<ul class="grid grid-cols-3 gap-4 py-6 px-6">
	<?php
	if (is_array($products)) {
		foreach ($products as $product) {
			?>
				<li class="flex flex-col bg-white rounded shadow-md hover:shadow ">
					<div class="relative w-full">
						<img src="https://images.pexels.com/photos/3184305/pexels-photo-3184305.jpeg?auto=compress&amp;cs=tinysrgb&amp;dpr=2&amp;h=750&amp;w=1260" class="object-cover w-full rounded-t" alt="Plan" />
					</div>
					<div class="p-6">
						<p class="text-lg font-semibold capitalize"> <?php echo $product['title'] ?> </p>
						<p class="text-sm text-gray-900 py-2"> <?php echo $product['description'] ?> </p>
						<div class="flex">
							<a href="../product/update.php?id=<?php echo $product['id'] ?>" class="p-4 bg-black rounded text-white font-semibold">Update Product</a>
							<form action="" method="post" class="ml-4">
								<input type="text" name="delete"  
									value="<?php echo $product['id'] ?>" 
									style="display: none;"
								>
								<input type="submit" value="Delete" class="w-ful h-full bg-blue-900 cursor-pointer text-white p-4 rounded" >
							</form>
						</div>
					</div>
				</li>
			<?php
		}
		?> </ul <?php
	}
?>