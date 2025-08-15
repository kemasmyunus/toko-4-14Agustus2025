<?php
include "../koneksi.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Pegawai</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Data Pegawai</h2>
    <a href="tambah.php" class="btn">+ Tambah Pegawai</a>
    <br><br>
    <table>
        <tr>
            <th>ID</th>
            <th>Nama Pegawai</th>
            <th>Username</th>
            <th>Peran</th>
            <th>Aksi</th>
        </tr>
        <?php
        $result = mysqli_query($koneksi, "SELECT * FROM pegawai ORDER BY id_pegawai ASC");
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                <td>{$row['id_pegawai']}</td>
                <td>{$row['nama_pegawai']}</td>
                <td>{$row['username']}</td>
                <td>{$row['peran']}</td>
                <td>
                    <a href='edit.php?id={$row['id_pegawai']}' class='edit'>Edit</a>
                    <a href='hapus.php?id={$row['id_pegawai']}' class='hapus' onclick=\"return confirm('Yakin ingin menghapus?')\">Hapus</a>
                </td>
            </tr>";
        }
        ?>
    </table>
</body>
</html>
