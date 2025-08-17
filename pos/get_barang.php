<?php
include "../koneksi.php";
$kode = $_GET['kode'];

$q = mysqli_query($koneksi, "SELECT * FROM barang WHERE kode_barang='$kode' OR sku='$kode'");
if(mysqli_num_rows($q) > 0){
    $barang = mysqli_fetch_assoc($q);
    // Pastikan field sn selalu string
    $barang['sn'] = isset($barang['sn']) ? (string)$barang['sn'] : "0";
    $barang['is_sn'] = ($barang['sn'] === "1") ? 1 : 0;

    // Ambil potongan barang
    $pot = mysqli_query($koneksi, "SELECT nama_potongan, nilai_potongan 
                                   FROM potongan_barang 
                                   WHERE id_barang={$barang['id_barang']}");
    $potongan = [];
    while($p = mysqli_fetch_assoc($pot)){
        $potongan[] = $p;
    }
    $barang['potongan_list'] = $potongan;

    if($barang['sn'] === "0") {
        // Cek stok
        $stok = mysqli_query($koneksi, "SELECT jumlah FROM stok WHERE id_barang='{$barang['id_barang']}' AND jumlah > 0");
        if(mysqli_num_rows($stok) == 0){
            echo ""; // Barang tidak ada di stok
            exit;
        }
    }
    echo json_encode($barang);
} else {
    // Jika tidak ditemukan di barang, cek ke stok_sn (IMEI/SN)
    $imei = $_GET['kode'];
    $q_sn = mysqli_query($koneksi, "SELECT * FROM stok_sn WHERE imei_sn='$imei' AND status='tersedia' LIMIT 1");
    if(mysqli_num_rows($q_sn) > 0){
        $stok_sn = mysqli_fetch_assoc($q_sn);
        $barang = mysqli_query($koneksi, "SELECT * FROM barang WHERE id_barang='{$stok_sn['id_barang']}' LIMIT 1");
        if(mysqli_num_rows($barang) > 0){
            $b = mysqli_fetch_assoc($barang);
            // Ambil potongan barang
            $pot = mysqli_query($koneksi, "SELECT nama_potongan, nilai_potongan 
                                           FROM potongan_barang 
                                           WHERE id_barang={$b['id_barang']}");
            $potongan = [];
            while($p = mysqli_fetch_assoc($pot)){
                $potongan[] = $p;
            }
            $b['potongan_list'] = $potongan;
            $b['sn'] = isset($b['sn']) ? (string)$b['sn'] : "0";
            $b['is_sn'] = ($b['sn'] === "1") ? 1 : 0;
            echo json_encode(['barang'=>$b, 'stok_sn'=>$stok_sn]);
            exit;
        }
    }
    echo "";
}
?>
