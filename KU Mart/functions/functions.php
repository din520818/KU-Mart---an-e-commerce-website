<?php

session_start();

$con = mysqli_connect("localhost","root","","kumart");
if(mysqli_connect_errno())
{
	echo "Failed to connect to MYSQL: " .mysqli_connect_error();
}

//getting the categories

function getcats(){

	global $con;
	$get_cats="select * from categories";
	$run_cats=mysqli_query($con,$get_cats);
	while($row_cats=mysqli_fetch_array($run_cats)){

		$cat_id=$row_cats['cat_id'];
		$cat_title=$row_cats['cat_title'];

		echo"<li><a href='index.php?cat=$cat_id'>$cat_title</a></li>";
	}

}

//getting the brands

function getbrands(){

	global $con;
	$get_brands="select * from brands";
	$run_brands=mysqli_query($con,$get_brands);
	while($row_brands=mysqli_fetch_array($run_brands)){

		$brand_id=$row_brands['brand_id'];
		$brand_title=$row_brands['brand_title'];

		echo"<li><a href='index.php?brand=$brand_id'>$brand_title</a></li>";
	}

}

function getpro(){

	if(!isset($_GET['cat'])){
		if(!isset($_GET['brand'])){
			global $con;
			$get_pro="select * from products order by RAND() LIMIT 0,12";
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
		}
	}
}

function getcatpro(){

	if(isset($_GET['cat'])){
					$cat_id=$_GET['cat'];
					global $con;
					$get_cat_pro="select * from products where product_cat='$cat_id'";
					$run_cat_pro=mysqli_query($con,$get_cat_pro);
					$count_cats=mysqli_num_rows($run_cat_pro);
					if($count_cats==0){
						echo "<p><b style='text-align:center;'>No Products Available.</b></p>";
					}
					while($row_cat_pro=mysqli_fetch_array($run_cat_pro)){
							$pro_id=$row_cat_pro['product_id'];
							$pro_cat=$row_cat_pro['product_cat'];
							$pro_brand=$row_cat_pro['product_brand'];
							$pro_title=$row_cat_pro['product_title'];
							$pro_price=$row_cat_pro['product_price'];
							$pro_image=$row_cat_pro['product_image'];

							echo "
									<div id='single_product'>

										<a href='details.php?pro_id=$pro_id'><img src='admin_area/product_images/$pro_image' width='200' height='180' /></a>
										<h3><a href='details.php?pro_id=$pro_id'>$pro_title</a></h3>
										<p><b> Rs. $pro_price </b></p>

									</div>
							";

					}
	}
}

function getbrandpro(){

	if(isset($_GET['brand'])){
					$brand_id=$_GET['brand'];
					global $con;
					$get_brand_pro="select * from products where product_brand='$brand_id'";
					$run_brand_pro=mysqli_query($con,$get_brand_pro);
					$count_brands=mysqli_num_rows($run_brand_pro);
					if($count_brands==0){
						echo "<p><b style='text-align:center;'>No Products Available.</b></p>";
					}
					while($row_brand_pro=mysqli_fetch_array($run_brand_pro)){
							$pro_id=$row_brand_pro['product_id'];
							$pro_cat=$row_brand_pro['product_cat'];
							$pro_brand=$row_brand_pro['product_brand'];
							$pro_title=$row_brand_pro['product_title'];
							$pro_price=$row_brand_pro['product_price'];
							$pro_image=$row_brand_pro['product_image'];

							echo "
									<div id='single_product'>

										<a href='details.php?pro_id=$pro_id'><img src='admin_area/product_images/$pro_image' width='200' height='180' /></a>
										<h3><a href='details.php?pro_id=$pro_id'>$pro_title</a></h3>
										<p><b> Rs. $pro_price </b></p>

									</div>
							";

					}
	}
}

function isUserLoggedIn(){
	return isset($_SESSION['user_id']);
}

function getLoggedInUser(){
	global $con;

	if(isUserLoggedIn()){
		$user_id = intval($_SESSION['user_id']);
		$user_query = "select * from users where users.user_id=$user_id limit 0,1";
		$result = mysqli_query($con,$user_query);

	    if($result){
	        $user = mysqli_fetch_assoc($result);
			return $user;
	    }
	}
	return null;
}

function loginUser($user_id){
	$_SESSION['user_id'] = $user_id;
}

//getting the total ordered items

function total_items(){
	
		if(isset($_GET['add_cart'])){
		
			global $con;
			$user_id=getLoggedInUser();
			$get_items="select * from orders where user_id='$user_id'";
			$run_items=mysqli_query($con, $get_items);
			$count_items=mysqli_num_rows($run_items);
		}
		else{
			global $con;
			$user_id=getLoggedInUser()['user_id'];
			$get_items="select * from orders where user_id='$user_id'";
			$run_items=mysqli_query($con, $get_items);
			$count_items=mysqli_num_rows($run_items);
		}
		echo $count_items;
		
	}
	
//getting the total price of the items

function total_price(){
	
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
			$values=array_sum($product_price);
			$total+=$values;
		
		}
	}
	echo "Rs. ". $total;
}

?>
