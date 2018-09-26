-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 21, 2018 at 03:11 PM
-- Server version: 5.7.23
-- PHP Version: 7.0.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yii2test`
--

-- --------------------------------------------------------

--
-- Table structure for table `in_matches`
--

CREATE TABLE `in_matches` (
  `match_id` int(11) NOT NULL,
  `opp_team_1` int(11) NOT NULL,
  `opp_team_2` int(11) NOT NULL,
  `match_datetime` datetime NOT NULL,
  `toss_winning_team_id` int(11) NOT NULL,
  `toss_winner_elected` tinyint(1) NOT NULL DEFAULT '1',
  `winner_team_id` int(11) NOT NULL,
  `match_status` tinyint(1) NOT NULL DEFAULT '1',
  `match_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `match_updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `in_match_details_balling`
--

CREATE TABLE `in_match_details_balling` (
  `in_match_details_balling_id` int(11) NOT NULL,
  `match_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  `overs_balled` float NOT NULL,
  `maidens_over_balled` int(11) NOT NULL,
  `runs` int(11) NOT NULL,
  `wickets` int(11) NOT NULL,
  `no_balls` int(11) NOT NULL,
  `wides` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `in_match_details_batting`
--

CREATE TABLE `in_match_details_batting` (
  `match_detail_batting_id` int(11) NOT NULL,
  `match_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  `is_notout` tinyint(1) NOT NULL DEFAULT '0',
  `out_remark` varchar(255) NOT NULL,
  `run_scored` int(11) NOT NULL,
  `ball_faced` int(11) NOT NULL,
  `fours` int(11) NOT NULL,
  `sixes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `in_players`
--

CREATE TABLE `in_players` (
  `player_id` int(11) NOT NULL,
  `player_team_id` int(11) NOT NULL,
  `player_fname` varchar(255) NOT NULL,
  `player_lname` varchar(255) NOT NULL,
  `player_image` varchar(255) NOT NULL,
  `player_status` tinyint(1) NOT NULL DEFAULT '1',
  `player_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `player_updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `in_players`
--

INSERT INTO `in_players` (`player_id`, `player_team_id`, `player_fname`, `player_lname`, `player_image`, `player_status`, `player_created_at`, `player_updated_at`) VALUES
(1, 4, 'Rohit', 'Sharma', 'team/players/rohit.jpg', 1, '2018-09-21 13:48:46', NULL),
(2, 4, 'Virat', 'Kohli', 'team/players/virat.jpg', 1, '2018-09-21 13:49:27', NULL),
(3, 4, 'MS', 'Dhoni', 'team/players/dhoni.jpg', 1, '2018-09-21 13:50:10', NULL),
(4, 4, 'Ravindra', 'Jadeja', 'team/players/jadeja.jpg', 1, '2018-09-21 13:51:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `in_player_details`
--

CREATE TABLE `in_player_details` (
  `player_detail_id` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  `played_matches` int(11) NOT NULL,
  `batting_innings` int(11) NOT NULL,
  `runs_scored` int(11) NOT NULL,
  `no_fifties` int(11) NOT NULL,
  `no_hundreds` int(11) NOT NULL,
  `highest_score` int(11) NOT NULL,
  `no_wicket_taken` int(11) NOT NULL,
  `no_over_bowled` float NOT NULL,
  `balling_innings` int(11) NOT NULL,
  `balling_runs` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `in_player_details`
--

INSERT INTO `in_player_details` (`player_detail_id`, `player_id`, `played_matches`, `batting_innings`, `runs_scored`, `no_fifties`, `no_hundreds`, `highest_score`, `no_wicket_taken`, `no_over_bowled`, `balling_innings`, `balling_runs`) VALUES
(1, 1, 185, 179, 6823, 35, 18, 264, 8, 98.5, 38, 515),
(2, 2, 285, 280, 10182, 40, 25, 183, 6, 80.2, 18, 430),
(3, 3, 270, 250, 12019, 50, 16, 183, 1, 6, 2, 31),
(4, 4, 136, 93, 1914, 10, 0, 87, 155, 1203, 5561, 430);

-- --------------------------------------------------------

--
-- Table structure for table `in_teams`
--

CREATE TABLE `in_teams` (
  `id` int(11) NOT NULL,
  `team_identifier` varchar(255) NOT NULL,
  `team_name` varchar(255) NOT NULL,
  `team_logo` varchar(255) NOT NULL,
  `team_country` varchar(255) NOT NULL,
  `team_status` tinyint(1) NOT NULL DEFAULT '1',
  `team_created_at` timestamp NULL DEFAULT NULL,
  `team_updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `in_teams`
--

INSERT INTO `in_teams` (`id`, `team_identifier`, `team_name`, `team_logo`, `team_country`, `team_status`, `team_created_at`, `team_updated_at`) VALUES
(4, 'IND', 'India', 'teams/logo/1820-download.png', 'India', 1, '2018-09-21 08:02:54', NULL),
(5, 'Aus', 'Australia', 'teams/logo/1189-aus.png', 'Australia', 1, '2018-09-21 08:03:45', NULL),
(6, 'Eng', 'England', 'teams/logo/7180-england.jpeg', 'England', 1, '2018-09-21 08:05:18', NULL),
(7, 'NZ', 'New Zealand', 'teams/logo/2737-newzland.jpeg', 'New Zealand', 1, '2018-09-21 08:06:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `in_users`
--

CREATE TABLE `in_users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `utid` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `fname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `landline` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `profile_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `in_users`
--

INSERT INTO `in_users` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `utid`, `fname`, `lname`, `mobile`, `landline`, `address`, `profile_image`) VALUES
(1, 'gaurav.jain', 'BkWwvPAAEtLIvb3DGA75eUGymRYEPnlk', '$2y$13$g40y8y.SAdyrDqcf16YYsufre1l0VbehQ8r0uke3Udz32YZeHFPAe', 'YP4Jlm4OEbk1DONeuXnFEGflShUvZayz_1436940203', 'gaurav.jain@intelegencia.com', 1, 1435917895, 1438681498, 1, 'Gaurav', 'Jain', '123-123-1234', '123456789094', 'Noida', 'users/admin/6596-agent4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `in_user_type`
--

CREATE TABLE `in_user_type` (
  `utid` int(10) UNSIGNED NOT NULL,
  `utname` varchar(45) DEFAULT NULL,
  `utstatus` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `in_user_type`
--

INSERT INTO `in_user_type` (`utid`, `utname`, `utstatus`) VALUES
(1, 'admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1435917370),
('m130524_201442_init', 1435917380);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `in_matches`
--
ALTER TABLE `in_matches`
  ADD PRIMARY KEY (`match_id`),
  ADD KEY `opp_team_1` (`opp_team_1`),
  ADD KEY `opp_team_2` (`opp_team_2`),
  ADD KEY `winner_team` (`winner_team_id`),
  ADD KEY `toss_winning_team_id` (`toss_winning_team_id`);

--
-- Indexes for table `in_match_details_balling`
--
ALTER TABLE `in_match_details_balling`
  ADD PRIMARY KEY (`in_match_details_balling_id`),
  ADD KEY `match_id` (`match_id`),
  ADD KEY `team_id` (`team_id`),
  ADD KEY `player_id` (`player_id`);

--
-- Indexes for table `in_match_details_batting`
--
ALTER TABLE `in_match_details_batting`
  ADD PRIMARY KEY (`match_detail_batting_id`),
  ADD KEY `match_id` (`match_id`),
  ADD KEY `team_id` (`team_id`),
  ADD KEY `player_id` (`player_id`);

--
-- Indexes for table `in_players`
--
ALTER TABLE `in_players`
  ADD PRIMARY KEY (`player_id`),
  ADD KEY `palyer_team_id` (`player_team_id`);

--
-- Indexes for table `in_player_details`
--
ALTER TABLE `in_player_details`
  ADD PRIMARY KEY (`player_detail_id`),
  ADD KEY `player_id` (`player_id`);

--
-- Indexes for table `in_teams`
--
ALTER TABLE `in_teams`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `team_identifier` (`team_identifier`);

--
-- Indexes for table `in_users`
--
ALTER TABLE `in_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utid` (`utid`);

--
-- Indexes for table `in_user_type`
--
ALTER TABLE `in_user_type`
  ADD PRIMARY KEY (`utid`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `in_matches`
--
ALTER TABLE `in_matches`
  MODIFY `match_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `in_match_details_balling`
--
ALTER TABLE `in_match_details_balling`
  MODIFY `in_match_details_balling_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `in_match_details_batting`
--
ALTER TABLE `in_match_details_batting`
  MODIFY `match_detail_batting_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `in_players`
--
ALTER TABLE `in_players`
  MODIFY `player_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `in_player_details`
--
ALTER TABLE `in_player_details`
  MODIFY `player_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `in_teams`
--
ALTER TABLE `in_teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `in_users`
--
ALTER TABLE `in_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `in_user_type`
--
ALTER TABLE `in_user_type`
  MODIFY `utid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `in_matches`
--
ALTER TABLE `in_matches`
  ADD CONSTRAINT `in_matches_ibfk_1` FOREIGN KEY (`opp_team_1`) REFERENCES `in_teams` (`id`),
  ADD CONSTRAINT `in_matches_ibfk_2` FOREIGN KEY (`opp_team_2`) REFERENCES `in_teams` (`id`),
  ADD CONSTRAINT `in_matches_ibfk_3` FOREIGN KEY (`toss_winning_team_id`) REFERENCES `in_teams` (`id`),
  ADD CONSTRAINT `in_matches_ibfk_4` FOREIGN KEY (`winner_team_id`) REFERENCES `in_teams` (`id`);

--
-- Constraints for table `in_match_details_balling`
--
ALTER TABLE `in_match_details_balling`
  ADD CONSTRAINT `in_match_details_balling_ibfk_1` FOREIGN KEY (`match_id`) REFERENCES `in_matches` (`match_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `in_match_details_balling_ibfk_2` FOREIGN KEY (`team_id`) REFERENCES `in_teams` (`id`),
  ADD CONSTRAINT `in_match_details_balling_ibfk_3` FOREIGN KEY (`player_id`) REFERENCES `in_players` (`player_id`);

--
-- Constraints for table `in_match_details_batting`
--
ALTER TABLE `in_match_details_batting`
  ADD CONSTRAINT `in_match_details_batting_ibfk_1` FOREIGN KEY (`match_id`) REFERENCES `in_matches` (`match_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `in_match_details_batting_ibfk_2` FOREIGN KEY (`team_id`) REFERENCES `in_teams` (`id`),
  ADD CONSTRAINT `in_match_details_batting_ibfk_3` FOREIGN KEY (`player_id`) REFERENCES `in_teams` (`id`);

--
-- Constraints for table `in_players`
--
ALTER TABLE `in_players`
  ADD CONSTRAINT `in_players_ibfk_1` FOREIGN KEY (`player_team_id`) REFERENCES `in_teams` (`id`);

--
-- Constraints for table `in_player_details`
--
ALTER TABLE `in_player_details`
  ADD CONSTRAINT `in_player_details_ibfk_1` FOREIGN KEY (`player_id`) REFERENCES `in_players` (`player_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `in_users`
--
ALTER TABLE `in_users`
  ADD CONSTRAINT `in_users_ibfk_1` FOREIGN KEY (`utid`) REFERENCES `in_user_type` (`utid`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
