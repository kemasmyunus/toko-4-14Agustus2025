<?php
include "../koneksi.php";
$q = mysqli_query($koneksi, "SELECT * FROM pelanggan ORDER BY nama_pelanggan ASC");
echo '<option value="">--Pilih Pelanggan--</option>';
while($d = mysqli_fetch_assoc($q)){
    echo "<option value='{$d['id_pelanggan']}'>{$d['nama_pelanggan']} ({$d['id_pelanggan']})</option>";
}
