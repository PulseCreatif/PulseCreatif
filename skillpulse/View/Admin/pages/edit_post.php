<?php
// Include necessary files and classes
require_once 'C:\xampp\htdocs\skillpulse\config.php'; // Assuming you have a config.php file for database connection
require_once 'C:\xampp\htdocs\skillpulse\Model\Post.php';
require_once 'C:\xampp\htdocs\skillpulse\Controller\PostC.php';

// Initialize PostC object
$postC = new PostC();

// Check if the post ID is provided in the URL
if (isset($_GET['id_post'])) {
    $postId = $_GET['id_post'];

    // Retrieve the post details from the database
    $post = $postC->getPostById($postId);

    // Check if the post exists
    if ($post) {
        // Now you have the post details, you can display the edit form
?>
        <!-- HTML form for editing the post -->
        <form method="POST" action="process_post.php">
            <!-- Hidden input field to store the post ID -->
            <input type="hidden" name="id" value="<?php echo $post['id_post']; ?>">
            <!-- Input fields to edit post details -->
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo $post['title']; ?>">
            </div>
            <div class="mb-3">
                <label for="contentP" class="form-label">Content</label>
                <textarea class="form-control" id="contentP" name="contentP"><?php echo $post['contentP']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="author" class="form-label">Author</label>
                <input type="text" class="form-control" id="author" name="author" value="<?php echo $post['author']; ?>">
            </div>
            <div class="mb-3">
                <label for="date_created" class="form-label">Date Created</label>
                <input type="date" class="form-control" id="date_created" name="date_created" value="<?php echo $post['date_created']; ?>">
            </div>
            <button type="submit" class="btn btn-primary" name="edit">Save Changes</button>
        </form>
<?php
    } else {
        // Post not found, display error message or redirect to error page
        echo "Error: Post not found.";
    }
} else {
    // No post ID provided in the URL, display error message or redirect to error page
    echo "Error: Post ID not provided.";
}
?>
