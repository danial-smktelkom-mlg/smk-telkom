<?php
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Kelulusan Siswa SMK Telkom Malang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2 class="mb-4 text-center">Daftar Kelulusan Siswa SMK Telkom Malang</h2>
    <div class="mb-3 text-start">
        <a href="home.php" class="btn btn-secondary">&larr; Home</a>
    </div>
    <div class="table-responsive" style="max-height:600px;overflow:auto;">
        <table class="table table-bordered table-hover table-sm">
            <thead class="table-dark">
                <tr>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Nilai</th>
                    <th>Status Kelulusan</th>
                </tr>
            </thead>
            <tbody>
            <?php
            if (($file = fopen(KELULUSAN_DATA_PATH, "r")) !== FALSE) {
                $header = fgetcsv($file);
                while (($data = fgetcsv($file)) !== FALSE) {
                    $nis = htmlspecialchars($data[0]);
                    $nama = htmlspecialchars($data[1]);
                    $nilai = (int)$data[2];
                    $status = $nilai >= 75 ? "LULUS" : "TIDAK LULUS";
                    $statusClass = $nilai >= 75 ? "table-success" : "table-danger";
                    echo "<tr>";
                    echo "<td>$nis</td>";
                    echo "<td>$nama</td>";
                    echo "<td class='text-center'>$nilai</td>";
                    echo "<td class='text-center $statusClass'><strong>$status</strong></td>";
                    echo "</tr>";
                }
                fclose($file);
            } else {
                echo '<tr><td colspan="4" class="text-center text-danger">File data siswa tidak ditemukan.</td></tr>';
            }
            ?>
            </tbody>
        </table>
    </div>
    <div class="alert alert-info mt-4">
        <strong>Kriteria Kelulusan:</strong> Nilai minimal <b>75</b> dinyatakan <span class="text-success">LULUS</span>.
    </div>
</div>
</body>
</html>