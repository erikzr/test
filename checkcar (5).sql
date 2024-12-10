-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2024 at 04:09 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

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
-- Table structure for table `servicerutin`
--

CREATE TABLE `servicerutin` (
  `id` int(11) NOT NULL,
  `mobil` varchar(50) NOT NULL,
  `kilometer` int(11) NOT NULL,
  `tanggal_perbaikan` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `jenis_service` varchar(50) NOT NULL,
  `item_service` varchar(50) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `bukti_nota` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_inspection`
--

CREATE TABLE `vehicle_inspection` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `plat_mobil` varchar(20) DEFAULT NULL,
  `oli_mesin` varchar(50) DEFAULT NULL,
  `oli_mesin_foto` varchar(255) DEFAULT NULL,
  `oli_power_steering` varchar(50) DEFAULT NULL,
  `oli_power_steering_foto` varchar(255) DEFAULT NULL,
  `oli_transmisi` varchar(50) DEFAULT NULL,
  `oli_transmisi_foto` varchar(255) DEFAULT NULL,
  `minyak_rem` varchar(50) DEFAULT NULL,
  `minyak_rem_foto` varchar(255) DEFAULT NULL,
  `lampu_utama` varchar(50) DEFAULT NULL,
  `lampu_utama_foto` varchar(255) DEFAULT NULL,
  `lampu_sein` varchar(50) DEFAULT NULL,
  `lampu_sein_foto` varchar(255) DEFAULT NULL,
  `lampu_rem` varchar(50) DEFAULT NULL,
  `lampu_rem_foto` varchar(255) DEFAULT NULL,
  `lampu_klakson` varchar(50) DEFAULT NULL,
  `lampu_klakson_foto` varchar(255) DEFAULT NULL,
  `cek_aki` varchar(50) DEFAULT NULL,
  `aki_foto` varchar(255) DEFAULT NULL,
  `cek_kursi` varchar(50) DEFAULT NULL,
  `kursi_foto` varchar(255) DEFAULT NULL,
  `cek_lantai` varchar(50) DEFAULT NULL,
  `lantai_foto` varchar(255) DEFAULT NULL,
  `cek_dinding` varchar(50) DEFAULT NULL,
  `dinding_foto` varchar(255) DEFAULT NULL,
  `cek_kap` varchar(50) DEFAULT NULL,
  `kap_foto` varchar(255) DEFAULT NULL,
  `cek_stnk` varchar(50) DEFAULT NULL,
  `stnk_foto` varchar(255) DEFAULT NULL,
  `cek_apar` varchar(50) DEFAULT NULL,
  `apar_foto` varchar(255) DEFAULT NULL,
  `cek_p3k` varchar(50) DEFAULT NULL,
  `p3k_foto` varchar(255) DEFAULT NULL,
  `cek_kunci_roda` varchar(50) DEFAULT NULL,
  `kunci_roda_foto` varchar(255) DEFAULT NULL,
  `cek_air_radiator` varchar(50) DEFAULT NULL,
  `air_radiator_foto` varchar(255) DEFAULT NULL,
  `cek_bahan_bakar` varchar(50) DEFAULT NULL,
  `bahan_bakar_foto` varchar(255) DEFAULT NULL,
  `cek_tekanan_ban` varchar(50) DEFAULT NULL,
  `tekanan_ban_foto` varchar(255) DEFAULT NULL,
  `cek_rem` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle_inspection`
--

INSERT INTO `vehicle_inspection` (`id`, `nama`, `plat_mobil`, `oli_mesin`, `oli_mesin_foto`, `oli_power_steering`, `oli_power_steering_foto`, `oli_transmisi`, `oli_transmisi_foto`, `minyak_rem`, `minyak_rem_foto`, `lampu_utama`, `lampu_utama_foto`, `lampu_sein`, `lampu_sein_foto`, `lampu_rem`, `lampu_rem_foto`, `lampu_klakson`, `lampu_klakson_foto`, `cek_aki`, `aki_foto`, `cek_kursi`, `kursi_foto`, `cek_lantai`, `lantai_foto`, `cek_dinding`, `dinding_foto`, `cek_kap`, `kap_foto`, `cek_stnk`, `stnk_foto`, `cek_apar`, `apar_foto`, `cek_p3k`, `p3k_foto`, `cek_kunci_roda`, `kunci_roda_foto`, `cek_air_radiator`, `air_radiator_foto`, `cek_bahan_bakar`, `bahan_bakar_foto`, `cek_tekanan_ban`, `tekanan_ban_foto`, `cek_rem`, `created_at`, `updated_at`) VALUES
(3, 'alfian fathurrahman', 'W 1740 NP', 'tidak_baik', NULL, 'baik', NULL, 'tidak_baik', NULL, 'tidak_baik', NULL, 'baik', NULL, 'baik', NULL, 'baik', NULL, 'tidak_baik', NULL, 'tidak_baik', NULL, 'tidak_baik', NULL, 'baik', NULL, 'baik', NULL, 'tidak_baik', NULL, 'baik', NULL, 'baik', NULL, 'tidak_baik', NULL, 'baik', NULL, 'tidak_baik', NULL, 'tidak_baik', NULL, 'tidak_baik', NULL, 'baik', '2024-10-17 08:04:41', '2024-10-17 08:04:41'),
(4, 'alfian fathurrahman', 'W 1507 NP', 'baik', NULL, 'baik', NULL, 'tidak_baik', NULL, 'baik', NULL, 'baik', NULL, 'tidak_baik', NULL, 'baik', NULL, 'tidak_baik', NULL, 'baik', NULL, 'tidak_baik', NULL, 'tidak_baik', NULL, 'baik', NULL, 'baik', NULL, 'tidak_baik', NULL, 'baik', NULL, 'tidak_baik', NULL, 'baik', NULL, 'baik', NULL, 'tidak_baik', NULL, 'baik', NULL, 'baik', '2024-10-17 08:05:09', '2024-10-17 08:05:09'),
(5, 'alfian fathurrahman', 'W 1374 NP', 'baik', NULL, 'baik', NULL, 'tidak_baik', NULL, 'baik', NULL, 'tidak_baik', NULL, 'baik', NULL, 'baik', NULL, 'tidak_baik', NULL, 'tidak_baik', NULL, 'baik', NULL, 'tidak_baik', NULL, 'tidak_baik', NULL, 'baik', NULL, 'tidak_baik', NULL, 'baik', NULL, 'baik', NULL, 'tidak_baik', NULL, 'tidak_baik', NULL, 'tidak_baik', NULL, 'baik', NULL, 'tidak_baik', '2024-10-17 08:05:29', '2024-10-17 08:05:29'),
(6, 'erik zubair', 'W 1740 NP', 'baik', NULL, 'tidak_baik', NULL, 'tidak_baik', NULL, 'baik', NULL, 'tidak_baik', NULL, 'baik', NULL, 'baik', NULL, 'baik', NULL, 'tidak_baik', NULL, 'tidak_baik', NULL, 'tidak_baik', NULL, 'baik', NULL, 'baik', NULL, 'baik', NULL, 'baik', NULL, 'baik', NULL, 'tidak_baik', NULL, 'baik', NULL, 'baik', NULL, 'tidak_baik', NULL, 'baik', '2024-10-17 08:09:43', '2024-10-17 08:09:43'),
(7, 'erik zubair', 'W 1507 NP', 'tidak_baik', NULL, 'tidak_baik', NULL, 'tidak_baik', NULL, 'tidak_baik', NULL, 'baik', NULL, 'baik', NULL, 'baik', NULL, 'baik', NULL, 'tidak_baik', NULL, 'baik', NULL, 'tidak_baik', NULL, 'tidak_baik', NULL, 'tidak_baik', NULL, 'tidak_baik', NULL, 'baik', NULL, 'baik', NULL, 'tidak_baik', NULL, 'tidak_baik', NULL, 'tidak_baik', NULL, 'baik', NULL, 'tidak_baik', '2024-10-17 08:10:02', '2024-10-17 08:10:02'),
(8, 'erik zubair', 'W 1374 NP', 'baik', NULL, 'baik', NULL, 'baik', NULL, 'tidak_baik', NULL, 'baik', NULL, 'baik', NULL, 'baik', NULL, 'tidak_baik', NULL, 'tidak_baik', NULL, 'tidak_baik', NULL, 'baik', NULL, 'baik', NULL, 'tidak_baik', NULL, 'baik', NULL, 'baik', NULL, 'baik', NULL, 'baik', NULL, 'baik', NULL, 'baik', NULL, 'baik', NULL, 'tidak_baik', '2024-10-17 08:10:19', '2024-10-17 08:10:19'),
(9, '', '', '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, '', '2024-10-23 02:32:29', '2024-10-23 02:32:29'),
(10, 'erik zubair', 'W 1740 NP', 'tidak_baik', NULL, 'tidak_baik', NULL, 'tidak_baik', NULL, 'tidak_baik', NULL, 'baik', NULL, 'tidak_baik', NULL, 'tidak_baik', NULL, 'tidak_baik', NULL, 'baik', NULL, 'baik', NULL, 'baik', NULL, 'tidak_baik', NULL, 'baik', NULL, 'baik', NULL, 'baik', NULL, 'tidak_baik', NULL, 'baik', NULL, 'tidak_baik', NULL, 'baik', NULL, 'baik', NULL, 'baik', '2024-10-23 02:34:29', '2024-10-23 02:34:29'),
(11, 'erik zubair', 'W 1507 NP', '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, '', '2024-10-23 02:35:33', '2024-10-23 02:35:33'),
(12, 'erik zubair', 'W 1374 NP', 'baik', NULL, 'baik', NULL, 'baik', NULL, 'baik', NULL, 'baik', NULL, 'baik', NULL, 'tidak_baik', NULL, 'baik', NULL, 'baik', NULL, 'baik', NULL, 'baik', NULL, 'baik', NULL, 'baik', NULL, 'baik', NULL, 'baik', NULL, 'baik', NULL, 'baik', '../../form/uploads/671863d7995cf_proses gambar 2.png', 'baik', NULL, 'baik', NULL, 'baik', NULL, 'baik', '2024-10-23 02:47:51', '2024-10-23 02:47:51'),
(13, 'erik zubair', 'W 1374 NP', 'baik', '../../form/uploads/671864975a4d8_proses gambar 2.png', 'baik', '../../form/uploads/671864975a71c_proses gambar 2.png', 'baik', '../../form/uploads/671864975a956_proses gambar 2.png', 'baik', '../../form/uploads/671864975abda_proses gambar 2.png', 'baik', '../../form/uploads/671864975ae6b_proses gambar 2.png', 'baik', '../../form/uploads/671864975b368_proses gambar 2.png', 'tidak_baik', '../../form/uploads/671864975b711_proses gambar.png', 'baik', '../../form/uploads/671864975ba4d_proses gambar 2.png', 'baik', '../../form/uploads/671864975bd09_proses gambar 2.png', 'baik', '../../form/uploads/671864975bf6d_proses gambar 2.png', 'baik', '../../form/uploads/671864975c295_proses gambar 2.png', 'baik', '../../form/uploads/671864975c4c1_proses gambar 2.png', 'baik', '../../form/uploads/671864975c730_proses gambar 2.png', 'baik', '../../form/uploads/671864975c9ee_proses gambar 2.png', 'baik', '../../form/uploads/671864975ccfb_proses gambar 2.png', 'baik', '../../form/uploads/671864975cf4a_proses gambar 2.png', 'baik', '../../form/uploads/671864975d1d4_proses gambar 2.png', 'baik', '../../form/uploads/671864975d400_proses gambar 2.png', 'baik', '../../form/uploads/671864975d6bf_proses gambar 2.png', 'baik', '../../form/uploads/671864975d934_proses gambar 2.png', 'baik', '2024-10-23 02:51:03', '2024-10-23 02:51:03'),
(14, 'erik zubair', 'W 1374 NP', 'baik', '../../form/uploads/671864b1b8169_proses gambar 2.png', 'baik', '../../form/uploads/671864b1b8420_proses gambar 2.png', 'baik', '../../form/uploads/671864b1b8675_proses gambar 2.png', 'baik', '../../form/uploads/671864b1b88ad_proses gambar 2.png', 'baik', '../../form/uploads/671864b1b8a86_proses gambar 2.png', 'baik', '../../form/uploads/671864b1b8cab_proses gambar 2.png', 'tidak_baik', '../../form/uploads/671864b1b8ea6_proses gambar.png', 'baik', '../../form/uploads/671864b1b90b1_proses gambar 2.png', 'baik', '../../form/uploads/671864b1b9a02_proses gambar 2.png', 'baik', '../../form/uploads/671864b1b9db1_proses gambar 2.png', 'baik', '../../form/uploads/671864b1b9fff_proses gambar 2.png', 'baik', '../../form/uploads/671864b1ba2cd_proses gambar 2.png', 'tidak_baik', '../../form/uploads/671864b1ba4dc_proses gambar 2.png', 'baik', '../../form/uploads/671864b1ba708_proses gambar 2.png', 'baik', '../../form/uploads/671864b1ba92b_proses gambar 2.png', 'baik', '../../form/uploads/671864b1bab3f_proses gambar 2.png', 'baik', '../../form/uploads/671864b1bad4c_proses gambar 2.png', 'baik', '../../form/uploads/671864b1baf20_proses gambar 2.png', 'baik', '../../form/uploads/671864b1bb0ea_proses gambar 2.png', 'baik', '../../form/uploads/671864b1bb2ae_proses gambar 2.png', 'baik', '2024-10-23 02:51:29', '2024-10-23 02:51:29'),
(15, 'erik zubair', 'W 1740 NP', 'baik', '../../form/uploads/671864dd6c61d_proses gambar 2.png', 'baik', '../../form/uploads/671864dd6c908_proses gambar 2.png', 'baik', '../../form/uploads/671864dd6cdc1_proses gambar 2.png', 'tidak_baik', '../../form/uploads/671864dd6d099_proses gambar 2.png', 'baik', '../../form/uploads/671864dd6d28c_proses gambar 2.png', 'baik', '../../form/uploads/671864dd6d459_proses gambar 2.png', 'tidak_baik', '../../form/uploads/671864dd6d7b2_proses gambar.png', 'baik', '../../form/uploads/671864dd6da44_proses gambar 2.png', 'baik', '../../form/uploads/671864dd6de25_proses gambar 2.png', 'baik', '../../form/uploads/671864dd6e110_proses gambar 2.png', 'baik', '../../form/uploads/671864dd6e3d2_proses gambar 2.png', 'baik', '../../form/uploads/671864dd6e6f0_proses gambar 2.png', 'tidak_baik', '../../form/uploads/671864dd6e9e4_proses gambar 2.png', 'baik', '../../form/uploads/671864dd6ebfb_proses gambar 2.png', 'baik', '../../form/uploads/671864dd6ee85_proses gambar 2.png', 'baik', '../../form/uploads/671864dd6f0f1_proses gambar 2.png', 'baik', '../../form/uploads/671864dd6f70f_proses gambar 2.png', 'baik', '../../form/uploads/671864dd6f9bc_proses gambar 2.png', 'baik', '../../form/uploads/671864dd6fc53_proses gambar 2.png', 'baik', '../../form/uploads/671864dd6fec0_proses gambar 2.png', 'baik', '2024-10-23 02:52:13', '2024-10-23 02:52:13'),
(16, 'erik zubair', 'W 1507 NP', 'baik', '../../form/uploads/671865db2d9d6_proses gambar 2.png', 'baik', '../../form/uploads/671865db2dc50_proses gambar 2.png', 'baik', '../../form/uploads/671865db2de2e_proses gambar 2.png', 'baik', '../../form/uploads/671865db2e072_proses gambar 2.png', 'baik', '../../form/uploads/671865db2e290_proses gambar 2.png', 'baik', '../../form/uploads/671865db2e48a_proses gambar 2.png', 'baik', '../../form/uploads/671865db2e72f_proses gambar.png', 'baik', '../../form/uploads/671865db2e99d_proses gambar 2.png', 'tidak_baik', '../../form/uploads/671865db2eb7d_proses gambar 2.png', 'baik', '../../form/uploads/671865db2efe4_proses gambar 2.png', 'baik', '../../form/uploads/671865db2f2c3_proses gambar 2.png', 'baik', '../../form/uploads/671865db2f540_proses gambar 2.png', 'tidak_baik', '../../form/uploads/671865db2f75e_proses gambar 2.png', 'baik', '../../form/uploads/671865db2faee_proses gambar 2.png', 'baik', '../../form/uploads/671865db2fdb3_proses gambar 2.png', 'baik', '../../form/uploads/671865db300aa_proses gambar 2.png', 'baik', '../../form/uploads/671865db302ac_proses gambar 2.png', 'baik', '../../form/uploads/671865db3054b_proses gambar 2.png', 'baik', '../../form/uploads/671865db3073c_proses gambar 2.png', 'baik', '../../form/uploads/671865db309f3_proses gambar 2.png', 'baik', '2024-10-23 02:56:27', '2024-10-23 02:56:27'),
(17, 'erik zubair', 'W 1507 NP', 'baik', '../../form/uploads/671865f1e15c8_proses gambar 2.png', 'baik', '../../form/uploads/671865f1e17f7_proses gambar 2.png', 'baik', '../../form/uploads/671865f1e19fa_proses gambar 2.png', 'baik', '../../form/uploads/671865f1e1c37_proses gambar 2.png', 'baik', '../../form/uploads/671865f1e1e56_proses gambar 2.png', 'baik', '../../form/uploads/671865f1e204e_proses gambar 2.png', 'baik', '../../form/uploads/671865f1e226a_proses gambar.png', 'baik', '../../form/uploads/671865f1e2525_proses gambar 2.png', 'tidak_baik', '../../form/uploads/671865f1e2793_proses gambar 2.png', 'baik', '../../form/uploads/671865f1e2986_proses gambar 2.png', 'baik', '../../form/uploads/671865f1e2baa_proses gambar 2.png', 'baik', '../../form/uploads/671865f1e2df8_proses gambar 2.png', 'tidak_baik', '../../form/uploads/671865f1e2fd8_proses gambar 2.png', 'baik', '../../form/uploads/671865f1e3255_proses gambar 2.png', 'baik', '../../form/uploads/671865f1e34af_proses gambar 2.png', 'baik', '../../form/uploads/671865f1e37da_proses gambar 2.png', 'baik', '../../form/uploads/671865f1e3a18_proses gambar 2.png', 'baik', '../../form/uploads/671865f1e3c76_proses gambar 2.png', 'baik', '../../form/uploads/671865f1e3f1e_proses gambar 2.png', 'baik', '../../form/uploads/671865f1e422f_proses gambar 2.png', 'baik', '2024-10-23 02:56:49', '2024-10-23 02:56:49'),
(18, 'erik zubair', 'W 1507 NP', 'baik', '../../form/uploads/671865fb06b42_proses gambar 2.png', 'baik', '../../form/uploads/671865fb06df7_proses gambar 2.png', 'baik', '../../form/uploads/671865fb0b318_proses gambar 2.png', 'baik', '../../form/uploads/671865fb0b59b_proses gambar 2.png', 'baik', '../../form/uploads/671865fb0b7e1_proses gambar 2.png', 'baik', '../../form/uploads/671865fb0ba00_proses gambar 2.png', 'baik', '../../form/uploads/671865fb0bbfe_proses gambar.png', 'baik', '../../form/uploads/671865fb0bf61_proses gambar 2.png', 'tidak_baik', '../../form/uploads/671865fb0c2a8_proses gambar 2.png', 'baik', '../../form/uploads/671865fb0c523_proses gambar 2.png', 'baik', '../../form/uploads/671865fb0c83a_proses gambar 2.png', 'baik', '../../form/uploads/671865fb0cb27_proses gambar 2.png', 'tidak_baik', '../../form/uploads/671865fb0cdd2_proses gambar 2.png', 'baik', '../../form/uploads/671865fb0d02d_proses gambar 2.png', 'baik', '../../form/uploads/671865fb0d3f9_proses gambar 2.png', 'baik', '../../form/uploads/671865fb0d6b0_proses gambar 2.png', 'baik', '../../form/uploads/671865fb0d903_proses gambar 2.png', 'baik', '../../form/uploads/671865fb0db3f_proses gambar 2.png', 'baik', '../../form/uploads/671865fb0de47_proses gambar 2.png', 'baik', '../../form/uploads/671865fb0e1ea_proses gambar 2.png', 'baik', '2024-10-23 02:56:59', '2024-10-23 02:56:59'),
(19, 'erik zubair', 'W 1507 NP', 'baik', '../../form/uploads/671866443ca46_proses gambar 2.png', 'baik', '../../form/uploads/671866443ccc9_proses gambar 2.png', 'baik', '../../form/uploads/671866443cf0d_proses gambar 2.png', 'baik', '../../form/uploads/671866443d17e_proses gambar 2.png', 'tidak_baik', '../../form/uploads/671866443d582_proses gambar 2.png', 'tidak_baik', '../../form/uploads/671866443da87_proses gambar 2.png', 'tidak_baik', '../../form/uploads/671866443dce3_proses gambar.png', 'tidak_baik', '../../form/uploads/671866443dead_proses gambar 2.png', 'tidak_baik', '../../form/uploads/671866443e09e_proses gambar 2.png', 'baik', '../../form/uploads/671866443e2df_proses gambar 2.png', 'baik', '../../form/uploads/671866443e4c3_proses gambar 2.png', 'baik', '../../form/uploads/671866443e6bb_proses gambar 2.png', 'tidak_baik', '../../form/uploads/671866443e8af_proses gambar 2.png', 'baik', '../../form/uploads/671866443eacc_proses gambar 2.png', 'baik', '../../form/uploads/671866443ed6f_proses gambar 2.png', 'baik', '../../form/uploads/671866443ef95_proses gambar 2.png', 'baik', '../../form/uploads/671866443f2a0_proses gambar 2.png', 'baik', '../../form/uploads/671866443f4e5_proses gambar 2.png', 'baik', '../../form/uploads/671866443f709_proses gambar 2.png', 'baik', '../../form/uploads/671866443f947_proses gambar 2.png', 'baik', '2024-10-23 02:58:12', '2024-10-23 02:58:12'),
(20, 'erik zubair', 'W 1507 NP', 'baik', '../../form/uploads/671866674f4a2_proses gambar 2.png', 'baik', '../../form/uploads/671866674f709_proses gambar 2.png', 'baik', '../../form/uploads/671866674f906_proses gambar 2.png', 'baik', '../../form/uploads/671866674fb76_proses gambar 2.png', 'tidak_baik', '../../form/uploads/671866674fd85_proses gambar 2.png', 'tidak_baik', '../../form/uploads/671866674ffb7_proses gambar 2.png', 'tidak_baik', '../../form/uploads/6718666750224_proses gambar.png', 'tidak_baik', '../../form/uploads/6718666750485_proses gambar 2.png', 'tidak_baik', '../../form/uploads/67186667506b5_proses gambar 2.png', 'baik', '../../form/uploads/67186667509c6_proses gambar 2.png', 'baik', '../../form/uploads/6718666750bd3_proses gambar 2.png', 'baik', '../../form/uploads/6718666750ea5_proses gambar 2.png', 'tidak_baik', '../../form/uploads/671866675110b_proses gambar 2.png', 'baik', '../../form/uploads/67186667513c9_proses gambar 2.png', 'baik', '../../form/uploads/67186667515e3_proses gambar 2.png', 'baik', '../../form/uploads/6718666751840_proses gambar 2.png', 'baik', '../../form/uploads/6718666751a67_proses gambar 2.png', 'baik', '../../form/uploads/6718666751cc9_proses gambar 2.png', 'baik', '../../form/uploads/6718666751f24_proses gambar 2.png', 'baik', '../../form/uploads/6718666752145_proses gambar 2.png', 'baik', '2024-10-23 02:58:47', '2024-10-23 02:58:47'),
(21, 'erik zubair', 'W 1507 NP', 'baik', '../../form/uploads/671866df33266_proses gambar 2.png', 'baik', '../../form/uploads/671866df334a7_proses gambar 2.png', 'baik', '../../form/uploads/671866df337e7_proses gambar 2.png', 'baik', '../../form/uploads/671866df33a5d_proses gambar 2.png', 'tidak_baik', '../../form/uploads/671866df33c95_proses gambar 2.png', 'tidak_baik', '../../form/uploads/671866df3401d_proses gambar 2.png', 'tidak_baik', '../../form/uploads/671866df342ce_proses gambar.png', 'tidak_baik', '../../form/uploads/671866df34592_proses gambar 2.png', 'tidak_baik', '../../form/uploads/671866df3481c_proses gambar 2.png', 'baik', '../../form/uploads/671866df34ac9_proses gambar 2.png', 'baik', '../../form/uploads/671866df34d7a_proses gambar 2.png', 'baik', '../../form/uploads/671866df34f94_proses gambar 2.png', 'tidak_baik', '../../form/uploads/671866df35204_proses gambar 2.png', 'baik', '../../form/uploads/671866df354a4_proses gambar 2.png', 'baik', '../../form/uploads/671866df35719_proses gambar 2.png', 'baik', '../../form/uploads/671866df35932_proses gambar 2.png', 'baik', '../../form/uploads/671866df35b96_proses gambar 2.png', 'baik', '../../form/uploads/671866df35df8_proses gambar 2.png', 'baik', '../../form/uploads/671866df3b5e8_proses gambar 2.png', 'baik', '../../form/uploads/671866df3b885_proses gambar 2.png', 'baik', '2024-10-23 03:00:47', '2024-10-23 03:00:47'),
(22, 'erik zubair', 'W 1507 NP', 'baik', '../../form/uploads/671866e9be75e_proses gambar 2.png', 'baik', '../../form/uploads/671866e9be9f4_proses gambar 2.png', 'baik', '../../form/uploads/671866e9bebfe_proses gambar 2.png', 'baik', '../../form/uploads/671866e9bedd6_proses gambar 2.png', 'tidak_baik', '../../form/uploads/671866e9befa6_proses gambar 2.png', 'tidak_baik', '../../form/uploads/671866e9c2fba_proses gambar 2.png', 'tidak_baik', '../../form/uploads/671866e9c328d_proses gambar.png', 'tidak_baik', '../../form/uploads/671866e9c3513_proses gambar 2.png', 'tidak_baik', '../../form/uploads/671866e9c37a2_proses gambar 2.png', 'baik', '../../form/uploads/671866e9c3ad3_proses gambar 2.png', 'baik', '../../form/uploads/671866e9c3df7_proses gambar 2.png', 'baik', '../../form/uploads/671866e9c4107_proses gambar 2.png', 'tidak_baik', '../../form/uploads/671866e9c4364_proses gambar 2.png', 'baik', '../../form/uploads/671866e9c4639_proses gambar 2.png', 'baik', '../../form/uploads/671866e9c488b_proses gambar 2.png', 'baik', '../../form/uploads/671866e9c4ac2_proses gambar 2.png', 'baik', '../../form/uploads/671866e9c4cf4_proses gambar 2.png', 'baik', '../../form/uploads/671866e9c4f29_proses gambar 2.png', 'baik', '../../form/uploads/671866e9c52d0_proses gambar 2.png', 'baik', '../../form/uploads/671866e9c550b_proses gambar 2.png', 'baik', '2024-10-23 03:00:57', '2024-10-23 03:00:57'),
(23, 'erik zubair', 'W 1507 NP', 'baik', '../../form/uploads/6718672ee9a87_proses gambar 2.png', 'baik', '../../form/uploads/6718672ee9e57_proses gambar 2.png', 'baik', '../../form/uploads/6718672eea075_proses gambar 2.png', 'baik', '../../form/uploads/6718672eea2fe_proses gambar 2.png', 'tidak_baik', '../../form/uploads/6718672eea546_proses gambar 2.png', 'tidak_baik', '../../form/uploads/6718672eea781_proses gambar 2.png', 'tidak_baik', '../../form/uploads/6718672eeaa00_proses gambar.png', 'tidak_baik', '../../form/uploads/6718672eeac1a_proses gambar 2.png', 'tidak_baik', '../../form/uploads/6718672eeae7e_proses gambar 2.png', 'baik', '../../form/uploads/6718672eeb22f_proses gambar 2.png', 'baik', '../../form/uploads/6718672eeb454_proses gambar 2.png', 'baik', '../../form/uploads/6718672eeb8de_proses gambar 2.png', 'tidak_baik', '../../form/uploads/6718672eebb77_proses gambar 2.png', 'baik', '../../form/uploads/6718672eebebd_proses gambar 2.png', 'baik', '../../form/uploads/6718672eec12d_proses gambar 2.png', 'baik', '../../form/uploads/6718672eec3b6_proses gambar 2.png', 'baik', '../../form/uploads/6718672eec66d_proses gambar 2.png', 'baik', '../../form/uploads/6718672eec8d6_proses gambar 2.png', 'baik', '../../form/uploads/6718672eecb45_proses gambar 2.png', 'baik', '../../form/uploads/6718672eece03_proses gambar 2.png', 'baik', '2024-10-23 03:02:06', '2024-10-23 03:02:06'),
(24, 'erik zubair', 'W 1507 NP', 'baik', '../../form/uploads/671867379c8ca_proses gambar 2.png', 'baik', '../../form/uploads/671867379cb18_proses gambar 2.png', 'baik', '../../form/uploads/671867379cd43_proses gambar 2.png', 'baik', '../../form/uploads/671867379cfcd_proses gambar 2.png', 'tidak_baik', '../../form/uploads/671867379d244_proses gambar 2.png', 'tidak_baik', '../../form/uploads/671867379d468_proses gambar 2.png', 'tidak_baik', '../../form/uploads/671867379d711_proses gambar.png', 'tidak_baik', '../../form/uploads/671867379d9d3_proses gambar 2.png', 'tidak_baik', '../../form/uploads/671867379dc7c_proses gambar 2.png', 'baik', '../../form/uploads/671867379e004_proses gambar 2.png', 'baik', '../../form/uploads/671867379e2c3_proses gambar 2.png', 'baik', '../../form/uploads/671867379e588_proses gambar 2.png', 'tidak_baik', '../../form/uploads/671867379e8db_proses gambar 2.png', 'baik', '../../form/uploads/671867379eaf3_proses gambar 2.png', 'baik', '../../form/uploads/671867379eec9_proses gambar 2.png', 'baik', '../../form/uploads/671867379f1a9_proses gambar 2.png', 'baik', '../../form/uploads/671867379f3c1_proses gambar 2.png', 'baik', '../../form/uploads/671867379f593_proses gambar 2.png', 'baik', '../../form/uploads/671867379f816_proses gambar 2.png', 'baik', '../../form/uploads/671867379fa68_proses gambar 2.png', 'baik', '2024-10-23 03:02:15', '2024-10-23 03:02:15'),
(25, 'erik zubair', 'W 1507 NP', 'baik', '../../form/uploads/67186786a6ed8_proses gambar 2.png', 'baik', '../../form/uploads/67186786a7166_proses gambar 2.png', 'baik', '../../form/uploads/67186786a741a_proses gambar 2.png', 'baik', '../../form/uploads/67186786a767b_proses gambar 2.png', 'tidak_baik', '../../form/uploads/67186786a786a_proses gambar 2.png', 'tidak_baik', '../../form/uploads/67186786a7ae5_proses gambar 2.png', 'tidak_baik', '../../form/uploads/67186786a7ce5_proses gambar.png', 'tidak_baik', '../../form/uploads/67186786a7f07_proses gambar 2.png', 'tidak_baik', '../../form/uploads/67186786a8188_proses gambar 2.png', 'baik', '../../form/uploads/67186786a8476_proses gambar 2.png', 'baik', '../../form/uploads/67186786a8772_proses gambar 2.png', 'baik', '../../form/uploads/67186786a8af9_proses gambar 2.png', 'tidak_baik', '../../form/uploads/67186786a8d79_proses gambar 2.png', 'baik', '../../form/uploads/67186786a8f97_proses gambar 2.png', 'baik', '../../form/uploads/67186786a91e1_proses gambar 2.png', 'baik', '../../form/uploads/67186786a9448_proses gambar 2.png', 'baik', '../../form/uploads/67186786a9715_proses gambar 2.png', 'baik', '../../form/uploads/67186786a9a0f_proses gambar 2.png', 'baik', '../../form/uploads/67186786a9c75_proses gambar 2.png', 'baik', '../../form/uploads/67186786a9e65_proses gambar 2.png', 'baik', '2024-10-23 03:03:34', '2024-10-23 03:03:34'),
(26, 'alfian fathurrahman', 'W 1740 NP', 'baik', '../../form/uploads/671f5f576d4de_tmpilan.png', 'baik', '../../form/uploads/671f5f576deea_tmpilan.png', 'baik', '../../form/uploads/671f5f576e908_tmpilan.png', 'baik', '../../form/uploads/671f5f576eebf_tmpilan.png', 'baik', '../../form/uploads/671f5f576f479_bukti.png', 'baik', '../../form/uploads/671f5f576f9a7_home.png', 'baik', '../../form/uploads/671f5f576fdad_more.png', 'baik', '../../form/uploads/671f5f57703a8_forgot.png', 'baik', '../../form/uploads/671f5f577083c_bukti.png', 'baik', '../../form/uploads/671f5f5770c94_passcode.png', 'baik', '../../form/uploads/671f5f57710e9_send.png', 'baik', '../../form/uploads/671f5f577155e_send_money.png', 'baik', '../../form/uploads/671f5f57719ba_passcode.png', '', '', '', '', 'baik', '../../form/uploads/671f5f577216f_home.png', 'baik', '../../form/uploads/671f5f577298b_forgot.png', 'baik', '../../form/uploads/671f5f5772e8f_passcode.png', 'baik', '../../form/uploads/671f5f5773320_send.png', 'baik', '../../form/uploads/671f5f57737b8_login.png', 'baik', '2024-10-28 09:54:31', '2024-10-28 09:54:31');

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
-- Indexes for table `servicerutin`
--
ALTER TABLE `servicerutin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `vehicle_inspection`
--
ALTER TABLE `vehicle_inspection`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `servicerutin`
--
ALTER TABLE `servicerutin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vehicle_inspection`
--
ALTER TABLE `vehicle_inspection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
