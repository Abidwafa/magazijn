-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2023 at 12:06 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `storage_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `form`
--

CREATE TABLE `form` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` varchar(150) NOT NULL,
  `serial_number` varchar(50) NOT NULL,
  `lint_out` varchar(10) NOT NULL,
  `to_who` varchar(30) NOT NULL,
  `date_time` text NOT NULL,
  `tested` varchar(10) NOT NULL,
  `by_who` varchar(25) NOT NULL,
  `date_time_tested` text NOT NULL,
  `problem` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `form`
--

INSERT INTO `form` (`id`, `name`, `description`, `serial_number`, `lint_out`, `to_who`, `date_time`, `tested`, `by_who`, `date_time_tested`, `problem`) VALUES
(24, 'khan', 'laptop 2', '22222222222222222', 'No', 'khan', '2023-01-01T14:45', 'No', 'khan', '2023-01-08T13:45', 'sss'),
(25, 'Abid wafa777777777777777', 'laptop 3', '33333333333333', 'Yes', 'khan', '2023-01-03T14:46', 'No', 'khan', '2023-01-02T13:46', 'niks'),
(27, 'wafa', 'laptop 4', '1234536666sssssssssssss', 'No', 'ssssssssssssss', '2023-01-03T13:56', 'No', 'preet', '2023-01-09T13:56', 'sss'),
(29, 'Abid wafa', 'laptop 23', '99999999999999999999', 'Yes', 'ssssssssssssss', '2023-01-02T14:48', 'Yes', 'sss', '2023-01-01T14:48', 'aaaaaaaaaaa'),
(32, 'Abid wafa', 'noord', '1235876541616459', 'Yes', 'khan', '2023-01-02T09:40', 'No', 'sss', '2023-01-02T09:40', 'sss');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `password` varchar(80) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `profile_picture` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `password`, `full_name`, `email`, `is_active`, `profile_picture`) VALUES
(9, 'B.Strijbis', 'T1jDELIJK', 'B.Strijbis', 'B.Strijbis@rocva.nl', 1, '1673513284.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `form`
--
ALTER TABLE `form`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `serial_number` (`serial_number`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `form`
--
ALTER TABLE `form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
