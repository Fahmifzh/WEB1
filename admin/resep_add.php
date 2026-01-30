<?php
include 'auth_check.php';

// CSRF TOKEN
if (empty($_SESSION['token'])) {
  $_SESSION['token'] = bin2hex(random_bytes(32));
}

// AMBIL KATEGORI
$kategori = mysqli_query($conn,"SELECT id, nama_kategori FROM kategori");

if (isset($_POST['simpan'])) {

  // CSRF CHECK
  if (
    !isset($_POST['token']) ||
    !hash_equals($_SESSION['token'], $_POST['token'])
  ) {
    die("Invalid CSRF token");
  }

  $nama       = trim($_POST['nama_resep']);
  $kategoriId = filter_input(INPUT_POST, 'kategori_id', FILTER_VALIDATE_INT);
  $deskripsi  = trim($_POST['deskripsi']);

  if (!$kategoriId) {
    die("Kategori tidak valid");
  }

  // =====================
  // UPLOAD GAMBAR AMAN
  // =====================
  $gambar = "default.jpg";

  if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {

    $allowedExt  = ['jpg','jpeg','png'];
    $allowedMime = ['image/jpeg','image/png'];

    $ext  = strtolower(pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION));
    $mime = mime_content_type($_FILES['gambar']['tmp_name']);

    if (!in_array($ext, $allowedExt) || !in_array($mime, $allowedMime)) {
      die("File gambar tidak valid");
    }

    if ($_FILES['gambar']['size'] > 2 * 1024 * 1024) {
      die("Ukuran file maksimal 2MB");
    }

    $gambar = uniqid('img_', true) . "." . $ext;
    move_uploaded_file(
      $_FILES['gambar']['tmp_name'],
      "../assets/uploads/" . $gambar
    );
  }

  // =====================
  // INSERT (PREPARED)
  // =====================
  $stmt = mysqli_prepare($conn,"
    INSERT INTO resep (nama_resep, kategori_id, deskripsi, gambar)
    VALUES (?, ?, ?, ?)
  ");
  mysqli_stmt_bind_param(
    $stmt,
    "siss",
    $nama,
    $kategoriId,
    $deskripsi,
    $gambar
  );
  mysqli_stmt_execute($stmt);

  header("Location: resep.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Resep | SweetSip Studio</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

<nav class="navbar navbar-expand-lg bg-light shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold d-flex align-items-center" href="#">
      <img src="../assets/img/logo.png" alt="Logo" width="35" height="35"
           class="d-inline-block align-text-top me-2">
      Admin SweetSip
    </a>
    <div class="ms-auto">
      <a href="resep.php" class="btn btn-sm btn-outline-secondary">
        Kembali
      </a>
    </div>
  </div>
</nav>

<div class="container my-5">
  <h4 class="fw-bold mb-4">➕ Tambah Resep</h4>

  <div class="card p-4">
    <form method="POST" enctype="multipart/form-data">

      <input type="hidden" name="token"
             value="<?= $_SESSION['token']; ?>">

      <div class="mb-3">
        <label class="form-label">Nama Resep</label>
        <input type="text" name="nama_resep"
               class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Kategori</label>
        <select name="kategori_id" class="form-select" required>
          <option value="">-- Pilih Kategori --</option>
          <?php while($k=mysqli_fetch_assoc($kategori)): ?>
            <option value="<?= (int)$k['id']; ?>">
              <?= htmlspecialchars($k['nama_kategori']); ?>
            </option>
          <?php endwhile; ?>
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">Deskripsi Resep</label>
        <textarea name="deskripsi" rows="5"
                  class="form-control" required></textarea>
      </div>

      <div class="mb-3">
        <label class="form-label">Gambar Resep</label>
        <input type="file" name="gambar"
               class="form-control"
               accept="image/png, image/jpeg">
      </div>

      <button name="simpan" class="btn btn-aesthetic">
        Simpan Resep
      </button>

    </form>
  </div>
</div>

<?php include '../layout/footer.php'; ?>
</body>
</html>
