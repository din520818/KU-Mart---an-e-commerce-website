<?php

require 'functions/functions.php';

if(isset($_GET['add_cart'])){
    if(isUserLoggedIn()){
        $product_id = intval($_GET['add_cart']);

        if(isset($_SESSION['cart'])){
            array_push($_SESSION['cart'],$product_id);
        } else {
            $_SESSION['cart'] = [$product_id];
        }
    }
}
header("location: order.php");

 ?>
