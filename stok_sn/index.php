<?php
require '../koneksi.php';

$query = "
    SELECT stok_sn.*, barang.nama_barang, barang.brand, barang.varian, gudang.nama_gudang, gudang.lokasi
    FROM stok_sn
    JOIN barang ON stok_sn.id_barang = barang.id_barang
    JOIN gudang ON stok_sn.id_gudang = gudang.id_gudang
    WHERE barang.sn = 1
";
$result = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Stok SN</title>
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
            background: #ffffff;
        }
        th, td {
            border: 1px solid #f5f5f5;
            padding: 10px 12px;
            text-align: left;
        }
        th {
            background: #f5f5f5;
            color: #000000;
            font-weight: bold;
        }
        a.button {
            display: inline-block;
            background: #f5f5f5;
            color: #000000;
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 3px;
            margin-bottom: 18px;
            border: 1px solid #e0e0e0;
        }
        a.button:hover {
            background: #ffffff;
            border-left: 4px solid #000000;
        }
    </style>
</head>
<body>
    <div class="header">Toko4 - Data Stok SN</div>
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
                <li><a href="../rekonsiliasi">rekonsiliasi</a></li>
                <li><a href="../stok">stok</a></li>
                <li><a href="../stok_sn">stok_sn</a></li>
                <li><a href="../supplier">supplier</a></li>
                <li><a href="../batch">batch</a></li>                <li><a href="../batch">batch</a></li>
            </ul>
        </nav>
        <div class="main-content">
            <a href="tambah.php" class="button">+ Tambah Stok SN</a>
            <?php if (mysqli_num_rows($result) > 0): ?>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Barang</th>
                        <th>Gudang</th>
                        <th>IMEI/SN</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= $row['id_stok_sn'] ?></td>
                        <td><?= $row['brand'] . ' ' . $row['nama_barang'] . ' ' . $row['varian'] ?></td>
                        <td><?= $row['nama_gudang'] ?> (<?= $row['lokasi'] ?>)</td>
                        <td><?= $row['imei_sn'] ?></td>
                        <td><?= ucfirst($row['status']) ?></td>
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
        </div>
    </div>
</body>
</html>
