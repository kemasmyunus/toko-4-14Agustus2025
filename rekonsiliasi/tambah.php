<?php
include "../koneksi.php";

// Ambil data penjualan join pelanggan
$penjualan = mysqli_query($koneksi, "
    SELECT p.id_penjualan, pl.nama_pelanggan, p.tanggal_penjualan 
    FROM penjualan p
    LEFT JOIN pelanggan pl ON p.id_pelanggan = pl.id_pelanggan
    ORDER BY p.id_penjualan DESC
");

// Proses simpan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_penjualan = $_POST['id_penjualan'];
    $metode       = $_POST['metode_pembayaran'];
    $tanggal      = $_POST['tanggal_transaksi'];
    $status       = $_POST['status_pembayaran'];
    $nominal      = $_POST['nominal'];

    $sql = "INSERT INTO rekonsiliasi (id_penjualan, metode_pembayaran, tanggal_transaksi, status_pembayaran, nominal)
            VALUES ('$id_penjualan','$metode','$tanggal','$status','$nominal')";
    if (mysqli_query($koneksi, $sql)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Rekonsiliasi</title>
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
        select, input[type="number"], input[type="date"], input[type="text"] {
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
    <div class="header">Toko4 - Tambah Data Rekonsiliasi</div>
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
            <h2 style="margin-top:0;">Tambah Data Rekonsiliasi</h2>
            <form method="POST">
                <label>ID Penjualan:</label>
                <select name="id_penjualan" required>
                    <option value="">--Pilih Penjualan--</option>
                    <?php while($pj = mysqli_fetch_assoc($penjualan)) { ?>
                        <option value="<?= $pj['id_penjualan'] ?>">
                            <?= $pj['id_penjualan']." - ".$pj['nama_pelanggan']." (".$pj['tanggal_penjualan'].")" ?>
                        </option>
                    <?php } ?>
                </select>
                <label>Metode Pembayaran:</label>
                <select name="metode_pembayaran" required>
                    <option value="cash">Cash</option>
                    <option value="qris">QRIS</option>
                    <option value="ewallet">E-Wallet</option>
                    <option value="bank">Bank Transfer</option>
                </select>
                <label>Tanggal Transaksi:</label>
                <input type="date" name="tanggal_transaksi" required>
                <label>Status Pembayaran:</label>
                <select name="status_pembayaran" required>
                    <option value="lunas">Lunas</option>
                    <option value="belum lunas">Belum Lunas</option>
                </select>
                <label>Nominal:</label>
                <input type="number" name="nominal" required>
                <button type="submit">Simpan</button>
            </form>
        </div>
    </div>
</body>
</html>
