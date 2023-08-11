<?php
require '../../../../vendor/autoload.php';
require_once '../layout/session_start.php';

use MyApp\Employee;

$employee = new Employee();
$msg = "";
$state = false;
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
 $id_rec = $_POST['id_rec'];
 $email = $_POST['recipient_email'];
 $subject = $_POST['report_subject'];
 $content = $_POST['report_content'];
 $status = $employee->submitReport($id_rec, $email, $subject, $content);
 if ($status) {
  $msg = "Report Send Successfully";
  $state = true;
 } else {
  $msg = "Report Send Failure";
 }
}
header("location: ../pages/send.php?msg=$msg&state=$state");
