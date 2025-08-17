<?php
include "../koneksi.php";

$id = $_GET['id'];
$sql = "DELETE FROM detail_pembelian WHERE id_detail_pembelian='$id'";
mysqli_query($koneksi, $sql);

header("Location: index.php");
