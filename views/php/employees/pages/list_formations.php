<?php
require '../../../../vendor/autoload.php';
require_once '../layout/session_start.php';

use MyApp\Employee;

$employee = new Employee();
$received_formation = $employee->getAllReceivedTrainings();
ob_start();
?>
<div class="container mt-4">
  <h1 class="mt-4">Employee Training Sessions</h1>

  <div class="row mt-4">
    <?php if (count($received_formation)) { ?>
      <?php foreach ($received_formation as $formation) : ?>
        <div class="col-lg-6 col-12 mx-auto mb-3">
          <div class="card text-center">
            <div class="card-header">Training Session <?= $formation['id_formation'] ?></div>
            <div class="card-body">
              <h5 class="card-title">Title: <?= $formation['title'] ?></h5>
              <p class="card-text"><strong>Start Date:</strong> <?= $formation['date_start'] ?></p>
              <p class="card-text"><strong>End Date:</strong> <?= $formation['date_end'] ?></p>
              <p class="card-text"><strong>Date Sent:</strong><?= $formation['date_sent'] ?></p>
              <a href="formation_details.php?id=<?= $formation['id_formation'] ?>" class="btn btn-primary mt-3">Details</a>
            </div>
          </div>
        </div>
      <?php endforeach ?>
    <?php } else { ?>
      <div class="col-lg-6 col-12 mx-auto mb-3 p-5">
        <div class="card text-center p-5">
          <h3>
            No Training To Dispaly
          </h3>
        </div>
      <?php } ?>
      </div>
  </div>
</div>



<?php
$pageContent = ob_get_clean();
$pageTitle = 'Dashboard';
require_once '../layout/index.php';
?>