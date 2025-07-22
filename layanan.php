<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit;
}
include 'koneksi.php';

// Tambah layanan
if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    mysqli_query($koneksi, "INSERT INTO layanan (nama, harga) VALUES ('$nama', '$harga')");
    header("Location: layanan.php");
    exit;
}

// Hapus layanan
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM layanan WHERE id = '$id'");
    header("Location: layanan.php");
    exit;
}

$layanan = mysqli_query($koneksi, "SELECT * FROM layanan ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Layanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h3>Data Layanan Bengkel</h3>
    <form method="post" class="row g-2 mt-3 mb-4">
        <div class="col-md-5">
            <input type="text" name="nama" class="form-control" placeholder="Nama Layanan" required>
        </div>
        <div class="col-md-4">
            <input type="number" name="harga" class="form-control" placeholder="Harga (Rp)" required>
        </div>
        <div class="col-md-3">
            <button type="submit" name="tambah" class="btn btn-primary w-100">Tambah</button>
        </div>
    </form>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Layanan</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; while ($row = mysqli_fetch_assoc($layanan)) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['nama']) ?></td>
                <td>Rp<?= number_format($row['harga']) ?></td>
                <td>
                    <a href="?hapus=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus layanan ini?')">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
