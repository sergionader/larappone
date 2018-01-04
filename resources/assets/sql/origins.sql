-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 01, 2017 at 07:33 PM
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
-- Table structure for table `origins`
--

CREATE TABLE `origins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `origins`
--

INSERT INTO `origins` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Australia', '2017-10-07 09:30:00', NULL),
(2, 'Brazil', '2017-10-07 09:30:00', NULL),
(3, 'China', '2017-10-07 09:30:00', NULL),
(4, 'England', '2017-10-07 09:30:00', NULL),
(5, 'Canada', '2017-10-07 09:30:00', NULL),
(6, 'Puerto Rico', '2017-10-07 09:30:00', NULL),
(7, 'India', '2017-10-07 09:30:00', NULL),
(8, 'Japan', '2017-10-07 09:30:00', NULL),
(9, 'United States', '2017-10-07 09:30:00', NULL),
(10, ' Please choose', '2017-10-07 09:30:00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `origins`
--
ALTER TABLE `origins`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `origins`
--
ALTER TABLE `origins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
