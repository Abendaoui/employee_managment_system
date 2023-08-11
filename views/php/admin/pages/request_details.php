<?php
require_once '../layout/session_start.php';

use MyApp\Admin;

$admin = new Admin();
$id = $_GET['id'] ?? '';
$demandeConge = $admin->getDemandeCongeById($id);
ob_start();
?>
<div class="container">
 <h1 class="mt-4">Demande Conge Details</h1>

 <div class="row training-details mt-4">
  <div class="col-md-10 mx-auto offset-md-2">
   <div class="card rounded-3">
    <div class="bg-primary text-white p-3 d-flex justify-content-center align-content-center">
     <h4 class="text-white mt-2">Demande Conge Details</h4>
    </div>
    <div class="card-body text-capitalize">
     <h5 class="card-title"><strong>ID:</strong> <?= $demandeConge['id_demande_conge'] ?></h5>
     <p class="card-text"><strong>Employee ID:</strong> <?= $demandeConge['name'] ?></p>
     <p class="card-text"><strong>Type Conge ID:</strong> <?= $demandeConge['type'] ?></p>
     <p class="card-text"><strong>Date Debut:</strong> <?= $demandeConge['date_debut'] ?></p>
     <p class="card-text"><strong>Date Fin:</strong> <?= $demandeConge['date_fin'] ?></p>
     <p class="card-text"><strong>Total Jours:</strong> <?= $demandeConge['jours_totales'] ?></p>
     <p class="card-text"><strong>Statut:</strong>
      <span class="status-badge status-<?= $demandeConge['statut'] ?>">
       <?= $demandeConge['statut'] ?>
      </span>
     </p>
     <p class="card-text"><strong>Commentaires:</strong> <?= $demandeConge['commentaires'] ?></p>
    </div>
   </div>
  </div>
 </div>
</div>







<?php
$pageContent = ob_get_clean();
$pageTitle = 'Request Datils';
require_once '../layout/index.php';
?>