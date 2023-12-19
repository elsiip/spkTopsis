-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 18, 2023 at 11:28 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_topsis`
--

-- --------------------------------------------------------

--
-- Table structure for table `alternatif`
--

CREATE TABLE `alternatif` (
  `id_alternatif` int NOT NULL,
  `nama_alternatif` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alternatif`
--

INSERT INTO `alternatif` (`id_alternatif`, `nama_alternatif`) VALUES
(1, 'Abdullah'),
(2, 'Wijaya'),
(3, 'Pratama'),
(4, 'Susanto'),
(5, 'Utomo'),
(6, 'Sari'),
(7, 'Kusuma'),
(8, 'Nugroho'),
(9, 'Setiawan'),
(10, 'Hartono'),
(11, 'Purnama'),
(12, 'Putra'),
(13, 'Hadi'),
(14, 'Permadi'),
(15, 'Santoso'),
(16, 'Yulianto'),
(17, 'Rahayu'),
(18, 'Wulandari'),
(19, 'Saputra'),
(20, 'Hermawan'),
(21, 'Surya'),
(22, 'Astuti'),
(23, 'Wirawan'),
(24, 'Jaya'),
(25, 'Fitri'),
(26, 'Sutanto'),
(27, 'Widodo'),
(28, 'Mulia'),
(29, 'Susilowati'),
(30, 'Kurniawan');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int NOT NULL,
  `nama_kriteria` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `bobot` int NOT NULL,
  `jenis_kriteria` varchar(20) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama_kriteria`, `bobot`, `jenis_kriteria`) VALUES
(1, 'Umur', 5, 'Benefit'),
(2, 'Pekerjaan', 4, 'Benefit'),
(3, 'Penghasilan Bulanan', 2, 'Benefit'),
(4, 'Luas Bangunan', 4, 'Cost'),
(5, 'Jumlah Tanggungan', 3, 'Cost'),
(6, 'Tagihan Listrik', 4, 'Cost'),
(7, 'Konsumsi Daging', 1, 'Cost');

-- --------------------------------------------------------

--
-- Table structure for table `sampel`
--

CREATE TABLE `sampel` (
  `id_sampel` int NOT NULL,
  `id_alternatif` int NOT NULL,
  `id_kriteria` int NOT NULL,
  `nilai` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sampel`
--

INSERT INTO `sampel` (`id_sampel`, `id_alternatif`, `id_kriteria`, `nilai`) VALUES
(1, 1, 1, 2),
(3, 1, 2, 3),
(4, 1, 3, 3),
(5, 1, 4, 4),
(6, 1, 5, 3),
(7, 1, 6, 4),
(8, 1, 7, 5),
(9, 2, 1, 3),
(10, 2, 2, 3),
(11, 2, 3, 2),
(12, 2, 4, 4),
(13, 2, 5, 5),
(14, 2, 6, 2),
(15, 2, 7, 3),
(16, 3, 1, 4),
(17, 3, 2, 3),
(18, 3, 3, 3),
(19, 3, 4, 2),
(20, 3, 5, 2),
(21, 3, 6, 4),
(22, 3, 7, 2),
(23, 4, 1, 3),
(24, 4, 2, 3),
(25, 4, 3, 4),
(26, 4, 4, 3),
(27, 4, 5, 4),
(28, 4, 6, 4),
(29, 4, 7, 5),
(30, 5, 1, 3),
(31, 5, 2, 3),
(32, 5, 3, 2),
(33, 5, 4, 2),
(34, 5, 5, 4),
(35, 5, 6, 3),
(36, 5, 7, 3),
(37, 6, 1, 2),
(38, 6, 2, 4),
(39, 6, 3, 3),
(40, 6, 4, 2),
(41, 6, 5, 5),
(42, 6, 6, 4),
(43, 6, 7, 1),
(44, 7, 1, 5),
(45, 7, 2, 4),
(46, 7, 3, 2),
(47, 7, 4, 5),
(48, 7, 5, 5),
(49, 7, 6, 5),
(50, 7, 7, 5),
(51, 8, 1, 4),
(52, 8, 2, 5),
(53, 8, 3, 5),
(54, 8, 4, 6),
(55, 8, 5, 4),
(56, 8, 6, 2),
(57, 8, 7, 3),
(58, 9, 1, 4),
(59, 9, 2, 2),
(60, 9, 3, 4),
(61, 9, 4, 4),
(62, 9, 5, 3),
(63, 9, 6, 3),
(64, 9, 7, 4),
(65, 10, 1, 1),
(66, 10, 2, 3),
(67, 10, 3, 1),
(68, 10, 4, 4),
(69, 10, 5, 2),
(70, 10, 6, 4),
(71, 10, 7, 1),
(72, 11, 1, 3),
(73, 11, 2, 3),
(74, 11, 3, 3),
(75, 11, 4, 3),
(76, 11, 5, 1),
(77, 11, 6, 2),
(78, 11, 7, 2),
(79, 12, 1, 2),
(80, 12, 2, 3),
(81, 12, 3, 2),
(83, 12, 5, 3),
(84, 12, 6, 3),
(85, 12, 7, 2),
(86, 12, 4, 1),
(87, 13, 1, 5),
(88, 13, 2, 4),
(89, 13, 3, 2),
(90, 13, 4, 2),
(91, 13, 5, 2),
(92, 13, 6, 1),
(93, 13, 7, 3),
(167, 14, 1, 5),
(168, 14, 2, 4),
(169, 14, 3, 5),
(170, 14, 4, 4),
(171, 14, 5, 3),
(172, 14, 6, 2),
(173, 14, 7, 4),
(174, 15, 1, 5),
(175, 15, 2, 1),
(176, 15, 4, 3),
(177, 15, 3, 5),
(178, 15, 5, 2),
(179, 15, 6, 3),
(181, 15, 7, 5),
(182, 16, 1, 1),
(183, 16, 2, 1),
(184, 16, 3, 4),
(185, 16, 4, 2),
(186, 16, 5, 1),
(187, 16, 6, 5),
(188, 16, 7, 1),
(189, 17, 1, 4),
(190, 17, 2, 4),
(191, 17, 3, 2),
(192, 17, 4, 3),
(193, 17, 5, 5),
(194, 17, 6, 4),
(195, 17, 7, 1),
(196, 18, 1, 3),
(197, 18, 2, 2),
(198, 18, 3, 1),
(199, 18, 4, 1),
(200, 18, 5, 4),
(201, 18, 6, 2),
(202, 18, 7, 2),
(203, 19, 1, 4),
(204, 19, 2, 3),
(205, 19, 3, 1),
(206, 19, 4, 4),
(207, 19, 5, 5),
(208, 19, 6, 1),
(209, 19, 7, 3),
(210, 20, 1, 5),
(211, 20, 2, 3),
(212, 20, 3, 3),
(213, 20, 4, 2),
(214, 20, 5, 3),
(215, 20, 6, 4),
(216, 20, 7, 4),
(217, 21, 1, 4),
(218, 21, 2, 5),
(219, 21, 3, 4),
(221, 21, 4, 4),
(222, 21, 5, 2),
(223, 21, 6, 2),
(224, 21, 7, 2),
(225, 22, 1, 3),
(226, 22, 2, 5),
(227, 22, 3, 3),
(228, 22, 4, 5),
(229, 22, 5, 4),
(230, 22, 6, 3),
(231, 22, 7, 1),
(232, 23, 1, 2),
(233, 23, 2, 2),
(234, 23, 3, 4),
(235, 23, 4, 3),
(236, 23, 5, 2),
(237, 23, 6, 5),
(238, 23, 7, 3),
(239, 24, 1, 1),
(240, 24, 2, 2),
(241, 24, 3, 5),
(242, 24, 4, 1),
(243, 24, 5, 1),
(244, 24, 6, 5),
(245, 24, 7, 5),
(246, 25, 1, 5),
(247, 25, 2, 1),
(248, 25, 3, 5),
(249, 25, 4, 2),
(250, 25, 5, 1),
(251, 25, 6, 1),
(252, 25, 7, 4),
(253, 26, 1, 5),
(254, 26, 2, 4),
(255, 26, 3, 3),
(256, 26, 4, 4),
(257, 26, 5, 3),
(258, 26, 6, 2),
(259, 26, 7, 4),
(260, 27, 1, 3),
(261, 27, 2, 3),
(262, 27, 3, 4),
(263, 27, 4, 5),
(264, 27, 5, 5),
(265, 27, 6, 3),
(266, 27, 7, 5),
(267, 28, 1, 2),
(268, 28, 2, 5),
(269, 28, 3, 1),
(270, 28, 4, 2),
(271, 28, 5, 4),
(273, 28, 6, 4),
(274, 28, 7, 3),
(275, 29, 1, 2),
(276, 29, 2, 4),
(277, 29, 3, 4),
(279, 29, 4, 3),
(280, 29, 5, 3),
(281, 29, 6, 2),
(282, 29, 7, 1),
(283, 30, 1, 4),
(284, 30, 2, 2),
(285, 30, 3, 1),
(286, 30, 4, 1),
(287, 30, 5, 5),
(288, 30, 6, 1),
(289, 30, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(20) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, 'Elsi Puspitasari', 'elsi@gmail.com', 'elsi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `sampel`
--
ALTER TABLE `sampel`
  ADD PRIMARY KEY (`id_sampel`),
  ADD KEY `pk_id_alternatif` (`id_alternatif`),
  ADD KEY `pk_id_kriteria` (`id_kriteria`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id_alternatif` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sampel`
--
ALTER TABLE `sampel`
  MODIFY `id_sampel` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=290;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sampel`
--
ALTER TABLE `sampel`
  ADD CONSTRAINT `pk_id_alternatif` FOREIGN KEY (`id_alternatif`) REFERENCES `alternatif` (`id_alternatif`),
  ADD CONSTRAINT `pk_id_kriteria` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
