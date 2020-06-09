-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 09, 2020 at 03:43 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `majapahit`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(80) NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`c_id`, `c_name`, `username`, `password`, `address`, `phone`, `email`, `points`) VALUES
(1, 'John Lennong', 'johnlennong', '$2y$10$n84PVd8ArjHYYqhgBguPQ.08zhg6hExd1DGVOt9UfcvDm04d6BEFS', 'Jl. Kaki Sendirian, No. 10', '0899123123123', 'johnlennong@gmail.com', 15),
(2, 'Bambang', 'bambang', '$2y$10$2qtXpOglfs1hZDR9xg2M2un/6KJPDU35XVhL9Uc3zbCtcdtsbXtDG', 'Jl. Menuju Roma, No. 11', '081121112222', 'bambang@yahood.com', 5),
(3, 'Ali Oncom', 'alioncom', '$2y$10$Pa6XF1LbJKajCyr7eZT8vecBXApZjght/5FEcZN0JooG.wLDMMeZC', 'Jl. Rawa Bolong 23, RT/RW 02/007 Bekasi', '081932142211', 'alioncom@gmail.com', 0),
(4, 'Joe Pedal', 'joepedal', '$2y$10$.76yFOVKvZHQq0p8mp8v.eIkSGa0LznDd3n5gPoZCrWsIchVqZH/O', 'Perumahan Mekar Asri Blok A12 No. 1', '08122312998', 'joepedal@gmail.com', 5);

-- --------------------------------------------------------

--
-- Table structure for table `gifts`
--

CREATE TABLE `gifts` (
  `g_id` int(11) NOT NULL,
  `g_name` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `exchange_value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gifts`
--

INSERT INTO `gifts` (`g_id`, `g_name`, `deskripsi`, `exchange_value`) VALUES
(1, 'Piring Cap Gayung', 'Hadiah Berupa Piring Cap Gayung Warna Pink sangat cantik dan menawan', 25),
(2, 'Celana Jeans KW300', 'Celana KW300', 50),
(3, 'Tas Komodo', 'Tas Eksklusif untuk peternak Komodo agar dapat dengan mudah memindahkan Komodo dengan selamat serta membuat Komodo nyaman dan bahagia.', 75),
(5, 'Pompa Air Jet High Rpm', 'Pompa Air yang didesain khusus untuk menyedot air dan bisa digunakan untuk menerbangkan roket.', 100),
(6, 'Rak Sepatu', 'Rak Sepatu', 125);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `p_id` int(11) NOT NULL,
  `p_name` varchar(50) NOT NULL,
  `p_description` text NOT NULL,
  `image` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`p_id`, `p_name`, `p_description`, `image`) VALUES
(1, 'Jaket Hoodie', 'Jaket Hoodie', 'jaket_hoodie.jpeg'),
(2, 'Panci Power3000', 'Panci Super Ampuh dan Sangat Cepat Ketika digunakan untuk memasak. Sekali memasukkan bahan makanan seketika langsung siap disajikan.', 'panci.jpg'),
(3, 'Dispenser', 'Dispenser', '');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `t_id` int(11) NOT NULL,
  `invoice` varchar(40) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`t_id`, `invoice`, `cust_id`, `prod_id`) VALUES
(1, 'MC-2006090001', 1, 1),
(2, 'MC-2006090002', 2, 1),
(3, 'MC-2006090003', 1, 1),
(4, 'MC-2006090004', 1, 2),
(5, 'MC-2006090005', 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `name`, `email`, `username`, `password`) VALUES
(1, 'administrator', 'admin@admin.com', 'admin', '$2y$10$v1Dqtn8IyZvyTqrVvx1V8O8oqk8PYMIixqi7PwXn7a8ZycWDGZVEO');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `gifts`
--
ALTER TABLE `gifts`
  ADD PRIMARY KEY (`g_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `gifts`
--
ALTER TABLE `gifts`
  MODIFY `g_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
