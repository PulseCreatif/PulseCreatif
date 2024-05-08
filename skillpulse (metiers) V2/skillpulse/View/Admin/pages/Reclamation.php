<?php
include '../../../Controller/ReclamationsC.php';
include '../../../Controller/CategorieC.php';
require_once '../../../Model/Reclamation.php';
require_once '../../../Model/Categorie.php';

$reclamationC = new ReclamationsC();
$categorieC = new CategorieC();

  $listeReclamations = $reclamationC->listReclamations();
  $listeCategories = $categorieC->listCategories();

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
          <!-- Button to redirect to stat.php -->
          <a href="stat.php" class="btn btn-primary">View Statistics</a>
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
                      <a href="edit_reclamation.php?idR=<?php echo $reclamation['idR']; ?>" class="btn btn-sm btn-secondary me-2" data-toggle="tooltip" data-original-title="Edit">Edit</a>
                      <a href="process_reclamation.php?delete=<?php echo $reclamation['idR']; ?>" class="btn btn-sm btn-danger" data-toggle="tooltip" data-original-title="Delete reclamation" onclick="return confirm('Are you sure you want to delete this reclamation?');">Delete</a>
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




<!-- Add Reclamation Form -->
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-md-6">
      <form method="POST" action="process_reclamation.php" enctype="multipart/form-data" onsubmit="return validateReclamationForm()">
        <div class="mb-3">
          <label for="Type" class="form-label">Type</label>
          <input type="text" class="form-control" id="Type" name="Type" value="" oninput="validateField('Type')">
          <div id="TypeError" class="error-message"></div> <!-- Error message container -->
        </div>
        <div class="mb-3">
          <label for="Etat" class="form-label">Etat</label>
          <input type="text" class="form-control" id="Etat" name="Etat" value="" oninput="validateField('Etat')">
          <div id="EtatError" class="error-message"></div> <!-- Error message container -->
        </div>
        <div class="mb-3">
          <label for="Description" class="form-label">Description</label>
          <input type="text" class="form-control" id="Description" name="Description" value="" oninput="validateField('Description')">
          <div id="DescriptionError" class="error-message"></div> <!-- Error message container -->
        </div>
        <div class="mb-3">
          <label for="Email" class="form-label">Email</label>
          <input type="email" class="form-control" id="Email" name="Email" value="" oninput="validateField('Email')">
          <div id="EmailError" class="error-message"></div> <!-- Error message container -->
        </div>
        <button type="submit" class="btn btn-primary" name="add_Rec">Add Reclamation</button>
      </form>
    </div>
  </div>
</div>

<script>
  function validateField(fieldName) {
    var fieldValue = document.getElementById(fieldName).value;
    var errorContainer = document.getElementById(fieldName + "Error");

    if (fieldName === "Description") {
      if (fieldValue.length > 200) {
        errorContainer.textContent = "Description must be less than 200 characters";
      } else {
        errorContainer.textContent = "";
      }
    } else if (fieldName === "Email") {
      var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(fieldValue)) {
        errorContainer.textContent = "Invalid email format";
      } else {
        errorContainer.textContent = "";
      }
    } else {
      var letterRegex = /^[A-Za-z]+$/;
      if (!letterRegex.test(fieldValue)) {
        errorContainer.textContent = fieldName + " should only contain letters";
      } else {
        errorContainer.textContent = "";
      }
    }
  }

  function validateReclamationForm() {
    var errors = [];

    var type = document.getElementById("Type").value;
    var etat = document.getElementById("Etat").value;
    var description = document.getElementById("Description").value;
    var email = document.getElementById("Email").value;

    if (type.trim() === "") {
      errors.push("Type is required");
    }

    if (etat.trim() === "") {
      errors.push("Etat is required");
    }

    if (description.trim() === "") {
      errors.push("Description is required");
    } else if (description.length > 200) {
      errors.push("Description must be less than 200 characters");
    }

    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
      errors.push("Invalid email format");
    }

    if (errors.length > 0) {
      var errorMessage = errors.join("\n");
      alert(errorMessage);
      return false;
    }

    return true;
  }
</script>


<!-- Categories Table code -->
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Categories table</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">ID</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Description</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Loop through categories -->
                                <?php foreach ($listeCategories as $category): ?>
                                <tr>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0"><?php echo $category['ID_Categorie']; ?></p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="text-secondary text-xs font-weight-bold"><?php echo $category['Nom_Categorie']; ?></span>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="text-secondary text-xs font-weight-bold"><?php echo $category['Description_Categorie']; ?></span>
                                    </td>
                                    <td class="align-middle">
                                        <a href="edit_categorie.php?ID_Categorie=<?php echo $category['ID_Categorie']; ?>"
                                            class="btn btn-sm btn-secondary me-2" data-toggle="tooltip"
                                            data-original-title="Edit">Edit</a>
                                            <a href="process_categorie.php?delete=<?php echo $category['ID_Categorie']; ?>" class="btn btn-sm btn-danger" data-toggle="tooltip" data-original-title="Delete" onclick="return confirm('Are you sure you want to delete this category?');">Delete</a>

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



<!-- Form for adding a new category -->
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-6">
            <form method="POST" action="process_categorie.php" onsubmit="return validateCategoryForm()">
                <div class="mb-3">
                    <label for="Nom_Categorie" class="form-label">Nom Categorie</label>
                    <input type="text" class="form-control" id="Nom_Categorie" name="Nom_Categorie" value="" oninput="validateField('Nom_Categorie')">
                    <div id="NomCategorieError" class="error-message"></div> <!-- Error message container -->
                </div>
                <div class="mb-3">
                    <label for="Description_Categorie" class="form-label">Description Categorie</label>
                    <input type="text" class="form-control" id="Description_Categorie" name="Description_Categorie" value="" oninput="validateField('Description_Categorie')">
                    <div id="DescriptionCategorieError" class="error-message"></div> <!-- Error message container -->
                </div>
                <button type="submit" class="btn btn-primary" name="add_category">Add Category</button>
            </form>
        </div>
    </div>
</div>

<script>
    function validateField(fieldName) {
        var fieldValue = document.getElementById(fieldName).value;
        var errorContainer = document.getElementById(fieldName + "Error");

        if (fieldName === "Description_Categorie") {
            if (fieldValue.length > 200) {
                errorContainer.textContent = "Description Categorie must be less than 200 characters";
            } else {
                errorContainer.textContent = "";
            }
        } else {
            var letterRegex = /^[A-Za-z]+$/;
            if (!letterRegex.test(fieldValue)) {
                errorContainer.textContent = fieldName + " should only contain letters";
            } else {
                errorContainer.textContent = "";
            }
        }
    }

    function validateCategoryForm() {
        var errors = [];

        var nomCategorie = document.getElementById("Nom_Categorie").value;
        var descriptionCategorie = document.getElementById("Description_Categorie").value;

        if (nomCategorie.trim() === "") {
            errors.push("Nom Categorie is required");
        }

        if (descriptionCategorie.trim() === "") {
            errors.push("Description Categorie is required");
        } else if (descriptionCategorie.length > 200) {
            errors.push("Description Categorie must be less than 200 characters");
        }

        if (errors.length > 0) {
            var errorMessage = errors.join("\n");
            alert(errorMessage);
            return false;
        }

        return true;
    }
</script>






  </main>

  <?php include 'Scripts.php'; ?>

</body>
</html>