<?php
require_once(__DIR__.'/../../app/controllers/UserC.php');
require_once(__DIR__.'/../../app/models/User.php');

$userC = new UserController();
if (isset($_GET["id"])) {
    $userC->deleteUser($_GET["id"]);
    header("Location:pages/dashboardUser.php");
}
else {
    echo "Missing id get parameter";
}