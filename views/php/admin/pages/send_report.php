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
<div class="row">
 <div class="col-12 col-lg-10 mx-auto">
  <div class="card mb-4">
   <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Send Report</h5>
    <small class="text-muted float-end">Enter the details below</small>
   </div>
   <div class="card-body">
    <form action="../helpers/process_send_report.php" method="post">
     <!-- Manager Name -->
     <div class="mb-3">
      <label class="form-label" for="leave_type">Recipient</label>
      <select class="form-select text-capitalize" id="leave_type" name="id_rec" required>
       <option value="" selected disabled>Select The Recipient</option>
       <?php foreach ($employees as $employee) : ?>
        <option value="<?= $employee['id_employe'] ?>">
         <?= $employee['nom'] . ' ' . $employee['prenom'] ?>
         <?php echo $employee['role'] === 'manager' ? ' (Manager)' : '' ?>
        </option>
       <?php endforeach ?>
      </select>
     </div>
     <!-- Recipient Email -->
     <div class="mb-3">
      <label class="form-label" for="recipient_email">Recipient Email</label>
      <div class="input-group input-group-merge">
       <span class="input-group-text"><i class="bx bx-envelope"></i></span>
       <input type="email" class="form-control" id="recipient_email" name="recipient_email" placeholder="john@example.com" aria-label="john@example.com" required />
      </div>
     </div>
     <!-- Subject -->
     <div class="mb-3">
      <label class="form-label" for="subject">Subject</label>
      <div class="input-group input-group-merge">
       <span class="input-group-text"><i class="bx bx-message-square"></i></span>
       <input type="text" class="form-control" id="subject" name="report_subject" placeholder="Report Subject" required />
      </div>
     </div>
     <!-- Content -->
     <div class="mb-3">
      <label class="form-label" for="content">Content</label>
      <div class="input-group input-group-merge">
       <span class="input-group-text"><i class="bx bx-comment"></i></span>
       <textarea id="content" class="form-control" name="report_content" rows="4" placeholder="Enter report content here" required></textarea>
      </div>
     </div>
     <!-- Msg -->
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