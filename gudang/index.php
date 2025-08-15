<?php
include "../koneksi.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Gudang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Data Gudang</h2>
    <a href="tambah.php" class="btn">+ Tambah Gudang</a>
    <br><br>
    <table>
        <tr>
            <th>ID</th>
            <th>Nama Gudang</th>
            <th>Lokasi</th>
            <th>Aksi</th>
        </tr>
        <?php
        $result = mysqli_query($koneksi, "SELECT * FROM gudang ORDER BY id_gudang ASC");
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                <td>{$row['id_gudang']}</td>
                <td>{$row['nama_gudang']}</td>
                <td>{$row['lokasi']}</td>
                <td>
                    <a href='edit.php?id={$row['id_gudang']}' class='edit'>Edit</a>
                    <a href='hapus.php?id={$row['id_gudang']}' class='hapus' onclick=\"return confirm('Yakin ingin menghapus?')\">Hapus</a>
                </td>
            </tr>";
        }
        ?>
    </table>
</body>
</html>
