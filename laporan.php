<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit;
}
include 'koneksi.php';

$query = mysqli_query($koneksi, "SELECT pesanan.*, customer.nama 
                                 FROM pesanan 
                                 JOIN customer ON pesanan.id_customer = customer.id 
                                 WHERE status='Selesai' 
                                 ORDER BY pesanan.tanggal DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Selesai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body onload="window.print()">
<div class="container mt-4">
    <h3 class="text-center">Laporan Pesanan Selesai</h3>
    <table class="table table-bordered mt-3">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Nama Customer</th>
                <th>Layanan</th>
                <th>Deskripsi</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; while ($row = mysqli_fetch_assoc($query)) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['nama']) ?></td>
                <td><?= htmlspecialchars($row['layanan']) ?></td>
                <td><?= htmlspecialchars($row['deskripsi']) ?></td>
                <td><?= $row['tanggal'] ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
