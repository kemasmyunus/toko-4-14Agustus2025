<?php
include "../koneksi.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Detail Pembelian</title>
</head>
<body>
    <h2>Data Detail Pembelian</h2>
    <a href="tambah.php">+ Tambah Data</a>
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Tanggal Pembelian</th>
            <th>Barang</th>
            <th>Jumlah</th>
            <th>Harga Beli</th>
            <th>Harga Jual</th>
            <th>Gudang</th>
            <th>Aksi</th>
        </tr>
        <?php
        $sql = "SELECT dp.*, 
                       p.tanggal_pembelian, 
                       b.nama_barang, 
                       g.nama_gudang
                FROM detail_pembelian dp
                JOIN pembelian p ON dp.id_pembelian = p.id_pembelian
                JOIN barang b ON dp.id_barang = b.id_barang
                JOIN gudang g ON dp.id_gudang = g.id_gudang
                ORDER BY dp.id_detail_pembelian DESC";
        $query = mysqli_query($koneksi, $sql);
        while ($row = mysqli_fetch_assoc($query)) {
            echo "<tr>
                    <td>{$row['id_detail_pembelian']}</td>
                    <td>{$row['tanggal_pembelian']}</td>
                    <td>{$row['nama_barang']}</td>
                    <td>{$row['jumlah']}</td>
                    <td>{$row['harga_beli']}</td>
                    <td>{$row['harga_jual']}</td>
                    <td>{$row['nama_gudang']}</td>
                    <td>
                        <a href='edit.php?id={$row['id_detail_pembelian']}'>Edit</a> | 
                        <a href='hapus.php?id={$row['id_detail_pembelian']}' onclick=\"return confirm('Hapus data ini?')\">Hapus</a>
                    </td>
                </tr>";
        }
        ?>
    </table>
</body>
</html>
