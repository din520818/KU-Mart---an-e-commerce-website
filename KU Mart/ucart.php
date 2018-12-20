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
						<br>
						<form action="" method="post" enctype="multipart/form-data">
							<table align="center" width="700" bgcolor="skyblue">
								<tr align="center">
									<td colspan="5"><h2>Ordered Items</h2></td>
								</tr>
								
								<tr align="center">
									<th>Remove</th>
									<th> Products</th>
									<th>Total price</th>
								</tr>
								
								<?php
									$total=0;
									global $con;
									$user_id=getLoggedInUser()['user_id'];
									$sel_price="select * from orders where user_id='$user_id'";
									$run_price=mysqli_query($con,$sel_price);
									while($p_price=mysqli_fetch_array($run_price)){
										$pro_id=$p_price['product_id'];
										$pro_price="select * from products where product_id='$pro_id'";
										$run_pro_price=mysqli_query($con,$pro_price);
										while($pp_price=mysqli_fetch_array($run_pro_price)){
											
											$product_price=array($pp_price['product_price']);
											$product_title=$pp_price['product_title'];
											$product_image=$pp_price['product_image'];
											$values=array_sum($product_price);
											$single_price=$pp_price['product_price'];
											$values=array_sum($product_price);
											$total+=$values;
								?>
								
								<tr align="center">
									<td><input type="checkbox" name="remove[]"value="<?php echo $pro_id; ?>"/></td>
									<td><?php echo $product_title; ?><br>
										<img src="admin_area/product_images/<?php echo $product_image;?>" width="60" height="60"/>
									</td>
									<td><?php echo "Rs.". $single_price; ?></td>
								</tr>
								
								<?php } } ?>
								
								
								<tr align="right">
									<td colspan="4"><b>Sub Total: <?php echo "Rs.". $total; ?></b></td>
								</tr>
								
								<br><tr align="center">
									<td colspan="2"><input type="submit" name="update_cart" value="Update Cart"/></td>
									<td><button><a href="index.php" style="text-decoration:none; color:black;">Continue Shopping</a></button></td>
								</tr>
								
							</table>
						</form>
						
						<?php
							$user_id=getLoggedInUser()['user_id'];
							if(isset($_POST['update_cart'])){
								foreach($_POST['remove'] as $remove_id){
								
									$delete_product="delete from orders where product_id='$remove_id' AND user_id='$user_id'";
									$run_delete=mysqli_query($con,$delete_product);
									if($run_delete){
										echo"<script>window.open('ucart.php','_self')</script>";
									}
								}
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
