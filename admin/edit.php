<?php
include '../config.php';

if (!isset($_COOKIE['login_admin'])) {
    header("Location: ../login.php");
    exit;
}

$username = $_COOKIE['login_admin'];

$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM resep WHERE id='$id'");
$row = mysqli_fetch_array($data);

if (isset($_POST['update'])) {
    mysqli_query($conn, "UPDATE resep SET
        nama_resep='$_POST[nama]',
        kategori='$_POST[kategori]',
        bahan='$_POST[bahan]',
        langkah='$_POST[langkah]'
        WHERE id='$id'
    ");
    header("Location: resep.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Resep</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background:#fffaf0;">
<div class="container mt-5">
    <h3 class="fw-bold">Edit Resep ✏️</h3>

    <form method="POST">
        <input type="text" name="nama"
               value="<?php echo $row['nama_resep']; ?>"
               class="form-control mb-2" required>

        <input type="text" name="kategori"
               value="<?php echo $row['kategori']; ?>"
               class="form-control mb-2" required>

        <textarea name="bahan" class="form-control mb-2" required><?php echo $row['bahan']; ?></textarea>

        <textarea name="langkah" class="form-control mb-3" required><?php echo $row['langkah']; ?></textarea>

        <button name="update" class="btn btn-warning">Update</button>
        <a href="resep.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>
