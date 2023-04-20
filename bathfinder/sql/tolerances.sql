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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tolerances`
--
ALTER TABLE `tolerances`
  ADD PRIMARY KEY (`tol_id`),
  ADD KEY `FK_userId` (`user_id`);

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
