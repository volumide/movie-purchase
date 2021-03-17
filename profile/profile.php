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
						<input type="text" name="name" id="name" value="<?php echo $rows['fullname'] ?>" disabled>
					</div>
					<div>
						<label for="email">Email</label>
						<input type="email" name="email" id="email" value="<?php echo $rows['email'] ?>" disabled>
					</div>
					<div>
						<label for="country">Country</label>
						<input type="text" name="country" id="country" value="<?php echo $rows['country'] ?>" disabled>
					</div>
					<div>
						<label for="phone">Phone</label>
						<input type="number" name="phone" id="phone" value="<?php echo $rows['phone'] ?>" disabled>
					</div>
					<div>
						<label for="gender">Gender</label>
						<input type="text" name="gender" id="gender" value="<?php echo $rows['gender'] ?>" disabled>
					</div>
					<div>
						<label for="dob">Date Of Birth</label>
						<input type="date" name="dob" id="dob" value="<?php echo $rows['dob'] ?>" disabled>
						<!-- <input type="text" name="dob" id="dob"> -->
					</div>
					<button type="submit" id="update" style="display: none;">Update</button>
					<button type="button" id="edit">Edit</button>
					<script>
						const docs = document.querySelectorAll("input")
						const edit = document.getElementById("edit")
						const update = document.getElementById("update")

						edit.addEventListener('click', (e)=>{
							e.preventDefault()
							docs.forEach(e =>{
								if(e.name !== 'dob' && e.name !== 'gender') e.disabled = false
							})
							edit.style.display = 'none'
							update.style.display = 'block'
						})
					</script>
				</form>
			<?php
		} 
		else{
			array_push($allUsers, $rows);
			var_dump($rows);
		} 
	}	
	else $message = "Not result found";

?>
	
<?php
	$dbConnection->close();
?>