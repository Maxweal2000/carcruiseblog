<?php
// Database connection data (use for XAMPP local)
$user = "root" ;
$pass = "" ;
$db = "carcruise_blog" ;
$server = "localhost" ;


 ////This is the connection string
$db = new PDO('mysql:host=localhost;dbname=carcruise_blog', $user, $pass);
//Check for any errors
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
