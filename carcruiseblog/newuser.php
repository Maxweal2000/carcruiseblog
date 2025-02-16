<?php 
// Display the form if the cookie is NOT set.
$cookie_name = "user_id";

if(!isset($_COOKIE[$cookie_name])) 
{
	include("./header.php") ; 
	?>
	
	
		<h5>Register as a user</h5><br />
		<p>If you want to join us as a user of 'the Little Theatre Company' then please complete the form below.</p>
		<!-- End of the header -->

		<form action="./insert_user.php" method="POST">
			<div class="form-group">			
				<label class="form-control-label" for="id" style="font-weight: bold;">User ID:</label>
				<input class="form-control" type="text" name="id" id="id" value="" readonly>
			</div>
			<div class="form-group">				
				<label class="form-control-label" for="email" style="font-weight: bold;">Email:</label>
				<input class="form-control" type="text" name="email" id="email" placeholder="Enter email" required>
			</div>	
		  <fieldset class="form-group">
			<div class="form-group">				
				<label class="form-control-label" for="first_name" style="font-weight: bold;">Firstname:</label>
				<input class="form-control" type="text" name="first_name" id="first_name" placeholder="Enter forename" required>
			</div>
			<fieldset class="form-group">
			<div class="form-group">				
				<label class="form-control-label" for="last_name" style="font-weight: bold;">Lastname:</label>
				<input class="form-control" type="text" name="last_name" id="last_name" placeholder="Enter surname" required>
			</div>			
			
			<div class="form-group">				
				<label class="form-control-label" for="address1" style="font-weight: bold;">Address Line 1:</label>
				<input class="form-control" type="text" name="address1" id="address1" placeholder="Address line 1" required>
			</div>		
			<div class="form-group">				
				<label class="form-control-label" for="postcode" style="font-weight: bold;">Postcode:</label>
				<input class="form-control" type="text" name="postcode" id="postcode" placeholder="Enter postcode" required>
			</div>	
					
			<div class="form-group">				
				<label class="form-control-label" for="password" style="font-weight: bold;">Password:</label>
				<input class="form-control" type="password" name="password" id="password" placeholder="" required>
			</div>
			
			
		  </fieldset>

		  <!-- The form Button -->
		  <div style="text-align: center;">
			<button class="btn btn-danger" type="submit">Register Details</button>
		  </div>			
		</form>
	
	<?php 
	include("./footer.php") ; 
}
else
{
	include("./header.php") ;
	
	// Cookie is set, no need to register
	?>
	<h5>Hey there existing user - you don't need to register ...</h5><br />
	<p>I think you must have forgotten that you are already a user and logged in at this time, 
	please proceed by selecting an option from the menu.</p>
	<?php
	
	include("./footer.php") ;
}

?>