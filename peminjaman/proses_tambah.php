<?php
include '../koneksi.php';
mysqli_query($koneksi, "INSERT INTO peminjaman 
(kode_p, ttd_petugas, ttd_peminjam, tgl_peminjaman, tgl_pengembalian, no_anggota, kode_b) 
VALUES (
    '$_POST[kode_p]', '$_POST[ttd_petugas]', '$_POST[ttd_peminjam]', 
    '$_POST[tgl_peminjaman]', '$_POST[tgl_pengembalian]', 
    '$_POST[no_anggota]', '$_POST[kode_b]'
)");
header("Location: ../index.php");
?>
