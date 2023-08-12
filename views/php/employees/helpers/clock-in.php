<?php
require '../../../../vendor/autoload.php';
require_once '../layout/session_start.php';

use MyApp\Employee;

$employee = new Employee();
$msg = '';
$state = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
 $run = $employee->clockIn();
 switch ($run) {
  case 'success':
   $msg = 'Avec succès';
   $state = true;
   break;
  case 'already':
   $msg = 'Déjà choisi';
   break;
  default:
   $msg = 'Erreur';
   break;
 }
}
header("location: ../pages/dashboard.php?msg=$msg&state=$state");
