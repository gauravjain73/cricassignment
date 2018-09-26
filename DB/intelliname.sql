-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 07, 2015 at 05:55 PM
-- Server version: 5.5.44-0ubuntu0.14.04.1
-- PHP Version: 5.5.15-1+deb.sury.org~precise+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `intelliname`
--

-- --------------------------------------------------------

--
-- Table structure for table `in_users`
--

CREATE TABLE IF NOT EXISTS `in_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `utid` int(10) unsigned NOT NULL DEFAULT '1',
  `fname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `landline` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `profile_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `utid` (`utid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `in_users`
--

INSERT INTO `in_users` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `utid`, `fname`, `lname`, `mobile`, `landline`, `address`, `profile_image`) VALUES
(1, 'gaurav.jain', 'BkWwvPAAEtLIvb3DGA75eUGymRYEPnlk', '$2y$13$g40y8y.SAdyrDqcf16YYsufre1l0VbehQ8r0uke3Udz32YZeHFPAe', 'YP4Jlm4OEbk1DONeuXnFEGflShUvZayz_1436940203', 'gaurav.jain@sourcesoftsolutions.com', 1, 1435917895, 1438681498, 1, 'Gaurav', 'Jain', '123-123-1234', '123456789094', 'Noida', 'users/admin/6596-agent4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `in_user_type`
--

CREATE TABLE IF NOT EXISTS `in_user_type` (
  `utid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `utname` varchar(45) DEFAULT NULL,
  `utstatus` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`utid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `in_user_type`
--

INSERT INTO `in_user_type` (`utid`, `utname`, `utstatus`) VALUES
(1, 'admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1435917370),
('m130524_201442_init', 1435917380);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `in_users`
--
ALTER TABLE `in_users`
  ADD CONSTRAINT `in_users_ibfk_1` FOREIGN KEY (`utid`) REFERENCES `in_user_type` (`utid`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
