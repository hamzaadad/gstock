-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Oct 14, 2016 at 01:36 PM
-- Server version: 5.5.42
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `gstock`
--

-- --------------------------------------------------------

--
-- Table structure for table `achats`
--

CREATE TABLE `achats` (
  `id` int(11) NOT NULL,
  `ref_type` int(11) DEFAULT NULL,
  `ref_for` int(11) DEFAULT NULL,
  `ref_vend` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `prix` double DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `basket`
--

CREATE TABLE `basket` (
  `id` int(11) NOT NULL,
  `ref_cli` int(11) DEFAULT NULL,
  `ref_vend` int(11) DEFAULT NULL,
  `ref_prod` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `sell_price` double DEFAULT NULL,
  `date` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `basket`
--

INSERT INTO `basket` (`id`, `ref_cli`, `ref_vend`, `ref_prod`, `qty`, `sell_price`, `date`) VALUES
(1, 2, 1, 2, 10, 20, '2016-10-09');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `city` varchar(100) NOT NULL,
  `tell` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `address`, `city`, `tell`, `created_at`, `updated_at`) VALUES
(2, 'wertyui', 'werty', 'wert', 'qwerty', '2016-10-09 02:09:59', '2016-10-09 02:09:59'),
(3, 'jhfjgh1hjgf', 'jhgf', 'hj', 'yu', '2016-10-09 02:10:46', '2016-10-09 02:10:46'),
(4, 'tyye1y', 'ytutyr', 'yuyt', 'uyt', '2016-10-09 02:12:36', '2016-10-09 02:12:36');

-- --------------------------------------------------------

--
-- Table structure for table `client_operation`
--

CREATE TABLE `client_operation` (
  `id` int(11) NOT NULL,
  `ref_cli` int(11) DEFAULT NULL,
  `ref_vend` int(11) DEFAULT NULL,
  `holding_amount` int(11) DEFAULT NULL,
  `advance` int(11) DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `ref_operation` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `client_wallet`
--

CREATE TABLE `client_wallet` (
  `id` int(11) NOT NULL,
  `ref_cli` int(11) NOT NULL,
  `ref_type` int(11) NOT NULL,
  `amout` double NOT NULL DEFAULT '0',
  `avout` double NOT NULL DEFAULT '0',
  `qty` int(11) NOT NULL,
  `date` varchar(20) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client_wallet`
--

INSERT INTO `client_wallet` (`id`, `ref_cli`, `ref_type`, `amout`, `avout`, `qty`, `date`, `updated_at`, `created_at`) VALUES
(25, 2, 1, 100, 0, 10, '2016-10-14', '2016-10-14 00:01:43', '2016-10-13 23:03:08'),
(26, 2, 1, -79.5, 0.5, 0, '2016-10-14', '2016-10-13 23:37:48', '2016-10-13 23:03:08'),
(27, 2, 1, -10, 0, 0, '2016-10-14', '2016-10-13 23:37:50', '2016-10-13 23:07:44'),
(28, 2, 1, 20, 0, 0, '1476399600', '2016-10-13 23:47:41', '2016-10-13 23:42:02'),
(29, 2, 1, -9.1, 0.9, 0, '1476399600', '2016-10-13 23:47:44', '2016-10-13 23:42:02');

-- --------------------------------------------------------

--
-- Table structure for table `fourniseurs`
--

CREATE TABLE `fourniseurs` (
  `id` int(11) NOT NULL,
  `tell` varchar(20) DEFAULT NULL,
  `address` mediumtext,
  `city` varchar(100) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fourniseurs`
--

INSERT INTO `fourniseurs` (`id`, `tell`, `address`, `city`, `nom`, `updated_at`, `created_at`) VALUES
(23, '4', '2', '', '1', '2016-10-08 16:32:50', '2016-10-08 16:32:50'),
(25, '4', '2', '1234563', '1', '2016-10-08 16:51:30', '2016-10-08 16:34:48'),
(26, '444', '222', '333', '111', '2016-10-08 16:35:03', '2016-10-08 16:35:03'),
(27, 'test', 'test', 'test', 'test', '2016-10-09 01:33:17', '2016-10-09 01:33:17'),
(28, 'wetwe', 'test', 'test', 'test', '2016-10-09 01:34:32', '2016-10-09 01:34:32'),
(29, 'test', 'test', 'test', 'test', '2016-10-09 01:35:22', '2016-10-09 01:35:22');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `ref_type` int(11) DEFAULT NULL,
  `ref_four` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `ref_type`, `ref_four`) VALUES
(1, 'tes test', 1, 0),
(2, 'test2', 2, 0),
(3, 'test2www', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `id` int(11) NOT NULL,
  `type_name` varchar(50) DEFAULT NULL,
  `unite` varchar(10) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`id`, `type_name`, `unite`) VALUES
(1, 'test', 'kg'),
(2, 'test', '23');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` int(11) NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `fourniseurs_id` int(11) NOT NULL,
  `date` varchar(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `price` double NOT NULL,
  `ref_type` int(11) NOT NULL,
  `name` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `qty`, `fourniseurs_id`, `date`, `created_at`, `updated_at`, `price`, `ref_type`, `name`) VALUES
(3, 10, 29, '2016-10-09', '2016-10-12 22:22:18', '0000-00-00 00:00:00', 20, 0, 0),
(4, 10, 29, '2016-10-09', '2016-10-12 22:22:20', '0000-00-00 00:00:00', 30, 0, 0),
(5, 39, 29, '2016-10-09', '2016-10-12 22:22:23', '0000-00-00 00:00:00', 40, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `stock_operations`
--

CREATE TABLE `stock_operations` (
  `id` int(11) NOT NULL,
  `ref_type` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `date` varchar(20) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_operations`
--

INSERT INTO `stock_operations` (`id`, `ref_type`, `qty`, `date`, `updated_at`, `created_at`) VALUES
(1, 1, 28, '2016-10-09', '2016-10-13 23:42:02', '0000-00-00 00:00:00'),
(2, 2, 10, '2016-10-09', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `unite_price_history`
--

CREATE TABLE `unite_price_history` (
  `id` int(11) NOT NULL,
  `ref_type` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `date` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unite_price_history`
--

INSERT INTO `unite_price_history` (`id`, `ref_type`, `price`, `date`) VALUES
(1, 1, 10, '2016-10-09'),
(2, 2, 20, '2016-10-09'),
(3, 1, 20, '2016-10-10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `user_name` varchar(10) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `level` tinyint(4) DEFAULT '0',
  `last_login` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `user_name`, `password`, `level`, `last_login`) VALUES
(1, 'dev', 'admin', 'admin', 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `achats`
--
ALTER TABLE `achats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ref_prod` (`ref_type`),
  ADD KEY `ref_for` (`ref_for`),
  ADD KEY `ref_vend` (`ref_vend`);

--
-- Indexes for table `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ref_cli` (`ref_cli`),
  ADD KEY `ref_vend` (`ref_vend`),
  ADD KEY `ref_prod` (`ref_prod`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_operation`
--
ALTER TABLE `client_operation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ref_cli` (`ref_cli`),
  ADD KEY `ref_vend` (`ref_vend`),
  ADD KEY `ref_operation` (`ref_operation`);

--
-- Indexes for table `client_wallet`
--
ALTER TABLE `client_wallet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ref_cli` (`ref_cli`);

--
-- Indexes for table `fourniseurs`
--
ALTER TABLE `fourniseurs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ref_type` (`ref_type`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fourniseurs_id` (`fourniseurs_id`);

--
-- Indexes for table `stock_operations`
--
ALTER TABLE `stock_operations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unite_price_history`
--
ALTER TABLE `unite_price_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`ref_type`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `achats`
--
ALTER TABLE `achats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `basket`
--
ALTER TABLE `basket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `client_operation`
--
ALTER TABLE `client_operation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `client_wallet`
--
ALTER TABLE `client_wallet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `fourniseurs`
--
ALTER TABLE `fourniseurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `stock_operations`
--
ALTER TABLE `stock_operations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `unite_price_history`
--
ALTER TABLE `unite_price_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `basket`
--
ALTER TABLE `basket`
  ADD CONSTRAINT `basket_ibfk_1` FOREIGN KEY (`ref_cli`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `basket_ibfk_2` FOREIGN KEY (`ref_vend`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `basket_ibfk_3` FOREIGN KEY (`ref_prod`) REFERENCES `products` (`id`);

--
-- Constraints for table `client_operation`
--
ALTER TABLE `client_operation`
  ADD CONSTRAINT `client_operation_ibfk_1` FOREIGN KEY (`ref_cli`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `client_operation_ibfk_2` FOREIGN KEY (`ref_vend`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `client_operation_ibfk_3` FOREIGN KEY (`ref_operation`) REFERENCES `basket` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`ref_type`) REFERENCES `product_type` (`id`);

--
-- Constraints for table `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `stocks_ibfk_2` FOREIGN KEY (`fourniseurs_id`) REFERENCES `fourniseurs` (`id`);
