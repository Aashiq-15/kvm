-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 20, 2024 at 11:12 AM
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
-- Database: `kvm`
--

-- --------------------------------------------------------

--
-- Table structure for table `advertisements`
--

DROP TABLE IF EXISTS `advertisements`;
CREATE TABLE IF NOT EXISTS `advertisements` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `add_date` date DEFAULT NULL,
  `dis_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `advertisements`
--

INSERT INTO `advertisements` (`id`, `title`, `description`, `image`, `status`, `add_date`, `dis_date`) VALUES
(3, 'model shoot', 'University Modal', 'ads-3.jpg', 'inactive', '2024-11-15', '2024-11-19'),
(4, 'Event Modal', 'Music Event', 'ads-4.jpg', 'active', '2024-11-17', NULL),
(5, 'Baby Shoot', 'aakjajsgdagdsya', 'ads-5.jpg', 'active', '2024-11-17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
CREATE TABLE IF NOT EXISTS `bookings` (
  `booking_id` int NOT NULL AUTO_INCREMENT,
  `user` int DEFAULT NULL,
  `booked` date DEFAULT (now()),
  `package` int DEFAULT NULL,
  `place` varchar(300) NOT NULL,
  `event_date` date NOT NULL,
  `event_time` time NOT NULL,
  `note` text,
  `state` enum('booked','confirmed','pending','complete') NOT NULL,
  PRIMARY KEY (`booking_id`),
  UNIQUE KEY `unique_bookings` (`event_date`),
  KEY `user` (`user`),
  KEY `package` (`package`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `feedback_id` int NOT NULL AUTO_INCREMENT,
  `user` int DEFAULT NULL,
  `feed` text NOT NULL,
  `date` date DEFAULT (now()),
  PRIMARY KEY (`feedback_id`),
  KEY `user` (`user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` bigint NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

DROP TABLE IF EXISTS `packages`;
CREATE TABLE IF NOT EXISTS `packages` (
  `package_id` int NOT NULL AUTO_INCREMENT,
  `package_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `hours` int NOT NULL,
  `description` text,
  `point1` varchar(255) DEFAULT NULL,
  `point2` varchar(255) DEFAULT NULL,
  `point3` varchar(255) DEFAULT NULL,
  `point4` varchar(255) DEFAULT NULL,
  `point5` varchar(255) DEFAULT NULL,
  `service1` varchar(255) DEFAULT NULL,
  `service2` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`package_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`package_id`, `package_name`, `price`, `hours`, `description`, `point1`, `point2`, `point3`, `point4`, `point5`, `service1`, `service2`) VALUES
(3, 'Basic Local Package', 5000.00, 1, 'this is our normal package with minimum services', 'Outdoor Photoshoot', '10 Edited Digital Images', 'Online Gallery Access', 'Print Release', 'Complimentary Consultation', '1', '2'),
(4, 'Standard Cultural Package', 10000.00, 2, 'This 2 hour photoshoot both indoor and out door sites', 'Photoshoot in Local indoor or outdoor Site', '20 Edited Digital Images', 'Online Gallery Access', 'Print Release', '1 Physical Print (8x10)', '1', '2'),
(5, 'Premium Wedding Package', 25000.00, 8, 'Include both basic and standard packages features and services', 'Full-Day Coverage ( 8 hours)', '100 Edited Digital Images', 'Online Gallery Access', 'Print Release', 'Custom Photo Album', '1', '2');

-- --------------------------------------------------------

--
-- Table structure for table `portfolio`
--

DROP TABLE IF EXISTS `portfolio`;
CREATE TABLE IF NOT EXISTS `portfolio` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cus_id` int DEFAULT NULL,
  `photography_type` varchar(255) DEFAULT NULL,
  `description` text,
  `date` date DEFAULT NULL,
  `cover_photo` varchar(255) DEFAULT NULL,
  `photo1` varchar(255) DEFAULT NULL,
  `photo2` varchar(255) DEFAULT NULL,
  `photo3` varchar(255) DEFAULT NULL,
  `photo4` varchar(255) DEFAULT NULL,
  `photo5` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cus_id` (`cus_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reply`
--

DROP TABLE IF EXISTS `reply`;
CREATE TABLE IF NOT EXISTS `reply` (
  `id` int NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `message_id` int NOT NULL,
  `add_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `review_id` int NOT NULL AUTO_INCREMENT,
  `user` int DEFAULT NULL,
  `booking` int DEFAULT NULL,
  `review` text NOT NULL,
  `rating` enum('1','2','3','4','5') NOT NULL,
  PRIMARY KEY (`review_id`),
  KEY `user` (`user`),
  KEY `booking` (`booking`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `description`, `image`, `date`) VALUES
(1, 'Event Photography', 'Capture the magic of your events with our event photography service. Whether it\'s a corporate gathering, birthday, or family reunion, we deliver high-quality images that reflect the essence of your celebration.', 'service-1.jpg', '2024-11-17'),
(2, 'Portrait Photography', 'Our portrait photography sessions are tailored to highlight each individual’s personality. With professional lighting and creative direction, we ensure that your portraits are captivating and unique.', 'service-2.jpg', '2024-11-16'),
(4, 'Album Design', 'An album design service in a photography studio involves professionally curating and designing custom photo albums for clients. This service includes selecting the best images, arranging them in a visually appealing layout, and adding personalized touches like backgrounds, text, and design elements. The goal is to create a high-quality, beautifully crafted photo album that captures and preserves special moments, whether from weddings, events, or portrait sessions. The final product serves as a timeless keepsake, showcasing the best of the client\'s photos in a polished, story-driven format.', 'service-4.jpg', '2024-11-17'),
(5, 'Custom Editing', 'A photo editing service in a photography studio offers professional enhancement and retouching of images to achieve the best possible quality. This includes adjusting brightness, contrast, and color balance, removing imperfections, retouching skin, and applying creative effects to enhance the overall look. The service ensures that each photo is polished and ready for print or digital use, helping clients achieve a flawless and professional finish for portraits, events, or commercial photography.', 'service-5.jpg', '2024-11-17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `phone`, `address`, `password`, `role`, `date`) VALUES
(1, 'user1', 'user@gmail.com', '1234567890', NULL, '$2y$10$jHTFbF.zTakKnWBgEeuAAOOPrM9i09f..ZOA1LIXvdMTrZE.ut1jO', 'user', '2024-11-15 15:33:16'),
(2, 'admin', 'admin@gmail.com', '4324324234', 'afasdfasdfasdfadsf', '$2y$10$/YFBjmuM.zJ0kmNrjpA1s.Kv4I2oXuQgN4HwFcmOTSyLgYZyb97Z2', 'admin', '2024-11-15 16:57:07');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
