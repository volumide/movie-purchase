<?php include_once './misc/header.php' ?>
	<form action="./auth/signup.php" method="POST">
		<div>
			<label for="name">Name</label>
			<input type="text" name="name" id="name">
		</div>
		<div>
			<label for="email">Email</label>
			<input type="email" name="email" id="email">
		</div>
		<div>
			<label for="country">Country</label>
			<input type="text" name="country" id="country">
		</div>
		<div>
			<label for="phone">Phone</label>
			<input type="number" name="phone" id="phone">
		</div>
		<div>
			<label for="gender">Gender</label>
			<input type="text" name="gender" id="gender">
		</div>
		<div>
			<label for="dob">Date Of Birth</label>
			<input type="date" name="dob" id="dob">
			<!-- <input type="text" name="dob" id="dob"> -->
		</div>
		<div>
			<label for="password">Password</label>
			<input type="password" name="password" id="password">
		</div>
		<div>
			<label for="password">Confirm Password</label>
			<input type="password" name="cpassword" id="cpassword">
		</div>

		<button type="submit">Sign up</button>
	</form>
<?php include_once './misc/footer.php' ?>
