-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:8111
-- Waktu pembuatan: 16 Mar 2025 pada 14.06
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
-- Database: 'wejeatrans_base`
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
(13, 'Innova Reborn', 'Toyota', 2015, 'matic', 'ff2177c68a4ad22c778330e8d8085d31d1888e0603b1ef70e5a31b0084e3257b.png', 700000.00, 'tersedia', '2024-11-27 06:42:22'),
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
(1, 'ORD67d655221e6e5', 800000.00, 'failed', '1742099782_67d65546f2ec7.jpg', 'active', '2025-03-16 04:36:22', '2025-03-16 04:36:29'),
(2, 'ORD67d6556990c28', 900000.00, 'paid', '1742099828_67d655747f7e5.jpg', 'completed', '2025-03-16 04:37:08', '2025-03-16 05:07:05'),
(3, 'ORD67d65ac3789fa', 350000.00, 'paid', '1742101211_67d65adb21534.png', 'completed', '2025-03-16 05:00:11', '2025-03-16 05:07:00');

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
(1, 2, 10, 'ORD67d655221e6e5', '2025-03-16', '2025-03-17', 1, 800000.00, 'failed', '2025-03-16 04:35:46', '2025-03-16 04:36:29'),
(2, 2, 11, 'ORD67d6556990c28', '2025-03-16', '2025-03-18', 2, 900000.00, 'paid', '2025-03-16 04:36:57', '2025-03-16 05:01:32'),
(3, 4, 12, 'ORD67d65ac3789fa', '2025-03-16', '2025-03-17', 1, 350000.00, 'paid', '2025-03-16 04:59:47', '2025-03-16 05:01:23');

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
(1, 'wejeatrans', '089609317309', 'wejeatrans@gmail.com', 'karawang', '$2y$10$jJyYblb2kmdWRpL.UKM5R.dNCk7SPjdQfvRqlNRKzuFJEi47pSLly', 'aktif', 'admin', '2025-03-16 04:27:39', NULL, NULL),
(2, 'Haerul Yuda Aditiya', '08816147969', 'haerulyudaaditiya@gmail.com', 'karawang', '$2y$10$S7byVcoHcoyjeddNxrA7yes2tJjyj849aKnA/4nMWMmhj5x0LnyGG', 'aktif', 'user', '2025-03-16 04:35:04', NULL, NULL),
(4, 'Haerul', '088161479691', 'if23.haeruladitiya@mhs.ubpkarawang.ac.id', 'karawang', '$2y$10$fx5o91isQinwKStKMB4MN.N8QhvlOTkx15JX7SznsHMTnva5LutLa', 'aktif', 'user', '2025-03-16 04:58:14', NULL, NULL);

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
  MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `rentals`
--
ALTER TABLE `rentals`
  MODIFY `rental_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
