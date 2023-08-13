<?php
if (isset($_GET['msg']) && isset($_GET['state'])) {
 $msg = $_GET['msg'];
 $state = $_GET['state'];
}
require_once '../layout/session_start.php';

use MyApp\Admin;

$admin = new Admin();
$deps = $admin->getDepartmentsWithManagers();

ob_start();
?>

<div class="row">
 <div class="col-xl">
  <div class="card mb-4">
   <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Liste des départements</h5>
    <small class="text-muted float-end">Voir les départements</small>
   </div>
   <div class="card-body">
    <table class="table table-bordered">
     <thead>
      <tr class="table-row">
       <th>ID</th>
       <th>Nom du département</th>
       <th>Directeur</th>
       <th>Actions</th>
      </tr>
     </thead>
     <tbody>
      <!-- PHP loop to populate the table rows with data from the database -->
      <?php foreach ($deps as $dep) : ?>
       <tr>
        <td><?= $dep['id'] ?></td>
        <td><?= $dep['name'] ?></td>
        <td><?= $dep['manager'] ?></td>
        <td>
         <div class="dropdown">
          <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
           <i class="bx bx-dots-vertical-rounded"></i>
          </button>
          <div class="dropdown-menu">
           <a class="dropdown-item" href="edit_dep.php?id=<?= $dep['id'] ?>">
            <i class="bx bx-edit-alt me-1"></i> Edit
           </a>
           <a class="dropdown-item text-danger" href="../helpers/delete_dep.php?id=<?= $dep['id'] ?>">
            <i class="bx bx-trash me-1"></i> Delete
           </a>
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
$pageTitle = 'List Of Departments';
require_once '../layout/index.php';
?>