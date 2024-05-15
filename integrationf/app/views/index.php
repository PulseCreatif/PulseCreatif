<?php
session_start();

if (!isset($_SESSION["user_role"])) {
	$_SESSION["user_role"] = null;
}

error_reporting(E_ALL);
require_once(__DIR__ . "/../../config/config.php");
require_once(__DIR__ . "/../utils.php");

function select_esp_file()
{
	if ($_SESSION["user_role"] == 0) {
		return "pages/dashboardUser.php";
	} else if ($_SESSION["user_role"] == 1) {
		return "espEtud.php";
	} else if ($_SESSION["user_role"] == 2) {
		return "espEtud_Prem.php";
	} else if ($_SESSION["user_role"] == 3) {
		return "espProf.php";
	}
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
	<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link type="text/css" rel="stylesheet" href="css/style.css" />

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

</head>

<body>

	<header id="header" class="transparent-nav">
		<div class="container">

			<div class="navbar-header">
				<!-- Logo -->
				<div class="navbar-brand">
					<a class="logo" href="index.php">
						<img src="img/logo.png" alt="logo">
					</a>
				</div>
				<button class="navbar-toggle">
					<span></span>
				</button>
			</div>
			<nav id="nav">
				<ul class="main-menu nav navbar-nav navbar-right">
					<li><a href="index.php">Accueil</a></li>
					<?php if (!isset($_SESSION["user_role"])) {
					?>
						<li><a href="signIn.php">Se connecter</a></li>
						<li><a href="addUser.php">Créez votre compte</a></li>
					<?php
					} else {
					?>
						<li><a href="<?= select_esp_file() ?>">Votre Compte</a></li>
						<li><a href="disconnect.php">Se déconnecter</a></li>
					<?php
					}
					?>
					<!--
                        <li><a href="coures.html">Courses</a></li>
                        <li><a href="devoir.html">Devoir</a></li>
                        <li><a href="reclamation.html">Reclamation</a></li>
                        <li><a href="formu.html">Forum</a></li>
		-->
				</ul>
			</nav>

		</div>
	</header>
	<div id="home" class="hero-area">
		<div class="bg-image bg-parallax overlay" style="background-image:url(img/home-background.jpg)"></div>
		<div class="home-wrapper">
			<div class="container">
				<div class="row">
					<div class="col-md-8">
						<h1 class="white-text">SkillPulse Free Online Training Courses</h1>
						<a class="main-button icon-button" href="signIn.php">Get Started!</a>
					</div>
				</div>
			</div>
		</div>

	</div>
	<div id="about" class="section">


		<div class="container">


			<div class="row">

				<div class="col-md-6">
					<div class="section-header">
						<h2>Welcome to SkillPulse</h2>
						<p class="lead">Libris vivendo eloquentiam ex ius, nec id splendide abhorreant.</p>
					</div>


					<div class="feature">
						<i class="feature-icon fa fa-flask"></i>
						<div class="feature-content">
							<h4>Online Courses </h4>
							<p>Ceteros fuisset mei no, soleat epicurei adipiscing ne vis. Et his suas veniam nominati.</p>
						</div>
					</div>

					<div class="feature">
						<i class="feature-icon fa fa-users"></i>
						<div class="feature-content">
							<h4>Expert Teachers</h4>
							<p>Ceteros fuisset mei no, soleat epicurei adipiscing ne vis. Et his suas veniam nominati.</p>
						</div>
					</div>

					<div class="feature">
						<i class="feature-icon fa fa-comments"></i>
						<div class="feature-content">
							<h4>Community</h4>
							<p>Ceteros fuisset mei no, soleat epicurei adipiscing ne vis. Et his suas veniam nominati.</p>
						</div>
					</div>


				</div>

				<div class="col-md-6">
					<div class="about-img">
						<img src="img/about.png" alt="">
					</div>
				</div>

			</div>


		</div>

	</div>

	<div id="courses" class="section">

		<div class="container">

			<div class="row">
				<div class="section-header text-center">
					<h2>Explore Courses</h2>
					<p class="lead">Libris vivendo eloquentiam ex ius, nec id splendide abhorreant.</p>
				</div>
			</div>
			<div id="courses-wrapper">
				<div class="row">

					<div class="col-md-3 col-sm-6 col-xs-6">
						<div class="course">
							<a href="#" class="course-img">
								<img src="img/course01.jpg" alt="">
								<i class="course-link-icon fa fa-link"></i>
							</a>
							<a class="course-title" href="#">Beginner to Pro in Excel: Financial Modeling and Valuation</a>
							<div class="course-details">
								<span class="course-category">Business</span>
								<span class="course-price course-free">Free</span>
							</div>
						</div>
					</div>
					<!-- /single course -->

					<!-- single course -->
					<div class="col-md-3 col-sm-6 col-xs-6">
						<div class="course">
							<a href="#" class="course-img">
								<img src="img/course02.jpg" alt="">
								<i class="course-link-icon fa fa-link"></i>
							</a>
							<a class="course-title" href="#">Introduction to CSS </a>
							<div class="course-details">
								<span class="course-category">Web Design</span>
								<span class="course-price course-premium">Premium</span>
							</div>
						</div>
					</div>
					<!-- /single course -->

					<!-- single course -->
					<div class="col-md-3 col-sm-6 col-xs-6">
						<div class="course">
							<a href="#" class="course-img">
								<img src="img/course03.jpg" alt="">
								<i class="course-link-icon fa fa-link"></i>
							</a>
							<a class="course-title" href="#">The Ultimate Drawing Course | From Beginner To Advanced</a>
							<div class="course-details">
								<span class="course-category">Drawing</span>
								<span class="course-price course-premium">Premium</span>
							</div>
						</div>
					</div>
					<!-- /single course -->

					<div class="col-md-3 col-sm-6 col-xs-6">
						<div class="course">
							<a href="#" class="course-img">
								<img src="img/course04.jpg" alt="">
								<i class="course-link-icon fa fa-link"></i>
							</a>
							<a class="course-title" href="#">The Complete Web Development Course</a>
							<div class="course-details">
								<span class="course-category">Web Development</span>
								<span class="course-price course-free">Free</span>
							</div>
						</div>
					</div>
					<!-- /single course -->

				</div>
				<!-- /row -->

				<!-- row -->
				<div class="row">

					<!-- single course -->
					<div class="col-md-3 col-sm-6 col-xs-6">
						<div class="course">
							<a href="#" class="course-img">
								<img src="img/course05.jpg" alt="">
								<i class="course-link-icon fa fa-link"></i>
							</a>
							<a class="course-title" href="#">PHP Tips, Tricks, and Techniques</a>
							<div class="course-details">
								<span class="course-category">Web Development</span>
								<span class="course-price course-free">Free</span>
							</div>
						</div>
					</div>
					<!-- /single course -->

					<!-- single course -->
					<div class="col-md-3 col-sm-6 col-xs-6">
						<div class="course">
							<a href="#" class="course-img">
								<img src="img/course06.jpg" alt="">
								<i class="course-link-icon fa fa-link"></i>
							</a>
							<a class="course-title" href="#">All You Need To Know About Web Design</a>
							<div class="course-details">
								<span class="course-category">Web Design</span>
								<span class="course-price course-free">Free</span>
							</div>
						</div>
					</div>
					<!-- /single course -->

					<!-- single course -->
					<div class="col-md-3 col-sm-6 col-xs-6">
						<div class="course">
							<a href="#" class="course-img">
								<img src="img/course07.jpg" alt="">
								<i class="course-link-icon fa fa-link"></i>
							</a>
							<a class="course-title" href="#">How to Get Started in Photography</a>
							<div class="course-details">
								<span class="course-category">Photography</span>
								<span class="course-price course-free">Free</span>
							</div>
						</div>
					</div>
					<!-- /single course -->


					<!-- single course -->
					<div class="col-md-3 col-sm-6 col-xs-6">
						<div class="course">
							<a href="#" class="course-img">
								<img src="img/course08.jpg" alt="">
								<i class="course-link-icon fa fa-link"></i>
							</a>
							<a class="course-title" href="#">Typography From A to Z</a>
							<div class="course-details">
								<span class="course-category">Typography</span>
								<span class="course-price course-free">Free</span>
							</div>
						</div>
					</div>
					<!-- /single course -->

				</div>
				<!-- /row -->

			</div>
			<!-- /courses -->

			<div class="row">
				<div class="center-btn">
					<a class="main-button icon-button" href="#">More Courses</a>
				</div>
			</div>

		</div>
		<!-- container -->

	</div>
	<!-- /Courses -->

	<!-- Call To Action -->
	<div id="cta" class="section">

		<!-- Backgound Image -->
		<div class="bg-image bg-parallax overlay" style="background-image:url(img/cta1-background.jpg)"></div>
		<!-- /Backgound Image -->

		<!-- container -->
		<div class="container">

			<!-- row -->
			<div class="row">

				<div class="col-md-6">
					<h2 class="white-text">Ceteros fuisset mei no, soleat epicurei adipiscing ne vis.</h2>
					<p class="lead white-text">Ceteros fuisset mei no, soleat epicurei adipiscing ne vis. Et his suas veniam nominati.</p>
					<a class="main-button icon-button" href="#">Get Started!</a>
				</div>

			</div>
			<!-- /row -->

		</div>
		<!-- /container -->

	</div>
	<!-- /Call To Action -->

	<!-- Why us -->
	<div id="why-us" class="section">

		<!-- container -->
		<div class="container">

			<!-- row -->
			<div class="row">
				<div class="section-header text-center">
					<h2>Why SkillPulse</h2>
					<p class="lead">Libris vivendo eloquentiam ex ius, nec id splendide abhorreant.</p>
				</div>

				<!-- feature -->
				<div class="col-md-4">
					<div class="feature">
						<i class="feature-icon fa fa-flask"></i>
						<div class="feature-content">
							<h4>Online Courses</h4>
							<p>Ceteros fuisset mei no, soleat epicurei adipiscing ne vis. Et his suas veniam nominati.</p>
						</div>
					</div>
				</div>
				<!-- /feature -->

				<!-- feature -->
				<div class="col-md-4">
					<div class="feature">
						<i class="feature-icon fa fa-users"></i>
						<div class="feature-content">
							<h4>Expert Teachers</h4>
							<p>Ceteros fuisset mei no, soleat epicurei adipiscing ne vis. Et his suas veniam nominati.</p>
						</div>
					</div>
				</div>
				<!-- /feature -->

				<!-- feature -->
				<div class="col-md-4">
					<div class="feature">
						<i class="feature-icon fa fa-comments"></i>
						<div class="feature-content">
							<h4>Community</h4>
							<p>Ceteros fuisset mei no, soleat epicurei adipiscing ne vis. Et his suas veniam nominati.</p>
						</div>
					</div>
				</div>
				<!-- /feature -->

			</div>
			<!-- /row -->

			<hr class="section-hr">

			<!-- row -->
			<div class="row">

				<div class="col-md-6">
					<h3>Persius imperdiet incorrupte et qui, munere nusquam et nec.</h3>
					<p class="lead">Libris vivendo eloquentiam ex ius, nec id splendide abhorreant.</p>
					<p>No vel facete sententiae, quodsi dolores no quo, pri ex tamquam interesset necessitatibus. Te denique cotidieque delicatissimi sed. Eu doming epicurei duo. Sit ea perfecto deseruisse theophrastus. At sed malis hendrerit, elitr deseruisse in sit, sit ei facilisi mediocrem.</p>
				</div>

				<div class="col-md-5 col-md-offset-1">
					<a class="about-video" href="#">
						<img src="img/about-video.jpg" alt="">
						<i class="play-icon fa fa-play"></i>
					</a>
				</div>

			</div>
			<!-- /row -->

		</div>
		<!-- /container -->

	</div>
	<!-- /Why us -->

	<!-- Contact CTA -->
	<div id="contact-cta" class="section">

		<!-- Backgound Image -->
		<div class="bg-image bg-parallax overlay" style="background-image:url(img/cta2-background.jpg)"></div>
		<!-- Backgound Image -->

		<!-- container -->
		<div class="container">

			<!-- row -->
			<div class="row">

				<div class="col-md-8 col-md-offset-2 text-center">
					<h2 class="white-text">Contact Us</h2>
					<p class="lead white-text">Libris vivendo eloquentiam ex ius, nec id splendide abhorreant.</p>
					<a class="main-button icon-button" href="#">Contact Us Now</a>
				</div>

			</div>
			<!-- /row -->

		</div>
		<!-- /container -->

	</div>
	<!-- /Contact CTA -->

	<!-- Footer -->
	<footer id="footer" class="section">

		<!-- container -->
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
					<span>&copy; Copyright 2018. All Rights Reserved. | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com">Colorlib</a></span>
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