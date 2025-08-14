<?php
include "../koneksi.php";
$kode = $_GET['kode'] ?? '';
$q = mysqli_query($koneksi, "SELECT id_barang, kode_barang, sku, nama_barang, harga_jual_default,
    (SELECT COUNT(*) FROM stok_sn WHERE id_barang=barang.id_barang AND status='tersedia') AS stok_sn
    FROM barang
    WHERE kode_barang='$kode' OR sku='$kode' LIMIT 1");

if(mysqli_num_rows($q) > 0){
    $barang = mysqli_fetch_assoc($q);
    $barang['imei_required'] = ($barang['stok_sn'] > 0);
    echo json_encode($barang);
} else {
    echo "";
}
