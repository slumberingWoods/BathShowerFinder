-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2023 at 06:22 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bathfinder`
--

-- --------------------------------------------------------

--
-- Table structure for table `shower`
--

CREATE TABLE `shower` (
  `MoldName` varchar(50) NOT NULL,
  `NoMold` varchar(20) NOT NULL,
  `ShowerID` int(11) NOT NULL,
  `Material` varchar(3) NOT NULL,
  `DimA` float NOT NULL,
  `DimB` float NOT NULL,
  `DimC` float NOT NULL,
  `DimD` float NOT NULL,
  `DimE` float NOT NULL,
  `DimF` float NOT NULL,
  `IdFront` int(11) NOT NULL,
  `IdDoor` int(11) NOT NULL,
  `IdMatShower` int(11) NOT NULL,
  `ShowerTime` int(11) DEFAULT NULL,
  `Comments` varchar(200) NOT NULL,
  `IdImage` blob DEFAULT NULL,
  `FrontName` varchar(30) NOT NULL,
  `DoorName` varchar(30) NOT NULL,
  `MatShowerName` varchar(30) NOT NULL,
  `RegionAvailable` varchar(20) NOT NULL,
  `Price` decimal(20,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `shower`
--
ALTER TABLE `shower`
  ADD PRIMARY KEY (`ShowerID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `shower`
--
ALTER TABLE `shower`
  MODIFY `ShowerID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
