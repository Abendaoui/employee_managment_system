<?php

require_once '../layout/session_start.php';

use MyApp\Admin;

$admin = new Admin();
$msg = "";
$state = false;
$id = $_GET['id'] ?? null;
if (isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
 $dep_name = $_POST['department_name'];
 $run = $admin->editDepartment($id, $dep_name);
 if ($run === 'updated') {
  $msg = 'Successfully Edited';
  $state = true;
 } elseif ($run === 'Not Found') {
  $msg = 'Department Not Found';
 } else {
  $msg = 'Failed to Edit department';
 }
}
header("location: ../pages/list_dep.php?msg=$msg&state=$state");
exit;
