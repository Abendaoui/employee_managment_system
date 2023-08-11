<?php
require_once '../layout/session_start.php';

use MyApp\Admin;

$id = $_GET['id'] ?? '';
$admin = new Admin();
// $contract = $admin->getContractById($id);
ob_start();
?>
<div class="container">
 <?php
 // Replace $contractId with the actual contract ID you want to display
 $contract = $admin->getContractById($id);

 if ($contract) {
  $employeeName = "John Doe"; // Replace this with the actual employee name
  $startDate = $contract['date_debut'];
  $endDate = $contract['date_fin'];
  $contractType = $contract['type_contrat'];
  $salary = $contract['salaire'];
  $employmentStatus = $contract['statut_emploi'];
  $terms = $contract['termes_contrat'];
 ?>
  <h1>Contract Details</h1>
  <table class="table table-bordered">
   <tr>
    <td><strong>Employee Name:</strong></td>
    <td><?= $employeeName ?></td>
   </tr>
   <tr>
    <td><strong>Start Date:</strong></td>
    <td><?= $startDate ?></td>
   </tr>
   <tr>
    <td><strong>End Date:</strong></td>
    <td><?= $endDate ?></td>
   </tr>
   <tr>
    <td><strong>Contract Type:</strong></td>
    <td><?= $contractType ?></td>
   </tr>
   <tr>
    <td><strong>Salary:</strong></td>
    <td><?= $salary ?> Dh</td>
   </tr>
   <tr>
    <td><strong>Employment Status:</strong></td>
    <td><?= $employmentStatus ?></td>
   </tr>
   <tr>
    <td><strong>Terms of Contract:</strong></td>
    <td>
     <ul>
      <?php
      $arr = explode(',', $terms);
      foreach ($arr as $term) : ?>
       <li><?= $term ?></li>
      <?php endforeach ?>
     </ul>
    </td>
   </tr>
  </table>
 <?php } else { ?>
  <p>Contract not found.</p>
 <?php } ?>
</div>

<?php
$pageContent = ob_get_clean();
$pageTitle = 'List Of Contracts';
require_once '../layout/index.php';
?>