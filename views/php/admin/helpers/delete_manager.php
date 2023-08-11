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
   $msg = 'Successfully Deleted';
   $state = true;
   break;
  case 'Not Found':
   $msg = 'No Employee With This ID';
   break;
  default:
   $msg = $success;
 }
} else {
 $msg = 'Invalid Employee ID';
}

header("location: ../pages/list_managers.php?msg=$msg&state=$state");
