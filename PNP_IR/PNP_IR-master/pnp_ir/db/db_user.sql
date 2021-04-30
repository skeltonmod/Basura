-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2020 at 07:41 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_user`
--

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `image` varchar(500) NOT NULL,
  `tags` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `image`, `tags`) VALUES
(1, '', 'yobs'),
(2, '14484872_1097618403679322_9182258567218559512_n.png', 'yobs1'),
(3, '1583253541329.png', '1');

-- --------------------------------------------------------

--
-- Table structure for table `incidents`
--

CREATE TABLE `incidents` (
  `id` int(11) NOT NULL,
  `image` varchar(500) NOT NULL,
  `incidenttype` varchar(500) NOT NULL,
  `informanttype` varchar(500) NOT NULL,
  `date` varchar(500) NOT NULL,
  `time` varchar(500) NOT NULL,
  `latitude` varchar(500) NOT NULL,
  `longitude` varchar(500) NOT NULL,
  `city` varchar(500) NOT NULL,
  `street` varchar(500) NOT NULL,
  `informantname` varchar(500) NOT NULL,
  `status` varchar(500) NOT NULL,
  `informantid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `incidents`
--

INSERT INTO `incidents` (`id`, `image`, `incidenttype`, `informanttype`, `date`, `time`, `latitude`, `longitude`, `city`, `street`, `informantname`, `status`, `informantid`) VALUES
(1, '1587309918650.png', 'Crime', '', '19-04-2020', '23:24 GMT+08:00', '8.4859667', '124.645205', 'Barangay 17', 'Barangay 17', 'Brann', 'Pending', 1),
(2, '1587309943031.png', 'Crime', 'Victim', '19-04-2020', '23:24 GMT+08:00', '8.4859667', '124.645205', 'Consolacion', 'Consolacion', 'Brann', 'Pending', 1);

-- --------------------------------------------------------

--
-- Table structure for table `informants`
--

CREATE TABLE `informants` (
  `id` int(5) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `suffix` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `citizenship` varchar(255) NOT NULL,
  `civilstatus` varchar(255) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `educ` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `mobilenumber` varchar(255) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `pob` varchar(255) NOT NULL,
  `currentaddress` varchar(500) NOT NULL,
  `homeaddress` varchar(500) NOT NULL,
  `occupation` varchar(500) NOT NULL,
  `workaddress` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `informants`
--

INSERT INTO `informants` (`id`, `firstname`, `suffix`, `lastname`, `middlename`, `email`, `password`, `citizenship`, `civilstatus`, `dob`, `educ`, `gender`, `mobilenumber`, `nickname`, `pob`, `currentaddress`, `homeaddress`, `occupation`, `workaddress`) VALUES
(1, 'Brann', '', 'Boyboy', 'Rezon', 'jorpetz@gmail.com', 'b9d52a3e899c0758cbf7ff2797212b78', 'Shokoy', 'Way Uyab!', '08/18/1999', 'College', 'Male', '09953875103', 'dmax', 'Balulang', 'balulaang', 'balulaang', 'Panday', 'balulaang'),
(4, '', '', '', '', '', 'd41d8cd98f00b204e9800998ecf8427e', '', 'Divorced', '', '', '', '', '', '', '  ', '  ', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `informant_image`
--

CREATE TABLE `informant_image` (
  `id` int(11) NOT NULL,
  `image` varchar(500) NOT NULL,
  `informant_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `informant_image`
--

INSERT INTO `informant_image` (`id`, `image`, `informant_id`) VALUES
(1, '1583769822535.png', 3),
(2, '1583770451996.png', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incidents`
--
ALTER TABLE `incidents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `informants`
--
ALTER TABLE `informants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `informant_image`
--
ALTER TABLE `informant_image`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `incidents`
--
ALTER TABLE `incidents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `informants`
--
ALTER TABLE `informants`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `informant_image`
--
ALTER TABLE `informant_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
