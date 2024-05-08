<?php
include '../Controller/ReclamationsC.php';

if (isset($_POST['email'])) {
    $reclamationC = new ReclamationsC();
    $results = $reclamationC->chercherReclamationParEmail($_POST['email']);
    echo json_encode($results);
}
?>
