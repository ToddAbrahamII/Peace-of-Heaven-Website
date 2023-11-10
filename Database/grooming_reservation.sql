-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2023 at 06:28 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

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
-- Table structure for table `grooming_reservation`
--

CREATE TABLE `grooming_reservation` (
  `GroomResID` int(11) NOT NULL,
  `ResStartDate` date NOT NULL,
  `ResEndDate` date NOT NULL,
  `EmerContact` varchar(255) NOT NULL,
  `EmerPhone` varchar(12) NOT NULL,
  `isApproved` tinyint(1) NOT NULL DEFAULT 0,
  `GroomingDesc` varchar(500) NOT NULL,
  `CustID` int(11) NOT NULL,
  `DogID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grooming_reservation`
--

INSERT INTO `grooming_reservation` (`GroomResID`, `ResStartDate`, `ResEndDate`, `EmerContact`, `EmerPhone`, `isApproved`, `GroomingDesc`, `CustID`, `DogID`) VALUES
(2, '2023-11-05', '2023-11-18', 'Todd Abraham', '999', 0, 'This is a description', 14, 2),
(3, '2023-10-29', '2023-10-31', 'Todd Abraham', '5555555555', 0, 'Descriptinnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnn', 14, 1),
(4, '2023-11-05', '2023-11-25', 'Todd Abraham', '890-098-2343', 0, 'This is descriping how I want my dog groomed', 14, 2),
(5, '2023-11-05', '2023-11-25', 'Todd Abraham', '890-098-2343', 0, 'This is descriping how I want my dog groomed', 14, 2),
(6, '2023-11-12', '2023-11-25', 'EmerMan', '888-888-8888', 1, 'I want nails on dogs', 14, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `grooming_reservation`
--
ALTER TABLE `grooming_reservation`
  ADD PRIMARY KEY (`GroomResID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `grooming_reservation`
--
ALTER TABLE `grooming_reservation`
  MODIFY `GroomResID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
