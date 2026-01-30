<?php
include '../admin/auth_check.php';

// HEADER EXCEL
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=laporan_resep_sweetsip.xls");

echo "<table border='1'>";
echo "<tr>
        <th>No</th>
        <th>Nama Resep</th>
        <th>Kategori</th>
        <th>Deskripsi</th>
        <th>Tanggal</th>
      </tr>";

// QUERY DATA
$query = mysqli_query($conn,"
  SELECT resep.nama_resep, resep.deskripsi, resep.created_at,
         kategori.nama_kategori
  FROM resep
  JOIN kategori ON resep.kategori_id = kategori.id
  ORDER BY resep.id DESC
");

$no = 1;
while ($row = mysqli_fetch_assoc($query)) {

  echo "<tr>
          <td>".$no++."</td>
          <td>".htmlspecialchars($row['nama_resep'])."</td>
          <td>".htmlspecialchars($row['nama_kategori'])."</td>
          <td>".htmlspecialchars($row['deskripsi'])."</td>
          <td>".date('d-m-Y', strtotime($row['created_at']))."</td>
        </tr>";
}

echo "</table>";
exit;
