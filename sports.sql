-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2020 at 05:13 AM
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
-- Table structure for table `matchs`
--

CREATE TABLE `matchs` (
  `match_id` int(11) NOT NULL,
  `tournament_id` int(11) NOT NULL,
  `sport_id` int(11) NOT NULL,
  `ts_id` int(11) NOT NULL,
  `team_a` int(11) NOT NULL,
  `team_b` int(11) NOT NULL,
  `team_win` int(11) NOT NULL,
  `match_date` datetime NOT NULL,
  `point` int(2) NOT NULL,
  `score_a` int(3) NOT NULL DEFAULT '0',
  `score_b` int(3) NOT NULL DEFAULT '0',
  `match_cutout` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `matchs`
--

INSERT INTO `matchs` (`match_id`, `tournament_id`, `sport_id`, `ts_id`, `team_a`, `team_b`, `team_win`, `match_date`, `point`, `score_a`, `score_b`, `match_cutout`) VALUES
(30, 12, 15, 55, 42, 43, 43, '2020-07-01 10:15:00', 0, 8, 9, 0),
(31, 12, 15, 55, 43, 44, 43, '2020-07-02 10:15:00', 0, 10, 2, 0),
(32, 12, 15, 55, 45, 44, 45, '2020-07-03 10:15:00', 0, 10, 9, 0),
(34, 12, 15, 55, 43, 45, 45, '2020-07-03 13:30:00', 0, 5, 15, 0),
(35, 12, 15, 55, 44, 45, 44, '2020-07-04 10:20:00', 0, 20, 15, 0),
(36, 12, 15, 55, 45, 44, 0, '2020-07-04 11:10:00', 0, 0, 0, 0);

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
(73, 'นราธิป', 42, 1),
(74, 'สุรินธรณ์', 42, 2),
(75, 'พชร', 43, 1),
(76, 'ธัชพล', 43, 2),
(77, 'โสภาค', 44, 1),
(78, 'สุรรัตน์', 44, 2),
(79, 'มงคล', 45, 1),
(80, 'ศักดิ์รวี', 45, 2);

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
  `team_status` int(1) NOT NULL DEFAULT '0',
  `team_point` int(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`team_id`, `team_name`, `ts_id`, `tournament_id`, `sport_id`, `team_status`, `team_point`) VALUES
(42, 'วิศวกรรมซอฟต์แวร์', 55, 12, 15, 2, 0),
(43, 'เทคโนอุตสาหกรรม', 55, 12, 15, 2, 6),
(44, 'พลังงาน', 55, 12, 15, 1, 12),
(45, 'วิศวโยธา', 55, 12, 15, 1, 6);

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
(12, 'กีฬาคณะเทคโนโลยีอุตสาหกรรม', '2020-07-01', '2020-07-10'),
(13, 'กีฬาสาขาวิศวกรรมซอฟต์แวร์', '2020-07-11', '2020-07-15');

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
(55, 12, 15, 'สนามวอลเล่ย์', '2020-07-01', '2020-07-04', ''),
(56, 12, 16, 'สนามฟุตบอล1', '2020-07-05', '2020-07-10', ''),
(57, 13, 15, '', '0000-00-00', '0000-00-00', ''),
(58, 13, 16, '', '0000-00-00', '0000-00-00', '');

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
-- AUTO_INCREMENT for table `matchs`
--
ALTER TABLE `matchs`
  MODIFY `match_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `player`
--
ALTER TABLE `player`
  MODIFY `player_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `sport`
--
ALTER TABLE `sport`
  MODIFY `sport_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `tournament`
--
ALTER TABLE `tournament`
  MODIFY `tournament_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tournament_sport`
--
ALTER TABLE `tournament_sport`
  MODIFY `ts_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
