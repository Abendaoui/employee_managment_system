<?php
require '../../../../vendor/autoload.php';
require_once '../layout/session_start.php';

use MyApp\Employee;

$employee = new Employee();
$msg = "";
$state = false;
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
 $id_conge = $_POST['leave_type'];
 $date_start = $_POST['start_date'];
 $date_end = $_POST['end_date'];
 $comment = $_POST['comments'];
 $status = $employee->submitLeaveRequest($id_conge, $date_start, $date_end, $comment);
 switch ($status) {
  case 'success':
   $msg = 'Leave request submitted successfully.';
   $state = true;
   break;
  case 'exceed_limit':
   $msg = 'Error: Total days requested exceed the limit of 10 days.';
   break;
  case 'insufficient_leave':
   $msg = 'Error: Insufficient remaining leave days for the current year.';
   break;
  default:
   $msg = 'An error occurred while submitting the leave request.';
   break;
 }
}
header("location: ../pages/request.php?msg=$msg&state=$state");
