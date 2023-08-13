<?php
require_once '../layout/session_start.php';

use MyApp\Admin;

$admin = new Admin();
$id = $_GET['id'] ?? null;
$contract = $admin->getContractById($id);
ob_start();
?>
<div class="row">
 <div class="col-12 col-lg-8 mx-auto">
  <div class="card mb-4">
   <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Modifier contrat</h5>
    <small class="text-muted float-end">Entrez les détails ci-dessous</small>
   </div>
   <div class="card-body">
    <form action="../helpers/process_edit_contract.php?id=<?= $contract['id_contrat'] ?>" method="POST">
     <!-- Employee ID -->
     <div class="mb-3">
      <label class="form-label" for="employee_id">employé nom</label>
      <input type="text" class="form-control" id="nom" name="nom" value="<?= $contract['nom'] . ' ' . $contract['prenom'] ?>" readonly />

     </div>
     <div class="row row-space mb-3">
      <!-- Start Date -->
      <div class="col-6">
       <label class="form-label" for="start_date">Date de début</label>
       <input type="date" class="form-control" value="<?= $contract['date_debut'] ?>" id="start_date" name="start_date" required />
       <small><?= $contract['date_debut'] ?></small>
      </div>
      <!-- End Date -->
      <div class="col-6">
       <label class="form-label" for="end_date">Date de fin</label>
       <input type="date" value="<?= $contract['date_fin'] ?>" class="form-control" id="end_date" name="end_date" required />
       <small><?= $contract['date_fin'] ?></small>
      </div>
     </div>
     <!-- Contract Type -->
     <div class="mb-3">
      <label class="form-label" for="contract_type">Type de contrat</label>
      <input type="text" class="form-control" id="contract_type" name="contract_type" value="<?= $contract['type_contrat'] ?>" required />
     </div>
     <!-- Salary -->
     <div class="mb-3">
      <label class="form-label" for="salary">Salaire</label>
      <input type="number" class="form-control" id="salary" name="salary" step="0.01" value="<?= $contract['salaire'] ?>" required />
     </div>
     <!-- Employment Status -->
     <div class="mb-3">
      <label class="form-label" for="employment_status">Statut d'emploi</label>
      <select class="form-select" id="employment_status" name="employment_status" required>
       <option value="" disabled><?= $contract['statut_emploi'] ?></option>
       <option value="temps plein">À temps plein</option>
       <option value="temps partiel">À temps partiel</option>
      </select>
     </div>
     <!-- Contract Terms -->
     <div class="mb-3">
      <label class="form-label" for="contract_terms">Termes de contrat</label>
      <textarea class="form-control" id="contract_terms" name="contract_terms" rows="4">
        <?= $contract['termes_contrat'] ?>
      </textarea>
     </div>
     <button type="submit" name="submit" class="btn btn-primary">Modifier</button>
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