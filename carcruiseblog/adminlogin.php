<?php
include("./connect_db.php"); // include database connection details

$name = $_POST['name'];
$password = $_POST['password'];

// Retrieve the hashed password from the database for the entered username
$query = "SELECT * FROM roles WHERE name = '$name'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $hashed_Password = $row['crypted_pass'];
    $role_id = $row['1'];

    // Use a password hashing algorithm, such as bcrypt, to compare the entered password to the hashed password in the database
    if (password_verify($password, $hashed_Password)) {
        // Passwords match, user is authenticated
        // Check if the user has admin rights
        if ($role_id == 1) {
            // User has admin rights, set a cookie to indicate that the user is logged in
            setcookie("user", $name, time() + (86400 * 30), "/"); // cookie expires in 30 days

            // Display the admin dashboard
            include("./header.php");
            echo "<h5>Welcome, $name!</h5><br />";
            // Display the admin dashboard options here
            include("./footer.php");
        } else {
            // User does not have admin rights
            include("./header.php");
            echo "<h5>Access Denied</h5><br />";
            echo "<p>You do not have admin rights to access this page.</p>";
            include("./footer.php");
        }
    } else {
        // Passwords do not match
        include("./header.php");
        echo "<h5>Login Failed</h5><br />";
        echo "<p>Incorrect username or password.</p>";
        include("./footer.php");
    }
} else {
    // User not found in the database
    include("./header.php");
    echo "<h5>Login Failed</h5><br />";
    echo "<p>Incorrect username or password.</p>";
    include("./footer.php");
}
?>