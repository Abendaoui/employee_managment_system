<?php
require_once '../layout/session_start.php';

use MyApp\Admin;

$admin = new Admin();
$id = $_GET['id'] ?? 1;
$target_formation = $admin->getFormationById($id);
ob_start();
?>
<div class="container">
 <h1 class="mt-4">Formation <?= $target_formation['title'] ?></h1>

 <div class="row training-details mt-4 ">
  <div class="col-md-10 mx-auto offset-md-2">
   <div class="card rounded-3">
    <div class="bg-primary text-white p-3 d-flex justify-content-center align-content-center">
     <h4 class="text-white mt-2">Formation <?= $target_formation['title'] ?></h4>
    </div>
    <div class="card-body text-capitalize">
     <h5 class="card-title"><strong>Title:</strong><?= $target_formation['title'] ?></h5>
     <p class="card-text"><strong>Description:</strong>
      <?= $target_formation['description'] ?>
     </p>
     <p class="card-text"><strong>Date de début:</strong> <?= $target_formation['date_start'] ?></p>
     <p class="card-text"><strong>Date de fin:</strong> <?= $target_formation['date_end'] ?></p>
     <p class="card-text"><strong>Expéditeur:</strong> <?= $_SESSION['name']; ?>
     </p>
     <p class="card-text"><strong>Statut:</strong>
      <span class="status-badge status-<?= $target_formation['status'] ?>">
       <?= $target_formation['status'] ?>
      </span>
    </p>
     <p class="card-text"><strong>Date d'envoi:</strong> <?= $target_formation['date_sent'] ?></p>
    </div>
   </div>
  </div>
 </div>
</div>
<?php
$pageContent = ob_get_clean();
$pageTitle = 'Add Formation';
require_once '../layout/index.php';
?>