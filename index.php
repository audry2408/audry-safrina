<?php
session_start();
include 'koneksi.php';

$error = "";

// Proses login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $role = isset($_POST['role']) ? $_POST['role'] : '';
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if ($role === "admin") {
        // Cek ke tabel admin
        $query_admin = mysqli_query($koneksi, "SELECT * FROM admin WHERE username='$username'");
        if ($query_admin && mysqli_num_rows($query_admin) > 0) {
            $data = mysqli_fetch_assoc($query_admin);
            if ($password == $data['password']) {
                $_SESSION['admin'] = $data['id'];
                $_SESSION['username'] = $data['username'];
                header("Location: dashboard_admin.php");
                exit;
            }
        }
    } elseif ($role === "customer") {
        // Cek ke tabel customer
        $query_customer = mysqli_query($koneksi, "SELECT * FROM customer WHERE email='$username'");
        if ($query_customer && mysqli_num_rows($query_customer) > 0) {
            $data = mysqli_fetch_assoc($query_customer);
            if ($password == $data['password']) {
                $_SESSION['customer'] = $data['id'];
                $_SESSION['nama'] = $data['nama'];
                header("Location: dashboard_customer.php");
                exit;
            }
        }
    }

    $error = "Login gagal! Cek kembali role, username/email, dan password.";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | Bengkel Las Revolusi Jaya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-header text-center bg-primary text-white">
                    <h4>Login Sistem Bengkel Las</h4>
                </div>
                <div class="card-body">
                    <?php if ($error): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>

                    <form method="post">
                        <div class="mb-3">
                            <label for="role" class="form-label">Masuk sebagai</label>
                            <select name="role" class="form-select" required>
                                <option value="">-- Pilih Role --</option>
                                <option value="admin">Admin</option>
                                <option value="customer">Customer</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username / Email</label>
                            <input type="text" class="form-control" name="username" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Kata Sandi</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Masuk</button>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <small>Belum punya akun? <a href="register.php">Daftar sebagai customer</a></small>
                    <small>Belum punya akun? <a href="register.php">Daftar sebagai admin</a></small>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
