<?php
include 'koneksi.php';
session_start();

$id = $_GET['id'];

if (mysqli_query($conn, "DELETE FROM barang WHERE id_barang = $id")) {
    $_SESSION['toast'] = "Data berhasil dihapus!";
} else {
    $_SESSION['toast'] = "Gagal menghapus data!";
}

header("Location: index.php");
exit();
?>