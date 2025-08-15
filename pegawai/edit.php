<?php
include "../koneksi.php";

$id = $_GET['id'];
$result = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE id_pegawai='$id'");
$data = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $nama_pegawai = $_POST['nama_pegawai'];
    $username     = $_POST['username'];
    $peran        = $_POST['peran'];

    // Jika password diisi, update password juga
    if (!empty($_POST['password'])) {
        $password = $_POST['password'];
        mysqli_query($koneksi, "UPDATE pegawai SET nama_pegawai='$nama_pegawai', username='$username', password='$password', peran='$peran' WHERE id_pegawai='$id'");
    } else {
        mysqli_query($koneksi, "UPDATE pegawai SET nama_pegawai='$nama_pegawai', username='$username', peran='$peran' WHERE id_pegawai='$id'");
    }

    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Pegawai</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Edit Pegawai</h2>
    <form method="POST">
        <label>Nama Pegawai</label>
        <input type="text" name="nama_pegawai" value="<?= $data['nama_pegawai'] ?>" required>

        <label>Username</label>
        <input type="text" name="username" value="<?= $data['username'] ?>" required>

        <label>Password (kosongkan jika tidak diganti)</label>
        <input type="password" name="password">

        <label>Peran</label>
        <select name="peran" required>
            <option value="admin" <?= $data['peran'] == 'admin' ? 'selected' : '' ?>>Admin</option>
            <option value="kasir" <?= $data['peran'] == 'kasir' ? 'selected' : '' ?>>Kasir</option>
            <option value="gudang" <?= $data['peran'] == 'gudang' ? 'selected' : '' ?>>Gudang</option>
            <option value="finance" <?= $data['peran'] == 'finance' ? 'selected' : '' ?>>Finance</option>
        </select>

        <button type="submit" name="update">Update</button>
        <a href="index.php" class="btn-batal">Batal</a>
    </form>
</body>
</html>
