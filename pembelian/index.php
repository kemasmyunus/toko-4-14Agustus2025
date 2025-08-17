<?php
include "../koneksi.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Pembelian</title>
</head>
<body>
    <h2>Data Pembelian</h2>
    <a href="tambah.php">+ Tambah Data</a>
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Tanggal</th>
            <th>Supplier</th>
            <th>Total</th>
            <th>Pegawai</th>
            <th>Aksi</th>
        </tr>
        <?php
        $sql = "SELECT p.*, s.nama_supplier, e.nama_pegawai
                FROM pembelian p
                JOIN supplier s ON p.id_supplier = s.id_supplier
                JOIN pegawai e ON p.id_pegawai = e.id_pegawai
                ORDER BY p.id_pembelian DESC";
        $query = mysqli_query($koneksi, $sql);
        while ($row = mysqli_fetch_assoc($query)) {
            echo "<tr>
                    <td>{$row['id_pembelian']}</td>
                    <td>{$row['tanggal_pembelian']}</td>
                    <td>{$row['nama_supplier']}</td>
                    <td>{$row['total_pembelian']}</td>
                    <td>{$row['nama_pegawai']}</td>
                    <td>
                        <a href='edit.php?id={$row['id_pembelian']}'>Edit</a> | 
                        <a href='hapus.php?id={$row['id_pembelian']}' onclick=\"return confirm('Hapus data ini?')\">Hapus</a>
                    </td>
                </tr>";
        }
        ?>
    </table>
</body>
</html>
