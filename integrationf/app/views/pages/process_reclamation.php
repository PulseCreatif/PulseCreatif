<?php
require_once '../../models\HistoriqueDAO.php';
require_once '../../models\Reclamation.php';
require_once '../../controllers\ReclamationsC.php';

// Initialize ReclamationsC object
$reclamationsC = new ReclamationsC();

// Add Reclamation
if (isset($_POST['add_Rec'])) {
    // Retrieve form data
    $type = $_POST['Type'] ?? '';
    $etat = $_POST['Etat'] ?? '';
    $description = $_POST['Description'] ?? '';
    $email = $_POST['Email'] ?? '';

    // Check if all required fields are present and not empty
    if (!empty($type) && !empty($etat) && !empty($description) && !empty($email)) {
        // Create Reclamation object and set properties
        $reclamation = new Reclamation();
        $reclamation->setType($type);
        $reclamation->setEtat($etat);
        $reclamation->setDescription($description);
        $reclamation->setEmail($email);

        // Add the reclamation
        $reclamationsC->addReclamation($reclamation);

        // Redirect to the page after adding
        header('Location: Reclamation.php'); // Replace 'Reclamation.php' with the appropriate page
        exit();
    } else {
        // Handle empty fields error
        echo "All fields are required!";
        exit();
    }
}


// Update Reclamation
if (isset($_POST['edit'])) {
    $idR = $_POST['idR'] ?? '';
    $type = $_POST['type'] ?? '';
    $etat = $_POST['etat'] ?? '';
    $description = $_POST['description'] ?? '';
    $email = $_POST['email'] ?? '';

    // Check if all required fields are present
    if (!empty($idR) && !empty($type) && !empty($etat) && !empty($description) && !empty($email)) {
        // Debugging: Output the values of fields to check if they are empty
        echo "idR: $idR<br>";
        echo "Type: $type<br>";
        echo "Etat: $etat<br>";
        echo "Description: $description<br>";
        echo "Email: $email<br>";

        $reclamation = new Reclamation();
        $reclamation->setIdR($idR);
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
