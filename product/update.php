<?php
	session_start();
	require_once '../connections/connection.php';
	require_once './productsController.php';
	require_once '../genre/genreController.php';
	require_once '../models/isadmin.php';

	if (getSession($_SESSION['status']) !== 'not eligible'){
		header("Location: ../");
		exit();
	}

	$dbConnection = (new Conn())->connect();
	$genres = (new Genre($dbConnection))->getGenre();

	if (!isset($_GET['id'])) {
		$message = "unable to perfom the operation";
		return;
	}
	require  '../admin/header.php';
	// $product;
	$id = $_GET['id'];
	$message = "";
	// check if form values are set and ready for query
	if (isset($_POST['title']) || isset($_POST['genre']) || isset($_POST['cover']) || isset($_POST['desc']) ||isset($_POST['price'])) {
		$title = $_POST['title'];
		$genre = $_POST['genre'];
		$cover = $_POST['cover'];
		$price = $_POST['price'];
		$description = $_POST['desc'];
		if (intval($price)) {
			$query = "UPDATE `movies` SET 
				`title` = '$title',
				`genre_id` = '$genre',
				`cover` = '$cover',
				`price` = '$price',
				`description` = '$description'
			WHERE `id` = '$id'";
	
			$result = $dbConnection->query($query);
	
			if ($result) $message = "Record Updated successfully" ;
			else $message = "No result found $dbConnection->error";
		}else $message = "price must be an interger";
	
	}

	// get data value from database
	$products = (new Products($dbConnection, $id))->productQUery();
	if (is_array($products)) {
		$product = $products;
		?>
			<div class="flex flex-col items-center w-full">
				<h1 class="py-5 text-3xl font-semibold"> Update <span class="text-blue-900 font-bold"> <?php echo $product['title'];?> </span> </h1>
				<div class=" w-full px-6 flex flex-col items-center" >
					<?php
						if ($message) {
							?>
								<p class="bg-yellow-500 border-yellow-200 w-2/5 rounded text-center py-4 font-semibold text-lg"><?php echo $message; ?></p>
							<?php
						}
					?>
					<!-- form for updating the product -->
					<form action=""  method="POST" class="w-2/5 my-5">
						<div class="pb-5">
							<label class="block pb-3" for="title" >Film Title</label>
							<input type="text" name="title" id="title" value="<?php echo trim($product['title'], " ");?>" class="px-4 py-4 w-full rounded border border-gray-300 shadow-sm text-base placeholder-gray-700  focus:outline-none focus:border-blue-500 py-3">
						</div>
						<div class="pb-5">
							<label class="block pb-3" for="genre">Genre</label>
							<!-- <input type="genre" name="genre" id="genre" value="<?php echo trim($product['genre'], " ");?>" disabled> -->
							<select name="genre" id="genre" class="px-4 py-4 w-full rounded border border-gray-300 shadow-sm text-base placeholder-gray-700  focus:outline-none focus:border-blue-500 py-3">
								<option value="<?php echo trim($product['genre_id'], " ");?>"><?php echo trim($product['name'], " ");?></option>
								<?php
									// get all genre from genre database
									foreach ($genres as $genre) {
										?>
											<option value="<?php echo $genre['id'] ?>"><?php echo $genre['name'] ?></option>
										<?php
									}
								?>
							</select>
						</div>
						<div class="pb-5">
							<label class="block pb-3" for="cover">Cover</label>
							<input type="text" name="cover" id="cover" value="<?php echo trim($product['cover'], " ");?>" class="px-4 py-4 w-full rounded border border-gray-300 shadow-sm text-base placeholder-gray-700  focus:outline-none focus:border-blue-500 py-3">
						</div>
						<div class="pb-5">
							<label class="block pb-3" for="price">Price</label>
							<input type="text" name="price" id="cover" value="<?php echo trim($product['price'], " ");?>" class="px-4 py-4 w-full rounded border border-gray-300 shadow-sm text-base placeholder-gray-700  focus:outline-none focus:border-blue-500 py-3">
						</div>
						<div class="pb-5">
							<label class="block pb-3" for="desc">Brief description</label>
							<textarea name="desc" id="desc" class="px-4 py-4 w-full rounded border border-gray-300 shadow-sm text-base placeholder-gray-700  focus:outline-none focus:border-blue-500">
							<?php echo trim(nl2br($product['description']), " \t\n\r");?>
						</textarea>
						</div>
						<button type="submit" name="submit" class="flex justify-center items-center bg-black hover:bg-gray-800 text-white focus:outline-none focus:ring rounded p-4">Update</button>
					</form>
				</div>
			</div>
		<?php

	} else echo $products;
?>