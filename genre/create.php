<?php
	session_start();
	require_once '../connections/connection.php';
	require_once '../models/isadmin.php';

	if (getSession($_SESSION['status']) !== 'eligible'){
		header("Location: ../");
		exit();
	}
	require  '../admin/header.php';
	$message = "";
	// error_reporting(0);
	$dbConnection = (new Conn())->connect();
	if (isset($_POST['title'])) {
		$title = $_POST['title'];
		$message;
		$query = "INSERT INTO `genre` (`name`) VALUES ('$title')";
		$message = ($dbConnection->query($query)) ? "$title genre created successfully" : "Error $dbConnection->error";
			
	}
?>
		<div class="flex flex-col items-center  w-full">
			<h1 class="py-5 text-3xl font-semibold"> Create Genre </h1>
			<form action="" method="POST" class=" w-2/5">
				<?php
					if ($message) {
						?>
							<p class="py-3 bg-yellow-500 font-semibold m-3 rounded text-center"> <?php echo $message ?> </p>
						<?php
					}
				?>
					<input type="text" name="title" id="title" class="border border-black rounded p-4 focus:outline-none w-full" placeholder="Genre title">
				<button type="submit" class="p-4 bg-blue-900  ml-auto mt-4  text-white font-semibold rounded-lg block border-current">Create</button>
			</form>
		</div>

<?php $dbConnection->close() ?>