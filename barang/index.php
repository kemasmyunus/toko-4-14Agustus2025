<?php
include "../koneksi.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Barang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Data Barang</h2>
    <a href="tambah.php">+ Tambah Barang</a>
    <br><br>
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Kode Barang</th>
            <th>SKU</th>
            <th>Nama Barang</th>
            <th>Varian</th>
            <th>Brand</th>
            <th>Kategori</th>
            <th>Harga Jual</th>
            <th>Aksi</th>
        </tr>
        <?php
        $query = mysqli_query($koneksi, "SELECT * FROM barang ORDER BY id_barang DESC");
        while ($row = mysqli_fetch_assoc($query)) {
            echo "<tr>
                    <td>{$row['id_barang']}</td>
                    <td>{$row['kode_barang']}</td>
                    <td>{$row['sku']}</td>
                    <td>{$row['nama_barang']}</td>
                    <td>{$row['varian']}</td>
                    <td>{$row['brand']}</td>
                    <td>{$row['kategori']}</td>
                    <td>Rp. {$row['harga_jual_default']}</td>
                    <td>
                        <a href='edit.php?id={$row['id_barang']}'>Edit</a> | 
                        <a href='hapus.php?id={$row['id_barang']}' onclick=\"return confirm('Yakin hapus?')\">Hapus</a>
                    </td>
                  </tr>";
        }
        ?>
    </table>
</body>
</html>
