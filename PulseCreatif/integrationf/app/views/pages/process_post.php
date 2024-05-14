<?php
// Include necessary files and classes
require_once '../../controllers/PostC.php'; // Include the PostC class file
require_once '../../models/Post.php';

// Initialize PostC object
$postC = new PostC();

// Add Post
if (isset($_POST['add'])) {
    // Check if all required fields are present
    if (isset($_POST['title'], $_POST['contentP'], $_POST['author'], $_POST['date_created'], $_FILES['img'])) {
        $title = $_POST['title'];
        $contentP = $_POST['contentP'];
        $author = $_POST['author'];
        $date_created = $_POST['date_created'];
        
  // Image handling
    $imgTmpName = $_FILES['img']['tmp_name'];
    $imgName = $_FILES['img']['name'];
    $imgPath = '../uploads/' . $imgName; // Adjust the path to your upload directory
    move_uploaded_file($imgTmpName, $imgPath);

        // Check if any required field is empty
        if (!empty($title) && !empty($contentP) && !empty($author) && !empty($date_created) && !empty($imgPath)) {
            $post = new Post();
            $post->setTitle($title);
            $post->setContentP($contentP);
            $post->setAuthor($author);
            $post->setDate_created($date_created);
            $post->setImg($imgPath); // Set image path in the post object

            $postC->addPost($post);

            // Redirect to the page after adding
            header('Location: Post.php'); // Replace 'Post.php' with the appropriate page
            exit();
        } else {
            echo "All fields are required for adding a post."; // Provide appropriate error handling
            exit();
        }
    } else {
        echo "All fields are required for adding a post."; // Provide appropriate error handling
        exit();
    }
}


// Update Post
if (isset($_POST['edit'])) {
    // Check if all required fields are present
    if (isset($_POST['id'], $_POST['title'], $_POST['contentP'], $_POST['author'], $_POST['date_created'])) {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $contentP = $_POST['contentP'];
        $author = $_POST['author'];
        $date_created = $_POST['date_created'];

        // Check if any required field is empty
        if (!empty($id) && !empty($title) && !empty($contentP) && !empty($author) && !empty($date_created)) {
            $post = new Post();
            $post->setId_post($id);
            $post->setTitle($title);
            $post->setContentP($contentP);
            $post->setAuthor($author);
            $post->setDate_created($date_created);

            $postC->updatePost($post);

            // Redirect to the page after updating
            header('Location: Post.php'); // Replace 'Post.php' with the appropriate page
            exit();
        } else {
            echo "All fields are required for updating a post."; // Provide appropriate error handling
            exit();
        }
    } else {
        echo "All fields are required for updating a post."; // Provide appropriate error handling
        exit();
    }
}


// Delete Post
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    // Check if the ID is present
    if (!empty($id)) {
        $postC->deletePost($id);

        // Redirect back to the page after deleting
        header('Location: Post.php'); // Replace 'Post.php' with the appropriate page
        exit();
    } else {
        echo "Post ID is required for deletion."; // Provide appropriate error handling
        exit();
    }
}





// Handle other cases or errors
// You can add search logic here if needed
?>
