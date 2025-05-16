<?php
include '../koneksi.php';

$kode_b = $_POST['kode_b'];
$judul_buku = $_POST['judul_buku'];
$gambar = $_FILES['gambar']['name'];
$tmp = $_FILES['gambar']['tmp_name'];

move_uploaded_file($tmp, "../gambar/" . $gambar);

mysqli_query($koneksi, "INSERT INTO buku VALUES ('$kode_b', '$judul_buku', '$gambar')");
header("Location: list.php");
?>
