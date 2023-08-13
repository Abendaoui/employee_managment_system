<?php
require_once '../layout/session_start.php';

use MyApp\Admin;

$admin = new Admin();
$msg = '';
$state = false;
$id = $_GET['id'] ?? null; // Replace with the actual ID of the employee you want to delete
if ($id !== null) {
 $success = $admin->deleteContrat($id);
 switch ($success) {
  case 'deleted':
   $msg = 'Successfully Deleted';
   $state = true;
   break;
  case 'Not Found':
   $msg = 'No Contrcat With This id';
   break;
  default:
   $msg = 'Error';
 }
} else {
 $msg = 'Invalid Employee ID';
}

header("location: ../pages/list_contract.php?msg=$msg&state=$state");
exit;