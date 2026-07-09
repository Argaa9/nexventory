-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Jul 2026 pada 14.57
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nexventory_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `borrowings`
--

CREATE TABLE `borrowings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `borrow_code` varchar(50) DEFAULT NULL,
  `borrower_name` varchar(255) NOT NULL,
  `division` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `borrow_date` date NOT NULL,
  `return_date` date NOT NULL,
  `status` enum('Dipinjam','Dikembalikan','Terlambat') DEFAULT 'Dipinjam',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `borrowing_details`
--

CREATE TABLE `borrowing_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `borrowing_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `qty` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Laptop', NULL, NULL, NULL),
(2, 'Printer', NULL, NULL, NULL),
(3, 'Networking', NULL, NULL, NULL),
(4, 'Monitor', NULL, NULL, NULL),
(5, 'Projector', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_code` varchar(50) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `stock` int(11) DEFAULT 0,
  `minimum_stock` int(11) DEFAULT 5,
  `location` varchar(255) NOT NULL,
  `item_condition` enum('Baik','Rusak Ringan','Rusak Berat','Dalam Perbaikan') DEFAULT 'Baik',
  `image` varchar(255) DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `purchase_price` decimal(15,2) DEFAULT NULL,
  `status` enum('Tersedia','Dipinjam','Maintenance','Rusak') DEFAULT 'Tersedia',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `category_id`, `product_code`, `product_name`, `description`, `stock`, `minimum_stock`, `location`, `item_condition`, `image`, `purchase_date`, `purchase_price`, `status`, `created_at`, `updated_at`) VALUES
(4, 1, 'LTP001', 'Lenovo ThinkPad E14', 'Laptop operasional staff IT', 15, 5, 'Ruang IT', 'Baik', 'products/KakrtlwyAjOMLma3Grd886Bx7G2gVoIaCnFJnAal.jpg', '2025-01-15', 12500000.00, 'Tersedia', '2026-07-08 08:01:11', '2026-07-08 01:06:40'),
(5, 1, 'LTP002', 'Dell Latitude 5430', 'Laptop operasional admin', 10, 5, 'Ruang Admin', 'Baik', 'products/t4BqcCCnMm6bJWk91xXCJcqJsHKAk3iKtN84gvdP.jpg', '2025-02-10', 13500000.00, 'Tersedia', '2026-07-08 08:01:11', '2026-07-08 01:06:52'),
(6, 1, 'LTP003', 'ASUS ExpertBook B1', 'Laptop untuk divisi HR', 8, 3, 'Ruang HR', 'Baik', 'products/rC5Wyeuu3yogXYzEwBVtv8BY3a0L8j1HPsOokOqX.jpg', '2025-03-12', 11000000.00, 'Tersedia', '2026-07-08 08:01:11', '2026-07-08 01:07:33'),
(7, 1, 'LTP004', 'HP ProBook 440', 'Laptop cadangan operasional', 5, 2, 'Gudang IT', 'Baik', 'products/9qv7hE2QMGp02XqRxH5tPCShwxnKO5pikdVO0L7B.jpg', '2025-04-08', 12000000.00, 'Tersedia', '2026-07-08 08:01:11', '2026-07-08 01:08:04'),
(8, 2, 'PRT001', 'Epson L3250', 'Printer warna multifungsi', 6, 2, 'Ruang Admin', 'Baik', 'products/1DynrvT0O0h3VjdvERIUvP5SnMtUEampcAqfJwYo.jpg', '2024-11-20', 3500000.00, 'Tersedia', '2026-07-08 08:01:11', '2026-07-08 01:08:34'),
(9, 2, 'PRT002', 'HP LaserJet Pro M404', 'Printer laser dokumen', 4, 1, 'Ruang Keuangan', 'Baik', 'products/DwMd5fvJEadfklMVme9Turm0jPHPMdhI2ycIHLUR.jpg', '2025-01-05', 4800000.00, 'Tersedia', '2026-07-08 08:01:11', '2026-07-08 01:09:29'),
(10, 2, 'PRT003', 'Canon PIXMA G3770', 'Printer operasional kantor', 3, 1, 'Ruang Operasional', 'Rusak Ringan', 'products/3WLMjgwSGuDpmKIofogPqGAakeWmxusQtNzGOSBi.jpg', '2024-09-10', 3200000.00, 'Maintenance', '2026-07-08 08:01:11', '2026-07-08 01:10:08'),
(11, 3, 'NET001', 'Cisco Switch 24 Port', 'Switch jaringan utama', 8, 2, 'Ruang Server', 'Baik', 'products/AWR1HoLFr8Kfxoz2RFxj5eQvaQzDiNjt2ELh5Vdr.jpg', '2024-08-15', 8500000.00, 'Tersedia', '2026-07-08 08:01:11', '2026-07-08 01:10:38'),
(12, 3, 'NET002', 'TP-Link Access Point EAP225', 'Access Point kantor', 12, 3, 'Ruang Server', 'Baik', 'products/zna6U3Z4TvRoxrAkniuyJ023Sk21oWmO8uOeXTEU.jpg', '2025-02-15', 2200000.00, 'Tersedia', '2026-07-08 08:01:11', '2026-07-08 01:12:06'),
(13, 3, 'NET003', 'Mikrotik RB4011', 'Router utama jaringan', 3, 1, 'Ruang Server', 'Rusak Berat', 'products/PgGUSvrPm7fRca3XHNnKI6OAQWrJWnT7OfBVoG8U.jpg', '2025-01-25', 4800000.00, 'Maintenance', '2026-07-08 08:01:11', '2026-07-08 01:12:44'),
(14, 3, 'NET004', 'Cisco Firewall ASA5506', 'Keamanan jaringan', 2, 1, 'Ruang Server', 'Baik', 'products/k8Zh41qoWQklGxh5Dl0VCBnJdRpY4xWyX4fIoVb1.jpg', '2024-12-12', 12500000.00, 'Tersedia', '2026-07-08 08:01:11', '2026-07-08 01:13:46'),
(15, 4, 'MON001', 'LG 24 Inch IPS', 'Monitor staff operasional', 20, 5, 'Gudang IT', 'Baik', 'products/g3mlqd4qkvxRhTSbOehDYHnwCT7vHVpUHHspJrSF.jpg', '2025-02-18', 2500000.00, 'Tersedia', '2026-07-08 08:01:11', '2026-07-08 01:14:21'),
(16, 4, 'MON002', 'Samsung 27 Inch Curved', 'Monitor manager', 6, 2, 'Ruang Manager', 'Dalam Perbaikan', 'products/plnPhssA2n4iu4pmRMj252t5BPHbDb7Gs7kvcldx.jpg', '2025-03-01', 4200000.00, 'Maintenance', '2026-07-08 08:01:11', '2026-07-08 01:18:58'),
(17, 4, 'MON003', 'Dell 24 Inch Professional', 'Monitor keuangan', 10, 3, 'Ruang Finance', 'Rusak Ringan', 'products/SxDN6WHCxXlHQF2ApLawql9TW05KZ4kUYfFbjUF0.jpg', '2024-10-05', 3100000.00, 'Maintenance', '2026-07-08 08:01:11', '2026-07-08 01:15:42'),
(18, 5, 'PRJ001', 'Epson EB-X06', 'Proyektor ruang meeting', 4, 1, 'Ruang Meeting', 'Baik', 'products/9hbyMufq3LfbUHNI2ncxXtayRvY7Q8UuSuD3moC9.jpg', '2024-07-20', 7500000.00, 'Tersedia', '2026-07-08 08:01:11', '2026-07-08 01:16:29'),
(19, 5, 'PRJ002', 'BenQ MX560', 'Proyektor presentasi', 3, 1, 'Ruang Meeting Besar', 'Baik', 'products/DXrsNbPWRRkq2UI41txDm8rnIrV3w6YOZ0rx0PqR.jpg', '2025-01-18', 8200000.00, 'Tersedia', '2026-07-08 08:01:11', '2026-07-08 01:17:23'),
(20, 5, 'PRJ003', 'ViewSonic PA503S', 'Proyektor cadangan', 2, 1, 'Gudang Inventaris', 'Dalam Perbaikan', 'products/mRuceSz5S8DCbVYLQ8ZFB28JkdtF9LXHi2WzSo25.jpg', '2024-09-15', 6800000.00, 'Maintenance', '2026-07-08 08:01:11', '2026-07-08 01:18:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('wv8bPSu81zidxkxmQhnm2h3yFLdqNIHv5WeY1dzJ', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiS1pWcFNpb2lZVU5yMDRBTUcwUjNwMTNMc2xURUJlRzh2aHRKdHBsViI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9oaXN0b3J5IjtzOjU6InJvdXRlIjtzOjc6Imhpc3RvcnkiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO30=', 1783501599);

-- --------------------------------------------------------

--
-- Struktur dari tabel `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `rating` int(11) DEFAULT 5,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `testimonials`
--

INSERT INTO `testimonials` (`id`, `user_id`, `message`, `rating`, `created_at`, `updated_at`) VALUES
(1, 5, 'baikkk', 3, '2026-07-07 23:13:18', '2026-07-07 23:13:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('admin','staff','manager') DEFAULT 'staff'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Admin', 'admin@nexventory.com', NULL, '$2y$12$8FmNC2JW9xcK6Ek.MYrA8.cvpy1ja5xlb0xKyXozKLGsqYMKgNWi6', NULL, '2026-07-07 08:02:06', '2026-07-07 01:38:32', 'admin'),
(2, 'Staff', 'staff@nexventory.com', NULL, '$2y$12$yQYvXfhz5GWilAcOCcTm0uhOED/Rk3JKAeU69DbFVMAutoVI/5jeG', NULL, '2026-07-07 01:47:01', '2026-07-07 01:47:01', 'staff'),
(3, 'Manager', 'manager@nexventory.com', NULL, '$2y$12$1MBGGTeKxtghQ6wXBUzFIetg.3P.MCSDM4RPdqe7A4bQswPxl.0iO', NULL, '2026-07-07 01:53:02', '2026-07-07 01:53:02', 'manager'),
(5, 'Ardo', 'ardo@nexventory.com', NULL, '$2y$12$08OxJGN1KRRKKdZTzBEafe.fF158rhpvU8RviFwGvQN26g.HVD9u6', NULL, '2026-07-07 03:38:10', '2026-07-07 03:38:43', 'staff');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `borrowings`
--
ALTER TABLE `borrowings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `borrow_code` (`borrow_code`);

--
-- Indeks untuk tabel `borrowing_details`
--
ALTER TABLE `borrowing_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `borrowing_id` (`borrowing_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_code` (`product_code`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `borrowings`
--
ALTER TABLE `borrowings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `borrowing_details`
--
ALTER TABLE `borrowing_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `borrowing_details`
--
ALTER TABLE `borrowing_details`
  ADD CONSTRAINT `borrowing_details_ibfk_1` FOREIGN KEY (`borrowing_id`) REFERENCES `borrowings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `borrowing_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
