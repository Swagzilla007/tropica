-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `hotel`
--
CREATE DATABASE IF NOT EXISTS `hotel` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `hotel`;

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(100) NOT NULL,
  `upass` varchar(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `uemail` varchar(100) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Default admin credentials
--

INSERT INTO `manager` (`uid`, `uname`, `upass`, `fullname`, `uemail`) VALUES
(1, 'admin', 'admin', 'Administrator', 'admin@hotel.com');

-- --------------------------------------------------------

--
-- Table structure for table `room_category`
--

CREATE TABLE `room_category` (
  `roomname` varchar(100) NOT NULL,
  `room_qnty` int(11) NOT NULL,
  `available` int(11) NOT NULL,
  `booked` int(11) NOT NULL,
  `no_bed` int(11) NOT NULL,
  `bedtype` varchar(100) NOT NULL,
  `facility` varchar(500) NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`roomname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Sample room categories
--

INSERT INTO `room_category` (`roomname`, `room_qnty`, `available`, `booked`, `no_bed`, `bedtype`, `facility`, `price`) VALUES
('Luxury Suite', 5, 5, 0, 2, 'double', 'AC, WiFi, Mini Bar, Ocean View, Room Service', 15000),
('Deluxe Room', 8, 8, 0, 1, 'double', 'AC, WiFi, City View', 8000),
('Standard Room', 10, 10, 0, 1, 'single', 'AC, WiFi', 5000);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` int(11) NOT NULL AUTO_INCREMENT,
  `room_cat` varchar(100) NOT NULL,
  `checkin` date DEFAULT NULL,
  `checkout` date DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `book` varchar(100) NOT NULL,
  PRIMARY KEY (`room_id`),
  FOREIGN KEY (`room_cat`) REFERENCES `room_category`(`roomname`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Generate initial rooms based on room categories
--

INSERT INTO `rooms` (`room_cat`, `book`) 
SELECT rc.roomname, 'false' 
FROM room_category rc 
CROSS JOIN (SELECT 1 AS n UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9 UNION SELECT 10) numbers 
WHERE numbers.n <= rc.room_qnty;

COMMIT;
