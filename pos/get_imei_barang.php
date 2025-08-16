<?php
include "../koneksi.php";
$imei = $_GET['imei'] ?? '';
if(!$imei) { echo ""; exit; }
$q = mysqli_query($koneksi, "SELECT * FROM stok_sn WHERE imei_sn='$imei' AND status='tersedia' LIMIT 1");
if(mysqli_num_rows($q) > 0){
    $stok_sn = mysqli_fetch_assoc($q);
    $barang = mysqli_query($koneksi, "SELECT * FROM barang WHERE id_barang='{$stok_sn['id_barang']}' LIMIT 1");
    if(mysqli_num_rows($barang) > 0){
        $b = mysqli_fetch_assoc($barang);
        // Ambil potongan
        $pot = mysqli_query($koneksi, "SELECT nama_potongan, nilai_potongan 
                                       FROM potongan_barang 
                                       WHERE id_barang={$b['id_barang']}");
        $potongan = [];
        while($p = mysqli_fetch_assoc($pot)){
            $potongan[] = $p;
        }
        $b['potongan_list'] = $potongan;
        echo json_encode(['barang'=>$b, 'stok_sn'=>$stok_sn]);
        exit;
    }
}
echo "";
?>
