<?php
require_once '../layout/session_start.php';

use MyApp\Admin;
use MyApp\Employee;

$employee = new Employee();
$admin = new Admin();
$notifications = $employee->getNotificationCount();
$report = $notifications['report'];
$manager = $admin->getManagerAndDepById();
$static = $admin->getStatic();
$latestFormation = $admin->getLatestFormation();
$latestLeaves = $admin->getLatestLeaves();
$latestReports = $admin->getLatestReports();
ob_start();
?>
<main class="container-xxl flex-grow-1 container-p-y">
  <!-- Notification -->
  <?php if ($report > 0) : ?>
    <article class="bs-toast toast fade show bg-primary custom-toast" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        <i class="bx bx-bell me-2"></i>
        <div class="me-auto fw-semibold">Notifications</div>
        <small><?= date('H:i A') ?></small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
        Vous avez <?= $report ?> nouveau(x) rapport(s) aujourd'hui.
      </div>
    </article>
  <?php endif ?>
  <!-- /Notification -->
  <!-- Up -->
  <section class="row">
    <!-- badge -->
    <article class="col-lg-8 mb-4 order-0">
      <div class="card">
        <div class="d-flex align-items-end row">
          <div class="col-sm-7">
            <div class="card-body">
              <h5 class="card-title text-primary">Bonjour <?= $_SESSION['name'] ?></h5>
              <p class="mb-4 text-capitalize">
                Vérifiez votre nouveau badge ici.
              </p>
              <a href="javascript:;" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#employeeInfoModal">Afficher les informations</a>
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
            <p><strong>Département:</strong> <?= $manager['nom_departement'] ?></p>
            <p><strong>Téléphone:</strong> <?= $manager['telephone'] ?></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Model -->
    <!-- /badge -->

    <!-- Static -->
    <article class="col-lg-4 col-md-4 order-1">
      <div class="row">
        <!-- Employee Count Card -->
        <div class="col-lg-6 col-md-12 col-6 mb-4">
          <div class="card">
            <div class="card-body mx-auto">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0">
                  <i class='bx bx-user' style="font-size: 45px;color:tomato"></i>
                </div>
              </div>
              <span class="fw-semibold d-block mb-1">Nombre d'employés</span>
              <h3 class="card-title mb-2">
                <?= $static['employee'] ?>
              </h3>
            </div>
          </div>
        </div>
        <!-- Manager Count Card -->
        <div class="col-lg-6 col-md-12 col-6 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0">
                  <i class='bx bx-user-circle' style="font-size: 45px;color:pink"></i>
                </div>
              </div>
              <span>Nombre de gestionnaires</span>
              <h3 class="card-title text-nowrap mb-1">
                <?= $static['manager'] ?>
              </h3>
            </div>
          </div>
        </div>
      </div>
    </article>
    <!-- /Static -->

    <!-- Total Revenue -->
    <article class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
      <div class="card">
        <div class="row row-bordered g-0">
          <div class="col-md-12">
            <h5 class="card-header m-0 me-2 pb-3">Employee Absence</h5>
            <div id="totalRevenueChart2" class="px-2"></div>
          </div>
        </div>
      </div>
    </article>
    <!--/ Total Revenue -->

    <!-- Static -->
    <article class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
      <div class="row">
        <!-- Department Count Card -->
        <div class="col-6 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0">
                  <i class="bx bx-building-house" style="font-size: 45px;color:salmon"></i>
                </div>
              </div>
              <span class="d-block mb-1">Nombre de départements</span>
              <h3 class="card-title text-nowrap mb-2">
                <?= $static['department'] ?>
              </h3>
            </div>
          </div>
        </div>
        <!-- Employees on Leave Card -->
        <div class="col-6 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0">
                  <i class='bx bx-time' style="font-size: 45px;color:blueviolet"></i>
                </div>
              </div>
              <span class="fw-semibold d-block mb-1">Employés en congé</span>
              <h3 class="card-title mb-2">
                <?= $static['leaves'] ?>
              </h3>
            </div>
          </div>
        </div>
      </div>
    </article>
    <!-- /Static -->
  </section>
  <!-- /Up -->
  <!-- #########################"" -->
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
              <a class="dropdown-item" href="report_history.php">Voir tout</a>
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
            <h5 class="m-0 me-2">Commande des feuilles</h5>
            <small class="text-muted">Commande des nouveaux départs</small>
          </div>
          <div class="dropdown">
            <button class="btn p-0" type="button" id="latestReports" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="bx bx-dots-vertical-rounded"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="latestReports">
              <a class="dropdown-item" href="received_request.php">Voir tout</a>
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
    <!-- Latest Formation -->
    <article class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
      <div class="card h-100">
        <div class="card-header d-flex align-items-center justify-content-between pb-0">
          <div class="card-title mb-0">
            <h5 class="m-0 me-2">Commande des feuilles</h5>
            <small class="text-muted">Commande des nouveaux départs</small>
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
    <!--/ Latest Formation -->
  </section>
  <!-- /Down -->
</main>
<?php
$pageContent = ob_get_clean();
$pageTitle = 'Dashboard';
require_once '../layout/index.php';
?>