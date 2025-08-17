<?php
include "../koneksi.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Supplier</title>
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
        a.btn, .btn-batal {
            display: inline-block;
            background: #f5f5f5;
            color: #000000;
            border: 1px solid #e0e0e0;
            padding: 8px 18px;
            border-radius: 3px;
            font-size: 15px;
            text-decoration: none;
            margin-bottom: 12px;
        }
        a.btn:hover, .btn-batal:hover {
            background: #ffffff;
            border-left: 4px solid #000000;
            font-weight: bold;
        }
        a.edit, a.hapus {
            color: blue;
            text-decoration: none;
            margin: 0 4px;
        }
        a.hapus:hover, a.edit:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="header">Toko4 - Data Supplier</div>
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
                <li><a href="../supplier" class="active">supplier</a></li>
            </ul>
        </nav>
        <div class="main-content">
            <a href="tambah.php" class="btn">+ Tambah Supplier</a>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nama Supplier</th>
                    <th>Kontak</th>
                    <th>Aksi</th>
                </tr>
                <?php
                $result = mysqli_query($koneksi, "SELECT * FROM supplier ORDER BY id_supplier ASC");
                if (!$result) {
                    die("Query gagal: " . mysqli_error($koneksi));
                }
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>{$row['id_supplier']}</td>
                        <td>{$row['nama_supplier']}</td>
                        <td>{$row['kontak']}</td>
                        <td>
                            <a href='edit.php?id={$row['id_supplier']}' class='edit'>Edit</a>
                            <a href='hapus.php?id={$row['id_supplier']}' class='hapus' onclick=\"return confirm('Yakin ingin menghapus?')\">Hapus</a>
                        </td>
                    </tr>";
                }
                ?>
            </table>
        </div>
    </div>
</body>
</html>
