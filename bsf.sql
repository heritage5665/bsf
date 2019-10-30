-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2019 at 02:47 PM
-- Server version: 5.7.17
-- PHP Version: 7.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bsf`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendants`
--

CREATE TABLE `attendants` (
  `id` int(199) UNSIGNED NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `phone_num` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `suggestions` text NOT NULL,
  `attending` varchar(7) NOT NULL,
  `reminder` varchar(3) NOT NULL,
  `church` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendants`
--

INSERT INTO `attendants` (`id`, `full_name`, `phone_num`, `email`, `suggestions`, `attending`, `reminder`, `church`, `date_created`) VALUES
(1, 'ade', '099877777777777', 'ade@com.net', 'sdujuughhhhhhhhhfkjjjjjjjjjjjjjjjj', 'yes', 'yes', 'oke ona', '2019-10-29 13:13:04'),
(2, 'Adegoke Yousaf', '08161280941', 'adegokeyousaf@gmail.com', 'hhhhhhhhhhhhhhhhhhhhhhhh', 'Yes', 'yes', 'itu-oke', '2019-10-29 13:51:33'),
(3, 'Adegoke Yosola', '08161280976', 'adegokejjuyof@gmail.com', 'addaddadadaddddddddddddddddddddddddd', 'Yes', 'yes', 'DDC', '2019-10-29 20:11:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) DEFAULT NULL,
  `usr_name` varchar(255) NOT NULL,
  `pswd` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `usr_name`, `pswd`, `is_admin`, `date_created`) VALUES
(NULL, 'adegokeddj236@gmail.com', 'e5a649fad1e2dac70159c654e6907b378ff680d8', 1, '2019-10-29 14:58:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendants`
--
ALTER TABLE `attendants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendants`
--
ALTER TABLE `attendants`
  MODIFY `id` int(199) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
