<?php
include '../config.php';

if (!isset($_COOKIE['login_admin'])) {
    header("Location: ../login.php");
    exit;
}

$username = $_COOKIE['login_admin'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Resep</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="container mt-5">
    <h3 class="fw-bold">Data Resep 🍹</h3>

    <a href="tambah.php" class="btn btn-success mb-3">+ Tambah Resep</a>
    <a href="dashboard.php" class="btn btn-secondary mb-3">⬅ Dashboard</a>
<div class="mb-3">
        <a href="export_excel.php" class="btn btn-outline-success">
            Export Excel 📊
        </a>
        <a href="export_pdf.php" class="btn btn-outline-danger">
            Export PDF 📄
        </a>
    </div>
    <table class="table table-bordered table-striped">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Gambar</th>
            <th>Aksi</th>
        </tr>

        <?php
        $no = 1;
        $data = mysqli_query($conn, "SELECT * FROM resep");
        while ($row = mysqli_fetch_array($data)) {
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $row['nama_resep']; ?></td>
            <td><?php echo $row['kategori']; ?></td>
            <td>
                <img src="../img/<?php echo $row['gambar']; ?>" width="80">
            </td>
            <td>
                <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="hapus.php?id=<?php echo $row['id']; ?>"
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Yakin hapus resep?')">
                   Hapus
                </a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>
</body>
</html>
