<?php
if (isset($_GET['msg']) && isset($_GET['state'])) {
 $msg = $_GET['msg'];
 $state = $_GET['state'];
}
require_once '../layout/session_start.php';

use MyApp\Admin;

$admin = new Admin();
$id = $_GET['id'] ?? null;
$employees = $admin->getContractById($id);

ob_start();
?>
<div class="row">
 <div class="col-12 col-lg-8 mx-auto">
  <div class="card mb-4">
   <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Ajouter un nouveau contrat</h5>
    <small class="text-muted float-end">Entrez les détails ci-dessous</small>
   </div>
   <div class="card-body">
    <form action="../helpers/process_edit_contract.php?id=<?= $id ?>" method="POST">
     <!-- Employee ID -->
     <div class="mb-3">
      <label class="form-label" for="employee_id">ID d'employé</label>
      <select class="form-select" id="employment_status" name="employee_id" required>
       <option value="" disabled selected>Sélectionnez l'employé</option>
       <?php foreach ($employees as $employee) : ?>
        <option value="<?= $employee['id'] ?>"><?= $employee['full_name'] ?></option>
       <?php endforeach ?>
      </select>
     </div>
     <div class="row row-space mb-3">
      <!-- Start Date -->
      <div class="col-6">
       <label class="form-label" for="start_date">Date de début</label>
       <input type="date" class="form-control" id="start_date" name="start_date" required />
      </div>
      <!-- End Date -->
      <div class="col-6">
       <label class="form-label" for="end_date">Date de fin</label>
       <input type="date" class="form-control" id="end_date" name="end_date" required />
      </div>
     </div>
     <!-- Contract Type -->
     <div class="mb-3">
      <label class="form-label" for="contract_type">Type de contrat</label>
      <input type="text" class="form-control" id="contract_type" name="contract_type" placeholder="Contract Type" required />
     </div>
     <!-- Salary -->
     <div class="mb-3">
      <label class="form-label" for="salary">Salaire</label>
      <input type="number" class="form-control" id="salary" name="salary" step="0.01" placeholder="Salary" required />
     </div>
     <!-- Employment Status -->
     <div class="mb-3">
      <label class="form-label" for="employment_status">Statut d'emploi</label>
      <select class="form-select" id="employment_status" name="employment_status" required>
       <option value="temps plein">À temps plein</option>
       <option value="temps partiel">À temps partiel</option>
      </select>
     </div>
     <!-- Contract Terms -->
     <div class="mb-3">
      <label class="form-label" for="contract_terms">Termes de contrat</label>
      <textarea class="form-control" id="contract_terms" name="contract_terms" rows="4" placeholder="Term One, Term Two, "></textarea>
     </div>
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
$pageTitle = 'Edit Contract';
require_once '../layout/index.php';
?>