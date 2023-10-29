-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2023 at 06:11 PM
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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(80) NOT NULL,
  `password` varchar(64) NOT NULL,
  `salt` varchar(32) NOT NULL,
  `joined` datetime NOT NULL,
  `group` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `salt`, `joined`, `group`) VALUES
(19, 'jonathan', 'fc62b864e8ac17d1d91f0611e042ad87d17655f41699a232a31f2ceafabc522f', '073ded09c1ceb28d7b47c5727835a840', '2023-10-28 01:24:56', 1),
(20, 'buttholemgoo', '64c4cb66424af1ae7550a52e0b4f33a3e68c838f2a3e87b4c5c1f25bd0d525da', 'a463f0ec8479ef13eff91ef072fb0d90', '2023-10-28 01:33:52', 1),
(21, 'Todd', 'b6ef5374a32494bdacac20b58b7b981f1ce866f7466391b05ecb0f8e2ef546a7', '7bed61fbde40514919c56d7e0ed7908d', '2023-10-28 01:38:50', 1),
(22, 'LeatherDaddy5', '2385e9f4d4018787a7b9821c4358ea04d06bf5d88437e3c61af60f5cb5471081', '34759a52028b11659b8ea35d294541ae', '2023-10-28 22:58:24', 1),
(23, 'ALLCAPS', 'e096926fc5f1dd8219ce191b146307668d6de20d629bfbc0f6aec25a8d3b2e60', '40d2020bdf5f3b471ff0bd95570fc14b', '2023-10-28 23:00:39', 1),
(24, 'Tabithat', 'e853aee2904db28caf056a31a2b9957bf680782db683c2645c363d8ed06860df', '3069162d646ba43a2184a99d50dde069', '2023-10-28 23:08:42', 1),
(25, 'buttGoblin', '0812d63fdbb675369d1123218e74066be1138074aa0d8a07bc8a41fc002cae6e', '0b9e272e779d0cd7c01593aae36fbbea', '2023-10-29 01:12:04', 1),
(26, 'jon', '7e479f5953223c0efa4a7ed2b454db781371c683887f59797396b6c5955c22c7', '3342c78742728f24f7e53c3cf8e2b97c', '2023-10-29 01:17:31', 1),
(27, 'IamChanged', 'f37dd6008ea1e16a490dc3bc7eb769932e22f2aba7d5908322f192136b1efa3f', '15a31421159fc9e05ff64550d34883a2', '2023-10-29 02:12:36', 1),
(28, 'dingdog', 'ef637f6c3e6a4846964f733a2cbb9509f4b2808d56c12ba16c9e30f034ed6ab1', 'ef777171a2406bb8e5f4e360cc917d60', '2023-10-29 02:27:13', 1),
(30, 'changemypassword', 'a7242898cc53eca302c11dd1c5914e5d63f2c8e564085ae44d241d2ec00b494e', 'cfaefc6aa31be16011e04d3c6169707d', '2023-10-29 02:49:17', 1),
(31, 'admin', 'fafcaba70abd39549b98f30601bd6c331e91b08a3c84d88d7156f7ab32145a8a', '066d6a9d7177ff13633ebc60e002719b', '2023-10-29 02:33:40', 2),


--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
