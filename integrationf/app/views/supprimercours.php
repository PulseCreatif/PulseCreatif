<?php
include '../controllers/CoursC.php';
$CoursC = new CoursC();
$CoursC->deletecours($_GET['Id_cours']);
header('Location:espProf.php');
