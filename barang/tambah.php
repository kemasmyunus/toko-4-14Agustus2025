<?php
include "../koneksi.php";

if (isset($_POST['simpan'])) {
    $kode_barang = $_POST['kode_barang'];
    $sku         = $_POST['sku'];
    $nama_barang = $_POST['nama_barang'];
    $varian      = $_POST['varian'];
    $brand       = $_POST['brand'];
    $kategori    = $_POST['kategori'];
    $harga_jual  = $_POST['harga_jual_default'];
    $sn          = isset($_POST['sn']) ? 1 : 0;

    $query = mysqli_query($koneksi, "INSERT INTO barang (kode_barang, sku, nama_barang, varian, brand, kategori, harga_jual_default, sn)
                                     VALUES ('$kode_barang', '$sku', '$nama_barang', '$varian', '$brand', '$kategori', '$harga_jual', '$sn')");

    if ($query) {
        header("Location: index.php");
    } else {
        echo "Gagal menambah data: " . mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Barang</title>
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
        form {
            max-width: 420px;
            background: #ffffff;
            padding: 24px 28px 18px 28px;
            border: 1px solid #f5f5f5;
            border-radius: 4px;
        }
        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
        }
        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 8px 10px;
            margin-bottom: 16px;
            border: 1px solid #f5f5f5;
            border-radius: 3px;
            background: #f5f5f5;
            color: #000000;
            font-size: 15px;
        }
        button[type="submit"] {
            background: #f5f5f5;
            color: #000000;
            border: 1px solid #e0e0e0;
            padding: 8px 18px;
            border-radius: 3px;
            font-size: 15px;
            cursor: pointer;
        }
        button[type="submit"]:hover {
            background: #ffffff;
            border-left: 4px solid #000000;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">Toko4 - Tambah Barang</div>
    <div class="container">
        <nav class="sidebar">
            <ul>
                <li><a href="../barang" class="active">barang</a></li>
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
                <li><a href="../batch" >batch</a></li>
            </ul>
        </nav>
        <div class="main-content">
            <h2 style="margin-top:0;">Tambah Barang</h2>
            <form method="post">
                <label>Kode Barang:</label>
                <input type="text" name="kode_barang" required>
                <label>SKU:</label>
                <input type="text" name="sku" required>
                <label>Nama Barang:</label>
                <input type="text" name="nama_barang" required>
                <label>Varian:</label>
                <input type="text" name="varian">
                <label>Brand:</label>
                <input type="text" name="brand">
                <label>Kategori:</label>
                <input type="text" name="kategori">
                <label>Harga Jual:</label>
                <input type="number" name="harga_jual_default" required>
                <label>
                    <input type="checkbox" name="sn" value="1"> Ada SN
                </label>
                <button type="submit" name="simpan">Simpan</button>
            </form>
        </div>
    </div>
</body>
</html>
