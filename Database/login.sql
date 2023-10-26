-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2023 at 03:58 PM
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
(8, 322879, 'Emp', '$2y$10$U7KQs7XvxeFWjBqQixfQEuA5avTHDhgbahJfKK9Q/gUxUizvk/yvu', 1, '2023-10-23 01:56:29');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
