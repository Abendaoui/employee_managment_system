<?php
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
    <h5 class="mb-0">List of Employees Contracts</h5>
    <small class="text-muted float-end">All Contracts</small>
   </div>
   <div class="card-body">
    <table class="table table-bordered">
     <thead>
      <tr class="table-row">
       <th>Employee Name</th>
       <th>Start Date</th>
       <th>End Date</th>
       <th>Contract Type</th>
       <th>Salary</th>
       <th>Employment Status</th>
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
            <i class='bx bxs-info-circle bx-tada bx-flip-horizontal'></i> Details
           </a>
           <a class="dropdown-item" href="edit_contract.php?id=<?= $x ?>">
            <i class="bx bx-edit-alt me-1"></i> Edit</a>
           <a class="dropdown-item text-danger" href="delete_contract.php?id=<?= $x ?>"><i class="bx bx-trash me-1"></i> Delete</a>
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
<?php
$pageContent = ob_get_clean();
$pageTitle = 'List Of Contracts';
require_once '../layout/index.php';
?>