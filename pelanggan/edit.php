<?php
include "../koneksi.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

$id = $_GET['id'];
$result = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE id_pelanggan='$id'");
if (!$result) {
    die("Query select gagal: " . mysqli_error($koneksi));
}
$data = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $kontak         = $_POST['kontak'];

    $query = mysqli_query($koneksi, "UPDATE pelanggan SET nama_pelanggan='$nama_pelanggan', kontak='$kontak' WHERE id_pelanggan='$id'");
    if (!$query) {
        die("Query update gagal: " . mysqli_error($koneksi));
    }

    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Pelanggan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Edit Pelanggan</h2>
    <form method="POST">
        <label>Nama Pelanggan</label>
        <input type="text" name="nama_pelanggan" value="<?= $data['nama_pelanggan'] ?>" required>

        <label>Kontak</label>
        <input type="text" name="kontak" value="<?= $data['kontak'] ?>" required>

        <button type="submit" name="update">Update</button>
        <a href="index.php" class="btn-batal">Batal</a>
    </form>
</body>
</html>
