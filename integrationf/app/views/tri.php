<?php
require_once '..\controllers\PostC.php'; // Include the PostC class file

require_once '..\controllers\CommentC.php';

require_once '..\models\Post.php'; // Include the Post model file

require_once '..\models\Comment.php';


$postC = new PostC();
$listPost = $postC->filterPostsByDateAsc();

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






                </div>
                <!-- /row -->

                <!-- row -->
                <div class="row">

                </div>
                <!-- /row -->
            </div>

				<!-- /main blog -->

				<!-- /aside blog -->

			</div>
			<!-- row -->

		</div>
		<!-- container -->

	</div>
	<!-- /Blog -->

    <?php

    if (isset($listPost) and !empty($listPost)) {
        ?>
    <div> 
        <table border="1" align="center" width="60%">
     <tr>
        <th>id_post</th>
        <th>title</th>
        <th>contentP</th>
        <th>author</th>
        <th>date_created</th>
        <th>img</th>
    </tr>
    <?php
    foreach ($listPost as $post) {
    ?>
        <tr>
            <td><?= $post['id_post']; ?></td>
            <td><?= $post['title']; ?></td>
            <td><?= $post['contentP']; ?></td>
            <td><?= $post['author']; ?></td>
            <td><?= $post['date_created']; ?></td>
            <td><?= $post['img']; ?></td>
        </tr> 
    <?php
    }}
    ?>
  </table>
</div>


    

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