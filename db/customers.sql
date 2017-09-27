-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2017 at 01:44 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ecom_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_username` varchar(255) NOT NULL,
  `customer_password` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_first_name` varchar(255) NOT NULL,
  `customer_last_name` varchar(255) NOT NULL,
  `customer_home_phone` int(11) NOT NULL,
  `customer_work_phone` int(11) NOT NULL,
  `customer_mobile_phone` int(11) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `customer_enabled` varchar(11) NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_username`, `customer_password`, `customer_email`, `customer_first_name`, `customer_last_name`, `customer_home_phone`, `customer_work_phone`, `customer_mobile_phone`, `customer_address`, `customer_enabled`) VALUES
(1, 'kapiton09', 'Kapil@123', 'kapiton_212@hotmail.com', 'Kapil', 'Shrestha', 95550255, 2108317604, 2108317604, '562 Richardson Road', 'No'),
(2, 'kkkkk', 'Kapil@123', 'kapiton@hotmail.com', 'Kaps', 'Shrestha', 95550255, 2108317604, 2108317604, '163 Richardson Road', 'Yes'),
(3, 'Dex', 'Dex', 'dex@gmail.com', 'Dex', 'Augusto', 123, 123, 123, '2311vr sds', 'Yes'),
(4, 'Irena', 'Irena', 'irena@hotmail.com', 'Irena', 'Shrestha', 44048066, 44048066, 0, 'Loftus St', 'Yes');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
