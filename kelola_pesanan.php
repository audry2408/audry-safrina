<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit;
}

include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Pesanan - Admin | Revolusi Jaya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="dashboard_admin.php">Admin | Revolusi Jaya</a>
    <div>
      <a href="logout.php" class="btn btn-sm btn-light">Logout</a>
    </div>
  </div>
</nav>

<div class="container mt-4">
    <h3 class="mb-4">Kelola Pesanan</h3>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Nama Customer</th>
                    <th>Layanan</th>
                    <th>Deskripsi</th>
                    <th>Tanggal Pesan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = mysqli_query($koneksi, "SELECT pesanan.*, customer.nama FROM pesanan 
                                 JOIN customer ON pesanan.id_customer = customer.id 
                                 ORDER BY pesanan.tanggal DESC");


                if ($query && mysqli_num_rows($query) > 0) {
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($query)) {
                        echo "<tr>";
                        echo "<td>$no</td>";
                        echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['layanan']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['deskripsi']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['tanggal_pesan']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                        echo "</tr>";
                        $no++;
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>Belum ada data pesanan.</td></tr>";
                    if (!$query) {
                        echo "<tr><td colspan='6' class='text-danger'>Query Error: " . mysqli_error($koneksi) . "</td></tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
