<!DOCTYPE html>
		<html lang="en">
		<head>
			<meta charset="UTF-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
			<title>Document</title>
		</head>
		<body>
		<div class="flex flex-row h-screen">
			<div class="py-5 pt-6 h-full bg-black flex-none sm:w-1/6 px-5 text-white font-semibold">
				<h2 class="py-6 px-6 font-bold">Admin</h2>
				<ul class="px-6">
					<li class="py-3"><a href="#">Home</a></li>

					<li class="py-3">
						<small class="text-gray-700">genres</small>
						<a href="../genre" class="block py-3">All genre</a> 
						<a href="../genre/create.php" class="block py-3">New genre</a>
					</li>

					<li class="py-3">
						<small class="text-gray-700">products</small>
						<a href="../product" class="block py-3">All Products</a>
						<a href="../product/create.php" class="block py-3">New product</a>
					</li>

					<li class="py-3">
						<small class="text-gray-700">users</small>
						<a href="../filter/users.php" class="block py-3">All users</a>
					</li>
				</ul>
			</div>