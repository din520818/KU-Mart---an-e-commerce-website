<!DOCTYPE>
<?php
include("functions/functions.php");

?>
<html>
      <head> 
            <title> KU Mart </title>
      <link rel="stylesheet" href="styles/style.css" media="all" />
      </head>
<body>

      <!--Main container starts here-->
	  <div class="main_wrapper">
	  
			<!--Header starts here-->
			<div class="header_wrapper"> 
			
				<a href='index.php'><img id="logo" src="images/logo.jpg"/></a>
				<img id="banner" src="images/ad_banner.gif"/>
		   
		   </div>
		   <!--Header ends here-->
		   
		   <!--Menubar starts here-->
		   <div class="menubar">
				<ul id="menu">
					<li><a href='index.php'>Home</a></li>
					<li><a href="all_products.php">All Products</a></li>
					<li><a href="ucart.php">My Account</a></li>
					<li><a href="users/login.php">Sign up</a></li>
					<li><a href="ucart.php">My Shop</a></li>
					<li><a href="contact.php">Contact us</a></li>
				</ul>
				
				<div id="form">
					<form method="get" action="results.php" enctype="multipart/form-data">
						<input type="text" name="user_query" placeholder="search a product"/>
						<input type="submit" name="search" value="search"/>
					</form>
				
				</div>
		   </div>
		   <!--Menubar ends here-->
			
			<!--Content wrapper starts here-->
           <div class="content_wrapper">
		   
				<div id="sidebar">
					<div id="sidebar_title">Categories</div>
					<ul id="cats">
						<?php 
							getcats();
						?>
					</ul>
					
					<div id="sidebar_title">Brands</div>
					<ul id="cats">
						<?php
							getbrands();
						?>
					</ul>
				
				</div>

				<div id="content_area">
				
					<div id="shopping_cart">
						<span style="float:right; font-size:18px; padding:5px; line-height:40px;">
							Welcome <?php if(isUserLoggedIn()){ echo getLoggedInUser()['username']; } else { echo 'Guest!'; } ?> 
							<b style="color:yellow">||  My Shop:- </b>||  
							Total ordered Items:<?php total_items(); ?>||  
							Total Price:<?php total_price(); ?>||  
							<?php 	if(isUserLoggedIn()){ echo"<a href=users/logout.php>Logout</a>"; } 
									else{ echo"<a href=users/login.php>Login</a>";} 
							?> ||
						</span>
					</div>
					
					<div id="products_box">
						<?php
										$get_pro="select * from products ";
										$run_pro=mysqli_query($con,$get_pro);
										while($row_pro=mysqli_fetch_array($run_pro)){
												$pro_id=$row_pro['product_id'];
												$pro_cat=$row_pro['product_cat'];
												$pro_brand=$row_pro['product_brand'];
												$pro_title=$row_pro['product_title'];
												$pro_price=$row_pro['product_price'];
												$pro_image=$row_pro['product_image'];
												
												echo "
														<div id='single_product'>
															
															<a href='details.php?pro_id=$pro_id'><img src='admin_area/product_images/$pro_image' width='200' height='180' /></a>
															<h3><a href='details.php?pro_id=$pro_id'>$pro_title</a></h3>
															<p><b> Rs. $pro_price </b></p>
														
														</div>
												";
										}
											
						?>
					</div>
					
				</div>

           </div>
		   <!--Content wrapper ends here-->
		   
		   <div id=footer> 
				<h2 style="text-align:center; padding-top:15px;">&copy; 2015 By Eye</h2>
		   </div>

      </div>
	  <!--Main container ends here-->


</body>
</html>