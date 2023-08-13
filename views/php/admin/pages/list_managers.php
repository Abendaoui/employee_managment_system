<?php
require_once '../layout/session_start.php';

use MyApp\Admin;

$admin = new Admin();
$managers = $admin->getAllManagersWithDepartments();
ob_start();
?>
<div class="card">
  <h5 class="card-header text-center" style="color: black !important;font-size:24px;font-weight:bold">
    Liste des gestionnaires
  </h5>
  <div class="table-responsive text-nowrap mt-3">
    <table class="table table-striped">
      <thead class="bg-dark">
        <tr class="text-center head-link">
          <th>ID</th>
          <th>Nom et prénom</th>
          <th>E-mail</th>
          <th>Poste</th>
          <th>Département</th>
          <th>Date d'embauche</th>
          <th>Téléphone</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        <?php foreach ($managers as $manager) : ?>
          <tr class="text-center">
            <td><strong class="badge bg-label-primary me-1 cursor-pointer">
                <?= $manager['id_employe'] ?>
              </strong></td>
            <td class="cap">
              <?= $manager['nom'] ?> <?= $manager['prenom'] ?>
            </td>
            <td>
              <?= $manager['email'] ?>
            </td>
            <td class="cap">
              <?= $manager['titre_poste'] ?>
            </td>
            <td class="cap">
              <?= $manager['nom_departement'] ?>
            </td>
            <td><strong>
                <?= $manager['date_embauché'] ?>
              </strong>
            </td>
            <td>
              <?= $manager['telephone'] ?>
            </td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="employee_details.php?slug=<?= $employee['slug'] ?>">
                    <i class='bx bx-info-circle me-1'></i> Détails</a>
                  <a class="dropdown-item text-danger" href="../helpers/delete_manager.php?id=<?= $manager['id_employe'] ?>">
                    <i class="bx bx-trash me-1"></i> Supprimer</a>
                </div>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<?php
$pageContent = ob_get_clean();
$pageTitle = 'List Of Managers';
require_once '../layout/index.php';
?>