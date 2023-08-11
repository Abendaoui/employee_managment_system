<?php
if (isset($_GET['msg']) && isset($_GET['state'])) {
 $msg = $_GET['msg'];
 $state = $_GET['state'];
}
require '../../../../vendor/autoload.php';
require_once '../layout/session_start.php';

use MyApp\Employee;

$employee = new Employee();
$relatedEmployee = $employee->getEmployeesByDepartment();
ob_start();
?>
<div class="container mt-4">
 <div class="row">
  <div class="col-md-6 offset-md-3">
   <div class="card">
    <div class="card-header">
     <h5 class="mb-0">Send Report</h5>
    </div>
    <div class="card-body">
     <form action="../helpers/process_send.php" method="POST">
      <div class="mb-3">
       <label class="form-label" for="leave_type">Recipient</label>
       <select class="form-select text-capitalize" id="leave_type" name="id_rec" required>
        <option value="" selected disabled>Select The Receipent</option>
        <?php foreach ($relatedEmployee as $employee) : ?>
         <option value="<?= $employee['id'] ?>"><?= $employee['full_name'] ?>
          <?php echo $employee['role'] === 'manager' ? ' (Manager)' : '' ?>
         </option>
        <?php endforeach ?>
       </select>
      </div>
      <!-- Recipient Email -->
      <div class="mb-3">
       <label class="form-label" for="recipient_email">Recipient Email</label>
       <div class="input-group input-group-merge">
        <input type="email" class="form-control" id="recipient_email" name="recipient_email" placeholder="john@example.com" aria-label="john@example.com" required />
       </div>
      </div>
      <div class="mb-3">
       <label class="form-label">Subject:</label>
       <input type="text" class="form-control" name="report_subject" required>
      </div>
      <div class="mb-3">
       <label class="form-label">Report Content:</label>
       <textarea class="form-control" name="report_content" rows="5" required></textarea>
      </div>
      <?php if (isset($msg) && $msg !== '') : ?>
       <div class="alert alert-<?php echo $state ? 'success' : 'danger';  ?> alert-dismissible mb-3" role="alert">
        <?= $msg ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>
      <?php endif ?>
      <button type="submit" name="submit" class="btn btn-primary">Send Report</button>
     </form>
    </div>
   </div>
  </div>
 </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
 $(document).ready(function() {
  $('#leave_type').change(function() {
   const selectedEmployeeId = $(this).val();
   if (selectedEmployeeId !== '') {
    // Send an AJAX request to get the email of the selected employee
    $.ajax({
     url: '../helpers/get_employee_email.php', // Replace with the actual PHP file that fetches the email from the database
     method: 'POST',
     data: {
      id: selectedEmployeeId
     },
     dataType: 'json',
     success: function(data) {
      if (data.success) {
       // Update the email field with the received email
       $('#recipient_email').val(data.email);
      } else {
       // If there's an error, you can handle it here
       console.error('Error fetching email.');
      }
     },
     error: function() {
      console.error('Error sending AJAX request.');
     }
    });
   }
  });
 });
</script>

<?php
$pageContent = ob_get_clean();
$pageTitle = 'Send Report';
require_once '../layout/index.php';
?>