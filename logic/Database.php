<?php

namespace MyApp;

use PDO;
use PDOException;

class Database
{
 private $host = 'localhost';
 private $username = 'root';
 private $password = '';
 private $dbname = 'employee_management_system';
 private $conn;

 public function __construct()
 {
  try {
   $dsn = "mysql:host={$this->host};dbname={$this->dbname}";
   $options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
   );
   $this->conn = new PDO($dsn, $this->username, $this->password, $options);
  } catch (PDOException $e) {
   die("Connection failed: " . $e->getMessage());
  }
 }

 public function getConnection()
 {
  return $this->conn;
 }

 public function closeConnection()
 {
  $this->conn = null;
 }
}
