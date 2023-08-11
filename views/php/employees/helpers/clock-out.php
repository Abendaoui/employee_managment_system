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
   $msg = 'Success';
   $state = true;
   break;
  case 'check':
   $msg = 'U Should Clock In First';
   break;
  default:
   $msg = $run;
   break;
 }
}
header("location: ../pages/dashboard.php?msg=$msg&state=$state");
