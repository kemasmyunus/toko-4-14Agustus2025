<?php
require '../koneksi.php';

$id = $_GET['id'] ?? '';
if (!$id) {
    die("ID tidak ditemukan");
}

// Ambil data stok
$stok = mysqli_query($koneksi, "SELECT * FROM stok WHERE id_stok = '$id'");
$data = mysqli_fetch_assoc($stok);
if (!$data) {
    die("Data stok tidak ditemukan");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_barang = $_POST['id_barang'];
    $id_gudang = $_POST['id_gudang'];
    $jumlah = $_POST['jumlah'];

    $update = mysqli_query($koneksi, "UPDATE stok SET id_barang='$id_barang', id_gudang='$id_gudang', jumlah='$jumlah' WHERE id_stok='$id'");
    if ($update) {
        header('Location: index.php');
        exit;
    } else {
        echo "Gagal update: " . mysqli_error($koneksi);
    }
}

// Ambil barang (sn = 0)
$barang = mysqli_query($koneksi, "SELECT id_barang, brand, nama_barang, varian FROM barang WHERE sn=0");

// Ambil gudang
$gudang = mysqli_query($koneksi, "SELECT id_gudang, nama_gudang, lokasi FROM gudang");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Stok</title>
</head>
<body>
    <h1>Edit Stok</h1>
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

        <label>Jumlah:</label>
        <input type="number" name="jumlah" value="<?= $data['jumlah'] ?>" required><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>
