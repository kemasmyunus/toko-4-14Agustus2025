<?php
include "../koneksi.php";

$today = date('Y-m-d');

// Ambil diskon yang expired dan masih aktif
$res = mysqli_query($koneksi, "SELECT * FROM potongan_barang 
                               WHERE tanggal_selesai < '$today' AND status='aktif'");
while($row = mysqli_fetch_assoc($res)){
    // Simpan ke riwayat
    mysqli_query($koneksi, "INSERT INTO potongan_barang_riwayat
        (id_potongan, id_barang, nama_potongan, nilai_potongan, tanggal_mulai, tanggal_selesai, status_awal, status_akhir)
        VALUES (
            '{$row['id_potongan']}',
            '{$row['id_barang']}',
            '{$row['nama_potongan']}',
            '{$row['nilai_potongan']}',
            '{$row['tanggal_mulai']}',
            '{$row['tanggal_selesai']}',
            '{$row['status']}',
            'nonaktif'
        )");
}

// Update status jadi nonaktif
mysqli_query($koneksi, "UPDATE potongan_barang 
                        SET status='nonaktif' 
                        WHERE tanggal_selesai < '$today' AND status='aktif'");