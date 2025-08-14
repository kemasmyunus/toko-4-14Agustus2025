<?php
require '../koneksi.php';

$query = "
    SELECT stok_sn.*, barang.nama_barang, barang.sn
    FROM stok_sn
    JOIN barang ON stok_sn.id_barang = barang.id_barang
    WHERE barang.sn = 1
";
$result = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Stok SN</title>
</head>
<body>
    <h1>Data Stok SN</h1>
    <a href="tambah.php">Tambah Stok SN</a>
    <br><br>
    <?php if (mysqli_num_rows($result) > 0): ?>
        <table border="1" cellpadding="5">
            <tr>
                <th>ID</th>
                <th>Nama Barang</th>
                <th>Gudang</th>
                <th>IMEI/SN</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $row['id_stok_sn'] ?></td>
                <td><?= $row['nama_barang'] ?></td>
                <td><?= $row['id_gudang'] ?></td>
                <td><?= $row['imei_sn'] ?></td>
                <td><?= $row['status'] ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['id_stok_sn'] ?>">Edit</a> |
                    <a href="hapus.php?id=<?= $row['id_stok_sn'] ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>Tidak ada data stok SN.</p>
    <?php endif; ?>
</body>
</html>
