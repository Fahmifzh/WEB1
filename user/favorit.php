<?php
include 'auth_check.php';

$user_id = $_SESSION['id'];

// AMBIL DATA FAVORIT (PREPARED STATEMENT)
$stmt = mysqli_prepare($conn,"
  SELECT resep.id, resep.nama_resep, resep.gambar,
         kategori.nama_kategori
  FROM favorites
  JOIN resep ON favorites.resep_id = resep.id
  JOIN kategori ON resep.kategori_id = kategori.id
  WHERE favorites.user_id = ?
  ORDER BY favorites.created_at DESC
");
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Favorit Saya | SweetSip Studio</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg bg-light shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="dashboard.php">
      Dashboard User
    </a>
    <div class="ms-auto">
      <a href="../auth/logout.php"
         class="btn btn-sm btn-outline-danger">
        Logout
      </a>
    </div>
  </div>
</nav>

<div class="container my-5">
  <h4 class="fw-bold mb-4">❤️ Resep Favorit Saya</h4>

  <div class="row">
  <?php if(mysqli_num_rows($result) > 0): ?>
    <?php while($f = mysqli_fetch_assoc($result)): ?>
      <div class="col-md-4 mb-4">
        <div class="card recipe-card h-100">

          <img src="../assets/uploads/<?= htmlspecialchars($f['gambar']); ?>"
               class="card-img-top"
               style="height:200px;object-fit:cover;">

          <div class="card-body text-center">
            <span class="category-badge">
              <?= htmlspecialchars($f['nama_kategori']); ?>
            </span>

            <h6 class="fw-bold mt-2">
              <?= htmlspecialchars($f['nama_resep']); ?>
            </h6>

            <a href="../detail.php?id=<?= (int)$f['id']; ?>"
               class="btn btn-aesthetic btn-sm mt-2">
              Lihat
            </a>
          </div>

        </div>
      </div>
    <?php endwhile; ?>
  <?php else: ?>
    <p class="text-muted">
      Belum ada resep favorit.
    </p>
  <?php endif; ?>
  </div>
</div>

<?php include '../layout/footer.php'; ?>
</body>
</html>
