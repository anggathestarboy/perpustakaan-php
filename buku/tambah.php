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
    <title>Tambah Buku</title>
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
        .btn-primary {
            background-color: var(--main-color);
            border-color: var(--main-color);
        }
        .btn-primary:hover {
            background-color: #0f155e;
            border-color: #0f155e;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h3>PERPUSTAKAAN</h3>
    <a href="../index.php">📚 Data Peminjaman</a>
    <a href="list.php">📘 Rak Buku</a>
    <a href="../peminjam/list.php">👨 Peminjam</a>
    <a href="../peminjaman/tambah.php">📌 Peminjaman Baru</a>
        <a href="../logout.php">🚪 Logout</a>
</div>

<div class="main-content">
    <h2>Tambah Buku</h2>
    <form action="proses_tambah.php" method="post" enctype="multipart/form-data" class="w-50">
        <div class="mb-3">
            <label for="kode_b" class="form-label">Kode Buku</label>
            <input type="text" class="form-control" id="kode_b" name="kode_b" required />
        </div>
        <div class="mb-3">
            <label for="judul_buku" class="form-label">Judul Buku</label>
            <input type="text" class="form-control" id="judul_buku" name="judul_buku" required />
        </div>
        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar Buku</label>
            <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*" required />
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

</body>
</html>
