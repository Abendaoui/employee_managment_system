<?php

require_once '../layout/session_start.php';

use MyApp\Admin;

$admin = new Admin();
$msg = "";
$state = false;
if (isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
 $dep_name = $_POST['department_name'];
 $run = $admin->addDepartment($dep_name);
 if ($run) {
  $msg = 'Ajouté avec succès';
  $state = true;
 } else {
  $msg = 'Échec de l\'ajout du département';
 }
}
header("location: ../pages/add_dep.php?msg=$msg&state=$state");