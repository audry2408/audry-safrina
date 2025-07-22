<?php
session_start();
if (!isset($_SESSION['customer'])) {
    header("Location: index.php");
    exit;
}

include 'koneksi.php';
$nama = $_SESSION['nama'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Customer | Revolusi Jaya Mandiri</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="#">Revolusi Jaya Mandiri</a>
    <div class="d-flex">
      <span class="text-white me-3 fw-semibold">Customer: <?= htmlspecialchars($nama) ?></span>
      <a href="logout.php" class="btn btn-sm btn-light">Logout</a>
    </div>
  </div>
</nav>

<!-- Konten Utama -->
<div class="container mt-5">
    <div class="text-center mb-4">
        <h3>Selamat datang, <?= htmlspecialchars($nama) ?> 👋</h3>
        <p class="text-muted">Silakan pilih menu di bawah ini untuk mengelola layanan Anda.</p>
        <hr>
    </div>

    <div class="row justify-content-center g-4">
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Pesan Layanan</h5>
                    <p class="card-text text-muted">Ajukan permintaan baru untuk layanan bengkel las.</p>
                    <a href="pesan_layanan.php" class="btn btn-primary w-100">Buat Pesanan</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Lihat Pesanan</h5>
                    <p class="card-text text-muted">Pantau status pesanan yang sedang diproses.</p>
                    <a href="lihat_pesanan.php" class="btn btn-info w-100">Lihat Pesanan</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Riwayat Pengerjaan</h5>
                    <p class="card-text text-muted">Lihat histori layanan yang telah selesai dikerjakan.</p>
                    <a href="riwayat_pengerjaan_customer.php" class="btn btn-success w-100">Riwayat Pengerjaan</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="text-center mt-5 mb-3 text-muted small">
    &copy; <?= date("Y") ?> Bengkel Las Revolusi Jaya Mandiri
</footer>

</body>
</html>
