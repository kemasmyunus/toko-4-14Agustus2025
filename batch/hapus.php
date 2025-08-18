<?php
include "../koneksi.php";
$id = $_GET['id'] ?? '';
if (!$id) die("ID tidak ditemukan.");

$hapus = mysqli_query($koneksi, "DELETE FROM detail_pembelian WHERE id_detail='$id'");
if ($hapus) {
    header("Location: index.php");
    exit;
} else {
    echo "Gagal hapus batch: " . mysqli_error($koneksi);
}
?>
