-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 24, 2022 at 10:19 PM
-- Server version: 8.0.12
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tyries_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `ty_cart`
--

DROP TABLE IF EXISTS `ty_cart`;
CREATE TABLE IF NOT EXISTS `ty_cart` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `cart_user_id` int(100) NOT NULL,
  `cart_user_name` varchar(200) NOT NULL,
  `cart_name` varchar(200) NOT NULL,
  `cart_price` varchar(100) NOT NULL,
  `cart_quantity` int(100) NOT NULL,
  `cart_image` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ty_orders`
--

DROP TABLE IF EXISTS `ty_orders`;
CREATE TABLE IF NOT EXISTS `ty_orders` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` int(100) NOT NULL,
  `name` varchar(120) NOT NULL,
  `number` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `total_products` varchar(100) NOT NULL,
  `total_price` int(11) NOT NULL,
  `placed_on` varchar(100) NOT NULL,
  `payment_status` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ty_orders`
--

INSERT INTO `ty_orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(1, 5, 'Jasper', '0268154245', 'jasper@gmail.com', 'cash on delivery', 'ghana', '  Honey Oils  (2)  Tumeric  (4)', 120, '16-Jul-2022', 'completed'),
(2, 5, 'Jasper', '02854124', 'jasper@gmail.com', 'cash on delivery', 'Dubai-Carter', '  Soap  (2)', 46, '18-Jul-2022', 'completed'),
(3, 5, 'Jasper', '0268141242', 'jasper@gmail.com', 'credit card', 'Kasoa', '  Honey Oils  (3)', 42, '11-Aug-2022', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `ty_products`
--

DROP TABLE IF EXISTS `ty_products`;
CREATE TABLE IF NOT EXISTS `ty_products` (
  `id` int(250) NOT NULL AUTO_INCREMENT,
  `pro_name` varchar(100) NOT NULL,
  `pro_price` int(100) NOT NULL,
  `pro_details` varchar(5000) NOT NULL,
  `pro_image` varchar(100) NOT NULL,
  `featured` varchar(200) NOT NULL,
  `category` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ty_products`
--

INSERT INTO `ty_products` (`id`, `pro_name`, `pro_price`, `pro_details`, `pro_image`, `featured`, `category`) VALUES
(2, 'Honey Oils', 14, 'Good for the hair. Apply to the scalp twice a day to give your hair the needed nutrients and style it easily', '9.jpg', 'feature', 'oil'),
(3, 'Tumeric', 23, 'Tumeric is good for your skin', '13.jpg', 'feature', 'soap'),
(4, 'Soap', 23, 'Soap helps keep the body clean', '14.jpg', 'feature', 'soap'),
(5, 'Package', 34, 'A package for that special person', '8.jpg', 'feature', 'package');

-- --------------------------------------------------------

--
-- Table structure for table `ty_users`
--

DROP TABLE IF EXISTS `ty_users`;
CREATE TABLE IF NOT EXISTS `ty_users` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_type` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ty_users`
--

INSERT INTO `ty_users` (`id`, `user_name`, `user_email`, `user_password`, `user_type`) VALUES
(4, 'Ruth', 'ruth@gmail.com', '81ea66d57d6b827ef722f4f20f8a669c', 'admin'),
(5, 'Jasper', 'jasper@gmail.com', '02b0732024cad6ad3dc2989bc82a1ef5', 'user');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
