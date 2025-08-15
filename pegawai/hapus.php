<?php
include "../koneksi.php";

$id = $_GET['id'];
mysqli_query($koneksi, "DELETE FROM pegawai WHERE id_pegawai='$id'");
header("Location: index.php");
?>
