-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2024 at 03:04 PM
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
-- Database: `bd_hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `Ncin` char(8) NOT NULL,
  `Nom` char(20) DEFAULT NULL,
  `Prenom` char(20) DEFAULT NULL,
  `Tel` char(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `equipement`
--

CREATE TABLE `equipement` (
  `Ref` char(5) NOT NULL,
  `Libelle` char(30) DEFAULT NULL,
  `PrixHeure` int(11) DEFAULT NULL,
  `Disponible` char(1) DEFAULT NULL CHECK (`Disponible` in ('O','N'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipement`
--

INSERT INTO `equipement` (`Ref`, `Libelle`, `PrixHeure`, `Disponible`) VALUES
('Jsk01', 'Jet-Ski', 25, 'O'),
('Pch76', 'Parachute', 15, 'N'),
('Ped01', 'Pédalo individuel', 10, 'N'),
('Ped02', 'Pédalo double', 18, 'O');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `NcinClient` char(8) NOT NULL,
  `RefEquipement` char(5) NOT NULL,
  `DateLoc` datetime NOT NULL,
  `DateRet` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`Ncin`);

--
-- Indexes for table `equipement`
--
ALTER TABLE `equipement`
  ADD PRIMARY KEY (`Ref`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`NcinClient`,`RefEquipement`,`DateLoc`),
  ADD KEY `RefEquipement` (`RefEquipement`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `location_ibfk_1` FOREIGN KEY (`NcinClient`) REFERENCES `client` (`Ncin`),
  ADD CONSTRAINT `location_ibfk_2` FOREIGN KEY (`RefEquipement`) REFERENCES `equipement` (`Ref`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
