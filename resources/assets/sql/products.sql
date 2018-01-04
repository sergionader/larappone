-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 01, 2017 at 07:34 PM
-- Server version: 5.7.17
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `productvisit`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Bolle', '2017-10-07 09:30:00', NULL),
(2, 'Bulgari', '2017-10-07 09:30:00', NULL),
(3, 'Carrera', '2017-10-07 09:30:00', NULL),
(4, 'Case', '2017-10-07 09:30:00', NULL),
(5, 'Cleaning Kit', '2017-10-07 09:30:00', NULL),
(6, 'Coach', '2017-10-07 09:30:00', NULL),
(7, 'Costa', '2017-10-07 09:30:00', NULL),
(8, 'Croake', '2017-10-07 09:30:00', NULL),
(9, 'Dior', '2017-10-07 09:30:00', NULL),
(10, 'Emporio Armani', '2017-10-07 09:30:00', NULL),
(11, 'Gucci', '2017-10-07 09:30:00', NULL),
(12, 'Guess', '2017-10-07 09:30:00', NULL),
(13, 'Jimmy Choo', '2017-10-07 09:30:00', NULL),
(14, 'Maui Jim', '2017-10-07 09:30:00', NULL),
(15, 'Michael Kors', '2017-10-07 09:30:00', NULL),
(16, 'New York Shades', '2017-10-07 09:30:00', NULL),
(17, 'Oakley', '2017-10-07 09:30:00', NULL),
(18, 'Polaroid', '2017-10-07 09:30:00', NULL),
(19, 'Prada', '2017-10-07 09:30:00', NULL),
(20, 'Ralph Lauren', '2017-10-07 09:30:00', NULL),
(21, 'Ray Ban', '2017-10-07 09:30:00', NULL),
(22, 'Reading Glasses', '2017-10-07 09:30:00', NULL),
(23, 'Revo', '2017-10-07 09:30:00', NULL),
(24, 'Serengetti', '2017-10-07 09:30:00', NULL),
(25, 'Suncloud', '2017-10-07 09:30:00', NULL),
(26, 'Tifanny', '2017-10-07 09:30:00', NULL),
(27, 'Tommy Bahamas', '2017-10-07 09:30:00', NULL),
(28, 'Tori Burch', '2017-10-07 09:30:00', NULL),
(29, 'Versace', '2017-10-07 09:30:00', NULL),
(30, 'Vogue', '2017-10-07 09:30:00', NULL),
(31, ' Please choose', '2017-10-07 09:30:00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
