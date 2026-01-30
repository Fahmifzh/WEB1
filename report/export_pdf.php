<?php
include '../admin/auth_check.php';
require('../fpdf/fpdf.php');

$pdf = new FPDF('L','mm','A4');
$pdf->AddPage();

$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,'LAPORAN DATA RESEP - SWEETSIP STUDIO',0,1,'C');
$pdf->Ln(5);

// HEADER TABLE
$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,8,'No',1);
$pdf->Cell(60,8,'Nama Resep',1);
$pdf->Cell(40,8,'Kategori',1);
$pdf->Cell(120,8,'Deskripsi',1);
$pdf->Cell(35,8,'Tanggal',1);
$pdf->Ln();

// DATA
$pdf->SetFont('Arial','',9);

$query = mysqli_query($conn,"
  SELECT resep.nama_resep, resep.deskripsi, resep.created_at,
         kategori.nama_kategori
  FROM resep
  JOIN kategori ON resep.kategori_id = kategori.id
  ORDER BY resep.id DESC
");

$no = 1;
while ($row = mysqli_fetch_assoc($query)) {

  $pdf->Cell(10,8,$no++,1);
  $pdf->Cell(60,8,substr($row['nama_resep'],0,30),1);
  $pdf->Cell(40,8,substr($row['nama_kategori'],0,20),1);
  $pdf->Cell(120,8,substr($row['deskripsi'],0,80).'...',1);
  $pdf->Cell(35,8,date('d-m-Y', strtotime($row['created_at'])),1);
  $pdf->Ln();
}

$pdf->Ln(5);
$pdf->Cell(0,10,'Dicetak pada: '.date('d-m-Y H:i:s'),0,1,'R');

$pdf->Output();
exit;
