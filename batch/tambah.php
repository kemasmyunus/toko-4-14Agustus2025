<?php
include "../koneksi.php";

// Ambil data pembelian, barang, gudang
$pembelian = mysqli_query($koneksi, "SELECT id_pembelian, tanggal_pembelian FROM pembelian ORDER BY tanggal_pembelian DESC");
$barang = mysqli_query($koneksi, "SELECT id_barang, nama_barang, brand, varian FROM barang ORDER BY nama_barang ASC");
$gudang = mysqli_query($koneksi, "SELECT id_gudang, nama_gudang FROM gudang ORDER BY nama_gudang ASC");

if (isset($_POST['simpan'])) {
    $id_pembelian = $_POST['id_pembelian'];
    $id_barang = $_POST['id_barang'];
    $jumlah = $_POST['jumlah'];
    $harga_beli = $_POST['harga_beli'];
    $harga_jual = $_POST['harga_jual'];
    $id_gudang = $_POST['id_gudang'];

    $insert = mysqli_query($koneksi, "INSERT INTO detail_pembelian (id_pembelian, id_barang, jumlah, harga_beli, harga_jual, id_gudang) VALUES ('$id_pembelian', '$id_barang', '$jumlah', '$harga_beli', '$harga_jual', '$id_gudang')");
    if ($insert) {
        header("Location: index.php");
        exit;
    } else {
        echo "Gagal menambah batch: " . mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Batch</title>
    <style>
        body { margin: 0; font-family: Arial, sans-serif; background: #f5f5f5; color: #000; }
        .header { background: #f5f5f5; color: #000; padding: 16px 24px; font-size: 22px; font-weight: bold; border-bottom: 1px solid #e0e0e0; }
        .container { display: flex; min-height: 100vh; }
        .sidebar { width: 220px; background: #f5f5f5; padding: 0; border-right: 1px solid #e0e0e0; min-height: 100vh; }
        .sidebar ul { list-style: none; margin: 0; padding: 0; }
        .sidebar li { margin: 0; }
        .sidebar a { display: block; color: #000; text-decoration: none; padding: 14px 24px; border-left: 4px solid transparent; }
        .sidebar a.active, .sidebar a:hover { background: #fff; border-left: 4px solid #000; font-weight: bold; }
        .main-content { flex: 1; background: #fff; padding: 32px 40px; }
        form { max-width: 420px; background: #fff; padding: 24px 28px 18px 28px; border: 1px solid #f5f5f5; border-radius: 4px; }
        label { display: block; margin-bottom: 6px; font-weight: bold; }
        select, input[type="number"] { width: 100%; padding: 8px 10px; margin-bottom: 16px; border: 1px solid #f5f5f5; border-radius: 3px; background: #f5f5f5; color: #000; font-size: 15px; }
        button[type="submit"] { background: #f5f5f5; color: #000; border: 1px solid #e0e0e0; padding: 8px 18px; border-radius: 3px; font-size: 15px; cursor: pointer; }
        button[type="submit"]:hover { background: #fff; border-left: 4px solid #000; font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">Toko4 - Tambah Batch</div>
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
                <li><a href="../supplier">supplier</a></li>
                <li><a href="../batch" class="active">batch</a></li>
            </ul>
        </nav>
        <div class="main-content">
            <h2 style="margin-top:0;">Tambah Batch</h2>
            <form method="post">
                <label>Pembelian:</label>
                <select name="id_pembelian" required>
                    <option value="">Pilih Pembelian</option>
                    <?php while($p = mysqli_fetch_assoc($pembelian)): ?>
                        <option value="<?= $p['id_pembelian'] ?>">
                            <?= $p['id_pembelian'] ?> (<?= $p['tanggal_pembelian'] ?>)
                        </option>
                    <?php endwhile; ?>
                </select>
                <label>Barang:</label>
                <select name="id_barang" required>
                    <option value="">Pilih Barang</option>
                    <?php while($b = mysqli_fetch_assoc($barang)): ?>
                        <option value="<?= $b['id_barang'] ?>">
                            <?= $b['nama_barang'] ?> <?= $b['brand'] ?> <?= $b['varian'] ?>
                        </option>
                    <?php endwhile; ?>
                </select>
                <label>Jumlah:</label>
                <input type="number" name="jumlah" min="1" required>
                <label>Harga Beli:</label>
                <input type="number" name="harga_beli" min="0" required>
                <label>Harga Jual:</label>
                <input type="number" name="harga_jual" min="0" required>
                <label>Gudang:</label>
                <select name="id_gudang" required>
                    <option value="">Pilih Gudang</option>
                    <?php while($g = mysqli_fetch_assoc($gudang)): ?>
                        <option value="<?= $g['id_gudang'] ?>">
                            <?= $g['nama_gudang'] ?>
                        </option>
                    <?php endwhile; ?>
                </select>
                <button type="submit" name="simpan">Simpan</button>
            </form>
        </div>
    </div>
</body>
</html>
