-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 28, 2024 at 06:46 AM
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
-- Table structure for table `offers`
--

DROP TABLE IF EXISTS `offers`;
CREATE TABLE IF NOT EXISTS `offers` (
  `ride_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `offer_price` int(11) NOT NULL,
  `negotiation_status` int(11) DEFAULT '0',
  `negotiation_price` int(11) DEFAULT NULL,
  `accept_status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ride_id`,`driver_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`ride_id`, `driver_id`, `offer_price`, `negotiation_status`, `negotiation_price`, `accept_status`) VALUES
(9, 1021, 80000, 0, NULL, 1),
(34, 1001, 500, 1, 450, 0),
(38, 1021, 2000, 0, NULL, 1),
(44, 1002, 600, 0, NULL, 1),
(45, 1021, 500, 0, NULL, 1),
(46, 1021, 800, 0, NULL, 1),
(51, 1021, 200, 0, NULL, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
