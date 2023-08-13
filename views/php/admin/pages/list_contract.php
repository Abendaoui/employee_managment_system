<?php
if (isset($_GET['msg']) && isset($_GET['state'])) {
 $msg = $_GET['msg'];
 $state = $_GET['state'];
}
require_once '../layout/session_start.php';

use MyApp\Admin;

$admin = new Admin();
$contracts = $admin->getAllContracts();
ob_start();
?>
<div class="row">
 <div class="col-12">
  <div class="card mb-4">
   <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Liste des contrats des employés</h5>
    <small class="text-muted float-end">Tous les contrats</small>
   </div>
   <div class="card-body">
    <table class="table table-bordered">
     <thead>
      <tr class="table-row">
       <th>Nom de l'employé</th>
       <th>Date de début</th>
       <th>Date de fin</th>
       <th>Type de contrat</th>
       <th>Salaire</th>
       <th>Statut d'emploi</th>
       <th>Action</th>
      </tr>
     </thead>
     <tbody>
      <!-- PHP loop to populate the table rows with data from the database -->
      <?php foreach ($contracts as $contract) : ?>
       <tr>
        <td><?= $contract['full_name'] ?></td>
        <td><?= $contract['date_debut'] ?></td>
        <td><?= $contract['date_fin'] ?></td>
        <td><?= $contract['type_contrat'] ?></td>
        <td><?= $contract['salaire'] ?> Dh</td>
        <td><?= $contract['statut_emploi'] ?></td>
        <td>
         <div class="dropdown">
          <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
           <i class="bx bx-dots-vertical-rounded"></i>
          </button>
          <div class="dropdown-menu">
           <a class="dropdown-item" href="contract_details.php?id=<?= $contract['id_contrat'] ?>">
            <i class='bx bxs-info-circle bx-tada bx-flip-horizontal'></i> Détails
           </a>
           <a class="dropdown-item" href="edit_contract.php?id=<?= $contract['id_contrat'] ?>">
            <i class="bx bx-edit-alt me-1"></i> Modifier</a>
           <a class="dropdown-item text-danger" href="../helpers/delete_contract.php?id=<?= $contract['id_contrat'] ?>"><i class="bx bx-trash me-1"></i> Delete</a>
          </div>
         </div>
        </td>
       </tr>
      <?php endforeach; ?>
     </tbody>
    </table>

   </div>
  </div>
 </div>
</div>
<!-- Msg -->
<?php if (isset($msg) && $msg !== '') : ?>
 <div class="mt-4 alert alert-<?php echo $state ? 'success' : 'danger';  ?> alert-dismissible mb-3" role="alert">
  <?= $msg ?>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
 </div>
<?php endif ?>
<?php
$pageContent = ob_get_clean();
$pageTitle = 'List Of Contracts';
require_once '../layout/index.php';
?>