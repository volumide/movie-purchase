<?php
	session_start();
	require_once '../connections/connection.php';
	require_once '../models/isadmin.php';

	$authenticate = getSession($_SESSION['status']);
	if ($authenticate !== 'eligible'){
		header("Location: ../");
		exit();
	}
	require  '../admin/header.php';
	?>
		<div class="flex flex-col items-center w-full">
	<?php
?>

<?php

	$dbConnection = (new Conn())->connect();
	$responses = [];
	$ageFilter = [];
	$query = "SELECT * FROM `users`";
	
	$result = $dbConnection->query($query);
	if ($result->num_rows > 0) while ($rows = $result->fetch_assoc()) array_push($responses, $rows);

	?> 
		<div class="flex flex-col items-center  w-full"> 
		<div class="p-4">
			<a href="../filter/users.php?purchases=all" class="p-3 bg-black text-white rounded font-semibold">Users Buy counts</a>
			<a href="../filter/users.php?age=age" class="p-3 bg-black text-white rounded font-semibold">Age > 50</a>
		</div>
	<?php

	if (isset($_GET['age']) && isset($_GET['age']) == "age") {
		// user with age greate than 50 logic here
		?>
			<h1 class="py-5 text-3xl font-semibold"> Users older than 50yrs </h1>
			<div class=" w-2/5" >
			<div class="p-4 m-1 flex items-center bg-gray-700 rounded">
				<p class="mr-4 flex-1 text-white  capitalize font-semibold text-lg"> Name </p>
				<p class="mr-4 flex-1 text-white capitalize font-semibold text-lg"> Email </p>
				<p class="mr-4 flex-1 text-white capitalize font-semibold text-lg"> Date Of Birth </p>
			</div>
		<?php

		$ageAbove50 = $_GET['age'];

		foreach ($responses as $response) {
			$currentDate = new DateTime(strval(date('Y-m-d')));
			$userYear = new DateTime((strval($response['dob'])));
			$ageDiff = ($userYear->diff($currentDate))->format('%Y');
			if ($ageDiff > 50) {
				array_push($ageFilter, $response);
			}
		}

		foreach ($ageFilter as$user) {
			?>
				<div class="p-4 m-1  flex items-center bg-gray-300 rounded">
					<p class="flex-1  capitalize font-semibold text-lg"> <?php echo $user['fullname']; ?> </p>
					<p class=" flex-1 capitalize font-semibold text-lg"> <?php echo   $user['email'];  ?> </p>
					<p class=" flex-1 capitalize font-semibold text-lg"> 	<?php echo $user['dob'] ?></p>
				</div>
			<?php
		}
		return;
	}

	if (!isset($_POST['age']) && !isset($_GET['purchases'])) {
		// start of table to show all registered user excluding the admin
		?>
			<h1 class="py-5 text-3xl font-semibold"> All current users </h1>
			<div class=" w-4/5" >
				<div class="p-4 m-1 flex items-center bg-gray-600 rounded">
					<p class="mr-4 flex-1  capitalize font-semibold text-lg text-white"> Name</p>
					<p class="mr-4 flex-1  capitalize font-semibold text-lg text-white"> Email </p>
					<p class="mr-4 flex-1  capitalize font-semibold text-lg text-white"> Phone </p>
					<p class="mr-4 flex-1  capitalize font-semibold text-lg text-white"> Gender </p>
					<p class="mr-4 flex-1  capitalize font-semibold text-lg text-white"> Country </p>
				</div>
		<?php
	}

	if (isset($_GET['purchases']) && isset($_GET['purchases']) =="all"){
		?>
			<h1 class="py-5 text-3xl font-semibold"> Count of users purchases </h1>
			<div class=" w-2/5" >
			<div class="p-4 m-1 flex items-center bg-gray-700 rounded">
				<p class="mr-4 flex-1 text-white  capitalize font-semibold text-lg"> Name </p>
				<p class="mr-4 flex-1 text-white capitalize font-semibold text-lg"> Email </p>
				<p class="mr-4 flex-1 text-white  font-semibold text-lg"> Total purchase(s) made </p>
			</div>
		<?php
	}

	foreach ($responses as $response) {
		// logic that works on counting number of product user have purchased 
		if (isset($_GET['purchases']) && isset($_GET['purchases']) =="all") {
			$id = intval($response['id']);
			$date = "";
			$query = "SELECT * FROM `purchases` WHERE `user_id` = '$id'";
			$result = $dbConnection->query($query);
			if ($result->num_rows > 0){
				$count = 0;
				while ($rows = $result->fetch_assoc()){
					$count+= 1;
					$date = $rows['purchase_date'];
				}
				if ($count > 0) {
					?>
						<div class="p-4 m-1 flex items-center bg-gray-300 rounded">
							<p class="mr-4 flex-1  capitalize font-semibold text-lg"> <?php echo $response['fullname']; ?> </p>
							<p class=" flex-1 capitalize font-semibold text-lg"> <?php echo   $response['email'];  ?> </p>
							<p class=" flex-1 capitalize font-semibold text-lg"> <?php echo   "($count)" ;  ?> </p>
						</div>
					<?php
				}	
			}
		}
		// table body for all users 
		if (!isset($_GET['age']) && !isset($_GET['purchases']) && $response['is_admin'] !== 'yes'){
			?>
				<div class="p-4 m-1 flex items-center bg-gray-300 rounded">
					<p class="mr-4 flex-1  capitalize font-semibold text-lg"> <?php echo $response['fullname']; ?> </p>
					<p class="mr-4 flex-1  capitalize font-semibold text-lg"> <?php echo $response['email']; ?> </p>
					<p class="mr-4 flex-1  capitalize font-semibold text-lg"> <?php echo $response['phone']; ?> </p>
					<p class="mr-4 flex-1  capitalize font-semibold text-lg"> <?php echo $response['gender']; ?> </p>
					<p class="mr-4 flex-1  capitalize font-semibold text-lg"> <?php echo $response['country']; ?> </p>
				</div>
			<?php
		}
	}

	?>
		</div>
	</div>
	<?php 
	// end of table to show all registered user excluding the admin
	
?>