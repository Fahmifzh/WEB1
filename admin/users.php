<?php
include '../config.php';
include 'auth_check.php';

$users = mysqli_query($conn,"SELECT * FROM users ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Kelola User | SweetSip Studio</title>

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
    <h4 class="fw-bold">👥 Kelola User</h4>
    <a href="user_add.php" class="btn btn-aesthetic">
      ➕ Tambah User (Register)
    </a>
  </div>

  <div class="card p-3">
    <div class="table-responsive">
      <table class="table table-bordered align-middle text-center">
        <thead class="table-light">
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Role</th>
            <th>Tanggal Dibuat</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>

        <?php
        $no=1;
        while($u=mysqli_fetch_assoc($users)):
        ?>
          <tr>
            <td><?= $no++; ?></td>
            <td><?= $u['nama']; ?></td>
            <td><?= $u['username']; ?></td>
            <td>
              <span class="badge bg-secondary">
                <?= $u['role']; ?>
              </span>
            </td>
            <td><?= date('d-m-Y',strtotime($u['created_at'])); ?></td>
            <td>
              <?php if($u['username'] != 'admin'): ?>
              <a href="user_delete.php?id=<?= $u['id']; ?>"
                 class="btn btn-sm btn-outline-danger"
                 onclick="return confirm('Yakin hapus user ini?')">
                Hapus
              </a>
              <?php else: ?>
                <span class="text-muted">Default</span>
              <?php endif; ?>
            </td>
          </tr>
        <?php endwhile; ?>

        </tbody>
      </table>
    </div>
  </div>

</div>

<?php include '../layout/footer.php'; ?>

</body>
</html>
