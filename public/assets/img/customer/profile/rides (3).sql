-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 28, 2024 at 06:43 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fareflex`
--

-- --------------------------------------------------------

--
-- Table structure for table `rides`
--

DROP TABLE IF EXISTS `rides`;
CREATE TABLE IF NOT EXISTS `rides` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `passenger_id` int(10) NOT NULL,
  `driver_id` int(10) NOT NULL,
  `date` datetime NOT NULL,
  `location` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `l_lat` float NOT NULL,
  `l_long` float NOT NULL,
  `destination` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `d_lat` float NOT NULL,
  `d_long` float NOT NULL,
  `m_lat` float DEFAULT NULL,
  `m_long` float DEFAULT NULL,
  `vehicle` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `time` varchar(20) NOT NULL,
  `distance` varchar(20) NOT NULL,
  `fare` float NOT NULL,
  `ride_start` tinyint(1) NOT NULL DEFAULT '0',
  `state` varchar(10) NOT NULL,
  `passenger_cancel` varchar(50) NOT NULL DEFAULT '',
  `driver_cancel` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `fk_passenger` (`passenger_id`),
  KEY `fk_driver` (`driver_id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rides`
--

INSERT INTO `rides` (`id`, `passenger_id`, `driver_id`, `date`, `location`, `l_lat`, `l_long`, `destination`, `d_lat`, `d_long`, `m_lat`, `m_long`, `vehicle`, `time`, `distance`, `fare`, `ride_start`, `state`, `passenger_cancel`, `driver_cancel`) VALUES
(21, 1019, 1001, '2024-04-25 21:34:40', ' Our uni', 6.90279, 79.8596, ' Home', 6.85658, 79.8745, NULL, NULL, 'bike', '00:14', '8.26', 500, 1, 'Reject', '', ''),
(22, 1019, 1001, '2024-04-26 09:33:13', ' Our uni', 6.90279, 79.8596, ' Home', 6.85658, 79.8745, 6.88394, 79.8551, 'bike', '00:13', '7.81', 500, 0, 'Reject', '', ''),
(25, 1019, 1001, '2024-04-26 11:51:02', ' Our uni', 6.90279, 79.8596, ' Home', 6.85658, 79.8745, NULL, NULL, 'bike', '00:10', '6.84', 500, 1, 'Reject', '', ''),
(29, 1019, 1021, '2024-04-26 12:24:32', ' Our uni', 6.90279, 79.8596, ' Home', 6.85658, 79.8745, NULL, NULL, 'auto', '00:10', '6.84', 80000, 0, 'Reject', '', ''),
(31, 1019, 1001, '2024-04-26 14:22:27', ' Our uni', 6.90279, 79.8596, ' Home', 6.85658, 79.8745, NULL, NULL, 'bike', '00:10', '6.84', 500, 0, 'Reject', '', ''),
(32, 1019, 1001, '2024-04-26 14:27:22', ' Our uni', 6.90279, 79.8596, ' Home', 6.85658, 79.8745, NULL, NULL, 'bike', '00:10', '6.84', 500, 0, 'Reject', '', ''),
(34, 1019, 1001, '2024-04-27 07:44:46', ' Moron', 6.86856, 79.9306, ' Home', 6.85658, 79.8745, 6.85149, 79.9185, 'bike', '00:18', '10.30', 500, 0, 'Reject', '', ''),
(35, 1019, 1021, '2024-04-27 10:12:51', ' Moron', 6.86856, 79.9306, ' Home', 6.85658, 79.8745, NULL, NULL, 'bike', '00:15', '9.22', 20000, 1, 'Reject', '', ''),
(37, 1019, 1021, '2024-04-27 13:23:58', ' UCSC', 6.90096, 79.8605, ' Home', 6.85658, 79.8745, NULL, NULL, 'auto', '00:9', '6.41', 600, 1, 'Success', '', ''),
(38, 1019, 1021, '2024-04-27 14:14:12', ' UCSC', 6.90096, 79.8605, ' Home', 6.85658, 79.8745, NULL, NULL, 'auto', '00:9', '6.41', 2000, 0, 'Reject', '', ''),
(39, 1019, 1021, '2024-04-27 14:48:59', ' UCSC', 6.90096, 79.8605, ' Home', 6.85658, 79.8745, NULL, NULL, 'bike', '00:9', '6.41', 600, 1, 'Success', '', ''),
(42, 1019, 1021, '2024-04-27 17:25:07', ' UCSC', 6.90096, 79.8605, ' Home', 6.85658, 79.8745, NULL, NULL, 'auto', '00:9', '6.41', 600, 0, 'cancel', 'vehicle issue', ''),
(43, 1019, 1002, '2024-04-28 02:07:46', ' UCSC', 6.90096, 79.8605, ' Home', 6.85658, 79.8745, NULL, NULL, 'bike', '00:9', '6.41', 600, 1, 'Success', '', ''),
(44, 1019, 1002, '2024-04-28 07:57:03', ' UCSC', 6.90096, 79.8605, ' Home', 6.85658, 79.8745, NULL, NULL, 'bike', '00:9', '6.41', 600, 1, 'Success', '', ''),
(45, 1019, 1021, '2024-04-28 10:14:38', ' UCSC', 6.90096, 79.8605, ' Home', 6.85658, 79.8745, 6.88308, 79.8681, 'auto', '00:10', '6.47', 500, 0, 'Reject', '', ''),
(46, 1019, 1021, '2024-04-28 10:16:25', ' UCSC', 6.90096, 79.8605, ' Home', 6.85658, 79.8745, 6.88308, 79.8681, 'auto', '00:10', '6.47', 800, 0, 'cancel', 'emergency', ''),
(47, 1019, 1021, '2024-04-28 10:21:05', ' UCSC', 6.90096, 79.8605, ' Home', 6.85658, 79.8745, NULL, NULL, 'auto', '00:9', '6.41', 200, 1, 'Success', '', ''),
(49, 1020, 1021, '2024-04-28 10:59:55', 'University of Colombo, Sri Lanka', 6.90209, 79.861, 'Delkanda 10250, Sri Lanka', 6.8637, 79.9029, NULL, NULL, 'auto', '00:10', '7.21', 200, 1, 'Success', '', ''),
(50, 1019, 1021, '2024-04-28 11:17:59', ' UCSC', 6.90096, 79.8605, ' Home', 6.85658, 79.8745, NULL, NULL, 'auto', '00:9', '6.41', 200, 1, 'Success', '', ''),
(51, 1019, 1021, '2024-04-28 12:11:14', ' UCSC', 6.90096, 79.8605, ' Home', 6.85658, 79.8745, NULL, NULL, 'auto', '00:9', '6.41', 200, 0, 'cancel', 'vehicle issue', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
