-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2019 at 11:36 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_mom`
--

-- --------------------------------------------------------

--
-- Table structure for table `daftar_peserta`
--

CREATE TABLE `daftar_peserta` (
  `id_daftar_peserta` int(10) UNSIGNED NOT NULL,
  `nama` varchar(64) NOT NULL,
  `instansi` varchar(32) NOT NULL,
  `absen` enum('1','0') NOT NULL,
  `id_mom` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `daftar_peserta`
--

INSERT INTO `daftar_peserta` (`id_daftar_peserta`, `nama`, `instansi`, `absen`, `id_mom`, `created_at`, `updated_at`) VALUES
(6, 'Asep Jawa', 'OJK', '1', 3, '2019-01-16 00:50:46', NULL),
(7, 'Otong Koil', 'OJK', '1', 3, '2019-01-16 00:51:05', NULL),
(8, 'Fahmi Hidayatullah', 'Sangkuriang', '1', 3, '2019-01-16 00:51:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `detail_pokok_bahasan`
--

CREATE TABLE `detail_pokok_bahasan` (
  `id_detail_pokok_bahasan` int(10) UNSIGNED NOT NULL,
  `no` int(10) UNSIGNED NOT NULL,
  `detail_pokok_bahasan` text NOT NULL,
  `id_pokok_bahasan` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_pokok_bahasan`
--

INSERT INTO `detail_pokok_bahasan` (`id_detail_pokok_bahasan`, `no`, `detail_pokok_bahasan`, `id_pokok_bahasan`) VALUES
(2, 1, 'Progress Report dilakukan setiap 2\r\nminggu sekali dengan agenda yang\r\nsudah di tentukan.', 3),
(3, 2, 'Setiap progress report dokumen yang dihasilkan adalah Risalah Rapat dan testing scenario (kalau sudah masuk tahap development)', 3);

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id_gallery` int(10) UNSIGNED NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `id_mom` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id_gallery`, `gambar`, `id_mom`, `created_at`, `updated_at`) VALUES
(2, '315476013715842a8fba6515b1e0ad75b03.png', 3, '2019-01-16 01:16:11', NULL),
(4, '3154785305120171027225440IMG1644.JPG', 3, '2019-01-18 23:10:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mom`
--

CREATE TABLE `mom` (
  `id_mom` int(10) UNSIGNED NOT NULL,
  `agenda` varchar(64) NOT NULL,
  `tanggal_waktu` date NOT NULL,
  `lokasi` varchar(64) NOT NULL,
  `kesimpulan` text,
  `id_project` int(10) UNSIGNED NOT NULL,
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mom`
--

INSERT INTO `mom` (`id_mom`, `agenda`, `tanggal_waktu`, `lokasi`, `kesimpulan`, `id_project`, `id`, `created_at`, `updated_at`) VALUES
(3, 'Kick Off Meeting', '2019-01-18', 'Bandung', 'Analisis Data', 3, 1, '2019-01-16 00:38:26', '2019-01-15 17:39:35');

-- --------------------------------------------------------

--
-- Table structure for table `pokok_bahasan`
--

CREATE TABLE `pokok_bahasan` (
  `id_pokok_bahasan` int(10) UNSIGNED NOT NULL,
  `no` int(10) UNSIGNED NOT NULL,
  `pokok_bahasan` text NOT NULL,
  `id_mom` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pokok_bahasan`
--

INSERT INTO `pokok_bahasan` (`id_pokok_bahasan`, `no`, `pokok_bahasan`, `id_mom`, `created_at`, `updated_at`) VALUES
(3, 1, 'Issue Terhadap Hasil Kick Off', 3, '2019-01-16 00:58:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id_project` int(10) UNSIGNED NOT NULL,
  `nama_project` varchar(128) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id_project`, `nama_project`, `created_at`, `updated_at`) VALUES
(3, 'Otoritas Jasa Keuangan', '2019-01-16 00:26:16', NULL),
(4, 'IDIS', '2019-01-16 02:30:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` enum('admin','user') COLLATE utf8mb4_unicode_ci DEFAULT 'user',
  `no_hp` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `jabatan`, `no_hp`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Fahmi Hidayatullah', 'fahmi.kudo12@gmail.com', NULL, '$2y$10$MjHu7FRbwbnDEvPpQwL1quZuRZjRRInauK9wAa098aFYW/X3eQ1e2', 'admin', '085320300227', 'EbXiN3SsamzRk410hdaJBIVIovYy2TiYvTGk2iAdVgBE8iY43KrGCByemuXD', '2018-12-20 00:03:15', '2018-12-20 00:03:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daftar_peserta`
--
ALTER TABLE `daftar_peserta`
  ADD PRIMARY KEY (`id_daftar_peserta`),
  ADD KEY `fk_id_mom_daftar_peserta` (`id_mom`);

--
-- Indexes for table `detail_pokok_bahasan`
--
ALTER TABLE `detail_pokok_bahasan`
  ADD PRIMARY KEY (`id_detail_pokok_bahasan`),
  ADD KEY `fk_id_pokok_bahasan` (`id_pokok_bahasan`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id_gallery`),
  ADD KEY `fk_id_mom_gallery` (`id_mom`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mom`
--
ALTER TABLE `mom`
  ADD PRIMARY KEY (`id_mom`) USING BTREE,
  ADD KEY `fk_id_project_mom` (`id_project`),
  ADD KEY `fk_id_mom` (`id`);

--
-- Indexes for table `pokok_bahasan`
--
ALTER TABLE `pokok_bahasan`
  ADD PRIMARY KEY (`id_pokok_bahasan`),
  ADD KEY `fk_id_mom_pokok_bahasan` (`id_mom`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id_project`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daftar_peserta`
--
ALTER TABLE `daftar_peserta`
  MODIFY `id_daftar_peserta` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `detail_pokok_bahasan`
--
ALTER TABLE `detail_pokok_bahasan`
  MODIFY `id_detail_pokok_bahasan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id_gallery` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mom`
--
ALTER TABLE `mom`
  MODIFY `id_mom` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pokok_bahasan`
--
ALTER TABLE `pokok_bahasan`
  MODIFY `id_pokok_bahasan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id_project` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `daftar_peserta`
--
ALTER TABLE `daftar_peserta`
  ADD CONSTRAINT `fk_id_mom_daftar_peserta` FOREIGN KEY (`id_mom`) REFERENCES `mom` (`id_mom`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_pokok_bahasan`
--
ALTER TABLE `detail_pokok_bahasan`
  ADD CONSTRAINT `fk_id_pokok_bahasan` FOREIGN KEY (`id_pokok_bahasan`) REFERENCES `pokok_bahasan` (`id_pokok_bahasan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gallery`
--
ALTER TABLE `gallery`
  ADD CONSTRAINT `fk_id_mom_gallery` FOREIGN KEY (`id_mom`) REFERENCES `mom` (`id_mom`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mom`
--
ALTER TABLE `mom`
  ADD CONSTRAINT `fk_id_mom` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_project_mom` FOREIGN KEY (`id_project`) REFERENCES `project` (`id_project`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pokok_bahasan`
--
ALTER TABLE `pokok_bahasan`
  ADD CONSTRAINT `fk_id_mom_pokok_bahasan` FOREIGN KEY (`id_mom`) REFERENCES `mom` (`id_mom`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
