-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2025 at 03:48 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id_book` int(11) NOT NULL,
  `ruang_rapat` varchar(100) NOT NULL,
  `mulai` varchar(50) NOT NULL,
  `durasi` varchar(50) NOT NULL,
  `tanggal_acara` date NOT NULL,
  `perihal` varchar(150) NOT NULL,
  `buat` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id_book`, `ruang_rapat`, `mulai`, `durasi`, `tanggal_acara`, `perihal`, `buat`) VALUES
(1, 'Ruang Rapat 1', '08:00', '2 Jam', '2024-01-31', 'Rapat Koordinasi', '2024-01-31 15:25:52');

-- --------------------------------------------------------

--
-- Table structure for table `cob`
--

CREATE TABLE `cob` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cob`
--

INSERT INTO `cob` (`id`, `name`, `email`) VALUES
(1, 'fahmi', 'fahmi@tes.com');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `gender` enum('L','P') NOT NULL,
  `phone` varchar(18) NOT NULL,
  `address` text NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `name`, `gender`, `phone`, `address`, `created`, `updated`) VALUES
(2, 'Sapi', 'P', '0815', 'depok DUA', '2022-01-10 13:25:21', '2022-01-10 07:51:47'),
(3, 'Leno', 'L', '0819', 'Jakarta', '2022-01-25 12:04:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cuti`
--

CREATE TABLE `cuti` (
  `id_cuti` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_unit` int(11) NOT NULL,
  `nomorb` varchar(100) NOT NULL,
  `namab` varchar(200) NOT NULL,
  `nipb` varchar(200) NOT NULL,
  `sisab` int(11) NOT NULL,
  `tahunb` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cuti`
--

INSERT INTO `cuti` (`id_cuti`, `id_user`, `id_unit`, `nomorb`, `namab`, `nipb`, `sisab`, `tahunb`, `created`, `updated`) VALUES
(15, 4, 0, '123', 'tes', '667', 3, 2022, '2022-12-24 21:47:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cuty`
--

CREATE TABLE `cuty` (
  `id_cuty` int(11) NOT NULL,
  `nomorb` varchar(100) NOT NULL,
  `namab` varchar(300) NOT NULL,
  `nipb` varchar(100) NOT NULL,
  `golb` varchar(30) NOT NULL,
  `pangkatb` varchar(80) NOT NULL,
  `sisab` int(11) NOT NULL,
  `tahunb` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cuty`
--

INSERT INTO `cuty` (`id_cuty`, `nomorb`, `namab`, `nipb`, `golb`, `pangkatb`, `sisab`, `tahunb`, `created`, `updated`) VALUES
(7, '5521/KR.120/K.8/12/2022', 'Imam Djajadi', '196307031983031001', 'IV/c', 'Pembina Muda', 2, 2022, '2022-12-25 15:25:31', '2022-12-25 09:27:06');

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
(6, 'Direktur');

-- --------------------------------------------------------

--
-- Table structure for table `lampiran_zi`
--

CREATE TABLE `lampiran_zi` (
  `id_zii` int(11) NOT NULL,
  `idzii` varchar(10) NOT NULL,
  `nama_lampiran` varchar(60) NOT NULL,
  `file` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lampiran_zi`
--

INSERT INTO `lampiran_zi` (`id_zii`, `idzii`, `nama_lampiran`, `file`) VALUES
(0, '', 'apaam', '121'),
(2, '', 'djd', '9_List_All_Users_Data_from_Database_in_CodeIgniter_8_QA145K_Xgcw_mp4_snapshot_04_21_5725.jpg'),
(3, '', 'gggg', '1_aja3.PNG'),
(8, '1', 'satu', '3_Mendesain_Layout_Dashboard_dan_Login_Responsive_dengan_Bootstrap_2_apn6JrbSMCg_mp4_snapshot_14_57_032.jpg'),
(9, '18', 'apaantu', 'ttd.PNG'),
(10, '18', 'jsjsjs', 'waktd_p.png');

-- --------------------------------------------------------

--
-- Table structure for table `laporan_harian`
--

CREATE TABLE `laporan_harian` (
  `id` int(5) NOT NULL,
  `tanggal` varchar(30) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `penjualan` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `laporan_harian`
--

INSERT INTO `laporan_harian` (`id`, `tanggal`, `nama`, `penjualan`) VALUES
(1, '2022-05-19 17:53:44', '1l', 8),
(2, '2022-05-19 18:02:31', 'jaja', 15),
(3, '2022-05-19 18:04:08', 'jaja', -8),
(4, '2022-05-19 18:04:55', '1ghvj', 9),
(5, '-2', '', 0),
(6, '0', '', 0),
(7, '2022-05-19 18:09:26', 'ja', -1),
(8, '2022-05-19 18:13:17', 'ad', 10),
(9, '2022-05-19 18:14:56', 'jaja', -20),
(10, '2022-05-19 18:15:23', 'nyoba', -23),
(11, '2022-05-20 06:19:09', 'Januari', 22),
(12, '2022-05-20 06:28:32', 'ffff', 20),
(13, '2022-05-20 07:56:54', 'das', 3),
(14, '2022-05-20 08:21:27', 'ad', 3),
(15, '2022-05-20 08:22:01', 'ad', 3),
(16, '2022-05-20 08:22:17', 'ad', 3),
(17, '2022-05-20 08:22:32', 'ad', 3),
(18, '2022-05-20 08:22:53', 'ad', 3),
(19, '2022-05-20 08:23:08', 'ad', 3),
(20, '2022-05-20 08:43:32', 'fad', 5),
(21, '2022-05-20 08:45:07', 'fad', 5),
(22, '2022-05-20 08:45:36', 'fad', 53),
(23, '2022-05-20 08:49:22', 'gsd', 5),
(24, '2022-05-20 08:52:25', 'hj,', 56),
(25, '2022-05-20 09:48:44', 'f', 5);

-- --------------------------------------------------------

--
-- Table structure for table `pengaju`
--

CREATE TABLE `pengaju` (
  `id_aju` int(11) NOT NULL,
  `perihal` varchar(250) NOT NULL,
  `divisi` int(11) NOT NULL,
  `sifat` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengaju`
--

INSERT INTO `pengaju` (`id_aju`, `perihal`, `divisi`, `sifat`, `status`) VALUES
(1, 'perbaikan jaringan', 2, 1, 2),
(2, 'Perbaikan PC', 1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pengajua`
--

CREATE TABLE `pengajua` (
  `id_aju` int(11) NOT NULL,
  `perihal` varchar(210) NOT NULL,
  `pembuat` int(11) NOT NULL,
  `divisi` int(11) NOT NULL,
  `sifat` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengajua`
--

INSERT INTO `pengajua` (`id_aju`, `perihal`, `pembuat`, `divisi`, `sifat`, `status`, `tanggal`) VALUES
(2, 'PErbaikan LAn', 9, 3, 1, 2, '2025-04-01 16:36:50'),
(4, 'testing pc', 9, 3, 1, 1, '2025-04-01 21:46:37'),
(6, 'aiiaiaiaiaiaiaiai', 11, 6, 2, 1, '2025-04-03 12:21:30'),
(7, 'percibianss', 9, 6, 1, 2, '2025-04-03 17:37:07'),
(13, 'papaapapssa', 11, 6, 1, 1, '2025-04-03 17:46:35'),
(14, 'Yutub tidak bisa d stel', 10, 1, 2, 1, '2025-04-03 21:18:54');

-- --------------------------------------------------------

--
-- Table structure for table `p_item`
--

CREATE TABLE `p_item` (
  `item_id` int(11) NOT NULL,
  `barcode` varchar(100) DEFAULT NULL,
  `name` varchar(120) DEFAULT NULL,
  `kategori_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `price` int(11) DEFAULT NULL,
  `stock` int(10) NOT NULL DEFAULT 0,
  `image` varchar(100) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `p_item`
--

INSERT INTO `p_item` (`item_id`, `barcode`, `name`, `kategori_id`, `unit_id`, `price`, `stock`, `image`, `created`, `updated`) VALUES
(13, 'A4', 'Lenovo', 4, 3, 100000, 0, 'item-_221224-485e5caf74.png', '2022-12-24 18:33:58', NULL),
(14, '12', 'apaan', 4, 4, 100000, 0, 'item-_240222-479629fc5e.png', '2024-02-22 13:03:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `p_kategori`
--

CREATE TABLE `p_kategori` (
  `kategori_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `p_kategori`
--

INSERT INTO `p_kategori` (`kategori_id`, `name`, `created`, `updated`) VALUES
(4, 'Lenovo', '2022-01-11 08:19:28', NULL),
(5, 'Asus', '2022-01-13 23:19:36', '2022-01-24 08:35:28'),
(7, 'Makanan', '2022-01-25 12:29:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `p_unit`
--

CREATE TABLE `p_unit` (
  `unit_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `p_unit`
--

INSERT INTO `p_unit` (`unit_id`, `name`, `created`, `updated`) VALUES
(3, 'Elektronik', '2022-01-20 14:45:17', '2022-01-24 08:39:03'),
(4, 'Pakaian', '2022-01-24 13:23:47', NULL),
(5, 'Makanan', '2024-01-29 20:19:09', NULL),
(6, 'Rumah', '2024-01-29 20:19:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sifat`
--

CREATE TABLE `sifat` (
  `id_sifat` int(11) NOT NULL,
  `sifat` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sifat`
--

INSERT INTO `sifat` (`id_sifat`, `sifat`) VALUES
(1, 'Segera 1-2 hari'),
(2, 'Biasa 3-5 Hari');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id_status` int(11) NOT NULL,
  `status` varchar(29) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id_status`, `status`) VALUES
(1, 'Draft'),
(2, 'SPV'),
(3, 'Manager'),
(4, 'Direktur'),
(5, 'Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `sup`
--

CREATE TABLE `sup` (
  `supplier_id` int(11) NOT NULL,
  `name` varchar(35) NOT NULL,
  `phone` varchar(19) NOT NULL,
  `address` varchar(77) NOT NULL,
  `description` varchar(110) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sup`
--

INSERT INTO `sup` (`supplier_id`, `name`, `phone`, `address`, `description`) VALUES
(1, 'Toko Jaya aja', '081818', 'jakarta', 'daging'),
(2, 'ADS', '0101', 'ASPAPSASD', 'FASADADSF'),
(3, 'Toko ada aja', '0895', 'Kelapa', 'Minyak');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(30) NOT NULL,
  `address` varchar(70) NOT NULL,
  `level` int(1) NOT NULL,
  `buat` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `name`, `address`, `level`, `buat`) VALUES
(4, 'awaludin', 'b3f421c567b0d560d5865d9c96bbaff2cd336472', 'awaludin ', 'cilebut', 1, '2021-12-24 22:30:03'),
(7, 'testings', 'f58cf5e7e10f195e21b553096d092c763ed18b0e', 'testing', 'Jakarta', 1, '2024-12-02 21:10:19'),
(9, 'fahmi', '5f6f8f2ec06aa6c6f23a9a3fbd927892867f5059', 'fahmi', 'bogor', 1, '2025-03-19 11:14:25'),
(10, 'testingku', '5f6f8f2ec06aa6c6f23a9a3fbd927892867f5059', 'test', 'bogor', 2, '2025-03-26 11:21:18'),
(11, 'adm', '3da541559918a808c2402bba5012f6c60b27661c', 'admin', 'bogors', 1, '2025-03-28 13:26:55');

-- --------------------------------------------------------

--
-- Table structure for table `zii`
--

CREATE TABLE `zii` (
  `id` int(11) NOT NULL,
  `kode` varchar(30) NOT NULL,
  `area_kom` varchar(100) NOT NULL,
  `sub_kom` varchar(110) NOT NULL,
  `des_kom` varchar(170) NOT NULL,
  `urai_kom` varchar(1000) NOT NULL,
  `has_viu` varchar(150) NOT NULL,
  `nilai_kom` int(11) NOT NULL,
  `lamp_kom` varchar(2048) NOT NULL,
  `id_zii` int(11) NOT NULL,
  `pj_kom` varchar(19) NOT NULL,
  `veri_kom` varchar(20) NOT NULL,
  `wkt_b` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `zii`
--

INSERT INTO `zii` (`id`, `kode`, `area_kom`, `sub_kom`, `des_kom`, `urai_kom`, `has_viu`, `nilai_kom`, `lamp_kom`, `id_zii`, `pj_kom`, `veri_kom`, `wkt_b`) VALUES
(1, 'I.1.a.1', 'Manajemen Perubahan', 'Tim Kerja', 'Apakah unit kerja telah membentuk tim kerja untuk melakukan pembangunan Zona Integritas ?', 'Ya , apabila Tim telah dibentuk di dalam unit kerj', 'SK Kepala BBKP Soetta No.56/Kpts/KP.330/K.8.A/01/2020 tentang Pembentukan Tim Pelaksana Zona Integritas BBKP Soetta', 1, 'I_1_a_1__SK_TIM_POKJA_ZI_WBK_20191.pdf', 0, '-', '-', '2021-12-24 23:21:04'),
(2, 'I.1.a.2', 'Manajemen Perubahan', 'Tim Kerja', 'Apakah unit kerja telah membentuk tim kerja untuk melakukan pembangunan Zona Integritas ?', 'SK Kepala BBKP Soetta No.56/Kpts/KP.330/K.8.A/01/2', 'Ya , apabila Tim telah dibentuk di dalam unit kerja', 1, 'I_1_a_2__SK_TIM_POKJA_ZI_WBK_2020.pdf', 0, '-', '-', '2021-12-24 23:46:14'),
(12, '0', 'cad', '123', 'afda', 'ascax', 'asdafeq', 12, 'I_1_a_1__SK_TIM_POKJA_ZI_WBK_20192.pdf', 0, '-', '-', '2022-02-18 18:08:03'),
(13, 'afd', 'asd', 'fsg', 'rgwrg', 'fwed', 'wqd34', 12, 'I_1_a_2__SK_TIM_POKJA_ZI_WBK_20201.pdf', 0, '-', '-', '2022-02-18 18:09:14'),
(14, 'adkm', 'doamko', 'mdoamsm', 'JBUUN', 'nounoinxi', 'ubnio', 3, 'BENER2as.png', 0, '-', '-', '2022-04-14 21:45:24'),
(15, 'aidbb', 'bjh', 'bjhgj', 'vg', 'bidab', 'boub', 1, 'BENER2as1.png', 0, '-', '-', '2022-04-14 22:17:16'),
(16, '0kk0pk', 'ndasjdnjn', 'iefh2ij', 'neofucba', 'ienaj', ' casjcbaoi', 12, 'Jadwal_Pelatihan_Pengamanan_TSL_angkatan_3.pdf', 0, '-', '-', '2022-04-14 22:19:52'),
(17, '', '', '', '', '', '', 0, '1_aja.PNG', 0, '', '', '2022-05-30 20:00:26'),
(18, 'sa', 'dasd', 'sadas', 'sasasd', 'wqxsx1', '1', 2, '1_aja2.PNG', 0, '-', '-', '2022-06-26 00:21:32'),
(19, '01', 'why', 'satu', 'dua', 'tiga', 'empat', 3, '9_List_All_Users_Data_from_Database_in_CodeIgniter_8_QA145K_Xgcw_mp4_snapshot_08_30_3321.jpg', 0, '2', '3', '2022-07-01 18:45:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id_book`);

--
-- Indexes for table `cob`
--
ALTER TABLE `cob`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `cuti`
--
ALTER TABLE `cuti`
  ADD PRIMARY KEY (`id_cuti`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `cuty`
--
ALTER TABLE `cuty`
  ADD PRIMARY KEY (`id_cuty`);

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id_divisi`);

--
-- Indexes for table `lampiran_zi`
--
ALTER TABLE `lampiran_zi`
  ADD PRIMARY KEY (`id_zii`);

--
-- Indexes for table `laporan_harian`
--
ALTER TABLE `laporan_harian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengaju`
--
ALTER TABLE `pengaju`
  ADD PRIMARY KEY (`id_aju`);

--
-- Indexes for table `pengajua`
--
ALTER TABLE `pengajua`
  ADD PRIMARY KEY (`id_aju`);

--
-- Indexes for table `p_item`
--
ALTER TABLE `p_item`
  ADD PRIMARY KEY (`item_id`),
  ADD UNIQUE KEY `barcode` (`barcode`),
  ADD KEY `kategori_id` (`kategori_id`),
  ADD KEY `unit_id` (`unit_id`);

--
-- Indexes for table `p_kategori`
--
ALTER TABLE `p_kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indexes for table `p_unit`
--
ALTER TABLE `p_unit`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indexes for table `sifat`
--
ALTER TABLE `sifat`
  ADD PRIMARY KEY (`id_sifat`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `sup`
--
ALTER TABLE `sup`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `zii`
--
ALTER TABLE `zii`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_zi` (`id_zii`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id_book` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cob`
--
ALTER TABLE `cob`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cuti`
--
ALTER TABLE `cuti`
  MODIFY `id_cuti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `cuty`
--
ALTER TABLE `cuty`
  MODIFY `id_cuty` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id_divisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `lampiran_zi`
--
ALTER TABLE `lampiran_zi`
  MODIFY `id_zii` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `laporan_harian`
--
ALTER TABLE `laporan_harian`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `pengaju`
--
ALTER TABLE `pengaju`
  MODIFY `id_aju` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pengajua`
--
ALTER TABLE `pengajua`
  MODIFY `id_aju` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `p_item`
--
ALTER TABLE `p_item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `p_kategori`
--
ALTER TABLE `p_kategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `p_unit`
--
ALTER TABLE `p_unit`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sifat`
--
ALTER TABLE `sifat`
  MODIFY `id_sifat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sup`
--
ALTER TABLE `sup`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `zii`
--
ALTER TABLE `zii`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cuti`
--
ALTER TABLE `cuti`
  ADD CONSTRAINT `cuti_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `p_item`
--
ALTER TABLE `p_item`
  ADD CONSTRAINT `p_item_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `p_kategori` (`kategori_id`),
  ADD CONSTRAINT `p_item_ibfk_2` FOREIGN KEY (`unit_id`) REFERENCES `p_unit` (`unit_id`);

--
-- Constraints for table `zii`
--
ALTER TABLE `zii`
  ADD CONSTRAINT `zii_ibfk_1` FOREIGN KEY (`id_zii`) REFERENCES `lampiran_zi` (`id_zii`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
