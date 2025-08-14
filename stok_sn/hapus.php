<?php
require '../koneksi.php';

$id = $_GET['id'] ?? '';
if (!$id) {
    die("ID tidak ditemukan");
}

$hapus = mysqli_query($koneksi, "DELETE FROM stok_sn WHERE id_stok_sn='$id'");
if ($hapus) {
    header('Location: index.php');
    exit;
} else {
    echo "Gagal hapus: " . mysqli_error($koneksi);
}
