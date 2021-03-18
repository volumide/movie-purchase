<?php include_once '../misc/header.php'; var_dump($_SESSION);?>
<form action="" method="POST">
	<div>
		<label for="opass">Old password</label>
		<input type="password" name="opass" id="opass" class="mt-2 w-full border rounded p-4">
	</div>
	<div>
		<label for="npass">New password</label>
		<input type="password" name="npass"  id="npass" class="mt-2 w-full border rounded p-4">
	</div>
	<div>
		<label for="cpass">Confirm new password</label>
		<input type="password" name="cpass" id="cpass" class="mt-2 w-full border rounded p-4">
	</div>
	<button type="submit" name="submit" class="mt-4 py-4 px-4 bg-black text-white rounded w-full font-bold">Save</button>
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

