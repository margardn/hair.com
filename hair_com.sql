-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2020 at 05:11 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hair.com`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblappointments`
--

CREATE TABLE `tblappointments` (
  `apptID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `start_event` datetime NOT NULL,
  `end_event` datetime NOT NULL,
  `customerID` int(10) DEFAULT NULL,
  `stylistID` int(10) DEFAULT NULL,
  `serviceID` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblappointments`
--

INSERT INTO `tblappointments` (`apptID`, `title`, `start_event`, `end_event`, `customerID`, `stylistID`, `serviceID`) VALUES
(13, 'Stab Gerry in face with butter knife', '2020-03-25 09:00:00', '2020-03-25 15:30:00', NULL, NULL, NULL),
(15, 'Test', '2020-04-08 00:00:00', '2020-04-09 00:00:00', NULL, NULL, NULL),
(16, 'Fucking test', '2020-04-15 00:00:00', '2020-04-16 00:00:00', NULL, NULL, NULL),
(17, 'New Appointment', '2020-04-16 00:00:00', '2020-04-17 00:00:00', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblhairanalysis`
--

CREATE TABLE `tblhairanalysis` (
  `analysisNo` int(10) NOT NULL,
  `customerID` int(10) NOT NULL,
  `texture` char(50) DEFAULT NULL,
  `hairCondition` char(50) DEFAULT NULL,
  `naturalForm` char(50) DEFAULT NULL,
  `skinTestDate` date NOT NULL,
  `result` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblservices`
--

CREATE TABLE `tblservices` (
  `serviceID` int(10) NOT NULL,
  `serviceName` varchar(50) DEFAULT NULL,
  `durationMins` int(4) DEFAULT NULL,
  `devTime` tinyint(1) DEFAULT NULL,
  `cost` decimal(13,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblservices`
--

INSERT INTO `tblservices` (`serviceID`, `serviceName`, `durationMins`, `devTime`, `cost`) VALUES
(1, 'Gent dry cut', 30, 0, '10.00'),
(2, 'Ladies Long Hair Blow Dry', 30, 0, '15.00'),
(4, 'Ladies Cut Wash and Blow-dry ', 60, 0, '30.00'),
(17, 'Ladies Perm', 60, 0, '40.00');

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `UserID` int(11) NOT NULL,
  `Firstname` varchar(50) NOT NULL,
  `Surname` varchar(50) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` char(255) NOT NULL,
  `phonenumber` varchar(11) DEFAULT NULL,
  `address1` varchar(50) DEFAULT '''NULL''',
  `address2` varchar(50) DEFAULT '''NULL''',
  `postcode` varchar(8) DEFAULT '''NULL''',
  `DateRegistered` datetime NOT NULL DEFAULT current_timestamp(),
  `UserType` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`UserID`, `Firstname`, `Surname`, `Username`, `Password`, `phonenumber`, `address1`, `address2`, `postcode`, `DateRegistered`, `UserType`) VALUES
(1, 'Denise', 'Gardner', 'denise.mckay123@gmail.com', '935db81c9bde2f5b9cc730950d91456a028f726a2f4cb14ba1bd49d75abc878a5bac98f715d3c1a9f1d99dc4ceb58a38d2a9f441c7016fed323c4aba312c78a0', '02825469786', '101 New Street', 'Ballymena', 'BT42 1PW', '2019-07-06 23:56:54', 3),
(2, 'Mark', 'Gardner', 'gardner_mark3@sky.com', '935db81c9bde2f5b9cc730950d91456a028f726a2f4cb14ba1bd49d75abc878a5bac98f715d3c1a9f1d99dc4ceb58a38d2a9f441c7016fed323c4aba312c78a0', '02825469785', '254 Ballymena Road', 'Cullybackey', 'BT43 5TP', '2020-01-01 20:41:28', 1),
(3, 'Alan', 'Gardner', 'alan@sky.com', '1cbad592ca4839557a43c99e0c249c2d80af0814d4aa7f3cd018e099b42ce0654436593176ee8fb45318540d61cebd33a51f2f2fe85d017d15c3abe1ea05b70d', '07894312569', '51 Glenhugh Road', 'Ahoghill', 'BT42 6NA', '2020-01-03 14:55:52', 1),
(4, 'Gerry', 'Lynch', 'gerry@sky.com', 'd2d8b6607e368505232666d0d2ab0898482977bbb26d533b956066d1f850798e8e6fb9461d4dcca3af8e0f7904e0456783be6042306df1c6ed130a7360da0643', '07123789456', '86 Rodgers Bay', 'Carrickfergus', 'BT38 8GG', '2020-01-03 20:33:55', 1),
(5, 'Angela', 'Gardner', 'client@1.com', '935db81c9bde2f5b9cc730950d91456a028f726a2f4cb14ba1bd49d75abc878a5bac98f715d3c1a9f1d99dc4ceb58a38d2a9f441c7016fed323c4aba312c78a0', '07989123456', '14 Craignageeragh Rd', 'Cullybackey', 'BT42 1EL', '2020-01-03 20:34:54', 1),
(6, 'Andy', 'Gardner', 'gardner_mark@sky.com', '9a37915c1f3c5dd909d4adf7ee3a9b48125ce1ddd3f0e9019fe1ecc460ff4e5fdf8548b1da1ababb7f94792788a06d37e2d00f6d57da5166eb2541507f9c8c5d', '07568053864', '14 Craignageeragh Rd', 'Cullybackey', 'BT42 1EL', '2020-02-13 22:05:34', 1),
(7, 'Sam', 'Gardner', 'gardner_mark2@sky.com', '9a37915c1f3c5dd909d4adf7ee3a9b48125ce1ddd3f0e9019fe1ecc460ff4e5fdf8548b1da1ababb7f94792788a06d37e2d00f6d57da5166eb2541507f9c8c5d', '07568053864', '14 Craignageeragh Rd', 'Cullybackey', 'BT42 1EL', '2020-02-13 22:06:33', 1),
(8, 'Harry', 'Gardner', 'alan1@sky.com', '99dd1e8da89726b0a972f354252a58ffcdbe452a2869dbfa3b667d95dd94f0a19ed4fff7c1847afdb6c9470d322b76e6532bd3ea5e53ceeb84cb4d1a38c0d1b9', '07589568974', '6 Rodgers Bay', 'Carrickfergus', 'BT38 8GG', '2020-02-16 13:25:48', 1),
(9, 'Karen', 'Gardner', 'client@sky.com', '935db81c9bde2f5b9cc730950d91456a028f726a2f4cb14ba1bd49d75abc878a5bac98f715d3c1a9f1d99dc4ceb58a38d2a9f441c7016fed323c4aba312c78a0', '02825490521', '267 Ballymoney rd', 'Ballymena', 'BT42 1EL', '2020-02-18 06:56:28', 1),
(10, 'Liz', 'Stylist', 'stylist@1.com', '935db81c9bde2f5b9cc730950d91456a028f726a2f4cb14ba1bd49d75abc878a5bac98f715d3c1a9f1d99dc4ceb58a38d2a9f441c7016fed323c4aba312c78a0', '02812345678', '1 The Place', 'Cullybackey', 'BT42 1EL', '2020-02-18 07:05:49', 2),
(11, 'Denise', 'Admin', 'admin@1.com', '935db81c9bde2f5b9cc730950d91456a028f726a2f4cb14ba1bd49d75abc878a5bac98f715d3c1a9f1d99dc4ceb58a38d2a9f441c7016fed323c4aba312c78a0', '02890123456', '14 Craignageeragh Rd', 'Cullybackey', 'BT42 1EL', '2020-02-18 07:21:09', 3),
(12, 'Mark', 'Gardner', '4@1.com', '935db81c9bde2f5b9cc730950d91456a028f726a2f4cb14ba1bd49d75abc878a5bac98f715d3c1a9f1d99dc4ceb58a38d2a9f441c7016fed323c4aba312c78a0', '07568053864', '14 Craignageeragh Rd', 'Cullybackey', 'BT42 1EL', '2020-02-18 07:24:03', 1),
(13, 'Gerry', 'Lynch', 'glynch@cisco.com', '935db81c9bde2f5b9cc730950d91456a028f726a2f4cb14ba1bd49d75abc878a5bac98f715d3c1a9f1d99dc4ceb58a38d2a9f441c7016fed323c4aba312c78a0', '07123456789', '12 Ballymoney Heights', 'Ballymena', 'BT43 5GH', '2020-02-19 09:56:42', 1),
(35, 'Mark', 'Gardner', 'gardner_mark3qqq@sky.com', '5c1793eba74d754d3fc489dab460eed539856ef2a0cb83d66cdd97599d4e0ded0f698dac268144c608ffc0632d8ee6bb549fe7eb865e264444655bb0605b0ecd', '07568053864', '14 Craignageeragh Rd', 'Cullybackey', 'BT42 1EL', '2020-04-11 15:01:48', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblappointments`
--
ALTER TABLE `tblappointments`
  ADD PRIMARY KEY (`apptID`),
  ADD KEY `serviceID` (`serviceID`),
  ADD KEY `stylistID` (`stylistID`),
  ADD KEY `customerID` (`customerID`);

--
-- Indexes for table `tblhairanalysis`
--
ALTER TABLE `tblhairanalysis`
  ADD PRIMARY KEY (`analysisNo`),
  ADD KEY `fk_customerID` (`customerID`);

--
-- Indexes for table `tblservices`
--
ALTER TABLE `tblservices`
  ADD PRIMARY KEY (`serviceID`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblappointments`
--
ALTER TABLE `tblappointments`
  MODIFY `apptID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tblhairanalysis`
--
ALTER TABLE `tblhairanalysis`
  MODIFY `analysisNo` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblservices`
--
ALTER TABLE `tblservices`
  MODIFY `serviceID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblappointments`
--
ALTER TABLE `tblappointments`
  ADD CONSTRAINT `customerID` FOREIGN KEY (`customerID`) REFERENCES `tblusers` (`UserID`),
  ADD CONSTRAINT `serviceID` FOREIGN KEY (`serviceID`) REFERENCES `tblservices` (`serviceID`),
  ADD CONSTRAINT `stylistID` FOREIGN KEY (`stylistID`) REFERENCES `tblusers` (`UserID`);

--
-- Constraints for table `tblhairanalysis`
--
ALTER TABLE `tblhairanalysis`
  ADD CONSTRAINT `fk_customerID` FOREIGN KEY (`customerID`) REFERENCES `tblusers` (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
