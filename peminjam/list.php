<?php
include '../koneksi.php';

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
}

if (isset($_POST['simpan'])) {
    $no_anggota = $_POST['no_anggota'];
    $nm_peminjam = $_POST['nm_peminjam'];

    mysqli_query($koneksi, "UPDATE peminjam SET nm_peminjam='$nm_peminjam' WHERE no_anggota='$no_anggota'");
    header("Location: list.php");
    exit;
}

if (isset($_GET['hapus'])) {
    $no_anggota = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM peminjam WHERE no_anggota='$no_anggota'");
    header("Location: list.php");
    exit;
}

$edit_mode = false;
if (isset($_GET['edit'])) {
    $edit_mode = true;
    $no_edit = $_GET['edit'];
    $peminjam = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM peminjam WHERE no_anggota='$no_edit'"));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Data Peminjam</title>
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
        .btn-tambah {
            background-color: var(--main-color);
            border: none;
            margin-bottom: 20px;
        }
        .btn-tambah:hover {
            background-color: #0f155e;
        }
        table {
            width: 100%;
        }
        thead {
            background-color: var(--main-color);
            color: white;
        }
        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tbody tr:hover {
            background-color: #d1d9ff;
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
    <h2>Data Peminjam</h2>

    <?php if ($edit_mode): ?>
    <div class="card shadow mb-4">
        <div class="card-body">
            <h5>Edit Peminjam</h5>
            <form method="post">
                <input type="hidden" name="no_anggota" value="<?= $peminjam['no_anggota'] ?>">
                <div class="mb-3">
                    <label>Nama Peminjam</label>
                    <input type="text" name="nm_peminjam" class="form-control" value="<?= $peminjam['nm_peminjam'] ?>" required>
                </div>
                <button type="submit" name="simpan" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>
    <?php endif; ?>

    <a href="tambah.php" class="btn btn-primary btn-tambah">+ Tambah Peminjam</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No Anggota</th>
                <th>Nama Peminjam</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $data = mysqli_query($koneksi, "SELECT * FROM peminjam");
            while ($d = mysqli_fetch_array($data)) {
                echo "<tr>
                        <td>{$d['no_anggota']}</td>
                        <td>{$d['nm_peminjam']}</td>
                        <td>
                            <a href='?edit={$d['no_anggota']}' class='btn btn-warning btn-sm'>Edit</a>
                            <a href='?hapus={$d['no_anggota']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin hapus data ini?\")'>Hapus</a>
                        </td>
                    </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
