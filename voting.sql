-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2015 at 08:42 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `voting`
--

-- --------------------------------------------------------

--
-- Table structure for table `elections`
--

CREATE TABLE IF NOT EXISTS `elections` (
  `election_id` int(11) NOT NULL AUTO_INCREMENT,
  `election_name` varchar(100) NOT NULL,
  `position_id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `details` varchar(250) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `members_added` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`election_id`),
  KEY `postion_id` (`position_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `elections`
--

INSERT INTO `elections` (`election_id`, `election_name`, `position_id`, `year`, `details`, `active`, `members_added`) VALUES
(1, 'SAC Election', 1, 2015, 'Election for SAC', 0, 1),
(2, 'AASF Election', 2, 2015, 'Selecting Event Head of AASF', 0, 1),
(3, 'Infotsav 2015', 1, 2015, 'Election for Infotsav Coordinator 2015', 0, 1),
(4, 'Urja Organiser Election', 4, 2014, 'Urja organiser is selected, who will manage the entire fest!!', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `election_users`
--

CREATE TABLE IF NOT EXISTS `election_users` (
  `election_users_id` int(11) NOT NULL AUTO_INCREMENT,
  `election_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `votes` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`election_users_id`),
  KEY `election_id` (`election_id`,`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `election_users`
--

INSERT INTO `election_users` (`election_users_id`, `election_id`, `user_id`, `votes`) VALUES
(1, 1, 2, 121),
(2, 1, 4, 71),
(3, 1, 5, 81),
(4, 1, 1, 0),
(5, 2, 4, 1),
(6, 2, 5, 0),
(7, 2, 2, 1),
(8, 2, 6, 0),
(9, 3, 1, 1),
(10, 3, 4, 0),
(11, 3, 5, 0),
(12, 3, 6, 0),
(21, 4, 2, 0),
(22, 4, 4, 0),
(23, 4, 8, 0),
(24, 4, 6, 0);

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE IF NOT EXISTS `positions` (
  `position_id` int(11) NOT NULL AUTO_INCREMENT,
  `position_name` varchar(100) NOT NULL,
  `details` varchar(200) NOT NULL,
  PRIMARY KEY (`position_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`position_id`, `position_name`, `details`) VALUES
(1, 'SAC President', 'President of SAC'),
(2, 'AASF Event Head', 'Manages all the events held under AASF'),
(3, 'Infotsav Coordinator', 'Manages Infotsav'),
(4, 'Urja Organisers', 'Election for urja organiser!!');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `post` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`post_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `post`, `timestamp`) VALUES
(1, 1, 'This is Shubham Aggarwal', '2015-10-04 05:45:12'),
(2, 1, 'I am standing for SAC President in 2015.', '2015-10-04 05:56:54'),
(3, 1, 'Testing \r\n', '2015-10-04 06:02:38'),
(4, 2, 'I am Testing!! ', '2015-10-04 06:05:10'),
(5, 2, 'Adding New post!!', '2015-10-04 06:24:12');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE IF NOT EXISTS `results` (
  `result_id` int(11) NOT NULL AUTO_INCREMENT,
  `election_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`result_id`),
  UNIQUE KEY `election_id` (`election_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`result_id`, `election_id`, `user_id`) VALUES
(6, 1, 2),
(7, 2, 4),
(8, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `roll_no` varchar(100) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL DEFAULT 'student',
  `bio` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `roll_no` (`roll_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `roll_no`, `fname`, `lname`, `password`, `role`, `bio`) VALUES
(1, '2011IPG-104', 'Shubham', 'Aggarwal', '3b6beb51e76816e632a40d440eab0097', 'student', 'Student of IPG 2011'),
(2, '2011IPG-011', 'Aditya', 'Verma', '057829fa5a65fc1ace408f490be486ac', 'student', 'Student of IPG 2011'),
(4, '2011IPG-026', 'Ashutosh', 'Jindal', '87f5ce84d66c6ca661f614213858b0b4', 'student', 'Student of IPG 2011'),
(5, '2011IPG-024', 'Arunabh', 'Chaudhary', 'a0d870238ab40a215ee3d8274a712e35', 'student', 'Student of IPG 2011'),
(6, '2011IPG-62', 'Mayank', 'Shivhare', '308a3820e4cccbe043cb5228de5e71e3', 'student', 'Student of IPG 2011'),
(7, '2011IPG-075', 'Parikshit', 'Raj Bhati', '11a60cf0e7e84e1008453db2955015ff', 'student', 'Student of IPG 2011'),
(8, '2011IPG-049', 'Ketan', 'Yadav', '2543ba5d2f955621e65408e5d5dbbe64', 'student', 'Student of IPG 2011'),
(9, '2012IPG-021', 'Kushagra', 'Varshney', '8bb33820028dc9ed18e76e9a0a62fabe', 'student', 'I am Infotsav Coordinator');

-- --------------------------------------------------------

--
-- Table structure for table `vote2`
--

CREATE TABLE IF NOT EXISTS `vote2` (
  `vote_id` int(11) NOT NULL AUTO_INCREMENT,
  `voter_id` int(11) NOT NULL,
  `election_id` int(11) NOT NULL,
  `nominee_id` int(11) NOT NULL,
  PRIMARY KEY (`vote_id`),
  KEY `voter_id` (`voter_id`,`election_id`,`nominee_id`),
  KEY `election_id` (`election_id`),
  KEY `user_id` (`nominee_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `vote2`
--

INSERT INTO `vote2` (`vote_id`, `voter_id`, `election_id`, `nominee_id`) VALUES
(1, 1, 1, 2),
(2, 1, 2, 4),
(3, 2, 1, 1),
(4, 2, 2, 2),
(5, 2, 3, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `elections`
--
ALTER TABLE `elections`
  ADD CONSTRAINT `positions` FOREIGN KEY (`position_id`) REFERENCES `positions` (`position_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `election_users`
--
ALTER TABLE `election_users`
  ADD CONSTRAINT `users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `elections` FOREIGN KEY (`election_id`) REFERENCES `elections` (`election_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `results_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `results_elections` FOREIGN KEY (`election_id`) REFERENCES `elections` (`election_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vote2`
--
ALTER TABLE `vote2`
  ADD CONSTRAINT `votes_nominee` FOREIGN KEY (`nominee_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `votes_election` FOREIGN KEY (`election_id`) REFERENCES `elections` (`election_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vote_voters` FOREIGN KEY (`voter_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
