-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 13, 2020 at 06:05 AM
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
-- Database: `desmarkdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `second_address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `document` varchar(255) NOT NULL,
  `account_status` enum('Paid','Unpaid','New') NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `civil_status` enum('Married','Single','Divorced','Widow') NOT NULL,
  `gender` enum('Male','Female') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `account_name`, `fname`, `lname`, `address`, `second_address`, `city`, `province`, `region`, `zip`, `email`, `phone`, `birthday`, `occupation`, `image`, `document`, `account_status`, `status`, `civil_status`, `gender`) VALUES
(1, '481', 'Elijah', 'Abgao', 'Balay', 'Balay', 'Balay', 'Balay', 'X', '9000', 'abgaoe@gmail.com', '543534534', '2020-06-03', 'Kargador', 'Elijah.png', 'Elijah.pdf', 'New', 'Active', 'Single', 'Male'),
(2, '93', 'Jazz', 'Zabate', 'Balay Gihapon', 'Balay', 'Balay', 'Balay', 'X', '9000', 'imongmama10@gmail.com', '78978978', '2020-05-07', 'Tig Hilot', 'Jazz.png', 'Jazz.pdf', 'New', 'Active', 'Divorced', 'Male'),
(3, '161', 'Brann', 'Boyboy', 'Balay', 'Balay', 'Balay', 'Balay', 'X', '9000', 'shokoy@shokoynet.com', '31321312', '1999-08-18', 'Mamayotay', 'Brann.png', 'Brann.pdf', 'New', 'Active', 'Widow', 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `second_address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `document` varchar(255) NOT NULL,
  `resume` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `civil_status` enum('Married','Single','Divorced','Widow') NOT NULL,
  `gender` enum('Male','Female') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `employee_id`, `fname`, `lname`, `address`, `second_address`, `city`, `province`, `region`, `zip`, `email`, `phone`, `birthday`, `occupation`, `image`, `document`, `resume`, `status`, `civil_status`, `gender`) VALUES
(1, '29', 'Jun', 'Tan', 'Balay', 'Balay', 'Balay', 'Balay', 'x', '9000', 'Jun@gmail.com', '86787868', '2020-06-30', 'Supervisor', 'Jun.png', 'Jun.pdf', 'Jun_resume.pdf', 'Active', 'Single', 'Male'),
(2, '75', 'Paul', 'Peligro', 'Balay', 'Balay', 'Balay', 'Balay', 'X', '9000', 'mcjohn@gmail.com', '24324234', '2020-07-01', 'Teacher', 'Paul.png', 'Paul.pdf', 'Paul_resume.pdf', 'Active', 'Married', 'Male'),
(3, '61', 'Mark', 'Magpatoc', 'Balay', 'Balay', 'Balay', 'Balay', 'Balay', 'Balay', 'devilmark@gmail.com', '767567567', '2020-06-04', 'Kargador', 'Mark.png', 'Mark.pdf', 'Mark_resume.pdf', 'Active', 'Married', 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(6) NOT NULL,
  `pname` varchar(255) NOT NULL,
  `pcode` varchar(255) NOT NULL,
  `stock` int(6) NOT NULL,
  `description` text NOT NULL,
  `price` double(7,2) NOT NULL,
  `bname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `myear` int(6) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `pname`, `pcode`, `stock`, `description`, `price`, `bname`, `mname`, `myear`, `status`) VALUES
(1, 'Mahal na Motor', '134', 13, 'Mahal nga motor dili nimo ma afford', 6800.20, 'Motolite', 'Nokia', 1995, 'Active'),
(2, 'Barato nga Motor', '463', 13, 'Cheap dali ra maguba', 1000.40, 'Rusi', 'Gubaon', 1999, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(7) NOT NULL,
  `tid` int(7) NOT NULL,
  `tdate` date NOT NULL COMMENT 'Transaction Date',
  `cid` int(7) NOT NULL,
  `eid` int(7) NOT NULL,
  `pid` int(7) NOT NULL COMMENT 'Product ID',
  `loaninterest` int(7) NOT NULL,
  `amount` double(10,3) NOT NULL,
  `downpayment` double(7,3) NOT NULL,
  `top` int(7) NOT NULL COMMENT 'Term of Payment',
  `tp` double(7,3) NOT NULL COMMENT 'Total Paid',
  `mp` double(7,3) NOT NULL COMMENT 'Monthly Payment',
  `dd` date NOT NULL COMMENT 'Due Date',
  `type` enum('Installment','Full') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `tid`, `tdate`, `cid`, `eid`, `pid`, `loaninterest`, `amount`, `downpayment`, `top`, `tp`, `mp`, `dd`, `type`) VALUES
(1, 867, '2020-08-13', 1, 2, 1, 10, 1000.000, 2000.000, 1, 4480.220, 623.350, '2020-08-19', 'Installment'),
(2, 55, '2020-08-13', 3, 3, 1, 10, 6800.200, 1500.000, 1, 5980.220, 623.350, '2020-08-31', 'Installment'),
(3, 547, '2020-08-13', 1, 2, 2, 10, 501.000, 500.000, 1, -0.560, 91.700, '2020-08-27', 'Full'),
(4, 960, '2020-08-13', 3, 3, 1, 10, 5000.000, 2500.000, 1, 4762.650, 623.350, '2020-08-01', 'Installment');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
