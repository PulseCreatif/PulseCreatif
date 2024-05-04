<?php

session_start();

require_once(__DIR__ . "/../controllers/EvaluationC.php");
require_once(__DIR__ . "/../models/evaluation.php");

$EvaluationC = new EvaluationController();
$list = $EvaluationC->listEvaluations();


function getQuestionFromBard() {
    // Clé API (remplacez par la vôtre)
    $key = "AIzaSyCHfh2ZufGd9SBw8WGBZbxFXAayd5UKEcw";

    // URL de l'API
    $url = "https://generativelanguage.googleapis.com/v1/models/gemini-pro:generateContent?key=$key";

    // Données pour la requête
    $data = array(
        'contents' => array(
            array(
                'parts' => array(
                    array(
                        'text' => 'Génère une question pour un exercice de programmation en PHP.'
                    )
                )
            )
        )
    );

    $jsonData = json_encode($data);

    // Création d'une session cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    $response = curl_exec($ch);

    if ($response === false) {
        echo 'Erreur: ' . curl_error($ch);
        return null;
    }

    $responseData = json_decode($response, true);
    curl_close($ch);

    if (isset($responseData["candidates"]) && count($responseData["candidates"]) > 0) {
        return $responseData["candidates"][0]["content"]["parts"][0]["text"];
    }

    return null;
}


if (isset($_POST['ID_EVALUATION']) && isset($_POST["REPONSE_ETUD"])) {
    // Valider ID_EVALUATION
    if (!is_numeric($_POST['ID_EVALUATION'])) {
        die("ID_EVALUATION non valide.");
    }

    // Récupérer les données d'évaluation
    $evaluationData = $EvaluationC->showEvaluation($_POST['ID_EVALUATION']);

    if (!$evaluationData) {
        die("Aucune donnée trouvée pour l'ID_EVALUATION fourni.");
    }

    // Construire l'objet Evaluation
    $evaluation = new Evaluation(0, 0, 0, 0, "", "");
    $evaluation = eval_array_construct($evaluation, $evaluationData);

    // Assigner la réponse
    $evaluation->setReponseEtud($_POST["REPONSE_ETUD"]);

    // Mettre à jour l'évaluation
    $EvaluationC->updateEvaluation($evaluation, $_POST["ID_EVALUATION"]);

    // Rediriger
    header("Location: afficherevaluation.php");
    exit();
}


$question = getQuestionFromBard();


function getImageText($file) {

    // Set API key
    $apikey = 'helloworld';

    // Set API URL
    $url = 'https://api.ocr.space/Parse/Image';

    // Set form data
    $postData = array(
        'file' => curl_file_create($file),
        'language' => 'eng',
        'isOverlayRequired' => 'true',
        'OCREngine' => '2'
    );

    // Initialize cURL session
    $ch = curl_init();

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "apikey: $apikey"
    ));

    // Execute cURL request
    $result = curl_exec($ch);

    // Close cURL session
    curl_close($ch);

    // Decode JSON response
    $parsedResult = json_decode($result, true);

    // Extract and return parsed text
    return $parsedResult['ParsedResults'][0]['ParsedText'];
}


if (isset($_POST["file_upload"]) and isset($_POST["ID_EVALUATION"])) {
    //$path = "C:\Users\souha\Desktop\OCR_ETUD";
    //$fullpath = $path . '\\' . $_FILES['file']['name'];

    $path = "/home/dalichabani/Pictures/OCR_ETUD";
    $fullpath = $path . '/' . $_FILES['file']['name'];

    $reponse_etud = getImageText($fullpath);
    
    // Récupérer les données d'évaluation
    $evaluationData = $EvaluationC->showEvaluation($_POST['ID_EVALUATION']);
    
    if (!$evaluationData) {
        die("Aucune donnée trouvée pour l'ID_EVALUATION fourni.");
    }

    // Construire l'objet Evaluation
    $evaluation = new Evaluation(0, 0, 0, 0, "", "");
    $evaluation = eval_array_construct($evaluation, $evaluationData);

    // Assigner la réponse
    $evaluation->setReponseEtud($reponse_etud);

    // Mettre à jour l'évaluation
    $EvaluationC->updateEvaluation($evaluation, $_POST["ID_EVALUATION"]);

    // Rediriger
    header("Location: afficherevaluation.php");
    exit();
}
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
							<li><a href="../index.php">Home</a></li>
							<li>Contact</li>
						</ul>
						<h1 class="white-text">Afficher les rendus par matiere</h1>

					</div>
				</div>
			</div>
		</div>

		<?php if ($question): ?>
            <div class="questionEval">
                 <p><?= $question ?></p>
            </div>
        <?php endif; ?>

        <!-- /Hero-area -->
        <form action="" id="reponse_etud" method="POST">
                <div>
                    <label for="id_cours">Reponse Etudiant</label>
                    <input type="text" id="reponse_etud" name="REPONSE_ETUD" required>
                    <input type="hidden" value="<?= $_POST['ID_EVALUATION']; ?>" name="ID_EVALUATION">
                    <button type="submit">Soumettre votre réponse</button>
                </div>
        </form>

        <hr>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="fileInput">Choisissez un fichier à envoyer:</label>
                <input type="hidden" value="<?= $_POST['ID_EVALUATION']; ?>" name="ID_EVALUATION">
                <input type="hidden" name="file_upload" value="file_upload">
                <input type="file" name="file" id="fileInput" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Envoyer</button>
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
		<script type="text/javascript" src="/js/bootstrap.min.js"></script>
		<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
		<script type="text/javascript" src="js/google-map.js"></script>
		<script type="text/javascript" src="js/main.js"></script>
		<script src="js/script.js"></script>

	</body>
</html>