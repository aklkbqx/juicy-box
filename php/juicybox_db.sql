-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Sep 01, 2024 at 11:11 AM
-- Server version: 8.4.0
-- PHP Version: 8.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `juicybox_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `cart_id` int NOT NULL,
  `product_id` int NOT NULL,
  `amount` int NOT NULL DEFAULT '1',
  `drink_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int NOT NULL,
  `oders_json` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `status` enum('waiting','delivering','canceled','successfully') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'waiting',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `oders_json`, `user_id`, `status`, `create_at`) VALUES
(15, '{\"totalPrice\":\"35\",\"user_id\":\"2\",\"carts\":[{\"cart_id\":\"6\",\"product_id\":\"4\",\"amount\":\"1\",\"drink_type\":\"\\u0e1b\\u0e31\\u0e48\\u0e19\",\"user_id\":\"2\",\"create_at\":\"2024-09-01 17:32:58\"}]}', 2, 'canceled', '2024-09-01 10:32:59'),
(16, '{\"totalPrice\":\"35\",\"user_id\":\"2\",\"carts\":[{\"cart_id\":\"7\",\"product_id\":\"2\",\"amount\":\"1\",\"drink_type\":\"\\u0e1b\\u0e31\\u0e48\\u0e19\",\"user_id\":\"2\",\"create_at\":\"2024-09-01 17:34:32\"}]}', 2, 'successfully', '2024-09-01 10:34:32'),
(17, '{\"totalPrice\":\"35\",\"user_id\":\"2\",\"carts\":[{\"cart_id\":\"8\",\"product_id\":\"5\",\"amount\":\"1\",\"drink_type\":\"\\u0e23\\u0e49\\u0e2d\\u0e19\",\"user_id\":\"2\",\"create_at\":\"2024-09-01 18:09:09\"}]}', 2, 'delivering', '2024-09-01 11:09:11');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `drink_type` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int NOT NULL,
  `product_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `detail`, `drink_type`, `price`, `product_image`, `create_at`) VALUES
(2, 'ชามะนาว', 'ชามะนาว', '[\"ร้อน\",\"เย็น\",\"ปั่น\"]', 35, '66c56d6552ee7.jpg', '2024-08-19 17:38:04'),
(3, 'โอเลี้ยง', 'โอเลี้ยง', '[\"ร้อน\",\"เย็น\"]', 30, '66c56d80400db.jpg', '2024-08-19 17:38:28'),
(4, 'ชาเขียว', 'ชาเขียว', '[\"ร้อน\",\"เย็น\",\"ปั่น\"]', 35, '66c56d85c457d.jpg', '2024-08-19 17:38:43'),
(5, 'โกโก้', 'โกโก้', '[\"ร้อน\",\"เย็น\",\"ปั่น\"]', 35, '66c581395d985.jpg', '2024-08-19 17:38:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `firstname` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('user','admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `tel`, `email`, `password`, `profile_image`, `address`, `role`, `created_at`) VALUES
(1, 'admin', 'admin', '123', 'admin@admin.com', '$2y$10$hajqwI4l867FIGNixCH66.Oow.Bt3frP/aeAkg2w/tx6ZW82iXbV6', 'default-profile.jpg', 'admin', 'admin', '2024-08-19 15:40:28'),
(2, 'test1', 'pass:123', '0000000000', 'test@gmail.com', '$2y$10$k.1veiPfIjId0YYmQLWgk.7T1bynYjS9sLzyPyWNs8rkPRDjPNT5e', '66d44b453b993.jpg', 'asd', 'user', '2024-08-21 04:50:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `cart_user_id` (`user_id`),
  ADD KEY `cart_product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `order_user_id` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `cart_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `cart_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `order_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
