<?php
include '../../../Controller/ReclamationsC.php';
require_once '../../../Model/Reclamation.php';

$reclamationC = new ReclamationsC();

if (isset($_GET['id'])) {
  $reclamationToEdit = $reclamationC->getReclamationById($_GET['id']);
}

if (isset($_POST['add']) || isset($_POST['edit'])) {
  if (isset($_POST['add'])) {
    $reclamation = new Reclamation();
    $reclamation->setType($_POST['type']);
    $reclamation->setEtat($_POST['etat']);
    $reclamation->setDescription($_POST['description']);
    $reclamation->setEmail($_POST['email']);
    $reclamationC->addReclamation($reclamation);
  } else if (isset($_POST['edit'])) {
    $reclamation = new Reclamation();
    $reclamation->setIdR($_POST['id']);
    $reclamation->setType($_POST['type']);
    $reclamation->setEtat($_POST['etat']);
    $reclamation->setDescription($_POST['description']);
    $reclamation->setEmail($_POST['email']);
    $reclamationC->modifyReclamation($reclamation);
  }
  header('Location: Reclamation.php');
}

if (isset($_POST['search'])) {
  $listeReclamations = $reclamationC->listResearcher($_POST['search_text']);
} else if (isset($_POST['tri'])) {
  $listeReclamations = $reclamationC->listReclamations(); // Assuming this is the intended function for sorting
} else {
  $listeReclamations = $reclamationC->listReclamations();
}
?>


<!DOCTYPE html>
<html lang="en">
<?php include 'Head.php'; ?>
<body class="g-sidenav-show  bg-gray-100">
  <?php include 'sidebar.php'; ?>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

  <?php include 'NavBar.php'; ?>





    <!-- Reclamation Table code -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Reclamations table</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Type</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Etat</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Name</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Subject</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Description</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($listeReclamations as $reclamation): ?>
                      <tr>
                        <td>
                          <p class="text-xs font-weight-bold mb-0"><?php echo $reclamation['Type']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                          <span class="text-secondary text-xs font-weight-bold"><?php echo $reclamation['Etat']; ?></span>
                        </td>


                        <td class="align-middle text-center text-sm">
                          <span class="text-secondary text-xs font-weight-bold"><?php echo $reclamation['Name']; ?></span>
                        </td>

                        <td class="align-middle text-center text-sm">
                          <span class="text-secondary text-xs font-weight-bold"><?php echo $reclamation['Subject']; ?></span>
                        </td>

                        <td class="align-middle text-center text-sm">
                          <span class="text-secondary text-xs font-weight-bold"><?php echo $reclamation['Description']; ?></span>
                        </td>
                        <td class="align-middle text-center text-sm">
                          <span class="text-secondary text-xs font-weight-bold"><?php echo $reclamation['Email']; ?></span>
                        </td>


                        <td class="align-middle">
                          <a href="?edit=<?php echo $reclamation['idR']; ?>" class="btn btn-sm btn-secondary me-2" data-toggle="tooltip" data-original-title="Edit reclamation">Edit</a>
                          <a href="process_reclamation.php?delete=<?php echo $reclamation['idR']; ?>" class="btn btn-sm btn-danger" data-toggle="tooltip" data-original-title="Delete reclamation">Delete</a>
                        </td>


                        
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>






   <!-- Add and Edit Reclamation Form -->
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-md-6">
      <!-- Form for adding a new reclamation -->
      <form method="POST" action="process_reclamation.php" onsubmit="return validateReclamationForm()">
        <div class="mb-3">
          <label for="type" class="form-label">Type</label>
          <input type="text" class="form-control" id="type" name="type" value="">
        </div>
        <div class="mb-3">
          <label for="etat" class="form-label">Etat</label>
          <input type="text" class="form-control" id="etat" name="etat" value="">
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <input type="text" class="form-control" id="description" name="description" value="">
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email" value="">
        </div>
        <button type="submit" class="btn btn-primary" name="add">Add Reclamation</button>
      </form>
    </div>
  </div>
</div>

<script>
  function validateReclamationForm() {
    var type = document.getElementById("type").value;
    var etat = document.getElementById("etat").value;
    var description = document.getElementById("description").value;
    var email = document.getElementById("email").value;

    var errors = [];

    if (type.trim() === "") {
      errors.push("Type is required");
    }

    if (etat.trim() === "") {
      errors.push("Etat is required");
    }

    if (description.trim() === "") {
      errors.push("Description is required");
    }

    // Email validation
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
      errors.push("Invalid email format");
    }

    if (errors.length > 0) {
      // Display error messages
      var errorMessage = errors.join("\n");
      alert(errorMessage);
      return false; // Prevent form submission
    }

    return true; // Allow form submission
  }
</script>





          <!-- Form for editing a reclamation -->
          <?php if(isset($_GET['edit'])): ?>
            <?php $reclamationToEdit = $reclamationC->getReclamationById($_GET['edit']); ?>
            <form method="POST" action="process_reclamation.php">
            <input type="hidden" name="id" value="<?php echo $reclamationToEdit['idR']; ?>">
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
          <?php endif; ?>
        </div>
      </div>
    </div>

  </main>

  <?php include 'Scripts.php'; ?>

</body>
</html>