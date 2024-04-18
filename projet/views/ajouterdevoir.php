<?php

include __DIR__.'/../controllers/DevoirC.php';
include __DIR__.'/../models/devoir.php';


// Instanciation du contrôleur
$devoirC = new DevoirController();
$devoir = null;

// Vérification de la présence des données nécessaires
if (isset($_POST["COURS_ID"]) &&
    isset($_POST["DATE_LIMITE"]) &&
    isset($_POST["COMMENTAIRE"]) &&
    isset($_POST["ETAT"]) &&
    isset($_POST["FICHIER"])) {

        if (!empty($_POST["COURS_ID"]) && !empty($_POST["FICHIER"]) && !empty($_POST["DATE_LIMITE"]) && !empty($_POST["COMMENTAIRE"]) && !empty($_POST["ETAT"])) {
            // Récupération des données du formulaire
            $COURS_ID = $_POST["COURS_ID"];
            $DATE_LIMITE = $_POST["DATE_LIMITE"];
            //$fichier = $_POST["FICHIER"];
            //$fichier = $_FILES["FICHIER"]["name"];
            $COMMENTAIRE = $_POST["COMMENTAIRE"];
            $ETAT = $_POST["ETAT"];
            $FICHIER = $_POST["FICHIER"];

            // Vérification que les champs ne sont pas vides
                // Gestion de l'upload du fichier
            /* $upload_directory = "chemin/vers/dossier/"; // Chemin du dossier de destination pour les téléchargements
                $file_tmp = $_FILES["FICHIER"]["tmp_name"];
                $file_name = $_FILES["FICHIER"]["name"];
                move_uploaded_file($file_tmp, $upload_directory . $file_name);*/

                // Création d'un nouvel objet Devoir
            $devoir = new Devoir(
                depot_id:null, // Laissez l'ID à null s'il est auto-incrémenté dans la base de données
                cours_id:$COURS_ID,
                date_limite:$DATE_LIMITE,
                fichier:$FICHIER,
                commentaire:$COMMENTAIRE,
                etat:(int) $ETAT
            );

            // Ajout du devoir à la base de données
            $devoirC->addDevoir($devoir);
            // Redirection vers une autre page si nécessaire
            // header("Location: signIn.php");
            // exit();
    }
}
?>

<!-- Affichage d'erreur -->
<?php if (!empty($error)): ?>
    <script>alert("<?php echo $error; ?>")</script>
<?php endif; ?>



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
							<li><a href="index.html">Home</a></li>
							<li>Contact</li>
						</ul>
						<h1 class="white-text">Afficher les rendus par matiere</h1>

					</div>
				</div>
			</div>

		</div>
		<!-- /Hero-area -->
			<h2>Ajouter un rendu</h2>
		<form id="addAssignmentForm" action="" method="POST" >
			
			<div>
				<label for="id_cours">ID du cours:</label>
				<input type="text" id="id_cours" name="COURS_ID" required>
			</div>
			<div>
				<label for="date_limite">Date limite:</label>
				<input type="date" id="date_limite" name="DATE_LIMITE" required>
			</div>
			<div>
				<label for="fichier">Fichier de rendu:</label>
				<input type="text" id="fichier" name="FICHIER">
			</div>
			<div>
				<label for="commentaire">Commentaire:</label>
				<textarea id="commentaire" name="COMMENTAIRE"></textarea>
			</div>
			<div>
				<label for="etat">État:</label>
				<select id="etat" name="ETAT" required>
					<option value="0">En attente</option>
					<option value="1">Soumis</option>
					<option value="2">Validé</option>
					<option value="3">Rejeté</option>
				</select>
			</div>
			<button type="submit" id="boutonAjouterRendu">Ajouter le rendu</button>
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
		<script src="js/script.js"></script>
		

	</body>
</html>
























	

