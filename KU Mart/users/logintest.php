<?php

require '../functions/functions.php';

if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user_query = "select * from users where users.username='$username' and users.password='$password' limit 0,1";

    $result = mysqli_query($con,$user_query);

    if($result){
        $user = mysqli_fetch_assoc($result);


        if(is_null($user)){
            header("location: login.php");
        } else {
            //user is found
            $user_id = intval($user['user_id']);
            loginUser($user_id);

            header("location: ../index.php");
        }
    }
}

 ?>
