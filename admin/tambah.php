<?php
include '../config.php';

if (!isset($_COOKIE['login_admin'])) {
    header("Location: ../login.php");
    exit;
}

$username = $_COOKIE['login_admin'];

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $bahan = $_POST['bahan'];
    $langkah = $_POST['langkah'];
    $gambar = $_FILES['gambar']['name'];

    move_uploaded_file($_FILES['gambar']['tmp_name'], "../img/".$gambar);

    mysqli_query($conn, "INSERT INTO resep VALUES (
        NULL,'$nama','$kategori','$bahan','$langkah','$gambar',NOW()
    )");

    header("Location: resep.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Resep</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background:#fffaf0;">
<div class="container mt-5">
    <h3 class="fw-bold">Tambah Resep 🍰</h3>

    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="nama" class="form-control mb-2" placeholder="Nama Resep" required>
        <input type="text" name="kategori" class="form-control mb-2" placeholder="Kategori" required>
        <textarea name="bahan" class="form-control mb-2" placeholder="Bahan-bahan" required></textarea>
        <textarea name="langkah" class="form-control mb-2" placeholder="Langkah Pembuatan" required></textarea>
        <input type="file" name="gambar" class="form-control mb-3" required>

        <button name="simpan" class="btn btn-success">Simpan</button>
        <a href="resep.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>
