<?php
$koneksi = mysqli_connect("localhost", "root", "", "revolusi_jaya");
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
