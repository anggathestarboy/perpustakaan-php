-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 16, 2025 at 07:32 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan_revolusi`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'anggara', 'aksata');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `kode_b` varchar(4) NOT NULL,
  `judul_buku` varchar(100) DEFAULT NULL,
  `gambar` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`kode_b`, `judul_buku`, `gambar`) VALUES
('B001', 'Sejarah Dunia Yang disembunyikan', 'createthumb.jpg'),
('B002', 'Sejarah Indonesia', 'images.jpg'),
('B003', 'Adolf Hiter Mati di Indonesia', '438-scaled.jpg'),
('B005', 'Madilog - Tan Malaka', 'madilog.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `peminjam`
--

CREATE TABLE `peminjam` (
  `no_anggota` varchar(4) NOT NULL,
  `nm_peminjam` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `peminjam`
--

INSERT INTO `peminjam` (`no_anggota`, `nm_peminjam`) VALUES
('A001', 'ACHMAD ABYUDAYA ADINATA'),
('A002', 'AFREZA ROCHMAD PRATAMA'),
('A003', 'ALVIAN ADITYA ANWAR'),
('A004', 'ARINI NAZHROTUL HIKMAH'),
('A005', 'AZILIA KIRANA'),
('A006', 'BUNGA APRILIA ARISKA'),
('A007', 'DEVANDA AMELIA'),
('A008', 'DITA AYU MAHARANI'),
('A009', 'ERIN DUWI YUFIAN'),
('A010', 'GARNIS DWI ENGARIANTI'),
('A011', 'INTAN NUR KAMILA'),
('A012', 'JAUHARIL FATHONI NAUFALDI'),
('A013', 'KEYLA LARASATI'),
('A014', 'KUKUH MASUNI HARTIANTO'),
('A015', 'LEANDRA DEVLIN CEZARE PHUTRA'),
('A016', 'MAULIDANI BRIAN MELVINO'),
('A017', 'MEGA INDAH NUR AZIZAH'),
('A018', 'MUHAMAD ARKAN FAUZI'),
('A019', 'MUHAMMAD AFFAN HUSSEIN'),
('A020', 'MUHAMMAD ALFARIZI FIRDAIDS'),
('A021', 'MUHAMMAD ALFIAN ZAKI ALFARIS'),
('A022', 'MUHAMMAD REIFAN HANAFI'),
('A023', 'MUHAMMAD REISYA ADANDI'),
('A024', 'NAJWA FARADISSA'),
('A025', 'NATASYA WAHYU AINI'),
('A026', 'NIDHOM MUZAKY'),
('A027', 'NVIDIANDRA RAFI PUTRA W'),
('A028', 'RAKA SATRIA NURSETO'),
('A029', 'RIZQI ANGGARA EFENDI'),
('A030', 'ROHMATUL UMMAH'),
('A031', 'RYOUKOU ARYA NUGROHO'),
('A032', 'SELVUNA SAPUTRI'),
('A033', 'SHIREN MARSYA LEONATA'),
('A034', 'SURYA DHARMA ALI'),
('A035', 'SYIFA RISMAWATI'),
('A036', 'VIRZA HANNA NUR AISYAH');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `kode_p` varchar(4) NOT NULL,
  `ttd_petugas` varchar(100) DEFAULT NULL,
  `ttd_peminjam` varchar(100) DEFAULT NULL,
  `tgl_peminjaman` date DEFAULT NULL,
  `tgl_pengembalian` date DEFAULT NULL,
  `no_anggota` varchar(4) DEFAULT NULL,
  `kode_b` varchar(4) DEFAULT NULL,
  `status_kembali` enum('belum','sudah') DEFAULT 'belum'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`kode_p`, `ttd_petugas`, `ttd_peminjam`, `tgl_peminjaman`, `tgl_pengembalian`, `no_anggota`, `kode_b`, `status_kembali`) VALUES
('P001', 'Wiliam', 'Anggara', '2008-12-12', '1990-12-12', 'A029', 'B003', 'sudah'),
('P002', 'Wiliam', 'Abyudaya', '2000-12-12', '2023-12-12', 'A001', 'B005', 'sudah');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`kode_b`);

--
-- Indexes for table `peminjam`
--
ALTER TABLE `peminjam`
  ADD PRIMARY KEY (`no_anggota`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`kode_p`),
  ADD KEY `no_anggota` (`no_anggota`),
  ADD KEY `kode_b` (`kode_b`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`no_anggota`) REFERENCES `peminjam` (`no_anggota`),
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`kode_b`) REFERENCES `buku` (`kode_b`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
