<?php
	require_once './connections/connection.php';
	$dbConnection = (new Conn())->connect();

	// $query = "CREATE TABLE  `users` (
	// 	id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	// 	`fullname` VARCHAR(255) NOT NULL,
	// 	`email` VARCHAR(255) NOT NULL,
	// 	`phone` VARCHAR(30) NULL,
	// 	`country` VARCHAR(30) NULL,
	// 	`gender` VARCHAR(30) NOT NULL,
	// 	`dob` VARCHAR(50) NOT NULL,
	// 	`password` VARCHAR(255) NOT NULL,
	// 	`is_admin` VARCHAR(50) NOT NULL DEFAULT 'no',
	// 	`created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
	// )";

	// $query = "CREATE TABLE  `movies` (
	// 	id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	// 	`title` VARCHAR(255) NOT NULL,
	// 	`genre` VARCHAR(255) NOT NULL,
	// 	`cover` VARCHAR(30) NULL,
	// 	`description` VARCHAR(30) NOT NULL,
	// 	`price` VARCHAR(30) NOT NULL,
	// 	`created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
	// )";

	// $query = "CREATE TABLE  `genre` (
	// 	id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	// 	`title` VARCHAR(255) NOT NULL,
	// 	`created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
	// )";

	echo ($dbConnection->query($query)) ? "Db table creation successful" : "Error creating table". $dbConnection->error;

	$dbConnection->close();
?>