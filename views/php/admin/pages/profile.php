<?php
require_once '../layout/session_start.php';
if (isset($_GET['msg']) && isset($_GET['state'])) {
 $msg = $_GET['msg'];
 $state = $_GET['state'];
}

use MyApp\Admin;

$admin = new Admin();
$currentAdmin = $admin->getManagerAndDepById();
ob_start();
?>
<div class="row">
 <div class="col-md-12">
  <div class="card mb-4">
   <h5 class="card-header">Profile Details</h5>
   <!-- Account -->
   <div class="card-body">
    <div class="d-flex align-items-start align-items-sm-center gap-4">
     <img src="../../../../assets/img/avatars/<?= $_SESSION['profile'] ?>.png" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
    </div>
   </div>
   <hr class="my-0" />
   <div class="card-body">
    <form id="formAccountSettings" method="POST" action="../helpers/process_profile.php">
     <div class="row">
      <div class="mb-3 col-md-6">
       <label for="firstName" class="form-label">First Name</label>
       <input class="form-control" type="text" id="firstName" name="firstName" value="<?= $currentAdmin['prenom'] ?>" />
      </div>
      <div class="mb-3 col-md-6">
       <label for="lastName" class="form-label">Last Name</label>
       <input class="form-control" type="text" name="lastName" id="lastName" value="<?= $currentAdmin['nom'] ?>" />
      </div>
      <div class="mb-3 col-md-6">
       <label for="email" class="form-label">E-mail</label>
       <input class="form-control" type="text" id="email" name="email" value="<?= $_SESSION['email'] ?>" />
      </div>
      <div class="mb-3 col-md-6">
       <label for="organization" class="form-label">Job Title</label>
       <input type="text" class="form-control" id="organization" name="organization" value="<?= $currentAdmin['titre_poste'] ?>" />
      </div>
      <div class="mb-3 col-md-6">
       <label class="form-label" for="dep">Departement</label>
       <input type="text" id="dep" name="dep" class="form-control" value="<?= $currentAdmin['nom_departement'] ?>" readonly />
      </div>
      <div class="mb-3 col-md-6">
       <label for="address" class="form-label">Role</label>
       <input type="text" class="form-control" id="role" name="role" value="Manager" readonly />
      </div>
      <div class="mb-3 col-md-6">
       <label for="state" class="form-label">Date Hired</label>
       <input class="form-control" type="text" id="hired" name="hired" value="<?= $currentAdmin['date_embauché'] ?>" />
      </div>
      <div class="mb-3 col-md-6">
       <label for="zipCode" class="form-label">Date Birth</label>
       <input type="text" class="form-control" id="birth" name="birth" value="<?= $currentAdmin['date_naissance'] ?>" />
      </div>
      <div class="mb-3 col-md-6">
       <label for="state" class="form-label">Phone</label>
       <input class="form-control" type="text" id="phone" name="phone" value="<?= $currentAdmin['telephone'] ?>" />
      </div>
      <div class="mb-3 col-md-6">
       <label for="zipCode" class="form-label">Genre</label>
       <input type="text" class="form-control" id="genre" name="genre" value="<?= $currentAdmin['genre'] ?>" />
      </div>
      <div class="mb-3 col-md-6">
       <label for="timeZones" class="form-label">Address</label>
       <input type="text" class="form-control" id="zipCode" name="zipCode" value="<?= $currentAdmin['adresse'] ?>" />
      </div>
     </div>
     <?php if (isset($msg) && $msg !== '') : ?>
      <div class="alert alert-<?php echo $state ? 'success' : 'danger';  ?> alert-dismissible mb-3" role="alert">
       <?= $msg ?>
       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
     <?php endif ?>
     <div class="mt-2">
      <button type="submit" class="btn btn-primary me-2">Save changes</button>
      <button type="reset" class="btn btn-outline-secondary">Cancel</button>
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