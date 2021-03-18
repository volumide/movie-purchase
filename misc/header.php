<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
	<title>Film Match</title>
</head>

<body>
<div class="bg-gray-900">
  <div class="px-4 py-6 mx-auto lg:py-8 sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8">
    <div class="relative flex items-center justify-between lg:justify-center lg:space-x-16">
      <ul class="flex items-center hidden space-x-8 lg:flex">
        <li><a href="./" aria-label="Our product" title="Our product" class="font-medium tracking-wide text-gray-100 transition-colors duration-200 hover:text-teal-accent-400">Home</a></li>
        <li><a href="./" aria-label="Our product" title="Our product" class="font-medium tracking-wide text-gray-100 transition-colors duration-200 hover:text-teal-accent-400">Products</a></li>
      </ul>
      <a href="/" aria-label="Company" title="Company" class="inline-flex items-center">
        <svg class="w-8 text-teal-accent-400" viewBox="0 0 24 24" stroke-linejoin="round" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" stroke="currentColor" fill="none">
          <rect x="3" y="1" width="7" height="12"></rect>
          <rect x="3" y="17" width="7" height="6"></rect>
          <rect x="14" y="1" width="7" height="6"></rect>
          <rect x="14" y="11" width="7" height="12"></rect>
        </svg>
        <span class="ml-2 text-xl font-bold tracking-wide text-gray-100 uppercase">Company</span>
      </a>
      <ul class="flex items-center hidden space-x-8 lg:flex">
		  <?php 
			if ($_SESSION) {
				?>
					<li><a href="profile.php?id=<?php echo $_SESSION['id']; ?>" aria-label="profile" title="Profile" class="font-medium tracking-wide text-gray-100 transition-colors duration-200 hover:text-teal-accent-400">Profile</a></li>
					<li><a href="./auth/logout" aria-label="logout" title="Logout" class="font-medium tracking-wide text-gray-100 transition-colors duration-200 hover:text-teal-accent-400">Logout</a></li>
					
				<?php
			}else{
				?>
				<li><a href="./signin.php" aria-label="Sign in" title="Sign in" class="font-medium tracking-wide text-gray-100 transition-colors duration-200 hover:text-teal-accent-400">Sign in</a></li>
					<li><a href="./signup.php" aria-label="Sign up" title="Sign up" class="font-medium tracking-wide text-gray-100 transition-colors duration-200 hover:text-teal-accent-400">Sign up</a></li>
				<?php
			}

		?>
      </ul>
      <!-- Mobile menu -->
      <div class="lg:hidden">
        <button aria-label="Open Menu" title="Open Menu" class="p-2 -mr-1 transition duration-200 rounded focus:outline-none focus:shadow-outline">
          <svg class="w-5 text-gray-600" viewBox="0 0 24 24">
            <path fill="currentColor" d="M23,13H1c-0.6,0-1-0.4-1-1s0.4-1,1-1h22c0.6,0,1,0.4,1,1S23.6,13,23,13z"></path>
            <path fill="currentColor" d="M23,6H1C0.4,6,0,5.6,0,5s0.4-1,1-1h22c0.6,0,1,0.4,1,1S23.6,6,23,6z"></path>
            <path fill="currentColor" d="M23,20H1c-0.6,0-1-0.4-1-1s0.4-1,1-1h22c0.6,0,1,0.4,1,1S23.6,20,23,20z"></path>
          </svg>
        </button>
      </div>
    </div>
  </div>
</div>
<div class="p-6 md:px-0 md:py-16 w-5/6 md:mx-auto">