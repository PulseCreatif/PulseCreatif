<!DOCTYPE html>
<html lang="en">
<?php include 'Head.php'; ?>
<body class="g-sidenav-show bg-gray-100">
  <?php include 'sidebar.php'; ?>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

  <?php include 'NavBar.php'; ?>

  <!-- Edit Reclamation Form -->
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-md-6">
        <?php
        require_once 'C:\xampp\htdocs\skillpulse\config.php'; // Assuming you have a config.php file for database connection
        require_once 'C:\xampp\htdocs\skillpulse\Model\Reclamation.php';
        require_once 'C:\xampp\htdocs\skillpulse\Controller\ReclamationsC.php';

        // Initialize ReclamationsC object
        $reclamationC = new ReclamationsC();

        // Check if the reclamation ID is provided in the URL
        if (isset($_GET['idR']) && !empty($_GET['idR'])) { // Check if 'edit' parameter is set and not empty
            $reclamationId = $_GET['idR'];

            // Retrieve the reclamation details from the database
            $reclamationToEdit = $reclamationC->getReclamationById($reclamationId);

            // Check if the reclamation exists
            if ($reclamationToEdit) {
                // Now you have the reclamation details, you can display the edit form
                ?>
                <!-- HTML form for editing the reclamation -->
                <form method="POST" action="process_reclamation.php">
                    <!-- Hidden input field to store the reclamation ID -->
                    <input type="hidden" name="idR" value="<?php echo $reclamationToEdit['idR']; ?>">
                    <!-- Input fields to edit reclamation details -->
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <input type="text" class="form-control" id="type" name="type" value="<?php echo $reclamationToEdit['Type']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="etat" class="form-label">Etat</label>
                        <input type="text" class="form-control" id="etat" name="etat" value="<?php echo $reclamationToEdit['Etat']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="description" name="description" value="<?php echo $reclamationToEdit['Description']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $reclamationToEdit['Email']; ?>">
                    </div>
                    <button type="submit" class="btn btn-success" name="edit">Update Reclamation</button>
                </form>
                <?php
            } else {
                // Reclamation not found, display error message or redirect to error page
                echo "Error: Reclamation not found.";
            }
        } else {
            // No reclamation ID provided in the URL, display error message or redirect to error page
            echo "Error: Reclamation ID not provided.";
        }
        ?>
      </div>
    </div>
  </div>

  </main>

  <?php include 'Scripts.php'; ?>

</body>
</html>
