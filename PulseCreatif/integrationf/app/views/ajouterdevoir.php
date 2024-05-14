<?php

include __DIR__.'/../controllers/DevoirC.php';
include __DIR__.'/../models/devoir.php';
require_once __DIR__."/validation.php";

$devoirC = new DevoirController();

if (isset($_POST["COURS_ID"]) &&
    isset($_POST["DATE_LIMITE"]) &&
    isset($_POST["COMMENTAIRE"]) &&
    isset($_POST["ETAT"]) &&
    isset($_FILES["fileToUpload"]["name"])) {

    $idCours = $_POST["COURS_ID"];
    $dateLimite = $_POST["DATE_LIMITE"];
    $commentaire = $_POST["COMMENTAIRE"];
    $etat = (int) $_POST["ETAT"];

    // Validate inputs
    $input_validation = validateInputs($idCours, $dateLimite, $_FILES, $commentaire, $etat);

    if (!empty($idCours) && !empty($dateLimite) && !empty($commentaire) && $input_validation) {
        $uploadDir = 'uploads/'; // Ensure this directory exists and has the correct permissions
        $fileTmpPath = $_FILES["fileToUpload"]["tmp_name"];
        $fileName = $_FILES["fileToUpload"]["name"];
        $uploadFilePath = $uploadDir . $fileName;

        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($uploadFilePath, PATHINFO_EXTENSION));

        // Check if the file is an image
        $check = getimagesize($fileTmpPath);
        if ($check !== false) {
            echo "File is an image: " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        if ($uploadOk && move_uploaded_file($fileTmpPath, $uploadFilePath)) {
            $devoir = new Devoir(
                depot_id: null, // Leave as is if auto-incremented
                cours_id: $idCours,
                date_limite: $dateLimite,
                fichier: $uploadFilePath, // Store the path to the uploaded file
                commentaire: $commentaire,
                etat: $etat
            );

            $devoirC->addDevoir($devoir);
        }
    } else {
        ?>
		<script>alert('Les données sont erronées')</script>
		<?php
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
                        <li><a href="index.php">Home</a></li>
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
							<li><a href="index.php">Home</a></li>
							<li>Contact</li>
						</ul>
						<h1 class="white-text">Afficher les rendus par matiere</h1>

					</div>
				</div>
			</div>

		</div>
		<!-- /Hero-area -->
			<h2>Ajouter un rendu</h2>
		<form id="addAssignmentForm" action="" method="POST" enctype="multipart/form-data">
			
			<div>
				<label for="id_cours">ID du cours:</label>
				<input type="text" id="id_cours" name="COURS_ID" required>
			</div>
			<div>
				<label for="date_limite">Date limite:</label>
				<input type="date" id="date_limite" name="DATE_LIMITE" required>
			</div>

			<div>
				<label for="fileToUpload">Select image to upload:</label>
  				<input type="file" name="fileToUpload" id="fileToUpload">
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
		<!--<script src="js/script.js"></script>-->
		

	</body>
</html>
























	

