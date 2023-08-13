<?php
require_once '../layout/session_start.php';

use MyApp\Admin;

$admin = new Admin();
$id = $_GET['id'] ?? '';
$demandeConge = $admin->getDemandeCongeById($id);
ob_start();
?>
<div class="container">
 <h1 class="mt-4">Demande Congé Détails</h1>

 <div class="row training-details mt-4">
  <div class="col-md-10 mx-auto offset-md-2">
   <div class="card rounded-3">
    <div class="bg-primary text-white p-3 d-flex justify-content-center align-content-center">
     <h4 class="text-white mt-2">Demande Congé Détails</h4>
    </div>
    <div class="card-body text-capitalize">
     <p class="card-text"><strong>Employé:</strong> <?= $demandeConge['name'] ?></p>
     <p class="card-text"><strong>Type Congé:</strong> <?= $demandeConge['type'] ?></p>
     <p class="card-text"><strong>Date de début:</strong> <?= $demandeConge['date_debut'] ?></p>
     <p class="card-text"><strong>Date fin:</strong> <?= $demandeConge['date_fin'] ?></p>
     <p class="card-text"><strong>Nombre total de jours:</strong> <?= (int)$demandeConge['jours_totales'] ?></p>
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