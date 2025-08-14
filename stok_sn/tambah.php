<?php
require '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_barang = $_POST['id_barang'];
    $id_gudang = $_POST['id_gudang'];
    $imei_sn = $_POST['imei_sn'];
    $status = $_POST['status'];

    $insert = mysqli_query($koneksi, "INSERT INTO stok_sn (id_barang, id_gudang, imei_sn, status) VALUES ('$id_barang','$id_gudang','$imei_sn','$status')");
    if ($insert) {
        header('Location: index.php');
        exit;
    } else {
        echo "Gagal: " . mysqli_error($koneksi);
    }
}

// Ambil barang (sn = 1)
$barang = mysqli_query($koneksi, "SELECT id_barang, brand, nama_barang, varian FROM barang WHERE sn=1");

// Ambil gudang
$gudang = mysqli_query($koneksi, "SELECT id_gudang, nama_gudang, lokasi FROM gudang");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Stok SN</title>
</head>
<body>
    <h1>Tambah Stok SN</h1>
    <form method="post">
        <label>Barang:</label>
        <select name="id_barang" required>
            <option value="">Pilih Barang</option>
            <?php while ($b = mysqli_fetch_assoc($barang)): ?>
                <option value="<?= $b['id_barang'] ?>">
                    <?= $b['id_barang'] ?> | <?= $b['brand'] . ' ' . $b['nama_barang'] . ' ' . $b['varian'] ?>
                </option>
            <?php endwhile; ?>
        </select>
        <br>

        <label>Gudang:</label>
        <select name="id_gudang" required>
            <option value="">Pilih Gudang</option>
            <?php while ($g = mysqli_fetch_assoc($gudang)): ?>
                <option value="<?= $g['id_gudang'] ?>">
                    <?= $g['id_gudang'] ?> | <?= $g['nama_gudang'] ?> (<?= $g['lokasi'] ?>)
                </option>
            <?php endwhile; ?>
        </select>
        <br>

        <label>IMEI/SN:</label>
        <input type="text" name="imei_sn" required><br>

        <label>Status:</label>
        <select name="status" required>
            <option value="">Pilih Status</option>
            <option value="tersedia">Tersedia</option>
            <option value="terjual">Terjual</option>
        </select>
        <br>

        <button type="submit">Simpan</button>
    </form>
</body>
</html>
