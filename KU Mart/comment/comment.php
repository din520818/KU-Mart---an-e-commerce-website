<?php

require('../functions/functions.php');

if(isset($_POST['comment'])){

    if(!isUserLoggedIn()){
        header("location: ../users/login.php");
		//..header('location: '.$_SERVER['HTTP_REFERER']);
    }

    $product_id = intval($_POST['product_id']);
    $comment_text = $_POST['comment'];

    $user = getLoggedInUser();
    $user_id = $user['user_id'];

    $comment_save_query = "insert into comment (user_id,product_id,comment) values ($user_id,$product_id,'$comment_text')";

    $result = mysqli_query($con,$comment_save_query);

    if($result){
		header('location: '.$_SERVER['HTTP_REFERER']);
        //...inserted
    } else {
        //...insert failed
    }
	
}


?>
