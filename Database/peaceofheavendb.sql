-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2023 at 06:43 PM
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
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `header` varchar(255) NOT NULL,
  `description` varchar(500) NOT NULL,
  `age` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `header`, `description`, `age`, `date`) VALUES
(1, 'Black Friday Deal', 'Cheap Deals For the Holidays', 2, '2023-11-15 21:01:25'),
(2, 'Opening for Boarding on 11/27', 'Reserve Now for a Chance for a Slot', 1, '2023-11-15 21:01:54');

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
  `CustCity` varchar(100) NOT NULL,
  `CustState` varchar(100) NOT NULL,
  `CustZip` varchar(100) NOT NULL,
  `AcctEmail` varchar(100) NOT NULL,
  `User_ID` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustID`, `CustFirstName`, `CustLastName`, `CustPhone`, `CustAddress`, `CustCity`, `CustState`, `CustZip`, `AcctEmail`, `User_ID`) VALUES
(14, 'FirstName', 'LastName', '9999999999', '123 Customer St.', 'Cust City', 'CI', '89988', 'Customer@tester.com', 20),
(18, 'Top', 'Dawg', '6966966969', 'Admin', 'Admin', 'AD', '69696', 'topdwg@admin', 23),
(20, 'Employee', 'Account', '9999999999', 'Employee', 'Emp', 'EM', '55555', 'employe@POH.com', 31);

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
  `HasForms` tinyint(1) NOT NULL DEFAULT 0,
  `DogOtherInfo` varchar(500) NOT NULL,
  `CustID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dog`
--

INSERT INTO `dog` (`DogID`, `DogName`, `Breed`, `DogDOB`, `Sex`, `isFixed`, `Weight`, `Color`, `HasForms`, `DogOtherInfo`, `CustID`) VALUES
(1, 'Sherman', 'Lab', '2004-10-15', 'M', 1, 75, 'Yellow', 1, '', 14),
(2, 'Zeva', 'Mutt', '2005-05-05', 'F', 1, 50, 'Black', 1, '', 14);

-- --------------------------------------------------------

--
-- Table structure for table `dogbehavior`
--

CREATE TABLE `dogbehavior` (
  `BehaviorID` int(11) NOT NULL,
  `Experience` int(5) NOT NULL,
  `IsSocial` tinyint(1) NOT NULL,
  `IsAggressive` tinyint(1) NOT NULL,
  `AggressiveDesc` varchar(500) DEFAULT NULL,
  `IsJumper` tinyint(1) NOT NULL,
  `IsClimber` tinyint(1) NOT NULL,
  `IsChewer` tinyint(1) NOT NULL,
  `IsEscapeArtist` tinyint(1) NOT NULL,
  `EscapeDesc` varchar(500) DEFAULT NULL,
  `CanWater` tinyint(1) NOT NULL,
  `CanTreat` tinyint(1) NOT NULL,
  `IsRestriction` tinyint(1) NOT NULL,
  `RestrictionDesc` varchar(500) DEFAULT NULL,
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
-- Dumping data for table `dogbehavior`
--

INSERT INTO `dogbehavior` (`BehaviorID`, `Experience`, `IsSocial`, `IsAggressive`, `AggressiveDesc`, `IsJumper`, `IsClimber`, `IsChewer`, `IsEscapeArtist`, `EscapeDesc`, `CanWater`, `CanTreat`, `IsRestriction`, `RestrictionDesc`, `Toys`, `OtherBehaviorInfo`, `Reinforce`, `Commands`, `IsLeashTrained`, `FoodPref`, `BathroomRoutine`, `DogID`) VALUES
(1, 0, 0, 1, 'na', 1, 1, 1, 1, 'na', 1, 1, 1, 'na', 'na', 'na', 'na', 'na', 1, 'na', 'na', 2),
(2, 0, 0, 1, 'na', 1, 1, 1, 1, 'na', 1, 1, 1, 'na', 'na', 'na', 'na', 'na', 1, 'na', 'na', 2);

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
-- Dumping data for table `doghealth`
--

INSERT INTO `doghealth` (`HealthID`, `ClinicName`, `VetAddress`, `VetCity`, `VetState`, `VetZip`, `VetPhone`, `VetName`, `MedicalCond`, `Medication`, `DogID`) VALUES
(1, 'klj', 'kkkl', 'jlk', 'jk', 99999, '9999', 'kdsjflk', 'jlkjkl', 'kljjljk', 2),
(2, 'klj', 'kkkl', 'jlk', 'jk', 99999, '9999', 'kdsjflk', 'jlkjkl', 'kljjljk', 2);

-- --------------------------------------------------------

--
-- Table structure for table `dogvaccine`
--

CREATE TABLE `dogvaccine` (
  `VacID` int(11) NOT NULL,
  `DHPP_Date` date NOT NULL,
  `RabiesDate` date NOT NULL,
  `BordellaDate` date NOT NULL,
  `FleaTickProduct` varchar(100) NOT NULL,
  `FleaTickDate` date NOT NULL,
  `OtherVacInfo` varchar(500) DEFAULT NULL,
  `DogID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dogvaccine`
--

INSERT INTO `dogvaccine` (`VacID`, `DHPP_Date`, `RabiesDate`, `BordellaDate`, `FleaTickProduct`, `FleaTickDate`, `OtherVacInfo`, `DogID`) VALUES
(1, '2222-12-05', '2009-06-07', '2023-11-07', 'yum', '2023-11-29', 'sdada', 2);

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
  `isFinished` tinyint(1) NOT NULL DEFAULT 0,
  `CustID` int(11) NOT NULL,
  `DogID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grooming_reservation`
--

INSERT INTO `grooming_reservation` (`GroomResID`, `ResStartDate`, `ResEndDate`, `EmerContact`, `EmerPhone`, `isApproved`, `GroomingDesc`, `isFinished`, `CustID`, `DogID`) VALUES
(2, '2023-11-05', '2023-11-18', 'Customer', '999-888-7777', 1, 'This is a description', 0, 14, 2),
(3, '2023-10-29', '2023-10-31', 'Customer3', '5555555555', 1, 'Shave them', 0, 14, 1),
(4, '2023-11-30', '2023-11-30', 'Customer4', '890-098-2343', 1, 'This is descripting how I want my dog groomed', 0, 14, 2),
(6, '2023-11-12', '2023-11-25', 'EmerMan', '888-888-8888', 0, 'I want nails on dogs', 0, 14, 2);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `permissions` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `permissions`) VALUES
(2, 'Standard user', ''),
(3, 'Administrator', '{\"admin\": 1}');

-- --------------------------------------------------------

--
-- Table structure for table `kennel`
--

CREATE TABLE `kennel` (
  `KennelID` int(11) NOT NULL,
  `KennelName` varchar(255) NOT NULL,
  `isOccupied` tinyint(1) NOT NULL,
  `isBoarding` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kennel`
--

INSERT INTO `kennel` (`KennelID`, `KennelName`, `isOccupied`, `isBoarding`) VALUES
(5, 'DC1', 1, 0),
(6, 'DC2', 0, 0),
(7, 'DC3', 0, 0),
(8, 'DC4', 0, 0),
(9, 'DC5', 0, 0),
(10, 'BK1', 0, 1),
(12, 'BK2', 0, 1),
(13, 'BK3', 0, 1),
(14, 'BK4', 0, 1),
(15, 'BK5', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `Res_ID` int(11) NOT NULL,
  `ResStartTime` date NOT NULL,
  `ResEndTime` date NOT NULL,
  `EmerContact` varchar(255) NOT NULL,
  `EmerPhone` varchar(12) NOT NULL,
  `isCheckedIn` tinyint(1) NOT NULL,
  `ServiceType` text NOT NULL,
  `isApproved` tinyint(1) NOT NULL,
  `ResDesc` varchar(500) NOT NULL,
  `isFinished` tinyint(1) NOT NULL,
  `CustID` int(11) NOT NULL,
  `DogID` int(11) NOT NULL,
  `KennelID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`Res_ID`, `ResStartTime`, `ResEndTime`, `EmerContact`, `EmerPhone`, `isCheckedIn`, `ServiceType`, `isApproved`, `ResDesc`, `isFinished`, `CustID`, `DogID`, `KennelID`) VALUES
(2, '2023-11-30', '2023-11-30', 'Todd', '999-999-9999', 1, 'Daycare', 1, 'Description', 1, 14, 1, 2),
(3, '2023-11-15', '2023-11-23', 'Emer', '999-999-9999', 1, 'Boarding', 1, 'Reservations', 1, 14, 1, 3),
(4, '2023-11-22', '2023-11-26', 'dsas', '9999', 1, 'Boarding', 1, 'asdfasdfa', 1, 14, 2, 1),
(5, '2023-11-17', '2023-11-17', 'Bobby Joe', '999-999-9999', 1, 'Daycare', 1, 'Description YO', 1, 14, 1, 3),
(6, '2023-11-29', '2023-12-09', 'Contact for Emergency', '123-456-7890', 1, 'Boarding', 1, 'I am leaving for Vacation', 1, 14, 1, 6),
(7, '2023-11-17', '2023-11-18', 'Emergency Contact', '123-456-7890', 1, 'Boarding', 1, 'Out of Town for the Week', 0, 14, 1, 5),
(8, '2023-11-27', '2023-11-27', 'Contact', '345-678-9099', 0, 'Daycare', 1, 'Dr Appointment this Day', 0, 14, 1, 0),
(9, '2023-12-09', '2023-12-09', 'Emergency Guy', '456-777-8788', 1, 'Daycare', 1, 'Gone for Day', 1, 14, 1, 5),
(10, '2023-11-20', '2023-11-20', 'EmerMan', '999999999', 0, 'Daycare', 0, 'Description, Description and Description', 0, 14, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(80) NOT NULL,
  `password` varchar(64) NOT NULL,
  `salt` varchar(32) NOT NULL,
  `joined` datetime NOT NULL,
  `isComplete` tinyint(1) NOT NULL DEFAULT 0,
  `group` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `salt`, `joined`, `isComplete`, `group`) VALUES
(20, 'Todd1200', '8a429dc7b839832e0cec672ba44ee2f112964701f45d022ed6ac9631a1fedd47', 'faa8def326700b37f9e8874b25ef5944', '2023-10-30 03:15:12', 1, 1),
(23, 'TopDAWG', '1b40c97090b9255194d31de7f0a34b0299b9b2a077df42ea59e9721015d1995a', '1f5fde3ed114f4969efc6145158f8049', '2023-10-30 21:10:51', 1, 3),
(31, 'Employee', '5b762d6422cae8c0e4f28cb9b3a39952668b6db36047ea7b359e9c1231a527ef', 'abc27c311fdbc0dcd03e84951cc05a72', '2023-11-15 01:32:39', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users_session`
--

CREATE TABLE `users_session` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hash` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CustID`),
  ADD KEY `CustID` (`CustID`),
  ADD KEY `Cust - UserId` (`User_ID`);

--
-- Indexes for table `dog`
--
ALTER TABLE `dog`
  ADD PRIMARY KEY (`DogID`),
  ADD KEY `CustID` (`CustID`);

--
-- Indexes for table `dogbehavior`
--
ALTER TABLE `dogbehavior`
  ADD PRIMARY KEY (`BehaviorID`),
  ADD KEY `DogID` (`DogID`);

--
-- Indexes for table `doghealth`
--
ALTER TABLE `doghealth`
  ADD PRIMARY KEY (`HealthID`),
  ADD KEY `DogID` (`DogID`);

--
-- Indexes for table `dogvaccine`
--
ALTER TABLE `dogvaccine`
  ADD PRIMARY KEY (`VacID`),
  ADD KEY `DogID` (`DogID`);

--
-- Indexes for table `grooming_reservation`
--
ALTER TABLE `grooming_reservation`
  ADD PRIMARY KEY (`GroomResID`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kennel`
--
ALTER TABLE `kennel`
  ADD PRIMARY KEY (`KennelID`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`Res_ID`),
  ADD KEY `CustID` (`CustID`),
  ADD KEY `DogID` (`DogID`),
  ADD KEY `KennelID` (`KennelID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_session`
--
ALTER TABLE `users_session`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CustID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `dog`
--
ALTER TABLE `dog`
  MODIFY `DogID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `dogbehavior`
--
ALTER TABLE `dogbehavior`
  MODIFY `BehaviorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `doghealth`
--
ALTER TABLE `doghealth`
  MODIFY `HealthID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `dogvaccine`
--
ALTER TABLE `dogvaccine`
  MODIFY `VacID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `grooming_reservation`
--
ALTER TABLE `grooming_reservation`
  MODIFY `GroomResID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kennel`
--
ALTER TABLE `kennel`
  MODIFY `KennelID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `Res_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users_session`
--
ALTER TABLE `users_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
