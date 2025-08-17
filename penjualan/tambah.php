<?php
include "../koneksi.php";

// Ambil data pelanggan
$pelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan ORDER BY nama_pelanggan");
// Ambil data pegawai
$pegawai   = mysqli_query($koneksi, "SELECT * FROM pegawai ORDER BY nama_pegawai");

// Proses simpan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tanggal  = $_POST['tanggal_penjualan'];
    $id_pel   = $_POST['id_pelanggan'];
    $id_peg   = $_POST['id_pegawai'];
    $metode   = $_POST['metode_pembayaran'];
    $total    = $_POST['total'];
    $diskon   = $_POST['diskon'];
    $subtotal = $_POST['subtotal'];
    $sisa     = $_POST['sisa_bayar'];

    $sql = "INSERT INTO penjualan (tanggal_penjualan, id_pelanggan, id_pegawai, metode_pembayaran, total, diskon, subtotal, sisa_bayar)
            VALUES ('$tanggal','$id_pel','$id_peg','$metode','$total','$diskon','$subtotal','$sisa')";
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
    <title>Tambah Penjualan</title>
</head>
<body>
    <h2>Tambah Data Penjualan</h2>
    <form method="POST">
        <label>Tanggal Penjualan:</label><br>
        <input type="date" name="tanggal_penjualan" required><br><br>

        <label>Pelanggan:</label><br>
        <select name="id_pelanggan" required>
            <option value="">--Pilih Pelanggan--</option>
            <?php while($pl = mysqli_fetch_assoc($pelanggan)) { ?>
                <option value="<?= $pl['id_pelanggan'] ?>"><?= $pl['nama_pelanggan'] ?></option>
            <?php } ?>
        </select><br><br>

        <label>Pegawai:</label><br>
        <select name="id_pegawai" required>
            <option value="">--Pilih Pegawai--</option>
            <?php while($pg = mysqli_fetch_assoc($pegawai)) { ?>
                <option value="<?= $pg['id_pegawai'] ?>"><?= $pg['nama_pegawai'] ?></option>
            <?php } ?>
        </select><br><br>

        <label>Metode Pembayaran:</label><br>
        <input type="text" name="metode_pembayaran" required><br><br>

        <label>Total:</label><br>
        <input type="number" name="total" required><br><br>

        <label>Diskon:</label><br>
        <input type="number" name="diskon"><br><br>

        <label>Subtotal:</label><br>
        <input type="number" name="subtotal" required><br><br>

        <label>Sisa Bayar:</label><br>
        <input type="number" name="sisa_bayar" required><br><br>

        <button type="submit">Simpan</button>
    </form>
</body>
</html>
