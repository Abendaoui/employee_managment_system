<?php
$times = [1, 2, 3, 4];
require '../../../../vendor/autoload.php';
require_once '../layout/session_start.php';

use MyApp\Employee;

$employee = new Employee();
$current_employee = $employee->getUserInfo();
ob_start();
?>

<style>
  .contract {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ccc;
  }

  strong {
    color: #000 !important;
    font-size: 15px !important;
  }

  .contract-title {
    text-align: center;
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 20px;
  }

  .section-title {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 10px;
  }

  .contract-details {
    margin-bottom: 20px;
  }

  .terms {
    margin-top: 40px;
  }

  .signature {
    margin-top: 60px;
    text-align: center;
  }

  .signature-line {
    width: 200px;
    border-bottom: 1px solid #000;
    margin: 0 auto;
  }

  .signature-label {
    margin-top: 10px;
    font-weight: bold;
  }

  .company-info {
    text-align: center;
    margin-top: 40px;
    font-size: 14px;
  }
</style>

<div class="container mt-5">
  <div class="row">
    <div class="contract col-md-8 offset-md-2">
      <div class="card">
        <div class="card-header text-center">
          <h2>EMPLOYMENT CONTRACT</h2>
        </div>
        <div class="card-body">
          <div class="mb-4 d-flex justify-content-between px-3">
            <div>
              <p><strong>Name:</strong> <?= $current_employee['prenom'] . ' ' . $current_employee['nom'] ?></p>
              <p><strong>Position:</strong> <?= $current_employee['titre_poste'] ?></p>
            </div>
            <div>
              <p><strong>Department:</strong> <?= $current_employee['nom_departement'] ?></p>
              <p><strong>Date Hired:</strong> <?= $current_employee['date_embauché'] ?></p>
            </div>
          </div>
          <div class="mb-4">
            <h4 class="text-center">Terms and Conditions</h4>
            <ul>
              <?php foreach (explode(',', $current_employee['termes_contrat']) as $term) : ?>
                <li><?= $term ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
          <div class="mb-4">
            <h4 class="text-center">Acceptance of Contract</h4>
            <p>I, <?= $current_employee['prenom'] . ' ' . $current_employee['nom'] ?>, hereby accept the terms and conditions of this employment contract and agree to abide by them during the term of my employment.</p>
          </div>
          <div class="signature text-center">
            <div class="signature-line"></div>
            <div class="signature-label"><?= $current_employee['prenom'] . ' ' . $current_employee['nom'] ?></div>
            <div class="signature-label">Employee Signature</div>
          </div>
          <div class="mt-4 text-center">
            <p>sellsysoft | <?= $current_employee['adresse'] . ' | ' . $current_employee['telephone'] ?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="buy-now">
  <button class="btn btn-danger btn-buy-now " id="down">Download <i class='bx bx-download bx-flashing'></i></button>
</div>

<!-- JavaScript to handle the download functionality -->
<script>
  const down = document.getElementById('down');

  function downloadContract() {
    const contractElement = document.querySelector('.contract');
    const opt = {
      margin: [0, 0],
      filename: 'employee_contract.pdf',
      image: {
        type: 'jpeg',
        quality: 0.98
      },
      html2canvas: {
        scale: 2
      },
      jsPDF: {
        unit: 'mm',
        format: 'a4',
        orientation: 'portrait'
      }
    };

    // Generate the PDF
    html2pdf()
      .from(contractElement)
      .set(opt)
      .save();
  }
  down.addEventListener('click', downloadContract)
</script>

<?php
$pageContent = ob_get_clean();
$pageTitle = 'Contract';
require_once '../layout/index.php';
?>