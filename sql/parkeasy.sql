-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2023 at 07:57 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parkeasy`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `location_name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `entry_time` time NOT NULL,
  `exit_time` time NOT NULL,
  `vehicle_number` varchar(20) NOT NULL,
  `vehicle_type` varchar(20) NOT NULL,
  `payment_method` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `email`, `location_name`, `date`, `entry_time`, `exit_time`, `vehicle_number`, `vehicle_type`, `payment_method`) VALUES
(1, 'pass@gmail.com', 'Welcome Pay N Park', '2023-10-02', '10:53:00', '10:51:00', 'MH 05 H 0001', 'two_wheeler', 'qr_code');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `latitude` varchar(20) NOT NULL,
  `longitude` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `available_slots` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `latitude`, `longitude`, `name`, `available_slots`, `price`) VALUES
(1, '19.245156588094872', '73.10930127418317', 'Kalyan Jn Parking Area', 12, 55.00),
(6, '19.24374181159976', '73.1337996900623', 'Pay And Park', 50, 15.00),
(7, '19.30597068800993', '73.22281955733163', 'Shri Ganesh Mandir Car Parking', 28, 50.00),
(8, '19.301388717772976', '73.21484364033796', 'Central Pay And Park Titwala', 13, 40.00),
(9, '19.307841359545407', '73.20584235301583', 'Lotus pay and park', 13, 40.00),
(10, '19.242391264165164', '73.14364907179069', 'Valdhuni Parking', 14, 12.00),
(11, '19.215364392083078', '73.0855374146118', 'KDMC Parking', 45, 20.00),
(12, '19.222682546410685', '73.08466256344217', 'Central Railway Pay And Park', 25, 10.00),
(13, '19.228992616565183', '73.08146123715335', 'Mausi house', 17, 10.00),
(14, '19.240030059058743', '73.16364206048799', 'Welcome Pay N Park', 30, 80.00),
(15, '19.24091735328762', '73.16132806090157', 'Usa Parking', 15, 20.00),
(16, '19.227155880167984', '73.16343669485468', 'CHM COLLEGE Parking Area', 14, 40.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`) VALUES
(1, 'test', 'test@gmail.com', '$2y$10$HsDW.WJ4lVUsHQK.q1/SEOkA2y03pKX80j6dB.upomCsW4iRxV6Pe'),
(2, 'pass', 'pass@gmail.com', '$2y$10$XzRpoA8BNs7lxxCFIB5dgO1q9gsTdzqjcuF1irhV/kN0IyXCzkcu6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
