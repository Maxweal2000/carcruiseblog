<?php


$cookie_name = "user_id";

if(!isset($_COOKIE[$cookie_name])) {
    // Cookie user not set, ask user to login.
    include("./header.php");
    echo "<h5>Whoah, you need to login first if you want to logout ...</h5><br />";
    echo "<p>You are not currently logged in.</p>";
    echo "<p>Select the 'Login' option from the 'Site Menu' or click <a href=\"./login.php\">here</a>.</p." ;
    include("./footer.php");

} else {

    // Unset the user cookie (effects the user logout)
    if (isset($_COOKIE[$cookie_name])) {
            unset($_COOKIE[$cookie_name]);
            setcookie($cookie_name, '', time() - 3600, '/'); // empty value and old timestamp
    }

    include("./header.php");
    echo "<h5>Bye for now  ...</h5><br />" ;

    echo "<p>You have successfully logged out of the system.</p>" ;

	include("./footer.php") ;
}
?>