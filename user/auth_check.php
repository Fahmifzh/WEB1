<?php
include '../config.php';

if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'user') {
  http_response_code(403);
  header("Location: ../auth/login.php");
  exit;
}
