<?php
include 'auth_check.php';

// CSRF TOKEN
if (empty($_SESSION['token'])) {
  $_SESSION['token'] = bin2hex(random_bytes(32));
}

// VALIDASI ID (GET)
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
  http_response_code(400);
  exit('Invalid ID');
}

// AMBIL DATA RESEP (PREPARED)
$stmt = mysqli_prepare($conn, "SELECT * FROM resep WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);

if (!$data) {
  http_response_code(404);
  exit('Data tidak ditemukan');
}

// AMBIL KATEGORI
$kategori = mysqli_query($conn,"SELECT id, nama_kategori FROM kategori");

// =====================
// PROSES UPDATE
// =====================
if (isset($_POST['update'])) {

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
  // UPLOAD GAMBAR (AMAN)
  // =====================
  $gambar = $data['gambar'];

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

    $gambarBaru = uniqid('img_', true) . "." . $ext;
    move_uploaded_file(
      $_FILES['gambar']['tmp_name'],
      "../assets/uploads/" . $gambarBaru
    );

    // HAPUS GAMBAR LAMA
    if ($gambar !== "default.jpg" &&
        file_exists("../assets/uploads/" . $gambar)) {
      unlink("../assets/uploads/" . $gambar);
    }

    $gambar = $gambarBaru;
  }

  // =====================
  // UPDATE (PREPARED)
  // =====================
  $stmt = mysqli_prepare($conn,"
    UPDATE resep SET
      nama_resep = ?,
      kategori_id = ?,
      deskripsi = ?,
      gambar = ?
    WHERE id = ?
  ");
  mysqli_stmt_bind_param(
    $stmt,
    "sissi",
    $nama,
    $kategoriId,
    $deskripsi,
    $gambar,
    $id
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
<title>Edit Resep | SweetSip Studio</title>
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
  <h4 class="fw-bold mb-4">✏️ Edit Resep</h4>

  <div class="card p-4">
    <form method="POST" enctype="multipart/form-data">

      <input type="hidden" name="token"
             value="<?= $_SESSION['token']; ?>">

      <div class="mb-3">
        <label class="form-label">Nama Resep</label>
        <input type="text" name="nama_resep"
               value="<?= htmlspecialchars($data['nama_resep']); ?>"
               class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Kategori</label>
        <select name="kategori_id" class="form-select" required>
          <?php while($k=mysqli_fetch_assoc($kategori)): ?>
            <option value="<?= (int)$k['id']; ?>"
              <?= $data['kategori_id']==$k['id']?'selected':''; ?>>
              <?= htmlspecialchars($k['nama_kategori']); ?>
            </option>
          <?php endwhile; ?>
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">Deskripsi Resep</label>
        <textarea name="deskripsi" rows="5"
          class="form-control" required><?= htmlspecialchars($data['deskripsi']); ?></textarea>
      </div>

      <div class="mb-3">
        <label class="form-label">Gambar Resep</label>
        <input type="file" name="gambar"
               class="form-control"
               accept="image/png, image/jpeg">
        <small class="text-muted">
          Kosongkan jika tidak ingin mengganti gambar
        </small>
      </div>

      <button name="update" class="btn btn-aesthetic">
        Update Resep
      </button>

    </form>
  </div>
</div>

<?php include '../layout/footer.php'; ?>
</body>
</html>
