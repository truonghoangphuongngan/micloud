-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2018 at 01:52 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `micloud`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
`commentID` int(10) NOT NULL,
  `created` datetime NOT NULL,
  `content` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `postID` int(10) NOT NULL,
  `userID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
`logID` int(10) NOT NULL,
  `created` datetime NOT NULL,
  `userID` int(10) NOT NULL,
  `action` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `brower` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
`postID` int(10) NOT NULL,
  `userID` int(10) NOT NULL,
  `description` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `tags` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `view` int(11) DEFAULT NULL,
  `like` int(11) DEFAULT NULL,
  `comment` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`postID`, `userID`, `description`, `created`, `modified`, `tags`, `location`, `photo`, `view`, `like`, `comment`, `status`) VALUES
(1, 1, 'today', '2018-05-02 00:00:00', '2018-05-03 00:00:00', '#helu', 'hcm', 'mi1.jpg', NULL, NULL, NULL, NULL),
(2, 1, 'lorem ipsum dolor sit amet', '2018-05-02 00:00:00', '2018-05-03 00:00:00', '#helu #hihi', 'hcm', 'mi2.jpg', NULL, NULL, NULL, NULL),
(14, 1, 'efdfdsfsdfdf', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'sdfdfdf', '', 'mi5.jpg', NULL, NULL, NULL, NULL),
(18, 1, 'bbbb', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'bbbb', '', '22050315_1131372653661165_5577067733864349838_n.jpg', NULL, NULL, NULL, NULL),
(19, 6, 'nguyendiv', '2018-05-06 00:00:00', '0000-00-00 00:00:00', 'ac ac', 'hcm', '', NULL, NULL, NULL, NULL),
(20, 6, 'nguyendiv', '2018-05-06 00:00:00', '0000-00-00 00:00:00', 'ac ac ac', 'dong nai sai gon', '20180503_210950.png', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
`tagID` int(10) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `use` int(11) NOT NULL,
  `posts` varchar(1000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`userID` int(10) NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `userpass` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `gender` int(10) NOT NULL,
  `follow` varchar(2000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `userpass`, `email`, `role`, `fullname`, `avatar`, `gender`, `follow`) VALUES
(1, 'phuongngan2204', '12345678', 'abcd@gmail.com', 'user', 'Ngan2', '23559438_1557653430995055_7421057726625070061_n.jpg', 0, 'Nguyen456'),
(6, 'Nguyen123', '12345', 'nguyen@gmail.com', 'user', 'nguyen', 'IMG_5965[2]-min.JPG', 0, ''),
(7, 'Nguyen456', '12345', 'haha@gmail.com', 'user', 'nguyenaaaaa', 'default_avatar.jpg', 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
 ADD PRIMARY KEY (`commentID`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
 ADD PRIMARY KEY (`logID`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
 ADD PRIMARY KEY (`postID`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
 ADD PRIMARY KEY (`tagID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
MODIFY `commentID` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
MODIFY `logID` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
MODIFY `postID` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
MODIFY `tagID` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `userID` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
