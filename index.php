<?php
	require './misc/header.php';
	require_once "./connections/connection.php";
	require_once "./product/productsController.php";
	$dbConnection = ((new Conn))->connect();
	$products = new Products($dbConnection);

	$allProduct = $products->productQUery();
	if (is_array($allProduct)) {
		?>
			<div  class="grid gap-5  md:grid-cols-4 sm:grid-cols-2 bg-white p-10 sm:mx-auto">
				<?php
					foreach ($allProduct as $product){
						$cover = $product['cover'];
						?>
							<div class="flex flex-col transition duration-300 bg-white rounded shadow-sm hover:shadow">
								<div class="relative w-full h-52">
									<div class="relative w-full">
										<div style="height: 250px; object-fit:cover; overflow:hidden;">
											<img src=" <?php echo ($product['cover']) ?"product/$cover" : "https://d13ezvd6yrslxm.cloudfront.net/wp/wp-content/images/2018-bestposters-spidermanspiderverse-700x1038.jpg"; ?> " class="object-cover h-full w-full h-100 rounded-t" alt="Plan" />
										</div>
									</div>
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