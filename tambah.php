<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang</title>
    <link rel="stylesheet" href="style.css" >
</head> 
<body>
<h2>TAMBAH BARANG</h2>
<form method="POST">
    Nama Barang: <input type="text" name="nama barang" required><br>
    Harga: <input type="number" name="harga" required><br>
    Jumlah stok: <input type="number" name="jumlah_stok" required><br>
    Kategori:
    <select name="id_kategori" required>
        <?php
        $kat = mysqli_query($conn, "SELECT * FROM kategori");
        while ($k = mysqli_fetch_assoc($kat)) {
            echo "<option value='".$k['id_kategori']."'>".$k['nama_kategori']."</option>";
        }
        ?>
        </select><br>
        Deskripsi: <textarea name="deskripsi" required></textarea><br>
        Tanggal Masuk: <input type="date" name="tanggal_masuk" required><br>
        <button type="submit" name="simpan">Simpan</button>
</form>

<div id="toast" class="toast"></div>

<?php
if (isset($_POST['simpan'])) {
    $nama_barang = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $jumlah_stok = $_POST['jumlah_stok'];
    $id_kategori = $_POST['id_kategori'];
    $deskripsi = $_POST['deskripsi'];
    $tanggal_masuk = $_POST['tanggal_masuk'];

    $query = "INSERT INTO barang (nama_barang, harga, jumlah_stok, id_kategori,deskripsi, tanggal_masuk)
            VALUES ('$nama_barang', '$harga', '$jumlah_stok', '$id_kategori', '$deskripsi', '$tanggal_masuk')";
    if (mysqli_query($conn, $query)){
        echo "<script>
        const toast= document.getElementById('toast');
        toast.textContent = 'Data berhasil ditambahkan!';
        toast.className = 'toast success show';
        setTimeout(() => {
            toast.classList.remove('show');
            window.location.href = 'index.php';
        }, 2000);
    </script>";

    } else {
        echo "<script>
        const toast= document.getElementById('toast');
        toast.textContent = 'Gagal menambahkan data!';
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