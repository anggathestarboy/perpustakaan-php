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
    <title>Tambah Peminjam</title>
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
        .btn-submit {
            background-color: var(--main-color);
            border: none;
            color: white;
            padding: 10px 20px;
            font-weight: bold;
            border-radius: 4px;
        }
        .btn-submit:hover {
            background-color: #0f155e;
            color: white;
        }
        label {
            font-weight: 600;
            color: var(--main-color);
        }
        .form-control {
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
    <a href="list.php">👨 Peminjam</a>
    <a href="../peminjaman/tambah.php">📌 Peminjaman Baru</a>

   <a href="../logout.php">🚪 Logout</a>
</div>

<div class="main-content">
    <h2>Tambah Peminjam</h2>
    <form action="proses_tambah.php" method="post" style="max-width: 500px;">
        <div class="mb-3">
            <label for="no_anggota" class="form-label">No Anggota</label>
            <input type="text" class="form-control" id="no_anggota" name="no_anggota" required />
        </div>
        <div class="mb-3">
            <label for="nm_peminjam" class="form-label">Nama Peminjam</label>
            <input type="text" class="form-control" id="nm_peminjam" name="nm_peminjam" required />
        </div>
        <button type="submit" class="btn-submit">Simpan</button>
    </form>
</div>

</body>
</html>
