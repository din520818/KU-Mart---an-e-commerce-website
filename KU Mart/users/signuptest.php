<?php

require '../functions/functions.php';

if(isset($_POST['username'])){
    if(!isUserLoggedIn()){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $contact_no = $_POST['contact_no'];

        //..$duplicate_user = "select * from users where users.username='$username'";

        //..$user_result = mysqli_query($con,$duplicate_user);

       //.. if(!$user_result){
            $signup_query = "insert into users (username,password,contact_no) values ('$username','$password','$contact_no')";

            $result = mysqli_query($con,$signup_query);

            if($result){
                $user_id = mysqli_insert_id($con);

                loginUser(intval($user_id));

                header("location: ../index.php");
            }
        //..} 
		//..else {
            //..duplicate username
		//..	die("Duplicate user");
        //..}
    }
}

header("location: login.php");

 ?>
