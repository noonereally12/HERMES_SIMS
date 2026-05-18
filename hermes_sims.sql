-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2026 at 07:14 PM
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
-- Database: `hermes_sims`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `AccID` int(11) NOT NULL,
  `AccName` varchar(50) NOT NULL,
  `AccPass` varchar(225) NOT NULL,
  `AccRole` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`AccID`, `AccName`, `AccPass`, `AccRole`) VALUES
(1, 'jcgerona', 'jcgeronaadmin123', 'admin'),
(2, 'slheyrana', 'slheyranaadmin123', 'admin'),
(3, 'sitiu', 'sitiustaff123', 'staff');

-- --------------------------------------------------------

--
-- Table structure for table `deliveries`
--

CREATE TABLE `deliveries` (
  `DelID` int(11) NOT NULL,
  `ProdID` int(11) NOT NULL,
  `DelQuan` int(11) NOT NULL,
  `DelDate` date NOT NULL,
  `DelAdd` varchar(225) NOT NULL,
  `DelStatus` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ProdID` int(11) NOT NULL,
  `ProdName` varchar(225) NOT NULL,
  `ProdStock` int(11) NOT NULL,
  `ProdExp` date NOT NULL,
  `ProdSupp` varchar(225) NOT NULL,
  `ProdPrice` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProdID`, `ProdName`, `ProdStock`, `ProdExp`, `ProdSupp`, `ProdPrice`) VALUES
(1, 'Hermes Buttered Chicken', 100, '2027-05-05', 'Hermes King Corporation', 30.00),
(2, 'Yangyeom Chicken', 55, '2027-05-12', 'JVG Corporation', 50.40),
(3, 'Samgyup Beef', 150, '2027-05-23', 'Hermes King Corporation', 75.00),
(4, 'Egg Roll ', 50, '2027-05-16', 'Dimsum Family', 90.00),
(5, 'Spicy Siomai', 50, '2027-05-29', 'Dimsum Family', 70.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`AccID`),
  ADD UNIQUE KEY `AccName` (`AccName`),
  ADD UNIQUE KEY `AccName_2` (`AccName`),
  ADD UNIQUE KEY `AccName_3` (`AccName`);

--
-- Indexes for table `deliveries`
--
ALTER TABLE `deliveries`
  ADD PRIMARY KEY (`DelID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProdID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `AccID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `deliveries`
--
ALTER TABLE `deliveries`
  MODIFY `DelID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ProdID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
