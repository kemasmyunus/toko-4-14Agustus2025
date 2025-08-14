<?php
require '../koneksi.php';

// Ambil data stok join barang untuk sn=0
$query = "
    SELECT stok.*, barang.nama_barang, barang.sn
    FROM stok
    JOIN barang ON stok.id_barang = barang.id_barang
    WHERE barang.sn = 0
";
$result = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Stok</title>
</head>
<body>
    <h1>Data Stok</h1>
    <a href="tambah.php">Tambah Stok</a>
    <br><br>
    <?php if (mysqli_num_rows($result) > 0): ?>
        <table border="1" cellpadding="5">
            <tr>
                <th>ID</th>
                <th>Nama Barang</th>
                <th>Gudang</th>
                <th>Jumlah</th>
                <th>Aksi</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $row['id_stok'] ?></td>
                <td><?= $row['nama_barang'] ?></td>
                <td><?= $row['id_gudang'] ?></td>
                <td><?= $row['jumlah'] ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['id_stok'] ?>">Edit</a> |
                    <a href="hapus.php?id=<?= $row['id_stok'] ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>Tidak ada data stok.</p>
    <?php endif; ?>
</body>
</html>
