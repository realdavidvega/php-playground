-- phpMyAdmin SQL Dump
-- version 4.0.6deb1
-- http://www.phpmyadmin.net
--
-- Server: localhost
-- Generation time: 17-11-2013
-- Server version: 5.5.34-0ubuntu0.13.10.1
-- PHP version: 5.5.3-1ubuntu2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- BBDD `pizzeria`
--

-- --------------------------------------------------------

--
-- Structure for table `offer`
--

CREATE TABLE IF NOT EXISTS `offer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) COLLATE utf8_bin NOT NULL,
  `image` varchar(100) COLLATE utf8_bin NOT NULL,
  `description` varchar(500) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=17 ;

--
-- Data for table `offer`
--

INSERT INTO `offer` (`id`, `title`, `image`, `description`) VALUES
(3, 'Free drink ordering two pizzas', 'pizza3.jpg', 'Ordering two pizzas you get free drink (alcoholic drinks are not included).'),
(15, 'Weekends Deal: Funghi pizzas medium and large for the price of small', 'pizza1.jpg', 'During this week, you get Funghi pizzas for medium and large for the price of small.'),
(16, 'Free pepperoni', 'pizza2.jpg', 'BBQ with albahaca gives you free pepperoni.');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
