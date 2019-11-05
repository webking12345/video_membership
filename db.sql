-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2019 at 04:59 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `video_membership`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL COMMENT 'category name',
  `description` varchar(500) DEFAULT NULL COMMENT 'category description',
  `class` varchar(200) DEFAULT NULL COMMENT 'category hierarchy ex: 00001.00001.',
  `is_leaf` tinyint(4) DEFAULT '1' COMMENT '1:leaf, 0:brench',
  `video_url` varchar(200) DEFAULT NULL COMMENT 'category intro video/image url',
  `thumb_url` varchar(200) DEFAULT NULL COMMENT 'thumbnail image url'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `class`, `is_leaf`, `video_url`, `thumb_url`) VALUES
(1, 'category1', NULL, '00001', 0, 'https://www.radiantmediaplayer.com/media/bbb-360p.mp4', 'public/images/video-thumbnail/big-buggy.jpg'),
(2, 'category2', NULL, '00002', 0, 'https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-576p.mp4', 'https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.jpg'),
(3, 'category3', NULL, '00003', 1, 'public/images/ServiceNow_Persona19_Security_Web.mp4', 'public/images/video-thumbnail/tech-intro.jpg'),
(4, 'category4', NULL, '00004', 1, 'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerJoyrides.mp4', 'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/images/ForBiggerJoyrides.jpg'),
(5, 'category5', NULL, '00005', 1, 'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ElephantsDream.mp4', 'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/images/ElephantsDream.jpg'),
(6, 'category1-1', NULL, '00001.00001', 1, 'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerBlazes.mp4', 'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/images/ForBiggerBlazes.jpg'),
(7, 'category1-2', NULL, '00001.00002', 1, 'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerEscapes.mp4', 'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/images/ForBiggerEscapes.jpg'),
(8, 'category2-1', NULL, '00002.00001', 1, 'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerFun.mp4', 'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/images/ForBiggerFun.jpg'),
(9, 'category2-2', NULL, '00002.00002', 1, 'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerJoyrides.mp4', 'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/images/ForBiggerJoyrides.jpg'),
(10, 'category2-3', NULL, '00002.00003', 1, 'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerMeltdowns.mp4', 'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/images/ForBiggerMeltdowns.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE `contents` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` int(11) DEFAULT NULL COMMENT 'contents type ex: video:1,txt:2,audio:3, image:4',
  `title` varchar(100) DEFAULT NULL COMMENT 'title',
  `description` varchar(500) DEFAULT NULL COMMENT 'description',
  `duration` varchar(250) DEFAULT NULL COMMENT 'duration ex: video/audio',
  `category_id` int(11) DEFAULT NULL,
  `contents_url` varchar(200) DEFAULT NULL COMMENT 'contents file url',
  `price` float DEFAULT NULL COMMENT 'price',
  `author_id` int(11) DEFAULT NULL COMMENT 'the author id of uploaded contents',
  `thumb_url` varchar(200) DEFAULT NULL COMMENT 'URL of the thumbnail  image for contents',
  `publish_date` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'publish_date',
  `reg_date` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'register date',
  `size` float DEFAULT NULL COMMENT 'file size e.g. 3.1M'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`id`, `type`, `title`, `description`, `duration`, `category_id`, `contents_url`, `price`, `author_id`, `thumb_url`, `publish_date`, `reg_date`, `size`) VALUES
(1, 1, 'Rogue One Trailer', '', '136', 6, 'https://www.radiantmediaplayer.com/media/bbb-360p.mp4', 23, NULL, 'public/uploads/video/thumb/default.png', '1000-01-01 00:00:00', '1000-01-01 00:00:00', 0),
(2, 1, 'Beauty and the Beast', 'a', '150', 1, 'https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-576p.mp4', 33, NULL, 'https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.jpg', '1000-01-01 00:00:00', '1000-01-01 00:00:00', 35),
(3, 2, 'The Dark Tower Trailer', NULL, '120', 2, 'https://www.antennahouse.com/XSLsample/pdf/sample-link_1.pdf', 43, NULL, 'public/images/video-thumbnail/tech-intro.jpg', '1000-01-01 00:00:00', '1000-01-01 00:00:00', 69),
(4, 1, 'Rogue One Trailer', NULL, '136', 1, 'https://www.radiantmediaplayer.com/media/bbb-360p.mp4', 3, NULL, 'public/images/video-thumbnail/big-buggy.jpg', '2019-10-18 18:52:56', '2019-10-18 18:52:56', 39),
(5, 1, 'Rogue One Trailer', NULL, '136', 1, 'https://www.radiantmediaplayer.com/media/bbb-360p.mp4', 221, NULL, 'public/images/video-thumbnail/big-buggy.jpg', '2019-10-18 18:52:56', '2019-10-18 18:52:56', 39),
(6, 1, 'Beauty and the Beast', NULL, '150', 1, 'https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-576p.mp4', 11, NULL, 'https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.jpg', '2019-10-18 18:52:56', '2019-10-18 18:52:56', 35),
(7, 2, 'The Dark Tower Trailer', NULL, '120', 2, 'https://www.ets.org/Media/Tests/GRE/pdf/gre_research_validity_data.pdf', 234, NULL, 'public/images/video-thumbnail/tech-intro.jpg', '2019-10-18 18:52:56', '2019-10-18 18:52:56', 69),
(8, 1, 'Rogue One Trailer', NULL, '136', 1, 'https://www.radiantmediaplayer.com/media/bbb-360p.mp4', 4, NULL, 'public/images/video-thumbnail/big-buggy.jpg', '2019-10-18 18:52:56', '2019-10-18 18:52:56', 39),
(12, 1, 'Rogue One Trailer', NULL, '136', 1, 'https://www.radiantmediaplayer.com/media/bbb-360p.mp4', 1, NULL, 'public/images/video-thumbnail/big-buggy.jpg', '2019-10-18 18:52:56', '2019-10-18 18:52:56', 39),
(13, 1, 'Beauty and the Beast', NULL, '150', 1, 'https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-576p.mp4', 76, NULL, 'https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.jpg', '2019-10-18 18:52:56', '2019-10-18 18:52:56', 35),
(14, 2, 'The Dark Tower Trailer', NULL, '120', 2, 'https://www.ets.org/Media/Tests/GRE/pdf/gre_research_validity_data.pdf', 35, NULL, 'public/images/video-thumbnail/tech-intro.jpg', '2019-10-18 18:52:56', '2019-10-18 18:52:56', 69),
(15, 1, 'Rogue One Trailer', NULL, '136', 1, 'https://www.radiantmediaplayer.com/media/bbb-360p.mp4', 20, NULL, 'public/images/video-thumbnail/big-buggy.jpg', '2019-10-18 18:52:56', '2019-10-18 18:52:56', 39),
(16, 1, 'Rogue One Trailer', NULL, '136', 1, 'https://www.radiantmediaplayer.com/media/bbb-360p.mp4', 12, NULL, 'public/images/video-thumbnail/big-buggy.jpg', '2019-10-18 18:52:56', '2019-10-18 18:52:56', 39),
(17, 1, 'Beauty and the Beast', NULL, '150', 1, 'https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-576p.mp4', 21, NULL, 'https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.jpg', '2019-10-18 18:52:56', '2019-10-18 18:52:56', 35),
(18, 2, 'The Dark Tower Trailer', NULL, '120', 2, 'https://www.antennahouse.com/XSLsample/pdf/sample-link_1.pdf', 53, NULL, 'public/images/video-thumbnail/tech-intro.jpg', '2019-10-18 18:52:56', '2019-10-18 18:52:56', 69),
(19, 1, 'Rogue One Trailer', NULL, '136', 1, 'https://www.radiantmediaplayer.com/media/bbb-360p.mp4', 66, NULL, 'public/images/video-thumbnail/big-buggy.jpg', '2019-10-18 18:52:56', '2019-10-18 18:52:56', 39),
(52, 1, 'Test', '', '0:05', 6, 'public/uploads/video/20191018154041_masthead.mp4', 15, NULL, 'public/uploads/video/thumb/20191018154041_masthead.jpg', '2019-10-18 23:40:41', '2019-10-18 23:40:41', 1042080),
(53, 2, 'Test PDF', '', '7', 7, 'public/uploads/doc/20191018154623_Strongman 2020 Website Design Brief.pdf', 5, NULL, 'public/uploads/doc/thumb/default.png', '2019-10-18 23:46:23', '2019-10-18 23:46:23', 0),
(55, 1, 'Youtube test1', 'youtube embed test', '10', 9, 'https://www.youtube.com/embed/tgbNymZ7vqY', 5, NULL, 'public/uploads/video/thumb/default.png', '2019-10-25 01:39:16', '2019-10-25 01:39:16', 5000);

-- --------------------------------------------------------

--
-- Table structure for table `feature_list`
--

CREATE TABLE `feature_list` (
  `id` int(11) NOT NULL,
  `feature` varchar(200) DEFAULT NULL COMMENT 'feature name',
  `feature_description` varchar(500) DEFAULT NULL COMMENT 'feature description',
  `tag` varchar(100) DEFAULT NULL COMMENT 'short name, tag'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `feature_list`
--

INSERT INTO `feature_list` (`id`, `feature`, `feature_description`, `tag`) VALUES
(1, 'membership feature1', '', 'f-1'),
(2, 'membership feature2', '', 'f-2'),
(3, 'membership feature3', NULL, 'f-3'),
(4, 'membership feature4', NULL, 'f-4'),
(5, 'membership feature5', NULL, 'f-5'),
(6, 'membership', '', 'f-6');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `action` int(2) NOT NULL COMMENT '1:register, 2:login, 3:logout, 4: visit page, 5: join, 6:purchase contents',
  `description` text,
  `user_ip` varchar(250) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `user_id`, `action`, `description`, `user_ip`, `date`) VALUES
(1, 2, 4, 'visit home page', '::1', '2019-10-26 03:21:20');

-- --------------------------------------------------------

--
-- Table structure for table `membership_data`
--

CREATE TABLE `membership_data` (
  `id` int(10) UNSIGNED NOT NULL,
  `membership_id` int(11) DEFAULT NULL COMMENT 'membership id',
  `user_id` int(11) DEFAULT NULL COMMENT 'user_id',
  `purchase_date` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'membership purchase date'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `membership_data`
--

INSERT INTO `membership_data` (`id`, `membership_id`, `user_id`, `purchase_date`) VALUES
(1, 1, 3, '2019-10-25 03:07:09');

-- --------------------------------------------------------

--
-- Table structure for table `membership_level`
--

CREATE TABLE `membership_level` (
  `id` int(10) UNSIGNED NOT NULL,
  `level_name` varchar(100) DEFAULT NULL COMMENT 'membership level name',
  `description` varchar(500) DEFAULT NULL COMMENT 'membership description',
  `price` float DEFAULT NULL COMMENT 'membership price',
  `timeline` varchar(100) DEFAULT NULL COMMENT 'membership timeline ex: 1: month, 2: year, 3: lifetime',
  `feature_id` varchar(200) DEFAULT NULL COMMENT 'feature id list ex: 1,2,3'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `membership_level`
--

INSERT INTO `membership_level` (`id`, `level_name`, `description`, `price`, `timeline`, `feature_id`) VALUES
(1, 'weekly', '1 week available', 15, '7', ',1'),
(2, 'monthly', '1 month available', 50, '30', '2,3,1'),
(3, 'yearly', '1 year available', 100, '365', '1,2,3,4,5'),
(4, 'lifetime', 'Lifetime available', 200, '999999', '2,3,4,5,6,7,1');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL COMMENT 'user id',
  `contents_id` int(11) DEFAULT NULL COMMENT 'contents id',
  `browse_time` datetime DEFAULT '1000-01-01 00:00:00' COMMENT 'Date and time when the user browse the content'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(100) CHARACTER SET latin1 DEFAULT NULL COMMENT 'user name',
  `email` varchar(100) CHARACTER SET latin1 DEFAULT NULL COMMENT 'email address',
  `pwd` varchar(200) CHARACTER SET latin1 DEFAULT NULL COMMENT 'password',
  `role` int(1) DEFAULT '2' COMMENT 'usre role id 1: admin',
  `reg_datetime` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'register datetime',
  `last_datetime` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'user last connect datetime',
  `balance` float DEFAULT '0' COMMENT 'user balace',
  `allow` tinyint(4) DEFAULT '1' COMMENT '1: allow, 0: block'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `pwd`, `role`, `reg_datetime`, `last_datetime`, `balance`, `allow`) VALUES
(1, 'admin', 'admin@123.com', 'e10adc3949ba59abbe56e057f20f883e', 1, '2019-09-18 03:29:23', '2019-09-18 03:29:23', 0, 1),
(2, 'user', 'user@123.com', 'e10adc3949ba59abbe56e057f20f883e', 2, '2019-09-18 04:04:36', '2019-09-18 04:04:36', 15, 1),
(3, 'user1', 'user1@123.com', 'c4ca4238a0b923820dcc509a6f75849b', 2, '2019-09-18 11:00:42', '2019-09-18 11:00:42', 0, 1),
(4, 'test', 'test@test.com', '098f6bcd4621d373cade4e832627b4f6', 2, '2019-09-28 20:44:09', '2019-09-28 20:44:09', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `class` (`class`);

--
-- Indexes for table `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feature_list`
--
ALTER TABLE `feature_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `membership_data`
--
ALTER TABLE `membership_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `membership_level`
--
ALTER TABLE `membership_level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `contents`
--
ALTER TABLE `contents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `feature_list`
--
ALTER TABLE `feature_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `membership_data`
--
ALTER TABLE `membership_data`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `membership_level`
--
ALTER TABLE `membership_level`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
