<?php
include '../config.php';

if (!isset($_COOKIE['login_admin'])) {
    header("Location: ../login.php");
    exit;
}

$username = $_COOKIE['login_admin'];
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin | SweetSip</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background:#fffaf0;">

<link rel="stylesheet" href="../assets/css/admin.css">

<nav class="navbar navbar-sweetsip">

    <div class="container">
        <span class="navbar-brand">🍰 SweetSip Admin</span>
        <a href="../logout.php" class="btn btn-light btn-sm">Logout</a>
    </div>
</nav>

<div class="container mt-5">
    <h3 class="fw-bold">Dashboard Admin 📊</h3>
    <p>Selamat datang, <b><?php echo $username; ?></b> ✨</p>

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card p-3 shadow-sm rounded-4">
                <h5>Total Resep</h5>
                <?php
                $q = mysqli_query($conn, "SELECT COUNT(*) as total FROM resep");
                $d = mysqli_fetch_array($q);
                ?>
                <h2><?php echo $d['total']; ?></h2>
            </div>
        </div>
    </div>

    <a href="resep.php" class="btn btn-sweetsip mt-4">
        Kelola Resep ✏️
    </a>
</div>

</body>
</html>
