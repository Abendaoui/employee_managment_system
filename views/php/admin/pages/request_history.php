<?php
require_once '../layout/session_start.php';

use MyApp\Admin;

$admin = new Admin();
$processed_commands = $admin->getProcessedLeaveRequests();
ob_start();
?>
<div class="row">
 <div class="col-12">
  <div class="card mb-4">
   <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Received Leave Requests</h5>
    <small class="text-muted float-end">All Requests</small>
   </div>
   <div class="card-body">
    <table class="table table-bordered">
     <thead>
      <tr class="table-row">
       <th>Employee Name</th>
       <th>Leave Type</th>
       <th>Start Date</th>
       <th>End Date</th>
       <th>Status</th>
       <th>Action</th>
      </tr>
     </thead>
     <tbody>
      <!-- PHP loop to populate the table rows with data from the database -->
      <?php if (count($processed_commands) > 0) { ?>
       <?php foreach ($processed_commands as $command) : ?>
        <tr>
         <td><?= $command['full_name'] ?></td>
         <td><?= $command['type'] ?></td>
         <td><?= $command['date_debut'] ?></td>
         <td><?= $command['date_fin'] ?></td>
         <td><?= $command['statut'] ?></td>
         <td>
          <div class="dropdown">
           <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
            <i class="bx bx-dots-vertical-rounded"></i>
           </button>
           <div class="dropdown-menu">
            <a class="dropdown-item" href="request_details.php?id=<?=$command['id_demande_conge'] ?>">
             <i class='bx bxs-info-circle bx-tada bx-flip-horizontal'></i> Details
            </a>
            <a class="dropdown-item text-danger" href="../helpers/delete_request.php?id=<?= $command['id_demande_conge'] ?>">
             <i class='bx bx-trash bx-tada bx-flip-horizontal'></i> Delete</a>
           </div>
          </div>
         </td>
        </tr>
       <?php endforeach; ?>
      <?php } else { ?>
       <tr>
        <td colspan="6">
         No Conge Demande To Display
        </td>
       </tr>
      <?php } ?>
     </tbody>
    </table>
   </div>
  </div>
 </div>
</div>

<?php
$pageContent = ob_get_clean();
$pageTitle = 'Leave Requests History';
require_once '../layout/index.php';
?>