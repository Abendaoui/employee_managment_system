<?php
if (isset($_GET['msg']) && isset($_GET['state'])) {
 $msg = $_GET['msg'];
 $state = $_GET['state'];
}
ob_start();
?>
<div class="row">
 <div class="col-12 col-lg-10 mx-auto">
  <div class="card mb-4">
   <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Add Department</h5>
    <small class="text-muted float-end">Enter Department Details</small>
   </div>
   <div class="card-body">
    <form action="../helpers/add_dep_action.php" method="POST">
     <!-- Department Name -->
     <div class="mb-3">
      <label class="form-label" for="department_name">Department Name</label>
      <input type="text" class="form-control" id="department_name" name="department_name" placeholder="Enter department name" />
     </div>
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
$pageTitle = 'Add New Department';
require_once '../layout/index.php';
?>