<?php
include "../koneksi.php";
include "auto_nonaktif_diskon.php"; // jalankan otomatis setiap buka halaman
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Diskon Barang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h2>Diskon Barang</h2>
<a href="tambah.php">+ Tambah Diskon</a> | 
<a href="riwayat.php">Riwayat Diskon</a>
<br><br>
<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Barang</th>
        <th>Nama Potongan</th>
        <th>Nilai Potongan</th>
        <th>Tanggal Mulai</th>
        <th>Tanggal Selesai</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>
    <?php
    $sql = "SELECT p.*, b.nama_barang 
            FROM potongan_barang p
            JOIN barang b ON p.id_barang = b.id_barang
            WHERE p.status='aktif'
            ORDER BY p.tanggal_mulai DESC";
    $q = mysqli_query($koneksi, $sql);
    while($row = mysqli_fetch_assoc($q)){
        echo "<tr>
            <td>{$row['id_potongan']}</td>
            <td>{$row['nama_barang']}</td>
            <td>{$row['nama_potongan']}</td>
            <td>Rp " . number_format($row['nilai_potongan']) . "</td>
            <td>{$row['tanggal_mulai']}</td>
            <td>{$row['tanggal_selesai']}</td>
            <td>{$row['status']}</td>
            <td>
                <a href='edit.php?id={$row['id_potongan']}'>Edit</a> | 
                <a href='hapus.php?id={$row['id_potongan']}' onclick=\"return confirm('Nonaktifkan diskon ini?')\">Nonaktifkan</a>
            </td>
        </tr>";
    }
    ?>
</table>
</body>
</html>
