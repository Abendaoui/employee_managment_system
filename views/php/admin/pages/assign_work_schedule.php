<?php
if (isset($_GET['msg']) && isset($_GET['state'])) {
 $msg = $_GET['msg'];
 $state = $_GET['state'];
}
require_once '../layout/session_start.php';

use MyApp\Admin;

$admin = new Admin();
$employees = $admin->getAllEmployeessWithDepartments();
ob_start();
?>
<div class="row">
 <div class="col-12 col-lg-8 mx-auto">
  <div class="card mb-4">
   <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Add Work Schedule For August</h5>
    <small class="text-muted float-end">Enter the details below</small>
   </div>
   <div class="card-body">
    <form action="../helpers/assign_action.php" method="POST">
     <!-- Employee -->
     <div class="mb-3">
      <label class="form-label" for="employee_name">Employee Name</label>
      <div class="input-group input-group-merge">
       <span class="input-group-text"><i class="bx bx-user"></i></span>
       <select class="form-select" name="employee_id" id="employee_name" aria-label="Select Employee">
        <option value="" disabled selected>Select an Employee</option>
        <?php foreach ($employees as $employee) : ?>
         <option value="<?= $employee['id_employe'] ?>">
          <?php echo $employee['nom'] . ' ' . $employee['prenom'] ?>
         </option>
        <?php endforeach; ?>
       </select>
      </div>
     </div>
     <!-- clock-in clock-out -->
     <div class="row mb-3 row-space">
      <div class="col-6">
       <label class="form-label" for="shift_start_time">Shift Start Time</label>
       <div class="input-group input-group-merge">
        <span class="input-group-text"><i class="bx bx-time"></i></span>
        <input type="time" class="form-control" id="shift_start_time" name="heure_entree" />
       </div>
      </div>
      <div class="col-6">
       <label class="form-label" for="shift_end_time">Shift End Time</label>
       <div class="input-group input-group-merge">
        <span class="input-group-text"><i class="bx bx-time"></i></span>
        <input type="time" class="form-control" id="shift_end_time" name="heure_sortie" />
       </div>
      </div>
     </div>
     <!-- Date Day -->
     <div class="mb-3">
      <label class="form-label" for="work_date">Work Date</label>
      <div class="input-group input-group-merge">
       <span class="input-group-text"><i class="bx bx-calendar"></i></span>
       <input type="date" class="form-control" id="work_date" name="date_travail" />
      </div>
     </div>
     <!-- Msg -->
     <?php if (isset($msg) && $msg !== '') : ?>
      <div class="alert alert-<?php echo $state ? 'success' : 'danger';  ?> alert-dismissible mb-3" role="alert">
       <?= $msg ?>
       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
     <?php endif ?>
     <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
   </div>
  </div>
 </div>
</div>

<?php
$pageContent = ob_get_clean();
$pageTitle = 'Assign Work Schedule';
require_once '../layout/index.php';
?>