-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306:3306
-- Generation Time: Apr 22, 2024 at 12:06 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lost_pets`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

DROP TABLE IF EXISTS `answers`;
CREATE TABLE IF NOT EXISTS `answers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `question_id` int DEFAULT NULL,
  `answer_text` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `question_id` (`question_id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `user_id`, `question_id`, `answer_text`, `created_at`) VALUES
(25, 1, 18, 'adna', '2024-04-19 14:13:45'),
(24, 1, 14, 'maybe', '2024-04-19 14:05:43'),
(21, 1, 13, 'no', '2024-04-19 14:02:10'),
(22, 1, 14, 'yes', '2024-04-19 14:05:31'),
(23, 1, 14, 'no', '2024-04-19 14:05:37');

-- --------------------------------------------------------

--
-- Table structure for table `found_pets`
--

DROP TABLE IF EXISTS `found_pets`;
CREATE TABLE IF NOT EXISTS `found_pets` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `image` varchar(100) NOT NULL,
  `found_pet_nametag` text NOT NULL,
  `found_pet_description` text NOT NULL,
  `address` varchar(255) NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `fk_user_id` (`user_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `missing_pets`
--

DROP TABLE IF EXISTS `missing_pets`;
CREATE TABLE IF NOT EXISTS `missing_pets` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `image` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `lost_pet_name` text NOT NULL,
  `lost_pet_age` int NOT NULL,
  `lost_pet_description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `address` varchar(255) NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_user_id` (`user_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `missing_pets`
--

INSERT INTO `missing_pets` (`id`, `user_id`, `image`, `lost_pet_name`, `lost_pet_age`, `lost_pet_description`, `address`, `approved`) VALUES
(50, 0, 'dogcheck.png', 'gd', 123, 'frfsfs', '301 Rawling Road', 0),
(51, 0, 'dogcheck.png', 'gdgd', 232, 'gsdgd', 'Gateshead', 0);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `question_text` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `user_id`, `question_text`, `created_at`) VALUES
(18, 1, 'is this real?', '2024-04-19 14:13:02'),
(14, 1, 'is this a question?', '2024-04-19 14:05:26');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Username` varchar(200) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Age` int DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `petdescription` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `address` varchar(255) NOT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT '0',
  `verification_code` varchar(255) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Id`, `Username`, `Email`, `Age`, `Password`, `petdescription`, `address`, `is_verified`, `verification_code`) VALUES
(31, 'nathan', 'nordstromhearne@gmail.com', 21, '$2y$10$1ZWyPjG4OOS24WYr7eMRAO4Ccuz3KHV4rvTtg336umtHsStkB88Ja', NULL, '', 0, ''),
(29, 'admin', 'admin1234@gmail.com', 12, '$2y$10$OJGhqYqKNEz4gKUqNmpgVecLMPP3MQ7qvkYWs1Mcp1KibVVU/3TPW', 'adaf ga gsa', 'Saltwell, Gateshead NE8 4SH', 0, ''),
(33, 'pet', 'pet@gmail.com', 21, '$2y$10$99LTZWimQKyYTcR/MK1v..A6waHUhe6nzI2UJ2NWRRxd6I87nlSJe', NULL, '', 0, '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
