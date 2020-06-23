-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2020 at 04:54 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sports`
--

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE `file` (
  `file_id` int(11) NOT NULL,
  `ts_file` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ts_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `file`
--

INSERT INTO `file` (`file_id`, `ts_file`, `ts_id`) VALUES
(4, 'ts_file2020_06_19_807798_42.pdf', 42),
(5, 'ts_file2020_06_19_683210_41.pdf', 41);

-- --------------------------------------------------------

--
-- Table structure for table `match`
--

CREATE TABLE `match` (
  `match_id` int(11) NOT NULL,
  `tournament_id` int(11) NOT NULL,
  `sport_id` int(11) NOT NULL,
  `ts_id` int(11) NOT NULL,
  `team_a` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `team_b` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `team_win` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `match_date` datetime NOT NULL,
  `roud` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `score_a` int(3) NOT NULL,
  `score_b` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `player`
--

CREATE TABLE `player` (
  `player_id` int(11) NOT NULL,
  `player_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `team_id` int(11) NOT NULL,
  `seq` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `player`
--

INSERT INTO `player` (`player_id`, `player_name`, `team_id`, `seq`) VALUES
(20, 'เด็กเวร', 1, 1),
(21, 'เด็กเหี้ย', 1, 2),
(22, 'เด็กสลัด', 1, 3),
(23, 'กัน', 2, 1),
(24, 'กันนี่', 2, 2),
(25, 'กัน', 3, 1),
(26, 'กันนี่', 3, 2),
(27, 'qwerty', 4, 1),
(28, 'gg', 4, 2),
(29, 'tuchchy', 5, 1),
(30, 'bfbdfbsdbds', 6, 1),
(31, 'gggggg', 7, 1),
(32, 'yhijoggj', 8, 1),
(33, 'dfdgreh', 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sport`
--

CREATE TABLE `sport` (
  `sport_id` int(11) NOT NULL,
  `sport_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `sport_player` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sport`
--

INSERT INTO `sport` (`sport_id`, `sport_name`, `sport_player`) VALUES
(14, 'เปตอง', 5),
(15, 'วอลเล่ย์บอล', 10),
(16, 'ฟุตบอล', 25),
(17, 'บาสเก็ตบอล', 12),
(18, 'แบตมินตัน', 4);

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `team_id` int(11) NOT NULL,
  `team_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ts_id` int(11) NOT NULL,
  `tournament_id` int(11) NOT NULL,
  `sport_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`team_id`, `team_name`, `ts_id`, `tournament_id`, `sport_id`) VALUES
(1, 'ทีมเวร', 41, 8, 15),
(2, 'คนสวย', 42, 8, 16),
(3, 'ทำงานนนน', 41, 8, 15),
(4, 'ทีม123', 41, 8, 15),
(5, '123456', 41, 8, 15),
(6, 'dfvgdvsd', 41, 8, 15),
(7, 'asdfgghh', 41, 8, 15),
(8, 'ggdddfd', 41, 8, 15),
(9, 'cvfffs', 41, 8, 15);

-- --------------------------------------------------------

--
-- Table structure for table `tournament`
--

CREATE TABLE `tournament` (
  `tournament_id` int(11) NOT NULL,
  `tournament_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tournament`
--

INSERT INTO `tournament` (`tournament_id`, `tournament_name`, `startdate`, `enddate`) VALUES
(8, 'software', '2020-06-08', '2020-06-20'),
(9, 'project', '2020-06-08', '2020-06-10');

-- --------------------------------------------------------

--
-- Table structure for table `tournament_sport`
--

CREATE TABLE `tournament_sport` (
  `ts_id` int(11) NOT NULL,
  `tournament_id` int(11) NOT NULL,
  `sport_id` int(11) NOT NULL,
  `ts_place` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ts_startdate` date NOT NULL,
  `ts_enddate` date NOT NULL,
  `ts_status` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tournament_sport`
--

INSERT INTO `tournament_sport` (`ts_id`, `tournament_id`, `sport_id`, `ts_place`, `ts_startdate`, `ts_enddate`, `ts_status`) VALUES
(41, 8, 15, 'สนามวอลเล่ย์', '2020-06-17', '2020-06-17', '3'),
(42, 8, 16, '', '0000-00-00', '0000-00-00', '2'),
(44, 9, 15, '', '0000-00-00', '0000-00-00', '1');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `username`, `password`) VALUES
(1, 'admingun', 'admin', '1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`file_id`);

--
-- Indexes for table `match`
--
ALTER TABLE `match`
  ADD PRIMARY KEY (`match_id`),
  ADD KEY `tournament` (`tournament_id`),
  ADD KEY `ts_id` (`ts_id`),
  ADD KEY `sport_id` (`sport_id`);

--
-- Indexes for table `player`
--
ALTER TABLE `player`
  ADD PRIMARY KEY (`player_id`);

--
-- Indexes for table `sport`
--
ALTER TABLE `sport`
  ADD PRIMARY KEY (`sport_id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`team_id`),
  ADD KEY `ts_id` (`ts_id`),
  ADD KEY `tournament_id` (`tournament_id`),
  ADD KEY `sport_id` (`sport_id`);

--
-- Indexes for table `tournament`
--
ALTER TABLE `tournament`
  ADD PRIMARY KEY (`tournament_id`) USING BTREE;

--
-- Indexes for table `tournament_sport`
--
ALTER TABLE `tournament_sport`
  ADD PRIMARY KEY (`ts_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `match`
--
ALTER TABLE `match`
  MODIFY `match_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `player`
--
ALTER TABLE `player`
  MODIFY `player_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `sport`
--
ALTER TABLE `sport`
  MODIFY `sport_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tournament`
--
ALTER TABLE `tournament`
  MODIFY `tournament_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tournament_sport`
--
ALTER TABLE `tournament_sport`
  MODIFY `ts_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
