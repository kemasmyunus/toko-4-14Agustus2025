<?php
include "../koneksi.php";

if (isset($_POST['simpan'])) {
    $kode_barang = $_POST['kode_barang'];
    $sku         = $_POST['sku'];
    $nama_barang = $_POST['nama_barang'];
    $varian      = $_POST['varian'];
    $brand       = $_POST['brand'];
    $kategori    = $_POST['kategori'];
    $harga_jual  = $_POST['harga_jual_default'];

    $query = mysqli_query($koneksi, "INSERT INTO barang (kode_barang, sku, nama_barang, varian, brand, kategori, harga_jual_default)
                                     VALUES ('$kode_barang', '$sku', '$nama_barang', '$varian', '$brand', '$kategori', '$harga_jual')");

    if ($query) {
        header("Location: index.php");
    } else {
        echo "Gagal menambah data: " . mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Barang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Tambah Barang</h2>
    <form method="post">
        Kode Barang: <input type="text" name="kode_barang" required><br>
        SKU: <input type="text" name="sku" required><br>
        Nama Barang: <input type="text" name="nama_barang" required><br>
        Varian: <input type="text" name="varian"><br>
        Brand: <input type="text" name="brand"><br>
        Kategori: <input type="text" name="kategori"><br>
        Harga Jual: <input type="number" name="harga_jual_default" required><br>
        <button type="submit" name="simpan">Simpan</button>
    </form>
</body>
</html>
