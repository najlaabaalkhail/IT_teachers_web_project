-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2018 at 11:40 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kafua`
--

-- --------------------------------------------------------

--
-- Table structure for table `admain`
--

CREATE TABLE `admain` (
  `email` varchar(40) NOT NULL,
  `passwoed` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `courseName` varchar(40) NOT NULL,
  `contact` varchar(1000) NOT NULL,
  `courseMark` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`courseName`, `contact`, `courseMark`) VALUES
('NULL', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `taskName` varchar(40) NOT NULL,
  `description` varchar(5000) NOT NULL,
  `taskMark` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`taskName`, `description`, `taskMark`) VALUES
('NULL', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `firstName` varchar(20) NOT NULL,
  `midName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `qualification` varchar(15) NOT NULL,
  `yearsOfService` varchar(2) NOT NULL,
  `school` varchar(20) NOT NULL,
  `level` varchar(5) NOT NULL,
  `office` varchar(12) NOT NULL,
  `courseName` varchar(40) DEFAULT NULL,
  `taskName` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`firstName`, `midName`, `lastName`, `password`, `email`, `phone`, `qualification`, `yearsOfService`, `school`, `level`, `office`, `courseName`, `taskName`) VALUES
('maha', 'saad', 'alotaibi', '12341234', 'he-qa@hotmail.com', '0503117917', 'Ø¯Ø¨Ù„ÙˆÙ…', '15', '17', 'Ø«Ø§Ù', 'Ø§Ù„Ù…Ø²Ø§Ø­', NULL, NULL),
('Ù†Ø¬Ù„Ø§Ø¡', 'ØºØ§Ø²ÙŠ', 'Ø§Ù„Ù‚ÙØ§Ø±ÙŠ', '12345678', 'najlakhalid@gmail.com', '0543364325', 'Ø¨ÙƒØ§Ù„ÙˆØ±ÙŠØ', '03', '17', 'Ù…ØªÙ', 'Ø§Ù„Ø±Ø§ÙˆØ¨', NULL, NULL),
('Ù†Ø¬Ù„Ø§Ø¡', 'Ù…', 'ÙŠ', '11111111', 'najlakhalied7@gmail.com', '1111111111', 'Ø¨ÙƒØ§Ù„ÙˆØ±ÙŠÙ', '5', '333', 'Ù…ØªÙ', 'Ù…ØªÙˆØ³Ø·', NULL, NULL),
('Ù†Ø¬Ù„Ø§Ø¡', 'Ù…', 'ÙŠ', '11111111', 'najlakhalieddd@gmail.com', '1111111111', 'Ø¨ÙƒØ§Ù„ÙˆØ±ÙŠÙ', '5', '333', 'Ù…ØªÙ', 'Ù…ØªÙˆØ³Ø·', NULL, NULL),
('Ù†Ø¬Ù„Ø§Ø¡', 'Ù…', 'ÙŠ', '11111111', 'nouf1@gmail.com', '1111111111', 'Ø¨ÙƒØ§Ù„ÙˆØ±ÙŠÙ', '5', '333', 'Ù…ØªÙ', 'Ù…ØªÙˆØ³Ø·', NULL, NULL),
('Ù†Ø¬Ù„Ø§Ø¡', 'Ù…', 'ÙŠ', '11111111', 'nouf4@gmail.com', '1111111111', 'Ø¨ÙƒØ§Ù„ÙˆØ±ÙŠÙ', '5', '333', 'Ù…ØªÙ', 'Ù…ØªÙˆØ³Ø·', NULL, NULL),
('Ù†Ø¬Ù„Ø§Ø¡', 'Ù…', 'ÙŠ', '11111111', 'nouf5@gmail.com', '1111111111', 'Ø¨ÙƒØ§Ù„ÙˆØ±ÙŠÙ', '5', '333', 'Ù…ØªÙ', 'Ù…ØªÙˆØ³Ø·', NULL, NULL),
('Ø³Ù„Ù…Ù‰', 'ØºØ§Ø²ÙŠ', 'Ø§Ù„Ù‚ÙØ§Ø±ÙŠ', '11111111', 'nouf@gmail.com', '0543364325', 'Ø¨ÙƒØ§Ù„ÙˆØ±ÙŠØ', '03', '360', 'Ù…ØªÙ', 'Ø«Ø§Ø¯Ù‚', NULL, NULL),
('Ø³Ù„Ù…Ù‰', 'ØºØ§Ø²ÙŠ', 'Ø§Ù„Ù‚ÙØ§Ø±ÙŠ', '12345678', 'ragybra@gmail.com', '0543364325', 'Ø¨ÙƒØ§Ù„ÙˆØ±ÙŠØ', '4', '360', 'Ù…ØªÙ', 'Ø­Ø±ÙŠÙ…Ù„Ø§', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admain`
--
ALTER TABLE `admain`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`courseName`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`taskName`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`email`(40)),
  ADD UNIQUE KEY `taskName` (`taskName`),
  ADD UNIQUE KEY `courseName` (`courseName`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
