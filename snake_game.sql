-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2024 at 11:31 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `4549122_snakegame`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `name` varchar(45) NOT NULL,
  `password` varchar(100) NOT NULL,
  `id` int(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`name`, `password`, `id`) VALUES
('Emmanuel', '$2y$10$6Y5th8eInOLW9AHK6u9Mt.ju4mOqUMlelJ0bxgxCawWAza8Ufx5xa', 3);

-- --------------------------------------------------------

--
-- Table structure for table `create_player_account`
--

CREATE TABLE `create_player_account` (
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `create_player_account`
--

INSERT INTO `create_player_account` (`username`, `password`) VALUES
('Ikenna', '$2y$10$2zrqYvjyz9OPiqRKDM3DUeKbHLnwVuv9E908wPCf8GVi0JGRkc5da');

-- --------------------------------------------------------

--
-- Table structure for table `high_score`
--

CREATE TABLE `high_score` (
  `username` varchar(45) NOT NULL,
  `high_score` int(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `high_score`
--

INSERT INTO `high_score` (`username`, `high_score`) VALUES
('Ikenna', 160),
('Kingsley', 110);

-- --------------------------------------------------------

--
-- Table structure for table `player_score`
--

CREATE TABLE `player_score` (
  `username` varchar(100) NOT NULL,
  `score` int(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `player_score`
--

INSERT INTO `player_score` (`username`, `score`) VALUES
('Ikenna', 0),
('Kingsley', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`),
  ADD KEY `name_2` (`name`);

--
-- Indexes for table `high_score`
--
ALTER TABLE `high_score`
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `player_score`
--
ALTER TABLE `player_score`
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(45) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
