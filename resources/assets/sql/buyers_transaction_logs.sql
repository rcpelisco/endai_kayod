-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2018 at 12:34 PM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.1.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `madelene_business_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `buyers_transaction_logs`
--

CREATE TABLE `buyers_transaction_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `value` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `buyer_id` int(10) UNSIGNED DEFAULT NULL,
  `transaction_type` enum('buy','debt','pay') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buyers_transaction_logs`
--

INSERT INTO `buyers_transaction_logs` (`id`, `product_id`, `value`, `created_at`, `updated_at`, `buyer_id`, `transaction_type`) VALUES
(1, 1, 7000.00, '2018-07-19 15:25:58', '2018-07-19 15:25:58', NULL, 'buy');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buyers_transaction_logs`
--
ALTER TABLE `buyers_transaction_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `buyers_transaction_logs_product_id_foreign` (`product_id`),
  ADD KEY `buyers_transaction_logs_buyer_id_foreign` (`buyer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buyers_transaction_logs`
--
ALTER TABLE `buyers_transaction_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buyers_transaction_logs`
--
ALTER TABLE `buyers_transaction_logs`
  ADD CONSTRAINT `buyers_transaction_logs_buyer_id_foreign` FOREIGN KEY (`buyer_id`) REFERENCES `buyers` (`id`),
  ADD CONSTRAINT `buyers_transaction_logs_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
