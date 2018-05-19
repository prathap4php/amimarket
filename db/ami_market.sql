-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2018 at 04:14 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ami_market`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(65) NOT NULL,
  `email` varchar(65) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  `last_login_datetime` datetime NOT NULL,
  `last_login_ip` varchar(25) NOT NULL,
  `flag_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `email`, `mobile`, `password`, `created_on`, `updated_on`, `last_login_datetime`, `last_login_ip`, `flag_status`) VALUES
(1, 'admin', 'admin@gmail.com', '9123123123', '4297f44b13955235245b2497399d7a93', '2018-05-10 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `animation_types`
--

CREATE TABLE `animation_types` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `created_on` datetime NOT NULL,
  `modified_on` datetime NOT NULL,
  `flag_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `animation_types`
--

INSERT INTO `animation_types` (`id`, `title`, `description`, `created_on`, `modified_on`, `flag_status`) VALUES
(7, 'Traditional Animation', '2D, Cel, Hand Drawn', '2018-05-14 10:29:10', '2018-05-14 16:54:45', 1),
(9, '2D Animation', 'Vector-Based', '2018-05-14 10:36:01', '2018-05-18 16:45:05', 1),
(10, '3D Animation', 'CGI, Computer Animation', '2018-05-14 10:36:18', '2018-05-14 16:54:58', 1),
(11, 'Motion Graphics', 'Typography, Animated Logos', '2018-05-14 10:36:36', '2018-05-14 16:55:14', 1),
(12, 'Stop Motion', 'Claymation, Cut-Outs', '2018-05-14 10:36:48', '2018-05-14 16:55:24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `compitions`
--

CREATE TABLE `compitions` (
  `compition_id` int(11) NOT NULL,
  `casting` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  `date` varchar(30) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `description` varchar(250) NOT NULL,
  `created_on` datetime NOT NULL,
  `modified_on` datetime NOT NULL,
  `flag_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `compitions`
--

INSERT INTO `compitions` (`compition_id`, `casting`, `title`, `date`, `start_time`, `end_time`, `description`, `created_on`, `modified_on`, `flag_status`) VALUES
(7, 'zxcs', 'asdasd', '2-1-18', '01:00:00', '03:00:00', 'test', '2018-05-19 13:21:48', '0000-00-00 00:00:00', 1),
(8, 'test casting', 'test title', '02-12-2018', '03:15:00', '05:15:00', 'test description', '2018-05-19 15:27:42', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `compition_category`
--

CREATE TABLE `compition_category` (
  `comption_category_id` int(11) NOT NULL,
  `compition_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `compition_category`
--

INSERT INTO `compition_category` (`comption_category_id`, `compition_id`, `category_id`) VALUES
(9, 7, 11),
(10, 7, 7),
(11, 8, 12),
(12, 8, 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `animation_types`
--
ALTER TABLE `animation_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `compitions`
--
ALTER TABLE `compitions`
  ADD PRIMARY KEY (`compition_id`);

--
-- Indexes for table `compition_category`
--
ALTER TABLE `compition_category`
  ADD PRIMARY KEY (`comption_category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `animation_types`
--
ALTER TABLE `animation_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `compitions`
--
ALTER TABLE `compitions`
  MODIFY `compition_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `compition_category`
--
ALTER TABLE `compition_category`
  MODIFY `comption_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
