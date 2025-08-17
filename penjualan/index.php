<?php
include "../koneksi.php";

// Ambil data penjualan join dengan pelanggan dan pegawai
$query = "
    SELECT p.id_penjualan, p.tanggal_penjualan, pl.nama_pelanggan, pg.nama_pegawai,
           p.metode_pembayaran, p.total, p.diskon, p.subtotal, p.sisa_bayar
    FROM penjualan p
    LEFT JOIN pelanggan pl ON p.id_pelanggan = pl.id_pelanggan
    LEFT JOIN pegawai pg ON p.id_pegawai = pg.id_pegawai
    ORDER BY p.id_penjualan DESC
";
$result = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Penjualan</title>
    <style>
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
        th { background: #eee; }
        a { text-decoration: none; color: blue; }
    </style>
</head>
<body>
    <h2>Data Penjualan</h2>
    <a href="tambah.php">+ Tambah Penjualan</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Tanggal</th>
            <th>Pelanggan</th>
            <th>Pegawai</th>
            <th>Metode Pembayaran</th>
            <th>Total</th>
            <th>Diskon</th>
            <th>Subtotal</th>
            <th>Sisa Bayar</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $row['id_penjualan'] ?></td>
            <td><?= $row['tanggal_penjualan'] ?></td>
            <td><?= $row['nama_pelanggan'] ?></td>
            <td><?= $row['nama_pegawai'] ?></td>
            <td><?= $row['metode_pembayaran'] ?></td>
            <td><?= $row['total'] ?></td>
            <td><?= $row['diskon'] ?></td>
            <td><?= $row['subtotal'] ?></td>
            <td><?= $row['sisa_bayar'] ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
