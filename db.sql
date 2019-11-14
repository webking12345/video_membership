/*
SQLyog Community
MySQL - 10.1.31-MariaDB : Database - video_membership
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `balance_history` */

DROP TABLE IF EXISTS `balance_history`;

CREATE TABLE `balance_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(250) NOT NULL,
  `in_amount` double DEFAULT NULL,
  `in_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `in_description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `balance_history` */

insert  into `balance_history`(`id`,`user_email`,`in_amount`,`in_date`,`in_description`) values 
(1,'test@tesat.com',15,'2019-11-07 05:48:24','Purchase weekly membership'),
(2,'test@tesat.com',50,'2019-11-07 05:52:52','Purchase montly membership'),
(3,'test@tesat.com',100,'2019-11-07 05:57:23','Purchase yearly membership');

/*Table structure for table `category` */

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL COMMENT 'category name',
  `description` varchar(500) DEFAULT NULL COMMENT 'category description',
  `class` varchar(200) DEFAULT NULL COMMENT 'category hierarchy ex: 00001.00001.',
  `is_leaf` tinyint(4) DEFAULT '1' COMMENT '1:leaf, 0:brench',
  `video_url` varchar(200) DEFAULT NULL COMMENT 'category intro video/image url',
  `thumb_url` varchar(200) DEFAULT NULL COMMENT 'thumbnail image url',
  PRIMARY KEY (`id`),
  UNIQUE KEY `class` (`class`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `category` */

insert  into `category`(`id`,`name`,`description`,`class`,`is_leaf`,`video_url`,`thumb_url`) values 
(1,'category1',NULL,'00001',0,'https://www.radiantmediaplayer.com/media/bbb-360p.mp4','public/images/video-thumbnail/big-buggy.jpg'),
(2,'category2',NULL,'00002',0,'https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-576p.mp4','https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.jpg'),
(3,'category3',NULL,'00003',1,'public/images/ServiceNow_Persona19_Security_Web.mp4','public/images/video-thumbnail/tech-intro.jpg'),
(4,'category4',NULL,'00004',1,'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerJoyrides.mp4','http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/images/ForBiggerJoyrides.jpg'),
(5,'category5',NULL,'00005',1,'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ElephantsDream.mp4','http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/images/ElephantsDream.jpg'),
(6,'category1-1',NULL,'00001.00001',1,'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerBlazes.mp4','http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/images/ForBiggerBlazes.jpg'),
(7,'category1-2',NULL,'00001.00002',1,'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerEscapes.mp4','http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/images/ForBiggerEscapes.jpg'),
(8,'category2-1',NULL,'00002.00001',1,'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerFun.mp4','http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/images/ForBiggerFun.jpg'),
(9,'category2-2',NULL,'00002.00002',1,'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerJoyrides.mp4','http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/images/ForBiggerJoyrides.jpg'),
(10,'category2-3',NULL,'00002.00003',1,'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerMeltdowns.mp4','http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/images/ForBiggerMeltdowns.jpg');

/*Table structure for table `contents` */

DROP TABLE IF EXISTS `contents`;

CREATE TABLE `contents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` int(11) DEFAULT NULL COMMENT 'contents type ex: video:1,txt:2,audio:3, image:4',
  `title` varchar(100) DEFAULT NULL COMMENT 'title',
  `description` varchar(500) DEFAULT NULL COMMENT 'description',
  `description2` text,
  `duration` varchar(250) DEFAULT NULL COMMENT 'duration ex: video/audio',
  `category_id` int(11) DEFAULT NULL,
  `contents_url` varchar(200) DEFAULT NULL COMMENT 'contents file url',
  `price` float DEFAULT NULL COMMENT 'price',
  `author_id` int(11) DEFAULT NULL COMMENT 'the author id of uploaded contents',
  `thumb_url` varchar(200) DEFAULT NULL COMMENT 'URL of the thumbnail  image for contents',
  `publish_date` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'publish_date',
  `reg_date` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'register date',
  `size` float DEFAULT NULL COMMENT 'file size e.g. 3.1M',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

/*Data for the table `contents` */

insert  into `contents`(`id`,`type`,`title`,`description`,`description2`,`duration`,`category_id`,`contents_url`,`price`,`author_id`,`thumb_url`,`publish_date`,`reg_date`,`size`) values 
(1,1,'Rogue One Trailer','',NULL,'136',6,'https://www.radiantmediaplayer.com/media/bbb-360p.mp4',23,NULL,'public/uploads/video/thumb/default.png','1000-01-01 00:00:00','1000-01-01 00:00:00',0),
(2,1,'Beauty and the Beast','a',NULL,'150',1,'https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-576p.mp4',33,NULL,'https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.jpg','1000-01-01 00:00:00','1000-01-01 00:00:00',35),
(3,2,'The Dark Tower Trailer',NULL,NULL,'120',2,'https://www.antennahouse.com/XSLsample/pdf/sample-link_1.pdf',43,NULL,'public/images/video-thumbnail/tech-intro.jpg','1000-01-01 00:00:00','1000-01-01 00:00:00',69),
(4,1,'Rogue One Trailer',NULL,NULL,'136',1,'https://www.radiantmediaplayer.com/media/bbb-360p.mp4',3,NULL,'public/images/video-thumbnail/big-buggy.jpg','2019-10-18 18:52:56','2019-10-18 18:52:56',39),
(5,1,'Rogue One Trailer',NULL,NULL,'136',1,'https://www.radiantmediaplayer.com/media/bbb-360p.mp4',221,NULL,'public/images/video-thumbnail/big-buggy.jpg','2019-10-18 18:52:56','2019-10-18 18:52:56',39),
(6,1,'Beauty and the Beast',NULL,NULL,'150',1,'https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-576p.mp4',11,NULL,'https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.jpg','2019-10-18 18:52:56','2019-10-18 18:52:56',35),
(7,2,'The Dark Tower Trailer',NULL,NULL,'120',2,'https://www.ets.org/Media/Tests/GRE/pdf/gre_research_validity_data.pdf',234,NULL,'public/images/video-thumbnail/tech-intro.jpg','2019-10-18 18:52:56','2019-10-18 18:52:56',69),
(8,1,'Rogue One Trailer',NULL,NULL,'136',1,'https://www.radiantmediaplayer.com/media/bbb-360p.mp4',4,NULL,'public/images/video-thumbnail/big-buggy.jpg','2019-10-18 18:52:56','2019-10-18 18:52:56',39),
(12,1,'Rogue One Trailer',NULL,NULL,'136',1,'https://www.radiantmediaplayer.com/media/bbb-360p.mp4',1,NULL,'public/images/video-thumbnail/big-buggy.jpg','2019-10-18 18:52:56','2019-10-18 18:52:56',39),
(13,1,'Beauty and the Beast',NULL,NULL,'150',1,'https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-576p.mp4',76,NULL,'https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.jpg','2019-10-18 18:52:56','2019-10-18 18:52:56',35),
(14,2,'The Dark Tower Trailer',NULL,NULL,'120',2,'https://www.ets.org/Media/Tests/GRE/pdf/gre_research_validity_data.pdf',35,NULL,'public/images/video-thumbnail/tech-intro.jpg','2019-10-18 18:52:56','2019-10-18 18:52:56',69),
(15,1,'Rogue One Trailer',NULL,NULL,'136',1,'https://www.radiantmediaplayer.com/media/bbb-360p.mp4',20,NULL,'public/images/video-thumbnail/big-buggy.jpg','2019-10-18 18:52:56','2019-10-18 18:52:56',39),
(16,1,'Rogue One Trailer',NULL,NULL,'136',1,'https://www.radiantmediaplayer.com/media/bbb-360p.mp4',12,NULL,'public/images/video-thumbnail/big-buggy.jpg','2019-10-18 18:52:56','2019-10-18 18:52:56',39),
(17,1,'Beauty and the Beast',NULL,NULL,'150',1,'https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-576p.mp4',21,NULL,'https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.jpg','2019-10-18 18:52:56','2019-10-18 18:52:56',35),
(18,2,'The Dark Tower Trailer',NULL,NULL,'120',2,'https://www.antennahouse.com/XSLsample/pdf/sample-link_1.pdf',53,NULL,'public/images/video-thumbnail/tech-intro.jpg','2019-10-18 18:52:56','2019-10-18 18:52:56',69),
(19,1,'Rogue One Trailer',NULL,NULL,'136',1,'https://www.radiantmediaplayer.com/media/bbb-360p.mp4',66,NULL,'public/images/video-thumbnail/big-buggy.jpg','2019-10-18 18:52:56','2019-10-18 18:52:56',39),
(52,1,'Test','',NULL,'0:05',6,'public/uploads/video/20191018154041_masthead.mp4',15,NULL,'public/uploads/video/thumb/20191018154041_masthead.jpg','2019-10-18 23:40:41','2019-10-18 23:40:41',1042080),
(53,2,'Test PDF','',NULL,'7',7,'public/uploads/doc/20191018154623_Strongman 2020 Website Design Brief.pdf',5,NULL,'public/uploads/doc/thumb/default.png','2019-10-18 23:46:23','2019-10-18 23:46:23',0),
(55,1,'Youtube test1','youtube embed test','This is the description2 for this product','10',9,'https://www.youtube.com/embed/tgbNymZ7vqY',5,NULL,'public/uploads/video/thumb/default.png','2019-10-25 01:39:16','2019-10-25 01:39:16',4);

/*Table structure for table `feature_list` */

DROP TABLE IF EXISTS `feature_list`;

CREATE TABLE `feature_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `feature` varchar(200) DEFAULT NULL COMMENT 'feature name',
  `feature_description` varchar(500) DEFAULT NULL COMMENT 'feature description',
  `tag` varchar(100) DEFAULT NULL COMMENT 'short name, tag',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `feature_list` */

insert  into `feature_list`(`id`,`feature`,`feature_description`,`tag`) values 
(1,'membership feature1','','f-1'),
(2,'membership feature2','','f-2'),
(3,'membership feature3',NULL,'f-3'),
(4,'membership feature4',NULL,'f-4'),
(5,'membership feature5',NULL,'f-5'),
(6,'membership','','f-6');

/*Table structure for table `history` */

DROP TABLE IF EXISTS `history`;

CREATE TABLE `history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `action` int(2) NOT NULL COMMENT '1:register, 2:login, 3:logout, 4: visit page, 5: join, 6:purchase contents',
  `description` text,
  `user_ip` varchar(250) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=181 DEFAULT CHARSET=utf8;

/*Data for the table `history` */

insert  into `history`(`id`,`user_id`,`action`,`description`,`user_ip`,`date`) values 
(1,2,6,'purchase content','::1','2019-11-05 13:05:07'),
(2,2,4,'PlayYoutube test1','::1','2019-11-05 13:05:08'),
(3,2,2,'login','::1','2019-11-05 18:49:07'),
(4,2,4,'PlayYoutube test1','::1','2019-11-05 19:03:52'),
(5,2,3,'logout','::1','2019-11-05 19:23:28'),
(6,0,4,'visit home page','::1','2019-11-05 19:23:28'),
(7,1,2,'login','::1','2019-11-05 19:23:34'),
(8,1,4,'PlayYoutube test1','::1','2019-11-05 19:23:39'),
(9,1,3,'logout','::1','2019-11-05 19:47:07'),
(10,0,4,'visit home page','::1','2019-11-05 19:47:07'),
(11,18,1,'register','::1','2019-11-05 19:52:14'),
(12,18,5,'purchase membership','::1','2019-11-05 19:52:14'),
(13,18,4,'visit home page','::1','2019-11-05 19:54:47'),
(14,18,3,'logout','::1','2019-11-05 19:54:50'),
(15,0,4,'visit home page','::1','2019-11-05 19:54:50'),
(16,0,4,'visit home page','::1','2019-11-05 19:56:09'),
(17,0,4,'visit home page','::1','2019-11-05 19:57:17'),
(18,22,1,'register','::1','2019-11-05 19:57:59'),
(19,22,5,'purchase membership','::1','2019-11-05 19:58:00'),
(20,22,3,'logout','::1','2019-11-05 19:58:50'),
(21,0,4,'visit home page','::1','2019-11-05 19:58:50'),
(22,1,2,'login','::1','2019-11-05 19:58:55'),
(23,1,3,'logout','::1','2019-11-05 19:59:10'),
(24,0,4,'visit home page','::1','2019-11-05 19:59:10'),
(25,23,1,'register','::1','2019-11-05 19:59:37'),
(26,23,5,'purchase membership','::1','2019-11-05 19:59:37'),
(27,23,3,'logout','::1','2019-11-05 20:01:37'),
(28,0,4,'visit home page','::1','2019-11-05 20:01:37'),
(29,1,2,'login','::1','2019-11-05 20:01:45'),
(30,1,3,'logout','::1','2019-11-05 20:16:23'),
(31,0,4,'visit home page','::1','2019-11-05 20:16:23'),
(32,1,2,'login','::1','2019-11-05 22:39:31'),
(33,1,3,'logout','::1','2019-11-05 22:55:43'),
(34,0,4,'visit home page','::1','2019-11-05 22:55:43'),
(35,22,2,'login','::1','2019-11-05 22:56:01'),
(36,22,3,'logout','::1','2019-11-05 22:56:29'),
(37,0,4,'visit home page','::1','2019-11-05 22:56:29'),
(38,8,2,'login','::1','2019-11-05 22:57:01'),
(39,8,3,'logout','::1','2019-11-05 22:57:12'),
(40,0,4,'visit home page','::1','2019-11-05 22:57:13'),
(41,1,2,'login','::1','2019-11-05 22:58:59'),
(42,0,4,'visit home page','::1','2019-11-06 01:06:25'),
(43,8,2,'login','::1','2019-11-06 01:06:35'),
(44,8,6,'purchase content','::1','2019-11-06 01:07:00'),
(45,8,4,'PlayRogue One Trailer','::1','2019-11-06 01:07:00'),
(46,1,3,'logout','::1','2019-11-06 01:20:02'),
(47,0,4,'visit home page','::1','2019-11-06 01:20:02'),
(48,8,2,'login','::1','2019-11-06 01:20:14'),
(49,8,6,'purchase content','::1','2019-11-06 01:22:29'),
(50,8,6,'purchase content','::1','2019-11-06 01:22:30'),
(51,8,6,'purchase content','::1','2019-11-06 01:22:30'),
(52,8,4,'PlayTest','::1','2019-11-06 01:22:30'),
(53,8,3,'logout','::1','2019-11-06 01:22:43'),
(54,0,4,'visit home page','::1','2019-11-06 01:22:43'),
(55,1,2,'login','::1','2019-11-06 01:22:48'),
(56,1,4,'visit home page','::1','2019-11-06 02:36:13'),
(57,1,4,'PlayTest PDF','::1','2019-11-06 02:36:36'),
(58,1,3,'logout','::1','2019-11-06 02:36:49'),
(59,0,4,'visit home page','::1','2019-11-06 02:36:49'),
(60,8,2,'login','::1','2019-11-06 02:36:58'),
(61,NULL,3,'logout','::1','2019-11-06 05:03:09'),
(62,0,4,'visit home page','::1','2019-11-06 05:03:09'),
(63,8,2,'login','::1','2019-11-06 05:13:30'),
(64,8,3,'logout','::1','2019-11-06 05:16:10'),
(65,0,4,'visit home page','::1','2019-11-06 05:16:10'),
(66,1,2,'login','::1','2019-11-06 05:16:14'),
(67,1,4,'PlayTest','::1','2019-11-06 05:16:19'),
(68,1,4,'PlayRogue One Trailer','::1','2019-11-06 05:18:01'),
(69,1,4,'PlayTest PDF','::1','2019-11-06 05:18:13'),
(70,1,4,'PlayTest PDF','::1','2019-11-06 05:19:36'),
(71,1,4,'visit home page','::1','2019-11-06 05:24:15'),
(72,1,4,'PlayYoutube test1','::1','2019-11-06 05:34:04'),
(73,1,4,'PlayYoutube test1','::1','2019-11-06 05:34:36'),
(74,1,4,'visit home page','::1','2019-11-06 05:45:16'),
(75,0,4,'visit home page','::1','2019-11-06 10:43:59'),
(76,0,4,'visit home page','::1','2019-11-06 12:12:41'),
(77,8,2,'login','::1','2019-11-06 12:17:44'),
(78,8,4,'visit home page','::1','2019-11-06 12:44:43'),
(79,8,4,'visit home page','::1','2019-11-06 12:46:11'),
(80,8,3,'logout','::1','2019-11-06 12:49:01'),
(81,0,4,'visit home page','::1','2019-11-06 12:49:01'),
(82,8,2,'login','::1','2019-11-06 12:49:16'),
(83,8,5,'purchase membership','::1','2019-11-06 12:51:11'),
(84,8,5,'purchase membership','::1','2019-11-06 12:51:11'),
(85,8,5,'purchase membership','::1','2019-11-06 12:51:11'),
(86,8,5,'purchase membership','::1','2019-11-06 12:51:11'),
(87,8,5,'purchase membership','::1','2019-11-06 13:04:07'),
(88,8,2,'login','::1','2019-11-06 19:18:20'),
(89,8,3,'logout','::1','2019-11-06 19:21:32'),
(90,0,4,'visit home page','::1','2019-11-06 19:21:32'),
(91,1,2,'login','::1','2019-11-06 19:21:37'),
(92,0,4,'visit home page','::1','2019-11-06 19:22:23'),
(93,1,3,'logout','::1','2019-11-06 19:33:49'),
(94,0,4,'visit home page','::1','2019-11-06 19:33:50'),
(95,8,2,'login','::1','2019-11-06 19:50:22'),
(96,8,4,'PlayTest','::1','2019-11-06 20:15:14'),
(97,8,4,'PlayTest','::1','2019-11-06 20:17:03'),
(98,8,4,'PlayTest','::1','2019-11-06 20:18:03'),
(99,8,4,'PlayTest PDF','::1','2019-11-06 20:18:30'),
(100,8,4,'PlayTest PDF','::1','2019-11-06 21:55:42'),
(101,8,4,'PlayTest PDF','::1','2019-11-06 21:56:25'),
(102,8,4,'PlayTest PDF','::1','2019-11-06 22:00:26'),
(103,8,4,'PlayTest PDF','::1','2019-11-06 22:00:57'),
(104,8,4,'PlayTest PDF','::1','2019-11-06 22:02:21'),
(105,8,4,'PlayTest PDF','::1','2019-11-06 22:02:23'),
(106,8,4,'PlayTest PDF','::1','2019-11-06 22:02:47'),
(107,8,4,'PlayTest PDF','::1','2019-11-06 22:02:49'),
(108,8,4,'PlayTest PDF','::1','2019-11-06 22:03:29'),
(109,8,4,'PlayTest PDF','::1','2019-11-06 22:07:59'),
(110,8,4,'PlayTest PDF','::1','2019-11-06 22:08:18'),
(111,8,4,'PlayTest PDF','::1','2019-11-06 22:08:32'),
(112,8,4,'PlayTest PDF','::1','2019-11-06 22:08:36'),
(113,8,4,'PlayTest PDF','::1','2019-11-06 22:13:34'),
(114,8,4,'visit home page','::1','2019-11-06 22:13:35'),
(115,8,4,'PlayTest PDF','::1','2019-11-06 22:17:25'),
(116,8,4,'PlayTest PDF','::1','2019-11-06 22:21:36'),
(117,8,4,'PlayTest PDF','::1','2019-11-06 22:21:59'),
(118,8,2,'login','::1','2019-11-07 02:46:15'),
(119,8,3,'logout','::1','2019-11-07 03:20:45'),
(120,0,4,'visit home page','::1','2019-11-07 03:20:45'),
(121,8,2,'login','::1','2019-11-07 03:21:05'),
(122,8,5,'purchase membership','::1','2019-11-07 04:54:34'),
(123,8,5,'purchase membership','::1','2019-11-07 05:10:22'),
(124,8,5,'purchase membership','::1','2019-11-07 05:42:31'),
(125,8,5,'purchase membership','::1','2019-11-07 05:43:28'),
(126,8,5,'purchase membership','::1','2019-11-07 05:44:33'),
(127,8,5,'purchase membership','::1','2019-11-07 05:45:55'),
(128,8,5,'purchase membership','::1','2019-11-07 05:48:25'),
(129,8,5,'purchase membership','::1','2019-11-07 05:52:53'),
(130,8,5,'purchase membership','::1','2019-11-07 05:57:32'),
(131,8,4,'PlayTest PDF','::1','2019-11-07 05:58:47'),
(132,8,4,'PlayTest PDF','::1','2019-11-07 06:04:01'),
(133,8,4,'PlayTest PDF','::1','2019-11-07 06:04:11'),
(134,8,4,'PlayTest PDF','::1','2019-11-07 06:04:15'),
(135,8,4,'PlayTest PDF','::1','2019-11-07 06:04:48'),
(136,8,4,'PlayTest PDF','::1','2019-11-07 06:04:55'),
(137,8,4,'PlayTest PDF','::1','2019-11-07 06:05:00'),
(138,8,4,'PlayTest PDF','::1','2019-11-07 06:05:06'),
(139,8,4,'PlayTest PDF','::1','2019-11-07 06:06:59'),
(140,8,4,'PlayTest PDF','::1','2019-11-07 06:07:05'),
(141,8,4,'PlayTest PDF','::1','2019-11-07 06:07:39'),
(142,8,4,'PlayTest PDF','::1','2019-11-07 06:07:54'),
(143,8,3,'logout','::1','2019-11-07 06:08:48'),
(144,0,4,'visit home page','::1','2019-11-07 06:08:48'),
(145,0,4,'visit home page','::1','2019-11-07 06:21:50'),
(146,0,4,'visit home page','::1','2019-11-07 06:22:05'),
(147,0,4,'visit home page','::1','2019-11-07 06:22:12'),
(148,0,4,'visit home page','::1','2019-11-07 06:22:16'),
(149,0,4,'visit home page','::1','2019-11-08 01:56:17'),
(150,0,4,'visit home page','::1','2019-11-08 23:57:52'),
(151,0,4,'visit home page','::1','2019-11-08 23:59:27'),
(152,0,4,'visit home page','::1','2019-11-08 23:59:29'),
(153,0,4,'visit home page','::1','2019-11-08 23:59:30'),
(154,0,4,'visit home page','::1','2019-11-08 23:59:55'),
(155,0,4,'visit home page','::1','2019-11-09 00:00:09'),
(156,8,2,'login','::1','2019-11-09 00:12:22'),
(157,8,4,'PlayTest','::1','2019-11-09 00:22:26'),
(158,8,4,'PlayTest','::1','2019-11-09 00:22:39'),
(159,8,4,'PlayTest PDF','::1','2019-11-09 00:22:49'),
(160,8,4,'PlayTest PDF','::1','2019-11-09 00:23:00'),
(161,8,4,'PlayTest PDF','::1','2019-11-09 00:23:08'),
(162,8,4,'PlayTest PDF','::1','2019-11-09 00:23:46'),
(163,8,4,'PlayTest PDF','::1','2019-11-09 00:37:57'),
(164,8,4,'PlayTest PDF','::1','2019-11-09 00:38:00'),
(165,8,4,'PlayTest PDF','::1','2019-11-09 00:38:04'),
(166,8,4,'PlayTest PDF','::1','2019-11-09 00:38:10'),
(167,8,4,'PlayTest PDF','::1','2019-11-09 00:38:16'),
(168,8,4,'PlayTest PDF','::1','2019-11-09 00:38:18'),
(169,0,4,'visit home page','::1','2019-11-11 01:21:14'),
(170,0,4,'visit home page','::1','2019-11-11 01:21:15'),
(171,0,4,'visit home page','::1','2019-11-11 01:24:24'),
(172,0,4,'visit home page','::1','2019-11-11 01:58:01'),
(173,0,4,'visit home page','127.0.0.1','2019-11-11 02:51:17'),
(174,0,4,'visit home page','::1','2019-11-11 22:17:06'),
(175,1,2,'login','::1','2019-11-11 22:17:14'),
(176,0,4,'visit home page','::1','2019-11-12 05:33:45'),
(177,8,2,'login','::1','2019-11-12 05:33:50'),
(178,8,3,'logout','::1','2019-11-12 05:34:03'),
(179,0,4,'visit home page','::1','2019-11-12 05:34:03'),
(180,22,2,'login','::1','2019-11-12 05:34:08');

/*Table structure for table `membership_level` */

DROP TABLE IF EXISTS `membership_level`;

CREATE TABLE `membership_level` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `level_name` varchar(100) DEFAULT NULL COMMENT 'membership level name',
  `description` text COMMENT 'membership description',
  `price` float DEFAULT NULL COMMENT 'membership price',
  `timeline` double DEFAULT '0' COMMENT 'membership timeline ex: 1: month, 2: year, 3: lifetime',
  `feature_id` varchar(200) DEFAULT NULL COMMENT 'feature id list ex: 1,2,3',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `membership_level` */

insert  into `membership_level`(`id`,`level_name`,`description`,`price`,`timeline`,`feature_id`) values 
(1,'No member','Please level up membership to purchase',0,0,NULL),
(2,'weekly','1 week available\n\nsdfsdfsdf',15,7,NULL),
(3,'montly','1 month available',50,30,NULL),
(4,'yearly','1 year available',100,365,NULL),
(5,'lifetime','lifetime available',200,999999,NULL);

/*Table structure for table `order` */

DROP TABLE IF EXISTS `order`;

CREATE TABLE `order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL COMMENT 'user id',
  `contents_id` int(11) DEFAULT NULL COMMENT 'contents id',
  `browse_time` datetime DEFAULT '1000-01-01 00:00:00' COMMENT 'Date and time when the user browse the content',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `order` */

/*Table structure for table `purchase_contents` */

DROP TABLE IF EXISTS `purchase_contents`;

CREATE TABLE `purchase_contents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `purchase_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_played` int(1) NOT NULL DEFAULT '0',
  `play_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `purchase_contents` */

/*Table structure for table `purchase_membership` */

DROP TABLE IF EXISTS `purchase_membership`;

CREATE TABLE `purchase_membership` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `membership_id` int(11) NOT NULL COMMENT 'membership id',
  `user_id` int(11) NOT NULL COMMENT 'user_id',
  `purchase_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'membership purchase date',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `purchase_membership` */

insert  into `purchase_membership`(`id`,`membership_id`,`user_id`,`purchase_date`) values 
(1,4,8,'2019-11-07 05:57:32');

/*Table structure for table `setting` */

DROP TABLE IF EXISTS `setting`;

CREATE TABLE `setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_title` varchar(250) DEFAULT NULL,
  `copyright` varchar(250) DEFAULT NULL,
  `welcome_text` text,
  `register_description1` text,
  `register_description2` text,
  `login_description` text,
  `join_description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `setting` */

insert  into `setting`(`id`,`site_title`,`copyright`,`welcome_text`,`register_description1`,`register_description2`,`login_description`,`join_description`) values 
(1,'Lifestyle','Copyright@2019 Lifestyle.com','Lifestyle is dedicated to bringing inspirational stories to light, \nusing the power of video and the internet to multiply acts of kindness, beauty, and generosity.','Please write a description1 on the setting page of the admin panel.','Please write a description2 on the setting page of the admin panel.','Please write a description on the setting page of the admin panel.','Please write a description on the setting page of the admin panel.');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) CHARACTER SET latin1 DEFAULT NULL COMMENT 'user name',
  `email` varchar(100) CHARACTER SET latin1 DEFAULT NULL COMMENT 'email address',
  `pwd` varchar(200) CHARACTER SET latin1 DEFAULT NULL COMMENT 'password',
  `role` int(1) DEFAULT '2' COMMENT 'usre role id 1: admin',
  `reg_datetime` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'register datetime',
  `last_datetime` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'user last connect datetime',
  `balance` float DEFAULT '0' COMMENT 'user balace',
  `allow` tinyint(4) DEFAULT '1' COMMENT '1: allow, 0: block',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`email`,`pwd`,`role`,`reg_datetime`,`last_datetime`,`balance`,`allow`) values 
(1,'admin','admin@1123.com','e10adc3949ba59abbe56e057f20f883e',1,'2019-09-18 03:29:23','2019-09-18 03:29:23',0,1),
(2,'user','user@123.com','e10adc3949ba59abbe56e057f20f883e',2,'2019-09-18 04:04:36','2019-09-18 04:04:36',15,1),
(3,'user1','user1@123.com','c4ca4238a0b923820dcc509a6f75849b',2,'2019-09-18 11:00:42','2019-09-18 11:00:42',0,1),
(4,'test','test@test.com','098f6bcd4621d373cade4e832627b4f6',2,'2019-09-28 20:44:09','2019-09-28 20:44:09',0,1),
(7,'user','test@test1.com','e10adc3949ba59abbe56e057f20f883e',2,'2019-11-01 01:40:34','2019-11-01 01:40:34',0,1),
(8,'user','test@tesat.com','e10adc3949ba59abbe56e057f20f883e',2,'2019-11-01 01:44:12','2019-11-01 01:44:12',0,1),
(16,'user101','user101@gmail.com','e10adc3949ba59abbe56e057f20f883e',2,'2019-11-05 11:50:30','2019-11-05 11:50:30',0,1),
(17,'user102','user102@gmail.com','e10adc3949ba59abbe56e057f20f883e',2,'2019-11-05 12:07:42','2019-11-05 12:07:42',0,1),
(18,'user103','user103@gmail.com','e10adc3949ba59abbe56e057f20f883e',2,'2019-11-05 19:52:14','2019-11-05 19:52:14',0,1),
(22,'user103','user105@gmail.com','e10adc3949ba59abbe56e057f20f883e',2,'2019-11-05 19:57:59','2019-11-05 19:57:59',0,1),
(23,'user106','user106@gmail.com','e10adc3949ba59abbe56e057f20f883e',2,'2019-11-05 19:59:37','2019-11-05 19:59:37',0,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
