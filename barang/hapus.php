<?php
include "../koneksi.php";

$id = $_GET['id'];
$hapus = mysqli_query($koneksi, "DELETE FROM barang WHERE id_barang='$id'");

if ($hapus) {
    header("Location: index.php");
} else {
    echo "Gagal menghapus data: " . mysqli_error($koneksi);
}
?>
