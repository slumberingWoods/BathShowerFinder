-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2023 at 08:20 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

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
-- Table structure for table `bathtub`
--

CREATE TABLE `bathtub` (
  `MoldName` varchar(50) NOT NULL,
  `NoMold` varchar(20) NOT NULL,
  `TubID` int(11) NOT NULL,
  `Material` varchar(3) NOT NULL,
  `DimA` float NOT NULL,
  `DimB` float NOT NULL,
  `DimC` float NOT NULL,
  `DimD` float NOT NULL,
  `DimE` float NOT NULL,
  `DimF` float NOT NULL,
  `DimG` float NOT NULL,
  `DimH` float NOT NULL,
  `IdFront` int(11) NOT NULL,
  `IdBack` int(11) NOT NULL,
  `IdMatTub` int(11) NOT NULL,
  `IdSide` int(11) NOT NULL,
  `TubTime` int(11) DEFAULT NULL,
  `Comments` varchar(200) NOT NULL,
  `IdImage` blob DEFAULT NULL,
  `SideName` varchar(30) NOT NULL,
  `BackName` varchar(30) NOT NULL,
  `FrontName` varchar(30) NOT NULL,
  `MatTubName` varchar(30) NOT NULL,
  `RegionAvailable` varchar(20) NOT NULL,
  `Price` decimal(20,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tolerances`
--

CREATE TABLE `tolerances` (
  `tol_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `aplus` decimal(10,0) NOT NULL,
  `amin` decimal(10,0) NOT NULL,
  `bplus` decimal(10,0) NOT NULL,
  `bmin` decimal(10,0) NOT NULL,
  `cplus` decimal(10,0) NOT NULL,
  `cmin` decimal(10,0) NOT NULL,
  `dplus` decimal(10,0) NOT NULL,
  `dmin` decimal(10,0) NOT NULL,
  `eplus` decimal(10,0) NOT NULL,
  `emin` decimal(10,0) NOT NULL,
  `fplus` decimal(10,0) NOT NULL,
  `fmin` decimal(10,0) NOT NULL,
  `gplus` decimal(10,0) NOT NULL,
  `gmin` decimal(10,0) NOT NULL,
  `hplus` decimal(10,0) NOT NULL,
  `hmin` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(30) NOT NULL,
  `isAdmin` tinyint(4) NOT NULL,
  `otpsecretkey` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bathtub`
--
ALTER TABLE `bathtub`
  ADD PRIMARY KEY (`TubID`);

--
-- Indexes for table `shower`
--
ALTER TABLE `shower`
  ADD PRIMARY KEY (`ShowerID`);

--
-- Indexes for table `tolerances`
--
ALTER TABLE `tolerances`
  ADD PRIMARY KEY (`tol_id`),
  ADD KEY `FK_userId` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `shower`
--
ALTER TABLE `shower`
  MODIFY `ShowerID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tolerances`
--
ALTER TABLE `tolerances`
  ADD CONSTRAINT `FK_userId` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
