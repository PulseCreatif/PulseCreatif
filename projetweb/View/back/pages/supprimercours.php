<?php
include 'C:/xampp/htdocs/projetweb/Controller/CoursC.php';
$CoursC = new CoursC();
$CoursC->deletecours($_GET['Id_cours']);
header('Location:coursesb.php');
