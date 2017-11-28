-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2017 at 08:45 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bma`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `bookingID` int(11) NOT NULL,
  `bookingDate` date NOT NULL,
  `appointmentDate` date NOT NULL,
  `personID` int(11) NOT NULL,
  `doctorID` int(11) NOT NULL,
  `slot` time NOT NULL,
  `bookingStatus` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`bookingID`, `bookingDate`, `appointmentDate`, `personID`, `doctorID`, `slot`, `bookingStatus`) VALUES
(1, '2017-11-24', '2017-11-25', 1, 4, '11:00:00', 'Booked');

-- --------------------------------------------------------

--
-- Table structure for table `building`
--

CREATE TABLE `building` (
  `buildingID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` varchar(8) NOT NULL,
  `addressLine1` varchar(100) NOT NULL,
  `addressLine2` varchar(100) NOT NULL,
  `addressLine3` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `pin` int(6) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `building`
--

INSERT INTO `building` (`buildingID`, `name`, `type`, `addressLine1`, `addressLine2`, `addressLine3`, `city`, `pin`, `latitude`, `longitude`) VALUES
(101, 'Mysore Dental Care', 'Clinic', '581', 'Off Kalidasa Road', 'Vijayanagar 1st Stage', 'Mysuru', 570012, 12.32535, 76.6130153),
(102, 'Parvathi Dental Care', 'Clinic', '765', 'Dr. Rajkumar Road', 'Yaraganahalli', 'Mysuru', 570029, 12.308083, 76.6910083),
(103, 'Dental Empire', 'Clinic', '20, Darla\'s Health Care', 'New CH 44, 7th Main Road', 'Saraswathipuram', 'Mysuru', 570009, 12.3047441, 76.6291994),
(104, 'MMS Dental Care', 'Clinic', '2963', 'Gokulam Main Road', 'Gokulam 2nd Stage', 'Mysuru', 570002, 12.326928, 76.6247353),
(105, 'Ramprasad Clinic', 'Clinic', '850/5', '25th Cross Road', 'Hebbal 2nd Stage', 'Mysuru', 570016, 12.3441641, 76.6043136),
(106, 'Vikram Hospital Private Limited', 'Hospital', '3075/23', 'Paramahamsa Road', 'Yadavagiri', 'Mysuru', 570020, 12.3268068, 76.635255),
(107, 'Apollo BGS Hospitals', 'Hospital', '23', 'Adichunchanagiri Road', 'Kuvempunagara', 'Mysuru', 570023, 12.2956272, 76.6298103),
(108, 'Brindavan Hospital', 'Hospital', '2744', 'Kalidasa Road, Vani Vilas Mohalla, 4th Block', 'Jayalakshmipuram', 'Mysuru', 570002, 12.3233343, 76.6248871),
(109, 'Mahalakshmi Clinic', 'Clinic', '248', 'Sarvajanika Hostel Road, Silk Factory Circle', 'Vidyaranyapuram', 'Mysuru', 570008, 12.285212, 76.6432423),
(110, 'Dixit Aarogya Dhaama', 'Clinic', '12, C-Block', 'Manchegowdana Koppalu', 'Vijayanagar 2nd Stage', 'Mysuru', 570017, 12.3313478, 76.6130882),
(111, 'Apollo Clinic', 'Clinic', '23', 'Kalidasa Road', 'Vani Vilas Mohalla', 'Mysuru', 570002, 12.3245177, 76.6218435),
(112, 'ARK Clinic', 'Clinic', '372/1, 1st Floor', 'Chamaraja Double Road', 'Chamarajapura', 'Mysuru', 570024, 12.302625, 76.6418205);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `departmentID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`departmentID`, `name`) VALUES
(11, 'Ayurveda'),
(12, 'Dentist'),
(13, 'ENT'),
(14, 'General Physician'),
(15, 'Gynecologist'),
(16, 'Neurosurgeon');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `doctorID` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) DEFAULT NULL,
  `gender` varchar(6) NOT NULL,
  `dob` date NOT NULL,
  `phoneNumber` bigint(10) NOT NULL,
  `registerDate` date NOT NULL,
  `qualification` varchar(100) NOT NULL,
  `departmentID` int(11) NOT NULL,
  `buildingID` int(11) NOT NULL,
  `experience` int(2) DEFAULT NULL,
  `fee` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`doctorID`, `firstName`, `lastName`, `gender`, `dob`, `phoneNumber`, `registerDate`, `qualification`, `departmentID`, `buildingID`, `experience`, `fee`) VALUES
(1, 'Ravi', 'R', 'male', '1965-05-01', 9874563215, '2017-11-24', 'BAMS,MD', 11, 110, 17, 300),
(2, 'ram', 'r', 'male', '1985-05-02', 1563247898, '2017-11-24', 'BAMS,MD', 11, 110, 5, 200),
(3, 'Hemanth', 'K', 'male', '1975-06-05', 5643217898, '2017-11-24', 'MBBS,MD', 16, 107, 7, 3500),
(4, 'Mohan', 'm', 'male', '1974-07-05', 4563982178, '2017-11-24', 'MBBS,MD', 16, 108, 6, 3000),
(5, 'Shibhani', 'A', 'female', '1974-11-05', 1452368521, '2017-11-24', 'DDS', 12, 101, 10, 500),
(6, 'Sham', 'S', 'male', '1969-06-04', 4568231795, '2017-11-24', 'DDS,DMS', 12, 102, 12, 700),
(7, 'John', 'S', 'male', '1965-10-05', 9871236540, '2017-11-24', 'MBBS,MS', 13, 106, 5, 250),
(8, 'Sunny', 'l', 'female', '1955-05-05', 4896121485, '2017-11-24', 'MBBS,MD', 13, 108, 20, 300),
(9, 'Bruce', 'w', 'male', '1978-06-05', 9874563259, '2017-11-24', 'MBBS,MD', 15, 108, 8, 250),
(10, 'Harold', 'N', 'male', '1987-12-05', 4587963215, '2017-11-24', 'MBBS', 14, 109, 5, 150),
(11, 'Kevin', 'A', 'male', '1978-06-08', 5478912365, '2017-11-24', 'MBBS', 14, 105, 5, 100);

-- --------------------------------------------------------

--
-- Table structure for table `doctorlogin`
--

CREATE TABLE `doctorlogin` (
  `doctorID` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `question` varchar(100) NOT NULL,
  `answer` varchar(100) NOT NULL,
  `lastLogin` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `doctorlogin`
--

INSERT INTO `doctorlogin` (`doctorID`, `email`, `password`, `question`, `answer`, `lastLogin`) VALUES
(9, 'bru@g.com', '202cb962ac59075b964b07152d234b70', 'In what city or town was your mother born?', 'c798cf2f72704a7ef75ae09db3687de7', '2017-11-24 11:39:48'),
(10, 'har@g.com', '202cb962ac59075b964b07152d234b70', 'In what city or town was your mother born?', 'c798cf2f72704a7ef75ae09db3687de7', '2017-11-24 11:43:40'),
(3, 'hem@g.com', '202cb962ac59075b964b07152d234b70', 'In what city or town was your mother born?', 'c798cf2f72704a7ef75ae09db3687de7', '2017-11-24 11:30:01'),
(7, 'john@g.com', '202cb962ac59075b964b07152d234b70', 'In what city or town was your mother born?', 'c798cf2f72704a7ef75ae09db3687de7', '2017-11-24 11:35:46'),
(11, 'kev@g.com', '202cb962ac59075b964b07152d234b70', 'In what city or town was your mother born?', 'c798cf2f72704a7ef75ae09db3687de7', '2017-11-24 11:45:10'),
(4, 'moh@g.com', '202cb962ac59075b964b07152d234b70', 'In what city or town was your mother born?', 'c798cf2f72704a7ef75ae09db3687de7', '2017-11-24 13:02:11'),
(2, 'ram@g.com', '202cb962ac59075b964b07152d234b70', 'In what city or town was your mother born?', 'c798cf2f72704a7ef75ae09db3687de7', '2017-11-24 13:11:05'),
(1, 'ravi@g.com', '202cb962ac59075b964b07152d234b70', 'In what city or town was your mother born?', 'c798cf2f72704a7ef75ae09db3687de7', '2017-11-24 11:25:29'),
(6, 'sham@g.com', '202cb962ac59075b964b07152d234b70', 'In what city or town was your mother born?', 'c798cf2f72704a7ef75ae09db3687de7', '2017-11-24 11:34:07'),
(5, 'shi@g.com', '202cb962ac59075b964b07152d234b70', 'In what city or town was your mother born?', 'c798cf2f72704a7ef75ae09db3687de7', '2017-11-24 11:32:42'),
(8, 'sun@g.com', '202cb962ac59075b964b07152d234b70', 'In what city or town was your mother born?', 'c798cf2f72704a7ef75ae09db3687de7', '2017-11-24 11:37:02');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `bookingID` int(11) NOT NULL,
  `bookingDate` date NOT NULL,
  `appointmentDate` date NOT NULL,
  `personID` int(11) NOT NULL,
  `doctorID` int(11) NOT NULL,
  `slot` time NOT NULL,
  `bookingStatus` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `personID` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) DEFAULT NULL,
  `gender` varchar(6) NOT NULL,
  `dob` date NOT NULL,
  `phoneNumber` bigint(10) NOT NULL,
  `registerDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`personID`, `firstName`, `lastName`, `gender`, `dob`, `phoneNumber`, `registerDate`) VALUES
(1, 'Rohan', 'K', 'male', '1997-06-09', 9483478805, '2017-11-24');

-- --------------------------------------------------------

--
-- Table structure for table `personlogin`
--

CREATE TABLE `personlogin` (
  `personID` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `question` varchar(100) NOT NULL,
  `answer` varchar(100) NOT NULL,
  `lastLogin` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `personlogin`
--

INSERT INTO `personlogin` (`personID`, `email`, `password`, `question`, `answer`, `lastLogin`) VALUES
(1, 'sr.rohanro@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'In what city or town was your mother born?', 'c798cf2f72704a7ef75ae09db3687de7', '2017-11-24 13:09:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`bookingID`),
  ADD KEY `FK_personBooking` (`personID`),
  ADD KEY `FK_doctorBooking` (`doctorID`);

--
-- Indexes for table `building`
--
ALTER TABLE `building`
  ADD PRIMARY KEY (`buildingID`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`departmentID`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`doctorID`),
  ADD KEY `FK_department` (`departmentID`),
  ADD KEY `FK_building` (`buildingID`);

--
-- Indexes for table `doctorlogin`
--
ALTER TABLE `doctorlogin`
  ADD PRIMARY KEY (`email`),
  ADD KEY `FK_doctorLogin` (`doctorID`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`bookingID`),
  ADD KEY `FK_personBookingHistory` (`personID`),
  ADD KEY `FK_doctorBookingHistory` (`doctorID`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`personID`);

--
-- Indexes for table `personlogin`
--
ALTER TABLE `personlogin`
  ADD PRIMARY KEY (`email`),
  ADD KEY `FK_personLogin` (`personID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `bookingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `building`
--
ALTER TABLE `building`
  MODIFY `buildingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `departmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `doctorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
  MODIFY `personID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `FK_doctorBooking` FOREIGN KEY (`doctorID`) REFERENCES `doctor` (`doctorID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_personBooking` FOREIGN KEY (`personID`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

--
-- Constraints for table `doctor`
--
ALTER TABLE `doctor`
  ADD CONSTRAINT `FK_building` FOREIGN KEY (`buildingID`) REFERENCES `building` (`buildingID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_department` FOREIGN KEY (`departmentID`) REFERENCES `department` (`departmentID`) ON UPDATE CASCADE;

--
-- Constraints for table `doctorlogin`
--
ALTER TABLE `doctorlogin`
  ADD CONSTRAINT `FK_doctorLogin` FOREIGN KEY (`doctorID`) REFERENCES `doctor` (`doctorID`) ON UPDATE CASCADE;

--
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `FK_doctorBookingHistory` FOREIGN KEY (`doctorID`) REFERENCES `doctor` (`doctorID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_personBookingHistory` FOREIGN KEY (`personID`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

--
-- Constraints for table `personlogin`
--
ALTER TABLE `personlogin`
  ADD CONSTRAINT `FK_personLogin` FOREIGN KEY (`personID`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `eventHistory` ON SCHEDULE EVERY 24 HOUR STARTS '2017-11-21 00:00:01' ON COMPLETION NOT PRESERVE ENABLE DO begin
	insert into history
	select * from booking
	where appointmentDate < curdate();

	delete from booking
	where appointmentDate < curdate();
end$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
