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
					<form method="GET" action="results.php" >
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
						<?php getpro(); ?>
						<?php getcatpro(); ?>
						<?php getbrandpro(); ?>
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
