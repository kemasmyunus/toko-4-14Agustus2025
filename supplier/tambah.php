<?php
include "../koneksi.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['simpan'])) {
    $nama_supplier = $_POST['nama_supplier'];
    $kontak        = $_POST['kontak'];

    $query = mysqli_query($koneksi, "INSERT INTO supplier (nama_supplier, kontak) VALUES ('$nama_supplier', '$kontak')");
    if (!$query) {
        die("Query gagal: " . mysqli_error($koneksi));
    }

    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Supplier</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Tambah Supplier</h2>
    <form method="POST">
        <label>Nama Supplier</label>
        <input type="text" name="nama_supplier" required>

        <label>Kontak</label>
        <input type="text" name="kontak" required>

        <button type="submit" name="simpan">Simpan</button>
        <a href="index.php" class="btn-batal">Batal</a>
    </form>
</body>
</html>
