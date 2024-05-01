<?php
include __DIR__.'/../controllers/EvaluationC.php';
include __DIR__.'/../models/evaluation.php';

$EvaluationC = new EvaluationController();
if (isset($_GET["id"])) {
    $EvaluationC->deleteEvaluation($_GET["id"]);
    header("Location:pages/evaluation.php");
} else {
    echo "ID de l'évaluation manquant dans le paramètre GET";
}
?>
