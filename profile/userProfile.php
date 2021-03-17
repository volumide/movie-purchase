<?php
	require_once '../connections/connection.php';
	$dbConnection = (new Conn())->connect();
	$message;
	$user;
	$id = "";
	$allUsers = [];
	
	$query = "SELECT * FROM `users`";
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		$query .= "WHERE `id` = '$id'";
	}
	$result = $dbConnection->query($query);
	if ($result->num_rows > 0) while ($rows = $result->fetch_assoc()){
		if ($id){
			?>
				<form action="" method="POST">
					<div>
						<label for="name">Name</label>
						<input type="text" name="name" id="name" value="<?php echo $rows['fullname'] ?>">
					</div>
					<div>
						<label for="email">Email</label>
						<input type="email" name="email" id="email" value="<?php echo $rows['email'] ?>">
					</div>
					<div>
						<label for="country">Country</label>
						<input type="text" name="country" id="country" value="<?php echo $rows['country'] ?>">
					</div>
					<div>
						<label for="phone">Phone</label>
						<input type="number" name="phone" id="phone" value="<?php echo $rows['phone'] ?>">
					</div>
					<div>
						<label for="gender">Gender</label>
						<input type="text" name="gender" id="gender" value="<?php echo $rows['gender'] ?>">
					</div>
					<div>
						<label for="dob">Date Of Birth</label>
						<input type="date" name="dob" id="dob" value="<?php echo $rows['fullname'] ?>">
						<!-- <input type="text" name="dob" id="dob"> -->
					</div>
					<button type="submit">Update</button>
				</form>
			<?php
		} 
		else array_push($allUsers, $rows);
	}	
	else $message = "Not result found";

?>
	
<?php
	$dbConnection->close();
?>