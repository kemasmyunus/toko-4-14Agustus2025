<?php
include "../koneksi.php";

$id = $_GET['id'];
mysqli_query($koneksi, "DELETE FROM gudang WHERE id_gudang='$id'");
header("Location: index.php");
?>
