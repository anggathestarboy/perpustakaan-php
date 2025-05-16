<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Tambah Peminjaman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        :root {
            --main-color: #1A237E;
        }
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .sidebar {
            position: fixed;
            width: 220px;
            height: 100vh;
            background-color: var(--main-color);
            color: white;
            padding-top: 30px;
        }
        .sidebar h3 {
            text-align: center;
            margin-bottom: 40px;
            font-weight: bold;
            font-size: 20px;
        }
        .sidebar a {
            display: block;
            padding: 12px 20px;
            color: white;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #0f155e;
        }
        .main-content {
            margin-left: 220px;
            padding: 40px;
        }
        h2 {
            color: var(--main-color);
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 30px;
        }
        label {
            font-weight: 600;
            color: var(--main-color);
        }
        .btn-submit {
            background-color: var(--main-color);
            border: none;
            color: white;
            padding: 10px 20px;
            font-weight: bold;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn-submit:hover {
            background-color: #0f155e;
            color: white;
        }
        .form-control, select {
            max-width: 400px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h3>PERPUSTAKAAN</h3>
    <a href="../index.php">📚 Data Peminjaman</a>
    <a href="../buku/list.php">📘 Rak Buku</a>
    <a href="../peminjam/list.php">👨 Peminjam</a>
    <a href="../peminjaman/tambah.php">📌 Peminjaman Baru</a>

    <a href="../logout.php">🚪 Logout</a>
</div>

<div class="main-content">
    <h2>Tambah Peminjaman</h2>
    <form action="proses_tambah.php" method="post" style="max-width: 500px;">
        <div class="mb-3">
            <label for="kode_p" class="form-label">Kode Peminjaman</label>
            <input type="text" id="kode_p" name="kode_p" class="form-control" required />
        </div>
        <div class="mb-3">
            <label for="ttd_petugas" class="form-label">TTD Petugas</label>
            <input type="text" id="ttd_petugas" name="ttd_petugas" class="form-control" required />
        </div>
        <div class="mb-3">
            <label for="ttd_peminjam" class="form-label">TTD Peminjam</label>
            <input type="text" id="ttd_peminjam" name="ttd_peminjam" class="form-control" required />
        </div>
        <div class="mb-3">
            <label for="tgl_peminjaman" class="form-label">Tanggal Pinjam</label>
            <input type="date" id="tgl_peminjaman" name="tgl_peminjaman" class="form-control" required />
        </div>
        <div class="mb-3">
            <label for="tgl_pengembalian" class="form-label">Tanggal Kembali</label>
            <input type="date" id="tgl_pengembalian" name="tgl_pengembalian" class="form-control" required />
        </div>
        <div class="mb-3">
            <label for="no_anggota" class="form-label">No Anggota</label>
            <select name="no_anggota" id="no_anggota" class="form-select" required>
                <?php
                include '../koneksi.php';
                $q = mysqli_query($koneksi, "SELECT * FROM peminjam");
                while ($d = mysqli_fetch_array($q)) {
                    echo "<option value='$d[no_anggota]'>$d[nm_peminjam]</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="kode_b" class="form-label">Buku</label>
            <select name="kode_b" id="kode_b" class="form-select" required>
                <?php
                $q = mysqli_query($koneksi, "SELECT * FROM buku");
                while ($d = mysqli_fetch_array($q)) {
                    echo "<option value='$d[kode_b]'>$d[judul_buku]</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn-submit">Pinjam</button>
    </form>
</div>

</body>
</html>
