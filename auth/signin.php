<?php
	require_once '../connections/connection.php';
	$dbConnection = (new Conn())->connect();
	
	$email = $_POST['email'];
	$password = $_POST['password'];

	$query = "SELECT * FROM `users` WHERE `email` = '$email' and `password` = '$password'";
	$result = $dbConnection->query($query);

	if($result->num_rows > 0){
		echo "successful";
		while ($row = $result->fetch_assoc()) {
			?>
				<script> 
					localStorage.setItem('online_status', "true")  
					localStorage.setItem('is_admin', <?php echo "'". $row['is_admin'] ."'"; ?> )  
				</script> 
			<?php
		}
		// header("Location: ../");
	} else{ echo "Invalid email or password"; }
	// 12234

	$dbConnection->close()
?>