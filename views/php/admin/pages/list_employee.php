<?php
if (isset($_GET['msg']) && isset($_GET['state'])) {
  $msg = $_GET['msg'];
  $state = $_GET['state'];
}
require_once '../layout/session_start.php';

use MyApp\Admin;

$admin = new Admin();
$employees = $admin->getAllEmployeessWithDepartments();
ob_start();
?>
<div class="card">
  <h5 class="card-header text-center" style="color: black !important;font-size:24px;font-weight:bold">
    List Of Employees
  </h5>
  <div class="table-responsive text-nowrap mt-3">
    <table class="table table-striped">
      <thead class="bg-dark">
        <tr class="text-center head-link">
          <th>ID</th>
          <th>Full-Name</th>
          <th>Email</th>
          <th>Poste</th>
          <th>Departement</th>
          <th>Date Hired</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        <?php foreach ($employees as $employee) : ?>
          <tr class="text-center">
            <td><strong class="badge bg-label-primary me-1 cursor-pointer">
                <?= $employee['id_employe'] ?>
              </strong></td>
            <td class="cap">
              <?= $employee['nom'] ?> <?= $employee['prenom'] ?>
            </td>
            <td>
              <?= $employee['email'] ?>
            </td>
            <td class="cap">
              <?= $employee['titre_poste'] ?>
            </td>
            <td class="cap">
              <?= $employee['nom_departement'] ?>
            </td>
            <td><strong>
                <?= $employee['date_embauché'] ?>
              </strong>
            </td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="employee_details.php?slug=<?= $employee['slug'] ?>">
                    <i class='bx bx-info-circle me-1'></i> Details</a>
                  <a class="dropdown-item text-danger" href="../helpers/delete_employee.php?id=<?= $employee['id_employe'] ?>"><i class="bx bx-trash me-1"></i> Delete</a>
                </div>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<!-- Msg -->
<?php if (isset($msg) && $msg !== '') : ?>
  <div class="mt-4 alert alert-<?php echo $state ? 'success' : 'danger';  ?> alert-dismissible mb-3" role="alert">
    <?= $msg ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php endif ?>

<?php
$pageContent = ob_get_clean();
$pageTitle = 'List Of Employees';
require_once '../layout/index.php';
?>