<?php
include "../koneksi.php";

if (isset($_POST['simpan'])) {
    $nama_gudang = $_POST['nama_gudang'];
    $lokasi      = $_POST['lokasi'];

    mysqli_query($koneksi, "INSERT INTO gudang (nama_gudang, lokasi) VALUES ('$nama_gudang', '$lokasi')");
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Gudang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Tambah Gudang</h2>
    <form method="POST">
        <label>Nama Gudang</label>
        <input type="text" name="nama_gudang" required>
        <label>Lokasi</label>
        <input type="text" name="lokasi" required>
        <button type="submit" name="simpan">Simpan</button>
        <a href="index.php" class="btn-batal">Batal</a>
    </form>
</body>
</html>
