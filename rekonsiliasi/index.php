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
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            color: #000000;
        }
        .header {
            background: #f5f5f5;
            color: #000000;
            padding: 16px 24px;
            font-size: 22px;
            font-weight: bold;
            border-bottom: 1px solid #e0e0e0;
        }
        .container {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 220px;
            background: #f5f5f5;
            padding: 0;
            border-right: 1px solid #e0e0e0;
            min-height: 100vh;
        }
        .sidebar ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }
        .sidebar li {
            margin: 0;
        }
        .sidebar a {
            display: block;
            color: #000000;
            text-decoration: none;
            padding: 14px 24px;
            border-left: 4px solid transparent;
        }
        .sidebar a.active, .sidebar a:hover {
            background: #ffffff;
            border-left: 4px solid #000000;
            font-weight: bold;
        }
        .main-content {
            flex: 1;
            background: #ffffff;
            padding: 32px 40px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
            background: #ffffff;
        }
        th, td {
            border: 1px solid #f5f5f5;
            padding: 8px;
            text-align: center;
            color: #000000;
        }
        th {
            background: #f5f5f5;
            font-weight: bold;
        }
        a {
            text-decoration: none;
            color: blue;
        }
        .btn-tambah {
            display: inline-block;
            margin-bottom: 12px;
            background: #f5f5f5;
            color: #000000;
            border: 1px solid #e0e0e0;
            padding: 8px 18px;
            border-radius: 3px;
            font-size: 15px;
        }
        .btn-tambah:hover {
            background: #ffffff;
            border-left: 4px solid #000000;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">Toko4 - Data Rekonsiliasi</div>
    <div class="container">
        <nav class="sidebar">
            <ul>
                <li><a href="../barang">barang</a></li>
                <li><a href="../detail_pembelian">detail_pembelian</a></li>
                <li><a href="../detail_penjualan">detail_penjualan</a></li>
                <li><a href="../diskon">diskon</a></li>
                <li><a href="../gudang">gudang</a></li>
                <li><a href="../pegawai">pegawai</a></li>
                <li><a href="../pelanggan">pelanggan</a></li>
                <li><a href="../pembelian">pembelian</a></li>
                <li><a href="../penjualan">penjualan</a></li>
                <li><a href="../pos">pos</a></li>
                <li><a href="../rekonsiliasi" class="active">rekonsiliasi</a></li>
                <li><a href="../stok">stok</a></li>
                <li><a href="../stok_sn">stok_sn</a></li>
                <li><a href="../supplier">supplier</a></li>
            </ul>
        </nav>
        <div class="main-content">
            <a href="tambah.php" class="btn-tambah">+ Tambah Rekonsiliasi</a>
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
        </div>
    </div>
</body>
</html>
