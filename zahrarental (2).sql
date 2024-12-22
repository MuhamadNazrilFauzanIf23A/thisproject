-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 22, 2024 at 06:28 AM
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
-- Database: `zahrarental`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `email_or_phone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `role` enum('admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email_or_phone`, `password`, `created_at`, `role`) VALUES
(1, 'admin15@gmail.com', '$2y$10$d1mF/OmqdVH6x/E9TypCEuizImP7HQFYhVxE.v.M5uQ2ZPPko28sK', '2024-12-06 17:56:34', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `detail_mobil`
--

CREATE TABLE `detail_mobil` (
  `id` int NOT NULL,
  `id_mobil` int DEFAULT NULL,
  `deskripsi` text,
  `spesifikasi` text,
  `stok` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `detail_mobil`
--

INSERT INTO `detail_mobil` (`id`, `id_mobil`, `deskripsi`, `spesifikasi`, `stok`) VALUES
(2, 1, 'Mobil Kuat, cocok untuk penggunaan tahunan', 'Manual, Bensin, Kapasitas 2 orang', 1),
(3, 2, 'Mobil menengah, cocok untuk penggunaan harian', 'Manual, Bensin, Kapasitas 2 orang', 1),
(5, 7, 'siap menjelajah', '8 orang', 1),
(6, 5, 'cepat seperti cheetah 12', '2 orang', 1),
(7, 8, 'seperti mobil balap', '2 orang saja', 1);

-- --------------------------------------------------------

--
-- Table structure for table `list_mobil`
--

CREATE TABLE `list_mobil` (
  `id` int NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tipe` varchar(50) NOT NULL,
  `harga` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `harga_per6jam` int DEFAULT '0',
  `harga_per12jam` int DEFAULT '0',
  `harga_per24jam` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `list_mobil`
--

INSERT INTO `list_mobil` (`id`, `nama`, `tipe`, `harga`, `gambar`, `harga_per6jam`, `harga_per12jam`, `harga_per24jam`) VALUES
(1, 'Toyota Avanza', 'Premium', '350000', 'Avanza.jpeg', 350000, 500000, 1000000),
(2, 'Daihatsu Ayla', 'Biasa', '250000', 'Ayla.jpeg', 250000, 400000, 1000000),
(5, 'Tesla Model 3', 'Biasa', '1200000', 'Tesla.jpeg', 0, 0, 0),
(7, 'Fortuner', 'Premium', '200000', 'fortuner.jpg', 200000, 350000, 900000),
(8, 'Sedan', 'Biasa', '300000', 'sedan.jpg', 300000, 550000, 120000);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `verification_code` varchar(6) NOT NULL,
  `expires_at` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`id`, `user_id`, `verification_code`, `expires_at`, `created_at`) VALUES
(12, 7, '102450', '2024-12-19 14:51:11', '2024-12-19 07:41:11');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `id_mobil` int NOT NULL,
  `tanggal_pemesanan` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `masa_sewa` int NOT NULL,
  `paket_sewa` varchar(50) NOT NULL,
  `harga` int NOT NULL,
  `sopir` enum('iya','tidak') DEFAULT 'tidak',
  `file_unggahan` varchar(255) NOT NULL,
  `status` enum('pending','disetujui','selesai') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id`, `user_id`, `id_mobil`, `tanggal_pemesanan`, `tanggal_mulai`, `tanggal_selesai`, `masa_sewa`, `paket_sewa`, `harga`, `sopir`, `file_unggahan`, `status`) VALUES
(3, 7, 2, '2024-12-22 06:24:28', '2024-12-22', '2024-12-25', 3, '12', 1200000, 'tidak', '23416255201055.pdf', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `profil`
--

CREATE TABLE `profil` (
  `id` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sopir`
--

CREATE TABLE `sopir` (
  `id` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kontak` varchar(15) DEFAULT NULL,
  `harga_perhari` decimal(10,2) NOT NULL,
  `status` enum('tersedia','tidak tersedia') DEFAULT 'tersedia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sopir`
--

INSERT INTO `sopir` (`id`, `nama`, `kontak`, `harga_perhari`, `status`) VALUES
(1, 'Raka', '08123456789', '150000.00', 'tersedia'),
(2, 'Rizky', '08198765432', '150000.00', 'tersedia'),
(3, 'nazril', '08134567890', '150000.00', 'tidak tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `email_or_phone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `role` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email_or_phone`, `password`, `created_at`, `role`) VALUES
(7, 'ghianpratama646@gmail.com', '$2y$10$bQ7By8KovKF7qrfFOs25Fuxs4d0L/Tia8R.64ODfsWQk8PxJqd.SC', '2024-12-11 11:04:49', 'user'),
(9, '081287819067', '$2y$10$fATHV8PjDVt9o0W.48jA/ua1.E1uux2/BPYZMR/ETtYOtgqz/dYJq', '2024-12-14 04:29:16', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_mobil`
--
ALTER TABLE `detail_mobil`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_mobil` (`id_mobil`);

--
-- Indexes for table `list_mobil`
--
ALTER TABLE `list_mobil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `id_mobil` (`id_mobil`);

--
-- Indexes for table `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sopir`
--
ALTER TABLE `sopir`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `detail_mobil`
--
ALTER TABLE `detail_mobil`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `list_mobil`
--
ALTER TABLE `list_mobil`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `profil`
--
ALTER TABLE `profil`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sopir`
--
ALTER TABLE `sopir`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_mobil`
--
ALTER TABLE `detail_mobil`
  ADD CONSTRAINT `detail_mobil_ibfk_1` FOREIGN KEY (`id_mobil`) REFERENCES `list_mobil` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD CONSTRAINT `password_resets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `pemesanan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `pemesanan_ibfk_2` FOREIGN KEY (`id_mobil`) REFERENCES `list_mobil` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
