
<?php

// Get form data
$article_id = $_POST["article_id"];
$comment_content = $_POST["comment_content"];
$user_id = $_SESSION["user_id"];

// Insert comment into database
$sql = "INSERT INTO comments (article_id, comment_content, comment_author) VALUES ($article_id, '$comment_content', $user_id)";
if (mysqli_query($conn, $sql)) {
    echo "Comment added successfully.";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close database connection
mysqli_close($conn);

?>




