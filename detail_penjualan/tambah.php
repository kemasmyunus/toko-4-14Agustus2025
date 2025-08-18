<?php
include '../koneksi.php';

// Ambil data penjualan untuk dropdown
$penjualan = mysqli_query($koneksi, "SELECT * FROM penjualan");
// Ambil data barang untuk dropdown
$barang = mysqli_query($koneksi, "SELECT * FROM barang");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_penjualan = $_POST['id_penjualan'];
    $id_barang = $_POST['id_barang'];
    $imei_sn = $_POST['imei_sn'];
    $jumlah = $_POST['jumlah'];
    $harga_jual = $_POST['harga_jual'];
    $potongan1 = $_POST['potongan1'];
    $potongan2 = $_POST['potongan2'];
    $potongan3 = $_POST['potongan3'];

    $total_setelah_potongan = ($harga_jual * $jumlah) - $potongan1 - $potongan2 - $potongan3;

    $sql = "INSERT INTO detail_penjualan 
            (id_penjualan, id_barang, imei_sn, jumlah, harga_jual, potongan1, potongan2, potongan3, total_setelah_potongan) 
            VALUES ('$id_penjualan','$id_barang','$imei_sn','$jumlah','$harga_jual','$potongan1','$potongan2','$potongan3','$total_setelah_potongan')";

    if (mysqli_query($koneksi, $sql)) {
        header("Location: index.php");
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Detail Penjualan</title>
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
    <div class="header">Toko4 - Tambah Detail Penjualan</div>
    <div class="container">
        <nav class="sidebar">
            <ul>
                <li><a href="../barang">barang</a></li>
                <li><a href="../detail_pembelian">detail_pembelian</a></li>
                <li><a href="../detail_penjualan" class="active">detail_penjualan</a></li>
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
            <h2 style="margin-top:0;">Tambah Detail Penjualan</h2>
            <form method="post">
                <label>Penjualan:</label>
                <select name="id_penjualan" required>
                    <option value="">--Pilih--</option>
                    <?php while($p = mysqli_fetch_assoc($penjualan)) { ?>
                        <option value="<?= $p['id_penjualan'] ?>"><?= $p['tanggal_penjualan'] ?></option>
                    <?php } ?>
                </select>
                <label>Barang:</label>
                <select name="id_barang" required>
                    <option value="">--Pilih--</option>
                    <?php while($b = mysqli_fetch_assoc($barang)) { ?>
                        <option value="<?= $b['id_barang'] ?>"><?= $b['nama_barang'] ?></option>
                    <?php } ?>
                </select>
                <label>IMEI/SN:</label>
                <input type="text" name="imei_sn" required>
                <label>Jumlah:</label>
                <input type="number" name="jumlah" required>
                <label>Harga Jual:</label>
                <input type="number" name="harga_jual" required>
                <label>Potongan 1:</label>
                <input type="number" name="potongan1" value="0">
                <label>Potongan 2:</label>
                <input type="number" name="potongan2" value="0">
                <label>Potongan 3:</label>
                <input type="number" name="potongan3" value="0">
                <button type="submit">Simpan</button>
            </form>
        </div>
    </div>
</body>
</html>
