<?php
require '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_barang = $_POST['id_barang'];
    $id_gudang = $_POST['id_gudang'];
    $jumlah = $_POST['jumlah'];

    $insert = mysqli_query($koneksi, "INSERT INTO stok (id_barang, id_gudang, jumlah) VALUES ('$id_barang','$id_gudang','$jumlah')");
    if ($insert) {
        header('Location: index.php');
        exit;
    } else {
        echo "Gagal: " . mysqli_error($koneksi);
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
    <title>Tambah Stok</title>
</head>
<body>
    <h1>Tambah Stok</h1>
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

        <label>Jumlah:</label>
        <input type="number" name="jumlah" required><br>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>
