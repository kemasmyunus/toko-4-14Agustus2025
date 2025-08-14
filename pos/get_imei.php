<?php
include "../koneksi.php";
$id_barang = $_GET['id_barang'] ?? 0;
$q = mysqli_query($koneksi, "SELECT imei_sn FROM stok_sn WHERE id_barang='$id_barang' AND status='tersedia'");
$list = [];
while($d = mysqli_fetch_assoc($q)){
    $list[] = $d['imei_sn'];
}
echo implode("\n", $list);
