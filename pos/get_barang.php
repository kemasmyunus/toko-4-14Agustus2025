<?php
include "../koneksi.php";
$kode = $_GET['kode'];

$q = mysqli_query($koneksi, "SELECT * FROM barang WHERE kode_barang='$kode' OR sku='$kode'");
if(mysqli_num_rows($q) > 0){
    $barang = mysqli_fetch_assoc($q);
    
    // Ambil potongan barang
    $pot = mysqli_query($koneksi, "SELECT nama_potongan, nilai_potongan 
                                   FROM potongan_barang 
                                   WHERE id_barang={$barang['id_barang']}");
    $potongan = [];
    while($p = mysqli_fetch_assoc($pot)){
        $potongan[] = $p;
    }

    $barang['potongan_list'] = $potongan;

    echo json_encode($barang);
} else {
    echo "";
}
?>
