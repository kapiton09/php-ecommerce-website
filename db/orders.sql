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
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_amount` float NOT NULL,
  `order_transaction` varchar(255) NOT NULL,
  `order_payment` varchar(11) NOT NULL,
  `order_status` varchar(255) NOT NULL,
  `order_currency` varchar(255) NOT NULL,
  `order_date` date NOT NULL,
  `order_time` time(6) NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_amount`, `order_transaction`, `order_payment`, `order_status`, `order_currency`, `order_date`, `order_time`) VALUES
(39, 324.98, '2TG26025YM679144R', 'Paid', 'Shipped', 'NZD', '2017-06-13', '14:11:58.000000'),
(41, 600, '1U407568PP4467510', 'Paid', 'Shipped', 'NZD', '2017-06-13', '14:16:45.000000'),
(42, 899.99, '0W451778N1629891D', 'Paid', 'Waiting', 'NZD', '2017-06-13', '19:38:18.000000'),
(44, 500, '6RU22489WA633302N', 'Paid', 'Shipped', 'NZD', '2017-06-13', '20:35:01.000000'),
(45, 150, '2AE39325N75376939', 'Paid', 'Waiting', 'NZD', '2017-06-14', '00:33:12.000000'),
(46, 150, '2AE39325N75376939', 'Unpaid', 'Waiting', 'NZD', '2017-06-14', '00:33:12.000000'),
(47, 150, '2AE39325N75376939', 'Paid', 'Waiting', 'NZD', '2017-06-14', '00:39:00.000000'),
(48, 150, '2AE39325N75376939', 'Unpaid', 'Waiting', 'NZD', '2017-06-14', '00:39:00.000000');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
