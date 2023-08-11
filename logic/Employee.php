<?php

namespace MyApp;

use PDO;
use DateTime;
use PDOException;
use MyApp\Database;

class Employee
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }
    public function loggedInEmployee()
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM employes WHERE id_employe = :id");
            $stmt->bindParam(':id', $_SESSION['id']);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Error fetching logged-in employee: ' . $e->getMessage());
            return null;
        }
    }
    public function getUserScheduleEvents()
    {
        $user_id = $_SESSION['id'];

        $sql = "SELECT date_travail, heure_entree, heure_sortie FROM HorairesTravail WHERE id_employe = :user_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();

        $userScheduleEvents = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $date = $row['date_travail'];
            $start_time = $row['heure_entree'];
            $end_time = $row['heure_sortie'];

            $start_datetime = "$date" . "T" . "$start_time";
            $end_datetime = "$date" . "T" . "$end_time";

            $event = array(
                'title' => 'Work Schedule',
                'start' => $start_datetime,
                'end' => $end_datetime
            );

            $userScheduleEvents[] = $event;
        }

        return $userScheduleEvents;
    }
    public function getUserInfo()
    {
        try {
            $stmt = $this->conn->prepare("SELECT e.*, c.date_debut, c.date_fin, c.type_contrat, c.salaire, c.statut_emploi, c.termes_contrat FROM Employes e
            INNER JOIN Contrats c ON e.id_employe = c.id_employe
            WHERE e.id_employe = :id");
            $stmt->bindParam(':id', $_SESSION['id']);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Error fetching user info: ' . $e->getMessage());
            return null;
        }
    }
    public function getAllLeaveTypes()
    {
        try {
            $stmt = $this->conn->query("SELECT * FROM TypesConge");
            $leaveTypes = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $leaveTypes;
        } catch (PDOException $e) {
            error_log('Error fetching leave types: ' . $e->getMessage());
            return array();
        }
    }
    public function submitLeaveRequest($id_type_conge, $date_debut, $date_fin, $commentaires)
    {
        try {
            // Calculate total days
            $start = new DateTime($date_debut);
            $end = new DateTime($date_fin);
            $interval = $start->diff($end);
            $jours_totales = $interval->days + 1; // Include both start and end dates

            // Check if total days exceed limit
            if ($jours_totales > 10) {
                return 'exceed_limit'; // Return a custom error code
            }

            // Check if the user has used up their leave days for the current year
            $current_year = date('Y');
            $stmt = $this->conn->prepare("SELECT SUM(jours_totales) AS total_days FROM DemandesConge 
            WHERE id_employe = :id_employe AND YEAR(date_debut) = :current_year AND statut = :status");
            $stmt->bindParam(':id_employe', $_SESSION['id']);
            $stmt->bindParam(':current_year', $current_year);
            $status = 'accepted'; // Assign status to a variable
            $stmt->bindParam(':status', $status);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            $used_leave_days = $result['total_days'] ?? 0;
            $remaining_leave_days = 60 - $used_leave_days;

            if ($jours_totales > $remaining_leave_days) {
                return 'insufficient_leave'; // Return a custom error code
            }

            $stmt = $this->conn->prepare("INSERT INTO DemandesConge 
            (id_employe, id_type_conge, date_debut, date_fin, jours_totales, commentaires, statut)
            VALUES (:id_employe, :id_type_conge, :date_debut, :date_fin, :jours_totales, :commentaires, 'En attente')");
            $stmt->bindParam(':id_employe', $_SESSION['id']);
            $stmt->bindParam(':id_type_conge', $id_type_conge);
            $stmt->bindParam(':date_debut', $date_debut);
            $stmt->bindParam(':date_fin', $date_fin);
            $stmt->bindParam(':jours_totales', $jours_totales);
            $stmt->bindParam(':commentaires', $commentaires);
            $stmt->execute();

            return 'success'; // Return success code
        } catch (PDOException $e) {
            error_log('Error submitting leave request: ' . $e->getMessage());
            return 'error'; // Return error code
        }
    }
    public function getLeaveRequestsByEmployee()
    {
        try {
            $stmt = $this->conn->prepare("SELECT dc.id_demande_conge, dc.date_debut, dc.date_fin, dc.statut, tc.nom_type_conge,
                dc.jours_totales,dc.commentaires
                FROM DemandesConge dc
                INNER JOIN TypesConge tc ON dc.id_type_conge = tc.id_type_conge
                WHERE dc.id_employe = :employee_id
                ORDER BY dc.id_demande_conge DESC");
            $stmt->bindParam(':employee_id', $_SESSION['id']);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Error getting leave requests: ' . $e->getMessage());
            return [];
        }
    }
    public function getEmployeeDepartmentInfo()
    {
        try {
            $stmt = $this->conn->prepare("SELECT e.*, d.nom_departement AS dep, id_gestionnaire AS manager FROM employes e
            INNER JOIN departements d ON d.id_departement = e.id_departement
            WHERE id_employe = :employee_id ");
            $stmt->bindParam(':employee_id', $_SESSION['id']);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Error getting employee department info: ' . $e->getMessage());
            return null;
        }
    }
    public function getManagerBYId($id)
    {
        try {
            $stmt = $this->conn->prepare("SELECT concat(nom,' ',prenom) AS full_name, role  FROM employes
            WHERE id_employe = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Error getting employee department info: ' . $e->getMessage());
            return null;
        }
    }
    public function submitReport($id_recipient, $recipient_email, $subject, $content)
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO reports 
            (id_employe, id_recipient, recipient_email, subject, content, date_sent)
            VALUES (:id_employe, :id_recipient, :recipient_email, :subject, :content, NOW())");

            $stmt->bindParam(':id_employe', $_SESSION['id']);
            $stmt->bindParam(':id_recipient', $id_recipient);
            $stmt->bindParam(':recipient_email', $recipient_email);
            $stmt->bindParam(':subject', $subject);
            $stmt->bindParam(':content', $content);
            $stmt->execute();

            return 'success'; // Return success code
        } catch (PDOException $e) {
            error_log('Error submitting report: ' . $e->getMessage());
            return 'error' . $e->getMessage(); // Return error code
        }
    }
    public function getEmployeesByDepartment()
    {
        try {
            $id = $_SESSION['id'];
            $stmt = $this->conn->prepare("SELECT  concat(nom,' ',prenom) AS full_name , id_employe AS id,role
            FROM Employes
            WHERE id_departement = :department_id AND id_employe != $id");
            $res = $this->loggedInEmployee();
            $departmentId = $res['id_departement'];
            $stmt->bindParam(':department_id', $departmentId);
            // $stmt->bindParam(':employee_id', $_SESSION['id']);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Error fetching employees by department: ' . $e->getMessage());
            return false;
        }
    }
    public function getSendAndReceiveReport()
    {
        try {
            $user_id = $_SESSION['id'];

            // Retrieve sent reports
            $sentReports = [];
            $stmtSent = $this->conn->prepare("SELECT *
            FROM reports r
            INNER JOIN employes e ON e.id_employe = r.id_employe
            WHERE r.id_employe = :user_id
            ORDER BY r.date_sent DESC");
            $stmtSent->bindParam(':user_id', $user_id);
            $stmtSent->execute();
            $sentReports = $stmtSent->fetchAll(PDO::FETCH_ASSOC);
            // Retrieve received reports
            $receivedReports = [];
            $stmtReceived = $this->conn->prepare("SELECT *
            FROM reports r
            INNER JOIN employes e ON e.id_employe = r.id_employe
            WHERE id_recipient = :user_id
            ORDER BY r.date_sent DESC");
            $stmtReceived->bindParam(':user_id', $user_id);
            $stmtReceived->execute();
            $receivedReports = $stmtReceived->fetchAll(PDO::FETCH_ASSOC);

            return [
                'sentReports' => $sentReports,
                'receivedReports' => $receivedReports
            ];
        } catch (PDOException $e) {
            error_log('Error fetching send and receive reports: ' . $e->getMessage());
            return null;
        }
    }
    public function getReceivedReportCountToday()
    {
        try {
            $user_id = $_SESSION['id'];
            $current_date = date('Y-m-d');

            $stmt = $this->conn->prepare("SELECT COUNT(*) AS count
            FROM reports
            WHERE id_recipient = :user_id
            AND DATE(date_sent) = :current_date
        ");
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':current_date', $current_date);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['count'];
        } catch (PDOException $e) {
            error_log('Error fetching received report count for today: ' . $e->getMessage());
            return 0; // Return 0 on error
        }
    }
    public function getAllReceivedTrainings()
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM formations WHERE id_recipient = :id_employee");
            $stmt->bindParam(':id_employee', $_SESSION['id']);
            $stmt->execute();
            $trainings = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $trainings;
        } catch (PDOException $e) {
            error_log('Error fetching received trainings: ' . $e->getMessage());
            return [];
        }
    }
    public function getTrainingById($trainingId)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM formations WHERE id_formation = :id_formation");
            $stmt->bindParam(':id_formation', $trainingId);
            $stmt->execute();
            $training = $stmt->fetch(PDO::FETCH_ASSOC);
            return $training;
        } catch (PDOException $e) {
            error_log('Error fetching training by ID: ' . $e->getMessage());
            return null;
        }
    }
    public function updateEmployee($firstName, $lastName, $email, $dateOfBirth, $phoneNumber, $gender, $address)
    {
        try {
            $stmt = $this->conn->prepare("UPDATE Employes
                                     SET prenom = :prenom,
                                         nom = :nom,
                                         email = :email,
                                         date_naissance = :date_naissance,
                                         telephone = :telephone,
                                         genre = :genre,
                                         adresse = :adresse
                                     WHERE id_employe = :id_employe");

            $stmt->bindParam(':id_employe', $_SESSION['id']);
            $stmt->bindParam(':prenom', $firstName);
            $stmt->bindParam(':nom', $lastName);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':date_naissance', $dateOfBirth);
            $stmt->bindParam(':telephone', $phoneNumber);
            $stmt->bindParam(':genre', $gender);
            $stmt->bindParam(':adresse', $address);
            $stmt->execute();

            return 'success'; // Return success code
        } catch (PDOException $e) {
            error_log('Error updating employee: ' . $e->getMessage());
            return 'error' . $e->getMessage(); // Return error code
        }
    }
    public function getNotificationCount()
    {
        try {
            $user_id = $_SESSION['id'];
            $current_date = date('Y-m-d');

            $stmt = $this->conn->prepare("SELECT COUNT(*) AS count
            FROM reports
            WHERE id_recipient = :user_id
            AND DATE(date_sent) = :current_date
            ");
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':current_date', $current_date);
            $stmt->execute();

            // Formation 
            $stmt2 = $this->conn->prepare("SELECT COUNT(*) AS count
            FROM formations
            WHERE id_recipient = :user_id
            AND DATE(date_sent) = :current_date
            ");

            $stmt2->bindParam(':user_id', $user_id);
            $stmt2->bindParam(':current_date', $current_date);
            $stmt2->execute();
            $result2 = $stmt2->fetch(PDO::FETCH_ASSOC);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return [
                'report' => $result['count'],
                'formation' => $result2['count']
            ];
        } catch (PDOException $e) {
            error_log('Error fetching received report count for today: ' . $e->getMessage());
            return 0; // Return 0 on error
        }
    }
    // Dashboard
    public function getLatestFormation()
    {
        try {
            $query = "SELECT date_sent,title FROM formations
            WHERE id_recipient = :id
            ORDER BY date_sent DESC LIMIT :count";
            $count = 6;
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':count', $count, PDO::PARAM_INT);
            $stmt->bindParam(':id', $_SESSION['id']);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Error fetching employee count: ' . $e->getMessage());
            return [
                'error' => $e->getMessage()
            ];
        }
    }
    public function getLatestLeaves()
    {
        try {
            $stmt = $this->conn->prepare("SELECT dc.*, concat(e.nom,' ',e.prenom) AS full_name, nom_type_conge AS type
                                     FROM demandesconge dc
                                     INNER JOIN employes e ON dc.id_employe = e.id_employe
                                     INNER JOIN typesconge t ON t.id_type_conge = dc.id_type_conge
                                     WHERE e.id_employe = :id
                                     ORDER BY dc.date_debut LIMIT 6");
            $stmt->bindParam(':id', $_SESSION['id']);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Error getting processed leave requests: ' . $e->getMessage());
            return $e->getMessage();
        }
    }
    public function getLatestReports()
    {
        try {
            $query = "SELECT concat(e.nom,' ',e.prenom) AS full_name, r.subject , r.date_sent FROM reports r
      INNER JOIN employes e ON e.id_employe = r.id_employe
      WHERE r.id_recipient = :id
      ORDER BY r.date_sent DESC LIMIT :count ";
            $count = 6;
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':count', $count, PDO::PARAM_INT);
            $stmt->bindParam(':id', $_SESSION['id']);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Error fetching employee count: ' . $e->getMessage());
            return [
                'error' => $e->getMessage()
            ];
        }
    }

    // Clock the employee
    public function clockIn()
    {
        try {
            $employee_id = $_SESSION['id']; // Assuming you have a getId method in the Employee class
            $date = date("Y-m-d");
            $entry_time = date("H:i:s");

            // Check if a clock-in record exists for the current date
            $sql_check = "SELECT id_pointage FROM pointages WHERE id_employe = :employee_id AND date = :date";
            $stmt_check = $this->conn->prepare($sql_check);
            $stmt_check->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
            $stmt_check->bindParam(':date', $date);
            $stmt_check->execute();

            if ($stmt_check->rowCount() > 0) {
                return "already";
            }

            // Insert the clock-in data into the database
            $sql_insert = "INSERT INTO pointages (id_employe, date, heure_entree) VALUES (:employee_id, :date, :entry_time)";
            $stmt_insert = $this->conn->prepare($sql_insert);
            $stmt_insert->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
            $stmt_insert->bindParam(':date', $date);
            $stmt_insert->bindParam(':entry_time', $entry_time);
            if ($stmt_insert->execute()) {
                return "success";
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }
    public function clockOut()
    {
        $employee_id = $_SESSION['id']; // Assuming you have a getId method in the Employee class
        $date = date("Y-m-d");
        $exit_time = date("H:i:s");

        // Check if a clock-in record exists for the current date
        $sql_check = "SELECT id_pointage, heure_entree FROM Pointages WHERE id_employe = :employee_id AND date = :date";
        $stmt_check = $this->conn->prepare($sql_check);
        $stmt_check->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
        $stmt_check->bindParam(':date', $date);
        $stmt_check->execute();
        $result = $stmt_check->fetchAll(PDO::FETCH_ASSOC);
        $clockInTime = $result['heure_entree'];
        if ($stmt_check->rowCount() === 0) {
            return "check";
        } else {
            // ... Calculate hours worked based on your method ...
            $hours_worked = $this->calculateHoursWorked($clockInTime, $exit_time);
            $sql_update = "UPDATE Pointages SET heure_sortie = :exit_time, heures_totales = :hours_worked WHERE id_employe = :employee_id AND date = :date";
            $stmt_update = $this->conn->prepare($sql_update);
            $stmt_update->bindParam(':exit_time', $exit_time);
            $stmt_update->bindParam(':hours_worked', $hours_worked);
            $stmt_update->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
            $stmt_update->bindParam(':date', $date);
            if ($stmt_update->execute()) {
                return "success";
            } else {
                return "Error: " . $stmt_update->errorInfo()[2];
            }
        }
    }
    public function calculateHoursWorked($clockInTime, $clockOutTime)
    {
        $clockIn = new DateTime($clockInTime);
        $clockOut = new DateTime($clockOutTime);

        $interval = $clockOut->diff($clockIn);
        $hours = $interval->h + ($interval->i / 60) + ($interval->s / 3600);

        return $hours;
    }
    public function hasClockIn()
    {
        try {


            $employee_id = $_SESSION['id']; // Assuming you have a getId method in the Employee class
            $date = date("Y-m-d");

            $sql_check = "SELECT id_pointage FROM Pointages WHERE id_employe = :employee_id AND date = :date";
            $stmt_check = $this->conn->prepare($sql_check);
            $stmt_check->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
            $stmt_check->bindParam(':date', $date);
            $stmt_check->execute();

            return $stmt_check->rowCount() > 0 ? 'y' : 'n';
        } catch (PDOException $e) {
            return 'error' . $e->getMessage();
        }
    }
    public function hasClockOut()
    {
        try {
            $employee_id = $_SESSION['id']; // Assuming you have a getId method in the Employee class
            $date = date("Y-m-d");

            $sql_check = "SELECT id_pointage FROM Pointages WHERE id_employe = :employee_id AND date = :date";
            $stmt_check = $this->conn->prepare($sql_check);
            $stmt_check->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
            $stmt_check->bindParam(':date', $date);
            $stmt_check->execute();

            return $stmt_check->rowCount() > 0 ? 'y' : 'n';
        } catch (PDOException $e) {
            return 'error' . $e->getMessage();
        }
    }
}
