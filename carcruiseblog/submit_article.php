<?php
// Connect to the database
$user = "root" ;
$pass = "" ;
$db = "tltc_blog" ;
$server = "localhost" ;

// This is the connection string
$db = new PDO('mysql:host=localhost;dbname=tltc_blog', $user, $pass);
// Check for any errors
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


// Retrieve the form data
$title = $_POST['title'];
$content = $_POST['content'];

// Save the data to the database
$sql = "INSERT INTO articles (user_Id, role_Id, articles_Post, articles_Detail) VALUES ('1', '2', '$title', '$content')";
if ($conn->query($sql) === TRUE) {
  echo "Article created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>