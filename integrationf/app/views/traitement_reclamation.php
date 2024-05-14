<?php
require_once '../models\HistoriqueDAO.php';// Include the config.php file
require_once '..\controllers\ReclamationsC.php';
require_once '..\models\Reclamation.php';

$reclamationC = new ReclamationsC();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form fields
    $name = $_POST['Name'] ?? '';
    $email = $_POST['Email'] ?? '';
    $subject = $_POST['Subject'] ?? '';
    $description = $_POST['Description'] ?? '';
    $idCategorie = $_POST['ID_Categorie'] ?? ''; // Assuming the category ID comes from the form

    if (empty($name) || empty($email) || empty($subject) || empty($description) || empty($idCategorie)) {
        // Handle missing form fields
        echo "Please fill out all form fields.";
        exit;
    }

    // Create a new Reclamation object and set its properties
    $reclamation = new Reclamation();
    $reclamation->setName($name);
    $reclamation->setEmail($email);
    $reclamation->setSubject($subject);
    $reclamation->setDescription($description);
    $reclamation->setIdCategorie($idCategorie);

    // Add the reclamation with details
    $reclamationC->addReclamationWithDetails($reclamation);

    // Redirect to a success page or do something else
    header('Location: success.php');
    exit;
}

?>
