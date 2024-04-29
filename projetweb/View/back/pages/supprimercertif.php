<?php
include 'C:/xampp/htdocs/projetweb/Controller/certifC.php';
$CertifC = new CertifC();
$CertifC->deletecertif($_GET['Id_Cert']);
header('Location:certificatb.php');
