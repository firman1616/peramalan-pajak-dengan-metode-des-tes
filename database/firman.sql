-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2021 at 09:30 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `firman`
--

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `nama_pengguna` varchar(50) NOT NULL,
  `username_pengguna` varchar(50) NOT NULL,
  `password_pengguna` varchar(50) NOT NULL,
  `akses_pengguna` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `nama_pengguna`, `username_pengguna`, `password_pengguna`, `akses_pengguna`) VALUES
(1, 'Firman', 'admin', 'admin', 'administrator');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pendapatan`
--

CREATE TABLE `tbl_pendapatan` (
  `id_pendapatan` int(11) NOT NULL,
  `id_usaha` int(11) NOT NULL,
  `tgl_pendapatan` date NOT NULL,
  `jumlah_pendapatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pendapatan`
--

INSERT INTO `tbl_pendapatan` (`id_pendapatan`, `id_usaha`, `tgl_pendapatan`, `jumlah_pendapatan`) VALUES
(162, 0, '2018-01-01', 480042),
(163, 0, '2018-01-02', 276407),
(164, 0, '2018-01-03', 285726),
(165, 0, '2018-01-04', 239954),
(166, 0, '2018-01-05', 256226),
(167, 0, '2018-01-06', 214771),
(168, 0, '2018-01-07', 191726),
(169, 0, '2018-01-08', 190409),
(170, 0, '2018-01-09', 169592),
(171, 0, '2018-01-10', 0),
(172, 0, '2018-01-11', 374729),
(173, 0, '2018-01-12', 156726),
(174, 0, '2018-01-13', 234544),
(175, 0, '2018-01-14', 210681),
(176, 0, '2018-01-15', 182136),
(177, 0, '2018-01-16', 119090),
(178, 0, '2018-01-17', 260089),
(179, 0, '2018-01-18', 221545),
(180, 0, '2018-01-19', 220681),
(181, 0, '2018-01-20', 292774),
(182, 0, '2018-01-21', 200681),
(183, 0, '2018-01-22', 168317),
(184, 0, '2018-01-23', 228999),
(185, 0, '2018-01-24', 132500),
(186, 0, '2018-01-25', 351499),
(187, 0, '2018-01-26', 209999),
(188, 0, '2018-01-27', 430772),
(189, 0, '2018-01-28', 184862),
(190, 0, '2018-01-29', 200408),
(191, 0, '2018-01-30', 300135),
(192, 0, '2018-01-31', 212137),
(194, 0, '2018-02-01', 480042),
(195, 0, '2018-02-02', 276407),
(196, 0, '2018-02-03', 285726),
(197, 0, '2018-02-04', 239954),
(198, 0, '2018-02-05', 256226),
(199, 0, '2018-02-06', 214771),
(200, 0, '2018-02-07', 191726),
(201, 0, '2018-02-08', 190409),
(202, 0, '2018-02-09', 169592),
(203, 0, '2018-02-10', 0),
(204, 0, '2018-02-11', 374729),
(205, 0, '2018-02-12', 156726),
(206, 0, '2018-02-13', 234544),
(207, 0, '2018-02-14', 210681),
(208, 0, '2018-02-15', 182136),
(209, 0, '2018-02-16', 119090),
(210, 0, '2018-02-17', 260089),
(211, 0, '2018-02-18', 221545),
(212, 0, '2018-02-19', 220681),
(213, 0, '2018-02-20', 292774),
(214, 0, '2018-02-21', 200681),
(215, 0, '2018-02-22', 168317),
(216, 0, '2018-02-23', 228999),
(217, 0, '2018-02-24', 132500),
(218, 0, '2018-02-25', 351499),
(219, 0, '2018-02-26', 209999),
(220, 0, '2018-02-27', 430772),
(221, 0, '2018-02-28', 184862),
(222, 0, '2018-03-01', 480042),
(223, 0, '2018-03-02', 276407),
(224, 0, '2018-03-03', 285726),
(225, 0, '2018-03-04', 239954),
(226, 0, '2018-03-05', 256226),
(227, 0, '2018-03-06', 214771),
(228, 0, '2018-03-07', 191726),
(229, 0, '2018-03-08', 190409),
(230, 0, '2018-03-09', 169592),
(231, 0, '2018-03-10', 0),
(232, 0, '2018-03-11', 374729),
(233, 0, '2018-03-12', 156726),
(234, 0, '2018-03-13', 234544),
(235, 0, '2018-03-14', 210681),
(236, 0, '2018-03-15', 182136),
(237, 0, '2018-03-16', 119090),
(238, 0, '2018-03-17', 260089),
(239, 0, '2018-03-18', 221545),
(240, 0, '2018-03-19', 220681),
(241, 0, '2018-03-20', 292774),
(242, 0, '2018-03-21', 200681),
(243, 0, '2018-03-22', 168317),
(244, 0, '2018-03-23', 228999),
(245, 0, '2018-03-24', 132500),
(246, 0, '2018-03-25', 351499),
(247, 0, '2018-03-26', 209999),
(248, 0, '2018-03-27', 430772),
(249, 0, '2018-03-28', 184862),
(250, 0, '2018-03-29', 200408),
(251, 0, '2018-03-30', 300135),
(252, 0, '2018-03-31', 212137);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_peramalan`
--

CREATE TABLE `tbl_peramalan` (
  `id_peramalan` int(11) NOT NULL,
  `tgl_peramalan` date NOT NULL,
  `alpha` varchar(10) NOT NULL,
  `step1` varchar(10) NOT NULL,
  `step2` varchar(10) NOT NULL,
  `step3` varchar(10) NOT NULL,
  `step4` varchar(10) NOT NULL,
  `step5` varchar(10) NOT NULL,
  `rmse` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_peramalan`
--

INSERT INTO `tbl_peramalan` (`id_peramalan`, `tgl_peramalan`, `alpha`, `step1`, `step2`, `step3`, `step4`, `step5`, `rmse`) VALUES
(3, '2018-01-01', '0.1', '7198157', '7198157', '7198157', '0', '7198157', '0'),
(4, '2018-02-01', '0.1', '7126889', '7191030.2', '7062747.8', '-7126.8', '7055621', '0'),
(5, '2018-03-01', '0.1', '7134015.8', '7185328.76', '7082702.84', '-5701.44', '7077001.4', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_peramalan_winter`
--

CREATE TABLE `tbl_peramalan_winter` (
  `id_peramalan_winter` int(11) NOT NULL,
  `tgl_peramalan_winter` date NOT NULL,
  `alpha_winter` varchar(10) NOT NULL,
  `abg_winter` varchar(15) NOT NULL,
  `st_winter` varchar(10) NOT NULL,
  `bt_winter` varchar(10) NOT NULL,
  `lt_winter` varchar(10) NOT NULL,
  `ftm_winter` varchar(10) NOT NULL,
  `rmse_winter` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_peramalan_winter`
--

INSERT INTO `tbl_peramalan_winter` (`id_peramalan_winter`, `tgl_peramalan_winter`, `alpha_winter`, `abg_winter`, `st_winter`, `bt_winter`, `lt_winter`, `ftm_winter`, `rmse_winter`) VALUES
(12, '2018-01-01', '0.1', '0.1,0.1,0.1', '9048776.1', '1879361.19', '1.03412925', '11301106.4', '2368838.99'),
(13, '2018-02-01', '0.1', '0.1,0.1,0.1', '9048776.1', '1879361.19', '0.93174148', '10182198.8', '2134303.37'),
(14, '2018-03-01', '0.1', '0.1,0.1,0.1', '9048776.1', '1879361.19', '1.03412925', '11301106.4', '2368838.99');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_usaha`
--

CREATE TABLE `tbl_usaha` (
  `id_usaha` int(11) NOT NULL,
  `nama_usaha` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_usaha`
--

INSERT INTO `tbl_usaha` (`id_usaha`, `nama_usaha`) VALUES
(0, 'RM Sumber Hidup'),
(3, 'RM Ayam Brewok'),
(4, 'RM Amanis');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indexes for table `tbl_pendapatan`
--
ALTER TABLE `tbl_pendapatan`
  ADD PRIMARY KEY (`id_pendapatan`),
  ADD KEY `id_usaha` (`id_usaha`);

--
-- Indexes for table `tbl_peramalan`
--
ALTER TABLE `tbl_peramalan`
  ADD PRIMARY KEY (`id_peramalan`);

--
-- Indexes for table `tbl_peramalan_winter`
--
ALTER TABLE `tbl_peramalan_winter`
  ADD PRIMARY KEY (`id_peramalan_winter`);

--
-- Indexes for table `tbl_usaha`
--
ALTER TABLE `tbl_usaha`
  ADD PRIMARY KEY (`id_usaha`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_pendapatan`
--
ALTER TABLE `tbl_pendapatan`
  MODIFY `id_pendapatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=253;

--
-- AUTO_INCREMENT for table `tbl_peramalan`
--
ALTER TABLE `tbl_peramalan`
  MODIFY `id_peramalan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_peramalan_winter`
--
ALTER TABLE `tbl_peramalan_winter`
  MODIFY `id_peramalan_winter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_usaha`
--
ALTER TABLE `tbl_usaha`
  MODIFY `id_usaha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
