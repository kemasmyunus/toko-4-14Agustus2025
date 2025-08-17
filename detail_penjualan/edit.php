<?php
include '../koneksi.php';

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM detail_penjualan WHERE id_detail_penjualan='$id'"));

$penjualan = mysqli_query($koneksi, "SELECT * FROM penjualan");
$barang = mysqli_query($koneksi, "SELECT * FROM barang");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_penjualan = $_POST['id_penjualan'];
    $id_barang = $_POST['id_barang'];
    $imei_sn = $_POST['imei_sn'];
    $jumlah = $_POST['jumlah'];
    $harga_jual = $_POST['harga_jual'];
    $potongan1 = $_POST['potongan1'];
    $potongan2 = $_POST['potongan2'];
    $potongan3 = $_POST['potongan3'];

    $total_setelah_potongan = ($harga_jual * $jumlah) - $potongan1 - $potongan2 - $potongan3;

    $sql = "UPDATE detail_penjualan SET 
            id_penjualan='$id_penjualan',
            id_barang='$id_barang',
            imei_sn='$imei_sn',
            jumlah='$jumlah',
            harga_jual='$harga_jual',
            potongan1='$potongan1',
            potongan2='$potongan2',
            potongan3='$potongan3',
            total_setelah_potongan='$total_setelah_potongan'
            WHERE id_detail_penjualan='$id'";

    if (mysqli_query($koneksi, $sql)) {
        header("Location: index.php");
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Edit Detail Penjualan</title></head>
<body>
<h2>Edit Detail Penjualan</h2>
<form method="post">
    Penjualan:
    <select name="id_penjualan" required>
        <?php while($p = mysqli_fetch_assoc($penjualan)) { ?>
            <option value="<?= $p['id_penjualan'] ?>" <?= ($p['id_penjualan']==$data['id_penjualan'])?'selected':'' ?>>
                <?= $p['tanggal_penjualan'] ?>
            </option>
        <?php } ?>
    </select><br>

    Barang:
    <select name="id_barang" required>
        <?php while($b = mysqli_fetch_assoc($barang)) { ?>
            <option value="<?= $b['id_barang'] ?>" <?= ($b['id_barang']==$data['id_barang'])?'selected':'' ?>>
                <?= $b['nama_barang'] ?>
            </option>
        <?php } ?>
    </select><br>

    IMEI/SN: <input type="text" name="imei_sn" value="<?= $data['imei_sn'] ?>" required><br>
    Jumlah: <input type="number" name="jumlah" value="<?= $data['jumlah'] ?>" required><br>
    Harga Jual: <input type="number" name="harga_jual" value="<?= $data['harga_jual'] ?>" required><br>
    Potongan 1: <input type="number" name="potongan1" value="<?= $data['potongan1'] ?>"><br>
    Potongan 2: <input type="number" name="potongan2" value="<?= $data['potongan2'] ?>"><br>
    Potongan 3: <input type="number" name="potongan3" value="<?= $data['potongan3'] ?>"><br>
    <button type="submit">Update</button>
</form>
</body>
</html>
