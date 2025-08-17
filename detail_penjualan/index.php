<?php
include '../koneksi.php';

// Ambil data detail_penjualan dengan join ke penjualan dan barang
$sql = "SELECT dp.*, p.tanggal_penjualan, b.nama_barang 
        FROM detail_penjualan dp
        LEFT JOIN penjualan p ON dp.id_penjualan = p.id_penjualan
        LEFT JOIN barang b ON dp.id_barang = b.id_barang";
$result = mysqli_query($koneksi, $sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Detail Penjualan</title>
</head>
<body>
<h2>Data Detail Penjualan</h2>
<a href="tambah.php">+ Tambah Data</a>
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Penjualan</th>
        <th>Barang</th>
        <th>IMEI/SN</th>
        <th>Jumlah</th>
        <th>Harga Jual</th>
        <th>Potongan1</th>
        <th>Potongan2</th>
        <th>Potongan3</th>
        <th>Total Setelah Potongan</th>
        <th>Aksi</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td><?= $row['id_detail_penjualan'] ?></td>
        <td><?= $row['tanggal_penjualan'] ?></td>
        <td><?= $row['nama_barang'] ?></td>
        <td><?= $row['imei_sn'] ?></td>
        <td><?= $row['jumlah'] ?></td>
        <td><?= $row['harga_jual'] ?></td>
        <td><?= $row['potongan1'] ?></td>
        <td><?= $row['potongan2'] ?></td>
        <td><?= $row['potongan3'] ?></td>
        <td><?= $row['total_setelah_potongan'] ?></td>
        <td>
            <a href="edit.php?id=<?= $row['id_detail_penjualan'] ?>">Edit</a> | 
            <a href="hapus.php?id=<?= $row['id_detail_penjualan'] ?>" onclick="return confirm('Yakin hapus?');">Hapus</a>
        </td>
    </tr>
    <?php } ?>
</table>
</body>
</html>
