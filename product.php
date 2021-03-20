<?php
	include_once './misc/header.php';
	require_once "./connections/connection.php";
	require_once "./product/productsController.php";
	
	$dbConnection = ((new Conn))->connect();
	if (!isset($_GET['id'])) header("Location: index.php");

	$productId = $_GET['id'];
	$currentDate = strval(date('Y-m-d'));
	$session_name = "";
	$message = "";
	$status = "";

	// var_dump($_SESSION);
	if ($_SESSION){
		$session_name = $_SESSION['name'];
		$status = $_SESSION['status'];
	}

	$products = (new Products($dbConnection, $_GET['id']))->productQUery();

	if (isset($_POST['purchase'])) {
		if(!$session_name) $message = "Sign in or Sign up to purchase this product";
		else{
			if ($status === 'yes') $message = "In eligigible to purchase this item";
			else{
				$title = $products['title'];
				$id = $_SESSION['id'];
				$query = "INSERT INTO `purchases` (`user_id`, `product`, `purchase_date`) VALUES ('$id', '$title', '$currentDate' )";
				$message = ($dbConnection->query($query)) ? "Purchase successful" : "Error $dbConnection->error";
				// echo $message;
			}
		}
	}

	if (is_array($products)) {
		$product = $products;
		$cover = $product['cover'];
		?>
			<div class="px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
				<div class="flex flex-col max-w-screen-lg overflow-hidden bg-white border rounded shadow-sm lg:flex-row sm:mx-auto">
					<div class="relative lg:w-1/2">
						<img src=" <?php echo ($product['cover']) ?"product/$cover" : "https://d13ezvd6yrslxm.cloudfront.net/wp/wp-content/images/2018-bestposters-spidermanspiderverse-700x1038.jpg"; ?>" alt="" class="object-cover w-full lg:absolute h-80 lg:h-full" />
						<svg class="absolute top-0 right-0 hidden h-full text-white lg:inline-block" viewBox="0 0 20 104" fill="currentColor">
							<polygon points="17.3036738 5.68434189e-14 20 5.68434189e-14 20 104 0.824555778 104"></polygon>
						</svg>
					</div>
					<div class="flex flex-col justify-center p-8 bg-white lg:p-16 lg:pl-10 lg:w-1/2">
						<div>
							<p class="inline-block px-3 py-px mb-4 text-xs font-semibold tracking-wider text-teal-900 uppercase rounded-full bg-teal-accent-400">
								<?php echo $product['name'] ?>
							
							</p>
						</div>
						<h5  class="mb-3 text-3xl font-extrabold leading-none sm:text-4xl">
							<?php echo $product['title'] ?>
						</h5>
						<p class="mb-5 text-gray-800">
							<?php echo $product['description'] ?>
						</p>
						<p class="mb-5 text-gray-800 text-xl text-blue-700 font-bold">
							<?php echo "$". $product['price'] ?>
						</p>
						<div class="flex items-center">
							<form action="" method="post" class= "">
								<button type="submit"  name="purchase" class="inline-flex items-center justify-center h-12 px-6 mr-6 font-medium bg-black text-white  rounded shadow-md  hover:bg-deep-purple-accent-700 focus:shadow-outline focus:outline-none">
									Purchase
								</button>
							</form>
							<p class="text-white rounded h-12 bg-gray-900 p-3  font-semibold">
								<?php  if ($message) echo $message;  ?>
							</p>
						</div>
					</div>
				</div>
			</div>
		<?php
	}



	include_once './misc/header.php';
?>