<?php
require_once '../layout/session_start.php';

use MyApp\Admin;

$admin = new Admin();
$msg = "";
$state = false;
if (isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
 $title = $_POST['title'];
 $desc = $_POST['description'];
 $start = $_POST['date_start'];
 $end = $_POST['date_end'];
 // Get the selected recipients
 $selectedRecipients = isset($_POST['recipients']) ? $_POST['recipients'] : [];
 $run = $admin->addFormation($title, $desc, $start, $end, $selectedRecipients);
 if ($run) {
  $msg = 'Formation ajoutée avec succès';
  $state = true;
 } else {
  $msg = 'Échec de la formation';
 }
}
header("location: ../pages/add_formations.php?msg=$msg&state=$state");