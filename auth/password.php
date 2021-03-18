<?php include_once '../misc/header.php'; ?>
<form action="" method="POST">
	<div>
		<label for="opass">Old password</label>
		<input type="password" name="opass" id="opass">
	</div>
	<div>
		<label for="npass">New password</label>
		<input type="password" name="npass"  id="npass">
	</div>
	<div>
		<label for="cpass">Confirm new password</label>
		<input type="password" name="cpass" id="cpass">
	</div>
	<button type="submit" name="submit">Save</button>
</form>
<?php
	require_once '../connections/connection.php';
	$dbConnection = (new Conn())->connect();
	$message;
	
	if (!isset($_GET['id'])) {
		echo "unable to perfom the operation";
		return;
	}

	$id = $_GET['id'];
	$verify = "";
	if (isset($_POST['submit'])) {
		$oldPassword = $_POST['opass'];
		$newPassword = $_POST['npass'];
		$confirmPassword = $_POST['cpass'];

		if ($oldPassword == "" || $newPassword == ""|| $confirmPassword == ""){
			echo "password cannot be empty";
			return;
		}

		$query = "SELECT `password` FROM `users` WHERE id = $id LIMIT 1";
		$result = $dbConnection->query($query);
		if($result->num_rows > 0){
			$row = $result->fetch_assoc()['password'];
			if (!password_verify($oldPassword, $row)){
				echo "Old password is incorrect";
				return;
			}
		}
	// new password 12345
		if ($newPassword !== $confirmPassword) $message = "confirm password does not match";
		else{
			$newPassword = password_hash($newPassword, PASSWORD_BCRYPT);
			$query = "UPDATE `users` SET `password` =  '$newPassword' WHERE id = '$id'";
			$message =  ($dbConnection->query($query)) ? "password changed successfully": "Error updating your password ";
		}

		echo $message;
	}
	
?>

