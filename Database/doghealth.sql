-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2023 at 10:46 PM
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
-- Table structure for table `doghealth`
--

CREATE TABLE `doghealth` (
  `HealthID` int(11) NOT NULL,
  `ClinicName` varchar(255) NOT NULL,
  `VetAddress` varchar(40) NOT NULL,
  `VetCity` varchar(30) NOT NULL,
  `VetState` varchar(2) NOT NULL,
  `VetZip` int(5) NOT NULL,
  `VetPhone` varchar(10) NOT NULL,
  `VetName` varchar(30) NOT NULL,
  `MedicalCond` varchar(255) NOT NULL,
  `Medication` varchar(255) NOT NULL,
  `DogID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doghealth`
--
ALTER TABLE `doghealth`
  ADD PRIMARY KEY (`HealthID`),
  ADD KEY `DogID` (`DogID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `doghealth`
--
ALTER TABLE `doghealth`
  MODIFY `HealthID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
