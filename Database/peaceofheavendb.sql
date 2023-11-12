-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2023 at 06:44 PM
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
-- Table structure for table `boarding_booking`
--

CREATE TABLE `boarding_booking` (
  `booking_id` int(11) NOT NULL,
  `TS_ID` int(11) NOT NULL,
  `Res_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(14, 'Customer', 'Tester', '9999999999', 'CustomerSt', 'tester', 'CUST', '89988', 'Customer@tester.om', 20),
(18, 'Top', 'DAWG', '6966966969', 'TOP DAWG Street', 'Top of the food chain', 'NY', '69696', 'topDAWG@yourmom', 23),
(19, 'Customer', 'Custy', '9999999999', 'Customer ST', 'CustCity', 'CU', '99999', 'customer@poh.com', 30);

-- --------------------------------------------------------

--
-- Table structure for table `daycare_booking`
--

CREATE TABLE `daycare_booking` (
  `booking_id` int(11) NOT NULL,
  `TS_ID` int(11) NOT NULL,
  `Res_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 'sherman', 'lab', '2004-10-15', 'M', 1, 75, 'yellow', 1, '', 14),
(2, 'zeva', 'mutt', '2005-05-05', 'F', 1, 50, 'black', 0, '', 14),
(3, 'Timmy', 'Pitbull', '2020-08-09', 'M', 1, 78, 'Brown', 0, 'He will bite you', 19);

-- --------------------------------------------------------

--
-- Table structure for table `dogbehavior`
--

CREATE TABLE `dogbehavior` (
  `BehaviorID` int(11) NOT NULL,
  `Experience` int(5) NOT NULL,
  `IsSocial` tinyint(1) NOT NULL,
  `IsAggressive` tinyint(1) NOT NULL,
  `AggressiveDesc` varchar(500) NOT NULL,
  `IsJumper` tinyint(1) NOT NULL,
  `IsClimber` tinyint(1) NOT NULL,
  `IsChewer` tinyint(1) NOT NULL,
  `IsEscapeArtist` tinyint(1) NOT NULL,
  `EscapeDesc` varchar(500) NOT NULL,
  `CanWater` tinyint(1) NOT NULL,
  `CanTreat` tinyint(1) NOT NULL,
  `IsRestriction` tinyint(1) NOT NULL,
  `RestrictionDesc` varchar(500) NOT NULL,
  `Toys` varchar(500) NOT NULL,
  `OtherBehaviorInfo` varchar(500) NOT NULL,
  `Reinforce` varchar(500) NOT NULL,
  `Commands` varchar(500) NOT NULL,
  `IsLeashTrained` tinyint(1) NOT NULL,
  `FoodPref` varchar(500) NOT NULL,
  `BathroomRoutine` varchar(500) NOT NULL,
  `DogID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doghealth`
--

CREATE TABLE `doghealth` (
  `HealthID` int(11) NOT NULL,
  `VetAddress` varchar(40) NOT NULL,
  `VetCity` varchar(30) NOT NULL,
  `VetState` varchar(2) NOT NULL,
  `VetZip` int(5) NOT NULL,
  `VetPhone` varchar(10) NOT NULL,
  `VetName` varchar(30) NOT NULL,
  `Allergies` varchar(255) NOT NULL,
  `MedicalCond` varchar(255) NOT NULL,
  `Impairments` varchar(255) NOT NULL,
  `OtherHealthInfo` varchar(500) NOT NULL,
  `DogID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dogvaccine`
--

CREATE TABLE `dogvaccine` (
  `VacID` int(11) NOT NULL,
  `DHPP_Date` date NOT NULL,
  `RabiesDate` date NOT NULL,
  `BordellaDate` date NOT NULL,
  `HasFleaTick` tinyint(1) NOT NULL,
  `FleaTickDate` date NOT NULL,
  `OtherVacInfo` varchar(500) NOT NULL,
  `DogID` int(11) NOT NULL
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
  `EmpCity` varchar(100) NOT NULL,
  `EmpState` varchar(100) NOT NULL,
  `EmpZip` varchar(100) NOT NULL,
  `AcctEmail` varchar(100) NOT NULL,
  `User_ID` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(2, '2023-11-05', '2023-11-18', 'Todd Abraham', '999', 1, 'This is a description', 14, 2),
(3, '2023-10-29', '2023-10-31', 'Todd Abraham', '5555555555', 1, 'Descriptinnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnn', 14, 1),
(4, '2023-11-05', '2023-11-25', 'Todd Abraham', '890-098-2343', 0, 'This is descriping how I want my dog groomed', 14, 2),
(5, '2023-11-05', '2023-11-25', 'Todd Abraham', '890-098-2343', 0, 'This is descriping how I want my dog groomed', 14, 2),
(6, '2023-11-12', '2023-11-25', 'EmerMan', '888-888-8888', 1, 'I want nails on dogs', 14, 2),
(7, '2023-11-26', '2023-12-02', 'Timmy\s Mom', '888-888-8888', 0, 'Timmy needs all of his teeth removed, he bites aggressively', 19, 3);

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
  `isOccupied` tinyint(1) NOT NULL,
  `isBoarding` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `Res_ID` int(11) NOT NULL,
  `ResStartTime` date NOT NULL,
  `ResEndTime` date NOT NULL,
  `EmerContact` text NOT NULL,
  `EmerPhone` varchar(12) NOT NULL,
  `isCheckedIn` tinyint(1) NOT NULL,
  `ServiceType` text NOT NULL,
  `isApproved` tinyint(1) NOT NULL,
  `ResDesc` varchar(500) NOT NULL,
  `CustID` int(11) NOT NULL,
  `DogID` int(11) NOT NULL,
  `KennelID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`Res_ID`, `ResStartTime`, `ResEndTime`, `EmerContact`, `EmerPhone`, `isCheckedIn`, `ServiceType`, `isApproved`, `ResDesc`, `CustID`, `DogID`, `KennelID`) VALUES
(1, '0000-00-00', '0000-00-00', '', '', 0, 'Grooming', 0, '', 14, 1, 0),
(2, '2023-11-30', '2023-11-30', 'Todd', '999-999-9999', 0, 'Daycare', 0, 'Description', 14, 1, 0),
(3, '2023-11-15', '2023-11-23', 'Emer', '999-999-9999', 0, 'Boarding', 0, 'Reservations', 14, 1, 0),
(4, '2023-11-22', '2023-11-26', 'dsas', '9999', 0, 'Boarding', 0, 'asdfasdfa', 14, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `timeslot`
--

CREATE TABLE `timeslot` (
  `TS_ID` int(11) NOT NULL,
  `booking_max` int(11) NOT NULL,
  `booking_count` int(11) NOT NULL,
  `TS_date` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(27, 'Account', 'd968207c5e0108b528be3a6f4b3279756f13003e9417b6034ac4badf40893b8f', '49ab991111b0f79ee5ff9c564c8de49d', '2023-11-10 16:37:40', 1, 2),
(28, 'Account2', '6dc6ffa45289c0b6c9efc543f4ddf78356004e5bde7408abab8736595b1ce434', 'e649e320ba47ecb26d7c1bc29595fae3', '2023-11-10 16:37:48', 1, 2),
(29, 'JonEmp', 'b04a879e662bf9d1375c2237d46b5567eb94e83a7af489c307e483528bf28455', '0ffac163ef7a87421b4bbbcdf1dfc6f1', '2023-11-10 17:40:21', 1, 2),
(30, 'Customer', '6945bc6aeeca2fc26191a4609ca8a8ce4876efd05242cde70150494e1e8495d8', '17fc7a81bebc4fb1b2ba850118ae69dc', '2023-11-10 20:29:41', 1, 1);

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
-- Indexes for table `boarding_booking`
--
ALTER TABLE `boarding_booking`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `TS_ID` (`TS_ID`),
  ADD KEY `Res_ID` (`Res_ID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CustID`),
  ADD KEY `CustID` (`CustID`),
  ADD KEY `Cust - UserId` (`User_ID`);

--
-- Indexes for table `daycare_booking`
--
ALTER TABLE `daycare_booking`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `TS_ID` (`TS_ID`),
  ADD KEY `Res_ID` (`Res_ID`);

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
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`Emp_ID`),
  ADD KEY `Emp_ID` (`Emp_ID`),
  ADD KEY `User_ID` (`User_ID`);

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
-- Indexes for table `timeslot`
--
ALTER TABLE `timeslot`
  ADD PRIMARY KEY (`TS_ID`),
  ADD KEY `booking_id` (`booking_id`);

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
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CustID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `dog`
--
ALTER TABLE `dog`
  MODIFY `DogID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `dogbehavior`
--
ALTER TABLE `dogbehavior`
  MODIFY `BehaviorID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doghealth`
--
ALTER TABLE `doghealth`
  MODIFY `HealthID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dogvaccine`
--
ALTER TABLE `dogvaccine`
  MODIFY `VacID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `Emp_ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `Res_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users_session`
--
ALTER TABLE `users_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
