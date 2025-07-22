<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $telepon = $_POST['telepon'];
    $alamat = $_POST['alamat'];

    // Cek apakah email sudah terdaftar
    $cek = mysqli_query($koneksi, "SELECT * FROM customer WHERE email='$email'");
    if (mysqli_num_rows($cek) > 0) {
        $error = "Email sudah terdaftar!";
    } else {
        // Simpan ke database customer
        $query = "INSERT INTO customer (nama, email, password, telepon, alamat) 
                  VALUES ('$nama', '$email', '$password', '$telepon', '$alamat')";
        if (mysqli_query($koneksi, $query)) {
            header("Location: index.php?success=registrasi_berhasil");
            exit;
        } else {
            $error = "Gagal mendaftar. Silakan coba lagi.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi Customer - Bengkel Las</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-success text-white text-center">
                    <h4>Daftar Akun Customer</h4>
                </div>
                <div class="card-body">
                    <?php if (isset($error)) : ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label>Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>No. Telepon</label>
                            <input type="text" name="telepon" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Daftar</button>
                        <p class="mt-3 text-center">Sudah punya akun? <a href="index.php">Login di sini</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
