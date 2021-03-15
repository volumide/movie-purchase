<?php
	require_once '../connections/connection.php';
	$dbConnection = (new Conn())->connect();
	$email = "";
	$password = "";

	$query = "SELECT * FROM `users` WHERE `email` = `$email` and `password` =`$password` LIMIT";
	$result = $dbConnection->query($query);

	if ($result->num_rows === 1){
		$_SESSION['online'] = true;
		?>
		<!-- closes php tag and opens script tag for local storage -->
			<script> 
				localStorage.setItem('online_status', true) 
				localStorage.setItem('status', result['is_admin']) 
			</script>
		<!-- opens php tag and closed script tag  -->
		<?php
		header("Location: index.php");
	} 

	$dbConnection->close()
?>