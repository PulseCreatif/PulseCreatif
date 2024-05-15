<?php
session_start();

if (!isset($_SESSION["user_role"]) or $_SESSION["user_role"] != 2) {
	http_response_code(403);
	header("Location:index.php");
	exit();
}
include '../controllers/CoursC.php';
include '../models/cours.php';
$CoursC = new CoursC();
$course_names = $CoursC->getCoursesNames();

// Initialize filter options
$filter_options = array();

// Check if any course checkboxes are selected
$course_filter_selected = false;
foreach ($course_names as $course_name) {
	if (isset($_GET['course_' . $course_name])) {
		$course_filter_selected = true;
		// Set filter option for the selected course name
		$filter_options['course_' . $course_name] = true;
	}
}

// Check which type options are selected
if (isset($_GET['type_free'])) {
	$filter_options['type_free'] = true;
}
if (isset($_GET['type_premium'])) {
	$filter_options['type_premium'] = true;
}

// Perform the filtered search
if ($course_filter_selected || isset($filter_options['type_free']) || isset($filter_options['type_premium'])) {
	// If any course checkbox is selected or type options are selected, perform the filtered search
	$tab = $CoursC->searchCours($filter_options, $course_names);
} else {
	// If no filter options are selected, display all courses
	$tab = $CoursC->listcours();
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
					<li><a href="index.php">Accueil</a></li>
					<li><a href="dashboardFront.php">Dashboard</a></li>

					<li><a href="gemini.php">ChatBot</a></li>
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



	<!-- /Hero-area -->

	<!-- Courses -->
	<div id="courses" class="section">
		<div class="container">
			<div class="row">

				<!-- Sidebar -->
				<div id="aside" class="col-md-3 pull-right">
					<!-- Filter widget -->
					<div class="widget filter-widget">
						<form method="GET" action="">
							<h4>Type de Cours</h4>
							<input type="checkbox" name="type_free" id="type_free" value="0">
							<label for="type_free">Gratuit</label>
							<br>
							<input type="checkbox" name="type_premium" id="type_premium" value="1">
							<label for="type_premium">Payant</label>

							<h4>Nom de Cours</h4>

							<?php foreach ($course_names as $course_name) { ?>
								<input type="checkbox" name="course_<?php echo $course_name; ?>" id="course_<?php echo $course_name; ?>" value="<?php echo $course_name; ?>">
								<label for="course_<?php echo $course_name; ?>"><?php echo $course_name; ?></label>
								<br>
							<?php } ?>


							<button type="submit" class="main-button icon-button">Filtres</button>
						</form>
					</div>
					<!-- /Filter widget -->
				</div>
				<!-- /Sidebar -->

				<!-- Courses Content -->
				<div class="col-md-9">
					<!-- courses -->
					<div id="courses-wrapper">
						<!-- row -->
						<div class="row">
							<!-- single course -->
							<?php foreach ($tab as $cours) {
							?>
								<div class="col-md-3 col-sm-6 col-xs-6">
									<div class="course">
										<a href="#" class="course-img">
											<img src="img/course01.jpg" alt="">
											<i class="course-link-icon fa fa-link"></i>
										</a>
										<a class="course-title" href="#"><?= $cours['Nom_cours'] ?></a>
										<div class="course-details">
											<span class="course-category"><?= $cours['Nbr_heures']; ?> h</span>
											<?php if ($cours['Type_cours'] == 1) { ?>
												<span class="course-price course-premium">Payant</span>
											<?php } else { ?>
												<span class="course-price course-free">Gratuit</span>
											<?php } ?>

										</div>
									</div>
								</div>
							<?php  } ?>

						</div>
						<!-- /row -->

					</div>
					<!-- /courses -->
					<div class="row">
						<div class="center-btn">
							<a class="main-button icon-button" href="espEtud_Prem.php">Plus de Cours</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Courses -->



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
		<div id='preloader'>
			<div class='preloader'></div>
		</div>
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