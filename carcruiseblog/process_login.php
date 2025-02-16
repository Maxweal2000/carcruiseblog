<?php
include("./connect_db.php");

// Declare the passed information from login.php to local script variables
$email = $_POST['email'] ;
$password = $_POST['password'] ;

// Convert the employee password to an encrypted password
$crypted_pass = sha1($password) ;

// Construct the SQL statement and add to the $sql variable, this statement will
// retrieve the user record from the employees table.

// Step 1. - Prepare the SQL statement
$stmt = $db->prepare("select * from users 
						where email = :aa
						and password = :bb
						");

// Step 2. - Execute the SQL statement
$stmt->execute(array(
	":aa" => $email,
	":bb" => $crypted_pass
));

$a_row = $stmt->fetch(PDO::FETCH_ASSOC) ;

// echo "DEBUG: Row details returned: $row <br />" ;
 
	// Check if a row has been found
if ( $a_row['id'] != null )
{
	$cookie_name = "user_id";
	$cookie_value = $a_row['id'] ;
	setcookie($cookie_name, $cookie_value, 0, "/"); // 86400 = 1 day, 0 = expires at session close.

	if ($a_row['email'] != null )
	{
		// Successful user login, now create a cookie for the user
		// The cookie will 'die' when the session is logged out or the browser window closed.
		// Create a session limited cookie (ref: https://www.w3schools.com/php/func_http_setcookie.asp)
		$cookie_name = "email";
		$cookie_value = $a_row['email'] ;
		setcookie($cookie_name, $cookie_value, 0, "/"); // 86400 = 1 day, 0 = expires at session close.
	}
}
else
{
	header('Location: ./login.php') ;
}

	// Output a success message
	include("./header.php");
	echo "<h5>Pleased to have you back...</h5><br />" ;
	echo "<p>Welcome $email, you have successfully logged in.</p>" ;
	echo "<p>Please select an option from the site menu.</p>" ;
	include("./footer.php") ;
	
?>
	<!-- The start of the modal requirement -->
	<div class="modal" tabindex="-1" role="dialog" id="myModal">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" style="color: Maroon;">Cookies</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<p>This site uses cookies to control and enhance the user experience. By continuing to use this site you confirm your acceptance of the cookie.</p>
			<p>Logging out of the site or closing the browser will automatically delete the cookie.</p>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		  </div>
		</div>
	  </div>
	</div>
	<!-- End of the modal requirement -->
