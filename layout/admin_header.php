<?php
include '../config.php';

if(!isset($_SESSION['login']) || !isset($_COOKIE['login_admin'])){
  header("Location: ../auth/login.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard Admin - SweetSip Studio</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

<nav class="navbar navbar-expand-lg bg-light shadow-sm">
  <div class="container-fluid">
    <span class="navbar-brand fw-bold">🍰 SweetSip Studio - Admin</span>
    <div class="ms-auto">
      <span class="me-3">Halo, <?php echo $_SESSION['nama']; ?></span>
      <a href="../auth/logout.php" class="btn btn-outline-secondary btn-sm">
        Logout
      </a>
    </div>
  </div>
</nav>

<div class="container-fluid">
  <div class="row">
