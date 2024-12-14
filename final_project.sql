-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:8111
-- Waktu pembuatan: 14 Des 2024 pada 05.04
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
(11, 'Avanza', 'Toyota', 2019, 'manual', 'car_6746bf7e515d72.47992962.png', 450000.00, 'dipesan', '2024-11-26 15:45:26'),
(12, 'Avanza', 'Toyota', 2016, 'manual', 'car_6746bf73130de4.19013060.png', 350000.00, 'dipesan', '2024-11-27 06:30:25'),
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
  `transaction_id` varchar(100) NOT NULL,
  `payment_type` varchar(50) NOT NULL,
  `gross_amount` decimal(15,2) NOT NULL,
  `payment_status` enum('pending','paid','failed') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `payments`
--

INSERT INTO `payments` (`payment_id`, `order_id`, `transaction_id`, `payment_type`, `gross_amount`, `payment_status`, `created_at`, `updated_at`) VALUES
(51, 'R675475c4d63f3', '0585babd-a8c6-422a-a6ba-5c905d970c8b', 'bank_transfer', 350000.00, 'paid', '2024-12-07 16:20:38', '2024-12-07 16:20:38'),
(54, 'R67571a1df346a', '51a9fa6a-b53c-49bc-af1d-41c3411b0680', 'bank_transfer', 450000.00, 'paid', '2024-12-09 16:26:47', '2024-12-09 16:26:47'),
(81, 'R675c73d22d888', '17ccb9cb-148c-4097-b0bc-077c34d4e4b4', 'bank_transfer', 350000.00, 'paid', '2024-12-13 17:50:30', '2024-12-13 17:50:30'),
(82, 'R675c73fbb549b', 'b3fde036-0920-411e-b707-3c4450991b34', 'bank_transfer', 450000.00, 'paid', '2024-12-13 17:51:13', '2024-12-13 17:51:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `payment_links`
--

CREATE TABLE `payment_links` (
  `link_id` int(11) NOT NULL,
  `rental_id` int(11) NOT NULL,
  `payment_url` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `payment_links`
--

INSERT INTO `payment_links` (`link_id`, `rental_id`, `payment_url`, `created_at`) VALUES
(47, 112, 'https://app.sandbox.midtrans.com/snap/v4/redirection/e09f4ab5-9485-4b5c-9bdb-a3d945d36fe1', '2024-12-07 16:19:39'),
(48, 113, 'https://app.sandbox.midtrans.com/snap/v4/redirection/5d95d559-1ff0-4060-9ed5-388ef16efc54', '2024-12-07 16:19:58'),
(49, 114, 'https://app.sandbox.midtrans.com/snap/v4/redirection/cbbc7bff-de5a-4643-9cc8-4aee528a9207', '2024-12-07 16:20:22'),
(50, 115, 'https://app.sandbox.midtrans.com/snap/v4/redirection/4f3f0a43-4139-4d5b-ac90-ca1396ef005a', '2024-12-07 19:39:21'),
(51, 116, 'https://app.sandbox.midtrans.com/snap/v4/redirection/f3857ac6-36ef-4ec8-abc8-56e898734345', '2024-12-07 19:39:46'),
(53, 118, 'https://app.sandbox.midtrans.com/snap/v4/redirection/58162894-61e3-400b-aea4-17613309173e', '2024-12-08 03:40:56'),
(54, 119, 'https://app.sandbox.midtrans.com/snap/v4/redirection/6ed543ff-0c12-4fc0-bee4-9377806aa6e4', '2024-12-08 03:57:56'),
(58, 123, 'https://app.sandbox.midtrans.com/snap/v4/redirection/11cad378-f3f8-4570-98f2-0225233d0f03', '2024-12-09 16:26:08'),
(64, 149, 'https://app.sandbox.midtrans.com/snap/v4/redirection/326c1a45-46a7-455b-bfa3-d8d67a99902a', '2024-12-13 17:50:12'),
(65, 150, 'https://app.sandbox.midtrans.com/snap/v4/redirection/ff4e67df-f6d5-46c0-9f5c-2a61cabef5b6', '2024-12-13 17:50:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rentals`
--

CREATE TABLE `rentals` (
  `rental_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `duration` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `payment_status` enum('not_chosen','pending','paid','failed') DEFAULT NULL,
  `order_id` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `rentals`
--

INSERT INTO `rentals` (`rental_id`, `user_id`, `car_id`, `start_date`, `end_date`, `duration`, `total_price`, `payment_status`, `order_id`, `created_at`, `updated_at`) VALUES
(112, 81, 11, '2024-12-07', '2024-12-08', 1, 450000.00, 'not_chosen', 'R675475994b516', '2024-12-07 16:19:39', '2024-12-07 16:19:39'),
(113, 81, 11, '2024-12-07', '2024-12-09', 2, 900000.00, 'failed', 'R675475ac44062', '2024-12-07 16:19:58', '2024-12-07 16:22:05'),
(114, 81, 12, '2024-12-07', '2024-12-08', 1, 350000.00, 'paid', 'R675475c4d63f3', '2024-12-07 16:20:22', '2024-12-07 16:20:38'),
(115, 81, 11, '2024-12-08', '2024-12-09', 1, 450000.00, 'not_chosen', 'R6754a465207b8', '2024-12-07 19:39:21', '2024-12-07 19:39:21'),
(116, 81, 11, '2024-12-08', '2024-12-09', 1, 450000.00, 'failed', 'R6754a4807a107', '2024-12-07 19:39:46', '2024-12-07 19:55:56'),
(118, 81, 11, '2024-12-08', '2024-12-09', 1, 450000.00, 'failed', 'R67551545b1d1d', '2024-12-08 03:40:56', '2024-12-08 03:57:13'),
(119, 81, 11, '2024-12-08', '2024-12-09', 1, 450000.00, 'failed', 'R675519419be85', '2024-12-08 03:57:56', '2024-12-08 04:14:05'),
(123, 1, 11, '2024-12-10', '2024-12-11', 1, 450000.00, 'paid', 'R67571a1df346a', '2024-12-09 16:26:08', '2024-12-09 16:26:47'),
(149, 81, 12, '2024-12-14', '2024-12-15', 1, 350000.00, 'paid', 'R675c73d22d888', '2024-12-13 17:50:12', '2024-12-13 17:50:30'),
(150, 81, 11, '2024-12-15', '2024-12-16', 1, 450000.00, 'paid', 'R675c73fbb549b', '2024-12-13 17:50:53', '2024-12-13 17:51:13');

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
(1, 'Haerul Yuda Aditiya', '08816147969', 'haerulyudaaditiya@gmail.com', 'Dusun Jenebin, Desa Purwadana, Kec. Telukjambe Timur', '$2y$10$hskOEws3NislOVOcVohxp.oYWGoNgdwNolrDMN2mIbHvNnQQweXiK', 'aktif', 'user', '2024-11-18 17:49:43', 'c43a2988db5de0bec003bd7899d05f2da1d79743781de34893bdfbce0ffe9824', '2024-12-01 02:19:06'),
(25, 'Admin', '08123456789', 'admin@gmail.com', 'Karawang', '$2y$10$sCHaJ3Huevlh65KCGAZJ8u5wOpHIqUob4ckg4qPigvUA92Z0f3YBi', 'aktif', 'admin', '2024-11-25 06:05:17', NULL, NULL),
(72, 'Robert Wilson', '081234567896', 'robert.wilson@example.com', 'Jl. Mawar No. 70', '$2y$10$zJwrNqqR0sHrBWzDFZGAeO7kbgQ.plXp0GXU6Xz5bnq1oP5gQ1q5C', 'nonaktif', 'user', '2024-11-26 07:07:20', NULL, NULL),
(73, 'Linda Moore', '081234567897', 'linda.moore@example.com', 'Jl. Taman No. 80', '$2y$10$zJwrNqqR0sHrBWzDFZGAeO7kbgQ.plXp0GXU6Xz5bnq1oP5gQ1q5C', 'nonaktif', 'user', '2024-11-26 07:07:20', NULL, NULL),
(74, 'William Harris', '081234567898', 'william.harris@example.com', 'Jl. Merpati No. 90', '$2y$10$zJwrNqqR0sHrBWzDFZGAeO7kbgQ.plXp0GXU6Xz5bnq1oP5gQ1q5C', 'aktif', 'user', '2024-11-26 07:07:20', NULL, NULL),
(75, 'Elizabeth Clark', '081234567899', 'elizabeth.clark@example.com', 'Jl. Melati No. 100', '$2y$10$zJwrNqqR0sHrBWzDFZGAeO7kbgQ.plXp0GXU6Xz5bnq1oP5gQ1q5C', 'aktif', 'user', '2024-11-26 07:07:20', NULL, NULL),
(76, 'David Lewis', '081234567900', 'david.lewis@example.com', 'Jl. Pahlawan No. 110', '$2y$10$zJwrNqqR0sHrBWzDFZGAeO7kbgQ.plXp0GXU6Xz5bnq1oP5gQ1q5C', 'aktif', 'user', '2024-11-26 07:07:20', NULL, NULL),
(81, 'Haerul Yuda Aditiya', '088161479690', 'if23.haeruladitiya@mhs.ubpkarawang.ac.id', 'Karawang', '$2y$10$Xq8.DUqZnkUEcpoe/.ndD.pDShEhzsvK5Au9Dp/yqGLA1LJlkjCCm', 'aktif', 'user', '2024-12-03 15:53:28', 'a51f169f0eda1acb8fc312200fa666ac97a1e41bca2a680d5d2023b310bdca83', '2024-12-05 14:57:47'),
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
-- Indeks untuk tabel `payment_links`
--
ALTER TABLE `payment_links`
  ADD PRIMARY KEY (`link_id`),
  ADD KEY `rental_id` (`rental_id`);

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
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT untuk tabel `payment_links`
--
ALTER TABLE `payment_links`
  MODIFY `link_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT untuk tabel `rentals`
--
ALTER TABLE `rentals`
  MODIFY `rental_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `order_id` FOREIGN KEY (`order_id`) REFERENCES `rentals` (`order_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `payment_links`
--
ALTER TABLE `payment_links`
  ADD CONSTRAINT `payment_links_ibfk_1` FOREIGN KEY (`rental_id`) REFERENCES `rentals` (`rental_id`) ON DELETE CASCADE;

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
