<?php
require_once '../layout/session_start.php';

use MyApp\Admin;

$admin = new Admin();
$msg = '';
$state = false;
if (isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
 $employe_id = $_POST['employee_id'];
 $start_hour = $_POST['heure_entree'];
 $end_hour = $_POST['heure_sortie'];
 $date = $_POST['date_travail'];
 $oparation = $admin->addWorkSchedule($employe_id, $start_hour, $end_hour, $date);
 if ($oparation === "success") {
  $msg  = 'Ajouté avec succès';
  $state = true;
 } else {
  $msg = 'Erreur';
 }
}
header("location: ../pages/assign_work_schedule.php?msg=$msg&state=$state");
