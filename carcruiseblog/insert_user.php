<?php
/*
Program Name:	insert_user.php
*/
include("./connect_db.php") ;
$email = $_POST['email'] ;
$first_name = $_POST ['first_name'] ;
$last_name = $_POST ['last_name'] ;
$address1 = $_POST['address1'] ;
$postcode = $_POST['postcode'] ;
$password = $_POST['password'] ;


// Convert the users password to an encrypted password
$crypted_pass = sha1($password) ;

// Insert the employee into the 'users' table by using a prepare then execute operation

// Step 1. - Prepare the SQL statement
$stmt = $db->prepare("insert into users (email, first_name, last_name, address1, postcode, password, create_user, update_user, role_id) 
						values (:aa, :bb, :cc, :dd, :ee, :ff, get_id_users('admin@example.com'), get_id_users('admin@example.com'), get_id_roles('writer') ) ");

// Step 2. - Execute the SQL statement
$stmt->execute(array(
	":aa" => $email,
	":bb" => $first_name,
	":cc" => $last_name,
	":dd" => $address1,
	":ee" => $postcode,
	":ff" => $crypted_pass
));


// echo "Customer table insert completed, please check with PHPMyAdmin.<br>" ;
header("Location: ./new_user_success.php") ;


?>
