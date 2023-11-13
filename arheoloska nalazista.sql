-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 14, 2023 at 08:21 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arheoloska nalazista`
--

-- --------------------------------------------------------

--
-- Table structure for table `nalazista`
--

CREATE TABLE `nalazista` (
  `ID_nalazista` int(11) NOT NULL,
  `Ime_nalazista` varchar(256) DEFAULT NULL,
  `Zemlja` varchar(256) DEFAULT NULL,
  `Vremensko_doba` varchar(256) DEFAULT NULL,
  `Znacaj` int(2) DEFAULT NULL,
  `Datum_otkrivanja` date DEFAULT NULL,
  `Pronalazac` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nalazista`
--

INSERT INTO `nalazista` (`ID_nalazista`, `Ime_nalazista`, `Zemlja`, `Vremensko_doba`, `Znacaj`, `Datum_otkrivanja`, `Pronalazac`) VALUES
(1, 'Tutankamunova grobnica', 'Egipat', 'Anticko doba', 8, '1922-11-04', 1),
(2, 'Jeriho', 'Izrael', 'Anticko doba', 8, '1951-05-01', 2),
(3, 'Olduvai Gorge - Zinjanthropus lobanja', 'Tanzanija', 'Paleolitsko doba', 9, '1959-06-07', 3),
(4, 'Olduvai Gorge - Homo habilis', 'Tanzanija', 'Paleolitsko doba', 10, '1960-08-17', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `nalazista`
--
ALTER TABLE `nalazista`
  ADD PRIMARY KEY (`ID_nalazista`),
  ADD KEY `KoJePronasao` (`Pronalazac`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nalazista`
--
ALTER TABLE `nalazista`
  MODIFY `ID_nalazista` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `nalazista`
--
ALTER TABLE `nalazista`
  ADD CONSTRAINT `KoJePronasao` FOREIGN KEY (`Pronalazac`) REFERENCES `arheolozi` (`ID_nalog`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
