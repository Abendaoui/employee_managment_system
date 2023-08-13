<?php

namespace MyApp;

use Cocur\Slugify\Slugify;
use PDO;
use DateTime;
use PDOException;
use MyApp\Database;

class Admin
{
  private $conn;

  public function __construct()
  {
    $db = new Database();
    $this->conn = $db->getConnection();
  }
  // Profile Page
  public function getManagerAndDepById()
  {
    try {
      $stmt = $this->conn->prepare("SELECT *  FROM employes e
            INNER JOIN departements d ON e.id_departement = d.id_departement
            WHERE id_employe = :id");
      $stmt->bindParam(':id', $_SESSION['id']);
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log('Error getting employee department info: ' . $e->getMessage());
      return null;
    }
  }
  // Manager Page
  public function getDepartmentsWithoutManagers()
  {
    try {
      $stmt = $this->conn->prepare("SELECT d.id_departement, d.nom_departement
                                     FROM departements d
                                     LEFT JOIN employes e ON d.id_departement = e.id_departement
                                     WHERE e.role IS NULL");
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log('Error getting departments without managers: ' . $e->getMessage());
      return false;
    }
  }
  public function getAllManagersWithDepartments()
  {
    try {
      $stmt = $this->conn->prepare("SELECT *
                                 FROM employes e
                                 INNER JOIN departements d ON e.id_departement = d.id_departement
                                 WHERE e.role = :role AND e.id_employe != :id
                                 ");
      $stmt->bindParam(':role', $_SESSION['role']);
      $stmt->bindParam(':id', $_SESSION['id']);

      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log('Error fetching managers with departments: ' . $e->getMessage());
      return [];
    }
  }
  public function createAuthCredentials($username, $email, $password)
  {
    try {
      // Hash the password
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

      // Insert credentials into the Authentification table
      $stmt = $this->conn->prepare("INSERT INTO Authentification (nom_utilisateur, email, mot_de_passe) VALUES (:username, :email, :password)");
      $stmt->bindParam(':username', $username);
      $stmt->bindParam(':email', $email);
      $stmt->bindParam(':password', $hashedPassword);
      $stmt->execute();
      return [
        'username' => $username,
        'password' => $password
      ];
    } catch (PDOException $e) {
      return 'Error creating auth credentials' . $e->getMessage();
    }
  }
  public function addManager($prenom, $nom, $email, $titre_poste, $id_departement, $role, $date_embauché, $date_naissance, $telephone, $genre, $profile, $adresse)
  {
    // Check if the email already exists
    $existingEmployee = $this->getEmployeeByEmail($email);
    if ($existingEmployee) {
      return 'email_exists';
    }

    //Upload Image
    $uploadResult = $this->uploadImage($profile);
    if (!$uploadResult) {
      return 'Failed to upload';
    }

    // Insert into database
    try {
      $stmt = $this->conn->prepare("INSERT INTO employes (prenom, nom, email, titre_poste, id_departement, id_gestionnaire, role, slug, date_embauché, date_naissance, telephone, genre, profile, adresse)
                                     VALUES (:prenom, :nom, :email, :titre_poste, :id_departement, NULL, :role, :slug, :date_embauche, :date_naissance, :telephone, :genre, :profile, :adresse)");

      // Generate a unique slug based on name
      $slug = $this->generateSlug($prenom, $nom);
      $uploadResult = '64d1bddce1cd6';
      $stmt->bindParam(':prenom', $prenom);
      $stmt->bindParam(':nom', $nom);
      $stmt->bindParam(':email', $email);
      $stmt->bindParam(':titre_poste', $titre_poste);
      $stmt->bindParam(':id_departement', $id_departement);
      $stmt->bindParam(':role', $role);
      $stmt->bindParam(':slug', $slug);
      $stmt->bindParam(':date_embauche', $date_embauché); // Corrected parameter name
      $stmt->bindParam(':date_naissance', $date_naissance);
      $stmt->bindParam(':telephone', $telephone);
      $stmt->bindParam(':genre', $genre);
      $stmt->bindParam(':profile', $uploadResult);
      $stmt->bindParam(':adresse', $adresse);

      $stmt->execute();

      return 'success';
    } catch (PDOException $e) {
      return 'Error adding manager ';
    }
  }
  // Upload image and return result
  private function uploadImage($file)
  {
    $image = uniqid();
    $image_tmp_name = $file['tmp_name'];
    $image_folder = '../../../../assets/img/avatars/' . $image . '.png';
    if (move_uploaded_file($image_tmp_name, $image_folder)) {
      return $image;
    }
    return false;
  }
  // Get employee by email
  private function getEmployeeByEmail($email)
  {
    try {
      $stmt = $this->conn->prepare("SELECT * FROM Employes WHERE email = :email");
      $stmt->bindParam(':email', $email);
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log('Error getting employee by email: ' . $e->getMessage());
      return false;
    }
  }
  // Generate slug based on name
  private function generateSlug($prenom, $nom)
  {
    $slug = strtolower($prenom . '-' . $nom);
    // Remove any non-alphanumeric characters
    $slug = preg_replace('/[^a-z0-9\-]/', '', $slug);
    return $slug;
  }
  // Delete 
  public function deleteEmployee($employeeId)
  {
    try {
      $stmt = $this->conn->prepare("DELETE FROM employes WHERE id_employe = :employeeId");
      $stmt->bindParam(':employeeId', $employeeId, PDO::PARAM_INT);
      $stmt->execute();

      // Check if any rows were affected by the delete operation
      if ($stmt->rowCount() > 0) {
        return 'deleted'; // Employee deleted successfully
      } else {
        return 'Not Found'; // No employee found with the given ID
      }
    } catch (PDOException $e) {
      error_log('Error deleting employee: ' . $e->getMessage());
      return 'Error deleting employee: ' . $e->getMessage(); // Error occurred while deleting employee
    }
  }
  // Update
  // Get employee
  public function getEmployeeBySlug($slug)
  {
    try {
      $stmt = $this->conn->prepare("SELECT * FROM employes e
      INNER JOIN departements d ON d.id_departement = e.id_departement
      WHERE slug = :slug");
      $stmt->bindParam(':slug', $slug, PDO::PARAM_STR);
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log('Error getting employee by slug: ' . $e->getMessage());
      return false;
    }
  }
  // Edit employee
  public function updateEmployee($firstName, $lastName, $email, $position, $dateOfHired, $dateOfBirth, $phoneNumber, $gender, $address)
  {
    try {
      $stmt = $this->conn->prepare("UPDATE Employes
                                     SET prenom = :prenom,
                                         nom = :nom,
                                         email = :email,
                                         titre_poste = :titre_poste,
                                         date_naissance = :date_naissance,
                                         date_embauché = :hired,
                                         telephone = :telephone,
                                         genre = :genre,
                                         adresse = :adresse
                                     WHERE id_employe = :id_employe");

      $stmt->bindParam(':id_employe', $_SESSION['id']);
      $stmt->bindParam(':prenom', $firstName);
      $stmt->bindParam(':nom', $lastName);
      $stmt->bindParam(':email', $email);
      $stmt->bindParam(':titre_poste', $position);
      $stmt->bindParam(':date_naissance', $dateOfBirth);
      $stmt->bindParam(':hired', $dateOfHired);
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
  // Employee Page
  public function getAllEmployeessWithDepartments()
  {
    try {
      $stmt = $this->conn->prepare("SELECT *
                                 FROM employes e
                                 INNER JOIN departements d ON e.id_departement = d.id_departement
                                 WHERE e.role != :role AND e.id_departement = :dep");
      $stmt->bindParam(':role', $_SESSION['role']);
      $stmt->bindParam(':dep', $_SESSION['id_dep']);

      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log('Error fetching managers with departments: ' . $e->getMessage());
      return [];
    }
  }
  public function generateRandomPassword($length = 8)
  {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $password = '';

    for ($i = 0; $i < $length; $i++) {
      $index = mt_rand(0, strlen($characters) - 1);
      $password .= $characters[$index];
    }

    return $password;
  }
  function generateUsername($firstName, $lastName)
  {
    $firstName = strtolower($firstName);
    $lastName = strtolower($lastName);

    // Remove spaces and special characters from names
    $firstName = preg_replace('/[^a-zA-Z0-9]/', '', $firstName);
    $lastName = preg_replace('/[^a-zA-Z0-9]/', '', $lastName);

    // Generate a unique username based on the first name and last name
    $username = $firstName . '_' . $lastName;

    // Check if the generated username already exists in the database
    // If it does, you can add a unique identifier to the username

    return $username;
  }

  public function addEmployee($prenom, $nom, $email, $titre_poste, $role, $date_embauché, $date_naissance, $telephone, $genre, $profile, $adresse)
  {
    // Check if the email already exists
    $existingEmployee = $this->getEmployeeByEmail($email);
    if ($existingEmployee) {
      return 'email_exists';
    }

    //Upload Image
    $uploadResult = $this->uploadImage($profile);
    if (!$uploadResult) {
      return 'Failed to upload';
    }

    // Insert into database
    try {
      $stmt = $this->conn->prepare("INSERT INTO employes (prenom, nom, email, titre_poste, id_departement, id_gestionnaire, role, slug, date_embauché, date_naissance, telephone, genre, profile, adresse)
                                     VALUES (:prenom, :nom, :email, :titre_poste, :id_departement, :manager, :role, :slug, :date_embauche, :date_naissance, :telephone, :genre, :profile, :adresse)");

      // Generate a unique slug based on name
      $slug = $this->generateSlug($prenom, $nom);
      $stmt->bindParam(':prenom', $prenom);
      $stmt->bindParam(':nom', $nom);
      $stmt->bindParam(':email', $email);
      $stmt->bindParam(':titre_poste', $titre_poste);
      $stmt->bindParam(':id_departement', $_SESSION['id_dep']);
      $stmt->bindParam(':manager', $_SESSION['id']);
      $stmt->bindParam(':role', $role);
      $stmt->bindParam(':slug', $slug);
      $stmt->bindParam(':date_embauche', $date_embauché); // Corrected parameter name
      $stmt->bindParam(':date_naissance', $date_naissance);
      $stmt->bindParam(':telephone', $telephone);
      $stmt->bindParam(':genre', $genre);
      $stmt->bindParam(':profile', $uploadResult);
      $stmt->bindParam(':adresse', $adresse);

      $stmt->execute();

      return 'success';
    } catch (PDOException $e) {
      return 'Error adding manager ';
    }
  }
  // Schudle Page
  public function addWorkSchedule($employeeId, $shiftStartTime, $shiftEndTime, $startDate)
  {
    try {
      $endDate = date('Y-m-t', strtotime($startDate)); // End of the current month

      // Delete previous month's records for the employee
      $prevMonthStartDate = date('Y-m-01', strtotime($startDate . ' -1 month'));
      $prevMonthEndDate = date('Y-m-t', strtotime($prevMonthStartDate));

      $deleteStmt = $this->conn->prepare("DELETE FROM HorairesTravail WHERE id_employe = :id_employe AND date_travail BETWEEN :prev_start_date AND :prev_end_date");
      $deleteStmt->bindParam(':id_employe', $employeeId);
      $deleteStmt->bindParam(':prev_start_date', $prevMonthStartDate);
      $deleteStmt->bindParam(':prev_end_date', $prevMonthEndDate);
      $deleteStmt->execute();

      // Insert new records for the current month
      $insertStmt = $this->conn->prepare("INSERT INTO HorairesTravail (id_employe, date_travail, heure_entree, heure_sortie)
                                 VALUES (:id_employe, :date_travail, :heure_entree, :heure_sortie)");

      $insertStmt->bindParam(':id_employe', $employeeId);
      $insertStmt->bindParam(':heure_entree', $shiftStartTime);
      $insertStmt->bindParam(':heure_sortie', $shiftEndTime);

      $currentDate = $startDate;
      while ($currentDate <= $endDate) {
        // Skip Saturdays (6) and Sundays (0)
        $dayOfWeek = date('w', strtotime($currentDate));
        if ($dayOfWeek !== '0' && $dayOfWeek !== '6') {
          $insertStmt->bindParam(':date_travail', $currentDate);
          $insertStmt->execute();
        }

        // Move to the next day
        $currentDate = date('Y-m-d', strtotime($currentDate . ' + 1 day'));
      }

      return 'success'; // Return success code
    } catch (PDOException $e) {
      error_log('Error adding work schedule: ' . $e->getMessage());
      return 'error' . $e->getMessage(); // Return error code
    }
  }

  public function getEmployeeWorkSchedule($employeeSlug)
  {
    try {
      $stmt = $this->conn->prepare("SELECT * FROM horairestravail h
                                     INNER JOIN employes e ON e.id_employe = h.id_employe
                                     WHERE slug = :employee_name AND date_travail >= CURDATE()");
      $stmt->bindParam(':employee_name', $employeeSlug);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log('Error getting work schedule: ' . $e->getMessage());
      return false;
    }
  }
  // Leave Management Page
  public function getPendingLeaveRequests()
  {
    try {
      $stmt = $this->conn->prepare("SELECT dc.*, concat(e.nom,' ',e.prenom) AS full_name, nom_type_conge AS type
                                     FROM demandesconge dc
                                     INNER JOIN employes e ON dc.id_employe = e.id_employe
                                     INNER JOIN typesconge t ON t.id_type_conge = dc.id_type_conge
                                     WHERE dc.statut = 'En attente'
                                     AND e.id_gestionnaire = :manager_id");
      $stmt->bindParam(':manager_id', $_SESSION['id']);
      $stmt->execute();
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $results;
    } catch (PDOException $e) {
      error_log('Error getting processed leave requests: ' . $e->getMessage());
      return false;
    }
  }
  public function getProcessedLeaveRequests()
  {
    try {
      $stmt = $this->conn->prepare("SELECT dc.*, concat(e.nom,' ',e.prenom) AS full_name, nom_type_conge AS type
                                     FROM demandesconge dc
                                     INNER JOIN employes e ON dc.id_employe = e.id_employe
                                     INNER JOIN typesconge t ON t.id_type_conge = dc.id_type_conge
                                     WHERE dc.statut <> 'En attente'
                                     AND e.id_gestionnaire = :manager_id");
      $stmt->bindParam(':manager_id', $_SESSION['id']);
      $stmt->execute();
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $results;
    } catch (PDOException $e) {
      error_log('Error getting processed leave requests: ' . $e->getMessage());
      return false;
    }
  }
  public function getDemandeCongeById($id_demande_conge)
  {
    try {
      $stmt = $this->conn->prepare("SELECT d.*, concat(e.nom,' ',e.prenom) AS name,nom_type_conge AS type  FROM demandesConge d
   INNER JOIN employes e ON e.id_employe = d.id_employe
   INNER JOIN typesconge t ON t.id_type_conge = t.id_type_conge
   WHERE id_demande_conge = :id_demande_conge");
      $stmt->bindParam(':id_demande_conge', $id_demande_conge, PDO::PARAM_INT);
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log('Error getting demand conge by ID: ' . $e->getMessage());
      return false;
    }
  }
  public function updateDemandeCongeStatus($id_demande_conge, $new_status)
  {
    try {
      $stmt = $this->conn->prepare("UPDATE demandesConge SET statut = :new_status WHERE id_demande_conge = :id_demande_conge");
      $stmt->bindParam(':new_status', $new_status, PDO::PARAM_STR);
      $stmt->bindParam(':id_demande_conge', $id_demande_conge, PDO::PARAM_INT);
      $stmt->execute();
      return true;
    } catch (PDOException $e) {
      error_log('Error updating demand conge status: ' . $e->getMessage());
      return false;
    }
  }
  // Department Page
  public function addDepartment($departmentName)
  {
    try {
      $stmt = $this->conn->prepare("INSERT INTO Departements (nom_departement) VALUES (:nom_departement)");
      $stmt->bindParam(':nom_departement', $departmentName);
      $stmt->execute();

      return true; // Return success code
    } catch (PDOException $e) {
      error_log('Error adding department: ' . $e->getMessage());
      return 'error'; // Return error code
    }
  }
  public function getDepartmentsWithManagers()
  {
    try {
      $stmt = $this->conn->prepare("SELECT D.id_departement AS id, 
                                          D.nom_departement AS name,
                                          CASE WHEN M.role = 'manager' THEN CONCAT(M.prenom, ' ', M.nom) ELSE NULL END AS manager
                                     FROM Departements D
                                     LEFT JOIN Employes M ON D.id_departement = M.id_departement AND M.role = 'manager'");
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log('Error getting departments with managers: ' . $e->getMessage());
      return false;
    }
  }
  public function deleteDep($id)
  {
    try {
      $stmt = $this->conn->prepare("DELETE FROM departements WHERE id_departement = :id");
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      $stmt->execute();

      // Check if any rows were affected by the delete operation
      if ($stmt->rowCount() > 0) {
        return 'deleted'; // Employee deleted successfully
      } else {
        return 'Not Found'; // No employee found with the given ID
      }
    } catch (PDOException $e) {
      error_log('Error deleting employee: ' . $e->getMessage());
      return 'Error deleting employee: ' . $e->getMessage(); // Error occurred while deleting employee
    }
  }
  public function getDepartmentById($id)
  {
    try {
      $stmt = $this->conn->prepare("SELECT * FROM departements WHERE id_departement = :id");
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      $stmt->execute();

      return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log('Error fetching department: ' . $e->getMessage());
      return null;
    }
  }
  public function editDepartment($id, $newDepartmentName)
  {
    try {
      $stmt = $this->conn->prepare("UPDATE departements SET nom_departement = :new_name WHERE id_departement = :id");
      $stmt->bindParam(':new_name', $newDepartmentName, PDO::PARAM_STR);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      $stmt->execute();

      // Check if any rows were affected by the update operation
      if ($stmt->rowCount() > 0) {
        return 'updated'; // Department updated successfully
      } else {
        return 'Not Found'; // No department found with the given ID
      }
    } catch (PDOException $e) {
      error_log('Error updating department: ' . $e->getMessage());
      return 'Error updating department: ' . $e->getMessage(); // Error occurred while updating department
    }
  }

  // Formation Page
  public function addFormation($title, $description, $startDate, $endDate, $recipientIds)
  {
    try {
      // Insert formation details into the table
      $stmt = $this->conn->prepare("INSERT INTO formations (title, description, date_start, date_end, id_sender,   id_recipient,status, date_sent)
                          VALUES (:title, :description, :date_start, :date_end, :id_sender,:id_recipient, 'pending', NOW())");
      $stmt->bindParam(':title', $title);
      $stmt->bindParam(':description', $description);
      $stmt->bindParam(':date_start', $startDate);
      $stmt->bindParam(':date_end', $endDate);
      $stmt->bindParam(':id_sender', $_SESSION['id']);
      // Insert recipient IDs into the relation table
      foreach ($recipientIds as $id) {
        $stmt->bindParam(':id_recipient', $id);
        $stmt->execute();
      }

      return true;
    } catch (PDOException $e) {
      error_log('Error adding formation: ' . $e->getMessage());
      return false;
    }
  }
  public function getAllFormations()
  {
    try {
      $stmt = $this->conn->prepare("SELECT f.id_formation, f.title, f.description, f.date_start, f.date_end, f.status , f.date_sent
                                 FROM formations f
                                 INNER JOIN (
                                   SELECT MAX(id_formation) AS max_id_formation
                                   FROM formations
                                   WHERE id_sender = :id_manager
                                   GROUP BY title
                                 ) AS subquery
                                 ON f.id_formation = subquery.max_id_formation 
                                 ORDER BY f.id_formation DESC");
      $stmt->bindParam(':id_manager', $_SESSION['id']);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log('Error getting formations: ' . $e->getMessage());
      return false;
    }
  }
  public function getFormationById($trainingId)
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
  // Contract Page
  public function getAllContracts()
  {
    try {
      $stmt = $this->conn->prepare("SELECT concat(e.nom,' ',e.prenom) AS full_name, c.*
                                      FROM contrats c
                                      JOIN employes e ON c.id_employe = e.id_employe
                                      WHERE e.role <> :role");
      $stmt->bindParam(':role', $_SESSION['role']);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log('Error getting all contracts: ' . $e->getMessage());
      return [];
    }
  }
  public function getContractById($contractId)
  {
    try {
      $stmt = $this->conn->prepare("SELECT * FROM contrats c
      INNER JOIN employes e ON e.id_employe = c.id_employe
      WHERE id_contrat = :contractId");
      $stmt->bindParam(':contractId', $contractId, PDO::PARAM_INT);
      $stmt->execute();

      return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log('Error getting contract by ID: ' . $e->getMessage());
      return false;
    }
  }
  public function deleteContrat($id)
  {
    try {
      $stmt = $this->conn->prepare("DELETE FROM contrats WHERE id_contrat = :id");
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      $stmt->execute();

      // Check if any rows were affected by the delete operation
      if ($stmt->rowCount() > 0) {
        return 'deleted'; // Employee deleted successfully
      } else {
        return 'Not Found'; // No employee found with the given ID
      }
    } catch (PDOException $e) {
      error_log('Error deleting employee: ' . $e->getMessage());
      return 'Error deleting employee: ' . $e->getMessage(); // Error occurred while deleting employee
    }
  }
  public function addContract($id_employe, $date_debut, $date_fin, $type_contrat, $salaire, $statut_emploi, $termes_contrat)
  {
    try {
      $stmt = $this->conn->prepare("INSERT INTO contrats (id_employe, date_debut, date_fin, type_contrat, salaire, statut_emploi, termes_contrat) 
                                     VALUES (:id_employe, :date_debut, :date_fin, :type_contrat, :salaire, :statut_emploi, :termes_contrat)");
      $stmt->bindParam(':id_employe', $id_employe, PDO::PARAM_INT);
      $stmt->bindParam(':date_debut', $date_debut);
      $stmt->bindParam(':date_fin', $date_fin);
      $stmt->bindParam(':type_contrat', $type_contrat);
      $stmt->bindParam(':salaire', $salaire);
      $stmt->bindParam(':statut_emploi', $statut_emploi);
      $stmt->bindParam(':termes_contrat', $termes_contrat);

      $stmt->execute();

      return true;
    } catch (PDOException $e) {
      error_log('Error adding contract: ' . $e->getMessage());
      return false;
    }
  }
  public function getEmployeesWithoutContract()
  {
    try {
      $stmt = $this->conn->prepare("SELECT e.id_employe AS id, concat(e.prenom,' ',e.nom)  AS full_name
                                     FROM Employes e
                                     LEFT JOIN Contrats c ON e.id_employe = c.id_employe
                                     WHERE c.id_contrat IS NULL AND e.id_gestionnaire = :managerId");
      $stmt->bindParam(':managerId', $_SESSION['id'], PDO::PARAM_INT);
      $stmt->execute();

      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log('Error getting employees without contract: ' . $e->getMessage());
      return false;
    }
  }
  public function updateContract($id, $date_debut, $date_fin, $type_contrat, $salaire, $statut_emploi, $termes_contrat)
  {
    try {
      $stmt = $this->conn->prepare("UPDATE Contrats
                                     SET date_debut = :date_debut,
                                         date_fin = :date_fin,
                                         type_contrat = :type_contrat,
                                         salaire = :salaire,
                                         statut_emploi = :statut_emploi,
                                         termes_contrat = :termes_contrat
                                     WHERE id_contrat = :id");

      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      $stmt->bindParam(':date_debut', $date_debut);
      $stmt->bindParam(':date_fin', $date_fin);
      $stmt->bindParam(':type_contrat', $type_contrat);
      $stmt->bindParam(':salaire', $salaire);
      $stmt->bindParam(':statut_emploi', $statut_emploi);
      $stmt->bindParam(':termes_contrat', $termes_contrat);

      $stmt->execute();

      if ($stmt->rowCount() > 0) {
        return 'updated'; // Contract updated successfully
      } else {
        return 'Not Found'; // No contract found with the given ID
      }
    } catch (PDOException $e) {
      error_log('Error updating contract: ' . $e->getMessage());
      return 'Error updating contract: ' . $e->getMessage(); // Error occurred while updating contract
    }
  }
  // Report Pages
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
      return 'error'; // Return error code
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
  // Dashboard
  public function getStatic()
  {
    try {
      $employeeRole = 'employé';
      $managerRole = 'manager';

      // Employee count
      $stmt1 = $this->conn->prepare("SELECT COUNT(*) AS count FROM employes WHERE role = :role");
      $stmt1->bindParam(':role', $employeeRole);
      $stmt1->execute();
      $result1 = $stmt1->fetch(PDO::FETCH_ASSOC);

      // Manager count
      $stmt2 = $this->conn->prepare("SELECT COUNT(*) AS count FROM employes WHERE role = :role");
      $stmt2->bindParam(':role', $managerRole);
      $stmt2->execute();
      $result2 = $stmt2->fetch(PDO::FETCH_ASSOC);

      // Department
      $stmt3 = $this->conn->query("SELECT COUNT(*) AS count FROM departements");
      $result3 = $stmt3->fetch(PDO::FETCH_ASSOC);

      // Leaves count
      $currentDate = date('Y-m-d');

      $stmt4 = $this->conn->prepare("SELECT COUNT(*) AS count FROM demandesconge WHERE :current_date BETWEEN date_debut AND date_fin");
      $stmt4->bindParam(':current_date', $currentDate);
      $stmt4->execute();
      $result4 = $stmt4->fetch(PDO::FETCH_ASSOC);

      return [
        'employee' => $result1['count'],
        'manager' => $result2['count'],
        'department' => $result3['count'],
        'leaves' => $result4['count']
      ];
    } catch (PDOException $e) {
      error_log('Error fetching employee count: ' . $e->getMessage());
      return [
        'error' => $e->getMessage()
      ];
    }
  }
  function getLatestFormation()
  {
    try {
      $query = "SELECT distinct(title),date_sent FROM formations
      WHERE id_sender = :id
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
  function getLatestLeaves()
  {
    try {
      $stmt = $this->conn->prepare("SELECT dc.*, concat(e.nom,' ',e.prenom) AS full_name, nom_type_conge AS type
                                     FROM demandesconge dc
                                     INNER JOIN employes e ON dc.id_employe = e.id_employe
                                     INNER JOIN typesconge t ON t.id_type_conge = dc.id_type_conge
                                     WHERE dc.statut <> 'En attente'
                                     AND e.id_gestionnaire = :manager_id
                                     ORDER BY dc.date_debut LIMIT 6");
      $stmt->bindParam(':manager_id', $_SESSION['id']);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log('Error getting processed leave requests: ' . $e->getMessage());
      return false;
    }
  }
  function getLatestReports()
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
}
