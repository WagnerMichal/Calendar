-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2020 at 05:29 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kalendar`
--

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `idevent` int(11) NOT NULL,
  `jmeno` varchar(45) COLLATE utf8_czech_ci NOT NULL,
  `datum` date NOT NULL,
  `cas` varchar(45) COLLATE utf8_czech_ci NOT NULL,
  `cas1` varchar(45) CHARACTER SET utf32 COLLATE utf32_czech_ci NOT NULL,
  `trida` varchar(45) COLLATE utf8_czech_ci NOT NULL,
  `ucitel` varchar(45) COLLATE utf8_czech_ci NOT NULL,
  `garant` varchar(45) COLLATE utf8_czech_ci NOT NULL,
  `cena` varchar(45) COLLATE utf8_czech_ci NOT NULL,
  `sraz` varchar(45) COLLATE utf8_czech_ci NOT NULL,
  `konani` varchar(45) COLLATE utf8_czech_ci NOT NULL,
  `typ` varchar(45) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`idevent`, `jmeno`, `datum`, `cas`, `cas1`, `trida`, `ucitel`, `garant`, `cena`, `sraz`, `konani`, `typ`) VALUES
(45, 'ZOO', '2020-07-18', '08:55', '09:55', 'V4B', 'HRLE', 'PEPE', '45005', 'Brno', 'Brno-Střed', 'Učitel'),
(57, 'Praha', '2020-06-18', '06:55', '12:55', '', 'PEPE', 'HRLE', '6000', 'Praha', 'Brno', 'Třída');

-- --------------------------------------------------------

--
-- Table structure for table `uzivatele`
--

CREATE TABLE `uzivatele` (
  `idUsers` int(11) NOT NULL,
  `uidUsers` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `emailUsers` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `pwdUsers` varchar(255) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Dumping data for table `uzivatele`
--

INSERT INTO `uzivatele` (`idUsers`, `uidUsers`, `emailUsers`, `pwdUsers`) VALUES
(2, 'admin', 'admin', '$2y$10$TMPfg4MHZmSmyV6sHCdwo.awSfI2JM7bdkm1DfOiTk1F9lopFjTga');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`idevent`);

--
-- Indexes for table `uzivatele`
--
ALTER TABLE `uzivatele`
  ADD PRIMARY KEY (`idUsers`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `idevent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `uzivatele`
--
ALTER TABLE `uzivatele`
  MODIFY `idUsers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
