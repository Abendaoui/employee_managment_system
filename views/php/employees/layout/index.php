<?php

require_once 'session_start.php';

if (!isset($_SESSION['id'])) {
 header('location: ../../login.php');
 exit;
}
if (isset($_SESSION['role']) && $_SESSION['role'] === 'manager') {
 header('location: ../../admin/pages/dashboard.php');
 exit;
}
?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../../../../assets/" data-template="vertical-menu-template-free">

<head>
 <meta charset="utf-8" />
 <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

 <title><?= $pageTitle; ?></title>

 <meta name="description" content="" />

 <!-- Favicon -->
 <link rel="icon" type="image/x-icon" href="../../../../assets/img/favicon/favicon_io/favicon.ico" />

 <!-- Fonts -->
 <link rel="preconnect" href="https://fonts.googleapis.com" />
 <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
 <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

 <!-- Icons. Uncomment required icon fonts -->
 <link rel="stylesheet" href="../../../../assets/vendor/fonts/boxicons.css" />
 <link rel="stylesheet" href="../../../../assets/css/custom.css" />


 <!-- Core CSS -->
 <link rel="stylesheet" href="../../../../assets/vendor/css/core.css" class="template-customizer-core-css" />
 <link rel="stylesheet" href="../../../../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
 <link rel="stylesheet" href="../../../../assets/css/demo.css" />

 <!-- Vendors CSS -->
 <link rel="stylesheet" href="../../../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

 <link rel="stylesheet" href="../../../../assets/vendor/libs/apex-charts/apex-charts.css" />

 <!-- Page CSS -->
 <!-- FullCalendar CSS -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css">

 <!-- FullCalendar JS -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>

 <!-- Helpers -->
 <script src="../../../../assets/vendor/js/helpers.js"></script>

 <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
 <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
 <script src="../../../../assets/js/config.js"></script>
</head>

<body>
 <div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">
   <!-- Menu -->
   <?php require_once '../inc/aside.php' ?>
   <!-- / Menu -->
   <div class="layout-page">
    <!-- Navbar -->
    <?php require_once '../inc/nav.php' ?>
    <!-- / Navbar -->
    <div class="content-wrapper">
     <div class="container-xxl flex-grow-1 container-p-y">
      <!-- Our Content -->
      <?= $pageContent; ?>
     </div>
     <div class="content-backdrop fade"></div>
    </div>
   </div>
  </div>
  <div class="layout-overlay layout-menu-toggle"></div>
 </div>



 <!-- Core JS -->
 <!-- build:js assets/vendor/js/core.js -->
 <script src="../../../../assets/vendor/libs/jquery/jquery.js"></script>
 <script src="../../../../assets/vendor/libs/popper/popper.js"></script>
 <script src="../../../../assets/vendor/js/bootstrap.js"></script>
 <script src="../../../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

 <script src="../../../../assets/vendor/js/menu.js"></script>
 <!-- endbuild -->

 <!-- Vendors JS -->
 <script src="../../../../assets/vendor/libs/apex-charts/apexcharts.js"></script>

 <!-- Main JS -->
 <script src="../../../../assets/js/main.js"></script>

 <!-- Page JS -->
 <script src="../../../../assets/js/dashboards-analytics.js"></script>

 <!-- Place this tag in your head or just before your close body tag. -->
 <script async defer src="https://buttons.github.io/buttons.js"></script>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

</body>

</html>