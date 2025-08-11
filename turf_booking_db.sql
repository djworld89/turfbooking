-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 11, 2025 at 04:56 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `turf_booking_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
CREATE TABLE IF NOT EXISTS `bookings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `booking_id` varchar(36) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `sport` varchar(50) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `token_amount` decimal(10,2) NOT NULL,
  `paymentStatus` enum('Pending','Paid') DEFAULT 'Pending',
  `fromDateTime` datetime NOT NULL,
  `toDateTime` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `remark` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `booking_id` (`booking_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `booking_id`, `name`, `mobile`, `email`, `sport`, `amount`, `token_amount`, `paymentStatus`, `fromDateTime`, `toDateTime`, `created_at`, `updated_at`, `remark`) VALUES
(1, 'BOOK_68934a07e21c6', 'DEEPAK', '7021670487', 'mumbai-1@gmail.com', 'Football', '2500.00', '0.00', 'Paid', '2025-08-07 22:00:00', '2025-08-07 23:59:00', '2025-08-06 12:26:47', '2025-08-06 14:51:16', 'hello world');

-- --------------------------------------------------------

--
-- Table structure for table `turfs`
--

DROP TABLE IF EXISTS `turfs`;
CREATE TABLE IF NOT EXISTS `turfs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `turfs`
--

INSERT INTO `turfs` (`id`, `name`, `location`) VALUES
(1, 'deepak', 'smart turf, mumbai');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `is_admin`) VALUES
(1, 'test', 'onlinebookmypandit@gmail.com', '$2y$10$Lep0Tt4Lr.idSgyOUjvDI.JqluLzuKTIuW.BqwbeIfZAbMfUJOeyO', 1),
(2, 'test1', 'sw@gmail.com', '$2y$10$smnvzCoiR0WiQm7DFC68Ievlm3eOF6CP/hu7X9Tp2hCbtMmMCfgTq', 0),
(3, 'mumbai_turf', 'mumbai@gmail.com', '$2y$10$aZuTAyrAfM9Gb67rPVnrEOZ35tfjbl/DjYQd8c7lrGDLDlXEUshQm', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
