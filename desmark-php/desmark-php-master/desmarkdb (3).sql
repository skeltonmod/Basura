-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2021 at 02:25 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

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
(1, '541', 'Jazz', 'Zabate', 'Foobar', 'Foobar', 'Foobar', 'Foobar', 'Foobar', 'Foobar', 'Imongmama10@gmail.com', '32132132121', '2020-12-16', 'Foobar', 'Jazz.png', 'Jazz.docx', 'New', 'Active', 'Single', 'Male'),
(2, '204', 'Brann', 'Jofran', 'Foobar', 'Foobar', 'Foobar', 'Foobar', 'Foobar', 'Foobar', 'Foobar', '4323324234', '2020-12-17', 'Foobar', 'Brann.jpg', 'Brann.docx', 'New', 'Active', 'Single', 'Male');

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
  `status` enum('Active','Inactive') NOT NULL,
  `civil_status` enum('Married','Single','Divorced','Widow') NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `branch` enum('Desmark Carmen','Desmark Cogon') NOT NULL DEFAULT 'Desmark Carmen'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `employee_id`, `fname`, `lname`, `address`, `second_address`, `city`, `province`, `region`, `zip`, `email`, `phone`, `birthday`, `occupation`, `status`, `civil_status`, `gender`, `branch`) VALUES
(1, '30', 'Louie', 'Japitan', 'Foobar', 'Foobar', 'Foobar', 'Foobar', 'Foobar', 'Foobar', 'louietestjapitan@employee.com', '21312312312333', '2020-12-03', 'Foobar', 'Active', 'Married', 'Male', 'Desmark Carmen'),
(2, '97', 'Ronn', 'Ronn', 'Balay', 'Balay', 'Balay', 'Balay', 'Balay', '9000', 'ronntest@gmail.com', '1245678901', '2021-01-29', 'Balay', 'Active', 'Married', 'Male', 'Desmark Cogon');

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
  `branch` enum('Carmen','Cogon') NOT NULL DEFAULT 'Carmen',
  `status` enum('Active','Inactive','Repo','Transferred') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `pname`, `pcode`, `stock`, `description`, `price`, `bname`, `mname`, `myear`, `branch`, `status`) VALUES
(1, 'Motor X', '412', 90, 'Two Wheels', 1000.00, 'Rusi', 'AMA', 1999, 'Carmen', 'Active'),
(2, 'Motor X', '412', 7, 'Two Wheels', 1000.00, 'Rusi', 'AMA', 1999, 'Cogon', 'Transferred');

-- --------------------------------------------------------

--
-- Table structure for table `owner_transaction`
--

CREATE TABLE `owner_transaction` (
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
  `type` enum('Installment','Full') NOT NULL,
  `status` enum('Non Repo','Repo') NOT NULL DEFAULT 'Non Repo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `owner_transaction`
--

INSERT INTO `owner_transaction` (`id`, `tid`, `tdate`, `cid`, `eid`, `pid`, `loaninterest`, `amount`, `downpayment`, `top`, `tp`, `mp`, `dd`, `type`, `status`) VALUES
(1, 564, '2021-01-09', 1, 2, 2, 15, 400.000, 200.000, 1, 550.000, 95.830, '2021-01-17', 'Installment', 'Non Repo'),
(2, 564, '2021-01-09', 2, 2, 2, 15, 200.000, 700.000, 1, 350.000, 95.830, '2021-01-18', 'Installment', 'Non Repo');

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
  `type` enum('Installment','Full') NOT NULL,
  `status` enum('Non Repo','Repo') NOT NULL DEFAULT 'Non Repo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `tid`, `tdate`, `cid`, `eid`, `pid`, `loaninterest`, `amount`, `downpayment`, `top`, `tp`, `mp`, `dd`, `type`, `status`) VALUES
(1, 564, '2021-01-09', 1, 2, 2, 15, 1000.000, 200.000, 1, 950.000, 95.830, '2021-01-17', 'Installment', 'Non Repo'),
(2, 564, '2021-01-09', 1, 2, 2, 10, 400.000, 0.000, 0, 550.000, 95.830, '2021-01-17', 'Installment', 'Non Repo'),
(3, 726, '2021-01-09', 2, 2, 2, 15, 1000.000, 700.000, 1, 450.000, 95.830, '2021-01-18', 'Installment', 'Non Repo'),
(4, 564, '2021-01-09', 1, 2, 2, 10, 200.000, 0.000, 0, 350.000, 95.830, '2021-01-17', 'Installment', 'Non Repo');

-- --------------------------------------------------------

--
-- Table structure for table `trans_inventory`
--

CREATE TABLE `trans_inventory` (
  `id` int(6) NOT NULL,
  `pname` varchar(255) NOT NULL,
  `pcode` varchar(255) NOT NULL,
  `stock` int(6) NOT NULL,
  `description` text NOT NULL,
  `price` double(7,2) NOT NULL,
  `bname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `myear` int(6) NOT NULL,
  `branch` enum('Carmen','Cogon') NOT NULL DEFAULT 'Carmen',
  `status` enum('Active','Inactive','Repo','Transferred') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `branch` enum('Desmark Cogon','Desmark Carmen') NOT NULL,
  `user_type` enum('customer','admin','employee','owner') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_id`, `email`, `password`, `branch`, `user_type`) VALUES
(1, 0, 'cogonadmin@admin.com', '5568840a85728b5c1de875d4b6f0cc6e', 'Desmark Cogon', 'admin'),
(2, 0, 'carmenadmin@admin.com', '5568840a85728b5c1de875d4b6f0cc6e', 'Desmark Carmen', 'admin'),
(3, 5, 'Foo@foo.com', '30106aa1151d9b8cc833732827294368', 'Desmark Carmen', 'employee'),
(4, 6, 'foobar@foobar.com', '8792b8cf71d27dc96173b2ac79b96e0d', 'Desmark Carmen', 'employee'),
(5, 7, 'test@test.com', 'd7688ec970040cb37e140a04dd9135f9', 'Desmark Cogon', 'employee'),
(6, 1, 'louietestjapitan@employee.com', '033836b6cedd9a857d82681aafadbc19', 'Desmark Carmen', 'employee'),
(7, 0, 'owner@owner.com', '5be057accb25758101fa5eadbbd79503', 'Desmark Cogon', 'owner'),
(8, 2, 'ronntest@gmail.com', '1ef1e348c94f1e7becec8e1cffbfedea', 'Desmark Cogon', 'employee');

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE `userlog` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `branch` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`id`, `name`, `action`, `date`, `branch`) VALUES
(1, 'carmenadmin@admin.com', 'Added 100 Rusi to Inventory', '2020-10-08', 'Desmark Carmen'),
(2, 'carmenadmin@admin.com', 'Login', '2021-01-09', 'Desmark Carmen'),
(3, 'cogonadmin@admin.com', 'Login', '2021-01-09', 'Desmark Cogon'),
(4, 'cogonadmin@admin.com', 'Login', '2021-01-09', 'Desmark Cogon'),
(5, 'cogonadmin@admin.com', 'Login', '2021-01-09', 'Desmark Cogon'),
(6, 'carmenadmin@admin.com', 'Login', '2021-01-09', 'Desmark Carmen'),
(7, 'cogonadmin@admin.com', 'Login', '2021-01-09', 'Desmark Cogon');

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
-- Indexes for table `owner_transaction`
--
ALTER TABLE `owner_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `owner_transaction`
--
ALTER TABLE `owner_transaction`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
