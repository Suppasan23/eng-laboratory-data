-- Adminer 4.8.1 MySQL 8.0.32 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

CREATE DATABASE `laboratory_system` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `laboratory_system`;

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` smallint unsigned NOT NULL AUTO_INCREMENT,
  `username` char(50) NOT NULL,
  `password` char(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1,	'batman',	'batman');

DROP TABLE IF EXISTS `civil`;
CREATE TABLE `civil` (
  `id` smallint unsigned NOT NULL AUTO_INCREMENT,
  `branch` varchar(50) NOT NULL,
  `room` varchar(50) NOT NULL,
  `instrument` varchar(100) NOT NULL,
  `quantity` int NOT NULL,
  `caretaker` varchar(50) NOT NULL,
  `image` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `civil` (`id`, `branch`, `room`, `instrument`, `quantity`, `caretaker`, `image`) VALUES
(1,	'วิศวกรรมโยธา',	'27102',	'เครื่องดึงเหล็ก',	1,	'จอห์น ชาวไร่',	'');

DROP TABLE IF EXISTS `computer`;
CREATE TABLE `computer` (
  `id` smallint unsigned NOT NULL AUTO_INCREMENT,
  `branch` varchar(50) NOT NULL,
  `room` varchar(50) NOT NULL,
  `instrument` varchar(100) NOT NULL,
  `quantity` int NOT NULL,
  `caretaker` varchar(50) NOT NULL,
  `image` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `computer` (`id`, `branch`, `room`, `instrument`, `quantity`, `caretaker`, `image`) VALUES
(1,	'วิศวกรรมคอมพิวเตอร์',	'65872',	'เครื่องกู้ข้อมูลฮาร์ดดิส',	1,	'เชฟหมี',	'');

DROP TABLE IF EXISTS `electrical`;
CREATE TABLE `electrical` (
  `id` smallint unsigned NOT NULL AUTO_INCREMENT,
  `branch` varchar(50) NOT NULL,
  `room` varchar(50) NOT NULL,
  `instrument` varchar(100) NOT NULL,
  `quantity` int NOT NULL,
  `caretaker` varchar(50) NOT NULL,
  `image` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `electrical` (`id`, `branch`, `room`, `instrument`, `quantity`, `caretaker`, `image`) VALUES
(1,	'วิศวกรรมไฟฟ้า',	'16589',	'เครื่องวัดกระแสไฟฟ้าแรงสูง',	1,	'โดบิตะ',	'');

DROP TABLE IF EXISTS `industrial`;
CREATE TABLE `industrial` (
  `id` smallint unsigned NOT NULL AUTO_INCREMENT,
  `branch` varchar(50) NOT NULL,
  `room` varchar(50) NOT NULL,
  `instrument` varchar(100) NOT NULL,
  `quantity` int NOT NULL,
  `caretaker` varchar(50) NOT NULL,
  `image` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `industrial` (`id`, `branch`, `room`, `instrument`, `quantity`, `caretaker`, `image`) VALUES
(1,	'วิศวกรรมอุตสาหการ',	'8546',	'เครื่องตัดเลเซอร์',	3,	'ปาโต้เยา',	'');

DROP TABLE IF EXISTS `mechanical`;
CREATE TABLE `mechanical` (
  `id` smallint unsigned NOT NULL AUTO_INCREMENT,
  `branch` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `room` varchar(50) NOT NULL,
  `instrument` varchar(100) NOT NULL,
  `quantity` int NOT NULL,
  `caretaker` varchar(50) NOT NULL,
  `image` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `mechanical` (`id`, `branch`, `room`, `instrument`, `quantity`, `caretaker`, `image`) VALUES
(1,	'วิศวกรรมเครื่องกล',	'12548',	'เครื่องทำความเย็น',	3,	'นายสามชาย พายเรือ',	'');

-- 2023-02-21 10:34:25
