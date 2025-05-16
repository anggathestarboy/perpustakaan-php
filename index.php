<?php
include 'koneksi.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}


$data = mysqli_query($koneksi, "
    SELECT p.*, b.judul_buku, pm.nm_peminjam 
    FROM peminjaman p
    JOIN buku b ON p.kode_b = b.kode_b
    JOIN peminjam pm ON p.no_anggota = pm.no_anggota
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Peminjaman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --main-color: #1A237E;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
        }

        .sidebar {
            height: 100vh;
            background-color: var(--main-color);
            color: white;
            padding-top: 30px;
            position: fixed;
            width: 220px;
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

        .main-content h2 {
            color: var(--main-color);
            font-weight: bold;
            text-transform: uppercase;
        }

        .btn-primary {
            background-color: var(--main-color);
            border-color: var(--main-color);
        }

        .btn-primary:hover {
            background-color: #0f155e;
            border-color: #0f155e;
        }

        .table thead {
            background-color: var(--main-color);
            color: white;
        }

        .badge-success {
            background-color: green;
        }

        .btn-warning {
            background-color: orange;
            border: none;
            color: white;
        }

        .btn-warning:hover {
            background-color: darkorange;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h3>PERPUSTAKAAN</h3>
    <a href="index.php">📚 Data Peminjaman</a>
    <a href="buku/list.php">📘 Rak Buku</a>
    <a href="peminjam/list.php">👨 Peminjam</a>
    <a href="peminjaman/tambah.php">📌 Peminjaman Baru</a>

    <a href="logout.php">🚪 Logout</a>
</div>

<div class="main-content">
    <h2>Data Peminjaman</h2>
    <div class="card shadow mt-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Buku</th>
                            <th>Tgl Pinjam</th>
                            <th>Tgl Kembali</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($d = mysqli_fetch_array($data)) { ?>
                            <tr>
                                <td><?= $d['kode_p']; ?></td>
                                <td><?= $d['nm_peminjam']; ?></td>
                                <td><?= $d['judul_buku']; ?></td>
                                <td><?= $d['tgl_peminjaman']; ?></td>
                                <td><?= $d['tgl_pengembalian']; ?></td>
                                <td>
                                    <?php if ($d['status_kembali'] == 'belum') { ?>
                                        <a href="peminjaman/kembalikan.php?kode_p=<?= $d['kode_p']; ?>" class="btn btn-sm btn-warning">Tandai Sudah</a>
                                    <?php } else { ?>
                                        <span class="badge bg-success">Sudah</span>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>
</html>
