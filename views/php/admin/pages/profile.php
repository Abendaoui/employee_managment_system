<?php
require_once '../layout/session_start.php';
if (isset($_GET['msg']) && isset($_GET['state'])) {
 $msg = $_GET['msg'];
 $state = $_GET['state'];
}
if (isset($_GET['m']) && isset($_GET['s'])) {
 $m = $_GET['m'];
 $s = $_GET['s'];
}


use MyApp\Admin;

$admin = new Admin();
$currentAdmin = $admin->getManagerAndDepById();
ob_start();
?>
<div class="row">
 <div class="col-md-12">
  <div class="card mb-4">
   <h5 class="card-header">Détails du profil</h5>
   <!-- Account -->
   <div class="card-body">
    <form action="../helpers/edit_photo_process.php" enctype="multipart/form-data" class="d-flex align-items-start align-items-sm-center gap-4" method="POST">
     <img src="../../../../assets/img/avatars/<?= $_SESSION['profile'] ?>.png" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
     <div class="button-wrapper">
      <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
       <span class="d-none d-sm-block">Télécharger une nouvelle photo</span>
       <i class="bx bx-upload d-block d-sm-none"></i>
       <input type="file" id="upload" name="upload" class="account-file-input" hidden accept="image/png" />
      </label>
      <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
       <i class="bx bx-reset d-block d-sm-none"></i>
       <span class="d-none d-sm-block">Réinitialiser</span>
      </button>
      <button type="submit" id='img' name="save" class="btn btn-success mb-4">
       <i class='bx bx-save d-block d-sm-none'></i>
       <span class="d-none d-sm-block">Sauvegarder</span>
      </button>
      <p class="text-muted mb-0">PNG autorisé. Taille maximale de 800K</p>
     </div>
    </form>
    <?php if (isset($m) && $m !== '') : ?>
     <div class="alert alert-<?php echo $s ? 'success' : 'danger';  ?> alert-dismissible mb-3 mt-3 col-4 mx-auto" role="alert">
      <?= $m ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
     </div>
    <?php endif ?>
   </div>
   <hr class="my-0" />
   <div class="card-body">
    <form id="formAccountSettings" method="POST" action="../helpers/process_profile.php">
     <div class="row">
      <div class="mb-3 col-md-6">
       <label for="firstName" class="form-label">Prénom</label>
       <input class="form-control" type="text" id="firstName" name="firstName" value="<?= $currentAdmin['prenom'] ?>" />
      </div>
      <div class="mb-3 col-md-6">
       <label for="lastName" class="form-label">Nom de famille</label>
       <input class="form-control" type="text" name="lastName" id="lastName" value="<?= $currentAdmin['nom'] ?>" />
      </div>
      <div class="mb-3 col-md-6">
       <label for="email" class="form-label">E-mail</label>
       <input class="form-control" type="text" id="email" name="email" value="<?= $_SESSION['email'] ?>" />
      </div>
      <div class="mb-3 col-md-6">
       <label for="organization" class="form-label">Titre d'emploi</label>
       <input type="text" class="form-control" id="organization" name="organization" value="<?= $currentAdmin['titre_poste'] ?>" />
      </div>
      <div class="mb-3 col-md-6">
       <label class="form-label" for="dep">Département</label>
       <input type="text" id="dep" name="dep" class="form-control" value="<?= $currentAdmin['nom_departement'] ?>" readonly />
      </div>
      <div class="mb-3 col-md-6">
       <label for="address" class="form-label">Rôle</label>
       <input type="text" class="form-control" id="role" name="role" value="Manager" readonly />
      </div>
      <div class="mb-3 col-md-6">
       <label for="state" class="form-label">Date d'embauche</label>
       <input class="form-control" type="text" id="hired" name="hired" value="<?= $currentAdmin['date_embauché'] ?>" />
      </div>
      <div class="mb-3 col-md-6">
       <label for="zipCode" class="form-label">Date de naissance</label>
       <input type="text" class="form-control" id="birth" name="birth" value="<?= $currentAdmin['date_naissance'] ?>" />
      </div>
      <div class="mb-3 col-md-6">
       <label for="state" class="form-label">Téléphone</label>
       <input class="form-control" type="text" id="phone" name="phone" value="<?= $currentAdmin['telephone'] ?>" />
      </div>
      <div class="mb-3 col-md-6">
       <label for="zipCode" class="form-label">Genre</label>
       <input type="text" class="form-control" id="genre" name="genre" value="<?= $currentAdmin['genre'] ?>" />
      </div>
      <div class="mb-3 col-md-6">
       <label for="timeZones" class="form-label">Adresse</label>
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