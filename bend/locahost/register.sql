-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2024 at 10:40 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

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
(6, 'วริษา', 'พูลพุทธ', '933757311', '165ihyufjihuydsgg', 'cugyugf7reb@gmail.com');

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
(7, '123456', '$2y$10$w/Osp8nGUJw.Np/vO3NCz.T5FO90eU.rI.DgpC8w.h2CBNbe1DXJ6');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cr_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `cr_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
