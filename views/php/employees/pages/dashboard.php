<?php
if (isset($_GET['msg']) && isset($_GET['state'])) {
  $msg = $_GET['msg'];
  $state = $_GET['state'];
}
require '../../../../vendor/autoload.php';
require_once '../layout/session_start.php';

use MyApp\Employee;

$employee = new Employee();
$notifications = $employee->getNotificationCount();
$report = $notifications['report'];
$formation = $notifications['formation'];
$dep = $employee->getEmployeeDepartmentInfo();
$latestFormation = $employee->getLatestFormation();
$latestLeaves = $employee->getLatestLeaves();
$latestReports = $employee->getLatestReports();

// Clock-Time
$is_clock_in = $employee->hasClockIn();

// print_r($is_clock_in);
// exit;

ob_start();
?>
<main class="container-xxl flex-grow-1 container-p-y">
  <!-- Notification -->
  <?php if ($report > 0 || $formation > 0) : ?>
    <article class="bs-toast toast fade show bg-primary custom-toast" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        <i class="bx bx-bell me-2"></i>
        <div class="me-auto fw-semibold">Notifications</div>
        <small><?= date('H:i A') ?></small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
        You have <?= $report ?> new report(s) and <?= $formation ?> new formation(s) today.
      </div>
    </article>
  <?php endif ?>
  <!-- /Notification -->
  <!-- Up -->
  <section class="row">
    <!-- Badge Model -->
    <article class="col-lg-8 mb-4 order-0">
      <div class="card">
        <div class="d-flex align-items-end row">
          <div class="col-sm-7">
            <div class="card-body">
              <h5 class="card-title text-primary">Welcome <?= $_SESSION['name'] ?></h5>
              <p class="mb-4 text-capitalize">
                Check your new badge in your profile.
              </p>
              <a href="javascript:;" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#employeeInfoModal">View Employee Info</a>
            </div>
          </div>
          <div class="col-sm-5 text-center text-sm-left">
            <div class="card-body pb-0 px-0 px-md-4">
              <img src="../../../../assets/img/illustrations/man-with-laptop-light.png" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png" />
            </div>
          </div>
        </div>
      </div>
    </article>
    <!-- Model -->
    <div class="modal fade" id="employeeInfoModal" tabindex="-1" aria-labelledby="employeeInfoModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <div class="d-flex align-items-center gap-4" id="employeeInfoModalLabel">
              <img src="../../../../assets/img/logo/logo.jpeg" class="rounded-circle" height="50" alt="Company Logo" />
              <h5 class="mb-0">SellsySoft</h5>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <img src="../../../../assets/img/avatars/<?= $_SESSION['profile'] ?>.png" class="mx-auto d-block mb-3 rounded-circle" height="80" alt="Employee Avatar" />
            <p><strong>Name:</strong> <?= $_SESSION['name'] ?></p>
            <p><strong>Department:</strong> <?= $dep['dep'] ?></p>
            <p><strong>Telephone:</strong> <?= $dep['telephone'] ?></p>
            <p style="margin-bottom: -12px;"><strong>Job:</strong> <?= $dep['titre_poste'] ?></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!-- /Badge Model -->

    <article class="col-lg-4 col-md-12 order-1">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-12 mb-4">
          <div class="card">
            <div class="card-header">
              Clock In / Clock Out
            </div>
            <div class="card-body d-flex justify-content-between">
              <?php if ($is_clock_in === 'n') : ?>
                <form action="../helpers/clock-in.php" method="post" class="flex-grow-1 me-2">
                  <div class="mb-3">
                    <label for="clockIn" class="form-label">Clock In</label>
                    <button type="submit" class="btn btn-primary" name="submit" id="clockIn">Clock In</button>
                  </div>
                </form>
              <?php endif; ?>
              <form action="../helpers/clock-out.php" method="post" class="flex-grow-1">
                <div class="mb-3">
                  <label for="clockOut" class="form-label">Clock Out</label>
                  <button type="submit" class="btn btn-danger" name="submit" id="clockOut">Clock Out</button>
                </div>
              </form>
            </div>

            <?php if (isset($msg) && $msg !== '') : ?>
              <div class="alert alert-<?php echo $state ? 'success' : 'danger';  ?> alert-dismissible mb-3 col-8 mx-auto" role="alert">
                <?= $msg ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php endif ?>
          </div>
        </div>

      </div>
    </article>
    <!-- Total Present -->
    <article class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
      <div class="card">
        <div class="row row-bordered g-0">
          <div class="col-md-12">
            <h5 class="card-header m-0 me-2 pb-3">Present Static</h5>
            <div id="totalRevenueChart" class="px-2"></div>
          </div>
        </div>
      </div>
    </article>
    <!--/ Total Present -->
    <!-- Schedule Time -->
    <article class="col-lg-4 col-md-4 order-3">
      <div class="row">
        <!-- Latest Formation -->
        <article class="col-12 mb-4">
          <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between pb-0">
              <div class="card-title mb-0">
                <h5 class="m-0 me-2">Latest Formation</h5>
                <small class="text-muted">Newly Formation</small>
              </div>
              <div class="dropdown">
                <button class="btn p-0" type="button" id="latestReports" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="latestReports">
                  <a class="dropdown-item" href="list_formations.php">View All</a>
                  <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                </div>
              </div>
            </div>
            <div class="card-body mt-4">
              <ul class="list-unstyled m-0">
                <?php foreach ($latestFormation as $formation) : ?>
                  <li class="d-flex align-items-center gap-4 mb-3">
                    <div class="d-flex flex-shrink-0 justify-content-center align-items-center me-3">
                      <span class="avatar avatar-md rounded-circle " style="display: flex;justify-content: center;align-items: center;background:salmon;color:#fff"><i class="bx bx-book"></i></span>
                    </div>
                    <div class="d-flex flex-column">
                      <h6 class="mb-0">
                        <?= $formation['title'] ?>
                      </h6>
                      <small class="text-muted">By: <?= $_SESSION['name'] ?></small>
                    </div>
                    <div class="d-flex flex-shrink-0 align-items-center">
                      <small class="text-muted">
                        <?= date('M-d - H:i', strtotime($formation['date_sent'])) ?>
                      </small>
                    </div>
                  </li>
                <?php endforeach ?>
              </ul>
            </div>
          </div>
        </article>
        <!--/ Latest Formation -->
      </div>
    </article>
    <!--/ Schedule Time -->
  </section>
  <!-- /Up -->
  <!-- Down -->
  <section class="row">
    <!-- Latest Report -->
    <article class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
      <div class="card h-100">
        <div class="card-header d-flex align-items-center justify-content-between pb-0">
          <div class="card-title mb-0">
            <h5 class="m-0 me-2">Latest Reports</h5>
            <small class="text-muted">Newly Received Reports</small>
          </div>
          <div class="dropdown">
            <button class="btn p-0" type="button" id="latestReports" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="bx bx-dots-vertical-rounded"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="latestReports">
              <a class="dropdown-item" href="send_history.php">View All</a>
              <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
            </div>
          </div>
        </div>
        <div class="card-body mt-4">
          <ul class="list-unstyled m-0">
            <?php foreach ($latestReports as $report) : ?>
              <li class="d-flex align-items-center gap-4 mb-3">
                <div class="d-flex flex-shrink-0 justify-content-center align-items-center me-3">
                  <span class="avatar avatar-md rounded-circle bg-label-primary" style="display: flex;justify-content: center;align-items: center;"><i class="bx bx-file"></i></span>
                </div>
                <div class="d-flex flex-column">
                  <h6 class="mb-0">
                    <?= $report['subject'] ?>
                  </h6>
                  <small class="text-muted">By: <?= $report['full_name'] ?></small>
                </div>
                <div class="d-flex flex-shrink-0 align-items-center">
                  <small class="text-muted"><?= date('D - H:i', strtotime($report['date_sent'])) ?></small>
                </div>
              </li>
            <?php endforeach ?>
          </ul>
        </div>
      </div>
    </article>
    <!--/ Latest Report -->
    <!-- Latest Leaves Command -->
    <article class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
      <div class="card h-100">
        <div class="card-header d-flex align-items-center justify-content-between pb-0">
          <div class="card-title mb-0">
            <h5 class="m-0 me-2">Leaves Command</h5>
            <small class="text-muted">Newly Leaves Command</small>
          </div>
          <div class="dropdown">
            <button class="btn p-0" type="button" id="latestReports" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="bx bx-dots-vertical-rounded"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="latestReports">
              <a class="dropdown-item" href="request_history.php">View All</a>
              <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
            </div>
          </div>
        </div>
        <div class="card-body mt-4">
          <ul class="list-unstyled m-0">
            <?php foreach ($latestLeaves as $leave) : ?>
              <li class="d-flex align-items-center gap-4 mb-3">
                <div title="<?= $leave['statut'] ?>" class="d-flex flex-shrink-0 justify-content-center align-items-center me-3">
                  <span class="avatar avatar-md rounded-circle" style="display: flex;justify-content: center;align-items:center;
                  background:<?php echo $leave['statut'] === 'Approuvé' ? 'aquamarine' : 'tomato'; ?>
                  ;color:<?php echo $leave['statut'] === 'Approuvé' ? 'rgb(18, 202, 140)' : 'red'; ?>">
                    <i class="bx bx-time"></i></span>
                </div>
                <div class="d-flex flex-column">
                  <h6 class="mb-0"><?= $leave['type'] ?></h6>
                  <small class="text-muted">By: <?= $leave['full_name'] ?></small>
                </div>
                <div class="d-flex flex-shrink-0 align-items-center">
                  <small class="text-muted">
                    <?= date('Y-m-d', strtotime($leave['date_debut'])) ?>
                  </small>
                </div>
              </li>
            <?php endforeach ?>
          </ul>
        </div>
      </div>
    </article>
    <!--/ Latest Leaves Command -->
  </section>
  <!-- /Down -->
</main>
<?php
$pageContent = ob_get_clean();
$pageTitle = 'Dashboard';
require_once '../layout/index.php';
?>