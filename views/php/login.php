<?php

require '../../vendor/autoload.php';
session_start();

use MyApp\Auth;

$auth = new Auth();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  if ($auth->login($username, $password)) {
    if ($_SESSION['role'] === 'manager') {
      header("Location: ./admin/pages/dashboard.php");
      exit();
    } else {
      header("Location: ./employees/pages/dashboard.php");
      exit();
    }
  } else {
    $error = "Les informations d'identification invalides. Veuillez réessayer.";
  }
}
if (!empty($_SESSION)) {
  if (isset($_SESSION['role']) && $_SESSION['role'] === 'manager') {
    header('location: ./admin/pages/dashboard.php');
    exit(); // Add an exit to prevent further execution
  }
  if (isset($_SESSION['role']) && $_SESSION['role'] === 'employé') {
    header('location: ./employees/pages/dashboard.php');
    exit(); // Add an exit to prevent further execution
  }
}



?>
<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="../../assets/" data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>Login</title>

  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="../../assets/img/favicon/favicon.ico" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="../../assets/vendor/fonts/boxicons.css" />
  <!-- Core CSS -->
  <link rel="stylesheet" href="../../assets/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="../../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="../../assets/css/demo.css" />
  <!-- Vendors CSS -->
  <link rel="stylesheet" href="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
  <!-- Page CSS -->
  <!-- Page -->
  <link rel="stylesheet" href="../../assets/vendor/css/pages/page-auth.css" />
  <!-- Helpers -->
  <script src="../../assets/vendor/js/helpers.js"></script>
  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="../../assets/js/config.js"></script>
</head>

<body>
  <!-- Content -->

  <div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
        <!-- Register -->
        <div class="card">
          <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center">
              <div class="app-brand-link gap-2">
                <span class="app-brand-logo demo">
                  <img src="../../assets/img/logo/logo.jpeg" alt="logo" class="object-fit-contain w-px-40 rounded-3" />
                </span>
                <span class="app-brand-text demo text-body fw-bolder" style="text-transform: capitalize !important;">
                  Sellsysoft</span>
              </div>
            </div>
            <!-- /Logo -->
            <h4 class="mb-6 text-center">Bonjour</h4>
            <form id="formAuthentication" class="mb-3" method="POST">
              <div class="mb-3">
                <label for="username" class="form-label">Nom d'utilisateur</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" autofocus />
              </div>
              <div class="form-password-toggle mb-3">
                <div class="d-flex justify-content-between">
                  <label class="form-label" for="password">Mot de passe</label>
                  <button type="button" class="mb-2" style="background: transparent;border:none;outline:none" data-bs-toggle="modal" data-bs-target="#modalToggle">
                    <small>Mot de passe oublié?</small>
                  </button>
                </div>
                <div class="input-group input-group-merge">
                  <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                  <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
              </div>
              <div class="mb-3">
                <?php if (isset($error)) : ?>
                  <div class="alert alert-danger alert-dismissible mb-3" role="alert">
                    <?= $error ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                <?php endif ?>
              </div>
              <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" name="login" type="submit">Se connecter</button>
              </div>
            </form>
          </div>
        </div>
        <!-- /Register -->
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-md-6">
    <div class="mt-3">
      <div class="modal fade" id="modalToggle" aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="btn btn-primary" id="modalToggleLabel">Mot de passe oublié</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">Si vous avez oublié votre mot de passe, veuillez contacter votre responsable</div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  <script src="../../assets/vendor/libs/jquery/jquery.js"></script>
  <script src="../../assets/vendor/libs/popper/popper.js"></script>
  <script src="../../assets/vendor/js/bootstrap.js"></script>
  <script src="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

  <script src="../../assets/vendor/js/menu.js"></script>
  <!-- endbuild -->

  <!-- Vendors JS -->

  <!-- Main JS -->
  <script src="../../assets/js/main.js"></script>

  <!-- Page JS -->

  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>