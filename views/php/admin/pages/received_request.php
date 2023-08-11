<?php
if (isset($_GET['msg']) && isset($_GET['state'])) {
  $msg = $_GET['msg'];
  $state = $_GET['state'];
}
require_once '../layout/session_start.php';

use MyApp\Admin;

$admin = new Admin();
$received_commands = $admin->getPendingLeaveRequests();
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
        <table class="table table-bordered overflow-auto">
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
            <?php if (count($received_commands) > 0) { ?>
              <?php foreach ($received_commands as $command) : ?>
                <tr>
                  <td><?= $command['full_name'] ?></td>
                  <td><?= $command['type'] ?></td>
                  <td><?= $command['date_debut'] ?></td>
                  <td><?= $command['date_fin'] ?></td>
                  <td>
                    <form action="../helpers/update_status.php" method="post">
                      <input type="hidden" name="id_demande_conge" value="<?= $command['id_demande_conge'] ?>">
                      <select class="form-select" name="status" id="status" onchange="this.form.submit()">
                        <option value="En attente" <?= $command['statut'] == 'En attente' ? 'selected' : '' ?>>En attente</option>
                        <option value="Approuvé" <?= $command['statut'] == 'Approuvé' ? 'selected' : '' ?>>Approuvé</option>
                        <option value="Rejeté" <?= $command['statut'] == 'Rejeté' ? 'selected' : '' ?>>Rejeté</option>
                      </select>
                    </form>
                  </td>

                  <td>
                    <div class="dropdown">
                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="request_details.php?id=<?= $command['id_demande_conge'] ?>"><i class='bx bxs-info-circle bx-tada bx-flip-horizontal'></i> Details</a>
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
    <!-- Msg -->
    <?php if (isset($msg) && $msg !== '') : ?>
      <div class="alert alert-<?php echo $state ? 'success' : 'danger';  ?> alert-dismissible mb-3" role="alert">
        <?= $msg ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif ?>
  </div>
</div>



<?php
$pageContent = ob_get_clean();
$pageTitle = 'Requests in the last week';
require_once '../layout/index.php';
?>