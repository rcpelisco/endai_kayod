-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2018 at 04:29 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `airline_companies`
--

CREATE TABLE `airline_companies` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `airline_companies`
--

INSERT INTO `airline_companies` (`id`, `name`, `address`, `phone_number`, `email`, `logo_path`, `created_at`, `updated_at`) VALUES
(10, 'Air Asia', 'Bldg, 4 unit 1 Salem Complex, Domestic Road Pasay, City, Philippines', '6327422742', 'http://www.airasia.com/ph', 'images/BRauoweKg5HIuJWVH0XTwKJrdGT80A0KjaremAIi.png', '2018-06-18 05:34:50', '2018-06-18 05:34:50'),
(11, 'Philippine Airlines', 'Manila', '6328558888', 'webmgr@pal.com.ph', 'images/dgEV0vvsaqyM11cIn7NVAbIX89toihPFGmXQ2VJa.png', '2018-06-18 05:39:12', '2018-06-18 05:39:12'),
(12, 'Cebu Pacific', 'Airline Operations Center Building Philippines', '6327020888', NULL, 'images/hE86T3UDlC3u3vuhmGSx5i1DPwNc8cUOzeqpA4NR.png', '2018-06-18 05:45:48', '2018-06-18 05:45:48'),
(13, 'Tiger Air', 'Cebu', '6327984488', NULL, 'images/y5MpJLYWZFBdPAGcSDsXvPkDdqgHDejcGCUPTLT8.png', '2018-06-18 06:29:01', '2018-06-18 06:29:01'),
(14, 'Cebgo', 'Baan Riverside', '091246745', 'cebgo@gmail.com', 'images/U3D41hS2iSI6MmlGVpTlD8adZGG3XZ38hCvReXHk.jpeg', '2018-06-29 12:31:03', '2018-06-29 12:31:03');

-- --------------------------------------------------------

--
-- Table structure for table `buyers`
--

CREATE TABLE `buyers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_no` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `buyers_purchased_products`
--

CREATE TABLE `buyers_purchased_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `buyer_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `product_log_id` int(10) UNSIGNED NOT NULL,
  `value` double(8,2) NOT NULL,
  `paid` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `enrolled`
--

CREATE TABLE `enrolled` (
  `id` int(10) UNSIGNED NOT NULL,
  `tutorial_id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `sessions_left` int(11) DEFAULT NULL,
  `credit` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enrolled_logs`
--

CREATE TABLE `enrolled_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `enrolled_id` int(10) UNSIGNED NOT NULL,
  `amount` double NOT NULL,
  `transaction_type` enum('pay','credit') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `flight_tickets`
--

CREATE TABLE `flight_tickets` (
  `id` int(10) UNSIGNED NOT NULL,
  `issue_date` datetime NOT NULL,
  `booking_date` datetime NOT NULL,
  `departure_date` datetime NOT NULL,
  `arrival_date` datetime NOT NULL,
  `booking_reference` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `flight_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `origin` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destination` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `passenger_name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ticket_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pax_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `add_on_baggage` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_amount` decimal(8,2) NOT NULL,
  `airline_company_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pnr` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guardians`
--

CREATE TABLE `guardians` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_number` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_04_04_133449_create_tutorials_table', 1),
(4, '2018_04_04_135810_create_guardians_table', 1),
(5, '2018_04_04_142224_create_students_table', 1),
(6, '2018_04_08_061245_create_product_table', 1),
(7, '2018_04_08_061317_create_enrolled_table', 1),
(8, '2018_04_08_062132_update_create_product_table_to_create_products_table', 1),
(9, '2018_04_08_070533_add_gender_column_to_students_table', 1),
(10, '2018_04_08_092206_create_product_logs_table', 1),
(11, '2018_04_08_100300_update_products_table', 2),
(12, '2018_04_10_054341_create_airline_companies_table', 3),
(13, '2018_04_10_055830_create_flight_tickets_table', 4),
(14, '2018_04_10_062348_add_foreign_key_to_arline_company_id_on_flight_tickets_table', 5),
(15, '2018_04_12_154135_remove_pnr_column_from_airline_companies_table', 6),
(16, '2018_04_12_154741_add_pnr_column_to_flight_tickets_table', 7),
(17, '2018_04_13_095623_update_create_product_logs_table', 8),
(18, '2018_05_07_160823_create_buyers_table', 9),
(19, '2018_05_08_063900_add_column_to_logs_table', 10),
(20, '2018_05_08_065925_add_foriegn_key_to_logs_table', 11),
(21, '2018_05_09_030851_create_buyers_transaction_logs_table', 12),
(22, '2018_05_09_035515_remove_date_column_in_product_logs_table', 13),
(23, '2018_05_09_121354_update_sold_to_column_nullable', 14),
(24, '2018_06_04_143016_update_buyers_transaction_log_nullable_buyers_id', 15),
(25, '2018_06_18_144528_buyers_purchased_products', 16),
(28, '2018_06_18_161525_create_product_edit_histories_table', 17),
(29, '2018_06_18_164315_update_add_transaction_type', 17),
(30, '2018_06_18_170713_add_active_column_for_delete', 18),
(31, '2018_06_18_170913_drop_active_column_in_product_logs', 19),
(34, '2018_06_22_154000_set_nullable_columns_on_product_logs', 20),
(35, '2018_06_22_163539_change_product_log_id_to_product_id', 20),
(36, '2018_06_22_163846_add_foreign_key', 21),
(37, '2018_06_25_112246_set_active_students', 22),
(38, '2018_06_25_113919_set_active_guardian', 23),
(39, '2018_06_25_121904_set_boolean_paid', 24),
(40, '2018_06_25_134818_add_debt_pay_type', 25),
(41, '2018_06_25_145518_update_buyers_transaction_log_transaction_type', 26),
(42, '2018_06_25_161538_add_foreign_key_buyers_purchased_products', 27),
(43, '2018_06_29_181939_add_active_to_tutorials', 28),
(44, '2018_07_17_110130_enrolled_logs', 29),
(45, '2018_07_17_111857_enrolled_logs_timestamps', 30),
(46, '2018_07_17_114018_enrolled_logs_edit', 31);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('og.gag@gmail.com', '$2y$10$hx/KUhJmdjpbGbU208fGGuyX/Fi86WIy76pv9bnbo0XwgiAkOTIO2', '2018-06-25 09:49:16');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `total_sold` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_edit_histories`
--

CREATE TABLE `product_edit_histories` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `edited_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_logs`
--

CREATE TABLE `product_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total_sold` double DEFAULT NULL,
  `sold_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sold_to` int(10) UNSIGNED DEFAULT NULL,
  `type` enum('add_stock','buy','edit','delete','debt','pay') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` enum('male','female') COLLATE utf8mb4_unicode_ci NOT NULL,
  `guardian_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tutorials`
--

CREATE TABLE `tutorials` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `type` enum('academic','interest') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Madelene Amante', 'madelenebt@gmail.com', '$2y$10$2yTb8hmMIWIj6B9LODrEkOKxUI.q5upF8Y4biqnD.dC5KBU.WzegO', 'uVAtaQrymMDj7STl6w81j4G0xAXrKG7mMV64wwAN2gaeSBzbJubONwm8NqyF', '2018-04-13 01:18:44', '2018-04-13 01:18:44'),
(2, 'dev', 'dev@dev.com', '$2y$10$6AlJ6UwjfilDBe7Wu4muGeRHW6mMtnWRRyShtZKGS/g1DrELcjKNu', NULL, '2018-04-13 01:44:39', '2018-04-13 01:44:39'),
(3, 'admin', 'admin@admin.com', '$2y$10$Jxu.Pw/vx8qxUH8SazT5ZeN40MamoI9S50WUAxGLnhd.N2NC9DS56', 'Fc52yD7fpSojZkpEzNoiQvXhBEQhex4JBClevO8LV7QBibwhJQ5DQymjFEYh', '2018-04-17 03:51:37', '2018-04-17 03:51:37'),
(4, 'dodong', 'dodong@yahoo.com', '$2y$10$rKTe.LnFVHG0oBHWx6/ue.u/5I2NtIAn97qXW6N/Q.E8ygzsH31v.', NULL, '2018-05-17 11:26:20', '2018-05-17 11:26:20'),
(5, 'Bamb boo', 'og.gag@gmail.com', '$2y$10$i2Uoj.PPeNGPzrsV9f0U1eY2V./P0nMhf8TqUAvman60ED9ED8H02', 'bqOjPKhYvcu3K1qewVUTmbZQSYsJ52j5wKHWr029zKqXQesbn2ppAIoLS2yY', '2018-06-25 09:30:49', '2018-06-25 09:30:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `airline_companies`
--
ALTER TABLE `airline_companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buyers`
--
ALTER TABLE `buyers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buyers_purchased_products`
--
ALTER TABLE `buyers_purchased_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `buyers_purchased_products_buyer_id_foreign` (`buyer_id`),
  ADD KEY `buyers_purchased_products_product_id_foreign` (`product_id`),
  ADD KEY `buyers_purchased_products_product_log_id_foreign` (`product_log_id`);

--
-- Indexes for table `buyers_transaction_logs`
--
ALTER TABLE `buyers_transaction_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `buyers_transaction_logs_product_id_foreign` (`product_id`),
  ADD KEY `buyers_transaction_logs_buyer_id_foreign` (`buyer_id`);

--
-- Indexes for table `enrolled`
--
ALTER TABLE `enrolled`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enrolled_tutorial_id_foreign` (`tutorial_id`),
  ADD KEY `enrolled_student_id_foreign` (`student_id`);

--
-- Indexes for table `enrolled_logs`
--
ALTER TABLE `enrolled_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enrolled_logs_enrolled_id_foreign` (`enrolled_id`);

--
-- Indexes for table `flight_tickets`
--
ALTER TABLE `flight_tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `flight_tickets_airline_company_id_foreign` (`airline_company_id`);

--
-- Indexes for table `guardians`
--
ALTER TABLE `guardians`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_edit_histories`
--
ALTER TABLE `product_edit_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_edit_histories_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_logs`
--
ALTER TABLE `product_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_logs_product_id_foreign` (`product_id`),
  ADD KEY `product_logs_sold_by_foreign` (`sold_by`),
  ADD KEY `product_logs_sold_to_foreign` (`sold_to`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `students_guardian_id_foreign` (`guardian_id`);

--
-- Indexes for table `tutorials`
--
ALTER TABLE `tutorials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `airline_companies`
--
ALTER TABLE `airline_companies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `buyers`
--
ALTER TABLE `buyers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `buyers_purchased_products`
--
ALTER TABLE `buyers_purchased_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `buyers_transaction_logs`
--
ALTER TABLE `buyers_transaction_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `enrolled`
--
ALTER TABLE `enrolled`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `enrolled_logs`
--
ALTER TABLE `enrolled_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;
--
-- AUTO_INCREMENT for table `flight_tickets`
--
ALTER TABLE `flight_tickets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `guardians`
--
ALTER TABLE `guardians`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `product_edit_histories`
--
ALTER TABLE `product_edit_histories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `product_logs`
--
ALTER TABLE `product_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tutorials`
--
ALTER TABLE `tutorials`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `buyers_purchased_products`
--
ALTER TABLE `buyers_purchased_products`
  ADD CONSTRAINT `buyers_purchased_products_buyer_id_foreign` FOREIGN KEY (`buyer_id`) REFERENCES `buyers` (`id`),
  ADD CONSTRAINT `buyers_purchased_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `buyers_purchased_products_product_log_id_foreign` FOREIGN KEY (`product_log_id`) REFERENCES `product_logs` (`id`);

--
-- Constraints for table `buyers_transaction_logs`
--
ALTER TABLE `buyers_transaction_logs`
  ADD CONSTRAINT `buyers_transaction_logs_buyer_id_foreign` FOREIGN KEY (`buyer_id`) REFERENCES `buyers` (`id`),
  ADD CONSTRAINT `buyers_transaction_logs_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `enrolled`
--
ALTER TABLE `enrolled`
  ADD CONSTRAINT `enrolled_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `enrolled_tutorial_id_foreign` FOREIGN KEY (`tutorial_id`) REFERENCES `tutorials` (`id`);

--
-- Constraints for table `enrolled_logs`
--
ALTER TABLE `enrolled_logs`
  ADD CONSTRAINT `enrolled_logs_enrolled_id_foreign` FOREIGN KEY (`enrolled_id`) REFERENCES `enrolled` (`id`);

--
-- Constraints for table `flight_tickets`
--
ALTER TABLE `flight_tickets`
  ADD CONSTRAINT `flight_tickets_airline_company_id_foreign` FOREIGN KEY (`airline_company_id`) REFERENCES `airline_companies` (`id`);

--
-- Constraints for table `product_edit_histories`
--
ALTER TABLE `product_edit_histories`
  ADD CONSTRAINT `product_edit_histories_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `product_logs`
--
ALTER TABLE `product_logs`
  ADD CONSTRAINT `product_logs_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_logs_sold_by_foreign` FOREIGN KEY (`sold_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `product_logs_sold_to_foreign` FOREIGN KEY (`sold_to`) REFERENCES `buyers` (`id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_guardian_id_foreign` FOREIGN KEY (`guardian_id`) REFERENCES `guardians` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
