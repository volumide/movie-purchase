<?php
	require './misc/header.php';
	require_once './connections/connection.php';
	if (!$_SESSION) header('Location: ./');
	$dbConnection = (new Conn())->connect();
	$message ="";
	$allUsers= [];
	$user;
	$id = "";
	if (isset($_GET['id'])) $id = $_GET['id'];
	
	
	if (isset($_POST['submit'])) {
		$name = $_POST['name'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$country = $_POST['country'];
		
		$sql = "UPDATE `users` SET 
			fullname = '$name',
			email = '$email',
			phone = '$phone',
			country = '$country'
			WHERE id = '$id' LIMIT 1";

		$message = ($dbConnection->query($sql)) ? "Profile Updates successfully": "No result found";
	}

	// query all user table for admin and update profile 
	$query = "SELECT * FROM `users`";
	if ($id) $query .= "WHERE `id` = '$id'";

	$result = $dbConnection->query($query);
	if ($result->num_rows > 0) while ($rows = $result->fetch_assoc()){
		if ($id){
			if ($message) {
				?>
					<p class="text-center py-4 sm:w-64 mx-auto bg-gray-800 font-semibold text-white rounded"> <?php echo $message ?> </p>
				<?php
			}
			?>
				<div class="py-10">
					<h1 class="sm:w-3/6 mx-auto text-4xl text-center font-semibold pb-11"> <?php echo trim($rows['fullname'])."'s Profile" ?> </h1>
				</div>
				<form action="" method="POST" class="sm:w-2/5 mx-auto">
					<div class="py-4">
						<label for="name" class="py-4 font-semibold">Name</label>
						<input type="text" name="name" id="name" value="<?php echo $rows['fullname'] ?>" disabled class="mt-2 w-full border rounded p-4">
					</div>
					<div class="py-4">
						<label for="email" class="py-4 font-semibold">Email</label>
						<input type="email" name="email" id="email" value="<?php echo $rows['email'] ?>" class="mt-2 w-full border rounded p-4" disabled>
					</div>
					<div class="py-4">
						<label for="country" class="py-4 font-semibold">Address</label>
						<input type="text" name="country" id="country" value="<?php echo $rows['country'] ?>" class="mt-2 w-full border rounded p-4" disabled>
					</div>
					<div class="py-4">
						<label for="phone" class="py-4 font-semibold">Phone</label>
						<input type="number" name="phone" id="phone" value="<?php echo $rows['phone'] ?>" class="mt-2 w-full border rounded p-4" disabled>
					</div>
					<div class="py-4">
						<label for="gender" class="py-4 font-semibold">Gender</label>
						<input type="text" name="gender" id="gender" value="<?php echo $rows['gender'] ?>" class="mt-2 w-full border rounded p-4" disabled>
					</div>
					<div class="py-4">
						<label for="dob" class="py-4 font-semibold">Date Of Birth</label>
						<input type="date" name="dob" id="dob" value="<?php echo $rows['dob'] ?>" class="mt-2 w-full border rounded p-4" disabled>
						<!-- <input type="text" name="dob" id="dob"> -->
					</div>
					<button type="submit" id="update" name="submit" style="display: none;" class="py-4 px-4 bg-black text-white rounded w-full font-bold">Update</button>
					<button type="button" id="edit" class="py-4 px-4 bg-blue-800 text-white rounded w-full font-bold">Edit Profile</button>
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
			// var_dump($rows);
		}
	}	
	else $message = "Not result found";
	
	require_once './models/isadmin.php';
	$authenticate = getSession($_SESSION['status']);
	if ($authenticate === 'eligible'){
		echo count(($allUsers));
		foreach ($allUsers as  $user) {
			?>
				<div style="padding: 5px;">
					<p> <?php echo $user['fullname'] ?></p>
					 <p> <?php echo $user['email'] ?></p>
					<p> <?php echo $user['phone'] ?></p>
					<p> <?php echo $user['gender'] ?></p> 
				</div>
			<?php
		}
	}
	// echo "not an admin";
?>
	
<?php
	$dbConnection->close();
?>