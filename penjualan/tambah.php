<?php
include "../koneksi.php";

// Ambil data pelanggan
$pelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan ORDER BY nama_pelanggan");
// Ambil data pegawai
$pegawai   = mysqli_query($koneksi, "SELECT * FROM pegawai ORDER BY nama_pegawai");

// Proses simpan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tanggal  = $_POST['tanggal_penjualan'];
    $id_pel   = $_POST['id_pelanggan'];
    $id_peg   = $_POST['id_pegawai'];
    $metode   = $_POST['metode_pembayaran'];
    $total    = $_POST['total'];
    $diskon   = $_POST['diskon'];
    $subtotal = $_POST['subtotal'];
    $sisa     = $_POST['sisa_bayar'];

    $sql = "INSERT INTO penjualan (tanggal_penjualan, id_pelanggan, id_pegawai, metode_pembayaran, total, diskon, subtotal, sisa_bayar)
            VALUES ('$tanggal','$id_pel','$id_peg','$metode','$total','$diskon','$subtotal','$sisa')";
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
    <title>Tambah Penjualan</title>
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
    <div class="header">Toko4 - Tambah Data Penjualan</div>
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
                <li><a href="../penjualan" class="active">penjualan</a></li>
                <li><a href="../pos">pos</a></li>
                <li><a href="../rekonsiliasi">rekonsiliasi</a></li>
                <li><a href="../stok">stok</a></li>
                <li><a href="../stok_sn">stok_sn</a></li>
                <li><a href="../supplier">supplier</a></li>
                <li><a href="../batch" >batch</a></li>
            </ul>
        </nav>
        <div class="main-content">
            <h2 style="margin-top:0;">Tambah Data Penjualan</h2>
            <form method="POST">
                <label>Tanggal Penjualan:</label>
                <input type="date" name="tanggal_penjualan" required>
                <label>Pelanggan:</label>
                <select name="id_pelanggan" required>
                    <option value="">--Pilih Pelanggan--</option>
                    <?php while($pl = mysqli_fetch_assoc($pelanggan)) { ?>
                        <option value="<?= $pl['id_pelanggan'] ?>"><?= $pl['nama_pelanggan'] ?></option>
                    <?php } ?>
                </select>
                <label>Pegawai:</label>
                <select name="id_pegawai" required>
                    <option value="">--Pilih Pegawai--</option>
                    <?php while($pg = mysqli_fetch_assoc($pegawai)) { ?>
                        <option value="<?= $pg['id_pegawai'] ?>"><?= $pg['nama_pegawai'] ?></option>
                    <?php } ?>
                </select>
                <label>Metode Pembayaran:</label>
                <input type="text" name="metode_pembayaran" required>
                <label>Total:</label>
                <input type="number" name="total" required>
                <label>Diskon:</label>
                <input type="number" name="diskon">
                <label>Subtotal:</label>
                <input type="number" name="subtotal" required>
                <label>Sisa Bayar:</label>
                <input type="number" name="sisa_bayar" required>
                <button type="submit">Simpan</button>
            </form>
        </div>
    </div>
</body>
</html>
