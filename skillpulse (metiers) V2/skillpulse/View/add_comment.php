<?php
// Include necessary files and classes
require_once 'C:\xampp\htdocs\skillpulse\config.php'; // Include the config.php file
require_once 'C:\xampp\htdocs\skillpulse\Controller\CommentC.php'; // Include the CommentC class file
require_once 'C:\xampp\htdocs\skillpulse\Model\Comment.php'; // Include the Comment model file

// Initialize CommentC object
$commentC = new CommentC();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $postId = $_POST['post_id'];
    $authorC = $_POST['authorC'];
    $contentC = $_POST['contentC'];

    // Create a new Comment object
    $comment = new Comment();
    $comment->setId_post($postId);
    $comment->setAuthorC($authorC);
    $comment->setContentC($contentC);

    // Add the comment to the database
    $commentC->addComment($comment);

    // Redirect back to the page after adding the comment
    header('Location: Post.php'); // Replace 'index.php' with the appropriate page
    exit();
}
