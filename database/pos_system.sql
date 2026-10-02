-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2026 at 06:28 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `full_name`, `email`, `phone`, `created_at`) VALUES
(1, 'Ada Mesmer', 'psychiatrist@gmail.com', '0917-123-4567', '2026-09-21 19:14:57'),
(2, 'Frederick Kreiburg', 'composer@gmail.com', '0918-234-5678', '2026-09-21 19:14:57'),
(3, 'Richard Sterling', 'knight@gmail.com', '0919-345-6789', '2026-09-21 19:14:57'),
(4, 'Evelyn Mora', 'farolady@gmail.com', '0920-456-7890', '2026-09-21 19:14:57'),
(5, 'Emil Mesmer', 'patient@gmail.com', '0921-567-8901', '2026-09-21 19:14:57'),
(6, 'Lars Alexandersson', 'dorya@hotmail.com', '0995-123-1245', '2026-10-02 07:22:11'),
(7, 'Tracy Reznik', 'mechanic@gmail.com', '0956-129-0054', '2026-10-02 12:28:34');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2026-10-02-140000', 'App\\Database\\Migrations\\AddPasswordToUsers', 'default', 'App', 1790958108, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `full_name`, `created_at`, `avatar`, `password`) VALUES
(1, 'admin01', 'Gabriel Saulo', '2026-09-21 19:18:04', NULL, '$2y$10$GHzLWb/jQVja3umiqyLOiu0zhO1opPZR2ySxWvvJXadua2mVvb6ey'),
(2, 'cashier01', 'Gigi Murin', '2026-09-21 19:18:04', '1790943721_a3217205ebc2e676c2c0.jpg', '$2y$10$INkfOOgyTEYx.CVV5EeibeUXUMvTK8Cs28PGaup.ich6y0qyQURpm'),
(3, 'staff01', 'Cecilia Immergreen', '2026-09-21 19:18:04', '1790943958_797ee35e5afcbb56a2ac.png', '$2y$10$KOUzC2GvEAaXqhma2kqxmunn3d4HgbW/yRJtUTkLu30SYynFgHjgW'),
(4, 'cashier02', 'Raora Panthera', '2026-09-21 19:18:04', '1790943989_c9cde63d45d86dd0a47c.png', '$2y$10$ix7dNySfRypg6CES8h6r3uXFkScY93rl.FJIjS3fEf18aw5NHUixC'),
(5, 'manager01', 'Elizabeth Rose Bloodflame', '2026-09-21 19:18:04', '1790944017_3bf8099f86f975bd4718.png', '$2y$10$XiDsXMn8GXE535zXRV//xezjMs9NkqVQkMAMmEQdFWdBbUCDpMLhC'),
(6, 'Co-Manager', 'Nerissa Ravencroft', '2026-10-02 07:58:04', '1790943885_8fa7d35714e17f5841d5.jpg', '$2y$10$/0Mno4TDw.t65nh4NXvk1eWaCMgjkwhsSRSvKjWftpRr6/Qq75.FC');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
