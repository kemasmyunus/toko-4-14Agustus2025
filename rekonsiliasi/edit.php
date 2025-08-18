<?php
include "../koneksi.php";

// Ambil data penjualan untuk dropdown
$penjualan = mysqli_query($koneksi, "
    SELECT p.id_penjualan, pl.nama_pelanggan, p.tanggal_penjualan 
    FROM penjualan p
    LEFT JOIN pelanggan pl ON p.id_pelanggan = pl.id_pelanggan
    ORDER BY p.id_penjualan DESC
");

$id = $_GET['id'] ?? 0;
$data = mysqli_query($koneksi, "SELECT * FROM rekonsiliasi WHERE id_rekonsiliasi='$id'");
$row = mysqli_fetch_assoc($data);

if (!$row) {
    die("Data tidak ditemukan!");
}

// Proses update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_penjualan = $_POST['id_penjualan'];
    $metode       = $_POST['metode_pembayaran'];
    $tanggal      = $_POST['tanggal_transaksi'];
    $status       = $_POST['status_pembayaran'];
    $nominal      = $_POST['nominal'];

    $sql = "UPDATE rekonsiliasi SET 
                id_penjualan='$id_penjualan',
                metode_pembayaran='$metode',
                tanggal_transaksi='$tanggal',
                status_pembayaran='$status',
                nominal='$nominal'
            WHERE id_rekonsiliasi='$id'";

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
    <title>Edit Rekonsiliasi</title>
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
    <div class="header">Toko4 - Edit Data Rekonsiliasi</div>
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
                <li><a href="../batch" >batch</a></li>
            </ul>
        </nav>
        <div class="main-content">
            <h2 style="margin-top:0;">Edit Data Rekonsiliasi</h2>
            <form method="POST">
                <label>ID Penjualan:</label>
                <select name="id_penjualan" required>
                    <?php while($pj = mysqli_fetch_assoc($penjualan)) { ?>
                        <option value="<?= $pj['id_penjualan'] ?>" <?= ($pj['id_penjualan'] == $row['id_penjualan']) ? 'selected' : '' ?>>
                            <?= $pj['id_penjualan']." - ".$pj['nama_pelanggan']." (".$pj['tanggal_penjualan'].")" ?>
                        </option>
                    <?php } ?>
                </select>
                <label>Metode Pembayaran:</label>
                <select name="metode_pembayaran" required>
                    <option value="cash" <?= ($row['metode_pembayaran']=="cash"?"selected":"") ?>>Cash</option>
                    <option value="qris" <?= ($row['metode_pembayaran']=="qris"?"selected":"") ?>>QRIS</option>
                    <option value="ewallet" <?= ($row['metode_pembayaran']=="ewallet"?"selected":"") ?>>E-Wallet</option>
                    <option value="bank" <?= ($row['metode_pembayaran']=="bank"?"selected":"") ?>>Bank Transfer</option>
                </select>
                <label>Tanggal Transaksi:</label>
                <input type="date" name="tanggal_transaksi" value="<?= $row['tanggal_transaksi'] ?>" required>
                <label>Status Pembayaran:</label>
                <select name="status_pembayaran" required>
                    <option value="lunas" <?= ($row['status_pembayaran']=="lunas"?"selected":"") ?>>Lunas</option>
                    <option value="belum lunas" <?= ($row['status_pembayaran']=="belum lunas"?"selected":"") ?>>Belum Lunas</option>
                </select>
                <label>Nominal:</label>
                <input type="number" name="nominal" value="<?= $row['nominal'] ?>" required>
                <button type="submit">Update</button>
            </form>
        </div>
    </div>
</body>
</html>
