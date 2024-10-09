-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2024 at 01:02 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ride_hailing`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `motorcycles`
--

CREATE TABLE `motorcycles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `motor_registration` varchar(50) DEFAULT NULL,
  `motor_type` varchar(50) DEFAULT NULL,
  `motor_color` varchar(50) DEFAULT NULL,
  `motor_model` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `motorcycles`
--

INSERT INTO `motorcycles` (`id`, `user_id`, `motor_registration`, `motor_type`, `motor_color`, `motor_model`) VALUES
(1, 2, '', '', '', ''),
(2, 4, '', '', '', ''),
(3, 7, 'eqwew', 'wdsx', 'sad', 'ds'),
(4, 8, 'eqwew', 'wdsx', 'sad', 'ds'),
(5, 10, 'eqwew', 'wdsx', 'sad', 'ds'),
(6, 11, 'eqwew', 'wdsx', 'sad', 'ds'),
(7, 13, 'Rf19', 'ag', 'black', 'cabege'),
(8, 18, 'Rf19', 'AGS', 'yellow', 'cabege');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `age` varchar(10) DEFAULT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `user_type` enum('passenger','motorcyclist') DEFAULT NULL,
  `national_id` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `language` varchar(20) DEFAULT NULL,
  `emergency_contact` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `referral_code` varchar(50) DEFAULT NULL,
  `two_factor` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `age`, `sex`, `user_type`, `national_id`, `address`, `language`, `emergency_contact`, `email`, `password`, `profile_picture`, `referral_code`, `two_factor`, `created_at`) VALUES
(1, 'IMANISHIMWE', 'Olivier', '18-25', 'male', 'passenger', '12002800407828', 'Rubavu/Gisenyi/Mbugangali', 'en', '0789392288', 'imanishimwe042@gmail.com', '$2y$10$jn2OxRzbOAunjyAjn19d3OvnEAv6Z0.9LmgKEajP7.UOz3.Ie5SyO', 'Screenshot (2).png', '', 1, '2024-09-20 05:43:17'),
(2, 'KAMANZI', 'Jordan', '18-25', 'male', 'motorcyclist', '12002800407828', 'Rubavu/Gisenyi/Mbugangali', 'fr', '0789392288', 'jordan@gmail.com', '$2y$10$ekVyjzX5pDlIbFOkSLiPtOSm3QV1C/H5AMTZ45hQfngxOdN6RO13K', 'Screenshot (3).png', '', 0, '2024-09-20 05:45:00'),
(3, 'IMANISHIMWE', 'Olivier', '18-25', 'male', 'passenger', '12002800407828', 'Rubavu/Gisenyi/Mbugangali', 'en', '0789392288', 'imanishimwe042@gmail.com', '$2y$10$C4neb7bVjBYCg6uBmP01Eu7KuqEhekVdC2Z7vVXpCzmy.6EDeFqP2', 'Screenshot (2).png', '', 0, '2024-09-20 05:47:03'),
(4, 'KAMANZI', 'Jordan', '18-25', 'male', 'motorcyclist', '12002800407828', 'Rubavu/Gisenyi/Mbugangali', 'fr', '0789392288', 'jordan@gmail.com', '$2y$10$9HFyl8khIdYDhyQdyfdCVewp9l9fYmlmDNGpaltk5qnHg3eQOZi7i', 'Screenshot (3).png', '', 0, '2024-09-20 05:49:35'),
(5, 'IMANISHIMWE', 'Olivier', '18-25', 'male', 'passenger', '12002800407828', 'Rubavu/Gisenyi/Mbugangali', 'en', '0789392288', 'olivier@gmail.com', '$2y$10$I7S14Vgxn04tm/DSUrFT9OOVURhkko8P7ICyEnadu8SpXiHEwl8yS', 'Screenshot (2).png', '123', 1, '2024-09-20 06:00:28'),
(6, 'IMANISHIMWE', 'Olivier', '18-25', 'male', 'passenger', '12002800407828', 'Rubavu/Gisenyi/Mbugangali', 'en', '0789392288', 'olivier@gmail.com', '$2y$10$zM/7a4cX9.nKxpLj9Bj5Yez/hfR9usWiVQpRkTh5lESGte1Cc6dwS', 'Screenshot (2).png', '123', 1, '2024-09-20 06:00:35'),
(7, 'lllllllllllllllll,,,,,,,,,,,,,,', 'erghg', '12', 'Male', '', '12345678', 'asdfhjkl', 'kiny', 'asdfg', 'imanishimeolivier@gmail.com', '$2y$10$7wucxhhcClvTujg3LwvjV.HMWPC9gajFFRVP6jpS07qeI.3qvV00a', '000.png', '432', 1, '2024-09-20 10:45:45'),
(8, 'mkugdas', 'dsas', '18-25', 'male', 'motorcyclist', 'ssdsd', 'asd', 'en', '0789392288', 'kan@gmail.com', '$2y$10$e/jxmb.uzGkizTrQnJNKqOYHrLePp45Sh9nvKUOl49kVBqTi5iiXW', 'g1.png', '432', 1, '2024-09-20 10:46:01'),
(9, 'MANISH', 'Jordan', '18-25', 'male', 'passenger', '12002800407828', 'HUYE/NGOMA', 'en', '0789392288', 'manish@gmail.com', '$2y$10$gU.57J8AeyWOq/GVdmu8Auiveje0p4ZYbaujVTyliHqChfDanxquK', 'g1.png', '432', 0, '2024-09-21 05:49:52'),
(10, 'IMANISHIMWE', 'Jordan', '18-25', 'male', 'motorcyclist', '12002800407828', 'Rubavu/Gisenyi/Mbugangali', 'rw', '0789392288', 'olvierog@gmail.com', '$2y$10$LEPU2PeH.R8Ze11gAJbTGOgNt1gGE.UPHo6rvY29hfTtRnLpFrsaa', 'g1.png', '', 0, '2024-09-21 05:53:13'),
(11, 'IMANISHIMWE', 'Jordan', '18-25', 'male', 'motorcyclist', '12002800407828', 'Rubavu/Gisenyi/Mbugangali', 'rw', '0789392288', 'olvierog@gmail.com', '$2y$10$cViRFiIJZwf0q6FJMvcrfuHiKF93qoZiAYa21eKkmXxUoUYKdK0oy', 'g1.png', '', 0, '2024-09-21 05:56:24'),
(12, 'kamoso', 'jire', '18-25', 'male', 'passenger', '12002800407828', 'Rubavu/Gisenyi/Mbugangali', 'en', '0789392288', 'olvierog1@gmail.com', '$2y$10$Fuaf2HTtu5z9zZpmyUyjmOb1sSBhyk8mZpyR4tGNQmAsWz7jU2VSK', '000.png', '432', 1, '2024-09-21 06:09:15'),
(13, 'MUGISHA ', 'Herve', '18-25', 'male', 'motorcyclist', '12002800407828', 'HUYE/NGOMA', 'en', '0790098152', 'herv@gmail.com', '$2y$10$ocWihPxMNjiCmJIGGe/Jxu9I.3md690icGgMYBzOmI6q/uEVJ3ZRu', 'g0000.png', '65', 1, '2024-09-21 06:43:56'),
(14, 'BYIRINGIRO ', 'Simplice', '18-25', 'male', 'passenger', '12002800407828', 'Ngoma/Kibungo/karenge', 'en', '0794904340', 'simlice@gmail.com', '$2y$10$ZLkLmImCDXeDl8l..i/Sdeqm3Aogr9W97QnWczE83.V2ED.cDaJwi', 'g777.png', '54', 1, '2024-09-21 06:54:47'),
(15, 'IMANISHIMWE', 'Olivier', '18-25', 'male', 'passenger', '12002800407828', 'Rubavu/Gisenyi/Mbugangali', 'en', '0794904340', 'kamanzi@gamil.com', '$2y$10$OVENWkkIUz2TrBqSChdH5uqJ3m7ENcAOBLECKZjXNuNz.N8JpoyTS', 'g1.png', '434', 1, '2024-09-21 07:23:18'),
(16, 'IMANISHIMWE', 'Jordan', '18-25', 'male', 'passenger', '12002800407828', 'Rubavu/Gisenyi/Mbugangali', 'en', '0789392288', 'gg@gmail.com', '$2y$10$0v3o7xgtURutohewf/0dXeoAD/RdSF5sVbKa0yXhpzhTTLD6/BHZu', 'g2.png', NULL, 1, '2024-09-21 07:35:30'),
(17, 'IMANISHIMWE', 'Jordan', '18-25', 'male', 'passenger', '12002800407828', 'Rubavu/Gisenyi/Mbugangali', 'en', '0789392288', 'ee@gmail.com', '$2y$10$xWQKfduIer1kcqd07pTcLO5cSSSNOu8ywglFFQ7HqYuMupsonNjMW', 'g22222.png', '09', 1, '2024-09-21 07:51:07'),
(18, 'SHUKURU ', 'Stephenia', '18-25', 'female', 'motorcyclist', '12002800407828', 'RUBAVU/RUBAVU/KARUKONGO', 'en', '0789392288', 'shukuru@gmail.com', '$2y$10$G.sWS7jXdTvik36xqykxSeji5c.fvSi36tEQ6g67M3HuES68JP.bG', 'g3.png', '443', 1, '2024-09-21 09:53:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `motorcycles`
--
ALTER TABLE `motorcycles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `motorcycles`
--
ALTER TABLE `motorcycles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `motorcycles`
--
ALTER TABLE `motorcycles`
  ADD CONSTRAINT `motorcycles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
