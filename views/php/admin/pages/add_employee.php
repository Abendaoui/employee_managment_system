<?php

if (isset($_GET['msg']) && isset($_GET['state'])) {
 $msg = $_GET['msg'];
 $state = $_GET['state'];
}

ob_start();
?>
<div class="row">
 <div class="col-xl">
  <div class="card mb-4">
   <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Add New Employee</h5>
   </div>
   <div class="card-body">
    <form action="../helpers/add_emp_action.php" method="post" enctype="multipart/form-data">
     <!-- Full-Name -->
     <div class="row row-space mb-3">
      <div class="col-6">
       <label class="form-label" for="basic-icon-default-fullname">First Name</label>
       <div class="input-group input-group-merge">
        <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
        <input type="text" class="form-control" id="basic-icon-default-fullname" placeholder="John" name="prenom" required />
       </div>
      </div>
      <div class="col-6">
       <label class="form-label" for="basic-icon-default-fullname">Last Name</label>
       <div class="input-group input-group-merge">
        <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
        <input type="text" class="form-control" id="basic-icon-default-fullname" placeholder="Doe" name="nom" required />
       </div>
      </div>
     </div>
     <!-- Email & Job -->
     <div class="row row-space mb-3">
      <div class="col-6">
       <label class="form-label" for="basic-icon-default-company">Email</label>
       <div class="input-group input-group-merge">
        <span id="basic-icon-default-company2" class="input-group-text"><i class="bx bx-envelope"></i></span>
        <input type="email" id="basic-icon-default-company" class="form-control" placeholder="john@gmail.com" name="email" required />
       </div>
      </div>
      <div class="col-6">
       <label class="form-label" for="basic-icon-default-company">Job Title</label>
       <div class="input-group input-group-merge">
        <span id="basic-icon-default-company2" class="input-group-text"><i class='bx bx-briefcase'></i></span>
        <input type="text" id="basic-icon-default-company" class="form-control" placeholder="Programmer" name="titre_poste" required />
       </div>
      </div>
     </div>
     <!-- Date Birth & Date Hired -->
     <div class="row row-space mb-3">
      <div class="col-6">
       <label class="form-label" for="basic-icon-default-company">Date Birth</label>
       <div class="input-group input-group-merge">
        <span id="basic-icon-default-company2" class="input-group-text"><i class='bx bx-time-five'></i></span>
        <input type="date" id="basic-icon-default-company" class="form-control" name="date_naissance" required />
       </div>
      </div>
      <div class="col-6">
       <label class="form-label" for="basic-icon-default-company">Date Hired</label>
       <div class="input-group input-group-merge">
        <span id="basic-icon-default-company2" class="input-group-text"><i class='bx bx-time-five'></i></span>
        <input type="date" id="basic-icon-default-company" class="form-control" name="date_embauché" required />
       </div>
      </div>
     </div>
     <!-- Telephone & Profile-->
     <div class="row row-space mb-3">
      <div class="col-6">
       <label class="form-label" for="basic-icon-default-company">Telephone</label>
       <div class="input-group input-group-merge">
        <span id="basic-icon-default-company2" class="input-group-text"><i class="bx bx-phone"></i></span>
        <input type="tel" id="basic-icon-default-company" class="form-control" placeholder="06/07********" name="telephone" required />
       </div>
      </div>
      <div class="col-6">
       <label class="form-label" for="basic-icon-default-company">Photo Profile</label>
       <div class="input-group input-group-merge">
        <span id="basic-icon-default-company2" class="input-group-text"><i class='bx bxs-file-image'></i></span>
        <input type="file" id="basic-icon-default-company" accept="image/png" class="form-control" name="profile" required />
       </div>
      </div>
     </div>
     <!-- Genre -->
     <div class="row row-space mb-3 ml-3">
      <label class="form-label" for="basic-icon-default-company">Genre</label>
      <div class="col-3">
       <div class="form-check">
        <input class="form-check-input" type="radio" name="genre" value="male" id="flexRadioDefault1">
        <label class="form-check-label" for="flexRadioDefault1">
         Male
        </label>
       </div>
      </div>
      <div class="col-3">
       <div class="form-check">
        <input class="form-check-input" type="radio" name="genre" value="female" id="flexRadioDefault1">
        <label class="form-check-label" for="flexRadioDefault1">
         Female
        </label>
       </div>
      </div>
     </div>
     <!-- Address -->
     <div class="mb-3">
      <label class="form-label" for="basic-icon-default-company">Date Hired</label>
      <div class="input-group input-group-merge">
       <span id="basic-icon-default-company2" class="input-group-text"><i class='bx bx-location-plus'></i></span>
       <textarea id="basic-icon-default-company" class="form-control" name="adresse" placeholder="IMM 15 APPRT 12 Street City 12250" required></textarea>
      </div>
     </div>
     <!-- Msg -->
     <?php if (isset($msg) && $msg !== '') : ?>
      <div class="alert alert-<?php echo $state ? 'success' : 'danger';  ?> alert-dismissible mb-3" role="alert">
       <?= $msg ?>
       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
     <?php endif ?>
     <button type="submit" class="btn btn-primary" name="submit">Ajouter</button>
    </form>
   </div>
  </div>
 </div>
</div>
<?php
$pageContent = ob_get_clean();
$pageTitle = 'Add Employee';
require_once '../layout/index.php';
?>