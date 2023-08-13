<?php
require_once '../layout/session_start.php';

use MyApp\Admin;

$admin = new Admin();
$msg = '';
$state = false;
$id = $_GET['id'] ?? null; // Replace with the actual ID of the employee you want to delete
if ($id !== null) {
 $success = $admin->deleteEmployee($id);
 switch ($success) {
  case 'deleted':
   $msg = 'Supprimé avec succès';
   $state = true;
   break;
  case 'Not Found':
   $msg = 'Aucun employé avec cet ID';
   break;
  default:
   $msg = $success;
 }
} else {
 $msg = 'Numéro d\'employé invalide';
}

header("location: ../pages/list_employee.php?msg=$msg&state=$state");
