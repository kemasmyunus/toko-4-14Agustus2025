<?php
include "../koneksi.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['simpan'])) {
    $nama_pegawai = $_POST['nama_pegawai'];
    $username     = $_POST['username'];
    $password     = $_POST['password'];
    $peran        = $_POST['peran'];

    mysqli_query($koneksi, "INSERT INTO pegawai (nama_pegawai, username, password, peran) VALUES ('$nama_pegawai', '$username', '$password', '$peran')");
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Pegawai</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Tambah Pegawai</h2>
    <form method="POST">
        <label>Nama Pegawai</label>
        <input type="text" name="nama_pegawai" required>

        <label>Username</label>
        <input type="text" name="username" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <label>Peran</label>
        <select name="peran" required>
            <option value="">-- Pilih Peran --</option>
            <option value="admin">Admin</option>
            <option value="kasir">Kasir</option>
            <option value="gudang">Gudang</option>
            <option value="finance">Finance</option>
        </select>

        <button type="submit" name="simpan">Simpan</button>
        <a href="index.php" class="btn-batal">Batal</a>
    </form>
</body>
</html>
