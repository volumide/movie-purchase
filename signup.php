<?php 
	include_once './misc/header.php';
	if ($_SESSION) header("Location: ./");
	$admin = (isset($_GET['admin']) || isset($_GET['admin']) === "admin") ? "admin": "";
	// echo $admin;
?>
	<!-- <form action="./auth/signup.php" method="POST">
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
	</form> -->
	<div class="py-5 w-full flex justify-center items-center">
    <div class="bg-black w-full sm:w-1/2 md:w-9/12 lg:w-1/2 mx-3 md:mx-5 lg:mx-0 shadow-md flex flex-col md:flex-row items-center rounded z-10 overflow-hidden bg-center">
      <div class="w-full md:w-1/2 flex flex-col justify-center items-center">
        <h1 class="text-3xl md:text-4xl font-extrabold text-white my-2 md:my-0"> Sign up </h1>
      </div>
      <div class="w-full md:w-1/2 flex flex-col items-center bg-white py-5 md:py-8 px-4">
        <form action="<?php echo ($admin) ? "./auth/signup.php?admin=$admin" : "./auth/signup.php?admin"; ?> " method="POST" class="px-3 flex flex-col justify-center items-center w-full gap-3">
			<div class="w-full">
				<label for="name" class="font-semibold">Fullname</label>
				<input type="text" name="name" placeholder="Fullname..." id="name" class="mt-2 px-4 py-4 w-full rounded border border-gray-300 shadow-sm text-base placeholder-gray-700  focus:outline-none focus:border-blue-500">
			</div>
			
			<div class="w-full">
				<label for="email" class="font-semibold">Email</label>
				<input type="email" placeholder="Email.." name="email" id="email" class="mt-2 px-4 py-4 w-full rounded border border-gray-300 shadow-sm text-base placeholder-gray-700  focus:outline-none focus:border-blue-500" >
			</div>

			<div class="w-full">
				<label for="name" class="font-semibold">Address</label>
				<input type="text" name="country" placeholder="Address..." id="country" class="mt-2 px-4 py-4 w-full rounded border border-gray-300 shadow-sm text-base placeholder-gray-700  focus:outline-none focus:border-blue-500">
			</div>

			<div class="w-full">
				<label for="phone" class="font-semibold">Phone</label>
				<input type="number" name="phone" placeholder="Phone..." id="phone" class="mt-2 px-4 py-4 w-full rounded border border-gray-300 shadow-sm text-base placeholder-gray-700  focus:outline-none focus:border-blue-500">
			</div>

			<div class="w-full">
				<label for="dob" class="font-semibold">Date of Birth</label>
				<input type="date" name="dob" placeholder="Date of birth..." id="dob" class="mt-2 px-4 py-4 w-full rounded border border-gray-300 shadow-sm text-base placeholder-gray-700  focus:outline-none focus:border-blue-500">
			</div>

			<div class="w-full">
				<label for="gender" class="font-semibold">Gender</label>
				<input type="text" name="gender" id="gender" placeholder="Gender..." class="mt-2 px-4 py-4 w-full rounded border border-gray-300 shadow-sm text-base placeholder-gray-700  focus:outline-none focus:border-blue-500">
			</div>
			<div class="w-full">
				<label for="password" class="font-semibold">Password</label>
				<input type="password" placeholder="password..." name="password" id="password" class="mt-2 px-4 py-4 w-full rounded border border-gray-300 shadow-sm text-base placeholder-gray-700  focus:outline-none focus:border-blue-500" >
			</div>

			<div class="w-full">
				<label for="cpassword" class="font-semibold">Confirm Password</label>
				<input type="password" placeholder="Confirm password.." name="cpassword" id="cpassword" class="mt-2 px-4 py-4 w-full rounded border border-gray-300 shadow-sm text-base placeholder-gray-700  focus:outline-none focus:border-blue-500"
				>
			</div>
			<button type="submit" class="flex justify-center items-center bg-black hover:bg-gray-800 text-white focus:outline-none focus:ring rounded p-4 mt-3">
				<p class="ml-1  text-lg">
				Sign up
				</p>
			</button>
        </form>
        <p class="text-gray-700  mt-5">
          already have an account?
          <a href="./signin.php" class="text-gray-500 hover:text-gray-600 mt-3  focus:outline-none font-bold underline">
            sign in
          </a>
        </p>
      </div>
    </div>
  </div>
<?php include_once './misc/footer.php' ?>
