-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2025 at 12:56 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `po`
--

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE `divisi` (
  `id_divisi` int(11) NOT NULL,
  `bidang` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`id_divisi`, `bidang`) VALUES
(1, 'HRD'),
(2, 'Marketing'),
(3, 'Keuangan'),
(4, 'IT'),
(5, 'GA'),
(6, 'Direktur'),
(7, 'SPV'),
(8, 'Staff'),
(9, 'Selesai'),
(10, 'Batal');

-- --------------------------------------------------------

--
-- Table structure for table `harga`
--

CREATE TABLE `harga` (
  `id_harga` int(11) NOT NULL,
  `nama_item` int(11) NOT NULL,
  `harga_modal` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `harga_jual_mitra` int(11) NOT NULL,
  `harga_provinsi` int(11) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `harga`
--

INSERT INTO `harga` (`id_harga`, `nama_item`, `harga_modal`, `harga_jual`, `harga_jual_mitra`, `harga_provinsi`, `stok`) VALUES
(1, 1, 10000, 11000, 12000, 1, 1),
(2, 1, 12000, 13000, 14000, 2, 2),
(3, 1, 14000, 15000, 16000, 4, 3),
(4, 2, 8000, 9000, 10000, 1, 4),
(5, 1, 13000, 14000, 15000, 3, 0),
(6, 2, 5000, 6000, 7000, 2, 0),
(7, 2, 6000, 7000, 8000, 3, 0),
(8, 2, 7000, 8000, 9000, 4, 0),
(9, 3, 10000, 11000, 11500, 1, 2),
(10, 3, 8500, 9000, 9500, 2, 2),
(11, 3, 7500, 8000, 8500, 3, 3),
(12, 3, 10000, 10500, 11000, 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id_item` int(11) NOT NULL,
  `nama_item` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id_item`, `nama_item`) VALUES
(1, 'Ayam'),
(2, 'Kentang'),
(3, 'Usus'),
(4, 'Sambel');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `keranjang_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pesan_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `jenis_id` int(11) NOT NULL,
  `stokis` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_total` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`keranjang_id`, `user_id`, `pesan_id`, `barang_id`, `jenis_id`, `stokis`, `jumlah`, `harga_total`, `created_at`) VALUES
(7, 15, 0, 1, 0, 0, 1, '12000.00', '2025-04-12 03:17:43'),
(8, 15, 0, 4, 0, 0, 1, '10000.00', '2025-04-12 03:18:59'),
(9, 16, 0, 3, 0, 0, 22, '352000.00', '2025-04-13 06:23:28'),
(10, 16, 0, 8, 0, 0, 11, '99000.00', '2025-04-13 06:23:28'),
(11, 16, 0, 8, 0, 0, 2, '18000.00', '2025-04-13 06:45:31'),
(12, 16, 0, 8, 0, 0, 2, '18000.00', '2025-04-13 06:46:08'),
(13, 16, 0, 8, 0, 0, 2, '18000.00', '2025-04-13 06:46:17'),
(14, 16, 0, 8, 0, 0, 2, '18000.00', '2025-04-13 06:46:43'),
(15, 16, 0, 3, 0, 0, 3, '48000.00', '2025-04-13 06:46:43'),
(16, 16, 0, 3, 0, 0, 5, '80000.00', '2025-04-13 06:53:33'),
(21, 16, 0, 3, 0, 0, 9, '144000.00', '2025-04-13 07:02:05'),
(22, 16, 0, 3, 0, 0, 3, '48000.00', '2025-04-13 07:03:01'),
(23, 16, 0, 8, 0, 0, 4, '36000.00', '2025-04-13 07:03:01'),
(24, 16, 0, 3, 1, 0, 3, '48000.00', '2025-04-13 12:20:48'),
(25, 16, 0, 8, 2, 0, 3, '27000.00', '2025-04-13 12:20:40'),
(26, 16, 13, 3, 1, 6, 9, '144000.00', '2025-04-14 02:53:19'),
(27, 16, 13, 8, 2, 6, 3, '27000.00', '2025-04-14 02:52:58'),
(28, 16, 14, 3, 1, 6, 6, '96000.00', '2025-04-14 02:52:40'),
(29, 16, 14, 8, 2, 6, 9, '81000.00', '2025-04-14 02:52:18'),
(30, 16, 15, 3, 1, 6, 12, '192000.00', '2025-04-14 02:52:03'),
(31, 16, 15, 8, 2, 6, 33, '297000.00', '2025-04-14 02:51:36'),
(32, 18, 16, 2, 1, 3, 9, '126000.00', '2025-04-14 02:50:34'),
(33, 18, 16, 6, 2, 3, 1, '7000.00', '2025-04-14 02:50:06'),
(34, 18, 17, 6, 2, 3, 9, '63000.00', '2025-04-14 02:49:56'),
(35, 18, 18, 2, 1, 3, 1, '14000.00', '2025-04-14 02:49:41'),
(36, 18, 18, 6, 2, 0, 1, '7000.00', '2025-04-13 13:03:25'),
(37, 16, 19, 3, 1, 0, 3, '48000.00', '2025-04-13 14:33:08'),
(38, 16, 19, 12, 3, 0, 7, '77000.00', '2025-04-13 14:33:08'),
(39, 4, 20, 1, 1, 0, 5, '60000.00', '2025-04-14 01:55:11'),
(40, 4, 20, 4, 2, 0, 3, '30000.00', '2025-04-14 01:55:11'),
(41, 4, 20, 9, 3, 0, 1, '11500.00', '2025-04-14 01:55:11'),
(42, 4, 21, 1, 1, 0, 2, '24000.00', '2025-04-14 02:03:10'),
(43, 4, 21, 4, 2, 0, 1, '10000.00', '2025-04-14 02:03:10'),
(44, 4, 21, 9, 3, 0, 9, '103500.00', '2025-04-14 02:03:10'),
(45, 4, 24, 1, 1, 2, 11, '132000.00', '2025-04-14 03:02:33'),
(46, 4, 24, 4, 2, 2, 11, '110000.00', '2025-04-14 03:02:33'),
(47, 4, 24, 9, 3, 2, 11, '126500.00', '2025-04-14 03:02:33'),
(48, 4, 25, 1, 1, 2, 1, '12000.00', '2025-04-14 03:48:03');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id.level` int(11) NOT NULL,
  `level` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id.level`, `level`) VALUES
(1, 'Stokis'),
(2, 'Mitra');

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE `pesan` (
  `id_pesan` int(11) NOT NULL,
  `kode_pesanan` varchar(40) NOT NULL,
  `pemesan` int(11) NOT NULL,
  `item_harga` int(11) NOT NULL,
  `stokis` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `status` int(11) NOT NULL,
  `catatan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pesan`
--

INSERT INTO `pesan` (`id_pesan`, `kode_pesanan`, `pemesan`, `item_harga`, `stokis`, `tanggal`, `status`, `catatan`) VALUES
(13, 'ORD20250413150218USR16', 16, 0, 6, '2025-04-13', 1, '3'),
(14, 'ORD20250413185317USR16', 16, 0, 6, '2025-04-13', 1, '3'),
(15, 'ORD20250413192353USR16', 16, 0, 6, '2025-04-13', 1, '3'),
(16, 'ORD20250413193434USR18', 18, 0, 3, '2025-04-13', 1, '3'),
(17, 'ORD20250413193450USR18', 18, 0, 3, '2025-04-13', 1, '3'),
(18, 'ORD20250413200325USR18', 18, 0, 3, '2025-04-13', 1, '3'),
(19, 'ORD20250413213308USR16', 16, 0, 6, '2025-04-13', 1, '3'),
(20, 'ORD20250414085511USR4', 4, 0, 2, '2025-04-14', 1, '3'),
(21, 'ORD20250414090310USR4', 4, 0, 2, '2025-04-14', 1, '3'),
(22, 'ORD20250414100103USR4', 4, 0, 2, '2025-04-14', 1, '3'),
(23, 'ORD20250414100118USR4', 4, 0, 2, '2025-04-14', 1, '3'),
(24, 'ORD20250414100233USR4', 4, 0, 2, '2025-04-14', 1, '3'),
(25, 'ORD20250414104803USR4', 4, 0, 2, '2025-04-14', 1, '3');

-- --------------------------------------------------------

--
-- Table structure for table `provinsi`
--

CREATE TABLE `provinsi` (
  `id_prov` int(11) NOT NULL,
  `provinsi` varchar(190) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `provinsi`
--

INSERT INTO `provinsi` (`id_prov`, `provinsi`) VALUES
(1, 'Jawa Barat'),
(2, 'Jawa Tengah'),
(3, 'Sumatera Selatan'),
(4, 'Riau');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id_status` int(11) NOT NULL,
  `status_nama` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id_status`, `status_nama`) VALUES
(1, 'Belum Bayar'),
(2, 'Sudah Bayar'),
(3, 'Batal'),
(4, 'Proses');

-- --------------------------------------------------------

--
-- Table structure for table `stok`
--

CREATE TABLE `stok` (
  `id_stok` int(11) NOT NULL,
  `item` int(11) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stok`
--

INSERT INTO `stok` (`id_stok`, `item`, `stok`) VALUES
(1, 1, 50),
(2, 2, 30),
(3, 3, 15),
(4, 4, 10);

-- --------------------------------------------------------

--
-- Table structure for table `stokis`
--

CREATE TABLE `stokis` (
  `id_stokis` int(11) NOT NULL,
  `nama_stokis` varchar(100) NOT NULL,
  `alamat` varchar(190) NOT NULL,
  `provinsi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stokis`
--

INSERT INTO `stokis` (`id_stokis`, `nama_stokis`, `alamat`, `provinsi`) VALUES
(1, 'Kota Bogor', 'Dramaga', 1),
(2, 'Cibinong', 'Cibinong square', 1),
(3, 'Semarang', 'Semarang Mall', 2),
(4, 'Jepara', 'Jepara Mall', 2),
(5, 'Palembang', 'Palembang Mall', 3),
(6, 'Pekanbaru', 'Kota Pekanbaru', 4);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(30) NOT NULL,
  `stokis` int(11) NOT NULL,
  `provinsi` int(11) NOT NULL,
  `level` int(1) NOT NULL,
  `buat` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `name`, `stokis`, `provinsi`, `level`, `buat`) VALUES
(4, 'mitracibinong', '8cb2237d0679ca88db6464eac60da96345513964', 'Mitra Cibinong', 2, 1, 2, '2021-12-24 22:30:03'),
(15, 'stokiscibinong', '8cb2237d0679ca88db6464eac60da96345513964', 'Stokis CIbinong', 2, 1, 1, '2025-04-10 19:00:47'),
(16, 'mitrariau', '8cb2237d0679ca88db6464eac60da96345513964', 'Mitra Riau', 6, 4, 2, '2025-04-10 19:21:54'),
(17, 'stokisriau', '8cb2237d0679ca88db6464eac60da96345513964', 'Stokis Riau', 6, 4, 1, '2025-04-10 19:22:57'),
(18, 'mitrasemarang', '8cb2237d0679ca88db6464eac60da96345513964', 'Mitra Semarang', 3, 2, 2, '2025-04-10 19:38:36'),
(19, 'stokissemarang', '8cb2237d0679ca88db6464eac60da96345513964', 'Stokis Semarang', 3, 2, 1, '2025-04-10 19:38:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id_divisi`);

--
-- Indexes for table `harga`
--
ALTER TABLE `harga`
  ADD PRIMARY KEY (`id_harga`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id_item`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`keranjang_id`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id.level`);

--
-- Indexes for table `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id_pesan`);

--
-- Indexes for table `provinsi`
--
ALTER TABLE `provinsi`
  ADD PRIMARY KEY (`id_prov`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `stok`
--
ALTER TABLE `stok`
  ADD PRIMARY KEY (`id_stok`);

--
-- Indexes for table `stokis`
--
ALTER TABLE `stokis`
  ADD PRIMARY KEY (`id_stokis`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id_divisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `harga`
--
ALTER TABLE `harga`
  MODIFY `id_harga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `keranjang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id.level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id_pesan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `provinsi`
--
ALTER TABLE `provinsi`
  MODIFY `id_prov` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stok`
--
ALTER TABLE `stok`
  MODIFY `id_stok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stokis`
--
ALTER TABLE `stokis`
  MODIFY `id_stokis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
