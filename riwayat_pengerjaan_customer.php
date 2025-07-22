<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['customer'])) {
    header("Location: index.php");
    exit;
}
$query = "SELECT p.id_pesanan, l.nama_layanan, p.tanggal_pesan, p.status, p.catatan_admin
          FROM pesanan p 
          JOIN layanan l ON p.id_layanan = l.id_layanan 
          ORDER BY p.tanggal_pesan DESC";

$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Pengerjaan - Customer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f8f9fa;
        }
        .navbar-brand {
            font-weight: bold;
        }
        .badge-status {
            font-size: 0.9em;
        }
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.08);
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid justify-content-between">
        <span class="navbar-brand">Revolusi Jaya Mandiri</span>
        <a href="dashboard_customer.php" class="btn btn-outline-light btn-sm">Kembali ke Dashboard</a>
    </div>
</nav>

<!-- Konten -->
<div class="container mt-5">
    <h3 class="mb-4 text-center">Riwayat Pengerjaan Anda</h3>

    <?php if ($result && mysqli_num_rows($result) > 0): ?>
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>No</th>
                        <th>Layanan</th>
                        <th>Tanggal Pesan</th>
                        <th>Status</th>
                        <th>Catatan Admin</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td><?= htmlspecialchars($row['nama_layanan']) ?></td>
                            <td class="text-center"><?= date("d-m-Y", strtotime($row['tanggal_pesan'])) ?></td>
                            <td class="text-center">
                                <span class="badge badge-status 
                                    <?= $row['status'] == 'Selesai' ? 'bg-success' : 
                                         ($row['status'] == 'Diproses' ? 'bg-warning text-dark' : 
                                         ($row['status'] == 'Dibatalkan' ? 'bg-danger' : 'bg-secondary')) ?>">
                                    <?= $row['status'] ?>
                                </span>
                            </td>
                            <td><?= $row['catatan_admin'] ? htmlspecialchars($row['catatan_admin']) : '-' ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-info text-center">Belum ada pengerjaan yang tercatat.</div>
    <?php endif; ?>
</div>

</body>
</html>
