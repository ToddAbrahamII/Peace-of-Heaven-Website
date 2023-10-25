-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2023 at 10:54 PM
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
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CustID` bigint(20) NOT NULL,
  `CustFirstName` varchar(100) NOT NULL,
  `CustLastName` varchar(100) NOT NULL,
  `CustPhone` varchar(20) NOT NULL,
  `CustAddress` varchar(100) NOT NULL,
  `CustState` varchar(100) NOT NULL,
  `CustZip` varchar(100) NOT NULL,
  `AcctEmail` varchar(100) NOT NULL,
  `User_ID` bigint(20) NOT NULL,
  `CustCity` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `Emp_ID` bigint(20) NOT NULL,
  `EmpFirstName` varchar(100) NOT NULL,
  `EmpLastName` varchar(100) NOT NULL,
  `EmpPhone` varchar(100) NOT NULL,
  `EmpAddress` varchar(100) NOT NULL,
  `EmpState` varchar(100) NOT NULL,
  `EmpZip` varchar(100) NOT NULL,
  `User_ID` bigint(20) NOT NULL,
  `AcctEmail` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `family`
--

CREATE TABLE `family` (
  `Family_ID` bigint(20) NOT NULL,
  `Cust_ID` bigint(20) NOT NULL,
  `Dog_ID` bigint(20) NOT NULL,
  `FamilyName` varchar(100) NOT NULL,
  `hasForms` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `ID` bigint(20) NOT NULL,
  `User_ID` bigint(20) NOT NULL,
  `User_Name` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `PermissionLvl` int(11) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`ID`, `User_ID`, `User_Name`, `Password`, `PermissionLvl`, `Date`) VALUES
(6, 64803, 'Cust', '$2y$10$ew7sQdHbOS72a6NUa3rXxOhYWm4tRN4Z51dNms25Bei5YzFOf1Cna', 0, '2023-10-23 01:56:29'),
(7, 9887246346, 'Admin', '$2y$10$e8BEG5bwIbOWSnu0fF474uuEaydTm.nN5MnJCqlwMCLt1At0YbZiq', 2, '2023-10-23 01:56:29'),
(8, 322879, 'Emp', '$2y$10$U7KQs7XvxeFWjBqQixfQEuA5avTHDhgbahJfKK9Q/gUxUizvk/yvu', 1, '2023-10-23 01:56:29'),
(22, 2593134560, 'ToddAbraham', '$2y$10$sMi0yay2g7ciDOmwUkH5V.nHrt8etR/RsUQ2LjichZSFPzlbNHaG.', 0, '2023-10-25 20:47:52'),
(23, 989640, 'Tredcvsdf', '$2y$10$zWGYV67sy5u5ckUNqGL2Hui0DA8Gej/k6pKu6UML2URcUupBTchpi', 0, '2023-10-25 20:49:36'),
(24, 402337, 'Asdfserf', '$2y$10$zIjda1ECvQhA2P/GEZfduOWBhIHf3B5L1oFAB4aCdiDK1eugKVdAa', 0, '2023-10-25 20:54:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CustID`),
  ADD KEY `CustID` (`CustID`),
  ADD KEY `Cust - UserId` (`User_ID`),
  ADD KEY `Cust - AcctEmail` (`AcctEmail`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`Emp_ID`),
  ADD KEY `Employee - UserId` (`User_ID`),
  ADD KEY `Employee - AcctEmail` (`AcctEmail`),
  ADD KEY `Emp_ID` (`Emp_ID`);

--
-- Indexes for table `family`
--
ALTER TABLE `family`
  ADD PRIMARY KEY (`Family_ID`),
  ADD KEY `Family - Cust_ID` (`Cust_ID`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Date` (`Date`),
  ADD KEY `User_ID` (`User_ID`),
  ADD KEY `User_Name` (`User_Name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CustID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `Emp_ID` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `family`
--
ALTER TABLE `family`
  MODIFY `Family_ID` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `Cust - UserId` FOREIGN KEY (`User_ID`) REFERENCES `login` (`User_ID`);

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `Employee - UserId` FOREIGN KEY (`User_ID`) REFERENCES `login` (`User_ID`);

--
-- Constraints for table `family`
--
ALTER TABLE `family`
  ADD CONSTRAINT `Family - Cust_ID` FOREIGN KEY (`Cust_ID`) REFERENCES `customer` (`CustID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
