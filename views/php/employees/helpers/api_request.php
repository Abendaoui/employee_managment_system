<?php
// api_request.php

use MyApp\Employee;

require_once '../../../../vendor/autoload.php';
require_once '../layout/session_start.php';

$employee = new Employee();

$result = $employee->getOriginalWorkedHour();

// Return the result as JSON
header('Content-Type: application/json');
echo json_encode($result);
