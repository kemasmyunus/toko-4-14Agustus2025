<?php
include "../koneksi.php";

$id = $_GET['id'];
$sql = mysqli_query($koneksi, "SELECT * FROM detail_pembelian WHERE id_detail_pembelian='$id'");
$data = mysqli_fetch_assoc($sql);

if (isset($_POST['update'])) {
    $id_pembelian = $_POST['id_pembelian'];
    $id_barang    = $_POST['id_barang'];
    $jumlah       = $_POST['jumlah'];
    $harga_beli   = $_POST['harga_beli'];
    $harga_jual   = $_POST['harga_jual'];
    $id_gudang    = $_POST['id_gudang'];

    $update = "UPDATE detail_pembelian SET 
                id_pembelian='$id_pembelian',
                id_barang='$id_barang',
                jumlah='$jumlah',
                harga_beli='$harga_beli',
                harga_jual='$harga_jual',
                id_gudang='$id_gudang'
               WHERE id_detail_pembelian='$id'";
    if (mysqli_query($koneksi, $update)) {
        header("Location: index.php");
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Detail Pembelian</title>
</head>
<body>
    <h2>Edit Detail Pembelian</h2>
    <form method="post">
        <label>Pembelian</label><br>
        <select name="id_pembelian">
            <?php
            $q = mysqli_query($koneksi, "SELECT * FROM pembelian");
            while ($r = mysqli_fetch_assoc($q)) {
                $sel = ($r['id_pembelian'] == $data['id_pembelian']) ? "selected" : "";
                echo "<option value='{$r['id_pembelian']}' $sel>{$r['tanggal_pembelian']}</option>";
            }
            ?>
        </select><br><br>

        <label>Barang</label><br>
        <select name="id_barang">
            <?php
            $q = mysqli_query($koneksi, "SELECT * FROM barang");
            while ($r = mysqli_fetch_assoc($q)) {
                $sel = ($r['id_barang'] == $data['id_barang']) ? "selected" : "";
                echo "<option value='{$r['id_barang']}' $sel>{$r['nama_barang']}</option>";
            }
            ?>
        </select><br><br>

        <label>Jumlah</label><br>
        <input type="number" name="jumlah" value="<?= $data['jumlah'] ?>"><br><br>

        <label>Harga Beli</label><br>
        <input type="number" name="harga_beli" value="<?= $data['harga_beli'] ?>"><br><br>

        <label>Harga Jual</label><br>
        <input type="number" name="harga_jual" value="<?= $data['harga_jual'] ?>"><br><br>

        <label>Gudang</label><br>
        <select name="id_gudang">
            <?php
            $q = mysqli_query($koneksi, "SELECT * FROM gudang");
            while ($r = mysqli_fetch_assoc($q)) {
                $sel = ($r['id_gudang'] == $data['id_gudang']) ? "selected" : "";
                echo "<option value='{$r['id_gudang']}' $sel>{$r['nama_gudang']}</option>";
            }
            ?>
        </select><br><br>

        <button type="submit" name="update">Update</button>
    </form>
</body>
</html>
