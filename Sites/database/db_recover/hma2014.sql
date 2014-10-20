-- phpMyAdmin SQL Dump
-- version 4.2.8.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2014-10-09 15:59:04
-- 服务器版本： 5.6.20
-- PHP Version: 5.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hma2014`
--

-- --------------------------------------------------------

--
-- 表的结构 `EI_area_overall`
--

CREATE TABLE IF NOT EXISTS `EI_area_overall` (
  `state_name` varchar(20) NOT NULL,
  `state_count` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `EI_area_time`
--

CREATE TABLE IF NOT EXISTS `EI_area_time` (
  `time_node` varchar(20) NOT NULL,
  `state_name` varchar(20) NOT NULL,
  `state_count` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `EI_area_type`
--

CREATE TABLE IF NOT EXISTS `EI_area_type` (
  `exercise_type` varchar(20) NOT NULL,
  `state_name` varchar(20) NOT NULL,
  `state_count` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `EI_time_overall`
--

CREATE TABLE IF NOT EXISTS `EI_time_overall` (
  `time_node` varchar(20) NOT NULL,
  `time_count` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `EI_time_type`
--

CREATE TABLE IF NOT EXISTS `EI_time_type` (
  `exercise_type` varchar(20) NOT NULL,
  `time_node` varchar(20) NOT NULL,
  `time_count` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `EI_type_overall`
--

CREATE TABLE IF NOT EXISTS `EI_type_overall` (
  `exercise_type` varchar(20) NOT NULL,
  `exercise_count` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `Etime_state`
--

CREATE TABLE IF NOT EXISTS `Etime_state` (
  `state_name` varchar(20) NOT NULL,
  `exercise_time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `Etime_state_mean`
--

CREATE TABLE IF NOT EXISTS `Etime_state_mean` (
  `state_name` varchar(20) NOT NULL,
  `mean` int(11) NOT NULL,
  `max` int(11) NOT NULL,
  `std` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `Etime_type`
--

CREATE TABLE IF NOT EXISTS `Etime_type` (
  `exercise_type` varchar(20) NOT NULL,
  `exercise_time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `Etime_type_mean`
--

CREATE TABLE IF NOT EXISTS `Etime_type_mean` (
  `exercise_type` varchar(20) NOT NULL,
  `mean` int(11) NOT NULL,
  `max` int(11) NOT NULL,
  `std` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `json_cache`
--

CREATE TABLE IF NOT EXISTS `json_cache` (
  `tweet_id` bigint(20) unsigned NOT NULL,
`cache_id` int(10) unsigned NOT NULL,
  `cache_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `raw_tweet` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `parsed` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `lb_area`
--

CREATE TABLE IF NOT EXISTS `lb_area` (
  `state_name` varchar(20) NOT NULL,
  `screen_name` varchar(50) NOT NULL,
  `tweet_num` int(11) NOT NULL,
  `profile_image_url` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `lb_type`
--

CREATE TABLE IF NOT EXISTS `lb_type` (
  `exercise_type` varchar(20) NOT NULL,
  `screen_name` varchar(50) NOT NULL,
  `tweet_num` int(11) NOT NULL,
  `profile_image_url` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `leaderboard_overall`
--

CREATE TABLE IF NOT EXISTS `leaderboard_overall` (
  `screen_name` varchar(20) NOT NULL,
  `tweet_num` int(40) NOT NULL,
  `profile_image_url` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tweets`
--

CREATE TABLE IF NOT EXISTS `tweets` (
  `tweet_id` bigint(20) unsigned NOT NULL,
  `tweet_text` varchar(160) NOT NULL,
  `entities` text NOT NULL,
  `created_at` datetime NOT NULL,
  `geo_lat` decimal(10,5) DEFAULT NULL,
  `geo_long` decimal(10,5) DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `screen_name` char(20) NOT NULL,
  `name` varchar(40) DEFAULT NULL,
  `profile_image_url` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tweet_mentions`
--

CREATE TABLE IF NOT EXISTS `tweet_mentions` (
  `tweet_id` bigint(20) NOT NULL,
  `source_user_id` bigint(20) NOT NULL,
  `target_user_id` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `tweet_tags`
--

CREATE TABLE IF NOT EXISTS `tweet_tags` (
  `tweet_id` bigint(20) NOT NULL,
  `tag` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tweet_urls`
--

CREATE TABLE IF NOT EXISTS `tweet_urls` (
  `tweet_id` bigint(20) NOT NULL,
  `url` varchar(140) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` bigint(20) unsigned NOT NULL,
  `screen_name` varchar(20) NOT NULL,
  `name` varchar(40) DEFAULT NULL,
  `profile_image_url` varchar(200) DEFAULT NULL,
  `location` varchar(30) DEFAULT NULL,
  `url` varchar(200) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `followers_count` int(10) unsigned DEFAULT NULL,
  `friends_count` int(10) unsigned DEFAULT NULL,
  `statuses_count` int(10) unsigned DEFAULT NULL,
  `time_zone` varchar(40) DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `user_profiles`
--

CREATE TABLE IF NOT EXISTS `user_profiles` (
  `user_name` varchar(20) NOT NULL,
  `tweet_text` varchar(160) NOT NULL,
  `created_at` varchar(50) NOT NULL,
  `profile_image_url` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `EI_area_overall`
--
ALTER TABLE `EI_area_overall`
 ADD UNIQUE KEY `state_name` (`state_name`);

--
-- Indexes for table `EI_time_overall`
--
ALTER TABLE `EI_time_overall`
 ADD UNIQUE KEY `time_node` (`time_node`);

--
-- Indexes for table `EI_time_type`
--
ALTER TABLE `EI_time_type`
 ADD UNIQUE KEY `exercise_type` (`exercise_type`);

--
-- Indexes for table `EI_type_overall`
--
ALTER TABLE `EI_type_overall`
 ADD UNIQUE KEY `exercise_type` (`exercise_type`);

--
-- Indexes for table `json_cache`
--
ALTER TABLE `json_cache`
 ADD PRIMARY KEY (`cache_id`), ADD KEY `tweet_id` (`tweet_id`), ADD KEY `cache_date` (`cache_date`);

--
-- Indexes for table `tweets`
--
ALTER TABLE `tweets`
 ADD PRIMARY KEY (`tweet_id`), ADD KEY `created_at` (`created_at`), ADD KEY `user_id` (`user_id`), ADD KEY `screen_name` (`screen_name`), ADD KEY `name` (`name`), ADD FULLTEXT KEY `tweet_text` (`tweet_text`);

--
-- Indexes for table `tweet_mentions`
--
ALTER TABLE `tweet_mentions`
 ADD KEY `tweet_id` (`tweet_id`), ADD KEY `source` (`source_user_id`), ADD KEY `target` (`target_user_id`);

--
-- Indexes for table `tweet_tags`
--
ALTER TABLE `tweet_tags`
 ADD KEY `tweet_id` (`tweet_id`), ADD KEY `tag` (`tag`);

--
-- Indexes for table `tweet_urls`
--
ALTER TABLE `tweet_urls`
 ADD KEY `tweet_id` (`tweet_id`), ADD KEY `url` (`url`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_id`), ADD KEY `user_name` (`name`), ADD KEY `last_update` (`last_update`), ADD KEY `screen_name` (`screen_name`), ADD FULLTEXT KEY `description` (`description`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `json_cache`
--
ALTER TABLE `json_cache`
MODIFY `cache_id` int(10) unsigned NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
