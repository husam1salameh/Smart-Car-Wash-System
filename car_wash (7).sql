-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 22, 2025 at 02:05 PM
-- Server version: 8.0.42-0ubuntu0.24.04.1
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car_wash`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `loginname` varchar(100) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `delete_status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `loginname`, `password`, `fullname`, `delete_status`) VALUES
(1, 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'محمد احمد محمود حمد', 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int NOT NULL,
  `loginname` varchar(100) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `card_number` varchar(50) DEFAULT NULL,
  `card_name` varchar(50) DEFAULT NULL,
  `card_expiry` varchar(50) DEFAULT NULL,
  `card_cvv` varchar(50) DEFAULT NULL,
  `delete_status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `loginname`, `password`, `fullname`, `card_number`, `card_name`, `card_expiry`, `card_cvv`, `delete_status`) VALUES
(1, 'khalid', 'fbb0fd63a3c4bc3f6079aa82c224378e33a71eee5c528dc49f45d1326349e458', 'خالد حسن توفيق خالد', NULL, NULL, NULL, NULL, 0),
(2, 'mhmd', 'fbb0fd63a3c4bc3f6079aa82c224378e33a71eee5c528dc49f45d1326349e458', 'محمد عيسى محمد عيسى', NULL, NULL, NULL, NULL, 0),
(3, 'alii', '9d5a45bfb8da005335182895013450f65a103ab2e6c8e36045659310b28aba5e', 'علي حسن حسين عبد الله', '2333555544441111', 'ali a', '02/24', '123', 0),
(4, 'yousef', 'bf4bcedaacc966a99376cf0ee1b5b23f291e2ed3f79df3f09386435d685ca650', 'يوسف محمود حسين عبد الله', NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer_booking`
--

CREATE TABLE `customer_booking` (
  `id` int NOT NULL,
  `booking_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `customer_id` int DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1' COMMENT '1.wait 2.came 3.out of datetime',
  `wash_date` date DEFAULT NULL,
  `wash_time` time DEFAULT NULL,
  `serial_QR` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `customer_booking`
--

INSERT INTO `customer_booking` (`id`, `booking_datetime`, `customer_id`, `status`, `wash_date`, `wash_time`, `serial_QR`) VALUES
(6, '2025-04-27 14:28:04', 3, 3, '2025-04-27', '16:33:00', '1a39480a1f80af87ff2967d53bf3e87081f62a29'),
(7, '2025-03-24 15:40:01', 3, 3, '2025-04-27', '13:00:00', '6a1ebf5a88332aa4d36517da5fc93d7cafde8991'),
(8, '2025-04-22 23:33:42', 3, 3, '2025-04-23', '14:35:00', 'c6e8da3bda8867f544d40a7f2d097c2e628b2b64'),
(9, '2025-05-22 13:45:18', 3, 1, '2025-05-22', '00:15:00', '19978f8f5728fbb49f82348fb4df66c7c5f9bdcf'),
(10, '2025-05-22 13:53:15', 3, 1, '2025-05-22', '00:00:00', 'e05de2649a3857e2c034b2c8267b574ec8e76c80'),
(11, '2025-05-22 13:56:36', 3, 1, '2025-05-22', '13:00:00', '41bd76d9d0d388cf7480eb5192aa995eb9694114');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `loginname` (`loginname`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `loginname` (`loginname`);

--
-- Indexes for table `customer_booking`
--
ALTER TABLE `customer_booking`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customer_booking`
--
ALTER TABLE `customer_booking`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
