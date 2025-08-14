<?php
include "../koneksi.php";
$nama = $_POST['nama_pelanggan'];
$kontak = $_POST['kontak'];
mysqli_query($koneksi, "INSERT INTO pelanggan (nama_pelanggan, kontak) VALUES ('$nama', '$kontak')");
