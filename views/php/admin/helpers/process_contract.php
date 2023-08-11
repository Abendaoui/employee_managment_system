<?php
require_once '../layout/session_start.php';

use MyApp\Admin;

$msg = '';
$state = false;
$admin = new Admin();

if (isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
 $id = $_POST['employee_id'];
 $start_date = $_POST['start_date'];
 $end_date = $_POST['end_date'];
 $contract_type = $_POST['contract_type'];
 $salary = $_POST['salary'];
 $employment_status = $_POST['employment_status'];
 $contract_terms = $_POST['contract_terms'];
 $result = $admin->addContract($id, $start_date, $end_date, $contract_type, $salary, $employment_status, $contract_terms);
 if ($result) {
  $msg = 'Contract Added Successfully';
  $state = true;
 } else {
  $msg = 'Contract Failed Added ';
 }
}
header("location: ../pages/add_contract.php?msg=$msg&state=$state");
