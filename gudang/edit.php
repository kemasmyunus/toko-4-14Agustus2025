<?php
include "../koneksi.php";

$id = $_GET['id'];
$result = mysqli_query($koneksi, "SELECT * FROM gudang WHERE id_gudang='$id'");
$data = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $nama_gudang = $_POST['nama_gudang'];
    $lokasi      = $_POST['lokasi'];

    mysqli_query($koneksi, "UPDATE gudang SET nama_gudang='$nama_gudang', lokasi='$lokasi' WHERE id_gudang='$id'");
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Gudang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Edit Gudang</h2>
    <form method="POST">
        <label>Nama Gudang</label>
        <input type="text" name="nama_gudang" value="<?= $data['nama_gudang'] ?>" required>
        <label>Lokasi</label>
        <input type="text" name="lokasi" value="<?= $data['lokasi'] ?>" required>
        <button type="submit" name="update">Update</button>
        <a href="index.php" class="btn-batal">Batal</a>
    </form>
</body>
</html>
