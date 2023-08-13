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
  $id_departement = $_POST['id_departement'];
  $date_naissance = $_POST['date_naissance'];
  $date_embauché = $_POST['date_embauché'];
  $telephone = $_POST['telephone'];
  $profile = $_FILES['profile'];
  $genre = $_POST['genre'];
  $adresse = $_POST['adresse'];

  $run = $admin->addManager($prenom, $nom, $email, 'Responsable', $id_departement, 'manager', $date_embauché, $date_naissance, $telephone, $genre, $profile, $adresse);

  switch ($run) {
    case 'success':
      // Generate a random password for the new employee
      $password = $admin->generateRandomPassword();

      // Generate a username based on employee's first name and last name
      $username = $admin->generateUsername($prenom, $nom);

      // Create auth credentials and get the generated username and password
      $authCredentials = $admin->createAuthCredentials($username, $email, $password);

      if (is_array($authCredentials)) {
        // Employee added successfully, and auth credentials generated
        $msg = "Gestionnaire ajouté avec succès. Username: {$authCredentials['username']},
         Password: {$authCredentials['password']}";
        $state = true;
      } else {
        // Error occurred while generating auth credentials
        $msg = "Gestionnaire ajouté avec succès, but there was an error generating auth credentials.";
      }
      break;
    case 'email_exists':
      $msg = "L'email existe déjà.";
      break;
    case 'Failed to upload':
      $msg = 'Échec du téléchargement de l\'image';
      break;
    default:
      $msg = "Échec de l\'ajout du gestionnaire.";
      break;
  }
}
// header("location: ../pages/add_manager.php?msg=$msg&state=$state");
$redirectUrl = "../pages/add_manager.php?msg=" . urlencode($msg) . "&state=$state";
header("Location: $redirectUrl");
exit;