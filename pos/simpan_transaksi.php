<?php
include "../koneksi.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);
$pelanggan = $_POST['pelanggan'];
$pegawai = $_POST['pegawai'];
$metode = $_POST['metode'];
$bayar = $_POST['bayar'];
$sisa = $_POST['sisa'];
$keranjang = json_decode($_POST['keranjang'], true);
$tanggal = date("Y-m-d H:i:s");

$total = 0;
$total_potongan = 0;
foreach($keranjang as $b){
    $total += $b['harga_jual_default'] * $b['jumlah'];
    $total_potongan += $b['total_potongan'] * $b['jumlah'];
}
$subtotal = $total - $total_potongan;

mysqli_query($koneksi, "INSERT INTO penjualan 
(tanggal_penjualan, id_pelanggan, id_pegawai, metode_pembayaran, total, diskon, subtotal, sisa_bayar) 
VALUES 
('$tanggal', '$pelanggan', '$pegawai', '$metode', '$total', '$total_potongan', '$subtotal', '$sisa')");

$id_penjualan = mysqli_insert_id($koneksi);

// Simpan ke tabel rekonsiliasi
$status_pembayaran = ($sisa == 0) ? 'lunas' : 'belum lunas';
mysqli_query($koneksi, "INSERT INTO rekonsiliasi 
(id_penjualan, metode_pembayaran, tanggal_transaksi, status_pembayaran, nominal) 
VALUES 
('$id_penjualan', '$metode', '$tanggal', '$status_pembayaran', '$subtotal')");

foreach($keranjang as $b){
    $id_barang = $b['id_barang'];
    $jumlah = $b['jumlah'];
    $harga = $b['harga_jual_default'];
    $total_item = $harga * $jumlah;
    $imei = $b['imei_sn'];
    $sn = $b['sn'];

    // Ambil potongan (maks 3)
    $pot1 = $pot2 = $pot3 = 0;
    if(isset($b['potongan_list']) && is_array($b['potongan_list'])){
        if(isset($b['potongan_list'][0]['nilai_potongan'])) $pot1 = $b['potongan_list'][0]['nilai_potongan'];
        if(isset($b['potongan_list'][1]['nilai_potongan'])) $pot2 = $b['potongan_list'][1]['nilai_potongan'];
        if(isset($b['potongan_list'][2]['nilai_potongan'])) $pot3 = $b['potongan_list'][2]['nilai_potongan'];
    }
    $total_potongan_item = $pot1 + $pot2 + $pot3;
    $total_setelah_potongan = ($harga * $jumlah) - ($total_potongan_item * $jumlah);

    mysqli_query($koneksi, "INSERT INTO detail_penjualan 
    (id_penjualan, id_barang, imei_sn, jumlah, harga_jual, potongan1, potongan2, potongan3, total_setelah_potongan) 
    VALUES 
    ('$id_penjualan', '$id_barang', '$imei', '$jumlah', '$harga', '$pot1', '$pot2', '$pot3', '$total_setelah_potongan')");

    if($sn == "1"){
        // Update stok IMEI/SN
        if(!empty($imei)){
            mysqli_query($koneksi, "UPDATE stok_sn SET status='terjual' WHERE imei_sn='$imei' AND id_barang='$id_barang'");
        }
        // Tidak update stok biasa
    } else {
        // Update stok biasa
        mysqli_query($koneksi, "UPDATE stok SET jumlah = jumlah - $jumlah WHERE id_barang = '$id_barang'");
    }
}

echo "Transaksi berhasil disimpan!";
