<?php
include __DIR__ . '/../../controllers/certifC.php';
session_start();

require_once(__DIR__ . '/../../../app/controllers/UserC.php');
require_once(__DIR__ . '/../../../app/models/User.php');

if (!isset($_SESSION["user_role"]) or $_SESSION["user_role"] != 0) {
    http_response_code(403);
    header("Location:../index.php");
    exit();
}
$CertifC = new CertifC();
$CertifC->deletecertif($_GET['Id_Cert']);
header('Location:dashboardCertif.php');
