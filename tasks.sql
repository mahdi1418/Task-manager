-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 25, 2025 at 10:10 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tasks`
--

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

DROP TABLE IF EXISTS `task`;
CREATE TABLE IF NOT EXISTS `task` (
  `task_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` text COLLATE utf8mb4_general_ci,
  `status` tinyint(1) NOT NULL,
  `option` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`task_id`)
) ENGINE=MyISAM AUTO_INCREMENT=124 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`task_id`, `title`, `status`, `option`, `user_id`) VALUES
(123, 'fjjekrfhjerukefjkdsfnkdjksdnfjksdkdjfkddddddddddddddddddddddddddddddddddffffffffffffffffffffffffffffffffffffffffkkkkkkkkkkkkkkkkkkkkkk', 0, 'high', 22),
(120, 'cddsds', 0, 'high', 22),
(121, 'cddsds', 0, 'high', 22),
(118, 'cddsds', 0, 'high', 22),
(119, 'cddsds', 0, 'high', 22),
(116, 'sdaaawd', 0, 'low', 22),
(117, 'cddsds', 0, 'high', 22),
(114, 'sdas', 0, 'high', 21),
(113, 'aswdwdww', 0, 'high', 21),
(109, 'edwqdqwed', 0, 'high', 1),
(110, 'wdqwqw', 0, 'high', 1),
(108, 'edwedwqa', 0, 'high', 1),
(104, 'asd', 0, 'high', 1),
(105, 'w', 0, 'high', 1),
(106, 'ww', 0, 'high', 1),
(107, 'ww', 0, 'high', 1),
(93, 'sdadawwxcn,mxnczxmxxzc mz mz z', 0, 'medium', 1),
(115, 'sdaaawd', 0, 'low', 22),
(90, 'sdflksdflefdea\r\nsbxshjxhjs\r\nxcnzxnsn ns\r\nsncbsxbsjx\r\nsnxsbhsbxhshbx\r\nxdsnxcnscbbjsz\r\ncmncx\r\na\r\ns\r\ns\r\nd\r\nf\r\nff\r\nf\r\n', 0, 'high', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` text COLLATE utf8mb4_general_ci,
  `file` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'file_1749260932.png',
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `file`, `create_date`) VALUES
(1, 'mahdi', 'mahdi@gmail.com', 'aa42d63db491f7281c888436463ae261', '', '2025-06-13 21:01:32'),
(7, 'mahdi', 'mahdi@gmail.com', 'aa42d63db491f7281c888436463ae261', '', '2025-06-13 21:03:51'),
(8, 'ali', 'ali@gmail.com', '3ea6277babd0570c650fca3d17ec4bc5', '', '2025-06-13 21:12:08'),
(22, 'akbar', 'akbar@gmail.com', '4f033a0a2bf2fe0b68800a3079545cd1', 'file_1750885801.png', '2025-06-25 13:40:49'),
(10, 'mohsen', 'moh@gmail.com', '62f2596b743b732c244ca5451a334b4f', '', '2025-06-14 00:40:21'),
(11, 'javad', 'mrj@gmail.com', 'fd2cc6c54239c40495a0d3a93b6380eb', '', '2025-06-14 00:54:23'),
(13, 'saeed', 'st@gmail.com', '849e060f05808577361b084ba1e3eca7', '', '2025-06-14 12:25:55'),
(14, 'amir', 'amir@gmail.com', '63eefbd45d89e8c91f24b609f7539942', '', '2025-06-14 12:35:07'),
(16, 'ehsan', 'es@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '', '2025-06-14 13:02:33'),
(17, 'mrj', 'j@gmail.com', 'f3609badce37435ec0fed38895890c58', '', '2025-06-14 13:31:08'),
(18, 'sajad', 's@gmail.com', '912ec803b2ce49e4a541068d495ab570', '', '2025-06-14 13:40:53'),
(20, 'sobhan', 'sob@gmail.com', '6ca29d9bb530402bd09fe026ee838148', '', '2025-06-14 17:09:24'),
(21, 'reza', 'rz@gmail.com', 'bb98b1d0b523d5e783f931550d7702b6', 'file_1750883976.png', '2025-06-25 12:26:06');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
