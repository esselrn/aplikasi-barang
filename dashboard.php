<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'koneksi.php';

$result_total = mysqli_query($conn, "SELECT COUNT(*) AS total FROM barang");
$total = mysqli_fetch_assoc($result_total)['total'];

$result_recent = mysqli_query($conn, "SELECT * FROM barang ORDER BY id_barang DESC LIMIT 5");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="dashboard.css" >
</head>
  <body>
            <h1 align="center">Selamat Datang, <?php echo $_SESSION['username']; ?></h1>

            <p><b>Total Barang :</b> <?php echo $total; ?></p>

            <h3>Barang Terbaru :</h3>
            <table border="1" cellpadding="8" cellspacing="0">
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                </tr>
                <?php
                $no = 1;
                while($row = mysqli_fetch_assoc($result_recent)) { ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $row['nama_barang'];?></td>
                    <td><?php echo $row['harga'];?></td>
                </tr>
           <?php } ?>
            </table>

            <br>
            <a href="index.php">Kelola Data Barang</a>
            <a href="tambah.php">Tambah Barang</a>
            <a href="logout.php">Logout</a>
        </body>
</html>