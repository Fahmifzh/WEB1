<?php
include '../config.php';
include 'auth_check.php';

if(isset($_POST['simpan'])){
  $nama = mysqli_real_escape_string($conn,$_POST['nama_kategori']);

  mysqli_query($conn,"
    INSERT INTO kategori (nama_kategori)
    VALUES ('$nama')
  ");

  header("Location: kategori.php");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Kategori | SweetSip Studio</title>

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
      <a href="kategori.php" class="btn btn-sm btn-outline-secondary">
        Kembali
      </a>
    </div>
  </div>
</nav>

<div class="container my-5">

  <h4 class="fw-bold mb-4">➕ Tambah Kategori</h4>

  <div class="card p-4">
    <form method="POST">
      <div class="mb-3">
        <label class="form-label">Nama Kategori</label>
        <input type="text" name="nama_kategori" class="form-control" required>
      </div>

      <button name="simpan" class="btn btn-aesthetic">
        Simpan
      </button>
    </form>
  </div>

</div>

<?php include '../layout/footer.php'; ?>

</body>
</html>
