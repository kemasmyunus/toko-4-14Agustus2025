<?php
include "../koneksi.php";

$id = $_GET['id'];
$sql = mysqli_query($koneksi, "SELECT * FROM pembelian WHERE id_pembelian='$id'");
$data = mysqli_fetch_assoc($sql);

if (isset($_POST['update'])) {
    $tanggal     = $_POST['tanggal_pembelian'];
    $id_supplier = $_POST['id_supplier'];
    $total       = $_POST['total_pembelian'];
    $id_pegawai  = $_POST['id_pegawai'];

    $update = "UPDATE pembelian SET 
                tanggal_pembelian='$tanggal',
                id_supplier='$id_supplier',
                total_pembelian='$total',
                id_pegawai='$id_pegawai'
               WHERE id_pembelian='$id'";
    if (mysqli_query($koneksi, $update)) {
        header("Location: index.php");
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Pembelian</title>
</head>
<body>
    <h2>Edit Pembelian</h2>
    <form method="post">
        <label>Tanggal Pembelian</label><br>
        <input type="date" name="tanggal_pembelian" value="<?= $data['tanggal_pembelian'] ?>"><br><br>

        <label>Supplier</label><br>
        <select name="id_supplier">
            <?php
            $q = mysqli_query($koneksi, "SELECT * FROM supplier");
            while ($r = mysqli_fetch_assoc($q)) {
                $sel = ($r['id_supplier'] == $data['id_supplier']) ? "selected" : "";
                echo "<option value='{$r['id_supplier']}' $sel>{$r['nama_supplier']}</option>";
            }
            ?>
        </select><br><br>

        <label>Total Pembelian</label><br>
        <input type="number" name="total_pembelian" value="<?= $data['total_pembelian'] ?>"><br><br>

        <label>Pegawai</label><br>
        <select name="id_pegawai">
            <?php
            $q = mysqli_query($koneksi, "SELECT * FROM pegawai");
            while ($r = mysqli_fetch_assoc($q)) {
                $sel = ($r['id_pegawai'] == $data['id_pegawai']) ? "selected" : "";
                echo "<option value='{$r['id_pegawai']}' $sel>{$r['nama_pegawai']}</option>";
            }
            ?>
        </select><br><br>

        <button type="submit" name="update">Update</button>
    </form>
</body>
</html>
