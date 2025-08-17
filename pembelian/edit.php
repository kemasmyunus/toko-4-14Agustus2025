<?php
include "../koneksi.php";

$id = $_GET['id'];
$sql = mysqli_query($koneksi, "SELECT * FROM pembelian WHERE id_pembelian='$id'");
$data = mysqli_fetch_assoc($sql);

if (isset($_POST['update'])) {
    $tanggal     = $_POST['tanggal_pembelian'];
    $id_supplier = $_POST['id_supplier'];
    $total       = $_POST['total_pembelian'];
    $id_pegawai  = $_POST['id_pegawai'];

    $update = "UPDATE pembelian SET 
                tanggal_pembelian='$tanggal',
                id_supplier='$id_supplier',
                total_pembelian='$total',
                id_pegawai='$id_pegawai'
               WHERE id_pembelian='$id'";
    if (mysqli_query($koneksi, $update)) {
        header("Location: index.php");
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Pembelian</title>
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
        select, input[type="number"], input[type="date"] {
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
    <div class="header">Toko4 - Edit Pembelian</div>
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
                <li><a href="../pembelian" class="active">pembelian</a></li>
                <li><a href="../penjualan">penjualan</a></li>
                <li><a href="../pos">pos</a></li>
                <li><a href="../rekonsiliasi">rekonsiliasi</a></li>
                <li><a href="../stok">stok</a></li>
                <li><a href="../stok_sn">stok_sn</a></li>
                <li><a href="../supplier">supplier</a></li>
            </ul>
        </nav>
        <div class="main-content">
            <h2 style="margin-top:0;">Edit Pembelian</h2>
            <form method="post">
                <label>Tanggal Pembelian</label>
                <input type="date" name="tanggal_pembelian" value="<?= $data['tanggal_pembelian'] ?>">
                <label>Supplier</label>
                <select name="id_supplier">
                    <?php
                    $q = mysqli_query($koneksi, "SELECT * FROM supplier");
                    while ($r = mysqli_fetch_assoc($q)) {
                        $sel = ($r['id_supplier'] == $data['id_supplier']) ? "selected" : "";
                        echo "<option value='{$r['id_supplier']}' $sel>{$r['nama_supplier']}</option>";
                    }
                    ?>
                </select>
                <label>Total Pembelian</label>
                <input type="number" name="total_pembelian" value="<?= $data['total_pembelian'] ?>">
                <label>Pegawai</label>
                <select name="id_pegawai">
                    <?php
                    $q = mysqli_query($koneksi, "SELECT * FROM pegawai");
                    while ($r = mysqli_fetch_assoc($q)) {
                        $sel = ($r['id_pegawai'] == $data['id_pegawai']) ? "selected" : "";
                        echo "<option value='{$r['id_pegawai']}' $sel>{$r['nama_pegawai']}</option>";
                    }
                    ?>
                </select>
                <button type="submit" name="update">Update</button>
            </form>
        </div>
    </div>
</body>
</html>
