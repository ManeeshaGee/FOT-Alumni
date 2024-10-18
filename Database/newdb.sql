-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 18, 2024 at 08:55 PM
-- Server version: 8.0.34
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `admin_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `name`, `password`) VALUES
(1, 'Maneesha', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `alumni`
--

DROP TABLE IF EXISTS `alumni`;
CREATE TABLE IF NOT EXISTS `alumni` (
  `Alumni_id` char(4) NOT NULL,
  `Name` varchar(1000) NOT NULL,
  `Address` varchar(1000) NOT NULL,
  `Position` varchar(1000) NOT NULL,
  `Contact_no` int NOT NULL,
  `Email` varchar(1000) NOT NULL,
  `alumni_photo_one` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `alumni_photo_two` varchar(1000) NOT NULL,
  PRIMARY KEY (`Alumni_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `alumni`
--

INSERT INTO `alumni` (`Alumni_id`, `Name`, `Address`, `Position`, `Contact_no`, `Email`, `alumni_photo_one`, `alumni_photo_two`) VALUES
('A001', 'A.R.Maneesha Geethanga', '123/B Udupila,Delgoda', 'Software Engineer', 762720230, 'maneeshageethanga2001@gmail.com', 'assets\\img\\staff\\team-1.jpg', ''),
('A002', 'Asela Priyadarshana', 'Kaluthara', 'Software Engineer', 761234567, 'asela@gmail.com', 'assets\\img\\staff\\team-1.jpg', ''),
('A003', 'Nepul dhanujaya', 'Galle', 'SE', 761234567, 'nepul@gmail.com', '', ''),
('A004', 'Abraham Lincoln', 'North carolina,USA', 'Software developer', 761234567, 'lincoln@gmail.com', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `event_id` int NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `title` varchar(1000) NOT NULL,
  `description` varchar(5000) NOT NULL,
  `event_photo_one` varchar(1000) NOT NULL,
  `event_photo_two` varchar(1000) NOT NULL,
  `event_photo_three` varchar(1000) NOT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `Message_id` int NOT NULL AUTO_INCREMENT,
  `alumni_id` char(4) NOT NULL,
  `Date` date NOT NULL,
  `Description` varchar(5000) NOT NULL,
  PRIMARY KEY (`Message_id`),
  KEY `alumni_id` (`alumni_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`Message_id`, `alumni_id`, `Date`, `Description`) VALUES
(2, 'A001', '2024-10-15', 'I am a software engineer. I am a software engineer. I am a software engineer. I am a software engineer. I am a software engineer. I am a software engineer.'),
(3, 'A002', '2024-10-17', 'I am a tech entreprenuer. I am a tech entreprenuer. I am a tech entreprenuer. I am a tech entreprenuer. I am a tech entreprenuer. I am a tech entreprenuer.');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `news_id` int NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `title` varchar(2000) NOT NULL,
  `description` varchar(5000) NOT NULL,
  `news_photo_one` varchar(1000) NOT NULL,
  `news_photo_two` varchar(1000) NOT NULL,
  `news_photo_three` varchar(1000) NOT NULL,
  PRIMARY KEY (`news_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `date`, `title`, `description`, `news_photo_one`, `news_photo_two`, `news_photo_three`) VALUES
(3, '2024-10-10', 'Annual meetup 2024', 'Lorem ipsum. Lorem ipsum. Lorem ipsum. Lorem ipsum. Lorem ipsum. Lorem ipsum. Lorem ipsum. Lorem ipsum. Lorem ipsum. Lorem ipsum. Lorem ipsum. Lorem ipsum. Lorem ipsum. Lorem ipsum. Lorem ipsum. ', 'profile.jpg', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `office_bearers`
--

DROP TABLE IF EXISTS `office_bearers`;
CREATE TABLE IF NOT EXISTS `office_bearers` (
  `office_bearer_id` char(4) NOT NULL,
  `almuni_id` char(4) NOT NULL,
  `position` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Image` varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`office_bearer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `office_bearers`
--

INSERT INTO `office_bearers` (`office_bearer_id`, `almuni_id`, `position`, `Image`) VALUES
('E001', 'A001', 'Software engineer', '\\assets\\img\\staff\\team-1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
CREATE TABLE IF NOT EXISTS `staff` (
  `staff_id` char(4) NOT NULL,
  `alumni_id` char(4) NOT NULL,
  `position` varchar(1000) NOT NULL,
  PRIMARY KEY (`staff_id`),
  KEY `alumni_id` (`alumni_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `alumni_id`, `position`) VALUES
('S001', 'A001', 'President');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`alumni_id`) REFERENCES `alumni` (`Alumni_id`);

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`alumni_id`) REFERENCES `alumni` (`Alumni_id`),
  ADD CONSTRAINT `staff_ibfk_2` FOREIGN KEY (`alumni_id`) REFERENCES `alumni` (`Alumni_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
