<?php
include "../koneksi.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Pelanggan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Data Pelanggan</h2>
    <a href="tambah.php" class="btn">+ Tambah Pelanggan</a>
    <br><br>
    <table>
        <tr>
            <th>ID</th>
            <th>Nama Pelanggan</th>
            <th>Kontak</th>
            <th>Aksi</th>
        </tr>
        <?php
        $result = mysqli_query($koneksi, "SELECT * FROM pelanggan ORDER BY id_pelanggan ASC");
        if (!$result) {
            die("Query gagal: " . mysqli_error($koneksi));
        }
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                <td>{$row['id_pelanggan']}</td>
                <td>{$row['nama_pelanggan']}</td>
                <td>{$row['kontak']}</td>
                <td>
                    <a href='edit.php?id={$row['id_pelanggan']}' class='edit'>Edit</a>
                    <a href='hapus.php?id={$row['id_pelanggan']}' class='hapus' onclick=\"return confirm('Yakin ingin menghapus?')\">Hapus</a>
                </td>
            </tr>";
        }
        ?>
    </table>
</body>
</html>
