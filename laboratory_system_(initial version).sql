-- Adminer 4.8.1 MySQL 8.0.32 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` smallint unsigned NOT NULL AUTO_INCREMENT,
  `username` char(50) NOT NULL,
  `password` char(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1,	'batman',	'batman'),
(2,	'batman99',	'batman99');

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
(5,	'civil',	'โรงงานไม้',	'เครื่องตัดไม้',	2,	'จอห์น ชาวไร่',	'-');

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
(3,	'computer',	'ห้องปฏิบัติการเซิฟเวอร์',	'เครื่องคอมพิวเตอร์เซิฟเวอร์สำหรับการเรียน',	5,	'โดบิตะ',	'-');

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
(3,	'electrical',	'ห้องปฏิบัติการไฟฟ้า',	'เครื่องมือวัดไฟฟ้าแรงสูง (High Voltage)',	2,	'ปาโต้เยา',	'-');

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
(3,	'industrial',	'โรงกลึง',	'เครื่องกลึง',	8,	'จอห์น สโนว์',	'-');

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
(3,	'mechanical',	'โรงงานเครื่องกล',	'เครื่องทดสอบแรงดันเครื่องยนต์',	1,	'เชฟหมี',	'-');

-- 2023-02-22 06:14:22
