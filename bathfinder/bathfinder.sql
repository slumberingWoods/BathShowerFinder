-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 19, 2023 at 04:07 PM
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
-- Database: `bathfinder`
--

-- --------------------------------------------------------

--
-- Table structure for table `Tolerances`
--

CREATE TABLE `Tolerances` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `user_id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `isAdmin` tinyint(4) NOT NULL,
  `otpsecretkey` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Tolerances`
--
ALTER TABLE `Tolerances`
  ADD PRIMARY KEY (`tol_id`),
  ADD KEY `FK_userId` (`user_id`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Tolerances`
--
ALTER TABLE `Tolerances`
  ADD CONSTRAINT `FK_userId` FOREIGN KEY (`user_id`) REFERENCES `User` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
