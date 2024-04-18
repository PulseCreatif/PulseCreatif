<?php

// Include necessary files and classes
require_once 'C:\xampp\htdocs\skillpulse\config.php'; // Assuming you have a config.php file for database connection
require_once 'C:\xampp\htdocs\skillpulse\Model\Reclamation.php';
require_once 'C:\xampp\htdocs\skillpulse\Controller\ReclamationsC.php';

// Initialize ReclamationsC object
$reclamationsC = new ReclamationsC();

// Add Reclamation
if (isset($_POST['add'])) {
    $type = $_POST['type'] ?? '';
    $etat = $_POST['etat'] ?? '';
    $description = $_POST['description'] ?? '';
    $email = $_POST['email'] ?? '';

    // Check if all required fields are present
    if (!empty($type) && !empty($etat) && !empty($description) && !empty($email)) {
        $reclamation = new Reclamation();
        $reclamation->setType($type);
        $reclamation->setEtat($etat);
        $reclamation->setDescription($description);
        $reclamation->setEmail($email);

        $reclamationsC->addReclamation($reclamation);

        // Redirect to the page after adding
        header('Location: Reclamation.php'); // Replace 'destination.php' with the appropriate page
        exit();
    } else {
        // Handle empty fields error
        echo "All fields are required!";
        exit();
    }
}

// Update Reclamation
if (isset($_POST['edit'])) {
    $id = $_POST['id'] ?? '';
    $type = $_POST['type'] ?? '';
    $etat = $_POST['etat'] ?? '';
    $description = $_POST['description'] ?? '';
    $email = $_POST['email'] ?? '';

    // Check if all required fields are present
    if (!empty($id) && !empty($type) && !empty($etat) && !empty($description) && !empty($email)) {
        $reclamation = new Reclamation();
        $reclamation->setIdR($id);
        $reclamation->setType($type);
        $reclamation->setEtat($etat);
        $reclamation->setDescription($description);
        $reclamation->setEmail($email);

        $reclamationsC->modifyReclamation($reclamation);

        // Redirect to the page after updating
        header('Location: Reclamation.php'); // Replace 'Reclamation.php' with the appropriate page
        exit();
    } else {
        // Handle empty fields error
        echo "All fields are required!";
        exit();
    }
}

// Delete Reclamation
if (isset($_GET['delete'])) {
    $id = $_GET['delete'] ?? '';
    if (!empty($id)) {
        $reclamationsC->deleteReclamation($id);

        // Redirect back to the page after deleting
        header('Location: Reclamation.php'); // Replace 'Reclamation.php' with the appropriate page
        exit();
    } else {
        // Handle invalid or missing ID error
        echo "Invalid or missing ID!";
        exit();
    }
}

// Search Reclamation
if (isset($_POST['search'])) {
    // Handle search logic here
}

// Handle other cases or errors
?>
