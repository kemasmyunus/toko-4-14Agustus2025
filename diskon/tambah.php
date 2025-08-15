<?php
include "../koneksi.php";

if(isset($_POST['simpan'])){
    $id_barang = $_POST['id_barang'];
    $nama_potongan = $_POST['nama_potongan'];
    $nilai_potongan = $_POST['nilai_potongan'];
    $tgl_mulai = $_POST['tanggal_mulai'];
    $tgl_selesai = $_POST['tanggal_selesai'];

    $sql = "INSERT INTO potongan_barang 
            (id_barang, nama_potongan, nilai_potongan, tanggal_mulai, tanggal_selesai, status)
            VALUES ('$id_barang', '$nama_potongan', '$nilai_potongan', '$tgl_mulai', '$tgl_selesai', 'aktif')";
    mysqli_query($koneksi, $sql);
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Diskon</title>
</head>
<body>
<h2>Tambah Diskon Barang</h2>
<form method="post">
    <label>Barang:</label>
    <select name="id_barang" required>
        <?php
        $b = mysqli_query($koneksi, "SELECT * FROM barang ORDER BY nama_barang");
        while($brg = mysqli_fetch_assoc($b)){
            echo "<option value='{$brg['id_barang']}'>{$brg['nama_barang']}</option>";
        }
        ?>
    </select><br><br>

    <label>Nama Potongan:</label>
    <input type="text" name="nama_potongan" required><br><br>

    <label>Nilai Potongan (Rp):</label>
    <input type="number" name="nilai_potongan" required><br><br>

    <label>Tanggal Mulai:</label>
    <input type="date" name="tanggal_mulai" required><br><br>

    <label>Tanggal Selesai:</label>
    <input type="date" name="tanggal_selesai" required><br><br>

    <button type="submit" name="simpan">Simpan</button>
</form>
</body>
</html>
