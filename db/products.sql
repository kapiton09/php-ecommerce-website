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
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_title` varchar(255) NOT NULL,
  `product_category_id` int(11) NOT NULL,
  `product_supplier_id` int(11) NOT NULL,
  `product_price` float NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `short_desc` text NOT NULL,
  `product_description` text NOT NULL,
  `product_image` varchar(255) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_title`, `product_category_id`, `product_supplier_id`, `product_price`, `product_quantity`, `short_desc`, `product_description`, `product_image`) VALUES
(1, 'Laptop Bag', 1, 1, 24.99, 3, 'Leather Laptop Bag', 'High quality leather bag for laptops.', 'mens-bag-6.jpg'),
(2, 'Designer Bag', 2, 1, 299.99, 2, 'Designer Bag with high quality leather.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin malesuada massa vel nulla cursus tempus. Ut efficitur odio lectus, in feugiat tortor dignissim sit amet. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin malesuada massa vel nulla cursus tempus. Ut efficitur odio lectus, in feugiat tortor dignissim sit amet. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin malesuada massa vel nulla cursus tempus. Ut efficitur odio lectus, in feugiat tortor dignissim sit amet. ', 'women-bag-3.jpg'),
(3, 'Adidas Bag', 1, 2, 100, 9, 'Genuine Adidas bag', 'High Quality bagpack from Adidas.', 'adidas-bag.jpg'),
(13, 'Men Back Pack', 1, 2, 89, 7, 'High Quality Backpack bag', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec congue in dolor ac efficitur. Maecenas eu eros sit amet purus consectetur interdum. Aenean in diam et erat sollicitudin molestie eget ac augue. Pellentesque hendrerit pulvinar sodales. Suspendisse porta magna cursus, maximus leo non, sollicitudin nisi. Maecenas consectetur pulvinar lorem, a iaculis turpis sodales sed. Quisque dictum fringilla efficornare augue vel metus facilisis molestie. Phasellus ut leo non lacus fermentum porta. Maecenas ac enim in est placerat tincidunt. Nulla quis sem vitae risus rhoncus pharetra hendrerit sit amet lorem. Aenean porttitor vestibulum tellus, hendrerit viverra lectus sagittis id. Donec auctor justo risus, quis venenatis massa porttitor quis. Nulla facilisi. Quisque ac iaculis lorem. Phasellus vitae egestas nisl. ', 'mens-bag-8.jpg'),
(14, 'Alligator Bag', 2, 4, 600, 2, 'This is a bag from high quality leather.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam elementum est sollicitudin, fringilla risus sit amet, efficitur augue. Sed ligula diam, convallis nec lectus in, porta scelerisque est. Nunc faucibus risus quis orci tincidunt hendrerit. Sed eget pharetra lacus. Suspendisse sit amet fermentum sapien. Vestibulum blandit consectetur ante, eget varius massa interdum vitae. Suspendisse consequat ut est et interdum. Proin laoreet vestibulum ultrices. ', 'women-bag-8.jpg'),
(15, 'Unicorn Bag', 3, 4, 50, 5, 'Unicorn Bag for Kids. ', 'Unicorn Bag for Kids. Unicorn Bag for Kids. Unicorn Bag for Kids. Unicorn Bag for Kids. Unicorn Bag for Kids. Unicorn Bag for Kids. Unicorn Bag for Kids. Unicorn Bag for Kids. Unicorn Bag for Kids. Unicorn Bag for Kids. ', 'kids-bag-1.jpg'),
(16, 'Pink Bag', 3, 1, 20, 20, 'Nice pink bag for kids. ', 'Nice pink bag for kids with horse drawing. Nice pink bag for kids. Nice pink bag for kids. Nice pink bag for kids. Nice pink bag for kids. Nice pink bag for kids. ', 'kids-bag-2.jpg'),
(17, 'Minion bag', 3, 4, 50, 3, 'Yellow minion shaped bag.', 'Yellow minion shaped bag. Great quality.', 'kids-bag-4.jpg'),
(18, 'Pink Side Bag', 2, 1, 100, 10, 'High quality pink side bag', 'High quality pink side bag for women. Latest design.', 'women-bag-9.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
