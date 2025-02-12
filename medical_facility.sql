-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2025 at 08:21 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

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
-- Table structure for table `contact_informations`
--

CREATE TABLE `contact_informations` (
  `contact_information_id` bigint(20) NOT NULL,
  `mobile_number` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `city_municipality` varchar(255) DEFAULT NULL,
  `barangay` varchar(255) DEFAULT NULL,
  `house_street_purok_district` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL COMMENT 'foreign to users',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_persons`
--

CREATE TABLE `contact_persons` (
  `contact_person_id` bigint(20) NOT NULL,
  `relationship` varchar(255) DEFAULT NULL,
  `mobile_number` int(11) DEFAULT NULL,
  `complete_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL COMMENT 'foreign to users',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_informations`
--

CREATE TABLE `personal_informations` (
  `personal_information_id` bigint(20) NOT NULL,
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
(1, 'a', '$2y$10$xgvo58wah5yES8G1UbVlSOlQToTD7ikWiZn3TJ8jQI1EFs0pc97Xi', 1, 0, '2025-02-13 01:06:20', '2025-02-13 01:06:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_informations`
--
ALTER TABLE `contact_informations`
  ADD PRIMARY KEY (`contact_information_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `contact_persons`
--
ALTER TABLE `contact_persons`
  ADD PRIMARY KEY (`contact_person_id`),
  ADD KEY `user_id` (`user_id`);

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
-- AUTO_INCREMENT for table `contact_informations`
--
ALTER TABLE `contact_informations`
  MODIFY `contact_information_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_persons`
--
ALTER TABLE `contact_persons`
  MODIFY `contact_person_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_informations`
--
ALTER TABLE `personal_informations`
  MODIFY `personal_information_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contact_informations`
--
ALTER TABLE `contact_informations`
  ADD CONSTRAINT `contact_informations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `contact_persons`
--
ALTER TABLE `contact_persons`
  ADD CONSTRAINT `contact_persons_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `personal_informations`
--
ALTER TABLE `personal_informations`
  ADD CONSTRAINT `personal_informations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
