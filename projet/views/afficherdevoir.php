<?php
include '../controllers/DevoirC.php';
$DevoirC = new DevoirController();
$list = $DevoirC->listDevoirs();
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
		<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>

		<!-- Font Awesome Icon -->
		<link rel="stylesheet" href="css/font-awesome.min.css">

		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="css/style.css"/>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

    </head>
	<body>

		<!-- Header -->
		<header id="header">
			<div class="container">

				<div class="navbar-header">
					<!-- Logo -->
					<div class="navbar-brand">
						<a class="logo" href="index.html">
							<img src="img/logo.png" alt="logo">
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
                        <li><a href="user.html">Utilisateur</a></li>
                        <li><a href="coures.html">Courses</a></li>
                        <li><a href="devoir.html">Devoir</a></li>
                        <li><a href="reclamation.html">Reclamation</a></li>
                        <li><a href="formu.html">Forum</a></li>
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
							<li><a href="../index.html">Home</a></li>
							<li>Contact</li>
						</ul>
						<h1 class="white-text">Afficher les rendus par matiere</h1>

					</div>
				</div>
			</div>

		</div>
		<!-- /Hero-area -->
        <form id="matiereForm">
			<label for="matiere">Choisir une matière:</label>
			<select id="matiere" name="matiere">
			  <option value="">Choisir une matière</option>
			  <option value="Base de données">Base de données</option>
			  <option value="Mathématique de base 3">Mathématique de base 3</option>
			  <option value="Programmation linéaire">Programmation linéaire</option>
			  <option value="Communication et culture">Communication et culture</option>
			  <option value="CCCF2">CCCF2</option>
			  <option value="Projet Web">Projet Web</option>
			  <option value="Projet QT">Projet QT</option>
			  <option value="Réseaux et Communication">Réseaux et Communication</option>
			  <option value="Scripting">Scripting</option>
			</select>
		  </form>



        <table border="1" align="center" width="70%">
        <tr>
            <th>Id Depot</th>
            <th>Id Cours</th>
            <th>Date Limite</th>
            <th>Fichier</th>
            <th>Commentaire</th>
            <th>Etat</th>
            
        </tr>
        <?php
        foreach ($list as $devoir) {
        ?>
            <tr>
                <td><?= $devoir['DEPOT_ID']; ?></td>
                <td><?= $devoir['COURS_ID']; ?></td>
				<td><?= $devoir['DATE_LIMITE']; ?></td>
                <td><?= $devoir['FICHIER']; ?></td>
                <td><?= $devoir['COMMENTAIRE']; ?></td>
                <td><?= $devoir['ETAT']; ?></td>
                <td align="center">
                    <!--<form method="POST" action="updateEmploye.php">
                        <input type="submit" name="update" value="Update">
                        <input type="hidden" value=<?PHP echo $devoir['DEPOT_ID']; ?> name="id">
                    </form>
		-->
                </td>

            </tr>
        <?php
        }
        ?>
    </table>

		
    
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
		<script type="text/javascript" src="/js/bootstrap.min.js"></script>
		<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
		<script type="text/javascript" src="js/google-map.js"></script>
		<script type="text/javascript" src="js/main.js"></script>
		<script src="js/script.js"></script>

	</body>
</html>
