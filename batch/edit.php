<?php
include "../koneksi.php";

$id = $_GET['id'] ?? '';
if (!$id) die("ID tidak ditemukan.");

// Ambil data detail_pembelian
$q = mysqli_query($koneksi, "SELECT * FROM detail_pembelian WHERE id_detail_pembelian='$id'");
$data = mysqli_fetch_assoc($q);
if (!$data) die("Data tidak ditemukan.");

// Ambil data pembelian dan barang
$pembelian = mysqli_query($koneksi, "SELECT id_pembelian, tanggal_pembelian FROM pembelian ORDER BY tanggal_pembelian DESC");
$barang = mysqli_query($koneksi, "SELECT id_barang, nama_barang, brand, varian FROM barang ORDER BY nama_barang ASC");
$gudang = mysqli_query($koneksi, "SELECT id_gudang, nama_gudang FROM gudang ORDER BY nama_gudang ASC");

if (isset($_POST['update'])) {
    $id_pembelian = $_POST['id_pembelian'];
    $id_barang = $_POST['id_barang'];
    $jumlah = $_POST['jumlah'];
    $harga_beli = $_POST['harga_beli'];
    $harga_jual = $_POST['harga_jual'];
    $id_gudang = $_POST['id_gudang'];

    $update = mysqli_query($koneksi, "UPDATE detail_pembelian SET 
        id_pembelian='$id_pembelian', 
        id_barang='$id_barang', 
        jumlah='$jumlah', 
        harga_beli='$harga_beli', 
        harga_jual='$harga_jual', 
        id_gudang='$id_gudang'
        WHERE id_detail_pembelian='$id'");
    if ($update) {
        header("Location: index.php");
        exit;
    } else {
        echo "Gagal update batch: " . mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Batch</title>
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
        select, input[type="number"] {
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
    <div class="header">Toko4 - Edit Batch</div>
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
                <li><a href="../supplier">supplier</a></li><li><a href="../batch">batch</a></li>
                <li><a href="../batch">batch</a></li>
            </ul>
        </nav>
        <div class="main-content">
            <h2 style="margin-top:0;">Edit Batch</h2>
            <form method="post">
                <label>Pembelian:</label>
                <select name="id_pembelian" required>
                    <?php while($p = mysqli_fetch_assoc($pembelian)): ?>
                        <option value="<?= $p['id_pembelian'] ?>" <?= $p['id_pembelian'] == $data['id_pembelian'] ? 'selected' : '' ?>>
                            <?= $p['id_pembelian'] ?> (<?= $p['tanggal_pembelian'] ?>)
                        </option>
                    <?php endwhile; ?>
                </select>
                <label>Barang:</label>
                <select name="id_barang" required>
                    <?php mysqli_data_seek($barang, 0); while($b = mysqli_fetch_assoc($barang)): ?>
                        <option value="<?= $b['id_barang'] ?>" <?= $b['id_barang'] == $data['id_barang'] ? 'selected' : '' ?>>
                            <?= $b['nama_barang'] ?> <?= $b['brand'] ?> <?= $b['varian'] ?>
                        </option>
                    <?php endwhile; ?>
                </select>
                <label>Jumlah:</label>
                <input type="number" name="jumlah" min="1" value="<?= $data['jumlah'] ?>" required>
                <label>Harga Beli:</label>
                <input type="number" name="harga_beli" min="0" value="<?= $data['harga_beli'] ?>" required>
                <label>Harga Jual:</label>
                <input type="number" name="harga_jual" min="0" value="<?= $data['harga_jual'] ?>" required>
                <label>Gudang:</label>
                <select name="id_gudang" required>
                    <option value="">Pilih Gudang</option>
                    <?php while($g = mysqli_fetch_assoc($gudang)): ?>
                        <option value="<?= $g['id_gudang'] ?>" <?= $g['id_gudang'] == $data['id_gudang'] ? 'selected' : '' ?>>
                            <?= $g['nama_gudang'] ?>
                        </option>
                    <?php endwhile; ?>
                </select>
                <button type="submit" name="update">Update</button>
            </form>
        </div>
    </div>
</body>
</html>
