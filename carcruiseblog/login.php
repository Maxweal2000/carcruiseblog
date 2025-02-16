<?php 
// If already logged in then no need to login.
// If 'user' cookie set then already logged in so let the user know

// Before proceeding the 'user' cookie must be set, so do a check.

$cookie_name = "user_id";


if(isset($_COOKIE[$cookie_name])) 
{
    // Cookie user already set, no need to login.
	include("./header.php") ;
    echo "<h5>Steady there, I think you are already logged in ...</h5><br />";
    echo "<p>No worries, you are already logged into this website, please continue by selecting an option from the menu.</p>";
	include("./footer.php") ;

} 
else 
{


	include("./header.php") ; 

	?>

		<p>Welcome to the user login page, enter your details to be able to update your account.</p>
	
		<!-- Use this form to process a user login -->
		<form action="./process_login.php" method="POST">
		  <fieldset class="form-group">
		  
			<!-- Get the customer name to use as the search -->
			<div class="form-group">				
				<label class="form-control-label" for="email" style="font-weight: bold;">Email:</label>
				<input class="form-control" type="text" name="email" id="email" placeholder="Enter email" required>
			</div>	
			
			<!-- Get the users password -->
			<div class="form-group">
				<label class="form-control-label" for="password" style="font-weight: bold;">Password:</label>
				<input class="form-control" type="password" name="password" id="password" placeholder="" >
			</div>
			
		  </fieldset>
		  
		<!-- The form Buttons -->
		<div style="text-align: center;">
			<button class="btn btn-danger" type="submit">Login Now</button>
			<button class="btn btn-danger" type="reset">Start Over</button>
		</div>
	<?php
	include("./footer.php") ; 
}

?>