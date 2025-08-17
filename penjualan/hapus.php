<?php
include "../koneksi.php";

$id = $_GET['id'] ?? 0;

if ($id) {
    $sql = "DELETE FROM penjualan WHERE id_penjualan='$id'";
    if (mysqli_query($koneksi, $sql)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
} else {
    echo "ID tidak valid!";
}
