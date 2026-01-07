-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2026 at 08:00 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webtech`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `image`) VALUES
(1, 'default.png'),
(2, 'default.png');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(255) DEFAULT 'default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`) VALUES
(1, 'Electronics', 'default.png'),
(3, 'Home', 'default.png'),
(4, 'Toys', 'default.png'),
(5, 'Fashion', '1767639316_cat_cat_men.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` varchar(20) NOT NULL,
  `order_date` date DEFAULT curdate(),
  `shipping_address` text DEFAULT NULL,
  `billing_address` text DEFAULT NULL,
  `order_items` text DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_name`, `total_amount`, `status`, `order_date`, `shipping_address`, `billing_address`, `order_items`, `email`) VALUES
(1, 'Alamin', 165.00, 'Pending', '2026-01-05', NULL, NULL, NULL, NULL),
(2, 'Alamin', 165.00, 'Pending', '2026-01-05', NULL, NULL, NULL, NULL),
(3, 'Alamin', 165.00, 'Pending', '2026-01-05', NULL, NULL, NULL, NULL),
(4, 'John Doe', 520.00, 'Pending', '2026-01-05', NULL, NULL, NULL, NULL),
(5, 'John Doe', 1225.00, 'Pending', '2026-01-05', NULL, NULL, NULL, NULL),
(6, 'Alice', 150.00, 'Completed', '2023-10-20', NULL, NULL, NULL, NULL),
(7, 'Bob', 300.00, 'Shipped', '2023-10-21', '', '', '', NULL),
(8, 'Charlie', 50.00, 'Completed', '2023-10-21', '', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(255) DEFAULT 'default.png',
  `description` text DEFAULT NULL,
  `discount_price` decimal(10,2) DEFAULT 0.00,
  `category` varchar(50) DEFAULT 'General'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `quantity`, `image`, `description`, `discount_price`, `category`) VALUES
(1, 'Gaming Mouse', 45.00, 10, 'default.png', NULL, 0.00, 'General'),
(2, 'Keyboard', 120.00, 5, 'default.png', NULL, 0.00, 'General'),
(3, 'Gaming Mouse', 45.00, 10, 'default.png', NULL, 0.00, 'General'),
(4, 'Keyboard', 120.00, 5, 'default.png', NULL, 0.00, 'General'),
(5, 'Gaming Mouse', 45.00, 10, 'default.png', NULL, 0.00, 'General'),
(6, 'Keyboard', 120.00, 5, 'default.png', NULL, 0.00, 'General'),
(7, 'Laptop', 500.00, 5, 'default.png', NULL, 0.00, 'General'),
(8, 'Mouse', 20.00, 50, 'default.png', NULL, 0.00, 'General'),
(9, 'Gaming Laptop', 1200.00, 5, 'default.png', NULL, 0.00, 'General'),
(10, 'Wireless Mouse', 25.00, 50, 'default.png', '', 0.00, 'Electronics');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `role` varchar(50) DEFAULT 'User'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`) VALUES
(1, 'admin', 'admin123', 'admin@bestcart.com', 'Admin'),
(2, 'admin', 'password', 'admin@test.com', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
