<?php
include "../koneksi.php";

$id = $_GET['id'];

// Ambil data lama
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM potongan_barang WHERE id_potongan='$id'"));

// Simpan ke riwayat
mysqli_query($koneksi, "INSERT INTO potongan_barang_riwayat
    (id_potongan, id_barang, nama_potongan, nilai_potongan, tanggal_mulai, tanggal_selesai, status_awal, status_akhir)
    VALUES (
        '{$data['id_potongan']}',
        '{$data['id_barang']}',
        '{$data['nama_potongan']}',
        '{$data['nilai_potongan']}',
        '{$data['tanggal_mulai']}',
        '{$data['tanggal_selesai']}',
        '{$data['status']}',
        'nonaktif'
    )");

// Update status jadi nonaktif
mysqli_query($koneksi, "UPDATE potongan_barang SET status='nonaktif' WHERE id_potongan='$id'");

header("Location: index.php");
exit;
?>
