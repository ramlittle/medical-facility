-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2025 at 10:24 AM
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
-- Database: `medical_facility`
--

-- --------------------------------------------------------

--
-- Table structure for table `personal_informations`
--

CREATE TABLE `personal_informations` (
  `personal_information_id` bigint(20) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `given_name` varchar(255) DEFAULT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `suffix_name` varchar(255) DEFAULT NULL,
  `sex` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `place_of_birth` varchar(255) DEFAULT NULL,
  `civil_status` varchar(255) DEFAULT NULL,
  `employment_status` varchar(255) DEFAULT NULL,
  `religion` varchar(255) DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL COMMENT 'foreign to users',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personal_informations`
--

INSERT INTO `personal_informations` (`personal_information_id`, `image_url`, `given_name`, `middle_name`, `last_name`, `suffix_name`, `sex`, `date_of_birth`, `place_of_birth`, `civil_status`, `employment_status`, `religion`, `nationality`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'https://static.wikia.nocookie.net/spongebob/images/c/ca/Mermaid_Man_stock_art.png/revision/latest?cb=20220807020103', 'Juan', 'Dela Cruz', 'lito', '', 'Male', '2025-02-13', NULL, 'Married', 'Employed', 'Roman Catholic', 'Filipino', 1, '2025-02-13 15:05:34', '2025-02-13 16:15:05'),
(5, 'https://static.wikia.nocookie.net/spongebob/images/c/ca/Mermaid_Man_stock_art.png/revision/latest?cb=20220807020103', 'Juan', 'Dela Cruz', 'lito', 'Jr.', 'Others', '2025-02-13', NULL, 'Single', 'Unemployed', 'Roman Catholic', 'Filipino', 2, '2025-02-13 16:33:15', '2025-02-13 16:33:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `is_active`, `is_admin`, `created_at`, `updated_at`) VALUES
(1, 'a', '$2y$10$LBx7eUmxR9cGAnHqxQgFaOWv94HATzuVkYM0B.tajxLg07xppHsvy', 1, 0, '2025-02-13 08:53:44', '2025-02-13 08:53:44'),
(2, 'b', '$2y$10$bCPbDwojdPpHkGW5.G4RGOyxB4s2Irkyo31XX75kLMdl8sMwtxm/y', 1, 0, '2025-02-13 13:05:09', '2025-02-13 13:05:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `personal_informations`
--
ALTER TABLE `personal_informations`
  ADD PRIMARY KEY (`personal_information_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `personal_informations`
--
ALTER TABLE `personal_informations`
  MODIFY `personal_information_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `personal_informations`
--
ALTER TABLE `personal_informations`
  ADD CONSTRAINT `personal_informations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
