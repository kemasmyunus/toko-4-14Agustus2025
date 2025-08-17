<?php
include '../koneksi.php';
$id = $_GET['id'];
mysqli_query($koneksi, "DELETE FROM detail_penjualan WHERE id_detail_penjualan='$id'");
header("Location: index.php");
?>
