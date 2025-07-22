<?php
session_start();
if (!isset($_SESSION['customer'])) {
    header("Location: index.php");
    exit;
}
include 'koneksi.php';

$id_customer = $_SESSION['customer'];
$query = mysqli_query($koneksi, "SELECT * FROM pesanan WHERE id_customer='$id_customer' ORDER BY tanggal DESC");

if (!$query) {
    die("Query gagal: " . mysqli_error($koneksi));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h3 class="mb-4">Daftar Pesanan Saya</h3>
    <a href="dashboard_customer.php" class="btn btn-secondary mb-3">← Kembali</a>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Jenis Layanan</th>
                    <th>Deskripsi</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($query) > 0): 
                    $no = 1;
                    while ($data = mysqli_fetch_assoc($query)): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($data['layanan']) ?></td>
                        <td><?= nl2br(htmlspecialchars($data['deskripsi'])) ?></td>
                        <td><?= $data['tanggal'] ?></td>
                        <td><span class="badge bg-secondary"><?= $data['status'] ?></span></td>
                    </tr>
                <?php endwhile; else: ?>
                    <tr>
                        <td colspan="5" class="text-center">Belum ada pesanan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
