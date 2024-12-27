-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:8111
-- Waktu pembuatan: 26 Des 2024 pada 20.02
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `final_project`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cars`
--

CREATE TABLE `cars` (
  `car_id` int(11) NOT NULL,
  `model` varchar(100) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `year` int(11) NOT NULL,
  `transmission` enum('manual','matic') NOT NULL,
  `image` varchar(255) NOT NULL,
  `price_24_hours` decimal(10,2) NOT NULL,
  `status` enum('tersedia','dipesan','dalam_perawatan') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `cars`
--

INSERT INTO `cars` (`car_id`, `model`, `brand`, `year`, `transmission`, `image`, `price_24_hours`, `status`, `created_at`) VALUES
(10, 'Fortuner', 'Toyota', 2015, 'manual', 'car_6746c1b9386ce2.61492360.png', 800000.00, 'tersedia', '2024-11-26 15:37:19'),
(11, 'Avanza', 'Toyota', 2019, 'manual', 'car_6746bf7e515d72.47992962.png', 450000.00, 'tersedia', '2024-11-26 15:45:26'),
(12, 'Avanza', 'Toyota', 2016, 'manual', 'car_6746bf73130de4.19013060.png', 350000.00, 'tersedia', '2024-11-27 06:30:25'),
(13, 'Innova Reborn', 'Toyota', 2015, 'matic', 'ff2177c68a4ad22c778330e8d8085d31d1888e0603b1ef70e5a31b0084e3257b.png', 700000.00, 'dipesan', '2024-11-27 06:42:22'),
(14, 'Avanza', 'Toyota', 2024, 'manual', 'fb724df829fed3291c1cd99c8c2a13dbf230ad4f4f07beda8d4b4612e79d9747.png', 600000.00, 'tersedia', '2024-11-27 07:18:22'),
(15, 'Innova', 'Toyota', 2013, 'matic', '7db60a9bfed4c60dc9223bb65869f730b399b7021a11cfeb41c142e676990a44.png', 500000.00, 'tersedia', '2024-11-27 07:20:04'),
(16, 'Luxio', 'Daihatsu', 2024, 'manual', '2c6c7b306e4d9d28653d953b17fd0078c8960a89a8785868f40995f26934a292.png', 500000.00, 'tersedia', '2024-11-27 07:23:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `order_id` varchar(50) NOT NULL,
  `gross_amount` decimal(15,2) NOT NULL,
  `payment_status` enum('verification','paid','failed') NOT NULL DEFAULT 'verification',
  `receipt_image` varchar(255) NOT NULL,
  `rental_status` enum('active','completed','cancelled') NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `payments`
--

INSERT INTO `payments` (`payment_id`, `order_id`, `gross_amount`, `payment_status`, `receipt_image`, `rental_status`, `created_at`, `updated_at`) VALUES
(87, 'R6768d9f1e2c75', 900000.00, 'paid', '', 'completed', '2024-12-23 03:35:04', '2024-12-26 08:31:06'),
(122, 'ORD676bc74f84d66', 600000.00, 'paid', '1735116636_676bc75c531cb.jpg', 'completed', '2024-12-25 08:50:36', '2024-12-26 18:46:16'),
(124, 'ORD676bd104e557a', 800000.00, 'paid', '1735119119_676bd10fdf211.jpg', 'completed', '2024-12-25 09:31:59', '2024-12-26 10:06:02'),
(125, 'ORD676c149d5a600', 700000.00, 'paid', '1735136465_676c14d1eabeb.png', 'completed', '2024-12-25 14:21:06', '2024-12-26 08:49:43'),
(126, 'ORD676d1b9a061fa', 350000.00, 'failed', '1735203785_676d1bc920901.jpg', 'cancelled', '2024-12-26 09:03:05', '2024-12-26 09:22:04'),
(127, 'ORD676d1cd9bbdb0', 450000.00, 'failed', '1735204070_676d1ce64ade2.jpg', 'cancelled', '2024-12-26 09:07:50', '2024-12-26 09:15:23'),
(128, 'ORD676d1f60856ff', 450000.00, 'paid', '1735204715_676d1f6bddfa7.jpg', 'completed', '2024-12-26 09:18:35', '2024-12-26 09:52:46'),
(129, 'ORD676d29afba6da', 450000.00, 'verification', '1735207357_676d29bde5aa6.jpg', 'active', '2024-12-26 10:02:38', '2024-12-26 10:02:38'),
(130, 'ORD676d29d09231d', 500000.00, 'verification', '1735207385_676d29d91f78b.jpg', 'active', '2024-12-26 10:03:05', '2024-12-26 10:03:05'),
(131, 'ORD676d29e831f92', 700000.00, 'paid', '1735207410_676d29f207377.jpg', 'active', '2024-12-26 10:03:30', '2024-12-26 10:04:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rentals`
--

CREATE TABLE `rentals` (
  `rental_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `order_id` varchar(50) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `duration` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `payment_status` enum('pending','verification','paid','failed') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `rentals`
--

INSERT INTO `rentals` (`rental_id`, `user_id`, `car_id`, `order_id`, `start_date`, `end_date`, `duration`, `total_price`, `payment_status`, `created_at`, `updated_at`) VALUES
(157, 81, 11, 'R6768d9f1e2c75', '2024-12-23', '2024-12-25', 2, 900000.00, 'paid', '2024-12-23 03:33:08', '2024-12-25 09:40:36'),
(185, 81, 14, 'ORD676bc74f84d66', '2024-12-25', '2024-12-26', 1, 600000.00, 'paid', '2024-12-25 08:50:23', '2024-12-26 07:13:59'),
(187, 81, 10, 'ORD676bd104e557a', '2024-12-25', '2024-12-26', 1, 800000.00, 'paid', '2024-12-25 09:31:48', '2024-12-25 09:38:18'),
(188, 81, 13, 'ORD676c149d5a600', '2024-12-25', '2024-12-26', 1, 700000.00, 'paid', '2024-12-25 14:20:13', '2024-12-25 14:22:49'),
(189, 81, 12, 'ORD676c3bc430164', '2024-12-26', '2024-12-27', 1, 350000.00, 'failed', '2024-12-25 17:07:16', '2024-12-25 17:07:57'),
(190, 81, 12, 'ORD676c3c0f04d4e', '2024-12-26', '2024-12-27', 1, 350000.00, 'pending', '2024-12-25 17:08:31', '2024-12-25 17:08:31'),
(191, 81, 12, 'ORD676c3daa04d8f', '2024-12-26', '2024-12-27', 1, 350000.00, 'pending', '2024-12-25 17:15:22', '2024-12-25 17:15:22'),
(192, 81, 12, 'ORD676d1b9a061fa', '2024-12-26', '2024-12-27', 1, 350000.00, 'failed', '2024-12-26 09:02:18', '2024-12-26 09:06:19'),
(193, 81, 11, 'ORD676d1cd9bbdb0', '2024-12-26', '2024-12-27', 1, 450000.00, 'failed', '2024-12-26 09:07:37', '2024-12-26 09:15:23'),
(194, 81, 11, 'ORD676d1f60856ff', '2024-12-26', '2024-12-27', 1, 450000.00, 'paid', '2024-12-26 09:18:24', '2024-12-26 09:22:34'),
(195, 81, 11, 'ORD676d29afba6da', '2024-12-26', '2024-12-27', 1, 450000.00, 'verification', '2024-12-26 10:02:23', '2024-12-26 10:02:38'),
(196, 81, 15, 'ORD676d29d09231d', '2024-12-26', '2024-12-27', 1, 500000.00, 'verification', '2024-12-26 10:02:56', '2024-12-26 10:03:05'),
(197, 81, 13, 'ORD676d29e831f92', '2024-12-26', '2024-12-27', 1, 700000.00, 'paid', '2024-12-26 10:03:20', '2024-12-26 10:04:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('aktif','nonaktif') NOT NULL DEFAULT 'aktif',
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `reset_token` varchar(64) DEFAULT NULL,
  `reset_token_expire` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `fullname`, `phone`, `email`, `address`, `password`, `status`, `role`, `created_at`, `reset_token`, `reset_token_expire`) VALUES
(1, 'Haerul Yuda Aditiya', '08816147969', 'haerulyudaaditiya@gmail.com', 'Dusun Jenebin, Desa Purwadana, Kec. Telukjambe Timur', '$2y$10$hskOEws3NislOVOcVohxp.oYWGoNgdwNolrDMN2mIbHvNnQQweXiK', 'aktif', 'user', '2024-11-18 17:49:43', '177dca55bf68c6dd8759637ac3491a1426e4c1760c1e18e43342a6fe03a779f3', '2024-12-18 00:32:33'),
(25, 'Admin', '08123456789', 'admin@gmail.com', 'Karawang', '$2y$10$sCHaJ3Huevlh65KCGAZJ8u5wOpHIqUob4ckg4qPigvUA92Z0f3YBi', 'aktif', 'admin', '2024-11-25 06:05:17', NULL, NULL),
(72, 'Robert Wilson', '081234567896', 'robert.wilson@example.com', 'Jl. Mawar No. 70', '$2y$10$zJwrNqqR0sHrBWzDFZGAeO7kbgQ.plXp0GXU6Xz5bnq1oP5gQ1q5C', 'aktif', 'user', '2024-11-26 07:07:20', NULL, NULL),
(73, 'Linda Moore', '081234567897', 'linda.moore@example.com', 'Jl. Taman No. 80', '$2y$10$zJwrNqqR0sHrBWzDFZGAeO7kbgQ.plXp0GXU6Xz5bnq1oP5gQ1q5C', 'nonaktif', 'user', '2024-11-26 07:07:20', NULL, NULL),
(74, 'William Harris', '081234567898', 'william.harris@example.com', 'Jl. Merpati No. 90', '$2y$10$zJwrNqqR0sHrBWzDFZGAeO7kbgQ.plXp0GXU6Xz5bnq1oP5gQ1q5C', 'aktif', 'user', '2024-11-26 07:07:20', NULL, NULL),
(75, 'Elizabeth Clark', '081234567899', 'elizabeth.clark@example.com', 'Jl. Melati No. 100', '$2y$10$zJwrNqqR0sHrBWzDFZGAeO7kbgQ.plXp0GXU6Xz5bnq1oP5gQ1q5C', 'aktif', 'user', '2024-11-26 07:07:20', NULL, NULL),
(76, 'David Lewis', '081234567900', 'david.lewis@example.com', 'Jl. Pahlawan No. 110', '$2y$10$zJwrNqqR0sHrBWzDFZGAeO7kbgQ.plXp0GXU6Xz5bnq1oP5gQ1q5C', 'aktif', 'user', '2024-11-26 07:07:20', NULL, NULL),
(81, 'Haerul Yuda', '088161479690', 'if23.haeruladitiya@mhs.ubpkarawang.ac.id', 'Karawang', '$2y$10$xY2QtmKbalwvRCWaFmhH5.HGMJffnwdU32Td/OSOc0/YPL7pqoRE6', 'aktif', 'user', '2024-12-03 15:53:28', '908c657dfa95b2280ff7e12ab38661157b3c866dbe5c6adee10a541a1c7a41d0', '2024-12-23 22:07:07'),
(82, 'Rendy Suwandi', '08221349788', 'rendysuwandi66@gmail.com', 'Karawang', '$2y$10$bF38KJVADg1WLPpvTeetnuO9L332KKhJHfi0yxnVDbgpdXh3kpDcK', 'aktif', 'user', '2024-12-04 03:22:11', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`car_id`);

--
-- Indeks untuk tabel `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `order_id` (`order_id`) USING BTREE;

--
-- Indeks untuk tabel `rentals`
--
ALTER TABLE `rentals`
  ADD PRIMARY KEY (`rental_id`),
  ADD UNIQUE KEY `order_id` (`order_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `car_id` (`car_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_phone` (`phone`),
  ADD UNIQUE KEY `unique_email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cars`
--
ALTER TABLE `cars`
  MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT untuk tabel `rentals`
--
ALTER TABLE `rentals`
  MODIFY `rental_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `order_id` FOREIGN KEY (`order_id`) REFERENCES `rentals` (`order_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `rentals`
--
ALTER TABLE `rentals`
  ADD CONSTRAINT `rentals_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rentals_ibfk_2` FOREIGN KEY (`car_id`) REFERENCES `cars` (`car_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
