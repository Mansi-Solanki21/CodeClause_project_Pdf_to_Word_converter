<?php
// MySQL database configuration
$host = 'localhost';
$db = 'pdf_to_word__DATABASE';
$user = 'root';
$password = '12345';

// Connect to the database
$conn = new mysql($host, $user, $password, $db);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

//  file upload
if (isset($_FILES['pdfFile']) && $_FILES['pdfFile']['error'] === UPLOAD_ERR_OK) {
  $pdfFile = $_FILES['pdfFile'];
  
  $uploadDir = 'uploads/';
  $targetFile = $uploadDir . uniqid() . '.pdf';
  
  if (move_uploaded_file($pdfFile['tmp_name'], $targetFile)) {
    $sql = "INSERT INTO converted_files (pdf_file, word_file) VALUES ('$targetFile', '$wordFile')";
    if ($conn->query($sql) === TRUE) {
      $lastInsertId = $conn->