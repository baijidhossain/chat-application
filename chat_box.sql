-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 23, 2024 at 06:22 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chat_box`
--

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int NOT NULL,
  `content` varchar(255) NOT NULL,
  `thread_id` int DEFAULT NULL,
  `sender_id` int NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `content`, `thread_id`, `sender_id`, `created`) VALUES
(1, 'hi rabbani', 1, 1, '2024-07-23 16:46:44'),
(2, 'kemon acho', 1, 2, '2024-07-23 16:56:51'),
(3, 'valo', 1, 1, '2024-07-23 17:26:42'),
(4, 'ki koro', 1, 2, '2024-07-23 17:31:31'),
(5, 'lfjsdlfj', 1, 1, '2024-07-23 17:32:14'),
(6, 'gfd', 1, 1, '2024-07-23 17:33:08'),
(7, 'ghdfgdf', 1, 1, '2024-07-23 17:33:11'),
(8, 'dgdfg', 1, 2, '2024-07-23 17:33:13'),
(9, 'gffdgdfg', 1, 2, '2024-07-23 17:33:16'),
(10, 'Hi', 1, 2, '2024-07-23 17:42:30'),
(11, 'kemon acho?', 1, 1, '2024-07-23 17:42:47'),
(12, '', 1, 2, '2024-07-23 17:55:16');

-- --------------------------------------------------------

--
-- Table structure for table `message_user_relation`
--

CREATE TABLE `message_user_relation` (
  `id` int NOT NULL,
  `message_id` int NOT NULL,
  `sender_id` int NOT NULL,
  `recipient_id` int NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `message_user_relation`
--

INSERT INTO `message_user_relation` (`id`, `message_id`, `sender_id`, `recipient_id`, `created`) VALUES
(1, 1, 1, 2, '2024-07-23 16:47:54');

-- --------------------------------------------------------

--
-- Table structure for table `thread`
--

CREATE TABLE `thread` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `thread`
--

INSERT INTO `thread` (`id`, `name`) VALUES
(1, 'Web Developer'),
(2, 'Graphics Designer');

-- --------------------------------------------------------

--
-- Table structure for table `thread_user_relation`
--

CREATE TABLE `thread_user_relation` (
  `id` int NOT NULL,
  `thread_id` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `thread_user_relation`
--

INSERT INTO `thread_user_relation` (`id`, `thread_id`, `user_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 1),
(4, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT '',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `image`, `email_verified_at`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Baijid Hossain', 'baijid@gmail.com', 'baijid.png', NULL, '123456789', 1, NULL, '2024-07-16 13:21:20', '2024-07-16 13:21:20'),
(2, 'Rabbani ', 'rabbani@gmail.com', 'rabbani.jpg', NULL, '123456789', 1, NULL, '2024-07-16 13:21:20', '2024-07-16 13:21:20'),
(3, 'Minthun', 'mithun@gmail.com', '', NULL, '123456789', 1, NULL, '2024-07-16 13:21:21', '2024-07-16 13:21:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message_user_relation`
--
ALTER TABLE `message_user_relation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `thread`
--
ALTER TABLE `thread`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `thread_user_relation`
--
ALTER TABLE `thread_user_relation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `message_user_relation`
--
ALTER TABLE `message_user_relation`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `thread`
--
ALTER TABLE `thread`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `thread_user_relation`
--
ALTER TABLE `thread_user_relation`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
