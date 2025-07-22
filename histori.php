<?php
session_start();
if (!isset($_SESSION['customer'])) {
    header("Location: index.php");
    exit;
}

include 'koneksi.php';

$id_customer = $_SESSION['customer'];

$pesanan = mysqli_query($koneksi, "
    SELECT pesanan.*, layanan.nama_layanan
    FROM pesanan
    JOIN layanan ON pesanan.id_layanan = layanan.id
    WHERE id_customer = $id_customer
    ORDER BY tanggal_pesan DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h3>Riwayat Pesanan Anda</h3>
    <a href="dashboard_customer.php" class="btn btn-secondary mb-3">Kembali ke Dashboard</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Layanan</th>
                <th>Tanggal Pesan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($pesanan)) : ?>
                <tr>
                    <td><?= $row['nama_layanan'] ?></td>
                    <td><?= $row['tanggal_pesan'] ?></td>
                    <td><span class="badge bg-<?= 
                        $row['status'] === 'pending' ? 'warning' : 
                        ($row['status'] === 'proses' ? 'primary' : 'success') ?>">
                        <?= ucfirst($row['status']) ?>
                    </span></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>
