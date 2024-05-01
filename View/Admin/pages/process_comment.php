<?php
require_once 'C:\xampp\htdocs\skillpulse\config.php'; 
require_once 'C:\xampp\htdocs\skillpulse\Controller\CommentC.php'; 
require_once 'C:\xampp\htdocs\skillpulse\Model\Comment.php'; 
require_once 'C:\xampp\htdocs\skillpulse\Model\Post.php'; // Include the Post model file
require_once 'C:\xampp\htdocs\skillpulse\Controller\PostC.php'; 

// Initialize CommentC object
$commentC = new CommentC();
$postC = new PostC();

// Add Comment
if (isset($_POST['add_comment'])) {
    // Check if all required fields are present
    if (isset($_POST['id_post'], $_POST['author'], $_POST['contentC'])) {
        $id_post = $_POST['id_post'];
        $authorC = $_POST['author'];
        $contentC = $_POST['contentC'];

        // Check if any required field is empty
        if (!empty($id_post) && !empty($authorC) && !empty($contentC)) {
            // Validate if the post with the provided id_post exists
            $post = new Post(); // Assuming you have a method to get post details by id
            $existingPost = $postC->getPostById($id_post);
            if ($existingPost) {
                $comment = new Comment();
                $comment->setId_post($id_post);
                $comment->setAuthorC($authorC);
                $comment->setContentC($contentC);

                $commentC->addComment($comment);

                // Redirect to the page after adding
                header('Location: Post.php'); // Replace 'index.php' with the appropriate page
                exit();
            } else {
                echo "The specified post does not exist."; 
                exit();
            }
        } else {
            echo "All fields are required for adding a comment."; 
            exit();
        }
    } else {
        echo "All fields are required for adding a comment."; 
        exit();
    }
}

// Handle other cases or errors
// You can add search logic here if needed
?>
