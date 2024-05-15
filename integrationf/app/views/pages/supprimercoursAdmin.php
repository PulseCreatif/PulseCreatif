<?php
include __DIR__ . '/../../controllers/CoursC.php';
session_start();

require_once(__DIR__ . '/../../../app/controllers/UserC.php');
require_once(__DIR__ . '/../../../app/models/User.php');

if (!isset($_SESSION["user_role"]) or $_SESSION["user_role"] != 0) {
    http_response_code(403);
    header("Location:../index.php");
    exit();
}
$CoursC = new CoursC();
$CoursC->deletecours($_GET['Id_cours']);
header('Location:dashboardcours.php');
