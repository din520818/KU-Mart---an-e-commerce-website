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

						<?php
							if(isset($_GET['pro_id'])){

							$product_id=$_GET['pro_id'];
							$get_pro="select * from products where product_id='$product_id'";
							$run_pro=mysqli_query($con,$get_pro);
							while($row_pro=mysqli_fetch_array($run_pro)){
								$pro_id=$row_pro['product_id'];
								$pro_title=$row_pro['product_title'];
								$pro_price=$row_pro['product_price'];
								$pro_image=$row_pro['product_image'];
								$pro_desc=$row_pro['product_desc'];

								echo "
									<div id='single_product'>

										<h3>$pro_title</h3>
										<img src='admin_area/product_images/$pro_image' />
										<p><b> Rs. $pro_price </b></p>
										<p>$pro_desc</p>
										<a href='index.php?pro_id=$pro_id' style=' float:left;'>GO Back</a>
										<a href='cart.php?add_cart=$pro_id'><button style='float:right'>Order Now!</button></a>

								 	</div>
								";
							}
							}
						?>

            <div id="product_comment">
                <?php
                    if(isset($_GET['pro_id'])){
                        $product_id = $_GET['pro_id'];

                        $comment_query = "select * from comment join users on users.user_id = comment.user_id where comment.product_id = $product_id order by comment.comment_id desc";

                        $comment_result = mysqli_query($con,$comment_query);

                        if($comment_result){
                            while($comment = mysqli_fetch_array($comment_result)){
                                $username = $comment['username'];
                                $comment_text = $comment['comment'];

                                echo '<div class="comment">
                                    <a href="#" class="user_link">'.
                                        $username.'
                                    </a>
                                    <p class="comment_text">'.
                                        $comment_text.'
                                    </p>
                                </div>';
                            }
                        }
                    }
                ?>
            </div>

					<form method="POST" action="comment/comment.php">
                            <input type="hidden" name="product_id" value="<?php echo $_GET['pro_id']; ?>">
							<table>
								<tr><td><textarea name="comment" cols="50" rows="5" placeholder="Enter a Comment"></textarea></td></tr>
								<tr><td><input type="submit" value="Comment"></td></tr>
							</table>

						</form>


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
