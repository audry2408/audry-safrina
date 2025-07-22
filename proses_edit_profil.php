<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['customer'])) {
    header("Location: index.php");
    exit;
}

// Validasi data
$id = $_POST['id'];
$nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
$email = mysqli_real_escape_string($koneksi, $_POST['email']);
$alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
$no_hp = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
$password = $_POST['password'];

// Cek apakah password diisi
if (!empty($password)) {
    $password = mysqli_real_escape_string($koneksi, $password);
    $query = "UPDATE customer SET 
                nama='$nama',
                email='$email',
                alamat='$alamat',
                no_hp='$no_hp',
                password='$password'
              WHERE id='$id'";
} else {
    $query = "UPDATE customer SET 
                nama='$nama',
                email='$email',
                alamat='$alamat',
                no_hp='$no_hp'
              WHERE id='$id'";
}

$update = mysqli_query($koneksi, $query);

if ($update) {
    $_SESSION['nama'] = $nama;
    header("Location: profil_customer.php?status=berhasil");
    exit;
} else {
    echo "Gagal mengupdate profil: " . mysqli_error($koneksi);
}
