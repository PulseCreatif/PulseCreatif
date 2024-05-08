<!DOCTYPE html>
<html lang="en">
<?php include 'Head.php'; ?>
<body class="g-sidenav-show bg-gray-100">
  <?php include 'sidebar.php'; ?>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

  <?php include 'NavBar.php'; ?>

  <!-- Historique Table code -->
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6>Historique des Actions</h6>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Date</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Table Concernée</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">ID Ligne Modifiée</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Utilisateur</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    require_once 'C:\xampp\htdocs\skillpulse\Model\HistoriqueDAO.php';
                    $historiqueEntries = HistoriqueDAO::getHistorique();
                    foreach ($historiqueEntries as $entry):
                  ?>
                    <tr>
                      <td><?php echo $entry['date_action']; ?></td>
                      <td><?php echo $entry['action_type']; ?></td>
                      <td><?php echo $entry['table_concernee']; ?></td>
                      <td><?php echo $entry['id_ligne_modifiee']; ?></td>
                      <td><?php echo $entry['utilisateur_id']; ?></td>
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

  <!-- Button to go back to the previous page -->
  <div class="container-fluid py-2">
    <div class="row">
      <div class="col-12">
        <button class="btn btn-primary" onclick="goBack()">Go Back</button>
      </div>
    </div>
  </div>

  </main>

  <?php include 'Scripts.php'; ?>

  <script>
    // JavaScript function to go back to the previous page
    function goBack() {
      window.history.back();
    }
  </script>

</body>
</html>
