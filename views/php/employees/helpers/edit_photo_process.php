<?php
require_once '../layout/session_start.php';

use MyApp\Admin;

$admin = new Admin();
$m = '';
$s = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save']) && isset($_FILES['upload'])) {
 $maxFileSize = 800 * 1024; // Maximum file size in bytes (800KB)

 $uploadedFile = $_FILES['upload'];

 $fileName = $uploadedFile['name'];
 $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
 if ($uploadedFile['size'] <= $maxFileSize) {
  $newFileName = uniqid();

  $uploadDirectory = '../../../../assets/img/avatars/';
  $uploadPath = $uploadDirectory . $newFileName . '.png';

  if (move_uploaded_file($uploadedFile['tmp_name'], $uploadPath)) {
   $updateSuccess = $admin->updateProfilePhoto($newFileName);

   if ($updateSuccess) {
    $m = 'Succès';
    $s = true;
   } else {
    $m = 'Erreur';
   }
  } else {
   $m = 'Erreur de téléversement';
  }
 } else {
  $m = 'Fichier non valide';
 }
} else {
 $m = 'erreur';
}
header("location: ../pages/profile.php?m=$m&s=$s");
