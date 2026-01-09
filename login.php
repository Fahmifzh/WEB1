<?php
include 'config.php';

if (isset($_COOKIE['login_admin'])) {
    header("Location: admin/dashboard.php");
    exit;
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $cek = mysqli_query($conn,
        "SELECT * FROM admin WHERE username='$username' AND password='$password'"
    );

    if (mysqli_num_rows($cek) > 0) {

        // COOKIE PENENTU LOGIN
        setcookie("login_admin", $username, time() + 3600, "/");

        header("Location: admin/dashboard.php");
        exit;

    } else {
        $error = "Login gagal!";
    }
}
?>



<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin | SweetSip</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/admin.css">
</head>

<body style="background:#fffaf0; font-family:Poppins;">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">

            <div class="card p-4 shadow rounded-4">
                <h4 class="text-center mb-3 fw-bold">🔐 Login Admin</h4>

                <?php if (isset($error)) { ?>
                    <div class="alert alert-danger text-center">
                        <?php echo $error; ?>
                    </div>
                <?php } ?>

                <form method="POST">
                    <input type="text" name="username" class="form-control mb-3"
                           placeholder="Username" required>

                    <input type="password" name="password" class="form-control mb-3"
                           placeholder="Password" required>

                    <button type="submit" name="login"
        class="btn btn-sweetsip w-100">
    Login 🚀
</button>

                </form>

                <p class="text-center mt-3">
                    <a href="index.php">⬅ Kembali ke Beranda</a>
                </p>
            </div>

        </div>
    </div>
</div>

<footer class="text-center py-4">
    <p class="mb-0">Dibuat dengan ❤️ oleh <b>Fahmi Fauziah</b></p>
</footer>

</body>
</html>
