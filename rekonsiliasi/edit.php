<?php
include "../koneksi.php";

// Ambil data penjualan untuk dropdown
$penjualan = mysqli_query($koneksi, "
    SELECT p.id_penjualan, pl.nama_pelanggan, p.tanggal_penjualan 
    FROM penjualan p
    LEFT JOIN pelanggan pl ON p.id_pelanggan = pl.id_pelanggan
    ORDER BY p.id_penjualan DESC
");

$id = $_GET['id'] ?? 0;
$data = mysqli_query($koneksi, "SELECT * FROM rekonsiliasi WHERE id_rekonsiliasi='$id'");
$row = mysqli_fetch_assoc($data);

if (!$row) {
    die("Data tidak ditemukan!");
}

// Proses update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_penjualan = $_POST['id_penjualan'];
    $metode       = $_POST['metode_pembayaran'];
    $tanggal      = $_POST['tanggal_transaksi'];
    $status       = $_POST['status_pembayaran'];
    $nominal      = $_POST['nominal'];

    $sql = "UPDATE rekonsiliasi SET 
                id_penjualan='$id_penjualan',
                metode_pembayaran='$metode',
                tanggal_transaksi='$tanggal',
                status_pembayaran='$status',
                nominal='$nominal'
            WHERE id_rekonsiliasi='$id'";

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
    <title>Edit Rekonsiliasi</title>
</head>
<body>
    <h2>Edit Data Rekonsiliasi</h2>
    <form method="POST">
        <label>ID Penjualan:</label><br>
        <select name="id_penjualan" required>
            <?php while($pj = mysqli_fetch_assoc($penjualan)) { ?>
                <option value="<?= $pj['id_penjualan'] ?>" <?= ($pj['id_penjualan'] == $row['id_penjualan']) ? 'selected' : '' ?>>
                    <?= $pj['id_penjualan']." - ".$pj['nama_pelanggan']." (".$pj['tanggal_penjualan'].")" ?>
                </option>
            <?php } ?>
        </select><br><br>

        <label>Metode Pembayaran:</label><br>
        <select name="metode_pembayaran" required>
            <option value="cash" <?= ($row['metode_pembayaran']=="cash"?"selected":"") ?>>Cash</option>
            <option value="qris" <?= ($row['metode_pembayaran']=="qris"?"selected":"") ?>>QRIS</option>
            <option value="ewallet" <?= ($row['metode_pembayaran']=="ewallet"?"selected":"") ?>>E-Wallet</option>
            <option value="bank" <?= ($row['metode_pembayaran']=="bank"?"selected":"") ?>>Bank Transfer</option>
        </select><br><br>
        <label>Tanggal Transaksi:</label><br>
        <input type="date" name="tanggal_transaksi" value="<?= $row['tanggal_transaksi'] ?>" required><br><br>

        <label>Status Pembayaran:</label><br>
        <select name="status_pembayaran" required>
            <option value="lunas" <?= ($row['status_pembayaran']=="lunas"?"selected":"") ?>>Lunas</option>
            <option value="belum lunas" <?= ($row['status_pembayaran']=="belum lunas"?"selected":"") ?>>Belum Lunas</option>
        </select><br><br>

        <label>Nominal:</label><br>
        <input type="number" name="nominal" value="<?= $row['nominal'] ?>" required><br><br>

        <button type="submit">Update</button>
    </form>
</body>
</html>
