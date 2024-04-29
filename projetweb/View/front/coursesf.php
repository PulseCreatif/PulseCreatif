<?php
include 'c:/xampp/htdocs/projetweb/Controller/CoursC.php';
include 'c:/xampp/htdocs/projetweb/Model/cours.php';
$CoursC = new CoursC();
//$tab = $CoursC->listcours();
if (isset($_GET['search'])) {
    // Get the search query from the URL
    $search_query = $_GET['search'];

    // Perform the search based on the course name or professor's name
    $tab = $CoursC->searchCours($search_query);
} else {
    // If no search query is provided, display all courses
    $tab = $CoursC->listcours();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SKILLPULSE</title>
    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Lato:700%7CMontserrat:400,600" rel="stylesheet">
    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="./css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="./css/font-awesome.min.css">
    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="./css/style.css" />
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
                    <a class="logo" href="./index.html">
                        <img src="img/logoweb.png" alt="logo">
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
                    <li><a href="./index.html">Home</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="./courses.html">Courses</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </nav>
            <!-- /Navigation -->
        </div>
    </header>
    <!-- /Header -->

    <!-- Hero-area -->
    <div class="hero-area section">
        <!-- Backgound Image -->
        <div class="bg-image bg-parallax overlay" style="background-image:url(img/page-background.jpg)"></div>
        <!-- /Backgound Image -->
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 text-center">
                    <ul class="hero-area-tree">
                        <li><a href="./index.html">Home</a></li>
                        <li>Courses</li>
                    </ul>
                    <h1 class="white-text">Courses</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- /Hero-area -->

    <!-- Courses -->
    <div id="courses" class="section">
        <div class="container">
            <div class="row">
                <!-- Sidebar -->
                <div id="aside" class="col-md-3 pull-right">
                    <!-- Search widget -->
                    <div class="widget search-widget">
                        <form method="GET" action="">
                            <input class="input" type="text" name="search" placeholder="Search...">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                    <!-- /Search widget -->
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
                                                <span class="course-price course-premium">Premium</span>
                                            <?php } else { ?>
                                                <span class="course-price course-free">Free</span>
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
                            <a class="main-button icon-button" href="coursesf.php">More Courses</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Courses -->

        <!-- Footer -->
        <footer id="footer" class="section">
            <div class="container">
                <div class="row">
                    <!-- footer logo -->
                    <div class="col-md-6">
                        <div class="footer-logo">
                            <a class="logo" href="View/index.html">
                                <img src="img/logoweb.png" alt="logo">
                            </a>
                        </div>
                    </div>
                    <!-- footer logo -->
                    <!-- footer nav -->
                    <div class="col-md-6">
                        <ul class="footer-nav">
                            <li><a href="View/index.html">Home</a></li>
                            <li><a href="#">About</a></li>
                            <li><a href="View/courses.html">Courses</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </div>
                    <!-- /footer nav -->
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
                            <span>&copy; Copyright 2018. All Rights Reserved. | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com">Colorlib</a></span>
                        </div>
                    </div>
                    <!-- /copyright -->
                </div>
            </div>
        </footer>
        <!-- /Footer -->
        <!-- preloader -->
        <div id='preloader'>
            <div class='preloader'></div>
        </div>
        <!-- /preloader -->
        <!-- jQuery Plugins -->
        <script type="text/javascript" src="./js/jquery.min.js"></script>
        <script type="text/javascript" src="./js/bootstrap.min.js"></script>
        <script type="text/javascript" src="./js/main.js"></script>
</body>

</html>