<?php
include 'auth_check.php';

// HANYA TERIMA POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(405);
  exit('Method Not Allowed');
}

// CSRF TOKEN CHECK
if (
  !isset($_POST['token']) ||
  !hash_equals($_SESSION['token'], $_POST['token'])
) {
  http_response_code(403);
  exit('Invalid CSRF token');
}

// VALIDASI ID
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
if (!$id) {
  http_response_code(400);
  exit('Invalid ID');
}

// DELETE DENGAN PREPARED STATEMENT
$stmt = mysqli_prepare($conn, "DELETE FROM resep WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

// REDIRECT BALIK
header("Location: resep.php");
exit;
