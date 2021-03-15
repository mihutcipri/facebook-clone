-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 15, 2021 at 12:10 PM
-- Server version: 8.0.18
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `facebook`
--

-- --------------------------------------------------------

--
-- Table structure for table `block`
--

CREATE TABLE `block` (
  `blockID` int(11) NOT NULL,
  `blockerID` int(11) NOT NULL,
  `blockedID` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `blockOn` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `block`
--

INSERT INTO `block` (`blockID`, `blockerID`, `blockedID`, `status`, `blockOn`) VALUES
(4, 27, 26, NULL, '2021-03-13 12:21:17');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `commentID` int(11) NOT NULL,
  `comment_paretn_id` int(11) NOT NULL,
  `commentReplyID` int(11) NOT NULL,
  `replyID` int(11) NOT NULL,
  `comment` text COLLATE utf8mb4_general_ci NOT NULL,
  `commentOn` int(11) NOT NULL,
  `commentBy` int(11) NOT NULL,
  `commentAt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments1`
--

CREATE TABLE `comments1` (
  `commentID` int(11) NOT NULL,
  `comment_parent_id` int(11) NOT NULL,
  `commentReplyID` decimal(20,0) NOT NULL,
  `replyID` decimal(20,0) NOT NULL,
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `commentOn` int(11) NOT NULL,
  `commentBy` decimal(20,0) NOT NULL,
  `commentAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

CREATE TABLE `follow` (
  `id` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  `followOn` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `follow`
--

INSERT INTO `follow` (`id`, `sender`, `receiver`, `followOn`) VALUES
(23, 27, 25, '2021-03-13 11:36:11');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `messageID` int(11) NOT NULL,
  `message` text COLLATE utf8mb4_general_ci NOT NULL,
  `messageTo` int(11) NOT NULL,
  `messageFrom` int(11) NOT NULL,
  `messageOn` datetime NOT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`messageID`, `message`, `messageTo`, `messageFrom`, `messageOn`, `status`) VALUES
(1, 'asda', 27, 25, '2021-03-13 12:11:55', NULL),
(2, 'HEII', 25, 27, '2021-03-13 12:12:17', NULL),
(3, 'asd', 27, 25, '2021-03-13 12:14:42', NULL),
(4, '<img alt=\"🤣\" class=\"emojioneemoji\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f923.png\"><img alt=\"🤣\" class=\"emojioneemoji\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f923.png\"><img alt=\"🤣\" class=\"emojioneemoji\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f923.png\"><img alt=\"😂\" class=\"emojioneemoji\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f602.png\"><img alt=\"🙂\" class=\"emojioneemoji\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f642.png\"><img alt=\"😜\" class=\"emojioneemoji\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f61c.png\"><img alt=\"😜\" class=\"emojioneemoji\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f61c.png\"><img alt=\"🙃\" class=\"emojioneemoji\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f643.png\"><img alt=\"🤘\" class=\"emojioneemoji\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f918.png\"><img alt=\"🐧\" class=\"emojioneemoji\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f427.png\"><img alt=\"🏳️\" class=\"emojioneemoji\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f3f3.png\"><img alt=\"🏴\" class=\"emojioneemoji\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f3f4.png\"><div><img alt=\"🏳️\" class=\"emojioneemoji\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f', 27, 25, '2021-03-13 12:15:50', NULL),
(5, '...', 26, 25, '2021-03-13 12:36:36', NULL),
(6, 'salut', 29, 27, '2021-03-13 12:44:08', NULL),
(7, 'merge', 26, 25, '2021-03-13 13:15:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `messages1`
--

CREATE TABLE `messages1` (
  `messageID` int(11) NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `messageTo` int(11) NOT NULL,
  `messageFrom` int(11) NOT NULL,
  `messageOn` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `ID` int(11) NOT NULL,
  `notificationFor` int(11) NOT NULL,
  `notificationFrom` int(11) NOT NULL,
  `postid` int(11) NOT NULL,
  `type` enum('postReact','commentReact','comment','share','message','request','mention') NOT NULL,
  `notificationOn` datetime NOT NULL,
  `notificationCount` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `friendStatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`ID`, `notificationFor`, `notificationFrom`, `postid`, `type`, `notificationOn`, `notificationCount`, `status`, `friendStatus`) VALUES
(86, 19, 20, 0, 'request', '2021-02-17 10:48:22', 0, 1, 1),
(87, 26, 25, 0, 'request', '2021-03-13 11:34:51', 0, 0, 0),
(88, 25, 27, 0, 'request', '2021-03-13 11:36:11', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `post` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci,
  `postBy` int(11) DEFAULT NULL,
  `sharedFrom` int(11) DEFAULT NULL,
  `shareId` int(11) DEFAULT NULL,
  `sharedBy` int(11) DEFAULT NULL,
  `postImage` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci,
  `imageId` text,
  `likesCount` int(11) DEFAULT NULL,
  `shareCount` int(11) DEFAULT NULL,
  `postedOn` datetime DEFAULT NULL,
  `shareText` text,
  `profilePhoto` text,
  `coverPhoto` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `userId`, `post`, `postBy`, `sharedFrom`, `shareId`, `sharedBy`, `postImage`, `imageId`, `likesCount`, `shareCount`, `postedOn`, `shareText`, `profilePhoto`, `coverPhoto`) VALUES
(67, 25, ':DDD<div><br></div>', 25, NULL, NULL, NULL, '[{\"imageName\":\"user/25/postImage/Capture.PNG\"}]', NULL, NULL, NULL, '2021-03-13 12:30:12', NULL, NULL, NULL),
(68, 25, 'NO PHOTO', 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-13 12:32:59', NULL, NULL, NULL),
(69, 27, 'ASDASRAD<div></div>@mihut_cipri', 27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-13 12:45:55', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `currentCity` varchar(255) DEFAULT NULL,
  `shortBio` text,
  `aboutYou` text,
  `birthday` date DEFAULT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `profilePic` text,
  `coverPic` text,
  `politicalViews` varchar(255) DEFAULT NULL,
  `religion` varchar(255) DEFAULT NULL,
  `highSchool` text,
  `college` text,
  `university` text,
  `country` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `language` varchar(255) DEFAULT NULL,
  `hometown` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `workplace` text,
  `professional` text,
  `otherPlace` text,
  `address` text,
  `socialLink` text,
  `relationship` text,
  `quotes` text,
  `otherName` text,
  `lifeEvent` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `userId`, `currentCity`, `shortBio`, `aboutYou`, `birthday`, `firstName`, `lastName`, `profilePic`, `coverPic`, `politicalViews`, `religion`, `highSchool`, `college`, `university`, `country`, `website`, `language`, `hometown`, `gender`, `workplace`, `professional`, `otherPlace`, `address`, `socialLink`, `relationship`, `quotes`, `otherName`, `lifeEvent`) VALUES
(4, 25, 'Arad', NULL, 'Student', '1997-08-01', 'Mihut', 'Ciprian', 'user/25/profilePhoto/Capture.PNG', 'user/25/coverphoto/Capture.PNG', NULL, NULL, 'LTB ARAD', 'UAV Arad', NULL, NULL, 'www.google.go', 'RO', 'Arad', 'male', 'HUF ARAD', 'INGINER', 'Romania', 'Romania', 'UAV ARAD', 'asdadada', NULL, 'Nairpic', NULL),
(5, 26, NULL, NULL, NULL, '2003-01-01', 'Mihut', 'Ciprian', 'assets/image/defaultProfile.png', 'assets/image/defaultCover.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 27, NULL, NULL, NULL, '1997-01-01', 'bogdi', 'mihut', 'assets/image/defaultProfile.png', 'assets/image/defaultCover.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'male', NULL, NULL, NULL, 'Arad', NULL, NULL, NULL, NULL, NULL),
(7, 29, NULL, NULL, NULL, '2012-01-01', 'Alex', 'Doru', 'assets/image/defaultProfile.png', 'assets/image/defaultCover.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `react`
--

CREATE TABLE `react` (
  `reactID` int(11) NOT NULL,
  `reactBy` int(11) NOT NULL,
  `reactOn` int(11) NOT NULL,
  `reactCommentOn` int(11) DEFAULT NULL,
  `reactReplyOn` int(11) DEFAULT NULL,
  `reactType` enum('like','love','haha','wow','sad','angry') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `reactTimeOn` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `react`
--

INSERT INTO `react` (`reactID`, `reactBy`, `reactOn`, `reactCommentOn`, `reactReplyOn`, `reactType`, `reactTimeOn`) VALUES
(298, 25, 67, NULL, NULL, 'like', '2021-03-13 14:36:25'),
(299, 25, 68, NULL, NULL, 'like', '2021-03-13 14:42:19'),
(300, 25, 68, NULL, NULL, 'like', '2021-03-13 14:49:24'),
(301, 25, 68, NULL, NULL, 'like', '2021-03-13 14:49:27'),
(302, 25, 67, NULL, NULL, 'like', '2021-03-13 14:49:29'),
(303, 25, 67, NULL, NULL, 'like', '2021-03-13 14:52:33'),
(304, 25, 67, NULL, NULL, 'love', '2021-03-13 14:54:53'),
(305, 25, 67, NULL, NULL, 'haha', '2021-03-13 14:55:00'),
(306, 25, 68, NULL, NULL, 'like', '2021-03-13 16:33:54'),
(307, 25, 68, NULL, NULL, 'like', '2021-03-13 16:33:57'),
(308, 25, 68, NULL, NULL, 'like', '2021-03-13 16:34:01'),
(309, 25, 68, NULL, NULL, 'like', '2021-03-13 16:34:05');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `requestid` int(11) NOT NULL,
  `reqtReceiver` int(11) NOT NULL,
  `reqtSender` int(11) NOT NULL,
  `reqStatus` int(11) NOT NULL,
  `requestOn` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`requestid`, `reqtReceiver`, `reqtSender`, `reqStatus`, `requestOn`) VALUES
(12, 19, 20, 1, '2021-02-17 10:48:22'),
(13, 20, 20, 0, '2021-02-17 10:51:30'),
(14, 20, 20, 0, '2021-02-17 10:51:59'),
(16, 25, 27, 1, '2021-03-13 11:36:11'),
(18, 25, 25, 0, '2021-03-13 13:51:29');

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `token`
--

INSERT INTO `token` (`id`, `token`, `user_id`) VALUES
(82, 'e89e76ffc25cebb2f3f693dfb9ce31a826bf4ce8', 26),
(86, 'b32f3a86e4b0fdfe798cb31a9ea252155d589887', 27),
(93, '26beb0cb6693fe0068a81278c9e324b1d65cea2c', 25);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `screenName` varchar(255) NOT NULL,
  `userLink` text NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `birthday` date DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `screenName`, `userLink`, `email`, `mobile`, `password`, `birthday`, `gender`) VALUES
(25, 'Mihut', 'Ciprian', 'Mihut_Ciprian', 'Mihut_Ciprian', 'blitzzen.cipri@gmail.com', NULL, '$2y$10$.lOSJPo.xwjYTd0UuHmGNebJU72u6btQ1c0EMHVsusmEvAmGw5E6K', '1997-08-01', 'male'),
(26, 'Mihut', 'Ciprian', 'Mihut_Ciprian', 'Mihut_Ciprian40101207', 'ksadas@sad.com', NULL, '$2y$10$Tdxg0dcueA1JKj8PwTRfOOrXC.1jEp8.3JLoG6DU/7HfpkmI6lCca', '2003-01-01', 'male'),
(27, 'bogdi', 'mihut', 'bogdi_mihut', 'bogdi_mihut', 'mihut@gmail.com', NULL, '$2y$10$MJzPr61boFNavc3xLICwcud9Pms1f1a3gjQBgmOF7aYxEaWp4gKQG', '1997-01-01', 'male'),
(29, 'Alex', 'Doru', 'Alex_Doru', 'Alex_Doru', NULL, '12312312312', '$2y$10$uwmEVIUZg4qKWUSQSDiXweLagvJt5VJoLIt55r0egbiNBwl.0mHr2', '2012-01-01', 'male');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `block`
--
ALTER TABLE `block`
  ADD PRIMARY KEY (`blockID`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentID`);

--
-- Indexes for table `comments1`
--
ALTER TABLE `comments1`
  ADD PRIMARY KEY (`commentID`);

--
-- Indexes for table `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`messageID`);

--
-- Indexes for table `messages1`
--
ALTER TABLE `messages1`
  ADD PRIMARY KEY (`messageID`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `postForien` (`userId`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `react`
--
ALTER TABLE `react`
  ADD PRIMARY KEY (`reactID`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`requestid`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_fk` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `block`
--
ALTER TABLE `block`
  MODIFY `blockID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `commentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments1`
--
ALTER TABLE `comments1`
  MODIFY `commentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `follow`
--
ALTER TABLE `follow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `messageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `messages1`
--
ALTER TABLE `messages1`
  MODIFY `messageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `react`
--
ALTER TABLE `react`
  MODIFY `reactID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=310;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `requestid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `token`
--
ALTER TABLE `token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `postForien` FOREIGN KEY (`userId`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `token`
--
ALTER TABLE `token`
  ADD CONSTRAINT `user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
