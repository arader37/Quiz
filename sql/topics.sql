-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2019 at 02:32 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quiz_master`
--

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `order` int(50) NOT NULL,
  `topic` varchar(50) NOT NULL,
  `image_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`order`, `topic`, `image_name`) VALUES
(0, 'PHP', 'phparray1.png'),
(1, 'Dances', 'dances.jpg'),
(2, 'Dresses', 'dresses_and_costumes.png'),
(3, 'Embroidery', 'embroidery.png'),
(4, 'Festivals', 'festivals.png'),
(5, 'Foods', 'foods.png'),
(6, 'Intruments', 'musical_instruments.png'),
(7, 'Leaders', 'leaders_and_scientists.png'),
(8, 'Monuments', 'places_and_monuments.png'),
(9, 'Movies', 'movies.png'),
(10, 'NRIs', 'NRI_s.jpg'),
(11, 'Sports', 'sports.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD UNIQUE KEY `order` (`order`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
