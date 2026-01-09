<?php
include '../config.php';

// CEK LOGIN ADMIN
if (!isset($_COOKIE['login_admin'])) {
    header("Location: ../login.php");
    exit;
}

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=laporan_resep_sweetsip.xls");
?>

<table border="1">
    <tr>
        <th>No</th>
        <th>Nama Resep</th>
        <th>Kategori</th>
        <th>Bahan</th>
        <th>Langkah</th>
        <th>Tanggal</th>
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
        <td><?php echo $row['bahan']; ?></td>
        <td><?php echo $row['langkah']; ?></td>
        <td><?php echo $row['created_at']; ?></td>
    </tr>
    <?php } ?>
</table>
