-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2022 at 10:38 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wilker`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_10_15_054032_create_places_table', 1),
(6, '2022_10_16_090901_create_schedules_table', 1),
(7, '2022_10_19_033143_create_routes_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'auth-sanctum', '51d1a8c4ba6cb2447b65089190729ec884a3e51352f7e8ae38088cd669f84c39', '[\"*\"]', '2022-10-19 01:36:36', NULL, '2022-10-19 01:27:48', '2022-10-19 01:36:36'),
(2, 'App\\Models\\User', 3, 'auth-sanctum', 'f9789141398e56b6dca83285db01079cf8e15c893bd35ac78dce1ab66414a5ad', '[\"*\"]', '2022-10-19 01:36:16', NULL, '2022-10-19 01:27:51', '2022-10-19 01:36:16');

-- --------------------------------------------------------

--
-- Table structure for table `places`
--

CREATE TABLE `places` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` decimal(10,7) NOT NULL,
  `longitude` decimal(10,7) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `places`
--

INSERT INTO `places` (`id`, `name`, `latitude`, `longitude`, `image`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Malang', '-7.9666200', '112.6326290', 'placeImages/malang.png', 'Kota Malang, adalah sebuah kota di Provinsi Jawa Timur, Indonesia. Kota ini berada di dataran tinggi yang cukup sejuk, terletak 90 km sebelah selatan Kota Surabaya, dan wilayahnya dikelilingi oleh Kabupaten Malang.', '2022-10-19 01:27:37', '2022-10-19 01:27:37'),
(2, 'Blitar', '-8.0954630', '112.1609040', 'placeImages/blitar.png', 'Blitar disebut juga sebagai Kota Proklamator. Alasannya adalah karena di kota ini terdapat makam Proklamator Kemerdekaan sekaligus Presiden Pertama RI yaitu Soekarno. Makam Bung Karno berada di Jalan Ir Soekarno, Nomor 152, Bendogerit, Kecamatan Sananwetan, Kota Blitar, Jawa Timur.', '2022-10-19 01:27:37', '2022-10-19 01:27:37'),
(3, 'Lumajang', '-8.0943570', '113.1441570', 'placeImages/lumajang.png', 'Kabupaten Lumajang merupakan salah satu daerah yang berada di wilayah Provinsi Jawa Timur. Kabupaten ini terkenal dengan julukan \'Kota Pisang\', karena daerah ini merupakan penghasil berbagai jenis buah pisang yang enak', '2022-10-19 01:27:37', '2022-10-19 01:27:37');

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `schedule_id` bigint(20) UNSIGNED NOT NULL,
  `from_place_id` bigint(20) UNSIGNED NOT NULL,
  `to_place_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `object` enum('bus','train') COLLATE utf8mb4_unicode_ci NOT NULL,
  `line` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_place_id` bigint(20) UNSIGNED NOT NULL,
  `to_place_id` bigint(20) UNSIGNED NOT NULL,
  `departure_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `arrival_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `distance` int(11) NOT NULL,
  `speed` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `object`, `line`, `from_place_id`, `to_place_id`, `departure_time`, `arrival_time`, `distance`, `speed`, `created_at`, `updated_at`) VALUES
(1, 'bus', 'Jl. Tol Pandaan - Malang', 1, 3, '20:00:00', '01:00:00', 58, 12, '2022-10-19 01:27:37', '2022-10-19 01:27:37'),
(2, 'train', 'Jl. Nasional III', 3, 2, '21:00:00', '08:00:00', 108, 45, '2022-10-19 01:27:37', '2022-10-19 01:27:37'),
(3, 'bus', 'Jl. Semeru', 3, 2, '12:00:00', '17:30:00', 108, 45, '2022-10-19 01:27:37', '2022-10-19 01:27:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$oCBJkp7X149wUfjK8H1igebpPzRfYKOZ6lzrvJ5ltDMgp0envPhbC', 'admin', NULL, '2022-10-19 01:27:37', '2022-10-19 01:27:37'),
(2, 'user1', '$2y$10$4PeJ2faimC6HxmKN.GGbku.WVt/J3dJUWpLZZM6wEQuFErbQ6Fa4S', 'user', NULL, '2022-10-19 01:27:37', '2022-10-19 01:27:37'),
(3, 'user2', '$2y$10$WITXDE2HC2.KCSewBBE1cOdd.R9bKdCvNXE3nLzXkY..WilOJ3CcK', 'user', NULL, '2022-10-19 01:27:37', '2022-10-19 01:27:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `places`
--
ALTER TABLE `places`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `routes_from_place_id_foreign` (`from_place_id`),
  ADD KEY `routes_to_place_id_foreign` (`to_place_id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `schedules_from_place_id_foreign` (`from_place_id`),
  ADD KEY `schedules_to_place_id_foreign` (`to_place_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `places`
--
ALTER TABLE `places`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `routes`
--
ALTER TABLE `routes`
  ADD CONSTRAINT `routes_from_place_id_foreign` FOREIGN KEY (`from_place_id`) REFERENCES `places` (`id`),
  ADD CONSTRAINT `routes_to_place_id_foreign` FOREIGN KEY (`to_place_id`) REFERENCES `places` (`id`);

--
-- Constraints for table `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `schedules_from_place_id_foreign` FOREIGN KEY (`from_place_id`) REFERENCES `places` (`id`),
  ADD CONSTRAINT `schedules_to_place_id_foreign` FOREIGN KEY (`to_place_id`) REFERENCES `places` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
