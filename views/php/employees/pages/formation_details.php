<?php
require '../../../../vendor/autoload.php';
require_once '../layout/session_start.php';

use MyApp\Employee;

$id = $_GET['id'] ?? 1;
$employee = new Employee();
$target_formation = $employee->getTrainingById($id);
ob_start();
?>

<div class="container">
  <h1 class="mt-4">Détails de la session de formation</h1>

  <div class="row training-details mt-4 ">
    <div class="col-md-10 mx-auto offset-md-2">
      <div class="card rounded-3">
        <div class="bg-primary text-white p-3 d-flex justify-content-center align-content-center">
          <h4 class="text-white mt-2">Session de formation <?= $target_formation['id_formation'] ?></h4>
        </div>
        <div class="card-body text-capitalize">
          <h5 class="card-title"><strong>Titre:</strong><?= $target_formation['title'] ?></h5>
          <p class="card-text"><strong>Description:</strong>
            <?= $target_formation['description'] ?>
          </p>
          <p class="card-text"><strong>Date de début:</strong> <?= $target_formation['date_start'] ?></p>
          <p class="card-text"><strong>Date de fin:</strong> <?= $target_formation['date_end'] ?></p>
          <p class="card-text"><strong>Expéditeur:</strong> <?=
                                                        $employee->getManagerBYId($target_formation['id_sender'])['full_name'];
                                                        ?>
          </p>
          <p class="card-text"><strong>Destinataire:</strong> <?= $_SESSION['name'] ?></p>
          <p class="card-text"><strong>Statut:</strong> <span class="status-badge status-<?= $target_formation['status'] ?>">
              <?= $target_formation['status'] ?>
            </span></p>
          <p class="card-text"><strong>Date d'envoi:</strong> <?= $target_formation['date_sent'] ?></p>
        </div>
      </div>
    </div>
  </div>
</div>





<?php
$pageContent = ob_get_clean();
$pageTitle = "Formation ". $target_formation['title'];
require_once '../layout/index.php';
?>