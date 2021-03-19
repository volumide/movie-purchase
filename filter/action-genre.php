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
	$dbConnection = (new Conn())->connect();
	$products = (new Products($dbConnection))->productQUery();
	$response = [];
		foreach ($products as $product) if ($product['name'] === 'action') array_push($response, $product);

	?> 
		<div class="flex flex-col items-center w-full">
		<h1 class="py-5 text-3xl font-semibold">Action Genre Category</h1> 
		<div class=" w-full px-6" >
			<ul class="grid grid-cols-3 gap-4 py-6 px-6">
	<?php
	foreach ($response as $value) {
		?>
			<li class="flex flex-col bg-white rounded shadow-md hover:shadow ">
				<div class="relative w-full">
					<img src="https://images.pexels.com/photos/3184305/pexels-photo-3184305.jpeg?auto=compress&amp;cs=tinysrgb&amp;dpr=2&amp;h=750&amp;w=1260" class="object-cover w-full rounded-t" alt="Plan" />
				</div>
				<div class="p-6">
					<p class="inline-block py-3  text-xs font-semibold text-teal-900 uppercase rounded-full bg-teal-accent-400">
								<?php echo $value['name'] ?>
							</p>
					<p class="text-lg font-semibold capitalize"> <?php echo $value['title'] ?> </p>
					<p class="text-sm text-gray-900 py-2"> <?php echo $value['description'] ?> </p>
					<div class="flex">
						<a href="../product/update.php?id=<?php echo $value['id'] ?>" class="p-4 bg-black rounded text-white font-semibold">Update Product</a>
						<form action="" method="post" class="ml-4">
							<input type="text" name="delete"  
								value="<?php echo $value['id'] ?>" 
								style="display: none;"
							>
							<input type="submit" value="Delete" class="w-ful h-full bg-blue-900 cursor-pointer text-white p-4 rounded" >
						</form>
					</div>
				</div>
				<!-- <?php echo $value['title'] ." ". $value['name'] . "<br>". $value['description']; ?> -->
			</li>
		<?php
	}
	?> </ul> </div> <div> <?php
?>