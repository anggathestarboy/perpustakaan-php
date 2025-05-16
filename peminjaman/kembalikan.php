<?php
include '../koneksi.php';
$kode = $_GET['kode_p'];
mysqli_query($koneksi, "UPDATE peminjaman SET status_kembali='sudah' WHERE kode_p='$kode'");
header("Location: ../index.php");
?>
