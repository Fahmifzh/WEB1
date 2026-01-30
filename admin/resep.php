<?php
include 'auth_check.php';

// CSRF TOKEN (UNTUK AKSI)
if (empty($_SESSION['token'])) {
  $_SESSION['token'] = bin2hex(random_bytes(32));
}

$resep = mysqli_query($conn,"
  SELECT resep.*, kategori.nama_kategori
  FROM resep
  JOIN kategori ON resep.kategori_id = kategori.id
  ORDER BY resep.id DESC
");
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Kelola Resep | SweetSip Studio</title>

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
    <h4 class="fw-bold">🍹 Kelola Resep</h4>
    <a href="resep_add.php" class="btn btn-aesthetic">
      ➕ Tambah Resep
    </a>
  </div>

  <div class="card p-3 table-responsive">
    <table class="table table-bordered align-middle text-center">
      <thead class="table-light">
        <tr>
          <th>No</th>
          <th>Gambar</th>
          <th>Nama Resep</th>
          <th>Kategori</th>
          <th>Tanggal</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>

      <?php
      $no=1;
      while($r=mysqli_fetch_assoc($resep)):
      ?>
        <tr>
          <td><?= $no++; ?></td>
          <td>
            <img src="../assets/uploads/<?= htmlspecialchars($r['gambar']); ?>"
                 width="80" class="rounded">
          </td>
          <td><?= htmlspecialchars($r['nama_resep']); ?></td>
          <td><?= htmlspecialchars($r['nama_kategori']); ?></td>
          <td><?= date('d-m-Y', strtotime($r['created_at'])); ?></td>
          <td>
            <a href="resep_edit.php?id=<?= (int)$r['id']; ?>"
               class="btn btn-sm btn-outline-primary">
              Edit
            </a>

            <!-- HAPUS PAKAI FORM + CSRF -->
            <form action="resep_delete.php"
                  method="POST"
                  class="d-inline"
                  onsubmit="return confirm('Yakin hapus resep ini?')">
              <input type="hidden" name="id"
                     value="<?= (int)$r['id']; ?>">
              <input type="hidden" name="token"
                     value="<?= $_SESSION['token']; ?>">
              <button class="btn btn-sm btn-outline-danger">
                Hapus
              </button>
            </form>
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
