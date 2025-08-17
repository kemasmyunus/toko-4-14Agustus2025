<?php
include "../koneksi.php";

if (isset($_POST['simpan'])) {
    $tanggal      = $_POST['tanggal_pembelian'];
    $id_supplier  = $_POST['id_supplier'];
    $total        = $_POST['total_pembelian'];
    $id_pegawai   = $_POST['id_pegawai'];

    $sql = "INSERT INTO pembelian (tanggal_pembelian, id_supplier, total_pembelian, id_pegawai)
            VALUES ('$tanggal','$id_supplier','$total','$id_pegawai')";
    if (mysqli_query($koneksi, $sql)) {
        header("Location: index.php");
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Pembelian</title>
</head>
<body>
    <h2>Tambah Pembelian</h2>
    <form method="post">
        <label>Tanggal Pembelian</label><br>
        <input type="date" name="tanggal_pembelian" required><br><br>

        <label>Supplier</label><br>
        <select name="id_supplier">
            <?php
            $q = mysqli_query($koneksi, "SELECT * FROM supplier");
            while ($r = mysqli_fetch_assoc($q)) {
                echo "<option value='{$r['id_supplier']}'>{$r['nama_supplier']}</option>";
            }
            ?>
        </select><br><br>

        <label>Total Pembelian</label><br>
        <input type="number" name="total_pembelian" required><br><br>

        <label>Pegawai</label><br>
        <select name="id_pegawai">
            <?php
            $q = mysqli_query($koneksi, "SELECT * FROM pegawai");
            while ($r = mysqli_fetch_assoc($q)) {
                echo "<option value='{$r['id_pegawai']}'>{$r['nama_pegawai']}</option>";
            }
            ?>
        </select><br><br>

        <button type="submit" name="simpan">Simpan</button>
    </form>
</body>
</html>
