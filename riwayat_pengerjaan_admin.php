<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit;
}

include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Pengerjaan | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Admin - Revolusi Jaya</a>
    <div>
      <a href="dashboard_admin.php" class="btn btn-light btn-sm">Dashboard</a>
      <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
    </div>
  </div>
</nav>

<div class="container mt-4">
    <h3>Riwayat Semua Pengerjaan (Selesai)</h3>
    <hr>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Customer</th>
                <th>Layanan</th>
                <th>Tanggal</th>
                <th>Deskripsi</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = mysqli_query($koneksi, "SELECT pesanan.*, customer.nama AS nama_customer, layanan.nama_layanan 
                                             FROM pesanan 
                                             JOIN customer ON pesanan.id_customer = customer.id 
                                             JOIN layanan ON pesanan.id_layanan = layanan.id 
                                             WHERE pesanan.status = 'Selesai'
                                             ORDER BY pesanan.tanggal DESC");

            if ($query && mysqli_num_rows($query) > 0):
                $no = 1;
                while ($row = mysqli_fetch_assoc($query)):
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($row['nama_customer']) ?></td>
                    <td><?= htmlspecialchars($row['nama_layanan']) ?></td>
                    <td><?= htmlspecialchars($row['tanggal']) ?></td>
                    <td><?= nl2br(htmlspecialchars($row['deskripsi'])) ?></td>
                    <td><?= nl2br(htmlspecialchars($row['keterangan'])) ?></td>
                </tr>
            <?php
                endwhile;
            else:
            ?>
                <tr>
                    <td colspan="6" class="text-center">Belum ada riwayat pengerjaan selesai.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>
