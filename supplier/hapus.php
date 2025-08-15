<?php
include "../koneksi.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

$id = $_GET['id'];
$query = mysqli_query($koneksi, "DELETE FROM supplier WHERE id_supplier='$id'");
if (!$query) {
    die("Query hapus gagal: " . mysqli_error($koneksi));
}

header("Location: index.php");
?>
