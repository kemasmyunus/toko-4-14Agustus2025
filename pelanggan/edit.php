<?php
include "../koneksi.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

$id = $_GET['id'];
$result = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE id_pelanggan='$id'");
if (!$result) {
    die("Query select gagal: " . mysqli_error($koneksi));
}
$data = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $kontak         = $_POST['kontak'];

    $query = mysqli_query($koneksi, "UPDATE pelanggan SET nama_pelanggan='$nama_pelanggan', kontak='$kontak' WHERE id_pelanggan='$id'");
    if (!$query) {
        die("Query update gagal: " . mysqli_error($koneksi));
    }

    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Pelanggan</title>
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
        input[type="text"] {
            width: 100%;
            padding: 8px 10px;
            margin-bottom: 16px;
            border: 1px solid #f5f5f5;
            border-radius: 3px;
            background: #f5f5f5;
            color: #000000;
            font-size: 15px;
        }
        button[type="submit"], .btn-batal {
            background: #f5f5f5;
            color: #000000;
            border: 1px solid #e0e0e0;
            padding: 8px 18px;
            border-radius: 3px;
            font-size: 15px;
            cursor: pointer;
            text-decoration: none;
            margin-right: 8px;
        }
        button[type="submit"]:hover, .btn-batal:hover {
            background: #ffffff;
            border-left: 4px solid #000000;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">Toko4 - Edit Pelanggan</div>
    <div class="container">
        <nav class="sidebar">
            <ul>
                <li><a href="../barang">barang</a></li>
                <li><a href="../detail_pembelian">detail_pembelian</a></li>
                <li><a href="../detail_penjualan">detail_penjualan</a></li>
                <li><a href="../diskon">diskon</a></li>
                <li><a href="../gudang">gudang</a></li>
                <li><a href="../pegawai">pegawai</a></li>
                <li><a href="../pelanggan" class="active">pelanggan</a></li>
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
            <h2 style="margin-top:0;">Edit Pelanggan</h2>
            <form method="POST">
                <label>Nama Pelanggan</label>
                <input type="text" name="nama_pelanggan" value="<?= $data['nama_pelanggan'] ?>" required>
                <label>Kontak</label>
                <input type="text" name="kontak" value="<?= $data['kontak'] ?>" required>
                <button type="submit" name="update">Update</button>
                <a href="index.php" class="btn-batal">Batal</a>
            </form>
        </div>
    </div>
</body>
</html>
