# use the composer dep

use Cocur\Slugify\Slugify;

# Js Bootstrap Files

<!-- Add Bootstrap CSS -->
<link href="node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Add Bootstrap JavaScript (popper.js is a dependency for some Bootstrap components) -->
<script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

# Trigger

DELIMITER //
CREATE TRIGGER trg_delete_previous_month_schedules
AFTER INSERT ON work_schedules
FOR EACH ROW
BEGIN
-- Get the month and year of the newly inserted work schedule
DECLARE new_month INT;
DECLARE new_year INT;
SET new_month = MONTH(NEW.shift_date);
SET new_year = YEAR(NEW.shift_date);

    -- Delete previous month's work schedules for the same employee
    DELETE FROM work_schedules
    WHERE employee_id = NEW.employee_id
    AND YEAR(shift_date) = new_year
    AND MONTH(shift_date) = new_month - 1;

END;
//
DELIMITER ;

# PHP Code For Add Work Schudle For Full Month

// Assume you have a function to connect to the database.
$conn = connectToDatabase();

// Example data for assigning work schedules to an employee for a full month.
$employeeId = 1; // ID of the employee from the 'employees' table.
$month = 7; // Month for which work schedules are being assigned.
$year = 2023; // Year for which work schedules are being assigned.

// Function to get the number of days in a given month and year.
function getDaysInMonth($month, $year) {
return cal_days_in_month(CAL_GREGORIAN, $month, $year);
}

// Loop through each day of the month and insert the work schedule into the 'work_schedules' table.
for ($day = 1; $day <= getDaysInMonth($month, $year); $day++) {
    $shiftDate = "$year-$month-$day"; // Date of the shift (e.g., 2023-07-01, 2023-07-02, ...).
$shiftStartTime = '09:00:00'; // Start time of the shift.
$shiftEndTime = '17:00:00'; // End time of the shift.

    // Insert the work schedule into the 'work_schedules' table.
    $sql = "INSERT INTO work_schedules (employee_id, shift_date, shift_start_time, shift_end_time)
            VALUES ($employeeId, '$shiftDate', '$shiftStartTime', '$shiftEndTime')";

    if (mysqli_query($conn, $sql)) {
        echo "Work schedule for $shiftDate assigned successfully.<br>";
    } else {
        echo "Error assigning work schedule for $shiftDate: " . mysqli_error($conn) . "<br>";
    }

}

# Code To Get Dispaly Of Monthly Work Schedule

<!-- monthly_work_schedule.php -->
<?php
// Assume you have a function to connect to the database and a function to get the list of employees.
$conn = connectToDatabase();

// Function to get the list of employees from the database.
function getEmployees()
{
    // Fetch the list of employees from the database.
    $sql = "SELECT id, name FROM employees";
    $result = mysqli_query($conn, $sql);

    $employees = array();

    // Store the employees in an array.
    while ($row = mysqli_fetch_assoc($result)) {
        $employees[$row['id']] = $row['name'];
    }

    return $employees;
}

// Function to get the monthly work schedule for a specific employee from the database.
function getMonthlyWorkSchedule($employeeId, $month, $year)
{
    // Fetch the work schedule for the selected month and employee from the database.
    $sql = "SELECT shift_date, shift_start_time, shift_end_time FROM work_schedules
            WHERE employee_id = $employeeId
            AND MONTH(shift_date) = $month
            AND YEAR(shift_date) = $year
            ORDER BY shift_date ASC";

    $result = mysqli_query($conn, $sql);

    $workSchedule = array();

    // Store the work schedule in an array.
    while ($row = mysqli_fetch_assoc($result)) {
        $workSchedule[$row['shift_date']] = array(
            'start_time' => $row['shift_start_time'],
            'end_time' => $row['shift_end_time']
        );
    }

    return $workSchedule;
}

// Check if the employee ID is provided in the URL.
if (isset($_GET['employee_id'])) {
    $selectedEmployeeId = $_GET['employee_id'];

    // Get the current month and year.
    $currentMonth = date('m');
    $currentYear = date('Y');

    // Get the list of employees and the monthly work schedule for the selected employee.
    $employees = getEmployees();
    $monthlyWorkSchedule = getMonthlyWorkSchedule($selectedEmployeeId, $currentMonth, $currentYear);
}
?>

<!-- Display the work schedule for the selected month and allow switching between employees. -->
<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Work Schedule for <?= date('F Y') ?></h5>
                <small class="text-muted float-end">Monthly Schedule</small>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <!-- Employee List -->
                        <div class="list-group mb-4">
                            <?php foreach ($employees as $id => $name) { ?>
                                <a href="?employee_id=<?= $id ?>" class="list-group-item list-group-item-action <?= $selectedEmployeeId == $id ? 'active' : '' ?>"><?= $name ?></a>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <!-- Calendar View -->
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sun</th>
                                    <th>Mon</th>
                                    <th>Tue</th>
                                    <th>Wed</th>
                                    <th>Thu</th>
                                    <th>Fri</th>
                                    <th>Sat</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);
                                $firstDayOfMonth = date('N', strtotime(date('Y-m-01')));
                                $dayCount = 1;
                                $currentDayOfWeek = 1;

                                while ($dayCount <= $daysInMonth) {
                                    echo '<tr>';

                                    for ($dayOfWeek = 1; $dayOfWeek <= 7; $dayOfWeek++) {
                                        echo '<td>';
                                        if ($dayCount <= $daysInMonth && ($dayOfWeek >= $firstDayOfMonth || $currentDayOfWeek > 1)) {
                                            $currentDate = "$currentYear-$currentMonth-" . str_pad($dayCount, 2, '0', STR_PAD_LEFT);
                                            $shiftData = isset($monthlyWorkSchedule[$currentDate]) ? $monthlyWorkSchedule[$currentDate] : null;

                                            if ($shiftData) {
                                                echo '<strong>' . $dayCount . '</strong><br>';
                                                echo 'Start Time: ' . $shiftData['start_time'] . '<br>';
                                                echo 'End Time: ' . $shiftData['end_time'];
                                            } else {
                                                echo $dayCount;
                                            }

                                            $dayCount++;
                                        }
                                        echo '</td>';
                                        $currentDayOfWeek++;
                                    }

                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <!-- Save and Publish Buttons -->
                        <button type="button" class="btn btn-primary">Save Draft</button>
                        <button type="button" class="btn btn-success">Publish Schedule</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

# Calender

// Replace these credentials with your actual database connection details
$servername = "your_database_servername";
$username = "your_database_username";
$password = "your_database_password";
$dbname = "your_database_name";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

// Assuming you have the user ID in $user_id variable
$user_id = 1; // Replace with the actual user ID
$sql = "SELECT date_travail, heure_entree, heure_sortie FROM HorairesTravail WHERE id_employe = $user_id";
$result = $conn->query($sql);

$userScheduleEvents = array();

if ($result->num_rows > 0) {
    // Loop through the rows and fetch the required data
    while ($row = $result->fetch_assoc()) {
$date = $row['date_travail'];
$start_time = $row['heure_entree'];
$end_time = $row['heure_sortie'];

        // Format the date and time as required by FullCalendar
        $start_datetime = "$date" . "T" . "$start_time";
        $end_datetime = "$date" . "T" . "$end_time";

        // Create an event object and add it to the $userScheduleEvents array
        $event = array(
            'title' => 'Work Schedule',
            'start' => $start_datetime,
            'end' => $end_datetime
        );

        $userScheduleEvents[] = $event;
    }

}

// Close the database connection
$conn->close();

<!-- Add your custom JavaScript if needed -->
<script>
    // Add your custom scripts here
    document.addEventListener('DOMContentLoaded', function() {
        var userScheduleEvents = <?php echo json_encode($userScheduleEvents); ?>;

        // Initialize FullCalendar
        $('#calendar').fullCalendar({
            events: userScheduleEvents,
            defaultView: 'agendaWeek', // Set the default view to 'agendaWeek'
            // ... (rest of the FullCalendar options and customization)
        });
    });
</script>
