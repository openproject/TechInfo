--
-- 初始化数据库
-- 建立数据库TechInfo，主要包括config和feed两个表。
--

--
-- Create database `TechInfo`
--
CREATE DATABASE  IF NOT EXISTS `TechInfo`;
USE TechInfo;

--
-- Create table `config`
-- key-value
--
CREATE TABLE `config` (
  `name` varchar(50) NOT NULL PRIMARY KEY,
  `val` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Create table `config`
-- feed list
--
CREATE TABLE `feed` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `summary` varchar(500) DEFAULT NULL,
  `time` varchar(100) DEFAULT NULL,
  `link` varchar(500) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `tag` varchar(500) DEFAULT NULL,
  `source` varchar(50) DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `feed_id_uindex` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3102 DEFAULT CHARSET=utf8;
