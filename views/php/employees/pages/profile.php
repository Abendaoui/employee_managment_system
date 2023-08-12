<?php
require '../../../../vendor/autoload.php';
require_once '../layout/session_start.php';
if (isset($_GET['msg']) && isset($_GET['state'])) {
 $msg = $_GET['msg'];
 $state = $_GET['state'];
}

use MyApp\Employee;

$employee = new Employee();
$employee_info = $employee->getEmployeeDepartmentInfo();
$manager = $employee->getManagerBYId($employee_info['manager'])['full_name'];
ob_start();
?>
<div class="row">
 <div class="col-md-12">
  <div class="card mb-4">
   <h5 class="card-header text-center">Détails du profil</h5>
   <!-- Account -->
   <div class="card-body">
    <div class="d-flex align-items-start align-items-sm-center gap-4 justify-content-center">
     <img src="../../../../assets/img/avatars/<?= $_SESSION['profile'] ?>.png" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
    </div>
   </div>
   <hr class="my-0" />
   <div class="card-body">
    <form id="formAccountSettings" method="POST" action="../helpers/process_profile.php">
     <div class="row">
      <div class="mb-3 col-md-6">
       <label for="firstName" class="form-label">Prénom</label>
       <input class="form-control text-capitalize" type="text" id="firstName" name="firstName" value="<?= $employee_info['prenom'] ?>" />
      </div>
      <div class="mb-3 col-md-6">
       <label for="lastName" class="form-label">Nom de famille</label>
       <input class="form-control text-capitalize" type="text" name="lastName" id="lastName" value="<?= $employee_info['nom'] ?>" />
      </div>
      <div class="mb-3 col-md-6">
       <label for="email" class="form-label">E-mail</label>
       <input class="form-control" type="text" id="email" name="email" value="<?= $_SESSION['email'] ?>" placeholder="john.doe@example.com" />
      </div>
      <div class="mb-3 col-md-6">
       <label for="organization" class="form-label">Titre d'emploi</label>
       <input type="text" class="form-control text-capitalize" readonly id="organization" name="organization" value="<?= $employee_info['titre_poste'] ?>" />
      </div>
      <div class="mb-3 col-md-6">
       <label class="form-label" for="dep">Département</label>
       <input type="text" id="dep" name="dep" readonly class="form-control text-capitalize" value="<?= $employee_info['dep'] ?>" />
      </div>
      <div class="mb-3 col-md-6">
       <label class="form-label" for="dep">Directeur</label>
       <input type="text" id="dep" name="dep" readonly class="form-control text-capitalize" value="<?= $manager ?>" />
      </div>
      <div class="mb-3 col-md-6">
       <label for="address" class="form-label">Rôle</label>
       <input type="text" class="form-control text-capitalize" readonly id="address" name="address" value="Employee" />
      </div>
      <div class="mb-3 col-md-6">
       <label for="state" class="form-label">Date d'embauche</label>
       <input class="form-control text-capitalize" readonly type="text" id="state" name="state" value="<?= $employee_info['date_embauché'] ?>" />
      </div>
      <div class="mb-3 col-md-6">
       <label for="zipCode" class="form-label">Date de naissance</label>
       <input type="text" class="form-control text-capitalize" id="zipCode" name="birth" value="<?= $employee_info['date_naissance'] ?>" />
      </div>
      <div class="mb-3 col-md-6">
       <label for="state" class="form-label">Téléphone</label>
       <input class="form-control text-capitalize" type="text" id="state" name="phone" value="<?= $employee_info['telephone'] ?>" />
      </div>
      <div class="mb-3 col-md-6">
       <label for="zipCode" class="form-label">Genre</label>
       <input type="text" class="form-control text-capitalize" id="genre" name="genre" value="<?= $employee_info['genre'] ?>" />
      </div>
      <div class="mb-3 col-md-6">
       <label for="timeZones" class="form-label">Adresse</label>
       <input type="text" class="form-control text-capitalize" id="zipCode" name="zipCode" value="<?= $employee_info['adresse'] ?>" />
      </div>
     </div>
     <?php if (isset($msg) && $msg !== '') : ?>
      <div class="alert alert-<?php echo $state ? 'success' : 'danger';  ?> alert-dismissible mb-3" role="alert">
       <?= $msg ?>
       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
     <?php endif ?>
     <div class="mt-2">
      <button type="submit" class="btn btn-primary me-2">Sauvegarder les modifications</button>
      <button type="reset" class="btn btn-outline-secondary">Annuler</button>
     </div>
    </form>
   </div>
   <!-- /Account -->
  </div>
 </div>
</div>
<?php
$pageContent = ob_get_clean();
$pageTitle = 'Profile';
require_once '../layout/index.php';
?>