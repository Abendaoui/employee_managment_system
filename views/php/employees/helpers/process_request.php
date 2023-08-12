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
   $msg = 'Demande de congé soumise avec succès.';
   $state = true;
   break;
  case 'exceed_limit':
   $msg = 'Erreur : Le nombre total de jours demandés dépasse la limite de 10 jours.';
   break;
  case 'insufficient_leave':
   $msg = 'Erreur : jours de congé restants insuffisants pour l\'année en cours.';
   break;
  default:
   $msg = 'Une erreur s\'est produite lors de la soumission de la demande de congé.';
   break;
 }
}
header("location: ../pages/request.php?msg=$msg&state=$state");
