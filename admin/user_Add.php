<?php
include '../config.php';
include 'auth_check.php';


if(isset($_POST['simpan'])){
  $nama = htmlspecialchars(mysqli_real_escape_string($conn,$_POST['nama']), ENT_QUOTES);
  $username = htmlspecialchars(mysqli_real_escape_string($conn,$_POST['username']), ENT_QUOTES);
  $password = hash('sha256',$_POST['password']);
  $role = $_POST['role'];

  $cek = mysqli_query($conn,"SELECT * FROM users WHERE username='$username'");

  if(mysqli_num_rows($cek) > 0){
    $error = "Username sudah digunakan!";
  } else {
    mysqli_query($conn,"
      INSERT INTO users (nama,username,password,role)
      VALUES ('$nama','$username','$password','$role')
    ");
    header("Location: users.php");
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah User | SweetSip Studio</title>

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
      <a href="users.php" class="btn btn-sm btn-outline-secondary">
        Kembali
      </a>
    </div>
  </div>
</nav>

<div class="container my-5">

  <h4 class="fw-bold mb-4">➕ Register / Tambah User</h4>

  <div class="card p-4">
    <?php if(isset($error)): ?>
      <div class="alert alert-danger">
        <?= $error; ?>
      </div>
    <?php endif; ?>

    <form method="POST">

      <div class="mb-3">
        <label class="form-label">Nama Lengkap</label>
        <input type="text" name="nama" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" name="username" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Role</label>
        <select name="role" class="form-select">
          <option value="admin">Admin</option>
          <option value="staff">Staff</option>
        </select>
      </div>

      <button name="simpan" class="btn btn-aesthetic">
        Simpan User
      </button>

    </form>
  </div>

</div>

<?php include '../layout/footer.php'; ?>

</body>
</html>
