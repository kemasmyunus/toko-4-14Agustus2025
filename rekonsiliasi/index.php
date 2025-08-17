<?php
include "../koneksi.php";

// Ambil data rekonsiliasi join penjualan & pelanggan
$query = "
    SELECT r.id_rekonsiliasi, r.id_penjualan, r.metode_pembayaran, 
           r.tanggal_transaksi, r.status_pembayaran, r.nominal,
           p.tanggal_penjualan, pl.nama_pelanggan
    FROM rekonsiliasi r
    LEFT JOIN penjualan p ON r.id_penjualan = p.id_penjualan
    LEFT JOIN pelanggan pl ON p.id_pelanggan = pl.id_pelanggan
    ORDER BY r.id_rekonsiliasi DESC
";
$result = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Rekonsiliasi</title>
    <style>
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
        th { background: #eee; }
        a { text-decoration: none; color: blue; }
    </style>
</head>
<body>
    <h2>Data Rekonsiliasi</h2>
    <a href="tambah.php">+ Tambah Rekonsiliasi</a>
    <table>
        <tr>
            <th>ID</th>
            <th>ID Penjualan</th>
            <th>Pelanggan</th>
            <th>Tanggal Penjualan</th>
            <th>Metode Pembayaran</th>
            <th>Tanggal Transaksi</th>
            <th>Status Pembayaran</th>
            <th>Nominal</th>
            <th>Aksi</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $row['id_rekonsiliasi'] ?></td>
            <td><?= $row['id_penjualan'] ?></td>
            <td><?= $row['nama_pelanggan'] ?></td>
            <td><?= $row['tanggal_penjualan'] ?></td>
            <td><?= $row['metode_pembayaran'] ?></td>
            <td><?= $row['tanggal_transaksi'] ?></td>
            <td><?= $row['status_pembayaran'] ?></td>
            <td><?= $row['nominal'] ?></td>
            <td>
                <a href="edit.php?id=<?= $row['id_rekonsiliasi'] ?>">Edit</a> | 
                <a href="hapus.php?id=<?= $row['id_rekonsiliasi'] ?>" onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
