<?php
include "../koneksi.php";

// Ambil data penjualan join pelanggan
$penjualan = mysqli_query($koneksi, "
    SELECT p.id_penjualan, pl.nama_pelanggan, p.tanggal_penjualan 
    FROM penjualan p
    LEFT JOIN pelanggan pl ON p.id_pelanggan = pl.id_pelanggan
    ORDER BY p.id_penjualan DESC
");

// Proses simpan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_penjualan = $_POST['id_penjualan'];
    $metode       = $_POST['metode_pembayaran'];
    $tanggal      = $_POST['tanggal_transaksi'];
    $status       = $_POST['status_pembayaran'];
    $nominal      = $_POST['nominal'];

    $sql = "INSERT INTO rekonsiliasi (id_penjualan, metode_pembayaran, tanggal_transaksi, status_pembayaran, nominal)
            VALUES ('$id_penjualan','$metode','$tanggal','$status','$nominal')";
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
    <title>Tambah Rekonsiliasi</title>
</head>
<body>
    <h2>Tambah Data Rekonsiliasi</h2>
    <form method="POST">
        <label>ID Penjualan:</label><br>
        <select name="id_penjualan" required>
            <option value="">--Pilih Penjualan--</option>
            <?php while($pj = mysqli_fetch_assoc($penjualan)) { ?>
                <option value="<?= $pj['id_penjualan'] ?>">
                    <?= $pj['id_penjualan']." - ".$pj['nama_pelanggan']." (".$pj['tanggal_penjualan'].")" ?>
                </option>
            <?php } ?>
        </select><br><br>

        <label>Metode Pembayaran:</label><br>
        <select name="metode_pembayaran" required>
            <option value="cash">Cash</option>
            <option value="qris">QRIS</option>
            <option value="ewallet">E-Wallet</option>
            <option value="bank">Bank Transfer</option>
        </select><br><br>
        <label>Tanggal Transaksi:</label><br>
        <input type="date" name="tanggal_transaksi" required><br><br>

        <label>Status Pembayaran:</label><br>
        <select name="status_pembayaran" required>
            <option value="lunas">Lunas</option>
            <option value="belum lunas">Belum Lunas</option>
        </select><br><br>
        <label>Nominal:</label><br>
        <input type="number" name="nominal" required><br><br>

        <button type="submit">Simpan</button>
    </form>
</body>
</html>
