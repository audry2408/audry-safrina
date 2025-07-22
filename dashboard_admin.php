<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit;
}
$nama = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - Revolusi Jaya Mandiri</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.2rem;
        }

        .card-hover:hover {
            box-shadow: 0 0 15px rgba(0,0,0,0.15);
            transform: translateY(-5px);
            transition: 0.3s ease-in-out;
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: 600;
        }

        .welcome-text {
            font-size: 1.25rem;
            margin-bottom: 25px;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <span class="navbar-brand">Admin | Revolusi Jaya Mandiri</span>
        <div class="d-flex">
            <a href="logout.php" class="btn btn-sm btn-outline-light">Logout</a>
        </div>
    </div>
</nav>

<!-- Konten -->
<div class="container py-5">
    <div class="text-center mb-4">
        <h2>Dashboard Admin</h2>
        <p class="welcome-text">Halo, <strong><?= htmlspecialchars($nama) ?></strong> 👋 Selamat datang di panel admin.</p>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4">

        <!-- Kelola Pesanan -->
        <div class="col">
            <div class="card border-primary card-hover h-100">
                <div class="card-body text-center">
                    <h5 class="card-title text-primary">Kelola Pesanan</h5>
                    <p class="card-text">Lihat dan kelola semua pesanan yang masuk dari customer.</p>
                    <a href="kelola_pesanan.php" class="btn btn-primary w-100">Masuk</a>
                </div>
            </div>
        </div>

        <!-- Kelola Layanan -->
        <div class="col">
            <div class="card border-success card-hover h-100">
                <div class="card-body text-center">
                    <h5 class="card-title text-success">Kelola Layanan</h5>
                    <p class="card-text">Tambah, edit, dan hapus daftar layanan bengkel.</p>
                    <a href="layanan.php" class="btn btn-success w-100">Masuk</a>
                </div>
            </div>
        </div>

        <!-- Data Customer -->
        <div class="col">
            <div class="card border-info card-hover h-100">
                <div class="card-body text-center">
                    <h5 class="card-title text-info">Data Customer</h5>
                    <p class="card-text">Lihat profil customer yang terdaftar di sistem.</p>
                    <a href="profil_customer.php" class="btn btn-info w-100">Lihat Data</a>
                </div>
            </div>
        </div>

        <!-- Cetak Laporan -->
        <div class="col">
            <div class="card border-warning card-hover h-100">
                <div class="card-body text-center">
                    <h5 class="card-title text-warning">Cetak Laporan</h5>
                    <p class="card-text">Unduh laporan pesanan & pengerjaan untuk keperluan administrasi.</p>
                    <a href="laporan.php" target="_blank" class="btn btn-warning w-100">Cetak</a>
                </div>
            </div>
        </div>

        <!-- Riwayat Pengerjaan -->
        <div class="col">
            <div class="card border-secondary card-hover h-100">
                <div class="card-body text-center">
                    <h5 class="card-title text-secondary">Riwayat Pengerjaan</h5>
                    <p class="card-text">Lihat riwayat semua pekerjaan yang sudah selesai.</p>
                    <a href="riwayat_pengerjaan_admin.php" class="btn btn-secondary w-100">Lihat</a>
                </div>
            </div>
        </div>

    </div>
</div>

</body>
</html>
