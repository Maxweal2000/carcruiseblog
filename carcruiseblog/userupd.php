<?php 
// Before continuing only logged in users should be able to access the
// customer update form. If the user is logged in then the 'user' cookie
// will be set.

// Display the form if the cookie is set.
$cookie_name = "user_id";

if(isset($_COOKIE[$cookie_name])) 
{
	// Display the form
	include("./header.php") ; 

		// Construct the SQL statement and add to the $sql variable, this statement will
		// retrieve the user record from the customer table.

		// Step 1. - Prepare the SQL statement
		$stmt = $db->prepare("select * from users
						where id = :aa
						");

		// Step 2. - Execute the SQL statement
		$stmt->execute(array(
			":aa" => $_COOKIE[$cookie_name]
		));

		$a_row = $stmt->fetch(PDO::FETCH_ASSOC) ;
	
		echo "<h5>Update your user details .....</h5><br />" ;
		echo "<p>Use this form to update your user details, please re-enter your password in order to proceed.</p>" ;
		?>	
		<form action="./update_user.php" method="post">
			
		  <!-- The name field is a display only field -->
		  <fieldset disabled>
			<!-- Display the customer name -->
			<div class="form-group">				
				<label class="form-control-label" for="id" style="font-weight: bold;">id:</label>
				<input class="form-control" type="text" name="id" id="id" value="<?php echo $a_row['id'] ; ?>" placeholder="" required>
			</div>
			
		  </fieldset>
		  
		  <!-- The remaining fields can be changed -->
		    <fieldset class="form-group">
			<div class="form-group">				
				<label class="form-control-label" for="email" style="font-weight: bold;">Email:</label>
				<input class="form-control" type="text" name="email" id="email" value="<?php echo $a_row['email'] ; ?>" placeholder="" required>
			</div>
			<div class="form-group">				
				<label class="form-control-label" for="fist_name" style="font-weight: bold;">Firstname:</label>
				<input class="form-control" type="text" name="first_name" id="first_name" value="<?php echo $a_row['first_name'] ; ?>" placeholder="" >
			</div>	
			<div class="form-group">				
				<label class="form-control-label" for="last_name" style="font-weight: bold;">Lastname:</label>
				<input class="form-control" type="text" name="last_name" id="last_name" value="<?php echo $a_row['last_name'] ; ?>" placeholder="" >
			</div>	
			<div class="form-group">				
				<label class="form-control-label" for="address1" style="font-weight: bold;">Address Line 1:</label>
				<input class="form-control" type="text" name="address1" id="address1" value="<?php echo $a_row['address1'] ; ?>" placeholder="" >
			</div>			
			<div class="form-group">				
				<label class="form-control-label" for="postcode" style="font-weight: bold;">Postcode:</label>
				<input class="form-control" type="text" name="postcode" id="postcode" value="<?php echo $a_row['postcode'] ; ?>" placeholder="" >
			</div>
			<div class="form-group">				
				<label class="form-control-label" for="password" style="font-weight: bold;">Password:</label>
				<input class="form-control" type="password" name="password" id="password" placeholder="" >
			</div>			
		  </fieldset>
			
			<!-- Cannot change customer name, but still need to pass it to the update_employee.php script. -->
			<input type="hidden" name="id" value="<?php echo $a_row['id'] ; ?>">

		  <!-- The form Button -->
		  <div style="text-align: center;">
			<button class="btn btn-danger" type="submit">Update User Details</button>
		  </div>
			
		</form>
	<?php
	include("./footer.php") ;
}
else
{
	include("./header.php") ;
	
	// No cookie set, not logged in so inform the user
	?>
	<h5>Oops! - You will need to login to access the user update details form ...</h5><br />
	<p>All users of the Local Theatre Company need to login to access the update details form. 
	Please use the menu login option on the menu to the left or click <a href="./login.php">here</a> to login.</p>
	<?php
	include("./footer.php") ;
}
?>