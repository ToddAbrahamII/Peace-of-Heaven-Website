-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2023 at 12:42 AM
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
-- Database: `lr`
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
  `name` varchar(50) NOT NULL,
  `joined` datetime NOT NULL,
  `group` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `salt`, `name`, `joined`, `group`) VALUES
(14, 'user1', 'ab3034a846486b9dcd5f729b0e98fa68a9ee8c1007d43d98c8ed16e7bb1efa2e', 'bb0167570f109cac1281825e56ecce8c', 'a1', '2023-10-27 03:16:32', 1),
(15, 'user2', '27e8ee125ef577dfb617c6db40ad1f67357410b4a299eca6a9c1257acea2003d', '06ff38be0674c4a228398ac4f955606c', 'a2', '2023-10-27 03:16:45', 1),
(16, 'ashley', 'aa552ceaef5cc41486a9b0befca83d3ae4ad3b6e413551cf3cb100da8f19afe4', 'dc884c8b071930f8630e4f4b4eb997c1', 'garrett', '2023-10-27 04:09:34', 1),
(17, 'user4', 'ea7e4ba33ceb33c174a478405b499d99305551fbae8d05ab3830b306dc96efae', '5175a961435abb6afc175dd5a851e7ce', 'a55', '2023-10-27 04:17:06', 1),
(18, 'todd', '758a595575f444aeef178c712ae4c6a670c330b41f806c69e7c430550a279746', 'bd9e583500598345af2b50292cac457e', 'todd', '2023-10-27 16:34:32', 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
