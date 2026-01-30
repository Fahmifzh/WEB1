<?php
include 'auth_check.php';

?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard User | SweetSip Studio</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg bg-light shadow-sm">
<div class="container">
<a class="navbar-brand fw-bold" href="../index.php">SweetSip Studio</a>
<div class="ms-auto">
<a href="../auth/logout.php" class="btn btn-sm btn-outline-danger">Logout</a>
</div>
</div>
</nav>

<div class="container my-5">
<div class="card p-4 text-center">
<h3>👋 Halo, <?= $_SESSION['nama']; ?></h3>
<p class="text-muted">Anda login sebagai User</p>

<a href="../index.php" class="btn btn-aesthetic mt-3">
🍰 Lihat Resep
</a>
</div>
</div>

<?php include '../layout/footer.php'; ?>
</body>
</html>
