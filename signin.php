<?php include_once './misc/header.php' ?>
	<form action="./auth/signin.php" method="POST">
		<div>
			<label for="email">Email</label>
			<input type="email" name="email" id="email">
		</div>
		<div>
			<label for="password">Password</label>
			<input type="password" name="password" id="password">
		</div>
		<button type="submit">Sign in</button>
	</form>
<?php include_once './misc/footer.php' ?>