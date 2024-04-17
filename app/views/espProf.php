<?php
session_start();

if (!isset($_SESSION["user_role"]) or $_SESSION["user_role"] != 3) {
	http_response_code(403);
	header("Location:index.php");
	exit();
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>HTML Education Template</title>
		<link href="https://fonts.googleapis.com/css?family=Lato:700%7CMontserrat:400,600" rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link type="text/css" rel="stylesheet" href="css/style.css"/>


    </head>
	<body>
		<header id="header">
			<div class="container">

				<div class="navbar-header">
					
					<div class="navbar-brand">
						<a class="logo" href="index.php">
							<img src="./img/logo.png" alt="logo">
						</a>
					</div>
					<button class="navbar-toggle">
						<span></span>
					</button>
				</div>
				<nav id="nav">
					<ul class="main-menu nav navbar-nav navbar-right">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="coures.html">Courses</a></li>
                        <li><a href="devoir.html">Devoir</a></li>
                        <li><a href="reclamation.html">Reclamation</a></li>
                        <li><a href="formu.html">Forum</a></li>
						<li><a href="disconnect.php">Se déconnecter</a></li>
					</ul>
				</nav>

			</div>
		</header>
		<div class="hero-area section">

			<!-- Backgound Image -->
			<div class="bg-image bg-parallax overlay" style="background-image:url(./img/page-background.jpg)"></div>
			<!-- /Backgound Image -->

			<div class="container">
				<div class="row">
					<div class="col-md-10 col-md-offset-1 text-center">
						<ul class="hero-area-tree">
							<li><a href="index.php">Home</a></li>
							<li>Contact</li>
						</ul>
						<h1 class="white-text">Get In Touch</h1>

					</div>
				</div>
			</div>

		</div>
		<!-- /Hero-area -->

		

			<!-- container -->
			<div class="container">

				<!-- row -->
				<div class="row">

					<!-- contact form -->
					<div class="container">
                        <div class="row">
                            <div class="col-md-3">
                                            <div class="crud-buttons">
                                                <a href="#" class="create-button">Ajouter un rendu</a>
                                                <a href="#" class="read-button">Lire les rendu</a>
                                                <a href="#" class="update-button">Mise a jour des rendus disponibles</a>
                                                <a href="#" class="delete-button">Suprimer un rendu</a>
        
                                            </div>
                                            
                                       
                                       
                            </div>
                         </div>
                     </div>
                             
					
					

				</div>
				<!-- /row -->

			</div>
			<!-- /container -->

		

		<!-- Footer -->
		<footer id="footer" class="section">

			<!-- container -->
			<div class="container">

				<!-- row -->
				<div class="row">

					
					

				</div>
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
							<span>&copy; Copyright 2018. All Rights Reserved. | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i></span>
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
		<div id='preloader'><div class='preloader'></div></div>
		<!-- /preloader -->


		<!-- jQuery Plugins -->
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
		<script type="text/javascript" src="js/google-map.js"></script>
		<script type="text/javascript" src="js/main.js"></script>
        <script src="script.js"></script>

	</body>
</html> 
