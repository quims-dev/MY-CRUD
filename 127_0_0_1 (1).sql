-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2025 at 01:20 PM
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
-- Database: `diary`
--
CREATE DATABASE IF NOT EXISTS `diary` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `diary`;

-- --------------------------------------------------------

--
-- Table structure for table `diary_entries`
--

CREATE TABLE `diary_entries` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `entry_date` date DEFAULT NULL,
  `favorite` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `diary_entries`
--

INSERT INTO `diary_entries` (`id`, `title`, `content`, `created_at`, `entry_date`, `favorite`) VALUES
(1, 'PE', 'we played scrabble ahhahaha', '2025-02-05 10:41:18', NULL, 0),
(2, 'CALCULUS', 'IT SO HARDDDDDDDDDDDDDDD', '2025-02-05 10:42:06', NULL, 0),
(3, 'IT6', 'IT SO HARD VERY HARD', '2025-02-05 10:51:02', '2025-02-05', 0),
(4, 'PE', 'SO KAPAGOD', '2025-02-05 10:54:54', '2025-02-05', 0),
(5, 'PE', 'AAAAA', '2025-02-05 10:57:33', '2025-02-05', 0),
(6, 'hak', 'dadsa', '2025-02-05 10:59:11', '2025-02-05', 0),
(7, 'sadsad', 'dasd', '2025-02-05 11:03:50', '2025-02-06', 0),
(8, 'SDS', 'MFDFLSDFSDFSD', '2025-02-05 11:23:38', '2025-02-05', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `diary_entries`
--
ALTER TABLE `diary_entries`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `diary_entries`
--
ALTER TABLE `diary_entries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
