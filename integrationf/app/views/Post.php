<?php

session_start();

if (!isset($_SESSION["user_role"])) {
    $_SESSION["user_role"] = null;
    header("Location: index.php");
}

require_once '..\controllers\PostC.php'; // Include the PostC class file

require_once '..\controllers\CommentC.php';

require_once '..\models\Post.php'; // Include the Post model file

require_once '..\models\Comment.php';


$postC = new PostC();
$commentC = new CommentC();





// Check if the search form is submitted
if (isset($_POST['search'])) {
    // Get the search keyword
    $keyword = $_POST['keyword'];

    // Perform the search
    $listPosts = $postC->searchPostsByKeyword($keyword);
} else {
    // If search form is not submitted, show all posts
    $listPosts = $postC->listPosts();
}

$Post = new Post();
$listComments = $commentC->listComments();
$Comment = new Comment();
$commentsWithCount = $commentC->listCommentsWithCount();


?>






<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>HTML Education Template</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Lato:700%7CMontserrat:400,600" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="css/font-awesome.min.css">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="css/style.css" />



	<style>
		.small-logo {
			width: 30px;
			/* Adjust the width as needed */
			height: auto;
			/* Maintain aspect ratio */

			transform: scale(3);/
		}
	</style>



</head>

<body>

	<!-- Header -->
	<header id="header">
		<div class="container">

			<div class="navbar-header">
				<!-- Logo -->
				<div class="navbar-brand">
					<a class="logo" href="index.html">
						<img src="./img/logo.png" alt="logo" class="small-logo">>
					</a>
				</div>
				<!-- /Logo -->

				<!-- Mobile toggle -->
				<button class="navbar-toggle">
					<span></span>
				</button>
				<!-- /Mobile toggle -->
			</div>

			<!-- Navigation -->
			<nav id="nav">
				<ul class="main-menu nav navbar-nav navbar-right">
					<li><a href="index.html">Home</a></li>
					<li><a href="#">About</a></li>
					<li><a href="#">Courses</a></li>
					<li><a href="Reclamation.php">Reclamation</a></li>
					<li><a href="Post.php">Post</a></li>
					<li><a href="contact.html">Contact</a></li>
				</ul>
			</nav>
			<!-- /Navigation -->

		</div>
	</header>
	<!-- /Header -->

	<!-- Hero-area -->
	<div class="hero-area section">

		<!-- Backgound Image -->
		<div class="bg-image bg-parallax overlay" style="background-image:url(./img/page-background.jpg)"></div>
		<!-- /Backgound Image -->

		<div class="container">
			<div class="row">
				<div class="col-md-10 col-md-offset-1 text-center">
					<ul class="hero-area-tree">
						<li><a href="index.html">Home</a></li>
						<li>Posts</li>
					</ul>
					<h1 class="white-text">Posts Page</h1>

				</div>
			</div>
		</div>

	</div>
	<!-- /Hero-area -->

<!-- Blog -->
<div id="blog" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- main blog -->
            <div id="main" class="col-md-9">
                <!-- row -->
                <div class="row">


				<!-- Search form -->
<form method="POST" action="">
    <input type="text" name="keyword" placeholder="Search posts...">
    <button type="submit" name="search">Search</button>
</form>




				<?php foreach ($listPosts as $post): ?>
    <!-- single blog -->
    <div class="col-md-6">
        <div class="single-blog">
            <div class="blog-img">
                <!-- Adjusting the image path by prepending the base path -->
                <?php
                // Adjust the image path for the current post
                $imagePathFromDatabase = $post['img']; // Assuming 'img' is the key for the image path in each post array

                // Remove the "../../Uploads/" prefix and extract the filename
                $filename = basename($imagePathFromDatabase);

                // Construct the adjusted image path by concatenating the new base path and the filename
                $adjustedImagePath = 'Uploads/' . $filename;
                ?>
                <img src="<?php echo $adjustedImagePath; ?>" alt="Post Image" width="100">
            </div>
            <h4><a><?php echo $post['title']; ?></a></h4>
            <div class="blog-meta">
                <span class="blog-meta-author">By: <a href="#"><?php echo $post['author']; ?></a></span>
                <div class="pull-right">
                    <span><?php echo $post['date_created']; ?></span>
                    <!-- Assuming you have a field for date_created in your database -->
                </div>
            </div>


<!-- Display comments -->
<div class="blog-comments">
    <?php
    // Find the comment count for the current post
    $commentCount = getCommentCount($post['id_post'], $commentsWithCount);
    ?>
    <h5>Comments: <?php echo $commentCount; ?></h5> <!-- Display the number of comments -->
    <?php foreach ($listComments as $comment): ?>
        <?php if ($comment['id_post'] == $post['id_post']): ?>
            <div class="comment">
                <span class="comment-author"> Author :
                    <?php echo $comment['USER_NAME']; ?>:</span>
                <p><?php echo $comment['contentC']; ?></p>
                <!-- Voting stars -->
                <div class="stars" data-comment-id="<?php echo $comment['id_comment']; ?>">
                    <span class="star" data-value="1">★</span>
                    <span class="star" data-value="2">★</span>
                    <span class="star" data-value="3">★</span>
                    <span class="star" data-value="4">★</span>
                    <span class="star" data-value="5">★</span>
                </div>
                <!-- Display vote count -->
                <p class="vote-count">Vote Count: <span class="comment-vote-count"><?php echo isset($comment['vote_count']) ? $comment['vote_count'] : 0; ?></span></p>
                <!-- Button to save vote -->
                <button class="save-vote-btn">Save Vote</button>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>



<script>
    // Add event listener to the save vote button
    document.querySelectorAll('.save-vote-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            var comment = button.closest('.comment');
            var commentId = comment.querySelector('.stars').getAttribute('data-comment-id');
            var voteCountElement = comment.querySelector('.comment-vote-count');
            var currentVoteCount = parseInt(voteCountElement.textContent);

            // Simulate saving vote to the server
            // You can replace this with an AJAX call to save the vote to the server
            // Here, I'm just incrementing the vote count for demonstration purposes
            var newVoteCount = currentVoteCount + 1;
            voteCountElement.textContent = newVoteCount;
        });
    });
</script>


<script>
    // Function to handle voting when a star is clicked
    function voteComment(commentId, value) {
        // You can implement the voting logic here
        console.log("Voted for comment with ID", commentId, "and value", value);
        // Here you can make an AJAX request to send the vote to the server if needed
        // Example AJAX request (replace with your actual endpoint)
        // $.post('save_vote.php', { comment_id: commentId, value: value }, function(response) {
        //     console.log(response);
        // });
    }

    // Attach event listeners to stars
    document.querySelectorAll('.stars .star').forEach(star => {
        star.addEventListener('click', function() {
            let commentId = this.parentNode.getAttribute('data-comment-id');
            let value = this.getAttribute('data-value');
            // Update the appearance of stars based on the selected value
            this.parentNode.querySelectorAll('.star').forEach(star => {
                if (parseInt(star.getAttribute('data-value')) <= value) {
                    star.classList.add('selected');
                } else {
                    star.classList.remove('selected');
                }
            });
        });
    });

    // Attach event listener to save vote button
    document.querySelectorAll('.save-vote-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            let commentId = this.parentNode.querySelector('.stars').getAttribute('data-comment-id');
            let selectedValue = this.parentNode.querySelector('.stars .selected').getAttribute('data-value');
            voteComment(commentId, selectedValue);
            // Increment vote count display
            let voteCountElem = this.parentNode.querySelector('.vote-count');
            let currentCount = parseInt(voteCountElem.textContent.split(': ')[1]);
            voteCountElem.textContent = "Vote Count: " + (currentCount + 1);
        });
    });
</script>

<style>
    .star {
        cursor: pointer;
    }
    .selected {
        color: gold;
    }
</style>


            <!-- Add comment form -->
            <div class="add-comment">
                <h5>Add Comment:</h5>
				<form action="add_comment.php" method="POST">
                    <input type="hidden" name="post_id" value="<?php echo $post['id_post']; ?>">
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="authorC" value="<?php echo $_SESSION["user_id"]; ?>">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="contentC" rows="3" placeholder="Your Comment"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <!-- /single blog -->
<?php endforeach; ?>

<?php

// Function to get the comment count for a specific post
function getCommentCount($postId, $commentsWithCount) {
    foreach ($commentsWithCount as $commentCount) {
        if ($commentCount['id_post'] == $postId) {
            return $commentCount['comment_count'];
        }
    }
    return 0; // Return 0 if no comments found
}
?>


                </div>
                <!-- /row -->

                <!-- row -->
                <div class="row">

                </div>
                <!-- /row -->
            </div>

				<!-- /main blog -->

				<!-- aside blog -->
				<div id="aside" class="col-md-3">

					<!-- search widget -->
					<div class="widget search-widget">
						<form>
							<input class="input" type="text" name="search">
							<button><i class="fa fa-search"></i></button>
						</form>
					</div>
					<!-- /search widget -->

					<!-- category widget -->
					<div class="widget category-widget">
						<h3>Categories</h3>
						<a class="category" href="#">Web <span>12</span></a>
						<a class="category" href="#">Css <span>5</span></a>
						<a class="category" href="#">Wordpress <span>24</span></a>
						<a class="category" href="#">Html <span>78</span></a>
						<a class="category" href="#">Business <span>36</span></a>
					</div>
					<!-- /category widget -->

					<!-- posts widget -->
					<div class="widget posts-widget">
						<h3>Recents Posts</h3>

						<!-- single posts -->
						<div class="single-post">
							<a class="single-post-img" href="blog-post.html">
								<img src="./img/post01.jpg" alt="">
							</a>
							<a href="blog-post.html">Pro eu error molestie deserunt.</a>
							<p><small>By : John Doe .18 Oct, 2017</small></p>
						</div>
						<!-- /single posts -->


					</div>
					<!-- /posts widget -->

					<!-- tags widget -->
					<div class="widget tags-widget">
						<h3>Tags</h3>
						<a class="tag" href="#">Web</a>
						<a class="tag" href="#">Photography</a>
						<a class="tag" href="#">Css</a>
						<a class="tag" href="#">Responsive</a>
						<a class="tag" href="#">Wordpress</a>
						<a class="tag" href="#">Html</a>
						<a class="tag" href="#">Website</a>
						<a class="tag" href="#">Business</a>
					</div>
					<!-- /tags widget -->

				</div>
				<!-- /aside blog -->

			</div>
			<!-- row -->

		</div>
		<!-- container -->

	</div>
	<!-- /Blog -->

	<!-- Footer -->
	<footer id="footer" class="section">

		<!-- container -->
		<div class="container">

			<!-- row -->
			<div class="row">

				<!-- footer logo -->
				<div class="col-md-6">
					<div class="footer-logo">
						<a class="logo" href="index.html">
							<img src="./img/logo.png" alt="logo" class="small-logo">>
						</a>
					</div>
				</div>
				<!-- footer logo -->

				<!-- footer nav -->
				<div class="col-md-6">
					<ul class="footer-nav">
						<li><a href="index.html">Home</a></li>
						<li><a href="#">About</a></li>
						<li><a href="#">Courses</a></li>
						<li><a href="blog.html">Blog</a></li>
						<li><a href="contact.html">Contact</a></li>
					</ul>
				</div>
				<!-- /footer nav -->

			</div>
			<!-- /row -->

			<!-- row -->
			<div id="bottom-footer" class="row">

				<!-- social -->
				<div class="col-md-4 col-md-push-8">
					<ul class="footer-social">
						<li><a href="#" class="facebook"><i class="fa fa-facebook"></i></a></li>
						<li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
						<li><a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a></li>
						<li><a href="#" class="instagram"><i class="fa fa-instagram"></i></a></li>
						<li><a href="#" class="youtube"><i class="fa fa-youtube"></i></a></li>
						<li><a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
					</ul>
				</div>
				<!-- /social -->

				<!-- copyright -->
				<div class="col-md-8 col-md-pull-4">
					<div class="footer-copyright">
						<span>&copy; Copyright 2018. All Rights Reserved. | This template is made with <i
								class="fa fa-heart-o" aria-hidden="true"></i> by <a
								href="https://colorlib.com">Colorlib</a></span>
					</div>
				</div>
				<!-- /copyright -->

			</div>
			<!-- row -->

		</div>
		<!-- /container -->

	</footer>
	<!-- /Footer -->

	<!-- preloader -->
	<div id='preloader'>
		<div class='preloader'></div>
	</div>
	<!-- /preloader -->


	<!-- jQuery Plugins -->
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/main.js"></script>

</body>

</html>