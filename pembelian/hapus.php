<?php
include "../koneksi.php";

$id = $_GET['id'];
$sql = "DELETE FROM pembelian WHERE id_pembelian='$id'";
mysqli_query($koneksi, $sql);

header("Location: index.php");
