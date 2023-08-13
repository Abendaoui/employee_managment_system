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
    <h5 class="mb-0">Ajouter une formation</h5>
    <small class="text-muted float-end">Entrez les détails ci-dessous</small>
   </div>
   <div class="card-body">
    <form action="../helpers/add_formation_action.php" method="POST">
     <!-- Title -->
     <div class="mb-3">
      <label class="form-label" for="title">Titre de formation</label>
      <input type="text" class="form-control" id="title" name="title" required />
     </div>
     <!-- Description -->
     <div class="mb-3">
      <label class="form-label" for="description">Description</label>
      <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
     </div>
     <!-- Receipent -->
     <!-- Recipients -->
     <div class="row mb-3 row-space mx-auto">
      <label class="form-label">Sélectionnez les destinataires</label>
      <?php foreach ($employees as $employee) : ?>
       <div class="form-check col-3">
        <input class="form-check-input" type="checkbox" name="recipients[]" value="<?= $employee['id_employe'] ?>" id="recipient_<?= $employee['id_employe'] ?>">
        <label class="form-check-label" for="recipient_<?= $employee['id_employe'] ?>">
         <?= $employee['nom'] . ' ' . $employee['prenom'] ?>
        </label>
       </div>
      <?php endforeach; ?>
     </div>

     <!-- Start Date -->
     <div class="mb-3">
      <label class="form-label" for="date_start">Date de début</label>
      <input type="date" class="form-control" id="date_start" name="date_start" required />
     </div>
     <!-- End Date -->
     <div class="mb-3">
      <label class="form-label" for="date_end">Date de fin</label>
      <input type="date" class="form-control" id="date_end" name="date_end" required />
     </div>
     <!-- Msg -->
     <?php if (isset($msg) && $msg !== '') : ?>
      <div class="alert alert-<?php echo $state ? 'success' : 'danger';  ?> alert-dismissible mb-3" role="alert">
       <?= $msg ?>
       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
     <?php endif ?>
     <button type="submit" name="submit" class="btn btn-primary">Ajouter</button>
    </form>
   </div>
  </div>
 </div>
</div>

<?php
$pageContent = ob_get_clean();
$pageTitle = 'Add Formation';
require_once '../layout/index.php';
?>