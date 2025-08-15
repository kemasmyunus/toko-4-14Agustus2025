<?php
include "../koneksi.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

$id = $_GET['id'];
$result = mysqli_query($koneksi, "SELECT * FROM supplier WHERE id_supplier='$id'");
if (!$result) {
    die("Query select gagal: " . mysqli_error($koneksi));
}
$data = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $nama_supplier = $_POST['nama_supplier'];
    $kontak        = $_POST['kontak'];

    $query = mysqli_query($koneksi, "UPDATE supplier SET nama_supplier='$nama_supplier', kontak='$kontak' WHERE id_supplier='$id'");
    if (!$query) {
        die("Query update gagal: " . mysqli_error($koneksi));
    }

    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Supplier</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Edit Supplier</h2>
    <form method="POST">
        <label>Nama Supplier</label>
        <input type="text" name="nama_supplier" value="<?= $data['nama_supplier'] ?>" required>

        <label>Kontak</label>
        <input type="text" name="kontak" value="<?= $data['kontak'] ?>" required>

        <button type="submit" name="update">Update</button>
        <a href="index.php" class="btn-batal">Batal</a>
    </form>
</body>
</html>
