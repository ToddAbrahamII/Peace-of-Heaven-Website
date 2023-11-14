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
-- Table structure for table `dogbehavior`
--

CREATE TABLE `dogbehavior` (

  `BehaviorID` int(11) NOT NULL,
  `Experience` int(5) NOT NULL,
  `IsSocial` tinyint(1) NOT NULL,
  `IsAggressive` tinyint(1) NOT NULL,
  `AggressiveDesc` varchar(500),
  `IsJumper` tinyint(1) NOT NULL,
  `IsClimber` tinyint(1) NOT NULL,
  `IsChewer` tinyint(1) NOT NULL,
  `IsEscapeArtist` tinyint(1) NOT NULL,
  `EscapeDesc` varchar(500),
  `CanWater` tinyint(1) NOT NULL,
  `CanTreat` tinyint(1) NOT NULL,
  `IsRestriction` tinyint(1) NOT NULL,
  `RestrictionDesc` varchar(500),
  `Toys` varchar(500) NOT NULL,
  `OtherBehaviorInfo` varchar(500) NOT NULL,
  `Reinforce` varchar(500) NOT NULL,
  `Commands` varchar(500) NOT NULL,
  `IsLeashTrained` tinyint(1) NOT NULL,
  `FoodPref` varchar(500) NOT NULL,
  `BathroomRoutine` varchar(500) NOT NULL,
  `DogID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dogbehavior`
--
ALTER TABLE `dogbehavior`
  ADD PRIMARY KEY (`BehaviorID`),
  ADD KEY `DogID` (`DogID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dogbehavior`
--
ALTER TABLE `dogbehavior`
  MODIFY `BehaviorID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
