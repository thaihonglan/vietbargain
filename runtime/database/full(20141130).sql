-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.12-log - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             8.1.0.4545
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table vietbargain.admin
DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  `first_name` varchar(32) DEFAULT NULL,
  `last_name` varchar(32) DEFAULT NULL,
  `has_admin_authority` tinyint(3) unsigned DEFAULT '0',
  `has_user_authority` tinyint(3) unsigned DEFAULT '0',
  `has_deal_authority` tinyint(3) unsigned DEFAULT '0',
  `has_dashboard_authority` tinyint(3) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table vietbargain.city
DROP TABLE IF EXISTS `city`;
CREATE TABLE IF NOT EXISTS `city` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` tinyint(3) unsigned DEFAULT '0',
  `zip` int(7) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.


-- Dumping structure for table vietbargain.comment
DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `content` text,
  `user_id` int(10) unsigned DEFAULT NULL,
  `post_id` bigint(20) unsigned DEFAULT NULL,
  `parent_id` bigint(20) unsigned DEFAULT NULL,
  `create_datetime` datetime DEFAULT NULL,
  `is_approved` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table vietbargain.deal_type
DROP TABLE IF EXISTS `deal_type`;
CREATE TABLE IF NOT EXISTS `deal_type` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name_vi` varchar(64) DEFAULT NULL,
  `name_en` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table vietbargain.dislike
DROP TABLE IF EXISTS `dislike`;
CREATE TABLE IF NOT EXISTS `dislike` (
  `post_id` bigint(20) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `comment_id` bigint(20) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table vietbargain.like
DROP TABLE IF EXISTS `like`;
CREATE TABLE IF NOT EXISTS `like` (
  `post_id` bigint(20) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table vietbargain.post
DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(32) DEFAULT NULL,
  `content` text,
  `user_id` int(10) unsigned DEFAULT '0' COMMENT 'User who post this',
  `contact_number` varchar(32) DEFAULT NULL,
  `store_address` varchar(128) DEFAULT NULL,
  `link` varchar(64) DEFAULT NULL,
  `discount_code` varchar(32) DEFAULT NULL,
  `is_owner` tinyint(3) unsigned DEFAULT '0' COMMENT 'Whether user is the deal owner',
  `image` varchar(64) DEFAULT NULL,
  `deal_type` smallint(6) DEFAULT '0',
  `deal_begin_date` datetime DEFAULT NULL,
  `deal_end_date` datetime DEFAULT NULL,
  `status` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table vietbargain.post_type
DROP TABLE IF EXISTS `post_type`;
CREATE TABLE IF NOT EXISTS `post_type` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name_vi` varchar(64) DEFAULT NULL,
  `name_en` varchar(64) DEFAULT NULL,
  `is_parent` tinyint(3) unsigned DEFAULT '0',
  `parent_id` mediumint(8) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table vietbargain.post_type_allocation
DROP TABLE IF EXISTS `post_type_allocation`;
CREATE TABLE IF NOT EXISTS `post_type_allocation` (
  `post_id` bigint(20) unsigned NOT NULL,
  `post_type_id` mediumint(8) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table vietbargain.request
DROP TABLE IF EXISTS `request`;
CREATE TABLE IF NOT EXISTS `request` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `request_type` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `request_key` char(32) NOT NULL DEFAULT '',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table vietbargain.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(32) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  `facebook_login_id` varchar(32) DEFAULT NULL,
  `first_name` varchar(32) DEFAULT NULL,
  `last_name` varchar(32) DEFAULT NULL,
  `identifier` varchar(32) DEFAULT NULL,
  `city_id` mediumint(8) unsigned DEFAULT '0',
  `address` varchar(45) DEFAULT NULL,
  `age` smallint(5) unsigned DEFAULT NULL,
  `contact_number` varchar(32) NOT NULL,
  `avatar` varchar(64) DEFAULT NULL,
  `is_unlimited_user` tinyint(3) unsigned DEFAULT '0' COMMENT 'Set true to post with no time limitation',
  `create_datetime` datetime DEFAULT NULL,
  `status` tinyint(3) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
