<?php
include "../koneksi.php";

// Ambil data pelanggan & pegawai untuk dropdown
$pelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan ORDER BY nama_pelanggan");
$pegawai   = mysqli_query($koneksi, "SELECT * FROM pegawai ORDER BY nama_pegawai");

$id = $_GET['id'] ?? 0;
$data = mysqli_query($koneksi, "SELECT * FROM penjualan WHERE id_penjualan='$id'");
$row = mysqli_fetch_assoc($data);

if (!$row) {
    die("Data tidak ditemukan!");
}

// Proses update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tanggal  = $_POST['tanggal_penjualan'];
    $id_pel   = $_POST['id_pelanggan'];
    $id_peg   = $_POST['id_pegawai'];
    $metode   = $_POST['metode_pembayaran'];
    $total    = $_POST['total'];
    $diskon   = $_POST['diskon'];
    $subtotal = $_POST['subtotal'];
    $sisa     = $_POST['sisa_bayar'];

    $sql = "UPDATE penjualan SET 
                tanggal_penjualan='$tanggal',
                id_pelanggan='$id_pel',
                id_pegawai='$id_peg',
                metode_pembayaran='$metode',
                total='$total',
                diskon='$diskon',
                subtotal='$subtotal',
                sisa_bayar='$sisa'
            WHERE id_penjualan='$id'";

    if (mysqli_query($koneksi, $sql)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Penjualan</title>
</head>
<body>
    <h2>Edit Data Penjualan</h2>
    <form method="POST">
        <label>Tanggal Penjualan:</label><br>
        <input type="date" name="tanggal_penjualan" value="<?= $row['tanggal_penjualan'] ?>" required><br><br>

        <label>Pelanggan:</label><br>
        <select name="id_pelanggan" required>
            <?php while($pl = mysqli_fetch_assoc($pelanggan)) { ?>
                <option value="<?= $pl['id_pelanggan'] ?>" <?= ($pl['id_pelanggan'] == $row['id_pelanggan']) ? 'selected' : '' ?>>
                    <?= $pl['nama_pelanggan'] ?>
                </option>
            <?php } ?>
        </select><br><br>

        <label>Pegawai:</label><br>
        <select name="id_pegawai" required>
            <?php while($pg = mysqli_fetch_assoc($pegawai)) { ?>
                <option value="<?= $pg['id_pegawai'] ?>" <?= ($pg['id_pegawai'] == $row['id_pegawai']) ? 'selected' : '' ?>>
                    <?= $pg['nama_pegawai'] ?>
                </option>
            <?php } ?>
        </select><br><br>

        <label>Metode Pembayaran:</label><br>
        <input type="text" name="metode_pembayaran" value="<?= $row['metode_pembayaran'] ?>" required><br><br>

        <label>Total:</label><br>
        <input type="number" name="total" value="<?= $row['total'] ?>" required><br><br>

        <label>Diskon:</label><br>
        <input type="number" name="diskon" value="<?= $row['diskon'] ?>"><br><br>

        <label>Subtotal:</label><br>
        <input type="number" name="subtotal" value="<?= $row['subtotal'] ?>" required><br><br>

        <label>Sisa Bayar:</label><br>
        <input type="number" name="sisa_bayar" value="<?= $row['sisa_bayar'] ?>" required><br><br>

        <button type="submit">Update</button>
    </form>
</body>
</html>
