<?php
include "../koneksi.php";

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM potongan_barang WHERE id_potongan='$id'"));

if(isset($_POST['update'])){
    $nama_potongan = $_POST['nama_potongan'];
    $nilai_potongan = $_POST['nilai_potongan'];
    $tgl_mulai = $_POST['tanggal_mulai'];
    $tgl_selesai = $_POST['tanggal_selesai'];

    $sql = "UPDATE potongan_barang SET
            nama_potongan='$nama_potongan',
            nilai_potongan='$nilai_potongan',
            tanggal_mulai='$tgl_mulai',
            tanggal_selesai='$tgl_selesai'
            WHERE id_potongan='$id'";
    mysqli_query($koneksi, $sql);
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Diskon</title>
</head>
<body>
<h2>Edit Diskon Barang</h2>
<form method="post">
    <label>Nama Potongan:</label>
    <input type="text" name="nama_potongan" value="<?= $data['nama_potongan'] ?>" required><br><br>

    <label>Nilai Potongan (Rp):</label>
    <input type="number" name="nilai_potongan" value="<?= $data['nilai_potongan'] ?>" required><br><br>

    <label>Tanggal Mulai:</label>
    <input type="date" name="tanggal_mulai" value="<?= $data['tanggal_mulai'] ?>" required><br><br>

    <label>Tanggal Selesai:</label>
    <input type="date" name="tanggal_selesai" value="<?= $data['tanggal_selesai'] ?>" required><br><br>

    <button type="submit" name="update">Update</button>
</form>
</body>
</html>
