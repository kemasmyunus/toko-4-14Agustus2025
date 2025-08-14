<?php
include "../koneksi.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);
$pelanggan = $_POST['pelanggan'];
$pegawai = $_POST['pegawai'];
$metode = $_POST['metode'];
$diskon = $_POST['diskon'];
$bayar = $_POST['bayar'];
$sisa = $_POST['sisa'];
$keranjang = json_decode($_POST['keranjang'], true);
$tanggal = date("Y-m-d H:i:s");

$total = 0;
foreach($keranjang as $b){
    $total += $b['harga_jual_default'] * $b['jumlah'];
}

mysqli_query($koneksi, "INSERT INTO penjualan 
(tanggal_penjualan, id_pelanggan, id_pegawai, metode_pembayaran, total, diskon, subtotal, sisa_bayar) 
VALUES 
('$tanggal', '$pelanggan', '$pegawai', '$metode', '$total', '$diskon', ($total - $diskon), '$sisa')");

$id_penjualan = mysqli_insert_id($koneksi);

foreach($keranjang as $b){
    $id_barang = $b['id_barang'];
    $jumlah = $b['jumlah'];
    $harga = $b['harga_jual_default'];
    $total_item = $harga * $jumlah;
    $imei = $b['imei_sn'];

    mysqli_query($koneksi, "INSERT INTO detail_penjualan 
    (id_penjualan, id_barang, imei_sn, jumlah, harga_jual, potongan1, potongan2, potongan3, total_setelah_potongan) 
    VALUES 
    ('$id_penjualan', '$id_barang', '$imei', '$jumlah', '$harga', 0, 0, 0, '$total_item')");

    // Update stok biasa
    mysqli_query($koneksi, "UPDATE stok SET jumlah = jumlah - $jumlah WHERE id_barang = '$id_barang'");

    // Update stok IMEI
    if(!empty($imei)){
        mysqli_query($koneksi, "UPDATE stok_sn SET status='terjual' WHERE imei_sn='$imei' AND id_barang='$id_barang'");
    }
}

echo "Transaksi berhasil disimpan!";
