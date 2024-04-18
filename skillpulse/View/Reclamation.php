<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reclamation Form</title>
    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Lato:700%7CMontserrat:400,600" rel="stylesheet">
    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="css/style.css"/>


    
		<style>

.small-logo {
	width: 30px; /* Adjust the width as needed */
    height: auto; /* Maintain aspect ratio */

    transform: scale(3); /
}


</style>





</head>
<body>

<!-- Header -->
<header id="header">
    <div class="container">
        <div class="navbar-header">
            <!-- Logo -->
            <div class="navbar-brand">
                <a class="logo" href="index.php">
                <img src="./img/logo.png" alt="logo" class="small-logo">>
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
                <li><a href="#">About</a></li>
                <li><a href="#">Courses</a></li>
                <li><a href="Reclamation.php">Reclamation</a></li>
                <li><a href="Post.php">Post</a></li>
                <li><a href="contact.html">Contact</a></li>
            </ul>
        </nav>
        <!-- /Navigation -->
    </div>
</header>
<!-- /Header -->



<style>
.button {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 15px 30px;
  border: 0;
  position: relative;
  overflow: hidden;
  border-radius: 10rem;
  transition: all 0.02s;
  font-weight: bold;
  color: rgb(37, 37, 37);
  z-index: 0;
  box-shadow: 0 0px 7px -5px rgba(0, 0, 0, 0.5);
}

.button:hover {
  background: rgb(193, 228, 248);
  color: rgb(33, 0, 85);
}

.button:active {
  transform: scale(0.97);
}

.hoverEffect {
  position: absolute;
  bottom: 0;
  top: 0;
  left: 0;
  right: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1;
}

.hoverEffect div {
  background: rgb(222,0,75);
  background: linear-gradient(90deg, rgba(222,0,75,1) 0%, rgba(191,70,255,1) 49%, rgba(0,212,255,1) 100%);
  border-radius: 40rem;
  width: 10rem;
  height: 10rem;
  transition: 0.4s;
  filter: blur(20px);
  animation: effect infinite 3s linear;
  opacity: 0.5;
}

.button:hover .hoverEffect div {
  width: 8rem;
  height: 8rem;
}

@keyframes effect {

  0% {
    transform: rotate(0deg);
  }

  100% {
    transform: rotate(360deg);
  }
}


    </style> 





<!-- Reclamation Form -->
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2>Reclamation Form</h2>
            <form id="reclamation-form" action="traitement_reclamation.php" method="post">
            <div class="form-group">
                                <input type="text" name="name" id="name" class="form-control" placeholder="Your Name"
                                    required data-error="Please enter your name">
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group">
                                <input type="email" name="email" id="email" class="form-control"
                                    placeholder="Your Email" required data-error="Please enter your email">
                                <div class="help-block with-errors"></div>
                            </div>


                            <div class="form-group">
                                <input type="text" name="subject" id="subject" class="form-control"
                                    placeholder="Subject" required data-error="Please enter the subject">
                                <div class="help-block with-errors"></div>
                            </div>





                <div class="form-group">
                                <textarea name="description" class="form-control" id="description" rows="6"
                                    placeholder="Your Message" required data-error="Please enter your message"></textarea>
                                <div class="help-block with-errors"></div>
                            </div>


      <button class="button" type="submit" class="default-btn">Submit Reclamation</button>


            </form>
        </div>
    </div>
</div>
<!-- End Reclamation Form -->

<!-- Footer -->
<footer id="footer" class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="footer-logo">
                    <a class="logo" href="index.html">
                    <img src="./img/logo.png" alt="logo" class="small-logo">>
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                <ul class="footer-nav">
                <li><a href="index.php">Home</a></li>
						<li><a href="#">About</a></li>
						<li><a href="#">Courses</a></li>
						<li><a href="Reclamation.php">Reclamation</a></li>
						<li><a href="Post.php">Post</a></li>
						<li><a href="contact.html">Contact</a></li>
                </ul>
            </div>
        </div>
        <div id="bottom-footer" class="row">
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
            <div class="col-md-8 col-md-pull-4">
                <div class="footer-copyright">
                    <span>&copy; Copyright 2018. All Rights Reserved. | This template is made with <i
                                class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com">Colorlib</a></span>
                </div>
            </div>
        </div>
    </div>
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

</body>
</html>
