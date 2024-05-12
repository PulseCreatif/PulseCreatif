<?php
session_start();

if (!isset($_SESSION["user_role"])) {
	$_SESSION["user_role"] = null;
    header("Location: index.php");
}

function select_esp_file() {
	if ($_SESSION["user_role"] == 0) {
		return "pages/dashboardUser.php";
	}
	else if ($_SESSION["user_role"] == 1) {
		return "espEtud.php";
	}
	else if ($_SESSION["user_role"] == 2) {
		return "espEtud_Prem.php";
	}
	else if ($_SESSION["user_role"] == 3) {
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
		<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link type="text/css" rel="stylesheet" href="css/style.css"/>

        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        

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
							<img src="img/logo-alt.png" alt="logo">
						</a>
					</div>
					<button class="navbar-toggle">
						<span></span>
					</button>
				</div>
				<nav id="nav">
					<ul class="main-menu nav navbar-nav navbar-right">
                    <li><a href="index.php">Accueil</a></li>
						<li><a href="gemini.php">ChatBot</a></li>
						<li><a href="disconnect.php">Se déconnecter</a></li>
					</ul>
				</nav>
                </div>
		</header>
		<!-- Hero-area -->
		<div class="hero-area section">

			<!-- Backgound Image -->
			<div class="bg-image bg-parallax overlay" style="background-image:url(./img/page-background.jpg)"></div>
			<!-- /Backgound Image -->

			<div class="container">
				<div class="row">
					<div class="col-md-10 col-md-offset-1 text-center">
						<ul class="hero-area-tree">
							<li><a href="index.php">Accueil</a></li>
							<li>Dashboard</li>
						</ul>
						<h1 class="white-text">Votre Dashboard</h1>

					</div>
				</div>
			</div>
        </div>

        <form id="signupForm">
            <h4> Espace utilisateur</h4>
                <a href="<?=select_esp_file();?>">Votre compte</a>
        </form>

        <hr>

        <form id="signupForm">
            <h4>Espace Devoirs</h4>
                <a href="afficherdevoir.php">Afficher vos devoirs</a>
                <hr>
                <a href="ajouterdevoir.php">Ajouter un devoir</a>
        </form>

        <hr>

        <form id="signupForm">
            <h4>Espace évaluations</h4>
                <a href="afficherevaluation.php">Afficher vos évaluations</a>
                <hr>
                <a href="ajouterevaluation.php">Ajouter une évaluation</a>
        </form>


    <!-- Footer -->
    <footer id="footer" class="section">

    <!-- container -->
    <div class="container">
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
                    <span>&copy; Copyright 2024. All Rights Reserved. | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i></span>
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