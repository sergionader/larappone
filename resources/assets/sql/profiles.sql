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
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `type_id` int(11) NOT NULL,
  `subtype_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `name`, `type_id`, `subtype_id`, `created_at`, `updated_at`) VALUES
(1, 'Couple Middle Age', 1, 1, '2017-10-05 16:30:00', NULL),
(2, 'Couple Young', 1, 4, '2017-10-05 16:31:00', NULL),
(3, 'Couple Senior', 1, 3, '2017-10-05 16:32:00', NULL),
(4, 'Family', 2, 2, '2017-10-05 16:33:00', NULL),
(5, 'Gentleman Middle Age', 4, 1, '2017-10-05 16:34:00', NULL),
(6, 'Gentleman Young', 4, 4, '2017-10-05 16:35:00', NULL),
(7, 'Gentlemen Senior', 4, 3, '2017-10-05 16:36:00', NULL),
(8, 'Lady Middle Age', 3, 1, '2017-10-05 16:37:00', NULL),
(9, 'Lady Senior', 3, 3, '2017-10-05 16:38:00', NULL),
(10, 'Lady Young', 3, 4, '2017-10-05 16:39:00', NULL),
(11, ' Please choose', 5, 5, '2017-10-05 16:39:00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;



INSERT INTO `profiles` (`id`, `name`, `type_id`, `subtype_id`, `created_at`, `updated_at`) VALUES
(1, 'Couple Middle Age', 1, 1, '2017-10-05 16:30:00', NULL),
(2, 'Couple Young', 1, 4, '2017-10-05 16:31:00', NULL),
(3, 'Couple Senior', 1, 3, '2017-10-05 16:32:00', NULL),
(4, 'Family', 2, 2, '2017-10-05 16:33:00', NULL),
(5, 'Gentleman Middle Age', 4, 1, '2017-10-05 16:34:00', NULL),
(6, 'Gentleman Young', 4, 4, '2017-10-05 16:35:00', NULL),
(7, 'Gentlemen Senior', 4, 3, '2017-10-05 16:36:00', NULL),
(8, 'Lady Middle Age', 3, 1, '2017-10-05 16:37:00', NULL),
(9, 'Lady Senior', 3, 3, '2017-10-05 16:38:00', NULL),
(10, 'Lady Young', 3, 4, '2017-10-05 16:39:00', NULL),
(11, ' Please choose', 5, 5, '2017-10-05 16:39:00', NULL);

