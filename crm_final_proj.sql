-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2025 at 03:19 AM
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
-- Database: `crm_final_proj`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `first_name`, `last_name`, `contact_number`, `email`, `address`, `status`, `staff_id`) VALUES
(1, 'Customer', 'Dela Cruz 1', '09171234561', 'client1@mail.com', 'Quezon City, Philippines', 'Active', 2),
(2, 'Customer', 'Dela Cruz 2', '09171234562', 'client2@mail.com', 'Quezon City, Philippines', 'Active', 2),
(3, 'Customer', 'Dela Cruz 3', '09171234563', 'client3@mail.com', 'Quezon City, Philippines', 'Active', 2),
(4, 'Customer', 'Dela Cruz 4', '09171234564', 'client4@mail.com', 'Quezon City, Philippines', 'Active', 2),
(5, 'Customer', 'Dela Cruz 5', '09171234565', 'client5@mail.com', 'Quezon City, Philippines', 'Active', 2);

-- --------------------------------------------------------

--
-- Table structure for table `interaction`
--

CREATE TABLE `interaction` (
  `interaction_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `date_time` datetime DEFAULT NULL,
  `interaction_type` varchar(50) DEFAULT NULL,
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `interaction`
--

INSERT INTO `interaction` (`interaction_id`, `customer_id`, `staff_id`, `date_time`, `interaction_type`, `notes`) VALUES
(1, 1, 2, '2025-12-14 01:19:24', 'Email', 'Inquired about membership promo.'),
(2, 2, 2, '2025-12-09 01:19:24', 'Email', 'Inquired about membership promo.'),
(3, 3, 2, '2025-12-07 01:19:24', 'Email', 'Inquired about membership promo.'),
(4, 4, 2, '2025-12-06 01:19:24', 'Meeting', 'Inquired about membership promo.'),
(5, 5, 2, '2025-12-14 01:19:24', 'Call', 'Inquired about membership promo.'),
(6, 1, 1, '2025-12-16 01:30:03', 'Call', 'Inquired about membership promo');

-- --------------------------------------------------------

--
-- Table structure for table `lead`
--

CREATE TABLE `lead` (
  `lead_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `lead_stage` varchar(50) DEFAULT NULL,
  `last_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lead`
--

INSERT INTO `lead` (`lead_id`, `customer_id`, `lead_stage`, `last_updated`) VALUES
(1, 1, 'Qualified', '2025-12-16 01:29:21'),
(2, 2, 'New', '2025-12-16 01:19:24'),
(3, 3, 'Qualified', '2025-12-16 01:19:24'),
(4, 4, 'New', '2025-12-16 01:19:24'),
(5, 5, 'Contacted', '2025-12-16 01:19:24');

-- --------------------------------------------------------

--
-- Table structure for table `manager_assignment`
--

CREATE TABLE `manager_assignment` (
  `assignment_id` int(11) NOT NULL,
  `manager_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `date_assign` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manager_assignment`
--

INSERT INTO `manager_assignment` (`assignment_id`, `manager_id`, `staff_id`, `date_assign`) VALUES
(1, 1, 2, '2025-12-16');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `roles` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `first_name`, `last_name`, `roles`, `email`, `password`) VALUES
(1, 'Roselle', 'Manager', 'Manager', 'roselle@gym.com', '$2y$12$O/G9pSWICF6g3nxavg6wyOgBx/P.xxQllnzRqmp31B8moFu7uksoq'),
(2, 'Rusil', 'Staff', 'Staff', 'rusil@gym.com', '$2y$12$qcAkX40oE3r4GXmpO6ewf.JZVOKJnGu6ANX8qzh8v7H0XpetxgUJS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `fk_customer_staff` (`staff_id`);

--
-- Indexes for table `interaction`
--
ALTER TABLE `interaction`
  ADD PRIMARY KEY (`interaction_id`),
  ADD KEY `fk_interaction_customer` (`customer_id`),
  ADD KEY `fk_interaction_staff` (`staff_id`);

--
-- Indexes for table `lead`
--
ALTER TABLE `lead`
  ADD PRIMARY KEY (`lead_id`),
  ADD KEY `fk_lead_customer` (`customer_id`);

--
-- Indexes for table `manager_assignment`
--
ALTER TABLE `manager_assignment`
  ADD PRIMARY KEY (`assignment_id`),
  ADD KEY `fk_managerassignment_manager` (`manager_id`),
  ADD KEY `fk_managerassignment_staff` (`staff_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `interaction`
--
ALTER TABLE `interaction`
  MODIFY `interaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `lead`
--
ALTER TABLE `lead`
  MODIFY `lead_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `manager_assignment`
--
ALTER TABLE `manager_assignment`
  MODIFY `assignment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `fk_customer_staff` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `interaction`
--
ALTER TABLE `interaction`
  ADD CONSTRAINT `fk_interaction_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_interaction_staff` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lead`
--
ALTER TABLE `lead`
  ADD CONSTRAINT `fk_lead_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `manager_assignment`
--
ALTER TABLE `manager_assignment`
  ADD CONSTRAINT `fk_managerassignment_manager` FOREIGN KEY (`manager_id`) REFERENCES `staff` (`staff_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_managerassignment_staff` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
