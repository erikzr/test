-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2024 at 05:11 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `checkcar`
--

-- --------------------------------------------------------

--
-- Table structure for table `checkup`
--

CREATE TABLE `checkup` (
  `id` int(11) NOT NULL,
  `nama_petugas` varchar(255) DEFAULT NULL,
  `plat_mobil` varchar(255) DEFAULT NULL,
  `hari` date DEFAULT NULL,
  `oliMesin` enum('Baik','Tidak Baik') DEFAULT NULL,
  `oliPowerSteering` enum('Baik','Tidak Baik') DEFAULT NULL,
  `oliTransmisi` enum('Baik','Tidak Baik') DEFAULT NULL,
  `minyakRem` enum('Baik','Tidak Baik') DEFAULT NULL,
  `lampuUtama` enum('Baik','Tidak Baik') DEFAULT NULL,
  `lampuSein` enum('Baik','Tidak Baik') DEFAULT NULL,
  `lampuRem` enum('Baik','Tidak Baik') DEFAULT NULL,
  `lampuKlakson` enum('Baik','Tidak Baik') DEFAULT NULL,
  `accu` enum('Baik','Tidak Baik') DEFAULT NULL,
  `kursi` enum('Baik','Tidak Baik') DEFAULT NULL,
  `lantai` enum('Baik','Tidak Baik') DEFAULT NULL,
  `dinding` enum('Baik','Tidak Baik') DEFAULT NULL,
  `kap` enum('Baik','Tidak Baik') DEFAULT NULL,
  `stnk` enum('Baik','Tidak Baik') DEFAULT NULL,
  `apar` enum('Baik','Tidak Baik') DEFAULT NULL,
  `p3k` enum('Baik','Tidak Baik') DEFAULT NULL,
  `kunciRoda` enum('Baik','Tidak Baik') DEFAULT NULL,
  `airRadiator` enum('Baik','Tidak Baik') DEFAULT NULL,
  `bahanBakar` enum('Baik','Tidak Baik') DEFAULT NULL,
  `oli` enum('Baik','Tidak Baik') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `checkup`
--

INSERT INTO `checkup` (`id`, `nama_petugas`, `plat_mobil`, `hari`, `oliMesin`, `oliPowerSteering`, `oliTransmisi`, `minyakRem`, `lampuUtama`, `lampuSein`, `lampuRem`, `lampuKlakson`, `accu`, `kursi`, `lantai`, `dinding`, `kap`, `stnk`, `apar`, `p3k`, `kunciRoda`, `airRadiator`, `bahanBakar`, `oli`) VALUES
(1, 'ridho', 'W 1507 NP ( Reborn )', '2024-09-13', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Tidak Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Tidak Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Tidak Baik'),
(2, 'laksono', 'W 1507 NP ( Reborn )', '2024-09-13', 'Baik', 'Tidak Baik', 'Tidak Baik', 'Tidak Baik', 'Tidak Baik', 'Tidak Baik', 'Tidak Baik', 'Baik', 'Tidak Baik', 'Tidak Baik', 'Tidak Baik', 'Baik', 'Tidak Baik', 'Tidak Baik', 'Tidak Baik', 'Tidak Baik', 'Tidak Baik', 'Baik', 'Baik', 'Tidak Baik'),
(3, 'Perspiciatis molest', 'W 1740 NP ( Inova Lama )', '2020-09-06', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Tidak Baik', 'Baik', 'Tidak Baik', 'Baik', 'Tidak Baik', 'Baik', 'Tidak Baik', 'Baik', 'Tidak Baik', 'Tidak Baik', 'Tidak Baik', 'Tidak Baik', 'Baik'),
(4, 'Suscipit dolorem et ', 'W 1507 NP ( Reborn )', '1990-06-20', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Tidak Baik', 'Baik', 'Tidak Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Tidak Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', 'Tidak Baik'),
(5, 'Aperiam et odit anim', 'W 1740 NP ( Inova Lama )', '2014-08-21', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Tidak Baik', 'Baik', 'Baik', 'Tidak Baik', 'Tidak Baik', 'Tidak Baik', 'Baik', 'Tidak Baik', 'Tidak Baik', 'Baik', 'Tidak Baik', 'Baik'),
(6, 'www', 'W 1507 NP ( Reborn )', '2024-09-30', 'Tidak Baik', 'Tidak Baik', 'Tidak Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Tidak Baik', 'Tidak Baik', 'Baik', 'Tidak Baik', 'Baik', NULL),
(7, 'erikerik', 'W 1740 NP ( Inova Lama )', '2024-10-02', 'Tidak Baik', 'Tidak Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Tidak Baik', 'Tidak Baik', 'Baik', 'Tidak Baik', 'Baik', 'Tidak Baik', NULL),
(8, 'a', 'W 1740 NP ( Inova Lama )', '2024-10-02', 'Baik', 'Baik', 'Tidak Baik', 'Tidak Baik', 'Tidak Baik', 'Baik', 'Tidak Baik', 'Tidak Baik', 'Tidak Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Tidak Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', NULL),
(9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Tidak Baik', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Tidak Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', NULL),
(10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Tidak Baik', 'Tidak Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', NULL),
(11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Tidak Baik', 'Tidak Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', NULL),
(12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Tidak Baik', 'Tidak Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', NULL),
(13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Tidak Baik', 'Tidak Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', NULL),
(14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Tidak Baik', 'Tidak Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', NULL),
(15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Tidak Baik', 'Tidak Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `nama_petugas` varchar(255) NOT NULL,
  `plat_mobil` varchar(255) NOT NULL,
  `hari` date NOT NULL,
  `photo_filename` varchar(255) NOT NULL,
  `upload_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `nama_petugas`, `plat_mobil`, `hari`, `photo_filename`, `upload_date`) VALUES
(22, 'alfian', 'W 1740 NP ( Inova Lama )', '2024-09-22', '66efc64017d84.png', '2024-09-22 07:24:48'),
(23, 'ppppalfian', 'W 1740 NP ( Inova Lama )', '2024-09-23', '66f0f765cac36.jpg', '2024-09-23 05:06:45'),
(24, 'a', 'W 1740 NP ( Inova Lama )', '2024-09-23', '66f0f7e73ab75.jpg', '2024-09-23 05:08:55'),
(25, 'a', 'W 1740 NP ( Inova Lama )', '2024-09-30', '66fa193ec83a1.jpg', '2024-09-30 03:21:34'),
(26, 'a', 'W 1740 NP ( Inova Lama )', '2024-09-30', '66fa19d0d975c.jpg', '2024-09-30 03:24:00'),
(27, 'www', 'W 1507 NP ( Reborn )', '2024-09-30', '66fa19e34d7e0.jpg', '2024-09-30 03:24:19'),
(28, 'erikerik', 'W 1740 NP ( Inova Lama )', '2024-10-02', '66fca5c76447a.jpg', '2024-10-02 01:45:43'),
(29, 'hpalfian', 'W 1374 NP ( Kijang Kapsul )', '2024-10-02', '66fcacd0acae9.jpg', '2024-10-02 02:15:44'),
(30, 'kocak', 'W 1740 NP ( Inova Lama )', '2024-10-02', '66fcafaa81467.jpg', '2024-10-02 02:27:54'),
(31, 'kocak', 'W 1740 NP ( Inova Lama )', '2024-10-02', '66fcb0e2bf64f.jpg', '2024-10-02 02:33:06'),
(32, 'bagas', 'W 1507 NP ( Reborn )', '2024-10-02', '66fcb18ee3677.jpg', '2024-10-02 02:35:58'),
(33, 'a', 'W 1740 NP ( Inova Lama )', '2024-10-02', '66fcb22876535.jpg', '2024-10-02 02:38:32'),
(34, 'ppppp', 'W 1507 NP ( Reborn )', '2024-10-02', '66fcb5bf5903b.jpg', '2024-10-02 02:53:51'),
(35, 'erikerikoke', 'W 1740 NP ( Inova Lama )', '2024-10-02', '66fcbccdcb56b.jpg', '2024-10-02 03:23:57'),
(36, 'dhika', 'W 1740 NP ( Inova Lama )', '2024-10-02', '66fccc54c4431.jpg', '2024-10-02 04:30:12'),
(37, 'bagas moshing', 'W 1740 NP ( Inova Lama )', '2024-10-02', '66fcfb5e1d4c0.jpg', '2024-10-02 07:50:54'),
(38, 'ggg', 'W 1740 NP ( Inova Lama )', '2024-10-02', '66fcfbb60d1e1.jpg', '2024-10-02 07:52:22'),
(39, 'ggg', 'W 1740 NP ( Inova Lama )', '2024-10-02', '66fcfc8265a1e.png', '2024-10-02 07:55:46'),
(40, 'a', 'W 1740 NP ( Inova Lama )', '2024-10-02', '66fcfe7759f55.png', '2024-10-02 08:04:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `role`) VALUES
(1, 'erikadmin', 'admin', '123', 'admin'),
(2, 'alfian fathurrahman', 'driver1', '123x', 'user'),
(3, 'erik zubair', 'driver2', '123x', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checkup`
--
ALTER TABLE `checkup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checkup`
--
ALTER TABLE `checkup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
