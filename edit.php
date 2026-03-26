<?php include 'koneksi.php'; ?>
<?php
$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM barang WHERE id_barang=$id");
$row = mysqli_fetch_assoc($data);
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang</title>
    <link rel="stylesheet" href="style.css" >
</head> 
<body>
<h2>EDIT BARANG</h2>
<form method="POST">
    Nama Barang: <input type="text" name="nama barang" value="<?php echo $row['nama_barang']; ?>" required><br>
    Harga: <input type="number" name="harga" value="<?php echo $row['harga']; ?>" required><br>
    Jumlah stok: <input type="number" name="jumlah_stok" value="<?php echo $row['jumlah_stok']; ?>" required><br>
    Kategori:
    <select name="id_kategori" required>
        <?php
        $kat = mysqli_query($conn, "SELECT * FROM kategori");
        while ($k = mysqli_fetch_assoc($kat)) {
            $selected = ($row['id_kategori'] == $k['id_kategori']) ? "selected" : "";
            echo "<option value='".$k['id_kategori']."' $selected>".$k['nama_kategori']."</option>";
        }
        ?>
        </select><br>
        Deskripsi: <textarea name="deskripsi" required><?php echo $row['deskripsi']; ?></textarea><br>
        Tanggal Masuk: <input type="date" name="tanggal_masuk" value="<?php echo $row['tanggal_masuk']; ?>" required><br>
        <button type="submit" name="update">Update</button>
</form>

<div id="toast" class="toast"></div>

<?php
if (isset($_POST['update'])) {
    $nama_barang = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $jumlah_stok = $_POST['jumlah_stok'];
    $id_kategori = $_POST['id_kategori'];
    $deskripsi = $_POST['deskripsi'];
    $tanggal_masuk = $_POST['tanggal_masuk'];

    $query = "UPDATE barang SET nama_barang='$nama_barang', harga='$harga', jumlah_stok='$jumlah_stok', id_kategori='$id_kategori', deskripsi='$deskripsi', tanggal_masuk='$tanggal_masuk' WHERE id_barang=$id";
    if (mysqli_query($conn, $query)) {
         echo "<script>
        const toast= document.getElementById('toast');
        toast.textContent = 'Data berhasil di update!';
        toast.className = 'toast success show';
        setTimeout(() => {
            toast.classList.remove('show');
            window.location.href = 'index.php';
        }, 2000);
    </script>";

    } else {
        echo "<script>
        const toast= document.getElementById('toast');
        toast.textContent = 'Gagal mengupdate data!';
        toast.className = 'toast error show';
        setTimeout(() => {
        toast.classList.remove('show');
         }, 2000);
         </script>";
    } 
}
?>
</body>
</html>