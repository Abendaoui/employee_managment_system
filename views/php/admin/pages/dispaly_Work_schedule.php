<?php
require_once '../layout/session_start.php';

use MyApp\Admin;

$admin = new Admin();
$selectedSlug = $_GET['slug'] ?? '';
$employees = $admin->getAllEmployeessWithDepartments();
$workSchedule = $admin->getEmployeeWorkSchedule($selectedSlug);
ob_start();
?>
<!-- Employee List -->
<div class="col-xl">
  <div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Work Schedule for <?php echo date('F Y'); ?></h5>
      <small class="text-muted float-end">Monthly Schedule</small>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-xl">
          <div class="list-group mb-4  h-px-200 overflow-auto">
            <?php foreach ($employees as $employee) : ?>
              <a href="dispaly_Work_schedule.php?slug=<?= $employee['slug'] ?>" class="list-group-item list-group-item-action
                <?php echo $employee['slug'] === $selectedSlug ? 'active' : ''; ?>">
                <?= $employee['prenom'] ?>
              </a>
            <?php endforeach ?>
          </div>
          <!-- Calendar View -->
          <?php if ($selectedSlug !== '') : ?>
            <table class="table table-bordered">
              <thead>
                <tr class="table-row">
                  <th>Date</th>
                  <th>Start Hour</th>
                  <th>End Hour</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($workSchedule as $schedule) : ?>
                  <tr>
                    <td><?= date('D', strtotime($schedule['date_travail'])) ?></td>
                    <td>
                      <?= date('h:i', strtotime($schedule['heure_entree'])) ?> AM
                    </td>
                    <td>
                      <?= date('h:i', strtotime($schedule['heure_sortie'])) ?>
                    </td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          <?php endif ?>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<?php
$pageContent = ob_get_clean();
$pageTitle = 'Display Work Schedule';
require_once '../layout/index.php';
?>