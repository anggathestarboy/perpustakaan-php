<?php
include '../koneksi.php';
$no = $_POST['no_anggota'];
$nama = $_POST['nm_peminjam'];
mysqli_query($koneksi, "INSERT INTO peminjam VALUES ('$no', '$nama')");
header("Location: list.php");
?>
