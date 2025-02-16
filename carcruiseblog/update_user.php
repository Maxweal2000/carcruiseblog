<?PHP
/*
Program Name:	update_user.php
*/
include("./connect_db.php") ;

$cookie_name = "user_id";
$email = $_POST['email'] ;
$first_name = $_POST['first_name'] ;
$last_name = $_POST['last_name'] ;
$address1 = $_POST['address1'] ;
$postcode = $_POST['postcode'] ;
$password = $_POST['password'] ;


// Convert the users password to an encrypted password
$crypted_pass = sha1($password) ;

// Insert the employee into the 'users' table by using a prepare then execute operation


// Now update the details
// Step 1. - Prepare the SQL statement
$stmt = $db->prepare(" UPDATE users SET 
						email = :aa,
						first_name = :bb,
						last_name = :cc, 
						address1 = :dd,
						postcode = :ee, 
                        password = :ff  ,
						update_date = CURRENT_TIMESTAMP,
						update_user = :gg
						WHERE id  = :gg ");
						
// Step 2. - Execute the SQL statement
$stmt->execute(array(
	    ":aa" => $email,
	    ":bb" => $first_name,
	    ":cc" => $last_name,
		":dd" => $address1,
		":ee" => $postcode,
		":ff" => $crypted_pass,
        ":gg" => $_COOKIE[$cookie_name]
));						

// Update completed, return back to the login.php script.
// echo "You have successfully updated your details, select a menu option to continue." ;
header("Location: ./successful_user_update.php") ;
?>