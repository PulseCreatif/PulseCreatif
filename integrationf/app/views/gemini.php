<?php

session_start();
if (!isset($_SESSION["user_role"])) {
    header("Location: index.php");
}


$responseData = null;

// Function to escape markdown characters
function escapeMarkdownChars($text) {
    // Escape characters used for formatting in markdown
    $text = htmlspecialchars($text, ENT_QUOTES);
    $text = str_replace(['*', '_', '~'], ['&#42;', '&#95;', '&#126;'], $text);
    return $text;
}
  

if (isset($_POST["prompt"]) and !empty($_POST["prompt"])) {
    // URL endpoint
    $url = 'https://generativelanguage.googleapis.com/v1/models/gemini-pro:generateContent?key=AIzaSyCHfh2ZufGd9SBw8WGBZbxFXAayd5UKEcw';
    // Request data
    $data = array(
        'contents' => array(
            array(
                'parts' => array(
                    array(
                        'text' => $_POST["prompt"]
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
        
        // Print response
        //print_r($responseData["candidates"][0]["content"]["parts"][0]["text"]);
    }

    // Close cURL session
    curl_close($ch);
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
                        <li><a href="dashboardFront.php">Dashboard</a></li>
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
							<li><a href="index.php">Home</a></li>
							<li>Chat</li>
						</ul>
						<h1 class="white-text">Discutez avec notre chatbot IA</h1>

					</div>
				</div>
			</div>

		</div>

        <div class="geminiContainer">
            <!-- /Hero-area -->
            <form id="chatForm" action="" method="POST">
                <div>
                    <label for="prompt">Champ de discussion</label>
                    <input type="text" id="prompt" name="prompt" required placeholder="Posez une question">
                    <hr>
                <button type="submit">Soumettre votre question</button>
            </form>

            <?php
                if ($responseData != null) {
                    ?>
                    <div class="answer">
                        <?= htmlspecialchars($responseData["candidates"][0]["content"]["parts"][0]["text"])?>
                    </div>
            <?php
                }
            ?>
        </div>


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