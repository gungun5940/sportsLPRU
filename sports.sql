-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2020 at 01:25 PM
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
-- Table structure for table `matchs`
--

CREATE TABLE `matchs` (
  `match_id` int(11) NOT NULL,
  `tournament_id` int(11) NOT NULL,
  `sport_id` int(11) NOT NULL,
  `ts_id` int(11) NOT NULL,
  `team_a` int(11) NOT NULL,
  `team_b` int(11) NOT NULL,
  `team_win` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `match_date` datetime NOT NULL,
  `round` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `score_a` int(3) NOT NULL DEFAULT '0',
  `score_b` int(3) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `matchs`
--

INSERT INTO `matchs` (`match_id`, `tournament_id`, `sport_id`, `ts_id`, `team_a`, `team_b`, `team_win`, `match_date`, `round`, `score_a`, `score_b`) VALUES
(1, 10, 15, 51, 13, 14, '', '2020-06-24 17:00:00', '', 0, 0);

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
(42, 'เด็กเวร', 13, 1),
(43, 'กันนี่', 13, 2),
(44, 'qwerty', 14, 1),
(45, 'เด็กเหี้ย', 14, 2),
(46, 'เพิ่ม 1 แหละ', 15, 1),
(47, 'เพิ่ม 2 แหละ', 16, 1),
(48, 'เพิ่ม 3 แหละ', 17, 1),
(49, 'เพิ่ม 4 แหละ', 18, 1);

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
  `sport_id` int(11) NOT NULL,
  `team_status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`team_id`, `team_name`, `ts_id`, `tournament_id`, `sport_id`, `team_status`) VALUES
(13, 'ทำงานนนน', 51, 10, 15, 1),
(14, 'ทีมเวร', 51, 10, 15, 1),
(15, 'ลองเพิ่ม 1', 51, 10, 15, 0),
(16, 'ลองเพิ่ม 2', 51, 10, 15, 0),
(17, 'ลองเพิ่ม 3', 51, 10, 15, 0),
(18, 'ลองเพิ่ม 4', 51, 10, 15, 0),
(19, 'ทดสอบ', 45, 8, 15, 0);

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
(9, 'project', '2020-06-08', '2020-06-10'),
(10, 'testggg', '2020-06-23', '2020-06-30');

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
(44, 9, 15, '', '0000-00-00', '0000-00-00', '1'),
(45, 8, 15, 'สนามวอลเล่ย์', '2020-06-18', '2020-06-10', ''),
(46, 8, 16, '', '0000-00-00', '0000-00-00', ''),
(51, 10, 15, '', '0000-00-00', '0000-00-00', ''),
(52, 10, 16, '', '0000-00-00', '0000-00-00', '');

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
-- Indexes for table `matchs`
--
ALTER TABLE `matchs`
  ADD PRIMARY KEY (`match_id`),
  ADD KEY `tournament` (`tournament_id`),
  ADD KEY `ts_id` (`ts_id`),
  ADD KEY `sport_id` (`sport_id`);

--
-- Indexes for table `player`
--
ALTER TABLE `player`
  ADD PRIMARY KEY (`player_id`),
  ADD KEY `team_id` (`team_id`);

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
-- AUTO_INCREMENT for table `matchs`
--
ALTER TABLE `matchs`
  MODIFY `match_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `player`
--
ALTER TABLE `player`
  MODIFY `player_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `sport`
--
ALTER TABLE `sport`
  MODIFY `sport_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tournament`
--
ALTER TABLE `tournament`
  MODIFY `tournament_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tournament_sport`
--
ALTER TABLE `tournament_sport`
  MODIFY `ts_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
