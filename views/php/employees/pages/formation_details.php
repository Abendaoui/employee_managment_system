<?php
require '../../../../vendor/autoload.php';
require_once '../layout/session_start.php';

use MyApp\Employee;

$id = $_GET['id'] ?? 1;
$employee = new Employee();
$target_formation = $employee->getTrainingById($id);
ob_start();
?>

<style>
  .training-details {
    margin-top: 20px;
  }

  .status-badge {
    font-size: 14px;
    padding: 5px 10px;
    border-radius: 3px;
  }

  .status-completed {
    background-color: #28a745;
    color: #fff;
  }

  .status-pending {
    background-color: #ffc107;
    color: #000;
  }

  strong {
    color: #696cff !important;
    font-size: 18px;
    font-weight: bold;
    font-family: monospace !important;
  }

  h1 {
    font-family: monospace !important;
    text-align: center;
    margin-bottom: 10px !important;
  }
</style>
<div class="container">
  <h1 class="mt-4">Training Session Details</h1>

  <div class="row training-details mt-4 ">
    <div class="col-md-10 mx-auto offset-md-2">
      <div class="card rounded-3">
        <div class="bg-primary text-white p-3 d-flex justify-content-center align-content-center">
          <h4 class="text-white mt-2">Training Session <?= $target_formation['id_formation'] ?></h4>
        </div>
        <div class="card-body text-capitalize">
          <h5 class="card-title"><strong>Title:</strong><?= $target_formation['title'] ?></h5>
          <p class="card-text"><strong>Description:</strong>
            <?= $target_formation['description'] ?>
          </p>
          <p class="card-text"><strong>Start Date:</strong> <?= $target_formation['date_start'] ?></p>
          <p class="card-text"><strong>End Date:</strong> <?= $target_formation['date_end'] ?></p>
          <p class="card-text"><strong>Sender:</strong> <?=
                                                        $employee->getManagerBYId($target_formation['id_sender'])['full_name'];
                                                        ?>
          </p>
          <p class="card-text"><strong>Recipient:</strong> <?= $_SESSION['name'] ?></p>
          <p class="card-text"><strong>Status:</strong> <span class="status-badge status-<?= $target_formation['status'] ?>">
              <?= $target_formation['status'] ?>
            </span></p>
          <p class="card-text"><strong>Date Sent:</strong> <?= $target_formation['date_sent'] ?></p>
        </div>
      </div>
    </div>
  </div>
</div>





<?php
$pageContent = ob_get_clean();
$pageTitle = 'Dashboard';
require_once '../layout/index.php';
?>