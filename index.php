<?php
	require './misc/header.php';
	require_once "./connections/connection.php";
	require_once "./product/productsController.php";
	$dbConnection = ((new Conn))->connect();
	$products = new Products($dbConnection);

	$allProduct = $products->productQUery();
	
	if (is_array($allProduct)) {
		?>
			<div  class="grid gap-10 row-gap-8 sm:row-gap-10 md:grid-cols-3 md:max-w-screen-lg bg-white p-10 sm:mx-auto">
				<?php
					foreach ($allProduct as $product){
						?>
							<div class="flex flex-col transition duration-300 bg-white rounded shadow-sm hover:shadow">
								<div class="relative w-full h-52">
									<img src="https://images.pexels.com/photos/3184305/pexels-photo-3184305.jpeg?auto=compress&amp;cs=tinysrgb&amp;dpr=2&amp;h=750&amp;w=1260" class="object-cover w-full h-full rounded-t" alt="Plan" />
								</div>
								<div class="flex flex-col justify-between flex-grow p-8 border border-t-0 rounded-b">
									<div>
									<div class="text-lg font-semibold"><?php echo $product['title'] ?></div>
									<p class="text-sm text-gray-900">
										<?php echo $product['description'] ?>
									</p>
									<div class="mt-1 mb-4 mr-1 text-3xl font-bold"><?php echo  "$".$product['price'] ?></div>
									<a
									href="product.php?id=<?php echo $product['id'] ?>"
									class="w-full inline-flex items-center text-white justify-center py-6 px-6 font-medium rounded bg-black hover:bg-deep-purple-accent-700 focus:shadow-outline focus:outline-none"
									>
										View
									</a>
								</div>
							</div>
						<?php
					}
				?> 
			</div> 
		<?php
	}
	else echo "<p> $allgenre </p>";
	include_once './misc/footer.php';
?>