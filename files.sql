-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 20, 2019 at 07:22 AM
-- Server version: 5.6.37
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `files`
--

-- --------------------------------------------------------

--
-- Table structure for table `files_t`
--

CREATE TABLE IF NOT EXISTS `files_t` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `client_name` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `file_name` varchar(100) NOT NULL,
  `date_uploaded` datetime NOT NULL,
  `file_exists` varchar(3) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `files_t`
--

INSERT INTO `files_t` (`id`, `client_id`, `client_name`, `user_id`, `user_name`, `file_name`, `date_uploaded`, `file_exists`) VALUES
(1, 101, 'Global', 1, 'Peter Potter', 'a.pdf', '2019-02-19 06:07:34', NULL),
(2, 102, 'General', 1, 'Peter Potter', 'd.pdf', '2019-02-19 06:07:34', NULL),
(3, 101, 'Global', 3, 'Will Weasley', 'c.pdf', '2019-02-22 06:07:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_t`
--

CREATE TABLE IF NOT EXISTS `user_t` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_t`
--

INSERT INTO `user_t` (`id`, `name`, `pass`) VALUES
(1, 'leki', 'leki');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `files_t`
--
ALTER TABLE `files_t`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_t`
--
ALTER TABLE `user_t`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `files_t`
--
ALTER TABLE `files_t`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user_t`
--
ALTER TABLE `user_t`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
