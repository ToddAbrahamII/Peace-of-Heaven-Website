-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2023 at 10:51 PM
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
(15, 'Customer', 'Tester', '9999999999', 'CustomerSt', 'tester', 'CUST', '89988', 'Customer@tester.om', 21),
(16, 'Customer', 'Tester', '9999999999', 'CustomerSt', 'tester', 'CUST', '89988', 'Customer@tester.om', 20),
(17, 'Jon', 'Jon', '8888888888', 'JOn', 'jon', 'jon', '13456', 'jonjon@jonjon', 22),
(18, 'Top', 'DAWG', '6966966969', 'TOP DAWG Street', 'Top of the food chain', 'NY', '69696', 'topDAWG@yourmom', 23);

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
  `DogOtherInfo` varchar(500) NOT NULL,
  `CustID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `grooming_booking`
--

CREATE TABLE `grooming_booking` (
  `booking_id` int(11) NOT NULL,
  `Res_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `CustID` int(11) NOT NULL,
  `DogID` int(11) NOT NULL,
  `KennelID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(14, 'user1', 'ab3034a846486b9dcd5f729b0e98fa68a9ee8c1007d43d98c8ed16e7bb1efa2e', 'bb0167570f109cac1281825e56ecce8c', '2023-10-27 03:16:32', 0, 1),
(15, 'user2', '27e8ee125ef577dfb617c6db40ad1f67357410b4a299eca6a9c1257acea2003d', '06ff38be0674c4a228398ac4f955606c', '2023-10-27 03:16:45', 0, 1),
(16, 'ashley', 'aa552ceaef5cc41486a9b0befca83d3ae4ad3b6e413551cf3cb100da8f19afe4', 'dc884c8b071930f8630e4f4b4eb997c1', '2023-10-27 04:09:34', 0, 1),
(17, 'user4', 'ea7e4ba33ceb33c174a478405b499d99305551fbae8d05ab3830b306dc96efae', '5175a961435abb6afc175dd5a851e7ce', '2023-10-27 04:17:06', 0, 1),
(18, 'todd', '758a595575f444aeef178c712ae4c6a670c330b41f806c69e7c430550a279746', 'bd9e583500598345af2b50292cac457e', '2023-10-27 16:34:32', 0, 1),
(19, 'Todd45', '10136cbb75a11682d12daa4f4a47e824905260f3558f935fde9121cb9a82985b', '1e19e3525c9515cf11499292642174f7', '2023-10-29 03:13:34', 0, 1),
(20, 'Todd1200', '8a429dc7b839832e0cec672ba44ee2f112964701f45d022ed6ac9631a1fedd47', 'faa8def326700b37f9e8874b25ef5944', '2023-10-30 03:15:12', 1, 1),
(21, 'Customer', '26e8174eac055a748d6f8c27254fc83725c21e23b056c660b4a9ecfec0e85251', '45faf6610fa7d80f192e7fe01fefba86', '2023-10-30 03:25:29', 1, 1),
(22, 'JonLones', 'be1c17ef0da4d06e60224a177a0966846ec3c01454c2f6053db827f5d228acba', 'dce8de4be8c41d8e19dd9a365265a1f4', '2023-10-30 03:46:11', 1, 1),
(23, 'TopDAWG', '1b40c97090b9255194d31de7f0a34b0299b9b2a077df42ea59e9721015d1995a', '1f5fde3ed114f4969efc6145158f8049', '2023-10-30 21:10:51', 1, 3);

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
-- Indexes for table `grooming_booking`
--
ALTER TABLE `grooming_booking`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `Res_ID` (`Res_ID`);

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
  MODIFY `CustID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `dog`
--
ALTER TABLE `dog`
  MODIFY `DogID` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users_session`
--
ALTER TABLE `users_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
