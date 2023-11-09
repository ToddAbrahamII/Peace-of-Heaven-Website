-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2023 at 10:45 PM
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
-- Database: `peaceofheavendb`
--

-- --------------------------------------------------------

--
-- Table structure for table `dog`
--

CREATE TABLE `dog` (
  `DogID` int(11) NOT NULL,
  `DogName` varchar(30) NOT NULL,
  `Breed` varchar(30) NOT NULL,
  `DogDOB` date NOT NULL,
  `Sex` char(1) NOT NULL,
  `isFixed` tinyint(1) NOT NULL,
  `Weight` int(3) NOT NULL,
  `Color` varchar(16) NOT NULL,
  `DogOtherInfo` varchar(500) NOT NULL,
  `HasForms` tinyint(1) NOT NULL,
  `CustID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dog`
--
ALTER TABLE `dog`
  ADD PRIMARY KEY (`DogID`),
  ADD KEY `CustID` (`CustID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dog`
--
ALTER TABLE `dog`
  MODIFY `DogID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
