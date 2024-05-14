<?php
include __DIR__.'/../controllers/DevoirC.php';
include __DIR__.'/../models/devoir.php';


$DevoirC = new DevoirController();
if (isset($_GET["id"])) {
    $DevoirC->deleteDevoir($_GET["id"]);
    header("Location:pages/dashboardDevoir.php");
}
else {
    echo "Missing id get parameter";
}