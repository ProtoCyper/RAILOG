-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2025 at 01:25 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cargowing`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) UNSIGNED NOT NULL,
  `nama` varchar(60) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Admin','Super Admin') NOT NULL,
  `aktif` tinyint(4) NOT NULL DEFAULT 0,
  `aktivitas_terakhir` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama`, `email`, `password`, `role`, `aktif`, `aktivitas_terakhir`) VALUES
(1, 'Super Administrator', 'admin1@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Super Admin', 1, NULL),
(2, 'Admin 2', 'admin2@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(3, 'Admin 3', 'admin3@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(4, 'Admin 4', 'admin4@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(5, 'Admin 5', 'admin5@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(6, 'Admin 6', 'admin6@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(7, 'Admin 7', 'admin7@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(8, 'Admin 8', 'admin8@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(9, 'Admin 9', 'admin9@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(10, 'Admin 10', 'admin10@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(11, 'Admin 11', 'admin11@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(12, 'Admin 12', 'admin12@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(13, 'Admin 13', 'admin13@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(14, 'Admin 14', 'admin14@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(15, 'Admin 15', 'admin15@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(16, 'Admin 16', 'admin16@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(17, 'Admin 17', 'admin17@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(18, 'Admin 18', 'admin18@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(19, 'Admin 19', 'admin19@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(20, 'Admin 20', 'admin20@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(21, 'Admin 21', 'admin21@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(22, 'Admin 22', 'admin22@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(23, 'Admin 23', 'admin23@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(24, 'Admin 24', 'admin24@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(25, 'Admin 25', 'admin25@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(26, 'Admin 26', 'admin26@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(27, 'Admin 27', 'admin27@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(28, 'Admin 28', 'admin28@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(29, 'Admin 29', 'admin29@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(30, 'Admin 30', 'admin30@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(31, 'Admin 31', 'admin31@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(32, 'Admin 32', 'admin32@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(33, 'Admin 33', 'admin33@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(34, 'Admin 34', 'admin34@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(35, 'Admin 35', 'admin35@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(36, 'Admin 36', 'admin36@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(37, 'Admin 37', 'admin37@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(38, 'Admin 38', 'admin38@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(39, 'Admin 39', 'admin39@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(40, 'Admin 40', 'admin40@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(41, 'Admin 41', 'admin41@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(42, 'Admin 42', 'admin42@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(43, 'Admin 43', 'admin43@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(44, 'Admin 44', 'admin44@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(45, 'Admin 45', 'admin45@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(46, 'Admin 46', 'admin46@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(47, 'Admin 47', 'admin47@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(48, 'Admin 48', 'admin48@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(49, 'Admin 49', 'admin49@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(50, 'Admin 50', 'admin50@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(51, 'Admin 51', 'admin51@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(52, 'Admin 52', 'admin52@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(53, 'Admin 53', 'admin53@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(54, 'Admin 54', 'admin54@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(55, 'Admin 55', 'admin55@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(56, 'Admin 56', 'admin56@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(57, 'Admin 57', 'admin57@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(58, 'Admin 58', 'admin58@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(59, 'Admin 59', 'admin59@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(60, 'Admin 60', 'admin60@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(61, 'Admin 61', 'admin61@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(62, 'Admin 62', 'admin62@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(63, 'Admin 63', 'admin63@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(64, 'Admin 64', 'admin64@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(65, 'Admin 65', 'admin65@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(66, 'Admin 66', 'admin66@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(67, 'Admin 67', 'admin67@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(68, 'Admin 68', 'admin68@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(69, 'Admin 69', 'admin69@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(70, 'Admin 70', 'admin70@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(71, 'Admin 71', 'admin71@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(72, 'Admin 72', 'admin72@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(73, 'Admin 73', 'admin73@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(74, 'Admin 74', 'admin74@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(75, 'Admin 75', 'admin75@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(76, 'Admin 76', 'admin76@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(77, 'Admin 77', 'admin77@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(78, 'Admin 78', 'admin78@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(79, 'Admin 79', 'admin79@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(80, 'Admin 80', 'admin80@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(81, 'Admin 81', 'admin81@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(82, 'Admin 82', 'admin82@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(83, 'Admin 83', 'admin83@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(84, 'Admin 84', 'admin84@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(85, 'Admin 85', 'admin85@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(86, 'Admin 86', 'admin86@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(87, 'Admin 87', 'admin87@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(88, 'Admin 88', 'admin88@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(89, 'Admin 89', 'admin89@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(90, 'Admin 90', 'admin90@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(91, 'Admin 91', 'admin91@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(92, 'Admin 92', 'admin92@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(93, 'Admin 93', 'admin93@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(94, 'Admin 94', 'admin94@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(95, 'Admin 95', 'admin95@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(96, 'Admin 96', 'admin96@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(97, 'Admin 97', 'admin97@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(98, 'Admin 98', 'admin98@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(99, 'Admin 99', 'admin99@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 0, NULL),
(100, 'Admin 100', 'admin100@gmail.com', '$2y$10$9.9aqIYE9zAXnlJjoq/UHufTsVPE5TQaBFX2Ybn7J.DEpqUGNtEJ2', 'Admin', 1, NULL),
(101, 'Admin 1', 'admin11@gmail.com', '$2y$10$2O6Szp515qC4FECAWxrSCuP95fhR4UY4dHlyjsgPIhQrT.RQ2B26u', 'Admin', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) UNSIGNED NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `jumlah` int(10) UNSIGNED NOT NULL,
  `satuan` varchar(20) DEFAULT NULL,
  `tanggal_masuk` date NOT NULL,
  `barcode` varchar(50) DEFAULT NULL,
  `minimum_stok` int(11) NOT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  `surat_jalan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `id_laporan` int(11) UNSIGNED NOT NULL,
  `id_barang` int(10) UNSIGNED NOT NULL,
  `jumlah` int(10) UNSIGNED NOT NULL,
  `jenis` enum('Masuk','Dipakai') NOT NULL,
  `tanggal` datetime NOT NULL,
  `id_user` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_aktivitas`
--

CREATE TABLE `log_aktivitas` (
  `id_log` int(11) UNSIGNED NOT NULL,
  `id_user` int(10) UNSIGNED DEFAULT NULL,
  `id_admin` int(10) UNSIGNED DEFAULT NULL,
  `role` enum('User','Admin','Super Admin','tidak terdaftar') NOT NULL,
  `aktivitas` text NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `user_agent` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `log_aktivitas`
--

INSERT INTO `log_aktivitas` (`id_log`, `id_user`, `id_admin`, `role`, `aktivitas`, `ip_address`, `user_agent`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, NULL, 'tidak terdaftar', 'Logout berhasil', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-10 22:38:58', NULL, NULL),
(2, NULL, NULL, 'tidak terdaftar', 'Logout berhasil', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-10 23:15:01', NULL, NULL),
(3, NULL, NULL, 'tidak terdaftar', 'Logout berhasil', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-11 07:05:52', NULL, NULL),
(4, NULL, NULL, 'tidak terdaftar', 'Logout berhasil', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-11 07:07:38', NULL, NULL);

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
(1, '2025-08-02-094747', 'App\\Database\\Migrations\\CreateAdmin', 'default', 'App', 1765381131, 1),
(2, '2025-08-02-095335', 'App\\Database\\Migrations\\CreateBarang', 'default', 'App', 1765381131, 1),
(3, '2025-08-02-095615', 'App\\Database\\Migrations\\CreateLaporan', 'default', 'App', 1765381131, 1),
(4, '2025-08-05-044956', 'App\\Database\\Migrations\\CreateUserTable', 'default', 'App', 1765381131, 1),
(5, '2025-08-26-073723', 'App\\Database\\Migrations\\CreateLogAktivitas', 'default', 'App', 1765381131, 1),
(6, '2025-09-14-044925', 'App\\Database\\Migrations\\CreateNotifikasiTable', 'default', 'App', 1765381131, 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id_notif` int(11) UNSIGNED NOT NULL,
  `id_barang` int(11) UNSIGNED DEFAULT NULL,
  `pesan` varchar(255) NOT NULL,
  `status` enum('unread','read') NOT NULL DEFAULT 'unread',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) UNSIGNED NOT NULL,
  `nama` varchar(60) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `no_hp` char(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indexes for table `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  ADD PRIMARY KEY (`id_log`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id_notif`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id_laporan` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  MODIFY `id_log` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id_notif` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
