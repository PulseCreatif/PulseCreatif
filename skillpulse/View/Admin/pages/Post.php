<?php
require_once '../../../Controller/PostC.php'; // Include the PostC class file
require_once '../../../Model/Post.php'; // Include the Post model file

$postC = new PostC();
$listPosts = []; // Initialize $listPosts array

if (isset($_GET['id'])) {
  $postToEdit = $postC->getPostById($_GET['id']);
}

if (isset($_POST['add']) || isset($_POST['edit'])) {
  // Handling adding or editing posts
  if (isset($_POST['add'])) {
      $post = new Post();
      $post->setTitle($_POST['title']);
      $post->setContentP($_POST['contentP']);
      $post->setAuthor($_POST['author']);
      $post->setDate_created($_POST['date_created']);
      $postC->addPost($post);
  } else if (isset($_POST['edit'])) {
      $post = new Post();
      $post->setId_post($_POST['id_post']);
      $post->setTitle($_POST['title']);
      $post->setContentP($_POST['contentP']);
      $post->setAuthor($_POST['author']);
      $post->setDate_created($_POST['date_created']);
      $postC->updatePost($post);
  }
  // Image handling
  if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
    $imgTmpName = $_FILES['img']['tmp_name'];
    $imgName = $_FILES['img']['name'];
    $imgPath = '../../Uploads/' . $imgName; // Adjust the path to your upload directory
    move_uploaded_file($imgTmpName, $imgPath);

    // Now $imgPath contains the path to the uploaded image, you can store it in your database or use it as needed.
    // Assuming you have access to $post object
    $post->setImg($imgPath); // Set the image path in the $post object

      
      // Update or add post with image
      if (isset($_POST['add'])) {
          $postC->addPost($post);
      } else if (isset($_POST['edit'])) {
          $postC->updatePost($post);
      }
  }
  header('Location: Post.php');
}

if (isset($_POST['search'])) {
  $listPosts = $postC->searchPostsByKeyword($_POST['search_text']);
} else if (isset($_POST['tri'])) {
  $listPosts = $postC->listPosts(); // Assuming this is the intended function for sorting
} else {
  $listPosts = $postC->listPosts();
}




?>






<!DOCTYPE html>
<html lang="en">
<?php include 'Head.php'; ?>
<body class="g-sidenav-show  bg-gray-100">
  <?php include 'sidebar.php'; ?>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

  <?php include 'NavBar.php'; ?>




<!-- Post Table code -->
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6>Posts table</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">ID</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Title</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Content</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Author</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date Created</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Image</th> <!-- New column for image -->
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($listPosts as $post): ?>
                  <tr>
                    <td>
                      <p class="text-xs font-weight-bold mb-0">         <?php echo $post['id_post']; ?>   </p>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="text-secondary text-xs font-weight-bold"><?php echo $post['title']; ?></span>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="text-secondary text-xs font-weight-bold"><?php echo $post['contentP']; ?></span>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="text-secondary text-xs font-weight-bold"><?php echo $post['author']; ?></span>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="text-secondary text-xs font-weight-bold"><?php echo $post['date_created']; ?></span>
                    </td>

                    <td class="align-middle text-center text-sm">
                    <img src="<?php echo $post['img']; ?>" alt="Post Image" width="100"> <!-- Display the image -->

</td>



                    <td class="align-middle">
                      <a href="?edit=<?php echo $post['id_post']; ?>" class="btn btn-sm btn-secondary me-2" data-toggle="tooltip" data-original-title="Edit post">Edit</a>
                      <a href="process_post.php?delete=<?php echo $post['id_post']; ?>" class="btn btn-sm btn-danger" data-toggle="tooltip" data-original-title="Delete post">Delete</a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<!-- Add Post Form -->
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-md-6">
      <!-- Form for adding a new post -->
      <form method="POST" action="process_post.php" enctype="multipart/form-data" onsubmit="return validatePostForm()">
        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input type="text" class="form-control" id="title" name="title" value="">
        </div>
        <div class="mb-3">
          <label for="contentP" class="form-label">Content</label>
          <textarea class="form-control" id="contentP" name="contentP"></textarea>
        </div>
        <div class="mb-3">
          <label for="author" class="form-label">Author</label>
          <input type="text" class="form-control" id="author" name="author" value="">
        </div>
        <div class="mb-3">
          <label for="date_created" class="form-label">Date Created</label>
          <input type="date" class="form-control" id="date_created" name="date_created" value="">
        </div>
        <div class="mb-3">
          <label for="img" class="form-label">Image</label>
          <input type="file" class="form-control" id="img" name="img">
        </div>
        <button type="submit" class="btn btn-primary" name="add">Add Post</button>
      </form>
    </div>
  </div>
</div>


<script>
  function validatePostForm() {
    var title = document.getElementById("title").value;
    var content = document.getElementById("contentP").value;
    var author = document.getElementById("author").value;
    var dateCreated = document.getElementById("date_created").value;

    var errors = [];

    if (title.trim() === "") {
      errors.push("Title is required");
    }

    if (content.trim() === "") {
      errors.push("Content is required");
    }

    if (author.trim() === "") {
      errors.push("Author is required");
    }

    if (dateCreated.trim() === "") {
      errors.push("Date Created is required");
    }

    if (errors.length > 0) {
      // Display error messages
      var errorMessage = errors.join("\n");
      alert(errorMessage);
      return false; // Prevent form submission
    }

    return true; // Allow form submission
  }
</script>





<!-- Form for editing a POST -->
<?php if(isset($_GET['edit'])): ?>
  <?php $postToEdit = $postC->getPostById($_GET['edit']); ?>
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-md-6">
        <form method="POST" action="process_post.php">
          <input type="hidden" name="id" value="<?php echo $postToEdit['id_post']; ?>">
          <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="<?php echo $postToEdit['title']; ?>">
          </div>
          <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" id="content" name="contentP"><?php echo $postToEdit['contentP']; ?></textarea> <!-- Fixed: Changed name="content" to name="contentP" -->
          </div>
          <div class="mb-3">
            <label for="author" class="form-label">Author</label>
            <input type="text" class="form-control" id="author" name="author" value="<?php echo $postToEdit['author']; ?>">
          </div>
          <div class="mb-3">
            <label for="date_created" class="form-label">Date Created</label>
            <input type="date" class="form-control" id="date_created" name="date_created" value="<?php echo $postToEdit['date_created']; ?>">
          </div>
          <button type="submit" class="btn btn-success" name="edit">Update Post</button>
        </form>
      </div>
    </div>
  </div>
<?php endif; ?>



  </main>

  <?php include 'Scripts.php'; ?>

</body>
</html>