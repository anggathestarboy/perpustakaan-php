<?php
include '../koneksi.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
}

// Handle form simpan perubahan buku
if (isset($_POST['simpan'])) {
    $kode_b = $_POST['kode_b'];
    $judul_buku = $_POST['judul_buku'];

    // Upload gambar jika ada file baru
    if ($_FILES['gambar']['name'] != '') {
        $gambar = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];
        move_uploaded_file($tmp, "../gambar/" . $gambar);

        mysqli_query($koneksi, "UPDATE buku SET judul_buku='$judul_buku', gambar='$gambar' WHERE kode_b='$kode_b'");
    } else {
        mysqli_query($koneksi, "UPDATE buku SET judul_buku='$judul_buku' WHERE kode_b='$kode_b'");
    }

    header("Location: list.php");
    exit;
}

// Handle hapus
if (isset($_GET['hapus'])) {
    $kode_b = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM buku WHERE kode_b='$kode_b'");
    header("Location: list.php");
    exit;
}

// Tangkap keyword search
$keyword = isset($_GET['search']) ? $_GET['search'] : '';

// Query data buku dengan filter pencarian
$query = "SELECT * FROM buku";
if (!empty($keyword)) {
    $query .= " WHERE judul_buku LIKE '%$keyword%'";
}
$data = mysqli_query($koneksi, $query);

// Mode edit
$edit_mode = false;
if (isset($_GET['edit'])) {
    $edit_mode = true;
    $kode_edit = $_GET['edit'];
    $buku = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM buku WHERE kode_b='$kode_edit'"));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Buku</title>
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
        .table thead {
            background-color: var(--main-color);
            color: white;
        }
        .img-thumbnail {
            max-width: 100px;
            height: auto;
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
    <a href="../index.php">📚 Data Peminjaman</a>
    <a href="list.php">📘 Rak Buku</a>
    <a href="../peminjam/list.php">👨 Peminjam</a>
    <a href="../peminjaman/tambah.php">📌 Peminjaman Baru</a>
    <a href="../logout.php">🚪 Logout</a>
</div>

<div class="main-content">
    <h2>Data Buku</h2>

    <?php if ($edit_mode): ?>
    <div class="card shadow mb-4">
        <div class="card-body">
            <h5>Edit Buku</h5>
            <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="kode_b" value="<?= $buku['kode_b'] ?>">
                <div class="mb-3">
                    <label>Judul Buku</label>
                    <input type="text" name="judul_buku" class="form-control" value="<?= $buku['judul_buku'] ?>" required>
                </div>
                <div class="mb-3">
                    <label>Gambar Buku (kosongkan jika tidak diganti)</label>
                    <input type="file" name="gambar" class="form-control">
                    <p class="mt-2">Gambar saat ini:</p>
                    <img src="../gambar/<?= $buku['gambar']; ?>" class="img-thumbnail">
                </div>
                <button type="submit" name="simpan" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>
    <?php endif; ?>

    <div class="card shadow mt-4">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <a href="tambah.php" class="btn btn-primary">+ Tambah Buku</a>
                <form method="get" class="d-flex">
                    <input type="text" name="search" class="form-control me-2" placeholder="Cari judul buku..." value="<?= htmlspecialchars($keyword) ?>">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Judul Buku</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (mysqli_num_rows($data) > 0): ?>
                            <?php while ($d = mysqli_fetch_array($data)) { ?>
                            <tr>
                                <td><?= $d['kode_b']; ?></td>
                                <td><?= $d['judul_buku']; ?></td>
                                <td><img src="../gambar/<?= $d['gambar']; ?>" class="img-thumbnail" alt="Gambar Buku"></td>
                                <td>
                                    <a href="?edit=<?= $d['kode_b'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="?hapus=<?= $d['kode_b'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus buku ini?')">Hapus</a>
                                </td>
                            </tr>
                            <?php } ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada data ditemukan.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>
</html>
