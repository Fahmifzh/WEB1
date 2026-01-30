<?php
include 'auth_check.php';

$total_resep = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM resep"));
$total_kategori = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM kategori"));
$total_user = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM users"));
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard Admin | SweetSip Studio</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

<nav class="navbar navbar-expand-lg bg-light shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold d-flex align-items-center" href="#">
      <img src="../assets/img/logo.png" alt="Logo" width="35" height="35" class="d-inline-block align-text-top me-2">
      Admin SweetSip
    </a>
    <div class="ms-auto">
      <span class="me-3">
        👋 <?= htmlspecialchars($_SESSION['nama']); ?>
      </span>
      <a href="../auth/logout.php" class="btn btn-sm btn-outline-secondary">
        Logout
      </a>
    </div>
  </div>
</nav>

<div class="container my-5">

  <h3 class="fw-bold mb-4">📊 Dashboard</h3>

  <div class="row">

    <div class="col-md-4 mb-4">
      <div class="card p-4 text-center">
        <h2><?= $total_resep; ?></h2>
        <p>Total Resep</p>
        <a href="resep.php" class="btn btn-sm btn-aesthetic">
          Kelola Resep
        </a>
      </div>
    </div>

    <div class="col-md-4 mb-4">
      <div class="card p-4 text-center">
        <h2><?= $total_kategori; ?></h2>
        <p>Total Kategori</p>
        <a href="kategori.php" class="btn btn-sm btn-aesthetic">
          Kelola Kategori
        </a>
      </div>
    </div>

    <div class="col-md-4 mb-4">
      <div class="card p-4 text-center">
        <h2><?= $total_user; ?></h2>
        <p>Total User</p>
        <a href="users.php" class="btn btn-sm btn-aesthetic">
          Kelola User
        </a>
      </div>
    </div>

  </div>

  <div class="mt-4">
    <a href="../report/export_pdf.php" class="btn btn-outline-danger me-2">
      📄 Export PDF
    </a>
    
    <a href="../report/export_excel.php" class="btn btn-outline-success">
     📑 Export Excel
    </a>
  </div>

</div>

<?php include '../layout/footer.php'; ?>

</body>
</html>
