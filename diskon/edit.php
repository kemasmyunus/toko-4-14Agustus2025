<?php
include "../koneksi.php";

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM potongan_barang WHERE id_potongan='$id'"));

if(isset($_POST['update'])){
    $nama_potongan = $_POST['nama_potongan'];
    $nilai_potongan = $_POST['nilai_potongan'];
    $tgl_mulai = $_POST['tanggal_mulai'];
    $tgl_selesai = $_POST['tanggal_selesai'];

    $sql = "UPDATE potongan_barang SET
            nama_potongan='$nama_potongan',
            nilai_potongan='$nilai_potongan',
            tanggal_mulai='$tgl_mulai',
            tanggal_selesai='$tgl_selesai'
            WHERE id_potongan='$id'";
    mysqli_query($koneksi, $sql);
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Diskon</title>
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
        input[type="number"], input[type="text"], input[type="date"] {
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
    <div class="header">Toko4 - Edit Diskon Barang</div>
    <div class="container">
        <nav class="sidebar">
            <ul>
                <li><a href="../barang">barang</a></li>
                <li><a href="../detail_pembelian">detail_pembelian</a></li>
                <li><a href="../detail_penjualan">detail_penjualan</a></li>
                <li><a href="../diskon" class="active">diskon</a></li>
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
            </ul>
        </nav>
        <div class="main-content">
            <h2 style="margin-top:0;">Edit Diskon Barang</h2>
            <form method="post">
                <label>Nama Potongan:</label>
                <input type="text" name="nama_potongan" value="<?= $data['nama_potongan'] ?>" required>
                <label>Nilai Potongan (Rp):</label>
                <input type="number" name="nilai_potongan" value="<?= $data['nilai_potongan'] ?>" required>
                <label>Tanggal Mulai:</label>
                <input type="date" name="tanggal_mulai" value="<?= $data['tanggal_mulai'] ?>" required>
                <label>Tanggal Selesai:</label>
                <input type="date" name="tanggal_selesai" value="<?= $data['tanggal_selesai'] ?>" required>
                <button type="submit" name="update">Update</button>
            </form>
        </div>
    </div>
</body>
</html>
