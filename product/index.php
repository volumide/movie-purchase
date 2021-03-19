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
	?> 
		<div class="flex flex-col items-center  w-full">
			<h1 class="py-5 text-3xl font-semibold"> All available Films </h1>
			<div class=" w-full px-6" >
	<?php
	// echo "<div><h1>All available Films</h1>";

	$dbConnection = (new Conn())->connect();
	$products = new Products($dbConnection);

	if (isset($_POST['delete'])) {
		$delete = $_POST['delete'];
		echo $products->deleteProduct($delete);
	}

	$allProduct = $products->productQUery();

	if (is_array($allProduct)) {
		?>
			<ul class="grid grid-cols-3 gap-4 py-6 px-6">
				<a href="../filter/action-genre.php" class="bg-blue-700 py-3 px-5 block rounded text-white font-semibold flex items-center justify-center text-3xl">All Action Genre</a>
				<a href="../filter/endsWiths.php" class="bg-blue-400 py-3 px-5 block rounded text-white font-semibold flex items-center justify-center text-3xl">Ends with "S"</a>
		<?php
		foreach ($allProduct as $product){
			?>
				<li class="flex flex-col bg-white rounded shadow-md hover:shadow ">
					<div class="relative w-full">
						<div style="height: 300px; object-fit:cover; overflow:hidden;">
							<img src="https://d13ezvd6yrslxm.cloudfront.net/wp/wp-content/images/2018-bestposters-spidermanspiderverse-700x1038.jpg" class="object-cover w-full h-100 rounded-t" alt="Plan" />
						</div>
					</div>
					<div class="p-6">
						<p class="inline-block py-3  text-xs font-semibold text-teal-900 uppercase rounded-full bg-teal-accent-400">
							<?php echo $product['name'] ?>
						</p>
						<p class="text-lg font-semibold capitalize"> <?php echo $product['title'] ?> </p>
						<p class="text-sm text-gray-900 py-2"> <?php echo $product['description'] ?> </p>
						<div class="flex">
							<a href="update.php?id=<?php echo $product['id'] ?>" class="p-4 bg-black rounded text-white font-semibold">Update Product</a>
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