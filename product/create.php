<?php
	session_start();
	// admin create new product
	require_once '../connections/connection.php';
	require_once '../genre/genreController.php';
	require_once '../models/isadmin.php';

	$authenticate = getSession($_SESSION['status']);
	if ($authenticate !== 'not eligible'){
		header("Location: ../");
		exit();
	}
	require  '../admin/header.php';
	// error_reporting(0);
	$dbConnection = (new Conn())->connect();
	$genres = (new Genre($dbConnection))->getGenre();
	$message ="";

	if (isset($_POST['submit'])) {
		$title = $_POST['title'];
		$genre = $_POST['genre'];
		$price = $_POST['price'];
		$cover = '';
		$description = $_POST['desc'];
		$dir = 'covers/';
		$tempName = "";
		$error = [];
		

		if ($_POST['cover']){
			$cover = $_FILES['cover']['name'];
			$tempName = $_FILES['cover']['tmp_name'];
			$fileType = strtolower(pathinfo(basename($dir .$cover),PATHINFO_EXTENSION));
			if (!getimagesize($tempName)) array_push($error, "file is not an image type"); 
			if (!$fileType != "jpg" || !$fileType != "jpeg" || !$fileType != "png") array_push($error, "Only JPEG PNG and JPG file are accepted" );
			if (($_FILES['cover']['size']) > 20000) array_push($error, "file size is too large");
		}
		
		if (count($error) > 0) {
			foreach ($error as $value) {
				echo $value;
				return;
			}
		}

		if ($_POST['cover']) {
			$moveImage =  move_uploaded_file($tempName, $dir);
		}

		$query = "INSERT INTO `movies` (`title`, `genre_id`, `cover`,`price`, `description`) VALUES ('$title', '$genre', '$cover', '$price', '$description')";
	
		if ($dbConnection->query($query)) $message = "Movie created successfully";
		else $message = "Error $dbConnection->error";
	}
	
	$dbConnection->close()
?>
	 
	 <div class="flex flex-col items-center w-full">
		<h1 class="py-5 text-3xl font-semibold"> Create Movie <span class="text-blue-900 font-bold">  </h1>
		<?php
			if ($message) {
				?>
					<p class="bg-yellow-500 border-yellow-200 w-2/5 rounded text-center py-4 font-semibold text-lg"><?php echo $message; ?></p>
				<?php
			}
		?>
		<form action="" method="POST" class="w-2/5 py-5">
			<div class="pb-5">
				<label class="block pb-3 for="title">Movie Title</label>
				<input placeholder="movie title..." type="text" name="title" id="title" class="px-4 py-4 w-full rounded border border-gray-300 shadow-sm text-base placeholder-gray-700  focus:outline-none focus:border-blue-500 py-3">
			</div>
			<div class="pb-5">
				<label class="block pb-3 for="genre">Genre</label>
				<select name="genre" id="genre" class="px-4 py-4 w-full rounded border border-gray-300 shadow-sm text-base placeholder-gray-700  focus:outline-none focus:border-blue-500 py-3">
					<option value="">select genre</option>
					<?php
						// get all genre from genre database
						foreach ($genres as $genre) {
							?>
								<option value="<?php echo $genre['id'] ?>"><?php echo $genre['name'] ?></option>
							<?php
						}
					?>
				</select>
				<!-- <input type="genre" name="genre" id="genre"> -->
			</div>
			<div class="pb-5">
				<label class="block pb-3 for="cover">Movie cover</label>
				<input placeholder="movie cover..." type="text" name="cover" id="cover" class="px-4 py-4 w-full rounded border border-gray-300 shadow-sm text-base placeholder-gray-700  focus:outline-none focus:border-blue-500 py-3">
			</div>
			<div class="pb-5">
				<label class="block pb-3 for="price">Price</label>
				<input placeholder="price" type="number" name="price" id="price" class="px-4 py-4 w-full rounded border border-gray-300 shadow-sm text-base placeholder-gray-700  focus:outline-none focus:border-blue-500 py-3">
			</div>
			<div class="pb-5">
				<label class="block pb-3 for="desc">Brief description</label>
				<textarea placeholder="description" name="desc" id="desc" class="px-4 py-4 w-full rounded border border-gray-300 shadow-sm text-base placeholder-gray-700  focus:outline-none focus:border-blue-500 py-3"></textarea>
			</div>
			<button type="submit" name="submit" class="flex justify-center items-center bg-black hover:bg-gray-800 text-white focus:outline-none focus:ring rounded p-4">Create movie</button>
		</form>
	 </div>
		<!-- </div>
	</div> -->