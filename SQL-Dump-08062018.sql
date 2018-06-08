-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2018 at 10:23 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sound`
--

-- --------------------------------------------------------

--
-- Table structure for table `sound`
--

CREATE TABLE `sound` (
  `SoundName` varchar(255) NOT NULL,
  `SoundDescription` text NOT NULL,
  `SoundFilePath` text NOT NULL,
  `SoundCategory` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sound`
--

INSERT INTO `sound` (`SoundName`, `SoundDescription`, `SoundFilePath`, `SoundCategory`) VALUES
('asdfasdf', 'sdfasdfasdf', 'asdfa', 'Pokimane'),
('Mop', 'asdf', 'asdf', 'asdf'),
('Nani the heck?', 'NANI???', 'sound/nani.mp3', 'LilyPichu'),
('Pokimane', 'Pokimane', 'Pokimane', 'Pokimane'),
('sassdsddd', 'aaaaaaaaaa', 'asdfasd', 'Pokimane'),
('Test', 'asdf', 'asdf', 'Pokimane');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sound`
--
ALTER TABLE `sound`
  ADD PRIMARY KEY (`SoundName`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
