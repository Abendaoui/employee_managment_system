<?php
require '../../../../vendor/autoload.php';
require_once '../layout/session_start.php';

use MyApp\Employee;

$employee = new Employee();
$received_formation = $employee->getAllReceivedTrainings();
ob_start();
?>
<div class="container mt-4">
  <h1 class="mt-4">Séances de formation des employés</h1>

  <div class="row mt-4">
    <?php if (count($received_formation)) { ?>
      <?php foreach ($received_formation as $formation) : ?>
        <div class="col-lg-6 col-12 mx-auto mb-3">
          <div class="card text-center">
            <div class="card-header">Session de formation <?= $formation['id_formation'] ?></div>
            <div class="card-body">
              <h5 class="card-title">Titre: <?= $formation['title'] ?></h5>
              <p class="card-text"><strong>Date de début:</strong> <?= $formation['date_start'] ?></p>
              <p class="card-text"><strong>Date de fin:</strong> <?= $formation['date_end'] ?></p>
              <p class="card-text"><strong>Date d'envoi:</strong><?= $formation['date_sent'] ?></p>
              <a href="formation_details.php?id=<?= $formation['id_formation'] ?>" class="btn btn-primary mt-3">Détails</a>
            </div>
          </div>
        </div>
      <?php endforeach ?>
    <?php } else { ?>
      <div class="col-lg-6 col-12 mx-auto mb-3 p-5">
        <div class="card text-center p-5">
          <h3>
            Aucune formation à afficher
          </h3>
        </div>
      <?php } ?>
      </div>
  </div>
</div>



<?php
$pageContent = ob_get_clean();
$pageTitle = 'List Formation';
require_once '../layout/index.php';
?>