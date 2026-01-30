<?php
include '../config.php';
include 'auth_check.php';

$kategori = mysqli_query($conn,"SELECT * FROM kategori ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Kelola Kategori | SweetSip Studio</title>

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
      <a href="dashboard.php" class="btn btn-sm btn-outline-secondary me-2">
        Dashboard
      </a>
      <a href="../auth/logout.php" class="btn btn-sm btn-outline-danger">
        Logout
      </a>
    </div>
  </div>
</nav>

<div class="container my-5">

  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold">📂 Kelola Kategori</h4>
    <a href="kategori_add.php" class="btn btn-aesthetic">
      ➕ Tambah Kategori
    </a>
  </div>

  <div class="card p-3">
    <table class="table table-bordered text-center align-middle">
      <thead class="table-light">
        <tr>
          <th>No</th>
          <th>Nama Kategori</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>

      <?php
      $no=1;
      while($k=mysqli_fetch_assoc($kategori)):
      ?>
        <tr>
          <td><?= $no++; ?></td>
          <td><?= $k['nama_kategori']; ?></td>
          <td>
            <a href="kategori_edit.php?id=<?= $k['id']; ?>"
               class="btn btn-sm btn-outline-primary">
              Edit
            </a>
            <a href="kategori_delete.php?id=<?= $k['id']; ?>"
               class="btn btn-sm btn-outline-danger"
               onclick="return confirm('Yakin hapus kategori ini?')">
              Hapus
            </a>
          </td>
        </tr>
      <?php endwhile; ?>

      </tbody>
    </table>
  </div>

</div>

<?php include '../layout/footer.php'; ?>

</body>
</html>
