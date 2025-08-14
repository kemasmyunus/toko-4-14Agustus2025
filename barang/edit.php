<?php
include "../koneksi.php";

$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM barang WHERE id_barang='$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    die("Data tidak ditemukan.");
}

if (isset($_POST['update'])) {
    $kode_barang = $_POST['kode_barang'];
    $sku         = $_POST['sku'];
    $nama_barang = $_POST['nama_barang'];
    $varian      = $_POST['varian'];
    $brand       = $_POST['brand'];
    $kategori    = $_POST['kategori'];
    $harga_jual  = $_POST['harga_jual_default'];

    $update = mysqli_query($koneksi, "UPDATE barang SET 
                                        kode_barang='$kode_barang',
                                        sku='$sku',
                                        nama_barang='$nama_barang',
                                        varian='$varian',
                                        brand='$brand',
                                        kategori='$kategori',
                                        harga_jual_default='$harga_jual'
                                      WHERE id_barang='$id'");

    if ($update) {
        header("Location: index.php");
    } else {
        echo "Gagal update data: " . mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Barang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Edit Barang</h2>
    <form method="post">
        Kode Barang: <input type="text" name="kode_barang" value="<?= $data['kode_barang'] ?>" required><br>
        SKU: <input type="text" name="sku" value="<?= $data['sku'] ?>" required><br>
        Nama Barang: <input type="text" name="nama_barang" value="<?= $data['nama_barang'] ?>" required><br>
        Varian: <input type="text" name="varian" value="<?= $data['varian'] ?>"><br>
        Brand: <input type="text" name="brand" value="<?= $data['brand'] ?>"><br>
        Kategori: <input type="text" name="kategori" value="<?= $data['kategori'] ?>"><br>
        Harga Jual: <input type="number" name="harga_jual_default" value="<?= $data['harga_jual_default'] ?>" required><br>
        <button type="submit" name="update">Update</button>
    </form>
</body>
</html>
