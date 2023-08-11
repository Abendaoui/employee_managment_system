<?php

namespace MyApp;

use MyApp\Database;
use PDO;

class Auth
{
  private $conn;

  public function __construct()
  {
    $db = new Database();
    $this->conn = $db->getConnection();
  }

  public function login($username, $password)
  {
    $stmt = $this->conn->prepare("SELECT * FROM authentification WHERE nom_utilisateur = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    // ($user && password_verify($password, $user['mot_de_passe']))
    if ($user && $password === $user['mot_de_passe']) {
      $employee = $this->getEmployeeByUserId($user['email']);
      if ($employee) {
        session_start();
        $_SESSION['id'] = $employee['id_employe'];
        $_SESSION['email'] = $employee['email'];
        $_SESSION['name'] = $employee['prenom'] . ' ' . $employee['nom'];
        $_SESSION['role'] = $employee['role'];
        $_SESSION['profile'] = $employee['profile'];
        $_SESSION['id_dep'] = $employee['id_departement'];
        return true;
      }
    }
    return false;
  }
  public function logout()
  {
    session_start();
    session_unset();
    header("Location: ../../login.php");
  }
  public function isLoggedIn()
  {
    session_start();
    return isset($_SESSION['id']);
  }
  private function getEmployeeByUserId($email)
  {
    $stmt = $this->conn->prepare("SELECT * FROM Employes WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    return $stmt->fetch();
  }
}
