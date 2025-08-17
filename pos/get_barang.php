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
    echo "";
}
?>
