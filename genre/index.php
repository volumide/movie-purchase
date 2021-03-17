<?php
	session_start();
	echo "<h1> All available genre </h1>";
	require_once '../connections/connection.php';
	require_once './genreController.php';
	require_once '../models/isadmin.php';

	if ( getSession($_SESSION['status']) !== 'not eligible'){
		header("Location: ../");
		exit();
	}

	$dbConnection = (new Conn())->connect();
	if (isset($_POST['id'])) {
		$id =  $_POST['id'];
		echo (new Genre($dbConnection, $id))->deleteGenre();
	}

	$genre = new Genre($dbConnection);
	$allgenre =  $genre->getGenre();
	if (is_array($allgenre)) 
		foreach ($allgenre as $singleGenre){
			// echo $singleGenre["title"];
			?>
				<div>
					<p> <?php echo $singleGenre['name'] ?> </p>
					<form action="" method="post">
						<input type="text" name="id" value="<?php echo $singleGenre['id'] ?>" style="display: none;">
						<button name="delete" id="delete" type="submit">Delete</button>
					</form>
				</div>

			<?php
		}
	else echo $allgenre;
?>