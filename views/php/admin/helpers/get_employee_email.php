<?php
function getEmployeeEmailById($employeeId)
{

 $conn = new PDO('mysql:host=localhost;dbname=employee_management_system;charset=utf8', 'root', '');

 $stmt = $conn->prepare("SELECT email FROM Employes WHERE id_employe = :employeeId");
 $stmt->bindParam(':employeeId', $employeeId, PDO::PARAM_INT);
 $stmt->execute();

 $result = $stmt->fetch(PDO::FETCH_ASSOC);
 if ($result) {
  return $result['email'];
 } else {
  return false; // Employee not found or email field is empty.
 }
}

// Check if the request was sent via POST and contains the 'id' parameter
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
 $employeeId = $_POST['id'];
 $email = getEmployeeEmailById($employeeId);

 if ($email) {
  // Return the email as a JSON response
  echo json_encode(['success' => true, 'email' => $email]);
 } else {
  // If the employee is not found or email is empty, return an error
  echo json_encode(['success' => false, 'error' => 'Employee not found or email is empty.']);
 }
} else {
 // If the request method is not POST or 'id' parameter is missing, return an error
 echo json_encode(['success' => false, 'error' => 'Invalid request.']);
}
