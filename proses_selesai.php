<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit;
}

include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    mysqli_query($koneksi, "UPDATE pesanan SET status='Selesai' WHERE id='$id'");
}

header("Location: dashboard_admin.php");
exit;
