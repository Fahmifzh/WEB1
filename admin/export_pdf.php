<?php
include '../config.php';

// CEK LOGIN ADMIN
if (!isset($_COOKIE['login_admin'])) {
    header("Location: ../login.php");
    exit;
}

require('../fpdf/fpdf.php');

$pdf = new FPDF('L','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','B',14);

$pdf->Cell(0,10,'LAPORAN RESEP SWEETSIP STUDIO',0,1,'C');
$pdf->Ln(5);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,8,'No',1);
$pdf->Cell(50,8,'Nama Resep',1);
$pdf->Cell(40,8,'Kategori',1);
$pdf->Cell(80,8,'Bahan',1);
$pdf->Cell(80,8,'Langkah',1);
$pdf->Cell(30,8,'Tanggal',1);
$pdf->Ln();

$pdf->SetFont('Arial','',9);
$no = 1;
$data = mysqli_query($conn, "SELECT * FROM resep");

while ($row = mysqli_fetch_array($data)) {
    $pdf->Cell(10,8,$no++,1);
    $pdf->Cell(50,8,$row['nama_resep'],1);
    $pdf->Cell(40,8,$row['kategori'],1);
    $pdf->Cell(80,8,substr($row['bahan'],0,50).'...',1);
    $pdf->Cell(80,8,substr($row['langkah'],0,50).'...',1);
    $pdf->Cell(30,8,$row['created_at'],1);
    $pdf->Ln();
}

$pdf->Output();
