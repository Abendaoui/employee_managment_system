<?php
require '../../../../vendor/autoload.php';
require_once '../layout/session_start.php';

use MyApp\Employee;

$employee = new Employee();
$msg = '';
$state = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
 $run = $employee->clockOut();
 switch ($run) {
  case 'success':
   $msg = 'Avec succès';
   $state = true;
   break;
  case 'check':
   $msg = 'Vous devriez pointer en premier';
   break;
  default:
   $msg = 'erreur';
   break;
 }
}
header("location: ../pages/dashboard.php?msg=$msg&state=$state");
