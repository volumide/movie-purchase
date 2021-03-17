<?php
	session_start();
	require_once '../connections/connection.php';
	require_once './genreController.php';
	$authenticate = getSession($_SESSION['status']);
	if ($authenticate === 'not eligible') {
		echo $authenticate;
		sleep(5);
		header("Location: ../");
		return;
	}
	$dbConnection = (new Conn())->connect();
	$genre = new Genre($dbConnection);
	$allgenre =  $genre->getGenre();
	if (is_array($allgenre)) 
		foreach ($allgenre as $singleGenre)
			echo $singleGenre["title"];
	else echo $allgenre;
?>