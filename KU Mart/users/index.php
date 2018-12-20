<?php

require("../functions/functions.php");

if(!isUserLoggedIn()){
    header("location: login.php");
}

 ?>

 <!DOCTYPE html>
 <html>
     <head>
         <meta charset="utf-8">
         <title>User</title>
     </head>
     <body>
         User Area
     </body>
 </html>
