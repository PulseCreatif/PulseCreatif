<?php
require_once '../../../Controller/PostC.php'; // Include the PostC class file
require_once '../../../Model/Post.php'; // Include the Post model file

require_once '../../../Controller/CommentC.php'; // Include the PostC class file
require_once '../../../Model/Comment.php'; // Include the Post model file

$postC = new PostC();
$commentC = new CommentC();

$listPosts = []; // Initialize $listPosts array
$listComments = [];
$listPosts = $postC->listPosts();
$listComments = $commentC->listComments();



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
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Title
                      </th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Content</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Author</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date Created</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Image</th>
                      <!-- New column for image -->
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($listPosts as $post): ?>
                      <tr>
                        <td>
                          <p class="text-xs font-weight-bold mb-0"><?php echo $post['id_post']; ?></p>
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
                          <span
                            class="text-secondary text-xs font-weight-bold"><?php echo $post['date_created']; ?></span>
                        </td>

                        <td class="align-middle text-center text-sm">
                          <img src="<?php echo $post['img']; ?>" alt="Post Image" width="100">
                          <!-- Display the image -->
                        </td>

                        <td class="align-middle">
                          <a href="edit_post.php?id_post=<?php echo $post['id_post']; ?>"
                            class="btn btn-sm btn-secondary me-2" data-toggle="tooltip"
                            data-original-title="Edit">Edit</a>
                          <a href="process_post.php?delete=<?php echo $post['id_post']; ?>" class="btn btn-sm btn-danger"
                            data-toggle="tooltip" data-original-title="Delete">Delete</a>
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
          <form method="POST" action="process_post.php" enctype="multipart/form-data"
            onsubmit="return validatePostForm()">
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

        // Regular expression to match only letters
        var lettersRegex = /^[a-zA-Z]+$/;

        // Regular expression to match letters and numbers
        var alphanumericRegex = /^[a-zA-Z0-9]+$/;

        if (!title.match(lettersRegex)) {
          errors.push("Title should contain only letters");
        }

        if (!content.match(lettersRegex)) {
          errors.push("Content should contain only letters");
        }

        if (!author.match(alphanumericRegex)) {
          errors.push("Author should contain only letters and numbers");
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




<!-- Comment Table code -->
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Comments table</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Comment Ref</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Post</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Author</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Content</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($listComments as $comment): ?>
                                    <tr>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0"><?php echo $comment['id_comment']; ?></p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="text-secondary text-xs font-weight-bold"><?php echo $comment['post_title']; ?></span>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="text-secondary text-xs font-weight-bold"><?php echo $comment['authorC']; ?></span>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="text-secondary text-xs font-weight-bold"><?php echo $comment['contentC']; ?></span>
                                        </td>

                                        <td class="align-middle">
                                    
                                            <a href="process_comment.php?delete=<?php echo $comment['id_comment']; ?>" class="btn btn-sm btn-danger" data-toggle="tooltip" data-original-title="Delete">
                                                Delete
                                            </a>
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





<!-- Add Comment Form -->
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-md-6">
      <!-- Form for adding a new comment -->
      <form method="POST" action="process_comment.php" enctype="multipart/form-data" >

      <div class="mb-3">
          <label for="post_title" class="form-label">Post Title</label>
          <select class="form-control" id="post_title" name="id_post">
            <?php foreach ($listPosts as $post): ?>
              <option value="<?php echo $post['id_post']; ?>"><?php echo $post['title']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="mb-3">
          <label for="author" class="form-label">Author</label>
          <input type="text" class="form-control" id="author" name="author" value="">
        </div>


        <div class="mb-3">
          <label for="contentC" class="form-label">Content</label>
          <textarea class="form-control" id="contentC" name="contentC"></textarea>
        </div>
      
   
        <button type="submit" class="btn btn-primary" name="add_comment">Add Comment</button>
      </form>
    </div>
  </div>
</div>






  </main>

  <?php include 'Scripts.php'; ?>

</body>

</html>