<?php 
	include_once './misc/header.php';
	if ($_SESSION) header("Location: ./");
 ?>

  <div class="py-5 w-full flex justify-center items-center">
    <div class="bg-black w-full sm:w-1/2 md:w-9/12 lg:w-1/2 mx-3 md:mx-5 lg:mx-0 shadow-md flex flex-col md:flex-row items-center rounded z-10 overflow-hidden bg-center">
		<div class="w-full md:w-1/2 flex flex-col justify-center items-center">
			<h1 class="text-3xl md:text-4xl font-extrabold text-white my-2 md:my-0"> Sign In </h1>
		</div>
		<div class="w-full md:w-1/2 flex flex-col items-center bg-white py-5 md:py-8 px-4">
			<form action="./auth/signin.php" method="POST" class="px-3 flex flex-col justify-center items-center w-full gap-3">
			<input 
				type="email" placeholder="email.." name="email" id="email"
				class="px-4 py-4 w-full rounded border border-gray-300 shadow-sm text-base placeholder-gray-700  focus:outline-none focus:border-blue-500"
			>
			<input 
				type="password" placeholder="password.." name="password" id="password"
				class="px-4 py-4 w-full rounded border border-gray-300 shadow-sm text-base placeholder-gray-700  focus:outline-none focus:border-blue-500"
			>
			<button type="submit" class="flex justify-center items-center bg-black hover:bg-gray-800 text-white focus:outline-none focus:ring rounded p-4">
				<p class="ml-1  text-lg">
				Sign in
				</p>
			</button>
			</form>
			<p class="text-gray-700  mt-5">
			don't have an account?
			<a href="./signup.php" class="text-gray-500 hover:text-gray-600 mt-3  focus:outline-none font-bold underline">
				register
			</a>
			</p>
		</div>
    </div>
  </div>
<?php include_once './misc/footer.php' ?>