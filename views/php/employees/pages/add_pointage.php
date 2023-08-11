<?php
ob_start();
?>
<?php
// employee_interface.php

// Database connection (Replace with your actual credentials)
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database";

// Check if the Clock In button is clicked
if (isset($_POST["clock_in"])) {
 $employee_id = 123; // Replace with the actual employee ID (you can get this from your authentication system)
 $date = date("Y-m-d");
 $entry_time = date("H:i:s");

 // Insert the data into the database (you should have a table to store the clock-in data)
 $conn = new mysqli($servername, $username, $password, $dbname);
 if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
 }

 $sql = "INSERT INTO employee_clock_in (employee_id, date, entry_time) VALUES ($employee_id, '$date', '$entry_time')";
 if ($conn->query($sql) === TRUE) {
  // Success message or any other action you want after clock-in
  echo "Clock In successful";
 } else {
  // Error message or error handling
  echo "Error: " . $sql . "<br>" . $conn->error;
 }

 $conn->close();
}

// Check if the Clock Out button is clicked
if (isset($_POST["clock_out"])) {
 $employee_id = 123; // Replace with the actual employee ID (you can get this from your authentication system)
 $exit_time = date("H:i:s");

 // Update the clock-out data in the database (you should have a table to store the clock-out data)
 $conn = new mysqli($servername, $username, $password, $dbname);
 if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
 }

 $sql = "UPDATE employee_clock_in SET exit_time='$exit_time' WHERE employee_id=$employee_id AND date=CURDATE()";
 if ($conn->query($sql) === TRUE) {
  // Success message or any other action you want after clock-out
  echo "Clock Out successful";
 } else {
  // Error message or error handling
  echo "Error: " . $sql . "<br>" . $conn->error;
 }

 $conn->close();
}
?>


 <div class="container mt-4">
  <h3>Welcome, Employee Name!</h3>
  <div class="mb-3">
   <form method="post">
    <button type="submit" name="clock_in" class="btn btn-primary">Clock In</button>
   </form>
  </div>
  <div>
   <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <button type="submit" name="clock_out" class="btn btn-danger">Clock Out</button>
   </form>
  </div>
 </div>


<?php
$pageContent = ob_get_clean();
$pageTitle = 'Your Department';
require_once '../layout/index.php';
?>