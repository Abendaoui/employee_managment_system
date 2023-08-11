<?php
require_once '../layout/session_start.php';

use MyApp\Admin;

$slug = $_GET['slug'] ?? null;
$admin = new Admin();
$current_employee = $admin->getEmployeeBySlug($slug);
ob_start();
?>
<div class="row">
 <div class="col-md-12">
  <div class="card mb-4">
   <h5 class="card-header">Employé <?= $current_employee['nom'] . ' ' . $current_employee['prenom'] ?></h5>
   <div class="card-body">
    <div class="d-flex align-items-start align-items-sm-center gap-4">
     <img src="../../../../assets/img/avatars/<?= $current_employee['profile'] ?>.png" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
    </div>
   </div>
   <hr class="my-0" />
   <div class="card-body">
    <form id="formAccountSettings" method="POST" action="../helpers/process_profile.php">
     <div class="row">
      <div class="mb-3 col-md-6">
       <label for="firstName" class="form-label">First Name</label>
       <input class="form-control" readonly type="text" id="firstName" name="firstName" value="<?= $current_employee['prenom'] ?>" />
      </div>
      <div class="mb-3 col-md-6">
       <label for="lastName" class="form-label">Last Name</label>
       <input class="form-control" readonly type="text" name="lastName" id="lastName" value="<?= $current_employee['nom'] ?>" />
      </div>
      <div class="mb-3 col-md-6">
       <label for="email" class="form-label">E-mail</label>
       <input class="form-control" readonly type="text" id="email" name="email" value="<?= $_SESSION['email'] ?>" />
      </div>
      <div class="mb-3 col-md-6">
       <label for="organization" class="form-label">Job Title</label>
       <input type="text" class="form-control" readonly id="organization" name="organization" value="<?= $current_employee['titre_poste'] ?>" />
      </div>
      <div class="mb-3 col-md-6">
       <label class="form-label" for="dep">Departement</label>
       <input type="text" id="dep" name="dep" class="form-control" readonly value="<?= $current_employee['nom_departement'] ?>" />
      </div>
      <div class="mb-3 col-md-6">
       <label class="form-label" for="dep">Manager</label>
       <input type="text" id="dep" name="dep" class="form-control" readonly value="<?= $_SESSION['name']?>" />
      </div>
      <div class="mb-3 col-md-6">
       <label for="address" class="form-label">Role</label>
       <input type="text" class="form-control" readonly id="role" name="role" value="Employé" />
      </div>
      <div class="mb-3 col-md-6">
       <label for="state" class="form-label">Date Hired</label>
       <input class="form-control" readonly type="text" id="hired" name="hired" value="<?= $current_employee['date_embauché'] ?>" />
      </div>
      <div class="mb-3 col-md-6">
       <label for="zipCode" class="form-label">Date Birth</label>
       <input type="text" class="form-control" readonly id="birth" name="birth" value="<?= $current_employee['date_naissance'] ?>" />
      </div>
      <div class="mb-3 col-md-6">
       <label for="state" class="form-label">Phone</label>
       <input class="form-control" readonly type="text" id="phone" name="phone" value="<?= $current_employee['telephone'] ?>" />
      </div>
      <div class="mb-3 col-md-6">
       <label for="zipCode" class="form-label">Genre</label>
       <input type="text" class="form-control" readonly id="genre" name="genre" value="<?= $current_employee['genre'] ?>" />
      </div>
      <div class="mb-3 col-md-6">
       <label for="timeZones" class="form-label">Address</label>
       <input type="text" class="form-control" readonly id="zipCode" name="zipCode" value="<?= $current_employee['adresse'] ?>" />
      </div>
     </div>
    </form>
   </div>
  </div>
 </div>
</div>
<?php
$pageContent = ob_get_clean();
$pageTitle = 'Update Employee';
require_once '../layout/index.php';
?>