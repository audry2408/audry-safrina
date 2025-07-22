<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['customer'])) {
    header("Location: index.php");
    exit;
}

$id = $_SESSION['customer'];
$query = mysqli_query($koneksi, "SELECT * FROM customer WHERE id='$id'");
if (!$query) {
    die("Gagal mengambil data: " . mysqli_error($koneksi));
}
$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="dashboard_customer.php">Customer | Revolusi Jaya</a>
    <div>
        <a href="logout.php" class="btn btn-sm btn-light">Logout</a>
    </div>
  </div>
</nav>

<div class="container mt-5">
    <h3>Edit Profil</h3>
    <form method="post" action="proses_edit_profil.php">
        <input type="hidden" name="id" value="<?= $data['id'] ?>">
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($data['nama']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($data['email']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control" required><?= htmlspecialchars($data['alamat']) ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">No HP</label>
            <input type="text" name="no_hp" class="form-control" value="<?= htmlspecialchars($data['no_hp']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Kata Sandi Baru <small class="text-muted">(kosongkan jika tidak ingin ubah)</small></label>
            <input type="password" name="password" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        <a href="profil_customer.php" class="btn btn-secondary">Batal</a>
    </form>
</div>

</body>
</html>
