-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2024 at 06:03 PM
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
-- Database: `heather`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `ADMIN_ID` int(11) NOT NULL,
  `ADMIN_EMAIL` varchar(50) NOT NULL,
  `ADMIN_PASS` varchar(20) NOT NULL,
  `ADMIN_FNAME` varchar(50) NOT NULL,
  `ADMIN_LNAME` varchar(50) NOT NULL,
  `ADMIN_CONTACT` bigint(25) NOT NULL,
  `USER_TYPE` enum('Admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`ADMIN_ID`, `ADMIN_EMAIL`, `ADMIN_PASS`, `ADMIN_FNAME`, `ADMIN_LNAME`, `ADMIN_CONTACT`, `USER_TYPE`) VALUES
(2, 'admin1@gmail.com', '123', 'admin', '1', 5555, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `property`
--

CREATE TABLE `property` (
  `PROP_ID` int(11) NOT NULL,
  `PROP_NAME` varchar(75) DEFAULT NULL,
  `ADVERTISER_ID` int(11) NOT NULL,
  `PROP_ADDRESS` varchar(100) DEFAULT NULL,
  `POSTCODE` int(11) DEFAULT NULL,
  `FLOOR_AREA` decimal(10,2) DEFAULT NULL,
  `ROOM_NUM` int(11) NOT NULL,
  `PROP_DESCRIPTION` varchar(100) DEFAULT NULL,
  `PROP_PRICE` decimal(10,2) DEFAULT NULL,
  `PROP_RULES` varchar(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `property`
--

INSERT INTO `property` (`PROP_ID`, `PROP_NAME`, `ADVERTISER_ID`, `PROP_ADDRESS`, `POSTCODE`, `FLOOR_AREA`, `ROOM_NUM`, `PROP_DESCRIPTION`, `PROP_PRICE`, `PROP_RULES`, `image`, `status`) VALUES
(1, 'Uzumaki Residence', 4, 'Konoha Village', 1234, 1500.00, 5, 'Flat House', 1500.00, '', 'img\\naruto.jpg', 'available'),
(2, 'Going Merry', 5, 'East Blue', 1234, 14000.00, 6, 'Sharing Room', 0.00, '', 'img\\luffy.jpg', 'available'),
(4, 'Wall Maria House', 6, 'Shiganshina District', 1234, 6000.00, 5, 'tatakae', 0.00, '', 'img\\eren.jpg', 'pending'),
(13, 'Moving Castle', 7, 'Cornwall, United Kingdom', 1000, 9000.00, 15, '', 100.00, '', 'img\\howl.jpg', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `ROOM_ID` int(11) NOT NULL,
  `PROP_ID` int(11) NOT NULL,
  `ROOM_IMAGE` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`ROOM_ID`, `PROP_ID`, `ROOM_IMAGE`, `status`) VALUES
(1, 1, 'img\\room1.jpg', 'Available'),
(2, 1, 'img\\room2.jpg', 'Available'),
(3, 2, 'img\\room3.jpg', 'Available'),
(4, 2, 'img\\room4.jpg', 'Available'),
(5, 13, 'img\\room5.jpg', 'Available'),
(6, 13, 'img\\room6.jpg', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `USER_ID` int(11) NOT NULL,
  `USER_EMAIL` varchar(50) NOT NULL,
  `USER_PASS` varchar(50) NOT NULL,
  `USER_FNAME` varchar(50) DEFAULT NULL,
  `USER_LNAME` varchar(50) DEFAULT NULL,
  `USER_CONTACT` bigint(25) NOT NULL,
  `USER_TYPE` enum('Tenant','Advertiser') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`USER_ID`, `USER_EMAIL`, `USER_PASS`, `USER_FNAME`, `USER_LNAME`, `USER_CONTACT`, `USER_TYPE`) VALUES
(1, 'tenant1@gmail.com', '123', 'Tenant', 'One', 112345678, 'Tenant'),
(2, 'advertiser1@gmail.com', '123', 'Advertiser', 'One', 122345678, 'Advertiser'),
(4, 'Naruto@gmail.com', '123', 'Naruto', 'Uzumaki', 123, 'Advertiser'),
(5, 'Luffy@gmail.com', '123', 'Luffy', 'Monkey D', 1234, 'Advertiser'),
(6, 'eren@gmail.com', '123', 'Eren', 'Yaegar', 9876, 'Advertiser'),
(7, 'howl@gmail.com', '123', 'Howl', 'Pendragon', 12345, 'Advertiser'),
(39, 'hahanju@gmail.com', 'mhhm', 'hanju', 'cantik', 2903, 'Tenant');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`ADMIN_ID`),
  ADD KEY `ADMIN_EMAIL` (`ADMIN_EMAIL`),
  ADD KEY `ADMIN_CONTACT` (`ADMIN_CONTACT`);

--
-- Indexes for table `property`
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`PROP_ID`),
  ADD KEY `fk_advertiser` (`ADVERTISER_ID`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`ROOM_ID`),
  ADD KEY `fk_prop` (`PROP_ID`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`USER_ID`),
  ADD UNIQUE KEY `USER_CONTACT` (`USER_CONTACT`),
  ADD UNIQUE KEY `USER_EMAIL` (`USER_EMAIL`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `ADMIN_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `property`
--
ALTER TABLE `property`
  MODIFY `PROP_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `ROOM_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `USER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `property`
--
ALTER TABLE `property`
  ADD CONSTRAINT `fk_advertiser` FOREIGN KEY (`ADVERTISER_ID`) REFERENCES `users` (`USER_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_owner` FOREIGN KEY (`ADVERTISER_ID`) REFERENCES `users` (`USER_ID`);

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `fk_prop` FOREIGN KEY (`PROP_ID`) REFERENCES `property` (`PROP_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
