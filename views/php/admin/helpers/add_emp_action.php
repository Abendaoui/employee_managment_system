<?php
require_once '../layout/session_start.php';

use MyApp\Admin;

$msg = '';
$state = false;
$admin = new Admin();

if (isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
  $prenom = $_POST['prenom'];
  $nom = $_POST['nom'];
  $email = $_POST['email'];
  $job = $_POST['titre_poste'];
  $date_naissance = $_POST['date_naissance'];
  $date_embauché = $_POST['date_embauché'];
  $telephone = $_POST['telephone'];
  $profile = $_FILES['profile'];
  $genre = $_POST['genre'];
  $adresse = $_POST['adresse'];

  $run = $admin->addEmployee($prenom, $nom, $email, $job, 'employé', $date_embauché, $date_naissance, $telephone, $genre, $profile, $adresse);

  switch ($run) {
    case 'success':
      $msg = "Employee added successfully.";
      $state = true;
      break;
    case 'email_exists':
      $msg = "Email already exists.";
      break;
    case 'Failed to upload';
      $msg = 'Failed to upload Image';
      break;
    default:
      $msg = "Failed to add Employee.";
      break;
  }
}
header("location: ../pages/add_employee.php?msg=$msg&state=$state");
