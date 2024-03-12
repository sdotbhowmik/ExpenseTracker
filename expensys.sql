-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2024 at 08:58 AM
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
-- Database: `expensys`
--

-- --------------------------------------------------------

--
-- Table structure for table `signup_details`
--

CREATE TABLE `signup_details` (
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `signup_details`
--

INSERT INTO `signup_details` (`name`, `username`, `email`, `password`, `id`) VALUES
('Subrata', 'admin', 'sdotbhowmik@gmail.com', '12345678', 1);

-- --------------------------------------------------------

--
-- Table structure for table `track_expense`
--

CREATE TABLE `track_expense` (
  `id` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `credit` int(10) NOT NULL,
  `debit` int(10) NOT NULL,
  `description` varchar(250) NOT NULL,
  `ddate` date NOT NULL,
  `balance` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `track_expense`
--

INSERT INTO `track_expense` (`id`, `username`, `credit`, `debit`, `description`, `ddate`, `balance`) VALUES
(1, 'admin', 10000, 0, 'test', '2024-03-12', 10000),
(2, 'admin', 0, 1400, 'jeans', '2024-03-12', 8600),
(3, 'admin', 0, 600, 't-shirt', '2024-03-12', 8000),
(4, 'admin', 1900, 0, 'loan', '2024-03-12', 9900),
(5, 'admin', 0, 900, 'food bill', '2024-03-12', 9000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `signup_details`
--
ALTER TABLE `signup_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `track_expense`
--
ALTER TABLE `track_expense`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `signup_details`
--
ALTER TABLE `signup_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `track_expense`
--
ALTER TABLE `track_expense`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
