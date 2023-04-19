-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2023 at 12:20 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_mvc`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(60) NOT NULL,
  `content` text NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `user_id`, `created_at`) VALUES
(126, 'VCC', 'VCVCCV', 13, '2023-04-19 15:18:11'),
(127, 'title0', 'this is comtnet', 13, '2023-04-19 15:18:39'),
(128, 'title1', 'this is comtnet', 13, '2023-04-19 15:18:39'),
(129, 'title2', 'this is comtnet', 13, '2023-04-19 15:18:39'),
(130, 'title3', 'this is comtnet', 13, '2023-04-19 15:18:39'),
(131, 'title4', 'this is comtnet', 13, '2023-04-19 15:18:39'),
(132, 'title5', 'this is comtnet', 13, '2023-04-19 15:18:39'),
(133, 'title6', 'this is comtnet', 13, '2023-04-19 15:18:39'),
(134, 'title7', 'this is comtnet', 13, '2023-04-19 15:18:39'),
(135, 'title8', 'this is comtnet', 13, '2023-04-19 15:18:39'),
(136, 'title9', 'this is comtnet', 13, '2023-04-19 15:18:39'),
(137, 'title10', 'this is comtnet', 13, '2023-04-19 15:18:39'),
(138, 'title11', 'this is comtnet', 13, '2023-04-19 15:18:39'),
(139, 'title12', 'this is comtnet', 13, '2023-04-19 15:18:39'),
(140, 'title13', 'this is comtnet', 13, '2023-04-19 15:18:39'),
(141, 'title14', 'this is comtnet', 13, '2023-04-19 15:18:39'),
(142, 'title15', 'this is comtnet', 13, '2023-04-19 15:18:39'),
(143, 'title16', 'this is comtnet', 13, '2023-04-19 15:18:39'),
(144, 'title17', 'this is comtnet', 13, '2023-04-19 15:18:39'),
(145, 'title18', 'this is comtnet', 13, '2023-04-19 15:18:39'),
(146, 'title19', 'this is comtnet', 13, '2023-04-19 15:18:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `created_at`) VALUES
(5, 'abczy', '25d55ad283aa400af464c76d713c07ad', 'abc', 'acb', '2023-04-15 22:07:21'),
(8, 'zxczxc', '$2y$10$y0FuxDrmTWORsvZmRjajmu2f9UVSajD5vWqg0VCyrNrfC5fVHBwSG', 'xyz', 'xyz', '2023-04-16 13:51:35'),
(13, 'abc', '$2y$10$PFooMJ7Wy5jcqPmTDmC3WeIlQk0DK/To0E0i54Q8GENNQU5xD.OGu', 'abc', 'abc', '2023-04-17 20:25:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
