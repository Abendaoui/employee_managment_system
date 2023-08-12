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
$is_clock_out = $employee->hasClockOut();

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
        Vous avez <?= $report ?> nouveau(x) rapport(s) et <?= $formation ?> nouvelle(s) formation(s) aujourd'hui.
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
              <h5 class="card-title text-primary">Bonjour <?= $_SESSION['name'] ?></h5>
              <p class="mb-4 text-capitalize">
                Vérifiez votre nouveau badge ici.
              </p>
              <a href="javascript:;" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#employeeInfoModal">Afficher vos informations</a>
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
            <p><strong>nom et prénom:</strong> <?= $_SESSION['name'] ?></p>
            <p><strong>Département:</strong> <?= $dep['dep'] ?></p>
            <p><strong>Téléphone:</strong> <?= $dep['telephone'] ?></p>
            <p style="margin-bottom: -12px;"><strong>Emploi:</strong> <?= $dep['titre_poste'] ?></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
          </div>
        </div>
      </div>
    </div>
    <!-- /Badge Model -->
    <!-- Clock -->
    <article class="col-lg-4 col-md-12 order-1">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-12 mb-4">
          <div class="card">
            <div class="card-header text-capitalize">
              Horloge d'entrée / Horloge de sortie
            </div>
            <div class="card-body d-flex justify-content-between">
              <?php if ($is_clock_in === 'n') : ?>
                <form action="../helpers/clock-in.php" method="post" class="flex-grow-1 me-2">
                  <div class="mb-3">
                    <label for="clockIn" class="form-label">Horloge d'entrée</label>
                    <button type="submit" class="btn btn-primary" name="submit" id="clockIn">Horloge d'entrée</button>
                  </div>
                </form>
              <?php endif; ?>
              <?php if ($is_clock_out === 'n') : ?>
                <form action="../helpers/clock-out.php" method="post" class="flex-grow-1">
                  <div class="mb-3">
                    <label for="clockOut" class="form-label">Horloge de sortie</label>
                    <button type="submit" class="btn btn-danger" name="submit" id="clockOut">Horloge de sortie</button>
                  </div>
                </form>
              <?php endif; ?>
              <?php if ($is_clock_in === 'y' && $is_clock_out === 'y') : ?>
                <h1 style="font-family: monospace;font-size:22px;color:blueviolet;text-align:center">U Complete Ur Day</h1>
              <?php endif; ?>
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
    <!-- /Clock -->
    <!-- Total Present -->
    <article class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
      <div class="card">
        <div class="row row-bordered g-0">
          <div class="col-md-12">
            <h5 class="card-header m-0 me-2 pb-3">Statistiques Des Heures</h5>
            <div id="totalRevenueChart" class="px-2"></div>
          </div>
        </div>
      </div>
    </article>
    <!--/ Total Present -->
    <!-- Latest Formation -->
    <article class="col-lg-4 col-md-4 order-3">
      <div class="row">
        <article class="col-12 mb-4">
          <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between pb-0">
              <div class="card-title mb-0">
                <h5 class="m-0 me-2">Dernière formation</h5>
                <small class="text-muted">Nouvellement formé</small>
              </div>
              <div class="dropdown">
                <button class="btn p-0" type="button" id="latestReports" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="latestReports">
                  <a class="dropdown-item" href="list_formations.php">Voir tout</a>
                  <a class="dropdown-item" href="javascript:void(0);">Rafraîchir</a>
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
                      <small class="text-muted">Par: <?= $_SESSION['name'] ?></small>
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
      </div>
    </article>
    <!--/ Latest Formation -->
  </section>
  <!-- /Up -->
  <!-- Down -->
  <section class="row">
    <!-- Latest Report -->
    <article class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
      <div class="card h-100">
        <div class="card-header d-flex align-items-center justify-content-between pb-0">
          <div class="card-title mb-0">
            <h5 class="m-0 me-2">Derniers rapports</h5>
            <small class="text-muted">Rapports nouvellement reçus</small>
          </div>
          <div class="dropdown">
            <button class="btn p-0" type="button" id="latestReports" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="bx bx-dots-vertical-rounded"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="latestReports">
              <a class="dropdown-item" href="send_history.php">Voir tout</a>
              <a class="dropdown-item" href="javascript:void(0);">Rafraîchir</a>
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
                  <small class="text-muted">Par: <?= $report['full_name'] ?></small>
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
            <h5 class="m-0 me-2">Congé Commande</h5>
            <small class="text-muted">Commande nouvellement conge</small>
          </div>
          <div class="dropdown">
            <button class="btn p-0" type="button" id="latestReports" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="bx bx-dots-vertical-rounded"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="latestReports">
              <a class="dropdown-item" href="request_history.php">Voir tout</a>
              <a class="dropdown-item" href="javascript:void(0);">Rafraîchir</a>
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
                  <small class="text-muted">Par: <?= $leave['full_name'] ?></small>
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