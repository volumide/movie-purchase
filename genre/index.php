<?php
	require_once '../connections/connection.php';
	require_once './genreController.php';

	$dbConnection = (new Conn())->connect();
	$genre = new Genre($dbConnection);
	$allgenre =  $genre->getGenre();
	if (is_array($allgenre)) 
		foreach ($allgenre as $singleGenre)
			echo $singleGenre["title"];
	else echo $allgenre;
?>