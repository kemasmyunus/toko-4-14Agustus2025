<?php
require '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_barang = $_POST['id_barang'];
    $id_gudang = $_POST['id_gudang'];
    $imei_sn = $_POST['imei_sn'];
    $imei1 = $_POST['imei1'];
    $imei2 = $_POST['imei2'];
    $status = $_POST['status'];

    $insert = mysqli_query($koneksi, "INSERT INTO stok_sn (id_barang, id_gudang, imei_sn, imei1, imei2, status) VALUES ('$id_barang','$id_gudang','$imei_sn','$imei1','$imei2','$status')");
    if ($insert) {
        header('Location: index.php');
        exit;
    } else {
        echo "Gagal: " . mysqli_error($koneksi);
    }
}

// Ambil barang (sn = 1)
$barang = mysqli_query($koneksi, "SELECT id_barang, brand, nama_barang, varian FROM barang WHERE sn=1");

// Ambil gudang
$gudang = mysqli_query($koneksi, "SELECT id_gudang, nama_gudang, lokasi FROM gudang");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Stok SN</title>
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
        select, input[type="text"] {
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
    <div class="header">Toko4 - Tambah Stok SN</div>
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
                <li><a href="../stok_sn" class="active">stok_sn</a></li>
                <li><a href="../supplier">supplier</a></li>
                <li><a href="../batch" >batch</a></li>
            </ul>
        </nav>
        <div class="main-content">
            <h2 style="margin-top:0;">Tambah Stok SN</h2>
            <form method="post">
                <label>Barang:</label>
                <select name="id_barang" required>
                    <option value="">Pilih Barang</option>
                    <?php while ($b = mysqli_fetch_assoc($barang)): ?>
                        <option value="<?= $b['id_barang'] ?>">
                            <?= $b['id_barang'] ?> | <?= $b['brand'] . ' ' . $b['nama_barang'] . ' ' . $b['varian'] ?>
                        </option>
                    <?php endwhile; ?>
                </select>

                <label>Gudang:</label>
                <select name="id_gudang" required>
                    <option value="">Pilih Gudang</option>
                    <?php while ($g = mysqli_fetch_assoc($gudang)): ?>
                        <option value="<?= $g['id_gudang'] ?>">
                            <?= $g['id_gudang'] ?> | <?= $g['nama_gudang'] ?> (<?= $g['lokasi'] ?>)
                        </option>
                    <?php endwhile; ?>
                </select>

                <label>IMEI/SN:</label>
                <input type="text" name="imei_sn" required>

                <label>IMEI1:</label>
                <input type="text" name="imei1">

                <label>IMEI2:</label>
                <input type="text" name="imei2">

                <label>Status:</label>
                <select name="status" required>
                    <option value="">Pilih Status</option>
                    <option value="tersedia">Tersedia</option>
                    <option value="terjual">Terjual</option>
                </select>

                <button type="submit">Simpan</button>
            </form>
        </div>
    </div>
</body>
</html>
