<?php

require 'functions/functions.php';

if(isUserLoggedIn()){
    $products = $_SESSION['cart'];

    $user_id = getLoggedInUser()['user_id'];

    var_dump($products);

    if(count($products) != 0){
        $order_query = "insert into orders (user_id,product_id) values ";

        for($i = 0;$i < count($products);$i++){
            $order_query .= "(".$user_id.",".$products[$i].")";

            if($i != count($products) - 1){
                $order_query .= ",";
            }
        }

        var_dump($order_query);

        $result = mysqli_query($con,$order_query);

        if($result){
            //..order saved
            $_SESSION['cart'] = [];
			header("location: index.php");
        } else {
            //..order not saved.
        }
    }
}

 ?>
