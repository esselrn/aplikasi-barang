<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang</title>
    <link rel="stylesheet" href="style.css" >
</head> 
<body>
    <?php
    session_start();
    if (isset($_SESSION['toast'])) {
        echo "<div id = 'toast' class = 'toast show'>".$_SESSION['toast']."</div>";
        unset($_SESSION['toast']);
    }
    ?>

    <h2 align="center">DAFTAR BARANG</h2>
    <a href="dashboard.php" class="btn btn-dash">Dashboard</a>
    <a href="tambah.php" class="btn btn-add">Tambah Barang</a>
    <table border="1" cellpadding="5">
        <tr>
            <th>No.</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Jumlah Stok</th>
            <th>Kategori</th>
            <th>Deskripsi</th>
            <th>Tanggal Masuk</th>
            <th>Aksi</th>
        </tr>
        <?php
        $no = 1;
        $sql = "SELECT barang.*, kategori.nama_kategori 
        FROM barang 
        JOIN kategori ON barang.id_kategori = kategori.id_kategori";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
            <td>".$no++."</td>
            <td>".$row['nama_barang']."</td>
            <td>".$row['harga']."</td>
            <td>".$row['jumlah_stok']."</td>
            <td>".$row['nama_kategori']."</td>
            <td>".$row['deskripsi']."</td>
            <td>".$row['tanggal_masuk']."</td>
            <td>
            <a href='edit.php?id=".$row['id_barang']."' class ='btn btn-edit'>Edit</a> |
            <a href='hapus.php?id=".$row['id_barang']."' class ='btn btn-delete' onclick=\"return confirm('Yakin hapus?')\">Hapus</a>
        </td>
        </tr>";
     }
?>
</table>
<script>
    const toast = document.getElementById('toast');
    if (toast) {
        setTimeout(() => {
            toast.classList.remove('show');
        }, 2000);
    }
</script>
</body>
</html>