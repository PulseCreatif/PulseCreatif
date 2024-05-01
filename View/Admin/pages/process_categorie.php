<?php
require_once 'C:\xampp\htdocs\skillpulse\config.php'; 
require_once 'C:\xampp\htdocs\skillpulse\Controller\CategorieC.php'; 
require_once 'C:\xampp\htdocs\skillpulse\Model\Categorie.php'; 

// Initialize CategorieC object
$categorieC = new CategorieC();

// Add Category
if (isset($_POST['add_category'])) {
    // Check if all required fields are present
    if (isset($_POST['Nom_Categorie'], $_POST['Description_Categorie'])) {
        $Nom_Categorie = $_POST['Nom_Categorie'];
        $Description_Categorie = $_POST['Description_Categorie'];

        // Check if any required field is empty
        if (!empty($Nom_Categorie) && !empty($Description_Categorie)) {
            $category = new Categorie();
            $category->setNom_Categorie($Nom_Categorie);
            $category->setDescription_Categorie($Description_Categorie);

            $categorieC->addCategory($category);

            // Redirect to the appropriate page after adding
            header('Location: Reclamation.php'); // Replace 'categories.php' with the appropriate page
            exit();
        }
    }

    // Display error message if any field is missing or empty
    echo "All fields are required for adding a category."; 
    exit();
}

// Update Category
if (isset($_POST['edit_category'])) {
    // Check if all required fields are present
    if (isset($_POST['ID_Categorie'], $_POST['Nom_Categorie'], $_POST['Description_Categorie'])) {
        $ID_Categorie = $_POST['ID_Categorie'];
        $Nom_Categorie = $_POST['Nom_Categorie'];
        $Description_Categorie = $_POST['Description_Categorie'];

        // Check if any required field is empty
        if (!empty($ID_Categorie) && !empty($Nom_Categorie) && !empty($Description_Categorie)) {
            $category = new Categorie();
            $category->setID_Categorie($ID_Categorie);
            $category->setNom_Categorie($Nom_Categorie);
            $category->setDescription_Categorie($Description_Categorie);

            $categorieC->updateCategory($category);

            // Redirect to the appropriate page after updating
            header('Location: Reclamation.php'); // Replace 'categories.php' with the appropriate page
            exit();
        }
    }

    // Display error message if any field is missing or empty
    echo "All fields are required for updating a category."; 
    exit();
}


// Delete Reclamation
if (isset($_GET['delete'])) {
    $ID_Categorie = $_GET['delete'] ?? '';
    if (!empty($ID_Categorie)) {
        $categorieC->deleteCategory($ID_Categorie);

        // Redirect back to the page after deleting
        header('Location: Reclamation.php'); // Replace 'Reclamation.php' with the appropriate page
        exit();
    } else {
        // Handle invalid or missing ID error
        echo "Invalid or missing ID!";
        exit();
    }
}



?>
