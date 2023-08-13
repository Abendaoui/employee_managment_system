<?php
require_once '../layout/session_start.php';

use MyApp\Admin;

$admin = new Admin();
$msg = '';
$state = false;
$id = (int)($_GET['id']) ?? null; // Replace with the actual ID of the employee you want to delete
if ($id !== null) {
 $success = $admin->deleteDep($id);
 switch ($success) {
  case 'deleted':
   $msg = 'Supprimé avec succès';
   $state = true;
   break;
  case 'Not Found':
   $msg = 'Aucun département avec cet identifiant';
   break;
  default:
   $msg = 'Erreur';
 }
} else {
 $msg = 'Numéro d\'employé invalide';
}

header("location: ../pages/list_dep.php?msg=$msg&state=$state");
exit;
