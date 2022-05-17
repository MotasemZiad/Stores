<!-- NAVIGATION -->
<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav">
						<li class="active"><a href="#">Home</a></li>
						<?php 
							include_once('../dashboard/db/db_connection.php');
							$query = 'SELECT * FROM categories WHERE status = 1';
							$result = mysqli_query($connection, $query);
							while ($row = mysqli_fetch_assoc($result)) {
								$category_id = $row['id'];	
								echo "<li><a href='show_products.php?category_id=$category_id'>" . $row['name'] . "</a></li>";
							}
						?>
						<!-- <li><a href="#">Hot Deals</a></li>
						<li><a href="#">Categories</a></li>
						<li><a href="#">Laptops</a></li>
						<li><a href="#">Smartphones</a></li>
						<li><a href="#">Cameras</a></li>
						<li><a href="#">Accessories</a></li> -->
					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
		</div>
        <!-- /container -->
</nav>
<!-- /NAVIGATION -->
