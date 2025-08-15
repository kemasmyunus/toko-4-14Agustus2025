<?php
include "../koneksi.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['simpan'])) {
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $kontak         = $_POST['kontak'];

    $query = mysqli_query($koneksi, "INSERT INTO pelanggan (nama_pelanggan, kontak) VALUES ('$nama_pelanggan', '$kontak')");
    if (!$query) {
        die("Query gagal: " . mysqli_error($koneksi));
    }

    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Pelanggan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Tambah Pelanggan</h2>
    <form method="POST">
        <label>Nama Pelanggan</label>
        <input type="text" name="nama_pelanggan" required>

        <label>Kontak</label>
        <input type="text" name="kontak" required>

        <button type="submit" name="simpan">Simpan</button>
        <a href="index.php" class="btn-batal">Batal</a>
    </form>
</body>
</html>
