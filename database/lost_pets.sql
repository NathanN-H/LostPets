-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306:3306
-- Generation Time: May 07, 2024 at 09:40 PM
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
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `user_id`, `question_id`, `answer_text`, `created_at`) VALUES
(35, 1, 23, 'yyryr4', '2024-05-01 12:48:18'),
(34, 1, 24, 'Could take up to 10 days.', '2024-04-29 11:17:00'),
(33, 1, 23, 'Im not sure around the corner.', '2024-04-29 11:16:33');

-- --------------------------------------------------------

--
-- Table structure for table `found_pets`
--

DROP TABLE IF EXISTS `found_pets`;
CREATE TABLE IF NOT EXISTS `found_pets` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `image` varchar(100) NOT NULL,
  `found_pet_nametag` text NOT NULL,
  `found_pet_description` text NOT NULL,
  `address` varchar(255) NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_user_id` (`user_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `found_pets`
--

INSERT INTO `found_pets` (`id`, `user_id`, `image`, `found_pet_nametag`, `found_pet_description`, `address`, `approved`) VALUES
(30, 29, 'pillow.png', 'TEST', 'TEST', '301 rawling road', 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `missing_pets`
--

INSERT INTO `missing_pets` (`id`, `user_id`, `image`, `lost_pet_name`, `lost_pet_age`, `lost_pet_description`, `address`, `approved`) VALUES
(64, 29, 'mug.png', 'test', 31, 'test', '301 Rawling Road', 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `user_id`, `question_text`, `created_at`) VALUES
(24, 1, 'How long does a pet operation take?', '2024-04-29 11:16:49'),
(23, 1, 'Where is a local pet shop?', '2024-04-29 11:16:21');

-- --------------------------------------------------------

--
-- Table structure for table `shop_items`
--

DROP TABLE IF EXISTS `shop_items`;
CREATE TABLE IF NOT EXISTS `shop_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `item_name` varchar(100) NOT NULL,
  `item_description` text NOT NULL,
  `image` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `price` int NOT NULL,
  `stock_quantity` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `shop_items`
--

INSERT INTO `shop_items` (`id`, `item_name`, `item_description`, `image`, `price`, `stock_quantity`, `created_at`) VALUES
(17, 'top', 'for legs', 't-shirt.png', 20000, 1, '2024-05-01 21:22:21'),
(9, 'Mug pug', 'Mug', 'mug.png', 30, 1, '2024-04-24 12:43:09'),
(12, 'mousesesses', 'mouse', 'mouse.png', 2112, 211, '2024-04-24 18:36:19'),
(7, 'long pillow', 'pillow', 'pillow.png', 21, 21, '2024-04-24 12:13:47'),
(19, 'pants', 'pants', 'pants.jfif', 10000, 5, '2024-05-01 21:29:10');

-- --------------------------------------------------------

--
-- Table structure for table `shop_vouchers`
--

DROP TABLE IF EXISTS `shop_vouchers`;
CREATE TABLE IF NOT EXISTS `shop_vouchers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `voucher_name` varchar(100) NOT NULL,
  `voucher_description` text NOT NULL,
  `image` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `price` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `shop_vouchers`
--

INSERT INTO `shop_vouchers` (`id`, `voucher_name`, `voucher_description`, `image`, `price`, `created_at`) VALUES
(20, '£10 gifts', '2123', '10_gift_voucher.png', 123, '2024-04-25 05:42:16'),
(22, '£100 Gifts', 'ifabifba', '100_gift_voucher.png', 1000, '2024-04-26 14:01:27');

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
  `points` int NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Id`, `Username`, `Email`, `Age`, `Password`, `petdescription`, `address`, `points`) VALUES
(34, 'Brian', 'brian@gmail.com', 45, '$2y$10$LEcZAo5PYX2a2p0yxFxeRu.iOthWwi1NLYjWSKUk34GPb..leYOTO', NULL, '', 130),
(29, 'admin', 'admin1234@gmail.com', 12, '$2y$10$OJGhqYqKNEz4gKUqNmpgVecLMPP3MQ7qvkYWs1Mcp1KibVVU/3TPW', 'adaf ga gsa', 'Saltwell, Gateshead NE8 4SH', 4985684),
(40, 'nathan', 'nathanhearne@gmail.com', 212, '$2y$10$/Za3R2sn6HvtlfUlnVNFzeYr1dWjmcQ1YT.uS5Ay0k90D4MRG0Bjm', 'I love dogs and cats', '301 rawling road', 50);

-- --------------------------------------------------------

--
-- Table structure for table `user_items`
--

DROP TABLE IF EXISTS `user_items`;
CREATE TABLE IF NOT EXISTS `user_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `item_id` int DEFAULT NULL,
  `purchase_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `fk_voucher_id_shop_vouchers` (`item_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_items`
--

INSERT INTO `user_items` (`id`, `user_id`, `item_id`, `purchase_date`, `approved`) VALUES
(1, 34, 9, '2024-04-25 20:50:16', 1),
(2, 29, 12, '2024-04-25 20:54:26', 1),
(3, 29, 20, '2024-04-25 21:57:50', 1),
(4, 36, 20, '2024-04-26 13:30:19', 0),
(5, 29, 7, '2024-04-26 13:43:58', 0),
(6, 29, 22, '2024-04-26 14:01:42', 0),
(7, 29, 9, '2024-05-01 12:38:27', 0),
(8, 29, 9, '2024-05-01 12:39:59', 1),
(9, 29, 22, '2024-05-01 15:56:40', 0),
(10, 39, 12, '2024-05-01 21:12:15', 0),
(11, 29, 19, '2024-05-07 16:32:25', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
