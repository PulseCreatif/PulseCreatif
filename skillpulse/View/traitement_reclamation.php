<?php

require_once 'C:\xampp\htdocs\skillpulse\Controller\ReclamationsC.php';
require_once 'C:\xampp\htdocs\skillpulse\Model\Reclamation.php';

$reclamationC = new ReclamationsC();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all form fields are set
    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['description'])) {
        // Create a new Reclamation object and set its properties
        $reclamation = new Reclamation();
        $reclamation->setName($_POST['name']);
        $reclamation->setEmail($_POST['email']);
        $reclamation->setSubject($_POST['subject']);
        $reclamation->setDescription($_POST['description']);

        // Add the reclamation with details
        $reclamationC->addReclamationWithDetails($reclamation);

        // Redirect to a success page or do something else
        header('Location: success.php');
        exit;
    } else {
        // Handle missing form fields
        echo "Please fill out all form fields.";
    }
}

?>
