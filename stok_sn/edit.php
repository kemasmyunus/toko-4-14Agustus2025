<?php
require '../koneksi.php';

$id = $_GET['id'] ?? '';
if (!$id) {
    die("ID tidak ditemukan");
}

// Ambil data stok_sn
$stok_sn = mysqli_query($koneksi, "SELECT * FROM stok_sn WHERE id_stok_sn = '$id'");
$data = mysqli_fetch_assoc($stok_sn);
if (!$data) {
    die("Data stok SN tidak ditemukan");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_barang = $_POST['id_barang'];
    $id_gudang = $_POST['id_gudang'];
    $imei_sn = $_POST['imei_sn'];
    $status = $_POST['status'];

    $update = mysqli_query($koneksi, "UPDATE stok_sn SET id_barang='$id_barang', id_gudang='$id_gudang', imei_sn='$imei_sn', status='$status' WHERE id_stok_sn='$id'");
    if ($update) {
        header('Location: index.php');
        exit;
    } else {
        echo "Gagal update: " . mysqli_error($koneksi);
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
    <title>Edit Stok SN</title>
</head>
<body>
    <h1>Edit Stok SN</h1>
    <form method="post">
        <label>Barang:</label>
        <select name="id_barang" required>
            <?php while ($b = mysqli_fetch_assoc($barang)): ?>
                <option value="<?= $b['id_barang'] ?>" <?= $b['id_barang'] == $data['id_barang'] ? 'selected' : '' ?>>
                    <?= $b['id_barang'] ?> | <?= $b['brand'] . ' ' . $b['nama_barang'] . ' ' . $b['varian'] ?>
                </option>
            <?php endwhile; ?>
        </select>
        <br>

        <label>Gudang:</label>
        <select name="id_gudang" required>
            <?php while ($g = mysqli_fetch_assoc($gudang)): ?>
                <option value="<?= $g['id_gudang'] ?>" <?= $g['id_gudang'] == $data['id_gudang'] ? 'selected' : '' ?>>
                    <?= $g['id_gudang'] ?> | <?= $g['nama_gudang'] ?> (<?= $g['lokasi'] ?>)
                </option>
            <?php endwhile; ?>
        </select>
        <br>

        <label>IMEI/SN:</label>
        <input type="text" name="imei_sn" value="<?= $data['imei_sn'] ?>" required><br>

        <label>Status:</label>
        <select name="status" required>
            <option value="tersedia" <?= $data['status'] == 'tersedia' ? 'selected' : '' ?>>Tersedia</option>
            <option value="terjual" <?= $data['status'] == 'terjual' ? 'selected' : '' ?>>Terjual</option>
        </select>
        <br>

        <button type="submit">Update</button>
    </form>
</body>
</html>
