<?php
require_once '../layout/session_start.php';

use MyApp\Employee;

$employee = new Employee();
$notifications = $employee->getNotificationCount();
$report = $notifications['report'];
$count = $employee->getReceivedReportCountToday();
?>
<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
  <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
      <i class="bx bx-menu bx-sm"></i>
    </a>
  </div>

  <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
    <!-- Search -->
    <div class="navbar-nav align-items-center">
      <div class="nav-item d-flex align-items-center">
        <!-- <input type="text" class="form-control border-0 shadow-none" readonly aria-label="Search..." /> -->
      </div>
    </div>
    <!-- /Search -->

    <ul class="navbar-nav flex-row align-items-center ms-auto">
      <!-- Notifucation. -->
      <li class="nav-item navbar-dropdown dropdown-user dropdown">
        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
          <div class="avatar mt-2">
            <i class='bx bx-bell' style="font-size:32px;color:<?php echo $count > 0 ? 'red' : 'black' ?>"></i>
          </div>
        </a>
        <?php if ($report > 0) : ?>
          <ul class="dropdown-menu dropdown-menu-end">
            <li>
              <a class="dropdown-item" href="../pages/report_history.php">
                <i class='bx bxs-report'></i>
                <span class="align-middle">You Have New Reports</span>
              </a>
            </li>
          </ul>
        <?php endif ?>
      </li>
      <!--/ Notifucation. -->
      <!-- User -->
      <li class="nav-item navbar-dropdown dropdown-user dropdown">
        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
          <div class="avatar avatar-online">
            <img src="../../../../assets/img/avatars/<?= $_SESSION['profile'] ?>.png" alt class="w-px-40 h-auto rounded-circle" />
          </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
          <li>
            <a class="dropdown-item" href="#">
              <div class="d-flex">
                <div class="flex-shrink-0 me-3">
                  <div class="avatar avatar-online">
                    <img src="../../../../assets/img/avatars/<?= $_SESSION['profile'] ?>.png" alt class="w-px-40 h-auto rounded-circle" />
                  </div>
                </div>
                <div class="flex-grow-1 text-capitalize">
                  <span class="fw-semibold d-block">
                    <?= $_SESSION['name'] ?>
                  </span>
                  <small class="text-muted">
                    <?= $_SESSION['role'] ?>
                  </small>
                </div>
              </div>
            </a>
          </li>
          <li>
            <div class="dropdown-divider"></div>
          </li>
          <li>
            <a class="dropdown-item" href="profile.php">
              <i class="bx bx-user me-2"></i>
              <span class="align-middle">My Profile</span>
            </a>
          </li>
          <li>
            <div class="dropdown-divider"></div>
          </li>
          <li>
            <a class="dropdown-item" href="../helpers/logout.php">
              <i class="bx bx-power-off me-2"></i>
              <span class="align-middle">Log Out</span>
            </a>
          </li>
        </ul>
      </li>
      <!--/ User -->
    </ul>
  </div>
</nav>