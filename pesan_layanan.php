<?php
session_start();
if (!isset($_SESSION['customer'])) {
    header("Location: index.php");
    exit;
}
include 'koneksi.php';

$id_customer = $_SESSION['customer'];
$success = "";
$error = "";

// Proses submit pesanan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $layanan = $_POST['layanan'];
    $deskripsi = $_POST['deskripsi'];
    $tanggal = date('Y-m-d');

    $query = mysqli_query($koneksi, "INSERT INTO pesanan (id_customer, layanan, deskripsi, tanggal, status) VALUES ('$id_customer', '$layanan', '$deskripsi', '$tanggal', 'Menunggu')");

    if ($query) {
        $success = "Pesanan berhasil dikirim!";
    } else {
        $error = "Gagal mengirim pesanan.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Buat Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h3 class="mb-4">Form Buat Pesanan</h3>

    <?php if ($success): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php elseif ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label class="form-label">Jenis Layanan</label>
            <input type="text" name="layanan" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Deskripsi Pekerjaan</label>
            <textarea name="deskripsi" class="form-control" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Kirim Pesanan</button>
        <a href="dashboard_customer.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
