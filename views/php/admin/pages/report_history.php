<?php
require_once '../layout/session_start.php';

use MyApp\Admin;
use MyApp\Employee;
$employee = new Employee();
$admin = new Admin();
$reports = $admin->getSendAndReceiveReport();
$count = $admin->getReceivedReportCountToday();

$send_reports = $reports['sentReports'];
$received_reports = $reports['receivedReports'];
ob_start();
?>
<div class="container mt-4">
  <div class="row">
    <div class="col-xl">
      <h4 class="text-muted text-center mb-3">Reports History</h4>
      <div class="nav-align-top mb-4 mt-3">
        <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
          <li class="nav-item">
            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-home" aria-controls="navs-pills-justified-home" aria-selected="true">
              <i class='bx bx-send bx-flashing'></i> Send
            </button>
          </li>
          <li class="nav-item">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-profile" aria-controls="navs-pills-justified-profile" aria-selected="false">
              <i class='bx bx-send bx-flashing bx-rotate-180'></i> Received
              <?php if (isset($count) && $count > 0) : ?>
                <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger">
                  <?= $count ?>
                </span>
              <?php endif; ?>
            </button>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane fade show active" id="navs-pills-justified-home" role="tabpanel">
            <ul>
              <?php foreach ($send_reports as $report) : ?>
                <li class="li mb-3  mb-2 p-4 rounded-3 text-capitalize">
                  <h6>Subject: <?= $report['subject'] ?></h6>
                  <p><strong>From:</strong> <?php echo $_SESSION['role'] . " " . $_SESSION['name'] ?></p>
                  <p><strong>To:</strong> <?php
                                          $emp = $employee->getManagerBYId($report['id_recipient']);
                                          echo $emp['role'] . " " . $emp['full_name']
                                          ?></p>
                  <p><?= $report['content'] ?></p>
                  <p class="text-muted">Sent: <?= $report['date_sent'] ?></p>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
          <div class="tab-pane fade" id="navs-pills-justified-profile" role="tabpanel">
            <ul>
              <?php foreach ($received_reports as $report) : ?>
                <li class="li mb-3  mb-2 p-4 rounded-3 text-capitalize">
                  <h6>Subject: <?= $report['subject'] ?></h6>
                  <p><strong>From: </strong><?php echo $report['role'] . " " . $report['nom'] . " " . $report['prenom'] ?> </p>
                  <p><strong>To: </strong><?php echo $_SESSION['role'] . " " . $_SESSION['name'] ?></p>
                  <p><?= $report['content'] ?></p>
                  <p class="text-muted">Sent: <?= date('Y-m-d h:i',strtotime($report['date_sent'])) ?></p>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
$pageContent = ob_get_clean();
$pageTitle = 'List Of Sent Reports';
require_once '../layout/index.php';
?>