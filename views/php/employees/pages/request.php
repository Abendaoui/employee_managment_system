<?php
if (isset($_GET['msg']) && isset($_GET['state'])) {
  $msg = $_GET['msg'];
  $state = $_GET['state'];
}
require '../../../../vendor/autoload.php';
require_once '../layout/session_start.php';

use MyApp\Employee;

$employee = new Employee();
$conge_types = $employee->getAllLeaveTypes();
ob_start();
?>
<div class="row">
  <div class="col-12 col-lg-10 mx-auto">
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Leave Request</h5>
        <small class="text-muted float-end">Enter the details below</small>
      </div>
      <div class="card-body">
        <form action="../helpers/process_request.php" method="post">
          <!-- Leave Type -->
          <div class="mb-3">
            <label class="form-label" for="leave_type">Leave Type</label>
            <select class="form-select" id="leave_type" name="leave_type" required>
              <option value="" selected disabled>Select Leave Type</option>
              <?php foreach ($conge_types as $type) : ?>
                <option value="<?= $type['id_type_conge'] ?>"><?= $type['nom_type_conge'] ?></option>
              <?php endforeach ?>
            </select>
          </div>
          <!-- Start Date -->
          <div class="mb-3">
            <label class="form-label" for="start_date">Start Date</label>
            <div class="input-group input-group-merge">
              <span class="input-group-text"><i class="bx bx-calendar"></i></span>
              <input type="date" class="form-control" id="start_date" name="start_date" required />
            </div>
          </div>
          <!-- End Date -->
          <div class="mb-3">
            <label class="form-label" for="end_date">End Date</label>
            <div class="input-group input-group-merge">
              <span class="input-group-text"><i class="bx bx-calendar"></i></span>
              <input type="date" class="form-control" id="end_date" name="end_date" required />
            </div>
          </div>
          <!-- Comments -->
          <div class="mb-3">
            <label class="form-label" for="comments">Comments</label>
            <div class="input-group input-group-merge">
              <span class="input-group-text"><i class="bx bx-comment"></i></span>
              <textarea id="comments" class="form-control" name="comments" rows="4" placeholder="Enter comments" required></textarea>
            </div>
          </div>
          <?php if (isset($msg) && $msg !== '') : ?>
            <div class="alert alert-<?php echo $state ? 'success' : 'danger';  ?> alert-dismissible mb-3" role="alert">
              <?= $msg ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php endif ?>
          <button type="submit" name="submit" class="btn btn-primary">Submit Request</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php
$pageContent = ob_get_clean();
$pageTitle = 'Leave Request';
require_once '../layout/index.php';
?>