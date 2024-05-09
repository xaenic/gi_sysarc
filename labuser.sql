-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2024 at 05:21 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `labuser`
--

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `content` varchar(254) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `student_id`, `content`, `date_created`) VALUES
(1, 18, 'test feedback', '2024-05-06 23:01:25'),
(2, 18, 'test feedback', '2024-05-06 23:01:40'),
(3, 18, 'asdasdasda', '2024-05-06 23:02:24'),
(4, 18, ' Lorem ipsum, dolor sit amet consectetur adipisicing elit. A fuga rem minus soluta illo perferendis commodi distinctio dolorum aperiam dolor, debitis excepturi, ullam voluptate voluptatem alias animi accusantium sed voluptates.', '2024-05-06 23:07:28');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `session_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `laboratory` varchar(254) NOT NULL,
  `purpose` varchar(254) NOT NULL,
  `time_in` datetime NOT NULL DEFAULT current_timestamp(),
  `time_out` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`session_id`, `student_id`, `laboratory`, `purpose`, `time_in`, `time_out`) VALUES
(1, 2, 'Lab 524', 'Java', '2024-03-25 18:36:09', '2024-03-25 17:21:11'),
(19, 18, 'Lab 524', 'Java', '2024-03-26 01:09:07', '2024-03-26 01:19:44'),
(20, 18, 'Lab 524', 'Java', '2024-03-26 01:19:52', '2024-03-26 01:19:52'),
(21, 18, 'Lab 524', 'Java', '2024-03-26 01:19:57', '2024-03-26 01:19:59'),
(22, 18, 'Lab 524', 'Java', '2024-03-26 01:20:05', '2024-03-26 01:20:07'),
(23, 18, 'Lab 524', 'Java', '2024-03-26 01:20:11', '2024-03-26 01:20:11'),
(24, 18, 'Lab 524', 'Java', '2024-03-26 01:20:16', '2024-03-26 01:20:16'),
(25, 18, 'Lab 524', 'Java', '2024-03-26 01:20:21', '2024-03-26 01:20:21'),
(26, 18, 'Lab 524', 'Java', '2024-03-26 01:20:41', '2024-03-26 01:20:42');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `firstname` varchar(150) NOT NULL,
  `lastname` varchar(150) NOT NULL,
  `middlename` varchar(150) NOT NULL,
  `age` int(150) NOT NULL,
  `gender` varchar(150) NOT NULL,
  `address` varchar(150) NOT NULL,
  `phone` int(150) NOT NULL,
  `idno` int(150) NOT NULL,
  `sessions` int(11) NOT NULL DEFAULT 30
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `email`, `password`, `firstname`, `lastname`, `middlename`, `age`, `gender`, `address`, `phone`, `idno`, `sessions`) VALUES
(2, 'kira@gmail.com', '123', 'tan', 'kira', 'MELVIN', 2, 'male', 'sdsadsa', 2147483647, 21322, 29),
(17, 'allanvillegas35@gmail.com', '123123', 'Ako l', 'Hehe', 'Caba', 26, 'Male', 'asdasdas', 231321, 214190231, 30),
(18, 'allanv@gmail.com', '123123', 'Allan ', 'Vil', 'Caa', 27, 'Male', 'asdasdsa', 21312312, 21419023, 13);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_student_id_feedback` (`student_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`session_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idno` (`idno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `session_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `fk_student_id_feedback` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
