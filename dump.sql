-- Adminer 4.8.4 MySQL 5.6.47 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP DATABASE IF EXISTS `menu`;
CREATE DATABASE `menu` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `menu`;

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `parent_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `categories` (`id`, `title`, `parent_id`) VALUES
(1,	'Category 1',	0),
(2,	'Category 2',	0),
(3,	'Category 3',	0),
(4,	'Category 2.1',	2),
(5,	'Category 2.2',	2),
(6,	'Category 2.1.1',	4),
(7,	'Category 2.1.2',	4);

-- 2024-10-28 21:20:18
