<?php

session_start();

$_SESSION["description"] = null;

require_once __DIR__.'/../controllers/EvaluationC.php';
$EvaluationC = new EvaluationController();
$list = $EvaluationC->listEvaluations();


function voirNote($reponse) {
	$_SESSION["description"] = null;

	$key = "AIzaSyCHfh2ZufGd9SBw8WGBZbxFXAayd5UKEcw";
	$url = "https://generativelanguage.googleapis.com/v1/models/gemini-pro:generateContent?key=$key";

	$text =  "Reponse: $reponse" . "\n Evaluez cette réponse / 20 ne soyez pas indulgents et donnez une petite description";

	$data = array(
        'contents' => array(
            array(
                'parts' => array(
                    array(
                        'text' => $text
                    )
                )
            )
        )
    );

	// Convert data to JSON format
	$jsonData = json_encode($data);

	// Initialize cURL session
	$ch = curl_init();

	// Set cURL options
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json'
	));

	// Execute cURL request
	$response = curl_exec($ch);


	if ($response === false) {
		echo 'Error: ' . curl_error($ch);
	}

	else {
		// Decode JSON response
		$responseData = json_decode($response, true);
		
		$_SESSION["description"] = $responseData["candidates"][0]["content"]["parts"][0]["text"];
	}

	// Close cURL session
	curl_close($ch);
}

if (isset($_POST["voir_note"]) and isset($_POST["reponse"])) {
	voirNote($_POST["reponse"]);
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
		<!-- /Hero-area -->

          <table border="1" align="center" width="60%">
    <tr>
        <th>Note</th>
        <th>Commentaire</th>
        <th>Réponse Étudiant</th>
    </tr>
    <?php
    foreach ($list as $evaluation) {
    ?>
        <tr>
            <td><?= $evaluation['NOTE']; ?></td>
            <td><?= $evaluation['COMMENTAIRE']; ?></td>
            <td><?= $evaluation['REPONSE_ETUD']; ?></td>
			<?php
				if (empty($evaluation["REPONSE_ETUD"])) {
					?>
					    <td align="center">
                		<form method="POST" action="miseajourevaluation.php">
                		<input type="submit" name="update" value="Update">
                    	<input type="hidden" value="<?= $evaluation['ID_EVALUATION']; ?>" name="ID_EVALUATION">
                		</form>
            			</td>
					<?php
				}

				if (empty($evaluation["NOTE"]) and !empty($evaluation["REPONSE_ETUD"])) {
					?>
						<td align="center">
                		<form method="POST" action="">
							<input type="hidden" name="voir_note">
							<input type="hidden" name="reponse" value="<?= $evaluation['REPONSE_ETUD']; ?>">
							<button type="submit">Voir Note</button>
                		</form>
            			</td>
					<?php

				}
			?>
        </tr>
    <?php
    }
    ?>
</table>

	<?php
		if (isset($_SESSION["description"])) {
			?>
			<div class="reponseEvalBard">
				<pre> <?= $_SESSION["description"]; ?> </pre>
			</div>
			<?php
		}
	?>

    
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
