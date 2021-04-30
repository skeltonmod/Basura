-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2021 at 05:46 AM
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
-- Database: `schooldb`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(5) NOT NULL,
  `student_id` int(5) NOT NULL,
  `attendance_status` enum('Present','Absent') NOT NULL,
  `attendance_date` date NOT NULL,
  `teacher_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `student_id`, `attendance_status`, `attendance_date`, `teacher_id`) VALUES
(1, 1, 'Present', '2020-12-03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `course_name`) VALUES
(1, 'BS Information Technology'),
(2, 'BS Computer Science'),
(3, 'BS Computer Engineering'),
(4, 'Assoc Computer Technology');

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int(11) NOT NULL,
  `student_id` int(5) NOT NULL,
  `teacher_id` int(5) NOT NULL,
  `subject_id` int(5) NOT NULL,
  `course_id` int(11) NOT NULL COMMENT 'Subject ID',
  `grade` double(4,2) NOT NULL,
  `year` int(2) NOT NULL,
  `semester` int(2) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `student_id`, `teacher_id`, `subject_id`, `course_id`, `grade`, `year`, `semester`, `description`) VALUES
(1, 1, 2, 1, 1, 30.00, 2, 1, 'Quiz');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id` int(5) NOT NULL,
  `subject_id` int(5) NOT NULL,
  `teacher_id` int(5) NOT NULL,
  `student_id` int(5) NOT NULL,
  `start_time` varchar(255) NOT NULL,
  `end_time` varchar(255) NOT NULL,
  `start_day` varchar(255) NOT NULL,
  `end_day` varchar(255) NOT NULL,
  `room_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id`, `subject_id`, `teacher_id`, `student_id`, `start_time`, `end_time`, `start_day`, `end_day`, `room_name`) VALUES
(1, 1, 2, 1, '1', '2', 'Tuesday', 'Thursday', 'Room 1');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) DEFAULT NULL,
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
  `enrollment_date` date NOT NULL,
  `year_level` int(1) NOT NULL,
  `semester` int(1) NOT NULL,
  `course` int(1) NOT NULL,
  `status` enum('Enrolled','Drop') NOT NULL DEFAULT 'Enrolled',
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `fname`, `mname`, `lname`, `address`, `second_address`, `city`, `province`, `region`, `zip`, `email`, `phone`, `birthday`, `enrollment_date`, `year_level`, `semester`, `course`, `status`, `image`) VALUES
(1, 'Foobar', NULL, 'Foobar', 'e', 'Foobar', 'Foobar', 'Foobar', 'Foobar', 'Foobar', 'Foobar@Foobar.com', '12345678901', '2020-09-30', '2020-10-21', 2, 1, 1, 'Enrolled', 'Foobar.png'),
(2, 'Maxtor', NULL, 'Shasta', 'Foobar', 'Foobar', 'Foobar', 'Foobar', 'Foobar', '9000', 'shasta@gmail.com', '12456789011', '2021-01-19', '2021-01-19', 2, 1, 1, 'Enrolled', 'Maxtor.jpg'),
(3, 'Foobar', 'Foobar', 'Foobar', 'Foobar', 'Foobar', 'Foobar', 'Foobar', 'Foobar', '9000', 'oten@yahoo.com', '09432847921', '2021-09-28', '2021-01-21', 2, 1, 1, 'Enrolled', 'Foobar.png');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL COMMENT 'Subject ID',
  `subject_name` varchar(255) NOT NULL COMMENT 'Subject Name',
  `subject_code` varchar(255) NOT NULL COMMENT 'Subject Code',
  `units` double(4,2) NOT NULL COMMENT 'Units',
  `description` tinytext NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `start_year` int(11) NOT NULL,
  `end_year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject_name`, `subject_code`, `units`, `description`, `teacher_id`, `start_year`, `end_year`) VALUES
(1, 'English', '9001', 2.00, 'English Minor', 2, 2020, 2021);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `second_address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `number` varchar(255) NOT NULL,
  `department` int(1) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `fname`, `mname`, `lname`, `email`, `address`, `second_address`, `city`, `province`, `region`, `zip`, `birthday`, `number`, `department`, `image`, `status`) VALUES
(2, 'Jun', NULL, 'Tan', 'qatan@gmail.com', 'Foobar', 'Foobar', 'Foobar', 'Foobar', 'Foobar', '9000', '2020-12-03', '12345678901', 2, 'Jun.jpg', 1),
(3, 'Jorpetz', 'Brann', 'Rezon', 'foo@foo.com', 'Foobar', 'Foobar', 'Foobar', 'Foobar', 'Foobar', '9000', '2021-01-21', '12345678901', 2, 'Jorpetz.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(5) NOT NULL,
  `user_id` varchar(255) NOT NULL COMMENT 'teacher or student id',
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` enum('Admin','Student','Teacher') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_id`, `email`, `password`, `user_type`) VALUES
(1, '7', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 'Admin'),
(2, '1', 'Foobar@Foobar.com', 'f58961a11013174dfe55f3daf3fd0f49', 'Student'),
(4, '2', 'qatan@gmail.com', '5ddbf54a0213a219873376d3ff457592', 'Teacher'),
(5, '2', 'shasta@gmail.com', '03cf4456247bde2f72080f8ca3740a4f', 'Student'),
(6, '3', 'oten@yahoo.com', '399335c7d4c4917695dbf41944189b1e', 'Student'),
(7, '3', 'foo@foo.com', '8644c408c28b2c34586cdd6d1b0fd2ee', 'Teacher');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course` (`course`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department` (`department`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Subject ID', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
