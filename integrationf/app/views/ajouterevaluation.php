<?php

include __DIR__.'/../controllers/EvaluationC.php';
include __DIR__.'/../models/evaluation.php';
require_once __DIR__."/validation.php";

//require_once __DIR__."/validation.php";

$input_validation = true;

// Instanciation du contrôleur
$evaluationC = new EvaluationController();
$evaluation = null;

// Vérification de la présence des données nécessaires
if (isset($_POST["ID_DEPOT"]) &&
    isset($_POST["ID_ENSEIGNANT"]) &&
    isset($_POST["NOTE"]) &&
    isset($_POST["COMMENTAIRE"]) &&
    isset($_POST["REPONSE_ETUD"])) {
    
		$id_depot=$_POST["ID_DEPOT"];
		$id_enseignant=$_POST["ID_ENSEIGNANT"];
		$note=$_POST["NOTE"];
		$commentaire=$_POST["COMMENTAIRE"];
		$reponse_etud=$_POST["REPONSE_ETUD"];

		$input_validation=validateEvaluation($id_depot,$id_enseignant,$note,$commentaire,$reponse_etud);

    if (!empty($id_depot) && !empty($id_enseignant) && !empty($note) && !empty($commentaire) && !empty($reponse_etud) && $input_validation) {
        // Récupération des données du formulaire
        $ID_DEPOT = $_POST["ID_DEPOT"];
        $ID_ENSEIGNANT = $_POST["ID_ENSEIGNANT"];
        $NOTE = $_POST["NOTE"];
        $COMMENTAIRE = $_POST["COMMENTAIRE"];
        $REPONSE_ETUD = $_POST["REPONSE_ETUD"];

        // Création d'un nouvel objet Evaluation
        $evaluation = new Evaluation(
            id_evaluation:null, // Laissez l'ID à null s'il est auto-incrémenté dans la base de données
            id_depot:$ID_DEPOT,
            id_enseignant:$ID_ENSEIGNANT,
            note:$NOTE,
            commentaire:$COMMENTAIRE,
            reponse_etud:$REPONSE_ETUD
        );

        // Ajout de l'évaluation à la base de données
        $evaluationC->addEvaluation($evaluation);
        // Redirection vers une autre page si nécessaire
        // header("Location: pageDeRedirection.php");
        // exit();
    }
	else {
		echo "<script>alert('Les données sont erronées')</script>";
	}
}
?>


<!-- Affichage d'erreur -->
<?php if (!empty($error)) { ?>
    <script>alert("<?php echo $error; ?>")</script>
<?php } ?>



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
						<a class="logo" href="index.php">
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
					<li><a href="index.php">Accueil</a></li>
					<li><a href="dashboardFront.php">Dashboard</a></li>
					<li><a href="gemini.php">ChatBot</a></li>
					<li><a href="disconnect.php">Se déconnecter</a></li>
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
							<li><a href="index.php">Home</a></li>
							<li>Contact</li>
						</ul>
						<h1 class="white-text">Afficher les rendus par matiere</h1>

					</div>
				</div>
			</div>

		</div>
		<!-- /Hero-area -->
        <h2>Ajouter une évaluation</h2>
<form id="addEvaluationForm" action="ajouterevaluation.php" method="POST">

    <div>
        <label for="id_evaluation">ID de l'évaluation :</label>
        <input type="text" id="id_evaluation" name="ID_EVALUATION" required>
    </div>
    <div>
        <label for="id_depot">ID du dépôt :</label>
        <input type="text" id="id_depot" name="ID_DEPOT" required>
    </div>
    <div>
        <label for="id_enseignant">ID de l'enseignant :</label>
        <input type="text" id="id_enseignant" name="ID_ENSEIGNANT" required>
    </div>
    <div>
        <label for="note">Note :</label>
        <input type="number" id="note" name="NOTE" step="0.01" min="0" required>
    </div>
    <div>
        <label for="commentaire">Commentaire :</label>
        <textarea id="commentaire" name="COMMENTAIRE"></textarea>
    </div>
    <div>
        <label for="reponse_etud">Réponse de l'étudiant :</label>
        <textarea id="reponse_etud" name="REPONSE_ETUD"></textarea>
    </div>
    <button type="submit" id="boutonAjouterEvaluation">Ajouter l'évaluation</button>
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
























	

