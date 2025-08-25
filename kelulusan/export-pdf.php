<?php
session_start();
if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header('Location: login.php');
    exit;
}

require_once 'config.php';
require_once 'fpdf.php';

// Set font directory path relative to project structure
define('FPDF_FONTPATH', dirname(__DIR__) . '/assets/font/');

$pdf = new FPDF();
$pdf->AddPage();

// Use Helvetica since we confirmed the files exist in assets/font
$pdf->SetFont('Helvetica','B',14);
$pdf->Cell(0,10,'Daftar Kelulusan Siswa SMK Telkom Malang',0,1,'C');
$pdf->Ln(5);

$pdf->SetFont('Helvetica','B',10);
$pdf->Cell(25,8,'NIS',1,0,'C');
$pdf->Cell(60,8,'Nama',1,0,'C');
$pdf->Cell(20,8,'Nilai',1,0,'C');
$pdf->Cell(40,8,'Status Kelulusan',1,1,'C');

$pdf->SetFont('Helvetica','',10);
if (($file = fopen(KELULUSAN_DATA_PATH, "r")) !== FALSE) {
    $header = fgetcsv($file);
    while (($data = fgetcsv($file)) !== FALSE) {
        $nis = $data[0];
        $nama = $data[1];
        $nilai = $data[2];
        $status = ($nilai >= 75) ? 'LULUS' : 'TIDAK LULUS';
        $pdf->Cell(25,8,$nis,1,0,'C');
        $pdf->Cell(60,8,$nama,1,0,'L');
        $pdf->Cell(20,8,$nilai,1,0,'C');
        $pdf->Cell(40,8,$status,1,1,'C');
    }
    fclose($file);
} else {
    $pdf->Cell(0,10,'Data siswa tidak ditemukan.',0,1,'C');
}
$pdf->Output('D', 'kelulusan_siswa.pdf');
exit;