<?php
require '../../../../vendor/autoload.php';
require_once '../layout/session_start.php';

use MyApp\Employee;

$employee = new Employee();
ob_start();
?>
<div class="row">
 <div class="col-12">
  <div class="card mb-4">
   <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Demandes de congé reçues</h5>
    <small class="text-muted float-end">Toutes les demandes</small>
   </div>
   <div class="card-body">
    <table class="table table-bordered">
     <thead>
      <tr class="table-row">
       <th>Nom de l'employé</th>
       <th>Type de congé</th>
       <th>Date de début</th>
       <th>Date de fin</th>
       <th>Jours</th>
       <th>Statut</th>
       <th>commentaires</th>
      </tr>
     </thead>
     <tbody>
      <!-- PHP loop to populate the table rows with data from the database -->
      <?php
      $leaveRequests = $employee->getLeaveRequestsByEmployee($_SESSION['id']);

      foreach ($leaveRequests as $request) :
       $status = $request['statut'];
      ?>
       <tr>
        <td><?= $_SESSION['name'] ?></td>
        <td><?= $request['nom_type_conge'] ?></td>
        <td><?= $request['date_debut'] ?></td>
        <td><?= $request['date_fin'] ?></td>
        <td><?= (int)$request['jours_totales'] ?></td>
        <td><?= $request['statut'] ?></td>
        <td><?= $request['commentaires'] ?></td>
       </tr>
      <?php endforeach; ?>
     </tbody>
    </table>
   </div>
  </div>
 </div>
</div>

<?php
$pageContent = ob_get_clean();
$pageTitle = 'Your Requests';
require_once '../layout/index.php';
?>