<?php
require '../koneksi.php';

$id = $_GET['id'] ?? '';
if (!$id) {
    die("ID tidak ditemukan");
}

// Ambil data stok
$stok = mysqli_query($koneksi, "SELECT * FROM stok WHERE id_stok = '$id'");
$data = mysqli_fetch_assoc($stok);
if (!$data) {
    die("Data stok tidak ditemukan");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_barang = $_POST['id_barang'];
    $id_gudang = $_POST['id_gudang'];
    $jumlah = $_POST['jumlah'];

    $update = mysqli_query($koneksi, "UPDATE stok SET id_barang='$id_barang', id_gudang='$id_gudang', jumlah='$jumlah' WHERE id_stok='$id'");
    if ($update) {
        header('Location: index.php');
        exit;
    } else {
        echo "Gagal update: " . mysqli_error($koneksi);
    }
}

// Ambil barang (sn = 0)
$barang = mysqli_query($koneksi, "SELECT id_barang, brand, nama_barang, varian FROM barang WHERE sn=0");

// Ambil gudang
$gudang = mysqli_query($koneksi, "SELECT id_gudang, nama_gudang, lokasi FROM gudang");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Stok</title>
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
        select, input[type="number"], input[type="text"] {
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
    <div class="header">Toko4 - Edit Stok</div>
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
                <li><a href="../stok" class="active">stok</a></li>
                <li><a href="../stok_sn">stok_sn</a></li>
                <li><a href="../supplier">supplier</a></li>
                <li><a href="../batch" >batch</a></li>
            </ul>
        </nav>
        <div class="main-content">
            <h2 style="margin-top:0;">Edit Stok</h2>
            <form method="post">
                <label>Barang:</label>
                <select name="id_barang" required>
                    <?php while ($b = mysqli_fetch_assoc($barang)): ?>
                        <option value="<?= $b['id_barang'] ?>" <?= $b['id_barang'] == $data['id_barang'] ? 'selected' : '' ?>>
                            <?= $b['id_barang'] ?> | <?= $b['brand'] . ' ' . $b['nama_barang'] . ' ' . $b['varian'] ?>
                        </option>
                    <?php endwhile; ?>
                </select>
                <label>Gudang:</label>
                <select name="id_gudang" required>
                    <?php while ($g = mysqli_fetch_assoc($gudang)): ?>
                        <option value="<?= $g['id_gudang'] ?>" <?= $g['id_gudang'] == $data['id_gudang'] ? 'selected' : '' ?>>
                            <?= $g['id_gudang'] ?> | <?= $g['nama_gudang'] ?> (<?= $g['lokasi'] ?>)
                        </option>
                    <?php endwhile; ?>
                </select>
                <label>Jumlah:</label>
                <input type="number" name="jumlah" value="<?= $data['jumlah'] ?>" required>
                <button type="submit">Update</button>
            </form>
        </div>
    </div>
</body>
</html>
