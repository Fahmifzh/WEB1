<?php
include '../config.php';

/* =========================
   RATE LIMIT LOGIN
========================= */
if (!isset($_SESSION['login_attempt'])) {
  $_SESSION['login_attempt'] = 0;
}

if ($_SESSION['login_attempt'] >= 5) {
  die("Terlalu banyak percobaan login. Coba lagi nanti.");
}

/* =========================
   PROSES LOGIN
========================= */
if (isset($_POST['login'])) {

  $username = trim($_POST['username']);
  $password = hash('sha256', $_POST['password']);

  $stmt = mysqli_prepare(
    $conn,
    "SELECT id, nama, role FROM users WHERE username=? AND password=?"
  );
  mysqli_stmt_bind_param($stmt, "ss", $username, $password);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if (mysqli_num_rows($result) === 1) {
    $user = mysqli_fetch_assoc($result);

    // REGENERATE SESSION (ANTI FIXATION)
    session_regenerate_id(true);

    $_SESSION['login'] = true;
    $_SESSION['id']    = $user['id'];
    $_SESSION['nama']  = $user['nama'];
    $_SESSION['role']  = $user['role'];

    // RESET ATTEMPT
    $_SESSION['login_attempt'] = 0;

    if ($user['role'] === 'admin') {
      header("Location: ../admin/dashboard.php");
    } else {
      header("Location: ../user/dashboard.php");
    }
    exit;

  } else {
    $_SESSION['login_attempt']++;
    $error = true;
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Login | SweetSip Studio</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body style="background:#fff5f7;">
<div class="container">
<div class="row justify-content-center align-items-center" style="min-height:100vh;">
<div class="col-md-4">
<div class="card p-4 shadow">

<h4 class="text-center fw-bold mb-2">🔐 Login</h4>

<?php if (isset($error)): ?>
<div class="alert alert-danger">
  Username atau password salah
</div>
<?php endif; ?>

<form method="POST">
  <input type="text" name="username" class="form-control mb-2"
         placeholder="Username" required>
  <input type="password" name="password" class="form-control mb-3"
         placeholder="Password" required>
  <button name="login" class="btn btn-aesthetic w-100">
    Login
  </button>
</form>

<div class="text-center mt-3">
  <a href="register.php">Belum punya akun? Register</a><br>
  <a href="../index.php">⬅ Kembali ke Home</a>
</div>

</div>
</div>
</div>
</div>
</body>
</html>
