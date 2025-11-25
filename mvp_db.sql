-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2025 at 03:04 PM
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
-- Database: `mvp_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `pembalap`
--

CREATE TABLE `pembalap` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `negara` varchar(255) NOT NULL,
  `poinMusim` int(11) DEFAULT 0,
  `jumlahMenang` int(11) DEFAULT 0,
  `team_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembalap`
--

INSERT INTO `pembalap` (`id`, `nama`, `negara`, `poinMusim`, `jumlahMenang`, `team_id`) VALUES
(2, 'Max', 'Indo', 300, 5, 4),
(3, 'Valtteri Bottas', 'Finland', 203, 2, 1),
(4, 'Sergio Perez', 'Mexico', 190, 1, 2),
(5, 'Carlos Sainz', 'Spain', 150, 0, 3),
(6, 'Daniel Ricciardo', 'Australia', 115, 1, 4),
(7, 'Charles Leclerc', 'Monaco', 95, 0, 3),
(8, 'Lando Norris', 'United Kingdom', 88, 0, 4),
(9, 'Pierre Gasly', 'France', 75, 0, 5),
(10, 'Fernando Alonso', 'Spain', 65, 0, 6);

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `id` int(11) NOT NULL,
  `namaTim` varchar(255) NOT NULL,
  `negaraAsal` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`id`, `namaTim`, `negaraAsal`) VALUES
(1, 'IndoKeren', 'Indonesia'),
(2, 'Red Bull', 'Austria'),
(3, 'Ferrari', 'Italy'),
(4, 'McLaren', 'United Kingdom'),
(5, 'AlphaTauri', 'Italy'),
(6, 'Alpine', 'France'),
(10, 'Manor Racing', 'Inggris');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pembalap`
--
ALTER TABLE `pembalap`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_team` (`team_id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pembalap`
--
ALTER TABLE `pembalap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pembalap`
--
ALTER TABLE `pembalap`
  ADD CONSTRAINT `fk_team` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
