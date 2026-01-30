<?php
include 'config.php';

$id = $_GET['id'];

$query = mysqli_query($conn,"
  SELECT resep.*, kategori.nama_kategori
  FROM resep
  JOIN kategori ON resep.kategori_id = kategori.id
  WHERE resep.id='$id'
");

$data = mysqli_fetch_assoc($query);

// PROSES TAMBAH FAVORIT
if (isset($_POST['favorit'])) {
  if (!isset($_SESSION['login']) || $_SESSION['role'] != 'user') {
    header("Location: auth/login.php");
    exit;
  }

  $user_id = $_SESSION['id'];

  mysqli_query($conn,"
    INSERT IGNORE INTO favorites (user_id, resep_id)
    VALUES ('$user_id','$id')
  ");

  $success = true;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title><?= $data['nama_resep']; ?> | SweetSip Studio</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php include 'layout/navbar.php'; ?>

<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-md-8">

      <div class="card p-4">

        <!-- GAMBAR + FAVORIT ICON -->
        <div class="position-relative mb-4">

          <img src="assets/uploads/<?= $data['gambar']; ?>"
               class="img-fluid rounded">

          <?php if (isset($_SESSION['login']) && $_SESSION['role'] == 'user'): ?>
            <!-- USER LOGIN -->
            <form method="POST"
                  class="position-absolute top-0 end-0 m-3">
              <button name="favorit"
                      class="btn btn-light rounded-circle shadow favorite-btn"
                      title="Tambah ke favorit">
                ❤️
              </button>
            </form>
          <?php else: ?>
            <!-- GUEST -->
            <a href="auth/login.php"
               class="btn btn-light rounded-circle shadow favorite-btn position-absolute top-0 end-0 m-3"
               title="Login untuk favorit">
              ❤️
            </a>
          <?php endif; ?>

        </div>

        <?php if (isset($success)): ?>
          <div class="alert alert-success">
            ❤️ Resep berhasil ditambahkan ke favorit
          </div>
        <?php endif; ?>

        <span class="category-badge">
          <?= $data['nama_kategori']; ?>
        </span>

        <h3 class="fw-bold mt-3">
          <?= $data['nama_resep']; ?>
        </h3>

        <p class="mt-3">
          <?= nl2br($data['deskripsi']); ?>
        </p>

        <a href="index.php" class="btn btn-secondary mt-4">
          ⬅ Kembali
        </a>

      </div>

    </div>
  </div>
</div>

<?php include 'layout/footer.php'; ?>
</body>
</html>
