<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit;
}

include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = mysqli_query($koneksi, "SELECT * FROM pesanan WHERE id = $id");
    $data = mysqli_fetch_assoc($query);

    if (!$data) {
        echo "Data pesanan tidak ditemukan.";
        exit;
    }
} else {
    echo "ID pesanan tidak valid.";
    exit;
}

if (isset($_POST['simpan'])) {
    $status = $_POST['status'];
    $keterangan = $_POST['keterangan'];

    $update = mysqli_query($koneksi, "UPDATE pesanan SET status='$status', keterangan='$keterangan' WHERE id=$id");

    if ($update) {
        header("Location: kelola_pesanan.php");
        exit;
    } else {
        echo "Gagal mengupdate status.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Ubah Status Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h3>Ubah Status Pesanan</h3>
    <form method="post">
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-select" required>
                <option value="Menunggu" <?= ($data['status'] == 'Menunggu') ? 'selected' : '' ?>>Menunggu</option>
                <option value="Diproses" <?= ($data['status'] == 'Diproses') ? 'selected' : '' ?>>Diproses</option>
                <option value="Selesai" <?= ($data['status'] == 'Selesai') ? 'selected' : '' ?>>Selesai</option>
                <option value="Dibatalkan" <?= ($data['status'] == 'Dibatalkan') ? 'selected' : '' ?>>Dibatalkan</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan (Opsional)</label>
            <textarea name="keterangan" class="form-control"><?= htmlspecialchars($data['keterangan']) ?></textarea>
        </div>

        <button type="submit" name="simpan" class="btn btn-primary">Simpan Perubahan</button>
        <a href="kelola_pesanan.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

</body>
</html>
