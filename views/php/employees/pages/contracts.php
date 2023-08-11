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

<div class="container mt-4">
  <div class="row">
    <div class="contract bg-light rounded-3">
      <div class="contract-title">EMPLOYMENT CONTRACT</div>
      <div class="contract-details">
        <div class="section-title">Employee Information</div>
        <p><strong>Name:</strong> <?= $current_employee['nom'] . " " . $current_employee['prenom'] ?></p>
        <p><strong>Position:</strong> <?= $current_employee['titre_poste'] ?> </p>
      </div>
      <div class="contract-details">
        <div class="section-title">Terms and Conditions</div>
        <ul>
          <?php foreach ($times as $time) : ?>
            <li>
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque bibendum magna vitae imperdiet
              fringilla.
            </li>
          <?php endforeach ?>
        </ul>
      </div>
      <div class="terms">
        <div class="section-title">Acceptance of Contract</div>
        <p>I, John Doe, hereby accept the terms and conditions of this employment contract and agree to abide by
          them during the term of my employment.</p>
      </div>
      <div class="signature">
        <div class="signature-line"></div>
        <div class="signature-label">John Doe</div>
        <div class="signature-label">Employee Signature</div>
      </div>
      <div class="company-info">
        <p>Company Name | Address | Phone | Email</p>
      </div>
    </div>
  </div>

  <div class="buy-now">
    <button class="btn btn-danger btn-buy-now" onclick="downloadContract()">Download Contract <i class='bx bx-download bx-flashing'></i></button>

  </div>
</div>

<!-- JavaScript to handle the download functionality -->
<script>
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
</script>

<?php
$pageContent = ob_get_clean();
$pageTitle = 'Contract';
require_once '../layout/index.php';
?>