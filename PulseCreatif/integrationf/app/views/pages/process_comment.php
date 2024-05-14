<?php
require_once '../../controllers/PostC.php'; // Include the PostC class file
require_once '../../models/Post.php'; // Include the Post model file
require_once '../../controllers/CommentC.php'; // Include the PostC class file
require_once '../../models/Comment.php';

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



// Delete comment
if (isset($_GET['delete'])) {
    $id_comment = $_GET['delete'] ?? '';
    if (!empty($id_comment)) {
        $commentC->deleteComment($id_comment);

        // Redirect back to the page after deleting
        header('Location: Post.php'); // Replace 'Reclamation.php' with the appropriate page
        exit();
    } else {
        // Handle invalid or missing ID error
        echo "Invalid or missing ID!";
        exit();
    }
}



// Handle other cases or errors
// You can add search logic here if needed
?>
