<?php
include '../config.php';

/* =========================
   CSRF TOKEN
========================= */
if (empty($_SESSION['token'])) {
  $_SESSION['token'] = bin2hex(random_bytes(32));
}

/* =========================
   PROSES REGISTER
========================= */
if (isset($_POST['register'])) {

  // CSRF CHECK
  if (!hash_equals($_SESSION['token'], $_POST['token'])) {
    die("Invalid CSRF token");
  }

  $nama     = trim($_POST['nama']);
  $email    = trim($_POST['email']);
  $username = trim($_POST['username']);
  $password = $_POST['password'];

  // VALIDASI DASAR
  if (strlen($username) < 4) {
    $error = "Username minimal 4 karakter";
  } elseif (strlen($password) < 6) {
    $error = "Password minimal 6 karakter";
  } else {

    // CEK USERNAME (PREPARED STATEMENT)
    $stmt = mysqli_prepare($conn,
      "SELECT id FROM users WHERE username=?"
    );
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
      $error = "Username sudah digunakan";
    } else {

      // HASH PASSWORD
      $hashed = hash('sha256', $password);

      // INSERT USER (PREPARED STATEMENT)
      $stmt = mysqli_prepare($conn,
        "INSERT INTO users (nama,email,username,password,role)
         VALUES (?,?,?,?, 'user')"
      );
      mysqli_stmt_bind_param(
        $stmt, "ssss",
        $nama, $email, $username, $hashed
      );
      mysqli_stmt_execute($stmt);

      header("Location: login.php");
      exit;
    }
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Register User | SweetSip Studio</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body style="background:#fff5f7;">

<div class="container">
<div class="row justify-content-center align-items-center" style="min-height:100vh;">
<div class="col-md-5">
<div class="card p-4 shadow">

<h4 class="text-center fw-bold mb-3">📝 Register User</h4>

<?php if (isset($error)): ?>
<div class="alert alert-danger">
  <?= htmlspecialchars($error); ?>
</div>
<?php endif; ?>

<form method="POST">

<input type="hidden" name="token"
       value="<?= $_SESSION['token']; ?>">

<input type="text" name="nama"
       class="form-control mb-2"
       placeholder="Nama Lengkap" required>

<input type="email" name="email"
       class="form-control mb-2"
       placeholder="Email">

<input type="text" name="username"
       class="form-control mb-2"
       placeholder="Username" required>

<input type="password" name="password"
       class="form-control mb-3"
       placeholder="Password" required>

<button name="register"
        class="btn btn-aesthetic w-100">
  Register
</button>

</form>

<div class="text-center mt-3">
<a href="login.php">Sudah punya akun? Login</a>
</div>

</div>
</div>
</div>
</div>

</body>
</html>
