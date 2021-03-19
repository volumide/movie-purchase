<?php
	session_start();
	require_once '../connections/connection.php';
	require_once './genreController.php';
	require_once '../models/isadmin.php';
	
	if ( getSession($_SESSION['status']) !== 'not eligible'){
		header("Location: ../");
		exit();
	}
	require  '../admin/header.php';
	?> 
		<div class="flex flex-col items-center  w-full">
			<h1 class="py-5 text-3xl font-semibold"> All available genre </h1>
			<div class=" w-2/5" >
	<?php

	$dbConnection = (new Conn())->connect();
	if (isset($_POST['id'])) {
		$id =  $_POST['id'];
		echo (new Genre($dbConnection, $id))->deleteGenre();
	}

	$genre = new Genre($dbConnection);
	$allgenre =  $genre->getGenre();
	if (is_array($allgenre)){
		foreach ($allgenre as $singleGenre){
			// echo $singleGenre["title"];
			?>
				<div class="p-4 my-4 flex items-center bg-gray-300 rounded">
					<p class="mr-4 flex-auto  capitalize font-semibold text-lg" > <?php echo $singleGenre['name'] ?> </p>
					<form action="" method="post" class="pl-4 flex-initial">
						<input type="text" name="id" value="<?php echo $singleGenre['id'] ?>" style="display: none;">
						<button name="delete" id="delete" type="submit" class="p-3 rounded bg-black font-semibold text-white font-bold">Delete</button>
					</form>
				</div>

			<?php
		}
		?> </div></div> <?php
	}
	else echo $allgenre;
?>