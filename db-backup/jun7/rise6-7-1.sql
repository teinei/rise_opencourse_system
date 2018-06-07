-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 07, 2018 at 04:03 AM
-- Server version: 5.6.34-log
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rise`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `class_id` int(11) NOT NULL,
  `class_stage` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `class_number` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `d_teacher` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `co_teacher` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `open1` date DEFAULT NULL,
  `open2` date DEFAULT NULL,
  `open3` date DEFAULT NULL,
  `graduate_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`class_id`, `class_stage`, `class_number`, `d_teacher`, `co_teacher`, `start_date`, `open1`, `open2`, `open3`, `graduate_date`) VALUES
(4, 'k1', '072', 'vivi', 'lina', '2018-05-23', '2018-08-01', '2018-10-20', '2018-12-29', '2019-03-20'),
(5, 'k1', '071', 'nisa', 'lina', '2018-04-22', '2018-07-05', '2018-09-16', '2018-12-09', '2019-02-28'),
(6, 's3', '033', 'ivy', 'christy', '2018-05-16', '2018-07-25', '2018-10-24', '2018-12-29', '2018-03-20'),
(7, 'k2', '073', 'maggie', 'daisy', '2018-05-13', '2018-07-22', '2018-10-12', '2018-12-21', '2019-02-22'),
(8, 'k2', '063', 'sarah', 'lina', '2018-05-05', '2018-07-30', '2018-10-22', '2018-12-31', '2019-02-25'),
(9, '1', '1', '1', '1', '2018-08-01', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `openlessons`
--

CREATE TABLE `openlessons` (
  `open_id` int(11) NOT NULL,
  `open_date` date DEFAULT NULL,
  `ordinal` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `class_number` varchar(128) DEFAULT NULL,
  `percent` float DEFAULT NULL,
  `issues` text CHARACTER SET utf8 COLLATE utf8_bin
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `openlessons`
--

INSERT INTO `openlessons` (`open_id`, `open_date`, `ordinal`, `class_id`, `class_number`, `percent`, `issues`) VALUES
(4, NULL, NULL, NULL, '42', 0.99, 'nothing'),
(5, NULL, NULL, NULL, '43', 0.99, 'nothing'),
(6, NULL, NULL, NULL, '42', 100, 'ddd'),
(7, NULL, NULL, NULL, '1', 1, '1'),
(8, NULL, NULL, NULL, '1', 1, '1'),
(9, NULL, NULL, NULL, '1', 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `open_lesson_scores`
--

CREATE TABLE `open_lesson_scores` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `class_number` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `ordinal` int(11) DEFAULT NULL,
  `q1` int(11) DEFAULT NULL,
  `q2` int(11) DEFAULT NULL,
  `q3` int(11) DEFAULT NULL,
  `q4` int(11) DEFAULT NULL,
  `q5` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `student_name` varchar(255) DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `suggests`
--

CREATE TABLE `suggests` (
  `id` int(11) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `class_number` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `ordinal` int(11) DEFAULT NULL,
  `text1` text,
  `text2` text,
  `text3` text,
  `check1` int(11) DEFAULT NULL,
  `check2` int(11) DEFAULT NULL,
  `check3` int(11) DEFAULT NULL,
  `check4` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `surveys`
--

CREATE TABLE `surveys` (
  `survey_id` int(11) NOT NULL,
  `open_date` date DEFAULT NULL,
  `q1` int(11) DEFAULT NULL,
  `q2` int(11) DEFAULT NULL,
  `q3` int(11) DEFAULT NULL,
  `q4` int(11) DEFAULT NULL,
  `q5` int(11) DEFAULT NULL,
  `average` float DEFAULT NULL,
  `q11` int(11) DEFAULT NULL,
  `text1` text,
  `text2` text,
  `text3` text,
  `student_name` varchar(128) DEFAULT NULL,
  `class_number` varchar(128) DEFAULT NULL,
  `ordinal` int(11) DEFAULT NULL,
  `d_teacher` varchar(128) DEFAULT NULL,
  `co_tea` varchar(128) DEFAULT NULL,
  `tel` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `surveys`
--

INSERT INTO `surveys` (`survey_id`, `open_date`, `q1`, `q2`, `q3`, `q4`, `q5`, `average`, `q11`, `text1`, `text2`, `text3`, `student_name`, `class_number`, `ordinal`, `d_teacher`, `co_tea`, `tel`) VALUES
(1, '2018-05-21', 10, 10, 10, 10, 10, 10, NULL, '', '', 'å¸Œæœ›å¤šç»„ç»‡å®¶é•¿éšå ‚å¬çš„è¯¾ç¨‹ï¼Œè®©å®¶é•¿å¤šäº†è§£ç‘žæ€çš„æ•™å­¦æ¨¡å¼', 'oscar', 'K2061', 1, 'lemon', 'ruby', NULL),
(2, '2018-05-21', 10, 10, 10, 10, 10, 10, NULL, '', 'å¬åŠ›å£è¯­è¡¨è¾¾è¿›æ­¥å¾ˆå¤§', 'hansonä¸Šè¯¾æ³¨æ„åŠ›ä¸é›†ä¸­ï¼Œè€å¸ˆä¸¥æ ¼è¦æ±‚ä»–', 'hanson', 'K2061', 1, 'lemon', 'ruby', NULL),
(5, '2018-05-21', 10, 10, 10, 10, 10, 10, NULL, 'ä¼šç»§ç»­æŠ¥', 'å£è¯­è¡¨è¾¾èƒ½åŠ›ï¼Œå£°éŸ³æ´ªäº®ï¼Œå¤§èƒ†', 'éžå¸¸æ»¡æ„', 'shirley', 'K2061', 1, 'lemon', 'ruby', NULL),
(7, '2018-05-21', 10, 10, 10, 10, 10, NULL, NULL, '', 'å£°éŸ³æ´ªäº®ï¼Œäº’åŠ¨å¾ˆå¥½', '', 'lucy', 'K2061', 1, 'lemon', 'ruby', NULL),
(8, '2018-06-01', 10, 10, 10, 10, 10, 10, 1, '', 'å¯å…¨è¯¾ç¨‹å¬æ‡‚æ•™å­¦å†…å®¹', '', 'david', 'S2039', 1, 'ivy', 'ruby', NULL),
(9, '2018-06-01', 10, 10, 10, 10, 10, 10, 2, '', '', 'è¯¾ç¨‹ç”ŸåŠ¨æ´»æ³¼ï¼Œå¼•å‘å­©å­éžå¸¸é«˜çš„å…´è¶£å­¦ä¹ ã€‚è¿™ç§å½¢å¼å¾ˆå¥½ã€‚', 'sky', 'S2039', 1, 'ivy', 'ruby', NULL),
(10, '2018-06-01', 9, 9, 9, 9, 9, 9, 1, '', 'éµå®ˆçºªå¾‹æ–¹é¢è¿›æ­¥å¾ˆå¤§', '', 'alex', 'S2039', 1, 'ivy', 'ruby', NULL),
(11, '2018-06-01', 10, 10, 10, 10, 10, 10, 3, '', '', '', 'cici', 'S2039', 1, 'ivy', 'ruby', NULL),
(12, '2018-06-01', 10, 10, 10, 10, 10, 10, 3, '', '', '', 'gladys', 'S2039', 1, 'ivy', 'ruby', NULL),
(13, '2018-06-01', 10, 10, 10, 9, 10, 9.8, 1, '', '', '', 'tolly', 'S2039', 1, 'ivy', 'ruby', NULL),
(14, '2018-06-01', 10, 10, 10, 9, 9, 9.6, 1, '', '', '', 'mary', 'S2039', 1, 'ivy', 'ruby', NULL),
(15, '2018-06-01', 10, 10, 10, 10, 10, 10, 1, '', '', '', 'honey', 'S2039', 1, 'ivy', 'ruby', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `teacher_id` int(11) NOT NULL,
  `teacher_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`teacher_id`, `teacher_name`, `password`, `email`) VALUES
(1, 'johnny', '123456', 'johnny@escience.cn'),
(5, 'coco', '123456', '@'),
(9, 'karen', '123', ''),
(10, 'joanne', '1234', '1@1'),
(12, 'sarah', '123', ''),
(13, 'nisa', '123', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_id`),
  ADD KEY `class_number` (`class_number`) USING BTREE,
  ADD KEY `d_teacher` (`d_teacher`),
  ADD KEY `co_teacher` (`co_teacher`),
  ADD KEY `class_number_2` (`class_number`),
  ADD KEY `class_number_3` (`class_number`,`d_teacher`,`co_teacher`);

--
-- Indexes for table `openlessons`
--
ALTER TABLE `openlessons`
  ADD PRIMARY KEY (`open_id`),
  ADD KEY `open_date` (`open_date`) USING BTREE,
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `open_lesson_scores`
--
ALTER TABLE `open_lesson_scores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_number` (`class_number`) USING BTREE,
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `student_name` (`student_name`) USING BTREE,
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `suggests`
--
ALTER TABLE `suggests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_number` (`class_number`) USING BTREE,
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `surveys`
--
ALTER TABLE `surveys`
  ADD PRIMARY KEY (`survey_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`teacher_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `openlessons`
--
ALTER TABLE `openlessons`
  MODIFY `open_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `open_lesson_scores`
--
ALTER TABLE `open_lesson_scores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `suggests`
--
ALTER TABLE `suggests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `surveys`
--
ALTER TABLE `surveys`
  MODIFY `survey_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `openlessons`
--
ALTER TABLE `openlessons`
  ADD CONSTRAINT `openlessons_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `open_lesson_scores`
--
ALTER TABLE `open_lesson_scores`
  ADD CONSTRAINT `open_lesson_scores_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`teacher_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `suggests`
--
ALTER TABLE `suggests`
  ADD CONSTRAINT `suggests_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
