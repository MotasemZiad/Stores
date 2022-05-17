<?php 
    include_once('../dashboard/db/db_connection.php');
    $category_id = $_GET['category_id'];
    $query1 = "SELECT * FROM products WHERE category_id = $category_id";
    $result1 = mysqli_query($connection, $query1);
?>


<!DOCTYPE html>
<html lang="en">
    <?php 
        include_once('shared/head.php');
    ?>
	<body>

        <?php 
            include_once('shared/header.php');
            include_once('shared/nav.php');
			# some updates regarding the fucking master branch
        ?>
		<!-- Section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<div class="col-md-12">
						<div class="section-title text-center">
							<h3 class="title">Related Products</h3>
						</div>
					</div>
                    
                    <?php 
                        while($product = mysqli_fetch_assoc($result1)){
                            echo '
                            <div class="col-md-3 col-xs-6">
                                <div class="product">
                                    <div class="product-img">
                                        <img src=" http://localhost/final_project/dashboard/uploads/images/' . $product['image'] . '" alt="">
                                        <div class="product-label">
                                            <span class="sale">-30%</span>
                                        </div>
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category"> ' . $product['category_id'] . ' Category</p>
                                        <h3 class="product-name"><a href="#">' . $product['name'] . '</a></h3>
                                        <h4 class="product-price"> $' . $product['price'] . '<del class="product-old-price"> $' . $product['first_price'] . '</del></h4>
                                        <div class="product-rating">
                                        </div>
                                        <div class="product-btns">
                                            <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
                                            <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
                                            <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
                                        </div>
                                    </div>
                                    <div class="add-to-cart">
                                        <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
                                    </div>
                                </div>
                            </div>
                            ';
                        }
                    ?>
				
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /Section -->

		<!-- NEWSLETTER -->
		<div id="newsletter" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="newsletter">
							<p>Sign Up for the <strong>NEWSLETTER</strong></p>
							<form>
								<input class="input" type="email" placeholder="Enter Your Email">
								<button class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribe</button>
							</form>
							<ul class="newsletter-follow">
								<li>
									<a href="#"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-twitter"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-instagram"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-pinterest"></i></a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /NEWSLETTER -->

        <?php 
            include_once('shared/footer.php');
            include_once('shared/jquery.php');
        ?>

	</body>
</html>
