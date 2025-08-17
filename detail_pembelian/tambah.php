<?php
include "../koneksi.php";

if (isset($_POST['simpan'])) {
    $id_pembelian = $_POST['id_pembelian'];
    $id_barang    = $_POST['id_barang'];
    $jumlah       = $_POST['jumlah'];
    $harga_beli   = $_POST['harga_beli'];
    $harga_jual   = $_POST['harga_jual'];
    $id_gudang    = $_POST['id_gudang'];

    $sql = "INSERT INTO detail_pembelian (id_pembelian, id_barang, jumlah, harga_beli, harga_jual, id_gudang)
            VALUES ('$id_pembelian','$id_barang','$jumlah','$harga_beli','$harga_jual','$id_gudang')";
    if (mysqli_query($koneksi, $sql)) {
        header("Location: index.php");
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Detail Pembelian</title>
</head>
<body>
    <h2>Tambah Detail Pembelian</h2>
    <form method="post">
        <label>Pembelian</label><br>
        <select name="id_pembelian">
            <?php
            $q = mysqli_query($koneksi, "SELECT * FROM pembelian");
            while ($r = mysqli_fetch_assoc($q)) {
                echo "<option value='{$r['id_pembelian']}'>{$r['tanggal_pembelian']}</option>";
            }
            ?>
        </select><br><br>

        <label>Barang</label><br>
        <select name="id_barang">
            <?php
            $q = mysqli_query($koneksi, "SELECT * FROM barang");
            while ($r = mysqli_fetch_assoc($q)) {
                echo "<option value='{$r['id_barang']}'>{$r['nama_barang']}</option>";
            }
            ?>
        </select><br><br>

        <label>Jumlah</label><br>
        <input type="number" name="jumlah" required><br><br>

        <label>Harga Beli</label><br>
        <input type="number" name="harga_beli" required><br><br>

        <label>Harga Jual</label><br>
        <input type="number" name="harga_jual" required><br><br>

        <label>Gudang</label><br>
        <select name="id_gudang">
            <?php
            $q = mysqli_query($koneksi, "SELECT * FROM gudang");
            while ($r = mysqli_fetch_assoc($q)) {
                echo "<option value='{$r['id_gudang']}'>{$r['nama_gudang']}</option>";
            }
            ?>
        </select><br><br>

        <button type="submit" name="simpan">Simpan</button>
    </form>
</body>
</html>
