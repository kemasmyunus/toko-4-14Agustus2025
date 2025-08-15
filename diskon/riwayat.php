<?php
include "../koneksi.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Diskon Barang</title>
</head>
<body>
<h2>Riwayat Diskon Barang</h2>
<a href="index.php">Kembali</a><br><br>
<table border="1" cellpadding="8">
    <tr>
        <th>ID Riwayat</th>
        <th>ID Potongan</th>
        <th>Barang</th>
        <th>Nama Potongan</th>
        <th>Nilai Potongan</th>
        <th>Tanggal Mulai</th>
        <th>Tanggal Selesai</th>
        <th>Status Awal</th>
        <th>Status Akhir</th>
        <th>Tanggal Perubahan</th>
    </tr>
    <?php
    $sql = "SELECT r.*, b.nama_barang 
            FROM potongan_barang_riwayat r
            JOIN barang b ON r.id_barang = b.id_barang
            ORDER BY r.tanggal_perubahan DESC";
    $q = mysqli_query($koneksi, $sql);
    while($row = mysqli_fetch_assoc($q)){
        echo "<tr>
            <td>{$row['id_riwayat']}</td>
            <td>{$row['id_potongan']}</td>
            <td>{$row['nama_barang']}</td>
            <td>{$row['nama_potongan']}</td>
            <td>Rp " . number_format($row['nilai_potongan']) . "</td>
            <td>{$row['tanggal_mulai']}</td>
            <td>{$row['tanggal_selesai']}</td>
            <td>{$row['status_awal']}</td>
            <td>{$row['status_akhir']}</td>
            <td>{$row['tanggal_perubahan']}</td>
        </tr>";
    }
    ?>
</table>
</body>
</html>
