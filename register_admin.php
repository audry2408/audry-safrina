<?php
include 'koneksi.php';

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Cek apakah username sudah ada
    $cek = mysqli_query($koneksi, "SELECT * FROM admin WHERE username='$username'");
    if (mysqli_num_rows($cek) > 0) {
        $error = "Username sudah digunakan. Coba yang lain.";
    } else {
        // Simpan data admin baru
        $query = mysqli_query($koneksi, "INSERT INTO admin (username, password) VALUES ('$username', '$password')");
        if ($query) {
            $success = "Pendaftaran berhasil. Silakan login.";
        } else {
            $error = "Gagal menyimpan data.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Admin | Bengkel Las Revolusi Jaya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-header bg-success text-white text-center">
                    <h4>Daftar Akun Admin</h4>
                </div>
                <div class="card-body">
                    <?php if ($error): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>
                    <?php if ($success): ?>
                        <div class="alert alert-success"><?= $success ?></div>
                    <?php endif; ?>

                    <form method="post">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username Admin</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Kata Sandi</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Daftar Admin</button>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <small>Sudah punya akun? <a href="index.php">Login di sini</a></small>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
