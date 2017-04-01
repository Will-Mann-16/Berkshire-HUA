-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2017 at 11:19 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `berkshirehua`
--

-- --------------------------------------------------------

--
-- Table structure for table `fixtures`
--

CREATE TABLE `fixtures` (
  `ID` int(11) NOT NULL,
  `Alias` varchar(255) NOT NULL,
  `HomeTeam` varchar(255) NOT NULL,
  `AwayTeam` varchar(255) NOT NULL,
  `Venue` text NOT NULL,
  `Address` text NOT NULL,
  `Umpires` varchar(255) NOT NULL,
  `Timestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fixtures`
--

INSERT INTO `fixtures` (`ID`, `Alias`, `HomeTeam`, `AwayTeam`, `Venue`, `Address`, `Umpires`, `Timestamp`) VALUES
(1, 'JACS U16 Men', 'Berkshire', 'Oxfordshire', 'Sonning Lane SLS', 'Reading Hockey Club, Sonning Lane, RG4 6ST, UK', '[1,2]', '2017-03-24 18:45:00'),
(2, 'U18s Cup Final', 'Wellington College', 'Pangborne', 'Mansergh Pitch', 'Wellington Health & Fitness Centre, Dukes Ride, Crowthorne, RG45 7PT', '[2,-1]', '2017-03-31 11:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `UserKey` text NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Admin` varchar(5) NOT NULL,
  `Password` text NOT NULL,
  `Firstname` varchar(255) NOT NULL,
  `Surname` varchar(255) NOT NULL,
  `MobileNo` varchar(11) NOT NULL,
  `HouseNo` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `UserKey`, `Email`, `Admin`, `Password`, `Firstname`, `Surname`, `MobileNo`, `HouseNo`) VALUES
(1, 'd5d3766bb7ce4499ed6e26a2682a1bdf', 'will@mannclan.net', 'true', '$2a$06$2SeFoKf2RdrfNpiaLn9DS.XreD4SIHpCbfMDHLDz6ZzirvrqeLbLi', 'Will', 'Mann', '07702430232', '01189835836'),
(2, '', 'william@mannclan.net', 'false', '', 'Test', 'User', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fixtures`
--
ALTER TABLE `fixtures`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fixtures`
--
ALTER TABLE `fixtures`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
