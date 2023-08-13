<?php
require_once '../layout/session_start.php';

use MyApp\Admin;

$msg = '';
$state = false;
$admin = new Admin();
$id = $_GET['id'] ?? null;
if (isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
 $start_date = $_POST['start_date'];
 $end_date = $_POST['end_date'];
 $contract_type = $_POST['contract_type'];
 $salary = $_POST['salary'];
 $employment_status = $_POST['employment_status'];
 $contract_terms = $_POST['contract_terms'];
 $result = $admin->updateContract($id, $start_date, $end_date, $contract_type, $salary, $employment_status, $contract_terms);
 if ($result === 'updated') {
  $msg = 'Contrat modifier avec succès';
  $state = true;
 } else {
  $msg = 'Échec du contrat modifier ';
 }
}
header("location: ../pages/list_contract.php?msg=$msg&state=$state");
