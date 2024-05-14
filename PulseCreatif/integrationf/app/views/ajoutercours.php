<?php
session_start();

if (!isset($_SESSION["user_role"]) or $_SESSION["user_role"] != 3) {
    http_response_code(403);
    header("Location:index.php");
    exit();
}
include '../controllers/CoursC.php';
include '../models/cours.php';
$cours = NULL;
$CoursC = new CoursC();
$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (
        isset($_POST['Nom_cours']) &&
        isset($_POST['Nbr_heures']) &&
        isset($_POST['Type_cours']) &&
        isset($_POST['Nom_Ens'])
    ) {
        if (!empty($_POST)) {
            if (empty($_POST['Nom_cours'])) {
                $errors[] = "Le nom du cours est vide.";
            } else if (!preg_match('/^[A-Za-z]+$/', $_POST['Nom_cours'])) {
                $errors[] = "Le nom du cours est invalide.";
            }

            if (empty($_POST['Nbr_heures'])) {
                $errors[] = "La durée du cours est vide.";
            } elseif (!is_numeric($_POST['Nbr_heures'])) {
                $errors[] = "La durée du cours est invalide.";
            }

            if (empty($_POST['Type_cours'])) {
                $errors[] = "Le type de cours est vide.";
            } elseif ($_POST['Type_cours'] != '0' && $_POST['Type_cours'] != '1') {
                $errors[] = "Le type de cours est invalide.";
            }

            if (empty($_POST['Nom_Ens'])) {
                $errors[] = "Le nom de l'enseignant est vide.";
            } elseif (!preg_match('/^[A-Za-z]+$/', $_POST['Nom_Ens'])) {
                $errors[] = "Le nom de l'enseignant est invalide.";
            }
        }

        if (empty($errors)) {
            $cours = new cours(
                $_POST['Nom_cours'],
                $_POST['Nbr_heures'],
                $_POST['Type_cours'],
                $_POST['Nom_Ens']
            );
            $CoursC->addcours($cours);
        } elseif (!empty($errors)) {
            echo "Erreurs rencontrées :";
            print_r($errors); // Affichage des erreurs
        }
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
                        <li><a href="index.php">Accueil</a></li>
                        <li>Espace Prof</li>
                    </ul>
                    <h1 class="white-text">Espace Prof</h1>

                </div>
            </div>
        </div>

    </div>
    <!-- /Hero-area -->

    <!-- Courses -->
    <div id="courses" class="section">

        <div class="container">
            <h2>Ajouter un cours</h2>
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="Nom_cours" class="form-label">Nom_cours:</label>
                    <input type="text" class="form-control" id="Nom_cours" name="Nom_cours">
                </div>
                <div class="mb-3">
                    <label for="Nbr_heures" class="form-label">Nbr_heures:</label>
                    <input type="number" class="form-control" id="Nbr_heures" name="Nbr_heures">
                </div>
                <div class="mb-3">
                    <label for="Type_cours" class="form-label">Type_cours:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="Type_cours" id="Type_cours_0" value="0">
                        <label class="form-check-label" for="Type_cours_0">
                            0 (Free)
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="Type_cours" id="Type_cours_1" value="1">
                        <label class="form-check-label" for="Type_cours_1">
                            1 (Premium)
                        </label>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="Nom_Ens" class="form-label">Nom_Ens:</label>
                    <input type="text" class="form-control" id="Nom_Ens" name="Nom_Ens">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="reset" class="btn btn-secondary">Annuler</button>
                <div class="form-group">
                    <button class="btn bg-gradient-primary btn-sm"><a href="espProf.php">Retour à la liste des cours</a></button>
                </div>
            </form>
        </div>

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