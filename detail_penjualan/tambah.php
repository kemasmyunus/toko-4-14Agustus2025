<?php
include '../koneksi.php';

// Ambil data penjualan untuk dropdown
$penjualan = mysqli_query($koneksi, "SELECT * FROM penjualan");
// Ambil data barang untuk dropdown
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

    $sql = "INSERT INTO detail_penjualan 
            (id_penjualan, id_barang, imei_sn, jumlah, harga_jual, potongan1, potongan2, potongan3, total_setelah_potongan) 
            VALUES ('$id_penjualan','$id_barang','$imei_sn','$jumlah','$harga_jual','$potongan1','$potongan2','$potongan3','$total_setelah_potongan')";

    if (mysqli_query($koneksi, $sql)) {
        header("Location: index.php");
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Tambah Detail Penjualan</title></head>
<body>
<h2>Tambah Detail Penjualan</h2>
<form method="post">
    Penjualan:
    <select name="id_penjualan" required>
        <option value="">--Pilih--</option>
        <?php while($p = mysqli_fetch_assoc($penjualan)) { ?>
            <option value="<?= $p['id_penjualan'] ?>"><?= $p['tanggal_penjualan'] ?></option>
        <?php } ?>
    </select><br>

    Barang:
    <select name="id_barang" required>
        <option value="">--Pilih--</option>
        <?php while($b = mysqli_fetch_assoc($barang)) { ?>
            <option value="<?= $b['id_barang'] ?>"><?= $b['nama_barang'] ?></option>
        <?php } ?>
    </select><br>

    IMEI/SN: <input type="text" name="imei_sn" required><br>
    Jumlah: <input type="number" name="jumlah" required><br>
    Harga Jual: <input type="number" name="harga_jual" required><br>
    Potongan 1: <input type="number" name="potongan1" value="0"><br>
    Potongan 2: <input type="number" name="potongan2" value="0"><br>
    Potongan 3: <input type="number" name="potongan3" value="0"><br>
    <button type="submit">Simpan</button>
</form>
</body>
</html>
