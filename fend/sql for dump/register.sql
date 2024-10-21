-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2024 at 07:12 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `register`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `address_id` int(11) NOT NULL,
  `cr_id` int(11) DEFAULT NULL,
  `address_text` text NOT NULL,
  `is_default` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`address_id`, `cr_id`, `address_text`, `is_default`) VALUES
(1, 14, 'testfordoaction', 0),
(2, 14, 'บ้าน2', 0),
(3, 14, 'บ้าน2', 0),
(4, 14, 'บ้าน2', 0),
(5, 14, 'นี่คือการทดสอบ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cr_id` int(7) NOT NULL,
  `cr_name` varchar(200) NOT NULL,
  `cr_last` varchar(200) NOT NULL,
  `cr_tel` varchar(15) NOT NULL,
  `cr_add` text NOT NULL,
  `cr_mail` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cr_id`, `cr_name`, `cr_last`, `cr_tel`, `cr_add`, `cr_mail`) VALUES
(5, 'ชลธิชา', 'เอี่ยมละออ', '931569184', '165ihyufjihuydsgg', 'cugyugf7reb@gmail.com'),
(6, 'วริษา', 'พูลพุทธ', '933757311', '165ihyufjihuydsgg', 'cugyugf7reb@gmail.com'),
(8, 'เทส', 'เทส', '0999999999', '557', 'test1@gmail.com'),
(9, 'mum', 'teng nong', '0999999999', '557 ', 'test1@gmail.com'),
(10, 'ไก่', 'กา อาราเล่', '0999999999', '557', 'test1@gmail.com'),
(11, 'guy', 'lit', '0999999999', '557', 'test1@gmail.com'),
(12, 'test3', 'test3', '0999999999', '557', 'test1@gmail.com'),
(13, 'mum', 'teng nong', '0999999999', '557', 'test1@gmail.com'),
(14, 'test', 'num5', '0999999999', '557', 'test1@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `cr_id` int(7) NOT NULL,
  `u_user` varchar(200) NOT NULL,
  `u_password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`cr_id`, `u_user`, `u_password`) VALUES
(4, '123456', '$2y$10$Avva.MPDoPAiMGlvMzF7Geprl6HtmnSGASfTt7uOyiHon1wuOqSrC'),
(5, '123456', '$2y$10$Nmy8IcUWoj4xDnL.p7jTY.jBHLAU7MUQuiwc6BItXdmJXHCnrwTfC'),
(6, '123456789', '$2y$10$oG9nv45ZCY4efanyxWkO9.ahpjol32ygI3VrN5HrWcIAO5twuFO3C'),
(7, '123456', '$2y$10$w/Osp8nGUJw.Np/vO3NCz.T5FO90eU.rI.DgpC8w.h2CBNbe1DXJ6'),
(8, 'test1', '$2y$10$v1kHW10QRR8fPb7DW1n17OpzsHN1F0xX.4tEd36kefqPJ74PIrcmG'),
(9, 'test2', '$2y$10$ugDNc4VZbHqS41zJ8STNoeTdgEK61JF9CTcZlcsEeTOjAO7gXzS2m'),
(10, 'test1', '$2y$10$MX8djKgLDec.RHaPQzUEQuO3YtMmjsrPo6fO9he9J.4GzKPbHi5h.'),
(11, 'fordoaction', '$2y$10$J3sLOQQLr441ESnC4Y0GkOvmXoUt6rUXxxn9z2UuhuGSufjOwWIZK'),
(12, 'test3', '$2y$10$m36LJ05L0Bbamlexr8P8SOqBg5v4EX0Y12zm/A3SrNgBe4LGcJ2mu'),
(13, 'test5', '$2y$10$YDGDktwbop8x7nSr0gclwui31cGoFbRSklEKgLk895OiHeIfcJoum'),
(14, 'num5', '$2y$10$P/gthfdNW06Q8LiJSftltesPmYdETPZVvLq/u4XXphLShp6ZI2weS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `cr_id` (`cr_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cr_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`cr_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cr_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `cr_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_ibfk_1` FOREIGN KEY (`cr_id`) REFERENCES `customer` (`cr_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
