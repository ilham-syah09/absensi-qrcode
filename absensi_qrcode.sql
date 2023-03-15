-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 15, 2023 at 08:25 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absensi_qrcode`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `image` text NOT NULL DEFAULT 'default.png',
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama`, `username`, `image`, `password`) VALUES
(1, 'Admin Kepegawaian', 'superadmin', 'default.png', '$2y$10$aX3KtHwTSYkN0AZ0fn7LcO727KuqwFEu91mL4kEKw7fYsOou1exSu');

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE `file` (
  `id` int(11) NOT NULL,
  `nama` text DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `file`
--

INSERT INTO `file` (`id`, `nama`, `createdAt`, `updatedAt`) VALUES
(1, 'qrcode-20230311145525.png', '2023-03-11 05:35:17', '2023-03-11 07:55:25');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id` int(11) NOT NULL,
  `namaJabatan` varchar(30) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id`, `namaJabatan`, `createdAt`, `updatedAt`) VALUES
(1, 'Operator Produksi', '2023-02-20 02:19:38', '2023-02-20 04:23:42'),
(3, 'Operator QC', '2023-02-20 02:25:18', '2023-02-20 02:36:00');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id` int(11) NOT NULL,
  `idShift` int(11) NOT NULL,
  `tanggalAwal` date NOT NULL,
  `tanggalAkhir` date NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id`, `idShift`, `tanggalAwal`, `tanggalAkhir`, `createdAt`, `updatedAt`) VALUES
(2, 1, '2023-03-06', '2023-03-10', '2023-03-08 09:31:22', NULL),
(3, 2, '2023-03-08', '2023-03-12', '2023-03-08 09:51:35', NULL),
(7, 1, '2023-03-13', '2023-03-17', '2023-03-14 07:16:54', NULL),
(8, 2, '2023-03-13', '2023-03-17', '2023-03-14 07:17:28', '2023-03-15 03:30:07');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `idJabatan` int(11) NOT NULL,
  `jk` int(1) NOT NULL,
  `status` int(1) NOT NULL,
  `image` text NOT NULL DEFAULT 'default.png',
  `createAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updateAt` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id`, `email`, `password`, `nama`, `nip`, `idJabatan`, `jk`, `status`, `image`, `createAt`, `updateAt`) VALUES
(1, 'pegawai.1@gmail.com', '$2y$10$RCnEISXcGP68RQIyYtcot.5itQA.MDUpFCRhZXBJUHAAYp.oiH3wi', 'Pegawai 1', '199912030001', 3, 2, 1, 'default.png', '2023-02-20 02:17:29', '2023-03-11 03:43:08'),
(5, 'ilham@gmail.com', '$2y$10$RCnEISXcGP68RQIyYtcot.5itQA.MDUpFCRhZXBJUHAAYp.oiH3wi', 'Ilham', '129091209', 1, 1, 1, 'default.png', '2023-02-20 04:15:23', '2023-02-22 02:36:24'),
(8, 'pegawai.3@gmail.com', '$2y$10$RCnEISXcGP68RQIyYtcot.5itQA.MDUpFCRhZXBJUHAAYp.oiH3wi', 'Pegawai 3', '199912030001', 3, 2, 1, 'default.png', '2023-02-20 02:17:29', '2023-03-11 03:43:10'),
(9, 'pegawai.4@gmail.com', '$2y$10$RCnEISXcGP68RQIyYtcot.5itQA.MDUpFCRhZXBJUHAAYp.oiH3wi', 'Pegawai 4', '129091209', 1, 1, 1, 'default.png', '2023-02-20 04:15:23', '2023-02-22 02:36:24');

-- --------------------------------------------------------

--
-- Table structure for table `presensi`
--

CREATE TABLE `presensi` (
  `id` int(11) NOT NULL,
  `idJadwal` int(11) NOT NULL,
  `idPegawai` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `presensiMasuk` time DEFAULT NULL,
  `presensiPulang` time DEFAULT NULL,
  `izin` time DEFAULT NULL,
  `alasanIzin` text DEFAULT NULL,
  `document` text DEFAULT NULL,
  `statusIzin` varchar(25) DEFAULT NULL,
  `tukarShift` int(1) NOT NULL DEFAULT 0,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `presensi`
--

INSERT INTO `presensi` (`id`, `idJadwal`, `idPegawai`, `tanggal`, `presensiMasuk`, `presensiPulang`, `izin`, `alasanIzin`, `document`, `statusIzin`, `tukarShift`, `createdAt`, `updatedAt`) VALUES
(1, 2, 5, '2023-03-06', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-03-08 09:31:23', NULL),
(2, 2, 9, '2023-03-06', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-03-08 09:31:23', NULL),
(3, 2, 5, '2023-03-07', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-03-08 09:31:23', NULL),
(4, 2, 9, '2023-03-07', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-03-08 09:31:23', NULL),
(5, 2, 5, '2023-03-08', NULL, NULL, '07:30:00', 'Males kerja', 'sample-izin.png', 'Disetujui', 0, '2023-03-08 09:31:23', '2023-03-08 14:16:20'),
(6, 2, 9, '2023-03-08', '08:02:00', '16:55:00', NULL, NULL, NULL, NULL, 0, '2023-03-08 09:31:23', '2023-03-08 13:52:57'),
(7, 2, 5, '2023-03-09', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-03-08 09:31:23', NULL),
(8, 2, 9, '2023-03-09', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-03-08 09:31:23', NULL),
(9, 2, 5, '2023-03-10', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-03-08 09:31:23', NULL),
(10, 2, 9, '2023-03-10', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-03-08 09:31:23', NULL),
(11, 3, 1, '2023-03-08', '14:55:00', '22:55:00', NULL, NULL, NULL, NULL, 0, '2023-03-08 09:51:35', '2023-03-08 13:52:13'),
(12, 3, 8, '2023-03-08', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-03-08 09:51:35', NULL),
(13, 3, 1, '2023-03-09', '15:02:00', '23:10:00', NULL, NULL, NULL, NULL, 0, '2023-03-08 09:51:35', '2023-03-09 04:19:22'),
(14, 3, 8, '2023-03-09', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-03-08 09:51:35', NULL),
(15, 3, 1, '2023-03-10', NULL, NULL, '07:45:00', 'Sakit', 'sample-izin.png', 'Disetujui', 0, '2023-03-08 09:51:35', '2023-03-11 04:23:18'),
(16, 3, 8, '2023-03-10', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-03-08 09:51:35', NULL),
(17, 3, 1, '2023-03-11', '14:54:44', '14:55:33', NULL, NULL, NULL, NULL, 0, '2023-03-08 09:51:35', '2023-03-11 07:55:33'),
(18, 3, 8, '2023-03-11', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-03-08 09:51:35', NULL),
(19, 3, 1, '2023-03-12', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-03-08 09:51:35', NULL),
(20, 3, 8, '2023-03-12', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-03-08 09:51:35', NULL),
(66, 7, 1, '2023-03-13', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-03-14 07:18:36', NULL),
(67, 7, 8, '2023-03-13', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-03-14 07:18:36', NULL),
(68, 7, 1, '2023-03-14', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-03-14 07:18:36', NULL),
(69, 7, 8, '2023-03-14', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-03-14 07:18:36', NULL),
(70, 7, 1, '2023-03-15', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-03-14 07:18:36', NULL),
(71, 8, 8, '2023-03-15', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-03-14 07:18:36', '2023-03-15 04:09:33'),
(72, 7, 1, '2023-03-16', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-03-14 07:18:36', NULL),
(73, 7, 8, '2023-03-16', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-03-14 07:18:36', NULL),
(74, 8, 1, '2023-03-17', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-03-14 07:18:36', '2023-03-15 03:33:31'),
(75, 7, 8, '2023-03-17', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-03-14 07:18:36', '2023-03-15 02:17:23'),
(81, 8, 5, '2023-03-13', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-03-15 03:30:07', NULL),
(82, 8, 5, '2023-03-14', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-03-15 03:30:07', NULL),
(83, 7, 5, '2023-03-15', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-03-15 03:30:07', '2023-03-15 04:05:36'),
(84, 8, 5, '2023-03-16', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-03-15 03:30:07', NULL),
(85, 8, 5, '2023-03-17', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-03-15 03:30:07', '2023-03-15 04:05:04');

-- --------------------------------------------------------

--
-- Table structure for table `shift`
--

CREATE TABLE `shift` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jamMasuk` time NOT NULL,
  `jamPulang` time NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shift`
--

INSERT INTO `shift` (`id`, `nama`, `jamMasuk`, `jamPulang`, `createdAt`, `updatedAt`) VALUES
(1, 'Shift Pagi', '08:00:00', '16:00:00', '2023-03-08 02:45:08', '2023-03-08 13:59:59'),
(2, 'Shift Sore', '15:00:00', '23:00:00', '2023-03-08 02:48:30', '2023-03-08 14:00:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `presensi`
--
ALTER TABLE `presensi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shift`
--
ALTER TABLE `shift`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `presensi`
--
ALTER TABLE `presensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `shift`
--
ALTER TABLE `shift`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
