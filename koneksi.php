<?php
$host     = "localhost";
$user     = "root"; // ganti sesuai username MySQL
$password = "";     // ganti sesuai password MySQL
$db       = "toko4";

$koneksi = mysqli_connect($host, $user, $password, $db);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
