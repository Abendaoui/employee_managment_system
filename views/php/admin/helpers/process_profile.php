<?php
require_once '../layout/session_start.php';

use MyApp\Admin;

$admin = new Admin();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
 $employeeId = $_SESSION['id_employe']; // Get the employee ID from the session or any other appropriate way

 // Get form data
 $firstName = $_POST['firstName'];
 $lastName = $_POST['lastName'];
 $email = $_POST['email'];
 $jobTitle = $_POST['organization'];
 $dateHired = $_POST['hired'];
 $dateOfBirth = $_POST['birth'];
 $phone = $_POST['phone'];
 $genre = $_POST['genre'];
 $address = $_POST['zipCode'];

 // Call the update function
 $updateResult = $admin->updateEmployee($firstName, $lastName, $email, $jobTitle, $dateHired, $dateOfBirth, $phone, $genre, $address);

 if ($updateResult === 'success') {
  $msg = 'Profile updated successfully.';
  $state = true;
 } else {
  $msg = 'Error updating profile: ' . $updateResult; // Handle the error message from the function
 }
} else {
 $msg = 'Invalid request method.';
}

// Redirect back to the profile page with the appropriate message and state
header("location: ../pages/profile.php?msg=$msg&state=$state");
