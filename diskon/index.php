<?php
include "../koneksi.php";
include "auto_nonaktif_diskon.php"; // jalankan otomatis setiap buka halaman
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Diskon Barang</title>
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
    <div class="header">Toko4 - Diskon Barang</div>
    <div class="container">
        <nav class="sidebar">
            <ul>
                <li><a href="../barang">barang</a></li>
                <li><a href="../detail_pembelian">detail_pembelian</a></li>
                <li><a href="../detail_penjualan">detail_penjualan</a></li>
                <li><a href="../diskon" class="active">diskon</a></li>
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
                <li><a href="../batch" >batch</a></li>
            </ul>
        </nav>
        <div class="main-content">
            <a href="tambah.php" class="button">+ Tambah Diskon</a>
            <a href="riwayat.php" class="button">Riwayat Diskon</a>
            <table>
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
        </div>
    </div>
</body>
</html>
