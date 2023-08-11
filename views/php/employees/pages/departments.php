<?php
require '../../../../vendor/autoload.php';
require_once '../layout/session_start.php';

use MyApp\Employee;

$employee = new Employee();
$departmentInfo = $employee->getEmployeeDepartmentInfo();
$id = $departmentInfo['manager'];
$manager = $employee->getManagerBYId($id);

ob_start();
?>
<div class="container mt-4">
 <div class="row">
  <div class="col-md-6 offset-md-3">
   <div class="card">
    <div class="card-header">
     <h5 class="mb-0">Employee Department</h5>
    </div>
    <div class="card-body">
     <div class="mb-3">
      <label class="form-label">Department:</label>
      <input type="text" class="form-control" value="<?= $departmentInfo['dep'] ?>" readonly>
     </div>
     <div class="mb-3">
      <label class="form-label">Manager:</label>
      <input type="text" class="form-control text-capitalize" value="<?= $manager['full_name'] ?>" readonly>
     </div>
     <div class="mb-3">
      <label class="form-label">Email:</label>
      <input type="email" class="form-control" value="<?= $departmentInfo['email'] ?>" readonly>
     </div>
     <!-- Add more employee information fields here if needed -->
    </div>
   </div>
  </div>
 </div>
</div>
<?php
$pageContent = ob_get_clean();
$pageTitle = 'Your Department';
require_once '../layout/index.php';
?>