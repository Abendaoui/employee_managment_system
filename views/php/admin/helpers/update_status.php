<?php
require_once '../layout/session_start.php';

use MyApp\Admin;

$admin = new Admin();
$msg = '';
$state = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 if (isset($_POST['id_demande_conge'], $_POST['status'])) {
  $id_demande_conge = $_POST['id_demande_conge'];
  $new_status = $_POST['status'];

  $admin = new Admin();
  $update_result = $admin->updateDemandeCongeStatus($id_demande_conge, $new_status);

  if ($update_result) {
   $msg = 'Status Updated Successfully';
   $state = true;
  } else {
   $msg = 'Failed To Update';
  }
 }
}
header("location: ../pages/received_request.php?msg=$msg&state=$state");
