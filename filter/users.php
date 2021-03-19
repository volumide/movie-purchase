<?php
	session_start();
	require_once '../connections/connection.php';
	require_once '../models/isadmin.php';

	$authenticate = getSession($_SESSION['status']);
	if ($authenticate !== 'not eligible'){
		header("Location: ../");
		exit();
	}
	require  '../admin/header.php';
	?>
		<div class="flex flex-col items-center w-full">
	<?php
?>
	<!-- <form action="" method="POST">
		<h1 class="text-2xl font-semibold">Filter age greater than 50 </h1>
		<button name="age" type="submit" class="text-lg text-blue-500 font-semi-bold" >Filter</button>
	</form> -->

<?php

	$dbConnection = (new Conn())->connect();
	$responses = [];
	$ageFilter = [];
	$query = "SELECT * FROM `users`";
	
	$result = $dbConnection->query($query);
	if ($result->num_rows > 0) while ($rows = $result->fetch_assoc()) array_push($responses, $rows);


	if (isset($_POST['age'])) {
		$ageAbove50 = $_POST['age'];
		foreach ($responses as $response) {
			$currentDate = new DateTime(strval(date('Y-m-d')));
			// echo $response['dob'];
			// return;
			$userYear = new DateTime((strval($response['dob'])));
			$ageDiff = ($userYear->diff($currentDate))->format('%Y');
			// echo $ageDiff;
			// return;
			if ($ageDiff > 50) {
				array_push($ageFilter, $response);
			}
		}
		foreach ($ageFilter as$user) {
			echo $user["fullname"];
		}
		return;
	}

	// start of table to show all registered user excluding the admin
	if (!isset($_POST['age']) && !isset($_GET['purchases'])) {
		?>
			<div class="flex flex-col items-center  w-full">
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
		<div class="flex flex-col items-center  w-full">
			<h1 class="py-5 text-3xl font-semibold"> Count of users purchases </h1>
			<div class=" w-2/5" >
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
							<p class="mr-4 flex-auto  capitalize font-semibold text-lg"> <?php echo $response['fullname']; ?> </p>
							<p class="pl-4 flex-initial capitalize font-semibold text-lg"> <?php echo   $response['email--------'];  ?> </p>
							<p class="pl-4 flex-initial capitalize font-semibold text-lg"> <?php echo   "Purchased ($count) movie(s)" ;  ?> </p>
						</div>
					<?php
				}	
			}
		}
		// table body for all users 
		if (!isset($_POST['age']) && !isset($_GET['purchases'])){
			?>
			<div class="p-4 m-1 flex items-center bg-gray-300 rounded">
				<p class="mr-4 flex-1  capitalize font-semibold text-lg"> <?php echo $response['fullname']; ?> </p>
				<p class="mr-4 flex-1  capitalize font-semibold text-lg"> <?php echo $response['email']; ?> </p>
				<p class="mr-4 flex-1  capitalize font-semibold text-lg"> <?php echo $response['phone']; ?> </p>
				<p class="mr-4 flex-1  capitalize font-semibold text-lg"> <?php echo $response['gender']; ?> </p>
				<p class="mr-4 flex-1  capitalize font-semibold text-lg"> <?php echo $response['country']; ?> </p>
			</div>
				<!-- <tr style="display: <?php echo ($response['is_admin'] == 'yes') ? "none" : ""; ?>">
					<td class="border-gray-600 border rounded p-4"><?php echo $response['fullname']; ?></td>
					<td class="border-gray-600 border rounded p-4"><?php echo $response['email']; ?></td>
					<td class="border-gray-600 border rounded p-4"><?php echo $response['phone']; ?></td>
					<td class="border-gray-600 border rounded p-4"><?php echo $response['gender']; ?></td>
					<td class="border-gray-600 border rounded p-4"><?php echo $response['country']; ?></td>
				</tr> -->

			<?php
		}
	}

	?>
		</div>
	</div>
	<?php 
	// end of table to show all registered user excluding the admin
	
?>