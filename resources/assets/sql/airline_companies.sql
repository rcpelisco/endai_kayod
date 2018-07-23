-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2018 at 04:59 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `madelene_business_management`
--

-- --------------------------------------------------------

--
-- Dumping data for table `airline_companies`
--

INSERT INTO `airline_companies` (`id`, `name`, `address`, `phone_number`, `email`, `logo_path`, `created_at`, `updated_at`) VALUES
(10, 'Air Asia', 'Bldg, 4 unit 1 Salem Complex, Domestic Road Pasay, City, Philippines', '6327422742', 'http://www.airasia.com/ph', 'images/BRauoweKg5HIuJWVH0XTwKJrdGT80A0KjaremAIi.png', '2018-06-18 05:34:50', '2018-06-18 05:34:50'),
(11, 'Philippine Airlines', 'Manila', '6328558888', 'webmgr@pal.com.ph', 'images/dgEV0vvsaqyM11cIn7NVAbIX89toihPFGmXQ2VJa.png', '2018-06-18 05:39:12', '2018-06-18 05:39:12'),
(12, 'Cebu Pacific', 'Airline Operations Center Building Philippines', '6327020888', NULL, 'images/hE86T3UDlC3u3vuhmGSx5i1DPwNc8cUOzeqpA4NR.png', '2018-06-18 05:45:48', '2018-06-18 05:45:48'),
(13, 'Tiger Air', 'Cebu', '6327984488', NULL, 'images/y5MpJLYWZFBdPAGcSDsXvPkDdqgHDejcGCUPTLT8.png', '2018-06-18 06:29:01', '2018-06-18 06:29:01'),
(14, 'Cebgo', 'Baan Riverside', '091246745', 'cebgo@gmail.com', 'images/U3D41hS2iSI6MmlGVpTlD8adZGG3XZ38hCvReXHk.jpeg', '2018-06-29 12:31:03', '2018-06-29 12:31:03');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
