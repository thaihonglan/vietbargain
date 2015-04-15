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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table vietbargain.admin: ~2 rows (approximately)
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`id`, `username`, `password`, `first_name`, `last_name`, `has_admin_authority`, `has_user_authority`, `has_deal_authority`, `has_dashboard_authority`) VALUES
	(1, 'admin', '$2y$13$KTqhc.5OzIMHVCF8rbyMRu6GuOdBf5EIDXrgl/GPMekdfLzh6roFe', 'Admin', 'Admin', 1, 1, 1, 1),
	(2, 'kiet_minh', '$2y$13$cVaiEqwMVGIggQxiV1FCBOrvMGiDLn2hUr/zF1bX4fcQuKZHOv7hm', 'Phan The', 'Kiet Minh', 1, 0, 1, 1);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;


-- Dumping structure for table vietbargain.city
CREATE TABLE IF NOT EXISTS `city` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` tinyint(3) unsigned DEFAULT '0',
  `zip` int(7) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table vietbargain.city: ~63 rows (approximately)
/*!40000 ALTER TABLE `city` DISABLE KEYS */;
INSERT INTO `city` (`id`, `name`, `code`, `zip`) VALUES
	(1, 'An Giang', 89, 94000),
	(2, 'Bà Rịa Vũng Tàu', 74, 74000),
	(3, 'Bắc Giang', 24, 99000),
	(4, 'Bắc Kạn', 6, 17000),
	(5, 'Bạc Liêu', 95, 21000),
	(6, 'Bắc Ninh', 27, 16000),
	(7, 'Bến Tre', 83, 83000),
	(8, 'Bình Định', 52, 72000),
	(9, 'Bình Dương', 74, 53000),
	(10, 'Bình Phước', 70, 77000),
	(11, 'Bình Thuận', 60, 62000),
	(12, 'Cà Mau', 96, 96000),
	(13, 'Cần Thơ -', 92, 92000),
	(14, 'Cao Bằng', 4, 22000),
	(15, 'Đắc Nông ', 67, 55000),
	(16, 'ĐắkLắk', 66, 55000),
	(17, 'Điện Biên', 11, 28000),
	(18, 'Đồng Nai', 75, 71000),
	(19, 'Đồng Tháp', 87, 93000),
	(20, 'Gia Lai', 64, 54000),
	(21, 'Hà Giang', 2, 29000),
	(22, 'Hà Nam', 35, 30000),
	(23, 'Hà Tĩnh', 42, 43000),
	(24, 'Hải Dương', 30, 34000),
	(25, 'Hậu Giang', 93, 92000),
	(26, 'Hoà Bình', 17, 13000),
	(27, 'Hưng Yên', 33, 39000),
	(28, 'Khánh Hoà', 56, 57000),
	(29, 'Kiên Giang', 91, 95000),
	(30, 'Kon Tum', 62, 58000),
	(31, 'Lai Châu', 12, 28000),
	(32, 'Lâm Đồng', 68, 61000),
	(33, 'Lạng Sơn', 20, 20000),
	(34, 'Lao Cai', 10, 19000),
	(35, 'Long An', 80, 81000),
	(36, 'Nam Định', 36, 32000),
	(37, 'Nghệ An', 40, 42000),
	(38, 'Ninh Bình', 37, 40000),
	(39, 'Ninh Thuận', 58, 63000),
	(40, 'Phú Thọ', 25, 24000),
	(41, 'Phú Yên', 54, 56000),
	(42, 'Quảng Bình', 44, 45000),
	(43, 'Quảng Nam', 49, 51000),
	(44, 'Quảng Ngãi', 51, 52000),
	(45, 'Quảng Ninh', 22, 36000),
	(46, 'Quảng Trị', 45, 46000),
	(47, 'Sóc Trăng', 94, 97000),
	(48, 'Sơn La', 14, 27000),
	(49, 'Tây Ninh', 72, 73000),
	(50, 'Thái Bình', 34, 33000),
	(51, 'Thái Nguyên', 19, 23000),
	(52, 'Thanh Hoá', 38, 41000),
	(53, 'Thừa Thiên Huế', 46, 47000),
	(54, 'Tiền Giang', 82, 82000),
	(55, 'TP. Đà Nẵng', 48, 59000),
	(56, 'TP. Hà Nội', 1, 10000),
	(57, 'TP. Hải Phòng', 31, 35000),
	(58, 'TP. Hồ Chí Minh', 79, 70000),
	(59, 'Trà Vinh', 84, 90000),
	(60, 'Tuyên Quang', 8, 25000),
	(61, 'Vĩnh Long', 86, 91000),
	(62, 'Vĩnh Phúc', 26, 11000),
	(63, 'Yên Bái', 15, 26000);
/*!40000 ALTER TABLE `city` ENABLE KEYS */;


-- Dumping structure for table vietbargain.comment
CREATE TABLE IF NOT EXISTS `comment` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `content` text,
  `user_id` int(10) unsigned DEFAULT NULL,
  `post_id` bigint(20) unsigned DEFAULT NULL,
  `parent_id` bigint(20) unsigned DEFAULT NULL,
  `create_datetime` datetime DEFAULT NULL,
  `is_approved` tinyint(1) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table vietbargain.comment: ~3 rows (approximately)
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` (`id`, `content`, `user_id`, `post_id`, `parent_id`, `create_datetime`, `is_approved`) VALUES
	(1, 'fefewfwe', 5, 3, NULL, '2015-01-17 05:12:22', 1),
	(2, 'adasdsa', 5, 3, NULL, '2015-01-17 05:43:37', 1),
	(3, 'adasdsadasdas', 5, 3, NULL, '2015-01-17 05:43:43', 1);
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;


-- Dumping structure for table vietbargain.deal_type
CREATE TABLE IF NOT EXISTS `deal_type` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name_vi` varchar(64) DEFAULT NULL,
  `name_en` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table vietbargain.deal_type: ~5 rows (approximately)
/*!40000 ALTER TABLE `deal_type` DISABLE KEYS */;
INSERT INTO `deal_type` (`id`, `name_vi`, `name_en`) VALUES
	(1, 'Miễn Phí', 'Free'),
	(2, 'Giảm Giá', 'Discount'),
	(3, 'Hàng Dùng Thử', 'Trial product'),
	(4, 'Đại Hạ Giá', 'Big sale'),
	(5, 'Khai Trương', 'New open');
/*!40000 ALTER TABLE `deal_type` ENABLE KEYS */;


-- Dumping structure for table vietbargain.dislike
CREATE TABLE IF NOT EXISTS `dislike` (
  `post_id` bigint(20) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `comment_id` bigint(20) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table vietbargain.dislike: ~0 rows (approximately)
/*!40000 ALTER TABLE `dislike` DISABLE KEYS */;
/*!40000 ALTER TABLE `dislike` ENABLE KEYS */;


-- Dumping structure for table vietbargain.like
CREATE TABLE IF NOT EXISTS `like` (
  `post_id` bigint(20) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table vietbargain.like: ~0 rows (approximately)
/*!40000 ALTER TABLE `like` DISABLE KEYS */;
/*!40000 ALTER TABLE `like` ENABLE KEYS */;


-- Dumping structure for table vietbargain.post
CREATE TABLE IF NOT EXISTS `post` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(32) DEFAULT NULL,
  `content` text,
  `short_content` varchar(512) DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT '0' COMMENT 'User who post this',
  `contact_number` varchar(32) DEFAULT NULL,
  `store_address` varchar(128) DEFAULT NULL,
  `link` varchar(64) DEFAULT NULL,
  `discount_code` varchar(32) DEFAULT NULL,
  `is_owner` tinyint(3) unsigned DEFAULT '0' COMMENT 'Whether user is the deal owner',
  `image` varchar(64) DEFAULT NULL,
  `deal_type_id` mediumint(9) DEFAULT '0',
  `like_number` int(11) DEFAULT '0',
  `dislike_number` int(11) DEFAULT '0',
  `comment_number` int(11) DEFAULT '0',
  `view_number` int(11) DEFAULT '0',
  `deal_begin_date` date DEFAULT NULL,
  `deal_end_date` date DEFAULT NULL,
  `create_datetime` datetime DEFAULT NULL,
  `modify_datetime` datetime DEFAULT NULL,
  `status` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `deal_type_id` (`deal_type_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Dumping data for table vietbargain.post: ~6 rows (approximately)
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` (`id`, `title`, `content`, `short_content`, `user_id`, `contact_number`, `store_address`, `link`, `discount_code`, `is_owner`, `image`, `deal_type_id`, `like_number`, `dislike_number`, `comment_number`, `view_number`, `deal_begin_date`, `deal_end_date`, `create_datetime`, `modify_datetime`, `status`) VALUES
	(3, 'New topic', 'New content', 'Today, we\'re looking at three particularly interesting stories. Pinterest added a new location-based feature on Wednesday that uses Place Pins as a way to map out vacations and favorite areas. Southwest Airlines is providing Wi-Fi access from gate to gate for $8 per day through an onboard hotspot. And in an effort to ramp up its user base, Google Wallet is offering a debit card that can take out cash from.', 4, NULL, NULL, NULL, 'sadwqdwq', 0, NULL, 2, 0, 0, 0, 218, '2014-12-26', '2014-12-26', '2014-12-25 15:55:25', NULL, 0),
	(4, 'New topic 2', '<p>AADASDW</p>', 'Today, we\'re looking at three particularly interesting stories. Pinterest added a new location-based feature on Wednesday that uses Place Pins as a way to map out vacations and favorite areas. Southwest Airlines is providing Wi-Fi access from gate to gate for $8 per day through an onboard hotspot. And in an effort to ramp up its user base, Google Wallet is offering a debit card that can take out cash from.', 4, NULL, NULL, NULL, 'ASDSADSA', 0, '', 2, 0, 0, 0, 5, '2014-12-16', '2014-12-31', '2014-12-25 15:55:25', '2015-04-15 15:31:20', 1),
	(6, 'New topic 1223asd', 'cascsavasdvsdvvds', 'Today, we\'re looking at three particularly interesting stories. Pinterest added a new location-based feature on Wednesday that uses Place Pins as a way to map out vacations and favorite areas. Southwest Airlines is providing Wi-Fi access from gate to gate for $8 per day through an onboard hotspot. And in an effort to ramp up its user base, Google Wallet is offering a debit card that can take out cash from.', 4, NULL, NULL, NULL, 'ALLO', 1, 'FHWDPW2kScvUZhh7WsLhSXsgmcekJNZ5.jpg', 1, 0, 0, 0, 2, '2014-12-25', '2014-12-31', '2014-12-25 15:55:25', NULL, 0),
	(7, 'Mama mia', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>What the hell is it</p>\r\n</body>\r\n</html>', 'This is a short content', 4, NULL, NULL, NULL, 'ADSADSA', 0, 'gkaQVIk8TYhXLHTo3W0pQOBgWWlrqHIm.jpg', 2, 0, 0, 0, 2, '2015-01-14', '2015-01-30', '2015-01-10 16:04:44', NULL, 0),
	(8, 'Boi loi topic 5678', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>New content</p>\r\n<p>tehis is a new teop</p>\r\n</body>\r\n</html>', 'Today, we\'re looking at three particularly interesting stories. Pinterest added a new location-based feature on Wednesday that uses Place Pins as a way to map out vacations and favorite areas. Southwest Airlines is providing Wi-Fi access from gate to gate for $8 per day through an onboard hotspot. And in an effort to ramp up its user base, Google Wallet is offering a debit card that can take out cash from.', 4, NULL, NULL, NULL, 'sadwqdwq', 0, NULL, 2, 0, 0, 0, 3, '2015-03-01', '2014-12-26', '2015-03-01 08:01:09', '2015-03-01 08:19:15', 0),
	(9, 'Boi loi topic 123', '<p>New content</p>\r\n<p>tehis is a new teop</p>', 'Today, we\'re looking at three particularly interesting stories. Pinterest added a new location-based feature on Wednesday that uses Place Pins as a way to map out vacations and favorite areas. Southwest Airlines is providing Wi-Fi access from gate to gate for $8 per day through an onboard hotspot. And in an effort to ramp up its user base, Google Wallet is offering a debit card that can take out cash from.', 4, NULL, NULL, NULL, 'sadwqdwq', 0, NULL, 2, 0, 0, 0, 0, '2015-03-01', '2014-12-26', '2015-03-01 08:07:51', '2015-04-15 15:29:05', 1);
/*!40000 ALTER TABLE `post` ENABLE KEYS */;


-- Dumping structure for table vietbargain.post_type
CREATE TABLE IF NOT EXISTS `post_type` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name_vi` varchar(64) DEFAULT NULL,
  `name_en` varchar(64) DEFAULT NULL,
  `is_parent` tinyint(3) unsigned DEFAULT '0',
  `parent_id` mediumint(8) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Dumping data for table vietbargain.post_type: ~6 rows (approximately)
/*!40000 ALTER TABLE `post_type` DISABLE KEYS */;
INSERT INTO `post_type` (`id`, `name_vi`, `name_en`, `is_parent`, `parent_id`) VALUES
	(1, 'Du lich', 'Tour', 1, 0),
	(2, 'Ngoai nuoc', 'Other coutry', 0, 1),
	(5, 'Trong nuoc', 'In country', 1, 1),
	(6, 'Hang hoa', 'Goods', 0, 0),
	(7, 'Boi loi', 'Swimming', 0, 5),
	(8, 'Heo', 'Hello', 0, 0);
/*!40000 ALTER TABLE `post_type` ENABLE KEYS */;


-- Dumping structure for table vietbargain.post_type_allocation
CREATE TABLE IF NOT EXISTS `post_type_allocation` (
  `post_id` bigint(20) unsigned NOT NULL,
  `post_type_id` mediumint(8) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table vietbargain.post_type_allocation: ~7 rows (approximately)
/*!40000 ALTER TABLE `post_type_allocation` DISABLE KEYS */;
INSERT INTO `post_type_allocation` (`post_id`, `post_type_id`) VALUES
	(3, 7),
	(4, 7),
	(6, 7),
	(7, 7),
	(8, 7),
	(9, 7),
	(8, 7);
/*!40000 ALTER TABLE `post_type_allocation` ENABLE KEYS */;


-- Dumping structure for table vietbargain.request
CREATE TABLE IF NOT EXISTS `request` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT '0',
  `request_type` tinyint(3) unsigned DEFAULT '0',
  `request_key` varchar(50) DEFAULT '',
  `data` varchar(256) DEFAULT NULL,
  `status` tinyint(3) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table vietbargain.request: ~4 rows (approximately)
/*!40000 ALTER TABLE `request` DISABLE KEYS */;
INSERT INTO `request` (`id`, `user_id`, `request_type`, `request_key`, `data`, `status`) VALUES
	(3, 4, 1, 'YWpXjZFKZE-z9HVrm4yMKuqgopADi7k6', NULL, 1),
	(4, 4, 3, 'zAQfT4cl3SbvZzNTYssfdzrUnqOn7eXX', '{"email":"4rest.wind@gmail.com"}', 1),
	(5, 5, 1, 'Vpc0qFE3kXywWx7qI6dar8xyPpH44ykP', NULL, 1),
	(6, 6, 1, 'B7-Ps0ybSA7vr818iePBNajnZU7j_5-V', NULL, 1);
/*!40000 ALTER TABLE `request` ENABLE KEYS */;


-- Dumping structure for table vietbargain.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` mediumint(9) DEFAULT '0',
  `email` varchar(32) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  `facebook_login_id` varchar(32) DEFAULT NULL,
  `first_name` varchar(32) DEFAULT NULL,
  `last_name` varchar(32) DEFAULT NULL,
  `identifier` varchar(32) DEFAULT NULL,
  `city_id` mediumint(8) unsigned DEFAULT '0',
  `address` varchar(45) DEFAULT NULL,
  `age` smallint(5) unsigned DEFAULT NULL,
  `contact_number` varchar(32) DEFAULT NULL,
  `avatar` varchar(64) DEFAULT NULL,
  `is_comment_unlimited` tinyint(1) unsigned DEFAULT '0' COMMENT 'Set true to comment with no limit',
  `create_datetime` datetime DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table vietbargain.user: ~3 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `type`, `email`, `password`, `facebook_login_id`, `first_name`, `last_name`, `identifier`, `city_id`, `address`, `age`, `contact_number`, `avatar`, `is_comment_unlimited`, `create_datetime`, `status`) VALUES
	(4, 1, '4rest.wind@gmail.com', '$2y$13$h33yCJaDt3rcO75qOMLQ4eVf.TKuqk13Rl.79OrDj.kq1/8aJ4gGm', NULL, 'Minh ne aaa', 'Phan The', 'c12231456', 52, NULL, 32, '839012730921', 'le89cFRDoSOYwUwhgN5oyky1c6OUAZvj.jpg', 1, NULL, 1),
	(5, 1, 'thaihonglan@gmail.com', '$2y$13$h33yCJaDt3rcO75qOMLQ4eVf.TKuqk13Rl.79OrDj.kq1/8aJ4gGm', NULL, 'Thai Hong', 'Lan', NULL, 8, NULL, NULL, NULL, 'avatar.jpg', 1, '2015-01-11 08:56:53', 1),
	(6, 1, 'lajiyoujian83@gmail.com', '$2y$13$UaTrlla3rYYmUZjZAU8RCOPGo5mXh2uwXzHOc.NkevDC6OWuZBAx.', NULL, 'You Jian', 'La Ji', NULL, 58, NULL, NULL, NULL, 'avatar.jpg', 0, '2015-03-01 08:40:07', 1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
