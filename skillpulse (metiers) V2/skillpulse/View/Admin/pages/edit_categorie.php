<?php
// Include necessary files and classes
require_once 'C:\xampp\htdocs\skillpulse\config.php'; // Assuming you have a config.php file for database connection
require_once 'C:\xampp\htdocs\skillpulse\Model\Categorie.php';
require_once 'C:\xampp\htdocs\skillpulse\Controller\CategorieC.php';

// Initialize CategorieC object
$categorieC = new CategorieC();

// Check if the category ID is provided in the URL
if (isset($_GET['ID_Categorie'])) {
    $categorieId = $_GET['ID_Categorie'];

    // Retrieve the category details from the database
    $categorie = $categorieC->getCategoryById($categorieId);

    // Check if the category exists
    if ($categorie) {
        // Now you have the category details, you can display the edit form
        ?>
        <!-- HTML form for editing the category -->



        <!DOCTYPE html>
<html lang="en">
<?php include 'Head.php'; ?>

<body class="g-sidenav-show  bg-gray-100">
  <?php include 'sidebar.php'; ?>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

    <?php include 'NavBar.php'; ?>

    
        <form method="POST" action="process_categorie.php">
            <!-- Hidden input field to store the category ID -->
            <input type="hidden" name="ID_Categorie" value="<?php echo $categorie['ID_Categorie']; ?>">
            <!-- Input fields to edit category details -->
            <div class="mb-3">
                <label for="Nom_Categorie" class="form-label">Nom Categorie</label>
                <input type="text" class="form-control" id="Nom_Categorie" name="Nom_Categorie"
                    value="<?php echo $categorie['Nom_Categorie']; ?>">
            </div>
            <div class="mb-3">
                <label for="Description_Categorie" class="form-label">Description Categorie</label>
                <input type="text" class="form-control" id="Description_Categorie" name="Description_Categorie"
                    value="<?php echo $categorie['Description_Categorie']; ?>">
            </div>
            <button type="submit" class="btn btn-primary" name="edit_category">Save Changes</button>
        </form>


        


  </main>

<?php include 'Scripts.php'; ?>

</body>

</html>



        <?php
    } else {
        // Category not found, display error message or redirect to error page
        echo "Error: Category not found.";
    }
} else {
    // No category ID provided in the URL, display error message or redirect to error page
    echo "Error: Category ID not provided.";
}
?>
