-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2021 at 04:19 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE `masomononlineshopping`;
--
-- Database: `masomononlineshopping`
--

-- --------------------------------------------------------

--
-- Table structure for table `actioncenter`
--

CREATE TABLE `actioncenter` (
  `actionId` varchar(255) NOT NULL,
  `cartIntegrationId` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `actionReason` varchar(255) NOT NULL,
  `actionAddtionalReason` varchar(255) NOT NULL,
  `actionStatus` varchar(255) NOT NULL,
  `actionSellerComment` varchar(255) NOT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `actioncenter`
--

INSERT INTO `actioncenter` (`actionId`, `cartIntegrationId`, `action`, `actionReason`, `actionAddtionalReason`, `actionStatus`, `actionSellerComment`, `created_time`, `update_time`) VALUES
('Cancel-5fbfc5c46e88f', '5fbe023dbb424', 'cancel', 'Delivery time too long', 'Delivert time too long', 'pending', '', '2020-11-26 15:12:04', '2020-11-26 15:12:04'),
('Cancel-5fbfc9baaf10b', '5fbfc857b89d7', 'cancel', 'Duplicate Order', 'wrong item so need cancel', 'approve', '', '2020-11-26 15:28:58', '2020-12-12 04:05:09'),
('Cancel-5fc260c5ba193', '5fc25d92c16ae', 'cancel', 'Change of mind', 'i buy a wrong product.', 'approve', '', '2020-11-28 14:37:57', '2020-11-28 14:37:57'),
('Cancel-5fca460eb00ca', '5fc25d7f25eba', 'cancel', 'Change/combine order', 'i found new model from other placependi', 'reject', 'No Reason, just cannpt', '2020-12-04 14:22:06', '2020-12-09 02:15:42'),
('Cancel-5fca56359676a', '5fbe54c55dd23', 'cancel', 'Delivery time too long', 'i found more discount from other place', 'approve', ' ', '2020-12-04 15:31:01', '2020-12-12 04:18:48'),
('Cancel-5fd9b983b80a7', '5fd9b8bcbe716', 'cancel', 'Delivery time too long', 'Delivery Time Too Long', 'reject', 'No Reason', '2020-12-16 07:38:43', '2020-12-16 07:40:44'),
('Cancel-5fd9d8c9c5905', '5fd9bf016eaa0', 'cancel', 'Change payment method', 'fewfwefewfewfewfewfewfew', 'reject', 'No Reaosn', '2020-12-16 09:52:09', '2020-12-18 02:17:33'),
('Cancel-5fda1b8b4a2f4', '5fda19b211c48', 'cancel', 'Change of mind', 'change of mind .....', 'approve', '', '2020-12-16 14:36:59', '2020-12-16 14:36:59'),
('Cancel-5fda1e1a56585', '5fda1ba3a7696', 'cancel', 'Change/combine order', 'change of  mind ....', 'reject', 'No Reason', '2020-12-16 14:47:54', '2020-12-16 14:48:31'),
('Cancel-5fdc0f22c9777', '5fdc0e2aa7a5e', 'cancel', 'Change of mind', 'change  of mind .... ', 'reject', 'No Reason', '2020-12-18 02:08:34', '2020-12-18 02:26:52'),
('Cancel-5fe039e1302ab', '5fcf81a470db8', 'cancel', 'Delivery time too long', 'jm6yutjmyummyumuym,yuijmyumyu', 'approve', '', '2020-12-21 06:00:01', '2020-12-21 06:00:01'),
('Return-5fc11e5b4922b', '5fba12d79c686', 'return', 'Pictures do not match item', 'pictures don\'t match item', 'reject', 'No Reason Why..???', '2020-11-27 15:42:19', '2020-12-09 03:16:56'),
('Return-5fd0cff023756', '5fba123e082ac', 'return', 'Description does not match item', 'picture donot matach item', 'approve', 'No 2324', '2020-12-09 13:24:00', '2020-12-12 04:19:19'),
('Return-5fd9fb75323b7', '5fd9bf016eaa0', 'return', 'Do not want the item or it doesn ot suit me', 'qdqwdwqdqwdqwdqwdqwdwqd', 'approve', 'fdwefew', '2020-12-16 12:20:05', '2020-12-16 12:31:19'),
('Return-5fda06ece4942', '5fd9bf2293708', 'return', 'Received wrong item', 'ewfwefwefewfewfewffewf', 'pending', '', '2020-12-16 13:09:00', '2020-12-16 13:09:16'),
('Return-5fda2b9ed1bc0', '5fda2aa096537', 'return', 'Description does not match item', 'n6tyunyunm6uytmyujmyu', 'reject', 'no reason', '2020-12-16 15:45:34', '2020-12-16 15:45:58');

-- --------------------------------------------------------

--
-- Table structure for table `address_shipping`
--

CREATE TABLE `address_shipping` (
  `ship_id` varchar(255) NOT NULL,
  `recipient_name` varchar(255) NOT NULL,
  `recipient_phone` varchar(255) NOT NULL,
  `recipient_address` varchar(255) NOT NULL,
  `recipient_city` varchar(255) NOT NULL,
  `recipient_state` varchar(255) NOT NULL,
  `recipient_postalCode` int(5) NOT NULL,
  `recipient_country` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `status` int(5) NOT NULL COMMENT '0: default, 1: no default',
  `created_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `address_shipping`
--

INSERT INTO `address_shipping` (`ship_id`, `recipient_name`, `recipient_phone`, `recipient_address`, `recipient_city`, `recipient_state`, `recipient_postalCode`, `recipient_country`, `user_id`, `status`, `created_time`, `update_time`) VALUES
('5fa50bd9c407a', 'wxtest', '1234567890', 'No1,Tman Selantan,Jalan Selantan', 'Johor Bahru', 'Johor', 82000, 'Malaysia', '5f3cdcd7b7c99', 0, '2020-11-05 20:39:53', '2020-11-05 20:39:53'),
('5fa517665c72b', 'wxtest1', '1234567890', 'No1,Tman Selantan,Jalan Selantan', 'Johor Bahru', 'Johor', 82000, 'Malaysia', '5f3cdcd7b7c99', 1, '2020-11-05 21:29:10', '2020-11-05 21:29:10'),
('5fd9b0d56ddb5', 'user1', '12345678', 'No 1 Jalan ABCDEF', 'Johor Bahru', 'Johor', 82000, 'Malaysia', '5fd99a5ae4946', 1, '2020-12-16 07:01:41', '2020-12-16 07:01:41'),
('5fda1a3459c27', 'user2', '12345678', 'No a123', 'Johor Bahru', 'Johor', 83000, 'Malaysia', '5fda1972e9060', 1, '2020-12-16 14:31:16', '2020-12-16 14:31:16'),
('5fda1a913fbd5', 'ikuiu', '12345678', 'kuik', 'Ipoh', 'Kedah', 87999, 'Malaysia', '5fda1972e9060', 1, '2020-12-16 14:32:49', '2020-12-16 14:32:49'),
('5fda2b08dcf2b', 'user3', '12345678', 'No 1233', 'Johor Bahru', 'Johor', 83000, 'Malaysia', '5fda29b6c63e4', 1, '2020-12-16 15:43:04', '2020-12-16 15:43:04'),
('5fdc0e7d22e23', 'woonxun', '13467899', 'No 1 Jalan 1', 'Johor Bahru', 'Johor', 82000, 'Malaysia', '5fdb5ff082420', 1, '2020-12-18 02:05:49', '2020-12-18 02:05:49');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminId` varchar(255) NOT NULL,
  `adminName` varchar(255) NOT NULL,
  `adminEmail` varchar(255) NOT NULL,
  `adminImage` varchar(255) NOT NULL,
  `adminPosition` varchar(255) NOT NULL,
  `adminPassword` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminId`, `adminName`, `adminEmail`, `adminImage`, `adminPosition`, `adminPassword`, `status`, `created_time`, `update_time`, `last_login`) VALUES
('Admin5fd30496d366e8.94018912', 'admin', 'admin1@gmail.com', 'userman.jpg', 'warehouseAdmin', '$2y$10$hEhOKJZZQw9ZQ71jgczE9OqTEYA3FBI7fub1osrfK4ajMyUbsG/A.', 'online', '2020-12-10 17:33:10', '2020-12-10 17:33:10', '2020-12-10 17:33:10'),
('Admin5fd30535cf93e4.71771546', 'admin2', 'admin2@gmail.com', 'userman.jpg', 'warehouseAdmin', '$2y$10$hEhOKJZZQw9ZQ71jgczE9OqTEYA3FBI7fub1osrfK4ajMyUbsG/A.', 'offline', '2020-12-10 17:35:49', '2020-12-10 17:35:49', '2020-12-10 17:35:49');

-- --------------------------------------------------------

--
-- Table structure for table `auctionrecord`
--

CREATE TABLE `auctionrecord` (
  `auctionRecordId` varchar(255) NOT NULL,
  `productId` varchar(255) NOT NULL,
  `userId` varchar(255) NOT NULL,
  `bid` int(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auctionrecord`
--

INSERT INTO `auctionrecord` (`auctionRecordId`, `productId`, `userId`, `bid`, `date`) VALUES
('5f4b43c4a0211', '5f3ced3307627', '5f3cdcd7b7c99', 170, '2020-08-30 06:14:39'),
('5f4ce96r3r3r3', '5f4ce967cfd18', '5f4dba8f0962d', 50, '2020-11-13 07:55:06'),
('5f4dbbe545112', '5f4cfb3dac68a', '5f4dba8f0962d', 45, '2020-09-01 03:11:38'),
('5f4dbdc080ab1', '5f4ce967cfd18', '5f3cdcd7b7c99', 560, '2020-10-16 09:33:33'),
('5f4egsfe34f15', '5f4ce967cfd18', '5f4dba8f0962d', 50, '2020-11-13 07:56:08'),
('5f97da451f117', '5f4ceada5853d', '5f3cdcd7b7c99', 568, '2020-12-08 18:06:16'),
('5faf8c8a30a94', '5f4ce967cfd18', '5faf8b9b1d929', 571, '2020-11-14 07:51:51'),
('5fcf888e39978', '5fc8afd710cc3', '5f3cdcd7b7c99', 3650, '2020-12-08 17:18:37'),
('5fd0696ad7d2a', '5f4cfb3dac68a', '5f3cdcd7b7c99', 46, '2020-12-08 18:06:34'),
('5fd99ac1f402d', '5fc8afd710cc3', '5fd99a5ae4946', 3651, '2020-12-15 17:27:29'),
('5fd9a54b3fb2e', '5fc61f6709274', '5fd99a5ae4946', 345346, '2020-12-15 18:12:27'),
('5fdc139d62cec', '5fdb748e3f658', '5fdb5ff082420', 2600, '2020-12-18 02:27:41');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartId` varchar(255) NOT NULL,
  `userId` varchar(255) NOT NULL,
  `total` double(10,2) NOT NULL,
  `unifiedDelivery` int(2) NOT NULL COMMENT '0: agree, 1: disagree',
  `status` varchar(255) NOT NULL,
  `create_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cartId`, `userId`, `total`, `unifiedDelivery`, `status`, `create_time`, `update_time`) VALUES
('5fba0ce6a18ca', '5f3cdcd7b7c99', 25.00, 1, '', '2020-11-22 07:01:58', '2020-11-22 07:01:58'),
('5fba0e567b032', '5f3cdcd7b7c99', 35.00, 1, '', '2020-11-22 07:08:06', '2020-11-22 07:08:06'),
('5fba12426ddaf', '5f3cdcd7b7c99', 5.50, 1, '', '2020-11-22 07:24:50', '2020-11-22 07:24:50'),
('5fba12e26c825', '5f3cdcd7b7c99', 6.00, 1, '', '2020-11-22 07:27:30', '2020-11-22 07:27:30'),
('5fba7a1142a82', '5f3cdcd7b7c99', 239.00, 1, '', '2020-11-22 14:47:45', '2020-11-22 14:47:45'),
('5fbe0255388e1', '5f3cdcd7b7c99', 356.00, 1, '', '2020-11-25 07:05:57', '2020-11-25 07:05:57'),
('5fbe58d3bf0aa', '5f3cdcd7b7c99', 10.50, 1, '', '2020-11-25 13:14:59', '2020-11-25 13:14:59'),
('5fbfc94c92759', '5f3cdcd7b7c99', 66.00, 0, '', '2020-11-26 15:27:08', '2020-11-26 15:27:08'),
('5fc25ea0b1201', '5f3cdcd7b7c99', 999.00, 1, '', '2020-11-28 14:28:48', '2020-11-28 14:28:48'),
('5fc25f59ba38e', '5f3cdcd7b7c99', 74.90, 1, '', '2020-11-28 14:31:53', '2020-11-28 14:31:53'),
('5fcf81cc9e19f', '5f3cdcd7b7c99', 245.00, 1, '', '2020-12-08 13:38:20', '2020-12-08 13:38:20'),
('5fcf821224562', '5f3cdcd7b7c99', 356.00, 1, '', '2020-12-08 13:39:30', '2020-12-08 13:39:30'),
('5fd07c124cf5a', '5faf8b9b1d929', 109.95, 1, '', '2020-12-09 07:26:10', '2020-12-09 07:26:10'),
('5fd5ea8f4ec14', '5f3cdcd7b7c99', 25.00, 1, '', '2020-12-13 10:18:55', '2020-12-13 10:18:55'),
('5fd769fea1385', '5f3cdcd7b7c99', 65.00, 1, '', '2020-12-14 13:34:54', '2020-12-14 13:34:54'),
('5fd76dec8a106', '5f3cdcd7b7c99', 23.00, 1, '', '2020-12-14 13:51:40', '2020-12-14 13:51:40'),
('5fd9b8bfed85e', '5fd99a5ae4946', 1.40, 1, '', '2020-12-16 07:35:27', '2020-12-16 07:35:27'),
('5fd9bcf5a3342', '5fd99a5ae4946', 65.00, 1, '', '2020-12-16 07:53:25', '2020-12-16 07:53:25'),
('5fd9bf276acdb', '5fd99a5ae4946', 1201.00, 1, '', '2020-12-16 08:02:47', '2020-12-16 08:02:47'),
('5fda19fc78e62', '5fda1972e9060', 1.40, 1, '', '2020-12-16 14:30:20', '2020-12-16 14:30:20'),
('5fda1ba7543ec', '5fda1972e9060', 4.00, 0, '', '2020-12-16 14:37:27', '2020-12-16 14:37:27'),
('5fda24aeb7be2', '5fda1972e9060', 77.80, 1, '', '2020-12-16 15:15:58', '2020-12-16 15:15:58'),
('5fda2ae250932', '5fda29b6c63e4', 77.80, 1, '', '2020-12-16 15:42:26', '2020-12-16 15:42:26'),
('5fdab95d6793d', '5f3cdcd7b7c99', 239.00, 1, '', '2020-12-17 01:50:21', '2020-12-17 01:50:21'),
('5fdc0e4996bff', '5fdb5ff082420', 50.00, 0, '', '2020-12-18 02:04:57', '2020-12-18 02:04:57'),
('5fdc0f3d8e00a', '5fdb5ff082420', 19.99, 1, '', '2020-12-18 02:09:01', '2020-12-18 02:09:01'),
('5fe6ce28f3298', '5f3cdcd7b7c99', 125.00, 1, '', '2020-12-26 05:46:16', '2020-12-26 05:46:16'),
('5fe6ce60608f1', '5f3cdcd7b7c99', 210.00, 1, '', '2020-12-26 05:47:12', '2020-12-26 05:47:12');

-- --------------------------------------------------------

--
-- Table structure for table `cartintegration`
--

CREATE TABLE `cartintegration` (
  `cartIntegrationId` varchar(255) NOT NULL,
  `cartId` varchar(255) NOT NULL,
  `productId` varchar(255) NOT NULL,
  `userId` varchar(255) NOT NULL,
  `sellerId` varchar(255) NOT NULL,
  `variation` varchar(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `returnRequest` int(5) NOT NULL COMMENT '0:no, 1:yes',
  `cancelRequest` int(5) NOT NULL COMMENT '0:no, 1:yes	',
  `detentionPeriod` timestamp NULL DEFAULT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cartintegration`
--

INSERT INTO `cartintegration` (`cartIntegrationId`, `cartId`, `productId`, `userId`, `sellerId`, `variation`, `quantity`, `status`, `returnRequest`, `cancelRequest`, `detentionPeriod`, `created_time`, `update_time`) VALUES
('5fba0ad859e6a', '5fba0ce6a18ca', '5f4bab92de8da', '5f3cdcd7b7c99', '1', 'L', 1, 'closed', 0, 0, '0000-00-00 00:00:00', '2020-11-21 18:53:12', '2020-11-22 07:02:01'),
('5fba0e51b3e8a', '5fba0e567b032', '5f4c7e4b105f3', '5f3cdcd7b7c99', '1', 'L', 1, 'unpaid', 0, 0, '0000-00-00 00:00:00', '2020-11-21 19:08:01', '2020-11-22 07:08:09'),
('5fba123e082ac', '5fba12426ddaf', '5f4ca4a963399', '5f3cdcd7b7c99', '1', '50g', 1, 'shipping', 1, 0, '0000-00-00 00:00:00', '2020-11-21 19:24:46', '2020-12-04 19:07:14'),
('5fba12d79c686', '5fba12e26c825', '5f4cb176e00e9', '5f3cdcd7b7c99', '1', 'Laptop 14s-dq1029tu', 1, 'shipping', 1, 0, '0000-00-00 00:00:00', '2020-11-21 19:27:19', '2020-11-22 07:27:48'),
('5fba12ddd525e', '5fba12e26c825', '5f4cba82bacbc', '5f3cdcd7b7c99', '1', 'FA506I-HHN137T', 1, 'shipping', 0, 0, '0000-00-00 00:00:00', '2020-11-21 19:27:25', '2020-12-13 15:09:18'),
('5fba7a0b0b489', '5fba7a1142a82', '5f4ca33f217a4', '5f3cdcd7b7c99', '1', '15.6 Inch - BLACK', 1, 'shipping', 0, 0, '0000-00-00 00:00:00', '2020-11-22 02:47:39', '2020-12-14 04:57:15'),
('5fbe023dbb424', '5fbe0255388e1', '5f4cb042d2153', '5f3cdcd7b7c99', '1', 'M12a Printer', 1, 'submitted', 0, 1, '0000-00-00 00:00:00', '2020-11-24 19:05:33', '2020-11-26 15:12:04'),
('5fbe54c55dd23', '5fbe58d3bf0aa', '5f4cbcbe8f2bf', '5f3cdcd7b7c99', '1', '16 GB', 1, 'submitted', 0, 1, '0000-00-00 00:00:00', '2020-11-25 00:57:41', '2020-11-25 13:16:57'),
('5fbfc857b89d7', '5fbfc94c92759', '5f4ca4a963399', '5f3cdcd7b7c99', '1', '50g', 1, 'closed', 0, 0, '0000-00-00 00:00:00', '2020-11-26 03:23:03', '2020-12-14 09:22:58'),
('5fbfc9348dbf5', '5fbfc94c92759', '5f4ca859474fe', '5f3cdcd7b7c99', '1', 'Whitening Essence 30g', 1, 'closed', 0, 0, '0000-00-00 00:00:00', '2020-11-26 15:26:44', '2020-12-14 09:22:58'),
('5fc25d7f25eba', '5fc25ea0b1201', '5f4caa5a59f11', '5f3cdcd7b7c99', '1', 'Midnight Black', 1, 'packging', 0, 1, '0000-00-00 00:00:00', '2020-11-28 14:23:59', '2020-11-28 14:29:11'),
('5fc25d92c16ae', '5fc25f59ba38e', '5f4c7cc46ecc1', '5f3cdcd7b7c99', '1', 'M', 1, 'submitted', 0, 1, '0000-00-00 00:00:00', '2020-11-28 14:24:18', '2020-11-28 14:34:32'),
('5fc60b00b504b', '5fd07c124cf5a', '5f4ce967cfd18', '5faf8b9b1d929 ', '1', '', 1, 'closed', 0, 0, '2020-12-02 21:21:04', '2020-11-30 21:21:04', '2020-12-08 19:57:53'),
('5fcf81a470db8', '5fcf81cc9e19f', '5f4c89ada196f', '5f3cdcd7b7c99', '1', '', 1, 'unpaid', 0, 1, '0000-00-00 00:00:00', '2020-12-08 13:37:40', '2020-12-08 13:38:45'),
('5fcf81af8cb50', '5fcf81cc9e19f', '5f4c7e4b105f3', '5f3cdcd7b7c99', '1', 'L', 1, 'unpaid', 0, 0, '0000-00-00 00:00:00', '2020-12-08 13:37:51', '2020-12-08 13:38:45'),
('5fcf820da1f46', '5fcf821224562', '5f4cb042d2153', '5f3cdcd7b7c99', '1', 'M12a Printer', 1, 'submitted', 0, 0, '0000-00-00 00:00:00', '2020-12-08 13:39:25', '2020-12-08 02:40:59'),
('5fcf823bce6ed', '5fd5ea8f4ec14', '5f4bab92de8da', '5f3cdcd7b7c99', '1', 'XL', 1, 'shipping', 0, 0, '0000-00-00 00:00:00', '2020-12-08 01:40:11', '2020-12-12 22:19:43'),
('5fd0995b471d4', '5fd769fea1385', '5f4bacacca947', '5f3cdcd7b7c99', '1', 'XL', 1, 'closed', 0, 0, '0000-00-00 00:00:00', '2020-12-09 09:31:07', '2020-12-14 13:49:35'),
('5fd76de20d290', '5fd76dec8a106', '5f4cc04f3dd3e', '5f3cdcd7b7c99', '1', 'XXS', 1, 'shipping', 0, 0, '0000-00-00 00:00:00', '2020-12-14 13:51:30', '2020-12-16 12:56:32'),
('5fd9a62e18529', '', '5fc61f6709274', '5fd99a5ae4946 ', '5fc5f446e800e', '', 1, '', 0, 0, '2020-12-17 00:24:00', '2020-12-16 06:16:13', '2020-12-16 06:16:13'),
('5fd9b8bcbe716', '5fd9b8bfed85e', '5f4cc66a84dfd', '5fd99a5ae4946', '1', 'Tune & White Fish 1+', 1, 'packging', 0, 0, '0000-00-00 00:00:00', '2020-12-16 07:35:24', '2020-12-16 07:40:44'),
('5fd9bcf2ab42c', '5fd9bcf5a3342', '5f4cbef97e297', '5fd99a5ae4946', '1', 'Size 7 B7G2010 FIBA', 1, 'unpaid', 0, 1, '0000-00-00 00:00:00', '2020-12-16 07:53:22', '2020-12-16 07:53:39'),
('5fd9bf016eaa0', '5fd9bf276acdb', '5f4c928888bd5', '5fd99a5ae4946', '1', '', 1, 'shipping', 1, 0, '0000-00-00 00:00:00', '2020-12-16 08:02:09', '2020-12-18 02:17:33'),
('5fd9bf2293708', '5fd9bf276acdb', '5f4c94e4b85d0', '5fd99a5ae4946', '1', 'Orang-3in1', 1, 'shipping', 0, 0, '0000-00-00 00:00:00', '2020-12-16 08:02:42', '2020-12-16 13:09:16'),
('5fda19b211c48', '5fda19fc78e62', '5f4cc66a84dfd', '5fda1972e9060', '1', 'Ocean Fish 1+', 2, 'submitted', 0, 1, '0000-00-00 00:00:00', '2020-12-16 14:29:06', '2020-12-16 14:35:08'),
('5fda1ba3a7696', '5fda1ba7543ec', '5f4cba82bacbc', '5fda1972e9060', '1', 'FA506I-IHN241T', 1, 'closed', 0, 0, '0000-00-00 00:00:00', '2020-12-16 14:37:23', '2020-12-16 14:58:40'),
('5fda20bc1d72f', ' ', '5f4cba82bacbc', '5fda1972e9060', '1', 'FA506I-IHN241T', 1, '', 0, 0, '0000-00-00 00:00:00', '2020-12-16 02:59:08', '2020-12-16 02:59:08'),
('5fda24ab7ac98', '5fda24aeb7be2', '5f4cbe043ef7e', '5fda1972e9060', '1', 'Single Pack One Dozen', 1, 'submitted', 0, 0, '0000-00-00 00:00:00', '2020-12-16 15:15:55', '2020-12-16 15:16:13'),
('5fda2a4ab09fc', ' ', '5f4cc66a84dfd', '5fda29b6c63e4', '1', 'Seafood Cocktail 1+', 4, '', 0, 0, '0000-00-00 00:00:00', '2020-12-16 15:39:54', '2020-12-16 15:39:54'),
('5fda2aa096537', '5fda2ae250932', '5f4cbe043ef7e', '5fda29b6c63e4', '1', 'Single Pack One Dozen', 1, 'shipping', 0, 0, '0000-00-00 00:00:00', '2020-12-16 15:41:20', '2020-12-16 15:45:58'),
('5fdab959b0ba1', '5fdab95d6793d', '5f4ca33f217a4', '5f3cdcd7b7c99', '1', '15.6 Inch - BLACK', 1, 'shipping', 0, 0, '0000-00-00 00:00:00', '2020-12-17 01:50:17', '2020-12-17 02:10:47'),
('5fdc0e2aa7a5e', '5fdc0e4996bff', '5f4bab92de8da', '5fdb5ff082420', '1', 'L', 2, 'submitted', 0, 0, '0000-00-00 00:00:00', '2020-12-18 02:04:26', '2020-12-18 02:26:52'),
('5fdc0f3a859ef', '5fdc0f3d8e00a', '5f4c8428880fc', '5fdb5ff082420', '1', 'XL', 1, 'closed', 0, 0, '0000-00-00 00:00:00', '2020-12-18 02:08:58', '2020-12-18 02:25:19'),
('5fdc1318bd99d', ' ', '5f4c8428880fc', '5fdb5ff082420', '1', 'XL', 1, '', 0, 0, '0000-00-00 00:00:00', '2020-12-18 02:25:28', '2020-12-18 02:25:28'),
('5fdc131d62f5d', ' ', '5f4c8428880fc', '5fdb5ff082420', '1', 'XL', 1, '', 0, 0, '0000-00-00 00:00:00', '2020-12-18 02:25:33', '2020-12-18 02:25:33'),
('5fdf07554ddfb', '5fe6ce28f3298', '5f4cbef97e297', '5f3cdcd7b7c99', '1', 'Size 7 B7G2010 FIBA', 1, 'submitted', 0, 0, '0000-00-00 00:00:00', '2020-12-20 08:12:05', '2020-12-26 05:46:22'),
('5fe6ce0b8a1aa', '5fe6ce28f3298', '5f4bab92de8da', '5f3cdcd7b7c99', '1', 'L', 1, 'submitted', 0, 0, '0000-00-00 00:00:00', '2020-12-26 05:45:47', '2020-12-26 05:46:22'),
('5fe6ce254a04f', '5fe6ce28f3298', '5f4c7e4b105f3', '5f3cdcd7b7c99', '1', 'XL', 1, 'submitted', 0, 0, '0000-00-00 00:00:00', '2020-12-26 05:46:13', '2020-12-26 05:46:22'),
('5fe6ce53c7135', '5fe6ce60608f1', '5f4bc4ad14736', '5f3cdcd7b7c99', '1', 'L', 1, 'submitted', 0, 0, '0000-00-00 00:00:00', '2020-12-26 05:46:59', '2020-12-26 05:47:15'),
('5fe6ce5d8d38f', '5fe6ce60608f1', '5f4bca07ce4ed', '5f3cdcd7b7c99', '1', 'L', 1, 'shipping', 0, 0, '0000-00-00 00:00:00', '2020-12-26 05:47:09', '2020-12-26 06:15:37'),
('5fec368c1be63', '', '5f4bacacca947', '5f3cdcd7b7c99', '1', 'L', 1, '', 0, 0, '0000-00-00 00:00:00', '2020-12-30 08:13:00', '2020-12-30 08:47:40');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryId` varchar(255) NOT NULL,
  `categoryType` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryId`, `categoryType`) VALUES
('0', 'Men\'s Clothing'),
('10', 'Women\'s Shoes'),
('11', 'Watches'),
('12', 'Men\'s Shoes'),
('13', 'Home & Living'),
('14', 'Fashion Accessories'),
('15', 'Home Appliances'),
('16', 'Games, Bookss & Hobbies'),
('17', 'Women\'s Bags'),
('18', 'Others'),
('2', 'Mobile & Gadgets'),
('3', 'Health & Beauty'),
('4', 'Women\'s Clothing'),
('5', 'Men\'s Bags & Wallets'),
('6', 'Computer & Accessories'),
('7', 'Groceries & Pets'),
('8', 'Sports & Outdoor'),
('9', 'Baby & Toys');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `commentId` varchar(255) NOT NULL,
  `ratingId` varchar(255) NOT NULL,
  `comment_personId` varchar(255) NOT NULL,
  `commentText` varchar(255) NOT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`commentId`, `ratingId`, `comment_personId`, `commentText`, `created_time`, `update_time`) VALUES
('Comment-5fbe03d178ec3', 'Rating-5fbe03d178ec2', '5f3cdcd7b7c99', 'Nice Product\r\nFast Delivery', '2020-11-25 07:12:17', '2020-11-25 07:12:17'),
('Comment-5fcb4bd6021ce', 'Rating-5fbe03d178ec2', '5f3cdcd7b7c99', 'yes', '2020-12-05 08:59:02', '2020-12-05 08:59:02'),
('Comment-5fcb4fd97f907', 'Rating-5fcb4fd97f906', '5f3cdcd7b7c99', 'SOSO.......', '2020-12-05 09:16:09', '2020-12-05 09:16:09'),
('Comment-5fce1979ca8f5', 'Rating-5fbe03d178ec2', '1', 'ABCDEF ', '2020-12-07 00:00:57', '2020-12-07 00:00:57'),
('Comment-5fcf86b41fea1', 'Rating-5fbe03d178ec2', '1', 'Hi', '2020-12-08 01:59:16', '2020-12-08 01:59:16'),
('Comment-5fd078fe3bc6a', 'Rating-5fbe03d178ec2', '5f3cdcd7b7c99', 'TEST', '2020-12-09 07:13:02', '2020-12-09 07:13:02'),
('Comment-5fd0842fd04ae', 'Rating-5fd0842fd04ad', '5faf8b9b1d929', 'Nice Product', '2020-12-09 08:00:47', '2020-12-09 08:00:47'),
('Comment-5fd2138c106fe', 'Rating-5fbe03d178ec2', '5f3cdcd7b7c99', 'dashjdgsa', '2020-12-10 12:24:44', '2020-12-10 12:24:44'),
('Comment-5fd214264c97a', 'Rating-5fbe03d178ec2', '5f3cdcd7b7c99', 'dasdsaf', '2020-12-10 12:27:18', '2020-12-10 12:27:18'),
('Comment-5fda20f75355f', 'Rating-5fda20f75355e', '5fda1972e9060', 'fefwfwefwefwefewfewfewfe', '2020-12-16 15:00:07', '2020-12-16 15:00:07'),
('Comment-5fdc11b3778ae', 'Rating-5fbe03d178ec2', '1', 'ABCd', '2020-12-18 02:19:31', '2020-12-18 02:19:31'),
('Comment-5fdc1332b8563', 'Rating-5fdc1332b8561', '5fdb5ff082420', 'Fast Delivery', '2020-12-18 02:25:54', '2020-12-18 02:25:54'),
('Comment-5fdc17e32fbca', 'Rating-5fbe03d178ec2', '1', 'fef', '2020-12-18 02:45:55', '2020-12-18 02:45:55'),
('Comment-5fdc17e629e57', 'Rating-5fbe03d178ec2', '1', 'fef', '2020-12-18 02:45:58', '2020-12-18 02:45:58'),
('Comment-5fdc17edc6782', 'Rating-5fbe03d178ec2', '1', 'fef', '2020-12-18 02:46:05', '2020-12-18 02:46:05'),
('Comment-5fdc17f5331b6', 'Rating-5fbe03d178ec2', '1', 'gregreg', '2020-12-18 02:46:13', '2020-12-18 02:46:13'),
('Comment-5fdc186a02837', 'Rating-5fbe03d178ec2', '1', 'vrvv', '2020-12-18 02:48:10', '2020-12-18 02:48:10'),
('Comment-5fdc18ad26112', 'Rating-5fbe03d178ec2', '1', 'fwefwef', '2020-12-18 02:49:17', '2020-12-18 02:49:17');

-- --------------------------------------------------------

--
-- Table structure for table `feedback_image`
--

CREATE TABLE `feedback_image` (
  `feedbackId` varchar(255) NOT NULL,
  `feedback_sourceId` varchar(255) NOT NULL COMMENT 'returnId/ commentId',
  `feedback_location` varchar(255) NOT NULL COMMENT 'storage path',
  `feedback_filetype` varchar(255) NOT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback_image`
--

INSERT INTO `feedback_image` (`feedbackId`, `feedback_sourceId`, `feedback_location`, `feedback_filetype`, `created_time`, `update_time`) VALUES
('Feedback-5fbe03d178ec9', 'Comment-5fbe03d178ec3', 'pexels1.jpeg', 'image', '2020-11-25 07:12:17', '2020-11-25 07:12:17'),
('Feedback-5fbe03d186aae', 'Comment-5fbe03d178ec3', 'slq_index.jpg', 'image', '2020-11-25 07:12:17', '2020-11-25 07:12:17'),
('Feedback-5fc11e5b49547', 'Return-5fc11e5b4922b', 'A001.jpg', 'image', '2020-11-27 15:42:19', '2020-11-27 15:42:19'),
('Feedback-5fcdf8f716ba8', 'Comment-5fcdf8f6e3c31', 'Dream it possible.mp4', 'video', '2020-12-06 21:42:14', '2020-12-06 21:42:14'),
('Feedback-5fcdf8f7305c8', 'Comment-5fcdf8f6e3c31', 'pexels1.jpeg', 'image', '2020-12-06 21:42:14', '2020-12-06 21:42:14'),
('Feedback-5fce1979e4d2b', 'Comment-5fce1979ca8f5', 'A001.jpg', 'image', '2020-12-07 00:00:57', '2020-12-07 00:00:57'),
('Feedback-5fce197a0f102', 'Comment-5fce1979ca8f5', 'Acer Predator 1.png', 'image', '2020-12-07 00:00:57', '2020-12-07 00:00:57'),
('Feedback-5fce197a27f5e', 'Comment-5fce1979ca8f5', 'Dream it possible.mp4', 'video', '2020-12-07 00:00:57', '2020-12-07 00:00:57'),
('Feedback-5fce197a4191b', 'Comment-5fce1979ca8f5', 'pexels1.jpeg', 'image', '2020-12-07 00:00:57', '2020-12-07 00:00:57'),
('Feedback-5fce197a6f55d', 'Comment-5fce1979ca8f5', 'slq_index.jpg', 'image', '2020-12-07 00:00:57', '2020-12-07 00:00:57'),
('Feedback-5fcf86b431d29', 'Comment-5fcf86b41fea1', '2002.mp4', 'video', '2020-12-08 01:59:16', '2020-12-08 01:59:16'),
('Feedback-5fcf86b44559f', 'Comment-5fcf86b41fea1', 'A001.jpg', 'image', '2020-12-08 01:59:16', '2020-12-08 01:59:16'),
('Feedback-5fcf86b466856', 'Comment-5fcf86b41fea1', 'A003.jpg', 'image', '2020-12-08 01:59:16', '2020-12-08 01:59:16'),
('Feedback-5fd078fe641b5', 'Comment-5fd078fe3bc6a', 'pexels1.jpeg', 'image', '2020-12-09 07:13:02', '2020-12-09 07:13:02'),
('Feedback-5fd078fe74d65', 'Comment-5fd078fe3bc6a', 'slq_index.jpg', 'image', '2020-12-09 07:13:02', '2020-12-09 07:13:02'),
('Feedback-5fd0842fd04b3', 'Comment-5fd0842fd04ae', 'pexels1.jpeg', 'image', '2020-12-09 08:00:47', '2020-12-09 08:00:47'),
('Feedback-5fd214268c9c9', 'Comment-5fd214264c97a', 'pexels1.jpeg', 'image', '2020-12-10 12:27:18', '2020-12-10 12:27:18'),
('Feedback-5fd214274d877', 'Comment-5fd214264c97a', 'slq_index.jpg', 'image', '2020-12-10 12:27:18', '2020-12-10 12:27:18'),
('Feedback-5fda20f753564', 'Comment-5fda20f75355f', 'A555.jpg', 'image', '2020-12-16 15:00:07', '2020-12-16 15:00:07'),
('Feedback-5fda20f77ba8b', 'Comment-5fda20f75355f', 'A1001.jpg', 'image', '2020-12-16 15:00:07', '2020-12-16 15:00:07'),
('Feedback-5fdc11b39c98a', 'Comment-5fdc11b3778ae', 'Adicolor_Classics_3-Stripes_Long_Sleeve_Tee_Black_GN3478_01_laydown3.jpg', 'image', '2020-12-18 02:19:31', '2020-12-18 02:19:31'),
('Feedback-5fdc1332b8569', 'Comment-5fdc1332b8563', 'Adicolor_Classics_3-Stripes_Long_Sleeve_Tee_Black_GN3478_01_laydown3.jpg', 'image', '2020-12-18 02:25:54', '2020-12-18 02:25:54'),
('Feedback-5fdc1332ccbe0', 'Comment-5fdc1332b8563', 'Adicolor_Classics_3-Stripes_Long_Sleeve_Tee_Black_GN3478_21_model1.jpg', 'image', '2020-12-18 02:25:54', '2020-12-18 02:25:54'),
('Feedback-5fdc18ad4aed3', 'Comment-5fdc18ad26112', 'Adicolor_Classics_3-Stripes_Long_Sleeve_Tee_Black_GN3478_25_outfit4.jpg', 'image', '2020-12-18 02:49:17', '2020-12-18 02:49:17');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `imagesId` varchar(255) NOT NULL,
  `productId` varchar(255) NOT NULL,
  `image1` varchar(255) NOT NULL,
  `image2` varchar(255) NOT NULL,
  `image3` varchar(255) NOT NULL,
  `image4` varchar(255) NOT NULL,
  `image5` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`imagesId`, `productId`, `image1`, `image2`, `image3`, `image4`, `image5`) VALUES
('5f3ced3307629', '5f3ced3307627', 'Levi\'s Women\'s Slim Crewneck Tee 2.jpg', 'Levi\'s Women\'s Slim Crewneck Tee 6.jpg', 'Levi\'s Women\'s Slim Crewneck Tee 4.jpg', 'Levi\'s Women\'s Slim Crewneck Tee 5.jpg', 'Levi\'s Women\'s Slim Crewneck Tee 3.jpg'),
('5f3ced58618e2', '5f3ced58618df', 'Levi\'s Women\'s Slim Crewneck Tee 2.jpg', 'Levi\'s Women\'s Slim Crewneck Tee 6.jpg', 'Levi\'s Women\'s Slim Crewneck Tee 4.jpg', 'Levi\'s Women\'s Slim Crewneck Tee 5.jpg', 'Levi\'s Women\'s Slim Crewneck Tee 3.jpg'),
('5f3ced81bbe8e', '5f3ced81bbe8c', 'Levi\'s Women\'s Slim Crewneck Tee 2.jpg', 'Levi\'s Women\'s Slim Crewneck Tee 6.jpg', 'Levi\'s Women\'s Slim Crewneck Tee 4.jpg', 'Levi\'s Women\'s Slim Crewneck Tee 5.jpg', 'Levi\'s Women\'s Slim Crewneck Tee 3.jpg'),
('5f3cedbb4eec6', '5f3cedbb4eec4', 'Levi\'s Women\'s Slim Crewneck Tee 2.jpg', 'Levi\'s Women\'s Slim Crewneck Tee 6.jpg', 'Levi\'s Women\'s Slim Crewneck Tee 4.jpg', 'Levi\'s Women\'s Slim Crewneck Tee 5.jpg', 'Levi\'s Women\'s Slim Crewneck Tee 3.jpg'),
('5f4b73ac69ffb', '5f4b73ac69ff9', 'Levi\'s Women\'s Slim Crewneck Tee 2.jpg', 'Levi\'s Women\'s Slim Crewneck Tee 6.jpg', 'Levi\'s Women\'s Slim Crewneck Tee 4.jpg', 'Levi\'s Women\'s Slim Crewneck Tee 5.jpg', 'Levi\'s Women\'s Slim Crewneck Tee 3.jpg'),
('5f4bab92de8db', '5f4bab92de8da', 'Levi\'s Women\'s Slim Crewneck Tee 2.jpg', 'Levi\'s Women\'s Slim Crewneck Tee 6.jpg', 'Levi\'s Women\'s Slim Crewneck Tee 4.jpg', 'Levi\'s Women\'s Slim Crewneck Tee 5.jpg', 'Levi\'s Women\'s Slim Crewneck Tee 3.jpg'),
('5f4bacacca949', '5f4bacacca947', 'Levi\'s Women\'s Slim Crewneck Tee 2.jpg', 'Levi\'s Women\'s Slim Crewneck Tee 6.jpg', 'Levi\'s Women\'s Slim Crewneck Tee 4.jpg', 'Levi\'s Women\'s Slim Crewneck Tee 5.jpg', 'Levi\'s Women\'s Slim Crewneck Tee 3.jpg'),
('5f4bb0cb5123d', '5f4bb0cb5123c', 'Levi\'s Women\'s Slim Crewneck Tee 2.jpg', 'Levi\'s Women\'s Slim Crewneck Tee 6.jpg', 'Levi\'s Women\'s Slim Crewneck Tee 4.jpg', 'Levi\'s Women\'s Slim Crewneck Tee 5.jpg', 'Levi\'s Women\'s Slim Crewneck Tee 3.jpg'),
('5f4bb76242865', '5f4bb76242863', 'Levi\'s Women\'s Slim Crewneck Tee 2.jpg', 'Levi\'s Women\'s Slim Crewneck Tee 6.jpg', 'Levi\'s Women\'s Slim Crewneck Tee 4.jpg', 'Levi\'s Women\'s Slim Crewneck Tee 5.jpg', 'Levi\'s Women\'s Slim Crewneck Tee 3.jpg'),
('5f4bb7bf6a048', '5f4bb7bf6a044', 'Levi\'s Women\'s Slim Crewneck Tee 2.jpg', 'Levi\'s Women\'s Slim Crewneck Tee 6.jpg', 'Levi\'s Women\'s Slim Crewneck Tee 4.jpg', 'Levi\'s Women\'s Slim Crewneck Tee 5.jpg', 'Levi\'s Women\'s Slim Crewneck Tee 3.jpg'),
('5f4bb917c6152', '5f4bb917c6150', '', '', '', '', ''),
('5f4bba11ae028', '5f4bba11ae026', 'Levi\'s Women\'s Slim Crewneck Tee 2.jpg', 'Levi\'s Women\'s Slim Crewneck Tee 6.jpg', 'Levi\'s Women\'s Slim Crewneck Tee 4.jpg', 'Levi\'s Women\'s Slim Crewneck Tee 5.jpg', 'Levi\'s Women\'s Slim Crewneck Tee 3.jpg'),
('5f4bc4ad14750', '5f4bc4ad14736', 'Levi\'s Women\'s Slim Crewneck Tee 2.jpg', 'Levi\'s Women\'s Slim Crewneck Tee 6.jpg', 'Levi\'s Women\'s Slim Crewneck Tee 4.jpg', 'Levi\'s Women\'s Slim Crewneck Tee 5.jpg', 'Levi\'s Women\'s Slim Crewneck Tee 3.jpg'),
('5f4bc6c7d9df2', '5f4bc6c7d9df0', 'Levi\'s Women\'s Slim Crew Logo Tee 3.jpg', 'Levi\'s Women\'s Slim Crew Logo Tee 4.jpg', 'Levi\'s Women\'s Slim Crew Logo Tee 6.jpg', 'Levi\'s Women\'s Slim Crew Logo Tee 2.jpg', 'Levi\'s Women\'s Slim Crew Logo Tee 5.png'),
('5f4bc8579d023', '5f4bc8579d021', 'G2000 Suit Jacket Women OL Office Stylish Plain Blazer Polyester 3.jpg', 'G2000 Suit Jacket Women OL Office Stylish Plain Blazer Polyester 4.jpg', 'G2000 Suit Jacket Women OL Office Stylish Plain Blazer Polyester 5.jpg', 'G2000 Suit Jacket Women OL Office Stylish Plain Blazer Polyester 2.jpg', 'G2000 Suit Jacket Women OL Office Stylish Plain Blazer Polyester 6.jpg'),
('5f4bca07ce4ef', '5f4bca07ce4ed', 'New Balance Women\'s Apparel - Graphic Heathertech Tee-Shirt 2.jpg', 'New Balance Women\'s Apparel - Graphic Heathertech Tee-Shirt 6.jpg', 'New Balance Women\'s Apparel - Graphic Heathertech Tee-Shirt 4.jpg', 'New Balance Women\'s Apparel - Graphic Heathertech Tee-Shirt 5.jpg', 'New Balance Women\'s Apparel - Graphic Heathertech Tee-Shirt 3.jpg'),
('5f4c7cc46ecc3', '5f4c7cc46ecc1', 'HYPE Seasonal Rebel Tee 3.jpg', 'HYPE Seasonal Rebel Tee 5.jpg', 'HYPE Seasonal Rebel Tee 1.jpg', 'HYPE Seasonal Rebel Tee 2.jpg', 'HYPE Seasonal Rebel Tee 4.jpg'),
('5f4c7e4b105f6', '5f4c7e4b105f3', 'Navy & Navy Men\'s Basic Polo Tees 6.jpg', 'Navy & Navy Men\'s Basic Polo Tees 2.jpg', 'Navy & Navy Men\'s Basic Polo Tees 4.jpg', 'Navy & Navy Men\'s Basic Polo Tees 5.jpg', 'Navy & Navy Men\'s Basic Polo Tees 3.jpg'),
('5f4c8428880fe', '5f4c8428880fc', 'Embroidery Small Polo Logo Polo 2.jpg', 'Embroidery Small Polo Logo Polo 1.jpg', 'Embroidery Small Polo Logo Polo 3.jpg', 'Embroidery Small Polo Logo Polo 2.jpeg', 'Embroidery Small Polo Logo Polo 5.jpg'),
('5f4c85cad22a8', '5f4c85cad22a6', 'Fashion Men\'S Korean Slim Fit Men Long Jeans Skinny 2.jpg', 'Fashion Men\'S Korean Slim Fit Men Long Jeans Skinny 3.jpg', 'Fashion Men\'S Korean Slim Fit Men Long Jeans Skinny 4.jpg', 'Fashion Men\'S Korean Slim Fit Men Long Jeans Skinny 5.jpg', 'Fashion Men\'S Korean Slim Fit Men Long Jeans Skinny 6.jpg'),
('5f4c873f1e7c8', '5f4c873f1e7c6', 'Men Formal Business Meeting Straight Solid Slacks Pants 2.jpg', 'Men Formal Business Meeting Straight Solid Slacks Pants 3.jpg', 'Men Formal Business Meeting Straight Solid Slacks Pants 4.jpg', 'Men Formal Business Meeting Straight Solid Slacks Pants 5.jpg', 'Men Formal Business Meeting Straight Solid Slacks Pants 6.jpg'),
('5f4c89ada1971', '5f4c89ada196f', 'Calvin Klein CK Men Monogram 3.jpg', 'Calvin Klein CK Men Monogram 4.jpg', 'Calvin Klein CK Men Monogram 2.jpg', 'Calvin Klein CK Men Monogram 1.jpg', 'Calvin Klein CK Men Monogram 5.jpg'),
('5f4c908adca08', '5f4c908adca06', 'Renoma Men\'s Chest Bag 2.jpg', 'Renoma Men\'s Chest Bag 3.jpg', 'Renoma Men\'s Chest Bag 4.jpg', 'Renoma Men\'s Chest Bag 6.jpg', 'Renoma Men\'s Chest Bag 5.jpg'),
('5f4c928888bd7', '5f4c928888bd5', 'Bonia Chariot Messenger Bag 3.jpg', 'Bonia Chariot Messenger Bag 2.jpg', 'Bonia Chariot Messenger Bag 4.jpg', 'Bonia Chariot Messenger Bag 5.jpg', 'Bonia Chariot Messenger Bag 6.jpg'),
('5f4c935ae0617', '5f4c935ae05df', 'Bonia Aria Backpack 1.jpg', 'Bonia Aria Backpack 2.jpg', 'Bonia Aria Backpack 3.jpg', 'Bonia Aria Backpack 4.jpg', 'Bonia Aria Backpack 5.jpg'),
('5f4c94e4b85d2', '5f4c94e4b85d0', 'Case Valker Fashion Gorgeous 2.jpg', 'Case Valker Fashion Gorgeous 3.jpg', 'Case Valker Fashion Gorgeous 4.jpg', 'Case Valker Fashion Gorgeous 5.jpg', 'Case Valker Fashion Gorgeous 1.jpg'),
('5f4c9629431a0', '5f4c96294319d', 'Alfio Raldo Black Lattice Diamond 1.jpg', 'Alfio Raldo Black Lattice Diamond 2.jpg', 'Alfio Raldo Black Lattice Diamond 3.jpg', 'Alfio Raldo Black Lattice Diamond 4.jpg', 'Alfio Raldo Black Lattice Diamond 5.jpg'),
('5f4c98b5e36e9', '5f4c98b5e36e7', 'Alfio Raldo Women Fashion Stylish 1.jpg', 'Alfio Raldo Women Fashion Stylish 3.jpg', 'Alfio Raldo Women Fashion Stylish 5.jpg', 'Alfio Raldo Women Fashion Stylish 4.jpg', 'Alfio Raldo Women Fashion Stylish 6.jpg'),
('5f4c9a1065184', '5f4c9a1065182', 'Bonia Black Milagros Crossbody 4.jpg', 'Bonia Black Milagros Crossbody 1.jpg', 'Bonia Black Milagros Crossbody 2.jpg', 'Bonia Black Milagros Crossbody 5.jpg', 'Bonia Black Milagros Crossbody 3.jpg'),
('5f4c9ab931b57', '5f4c9ab931b56', 'Bonia Rose Gold And Silver 1.jpg', 'Bonia Rose Gold And Silver 3.jpg', 'Bonia Rose Gold And Silver 6.jpg', 'Bonia Rose Gold And Silver 2.jpg', 'Bonia Rose Gold And Silver 4.jpg'),
('5f4c9bd15cd64', '5f4c9bd15cd5f', 'PLAYBOY GENUINE LEATHER 2.jpg', 'PLAYBOY GENUINE LEATHER 3.jpg', 'PLAYBOY GENUINE LEATHER 5.jpg', 'PLAYBOY GENUINE LEATHER 6.jpg', 'PLAYBOY GENUINE LEATHER 4.jpg'),
('5f4c9cf7adf71', '5f4c9cf7adf70', 'Rav Design Men\'s Genuine Leather 1.jpg', 'Rav Design Men\'s Genuine Leather 2.jpg', 'Rav Design Men\'s Genuine Leather 3.jpg', 'Rav Design Men\'s Genuine Leather 4.jpeg', 'Rav Design Men\'s Genuine Leather 2.jpg'),
('5f4c9e34ce28c', '5f4c9e34ce270', 'Renoma Men - Business 2.jpg', 'Renoma Men - Business  4.jpg', 'Renoma Men - Business 6.jpg', 'Renoma Men - Business 5.jpg', 'Renoma Men - Business 3.jpg'),
('5f4ca33f217a6', '5f4ca33f217a4', 'TARGUS BP SOL-LITE 3.jpg', 'TARGUS BP SOL-LITE 6.jpg', 'TARGUS BP SOL-LITE 1.jpg', 'TARGUS BP SOL-LITE 4.jpg', 'TARGUS BP SOL-LITE 2.jpg'),
('5f4ca4a96339b', '5f4ca4a963399', 'Vaseline Petroleum Jelly 1.jpg', 'Vaseline Petroleum Jelly 3.jpg', 'Vaseline Petroleum Jelly 5.jpeg', 'Vaseline Petroleum Jelly 2.jpg', 'Vaseline Petroleum Jelly  6.jpg'),
('5f4ca778894d8', '5f4ca778894d1', 'L\'Oreal Paris Revitalift 2.jpg', 'L\'Oreal Paris Revitalift 5.jpg', 'L\'Oreal Paris Revitalift  4.jpg', 'L\'Oreal Paris Revitalift 1.jpg', 'L\'Oreal Paris Revitalift 3.jpg'),
('5f4ca85947500', '5f4ca859474fe', 'Hada Labo Premium Whitening Essence 3.jpg', 'Hada Labo Premium Whitening Essence 6.png', 'Hada Labo Premium Whitening Essence 4.jpg', 'Hada Labo Premium Whitening Essence 2.jpg', 'Hada Labo Premium Whitening Essence 1.png'),
('5f4caa5a59f13', '5f4caa5a59f11', 'Huawei Nova 7I 5.jpg', 'Huawei Nova 7I  6.jpg', 'Huawei Nova 7I 4.jpg', 'Huawei Nova 7I  1.jpg', 'Huawei Nova 7I  2.jpg'),
('5f4cabee19082', '5f4cabee19080', 'Huawei Band 4 Smartwatch 3.png', 'Huawei Band 4 Smartwatch 5.jpg', 'Huawei Band 4 Smartwatch 2.png', 'Huawei Band 4 Smartwatch 6.jpg', 'Huawei Band 4 Smartwatch 1.jpg'),
('5f4cae4b7f97a', '5f4cae4b7f977', 'OPPO A91 Smartphone1.jpg', 'OPPO A91 Smartphone 6.jpg', 'OPPO A91 Smartphone 5.jpg', 'OPPO A91 Smartphone 3.jpg', 'OPPO A91 Smartphone 4.jpeg'),
('5f4cb042d2155', '5f4cb042d2153', 'HP LaserJet Pro M12a Printer 5.jpg', 'HP LaserJet Pro M12a Printer 6.jpg', 'HP LaserJet Pro M12a Printer 2.png', 'HP LaserJet Pro M12a Printer 4.png', 'HP LaserJet Pro M12a Printer 3.png'),
('5f4cb176e00ea', '5f4cb176e00e9', 'HP Laptop 14s-dq1029tu 3.png', 'HP Laptop 14s-dq1029tu 4.png', 'HP Laptop 14s-dq1029tu 5.jpg', 'HP Laptop 14s-dq1029tu 6.jpg', 'HP Laptop 14s-dq1029tu 2.png'),
('5f4cba82bacbe', '5f4cba82bacbc', 'ASUS TUF A15 Gaming Laptop 2.jpg', 'ASUS TUF A15 Gaming Laptop 4.jpg', 'ASUS TUF A15 Gaming Laptop 6.jpg', 'ASUS TUF A15 Gaming Laptop 3.jpg', 'ASUS TUF A15 Gaming Laptop 5.jpg'),
('5f4cbb8233c62', '5f4cbb8233c60', 'Acer Predator Helios 2.png', 'Acer Predator Helios 3.jpg', 'Acer Predator Helios 4.jpg', 'Acer Predator Helios 6.jpg', 'Acer Predator Helios 5.jpg'),
('5f4cbcbe8f2c1', '5f4cbcbe8f2bf', 'Kingston Micro SD Card 6.jpg', 'Kingston Micro SD Card 4.jpg', 'Kingston Micro SD Card 5.jpg', 'Kingston Micro SD Card  3.jpg', 'Kingston Micro SD Card 1.jpg'),
('5f4cbe043ef81', '5f4cbe043ef7e', 'Victor Shuttlecocks 2.jpg', 'Victor Shuttlecocks 5.jpg', 'Victor Shuttlecocks 1.jpg', 'Victor Shuttlecocks 4.jpg', 'Victor Shuttlecocks 6.jpg'),
('5f4cbef97e298', '5f4cbef97e297', 'Molten Basketball Rubber 5.jpg', 'Molten Basketball Rubber 2.jpg', 'Molten Basketball Rubber 4.jpg', 'Molten Basketball Rubber 3.jpg', 'Molten Basketball Rubber 6.jpg'),
('5f4cc04f3dd40', '5f4cc04f3dd3e', 'MAXX Fashion Sport Shirt 4.jpg', 'MAXX Fashion Sport Shirt 2.jpg', 'MAXX Fashion Sport Shirt 3.jpg', 'MAXX Fashion Sport Shirt 6.jpg', 'MAXX Fashion Sport Shirt 5.jpg'),
('5f4cc1785bcbc', '5f4cc1785bcba', 'Yonex Astrox 99 Badminton 1.jpg', 'Yonex Astrox 99 Badminton 4.jpg', 'Yonex Astrox 99 Badminton 5.jpg', 'Yonex Astrox 99 Badminton 2.jpg', 'Yonex Astrox 99 Badminton 6.jpg'),
('5f4cc2f6208b7', '5f4cc2f6208ad', 'AVENT Natural Bottle 3.jpg', 'AVENT Natural Bottle 5.jpg', 'AVENT Natural Bottle 4.jpg', 'AVENT Natural Bottle 2.jpg', 'AVENT Natural Bottle 6.jpg'),
('5f4cc41b21398', '5f4cc41b21396', 'Nestle Nankid Optipro HA 5.jpg', 'Nestle Nankid Optipro HA 4.jpg', 'Nestle Nankid Optipro HA 1.jpg', 'Nestle Nankid Optipro HA 3.jpg', 'Nestle Nankid Optipro HA 6.jpg'),
('5f4cc4f75301b', '5f4cc4f753019', 'Drypers Baby Head 3.jpg', 'Drypers Baby Head 1.jpg', 'Drypers Baby Head 4.jpg', 'Drypers Baby Head 5.jpg', 'Drypers Baby Head 6.jpg'),
('5f4cc66a84e0f', '5f4cc66a84dfd', 'WHISKAS CAT 3.png', 'WHISKAS CAT 1.jpg', 'WHISKAS CAT 6.jpg', 'WHISKAS CAT 4.jpg', 'WHISKAS CAT 5.jpg'),
('5f4ce7eb993a5', '5f4ce7eb993a3', 'Fossil Explorist Gen 2.jpg', 'Fossil Explorist Gen 5.jpg', 'Fossil Explorist Gen 4.jpg', 'Fossil Explorist Gen 3.jpg', 'Fossil Explorist Gen 1.jpg'),
('5f4ce967cfd1a', '5f4ce967cfd18', 'PLAYBOY GENUINE LEATHER 1.jpg', 'PLAYBOY GENUINE LEATHER 5.jpg', 'PLAYBOY GENUINE LEATHER 3.jpg', 'PLAYBOY GENUINE LEATHER 6.jpg', 'PLAYBOY GENUINE LEATHER 4.jpg'),
('5f4ceada58541', '5f4ceada5853d', 'Victor Badminton Bag 1.jpg', 'Victor Badminton Bag 3.jpg', 'Victor Badminton Bag 2.jpg', 'Victor Badminton Bag 4.jpg', 'Victor Badminton Bag 5.jpg'),
('5f4cec2522463', '5f4cec2522462', 'ony WH-1000XM4 Bluetooth 2.jpg', 'ony WH-1000XM4 Bluetooth 1.jpg', 'ony WH-1000XM4 Bluetooth 3.jpg', 'ony WH-1000XM4 Bluetooth 4.jpg', 'ony WH-1000XM4 Bluetooth 5.jpg'),
('5f4cee9e56a3c', '5f4cee9e56a3a', 'Microsoft Surface Go 1.jpg', 'Microsoft Surface Go 2.jpg', 'Microsoft Surface Go 4.jpg', 'Microsoft Surface Go 5.jpg', 'Microsoft Surface Go 6.jpg'),
('5f4cf849524c9', '5f4cf849524c3', 'Acer Predator 1.png', 'Acer Predator 2.png', 'Acer Predator 3.png', 'Acer Predator 4.jpg', 'Acer Predator 6.jpg'),
('5f4cf9f8e0542', '5f4cf9f8e053b', 'Asus Zenbook Duo 2.jpg', 'Asus Zenbook Duo 3.jpg', 'Asus Zenbook Duo 4.jpg', 'Asus Zenbook Duo 5.jpg', 'Asus Zenbook Duo 6.jpg'),
('5f4cfb3dac68b', '5f4cfb3dac68a', 'Samsung Galaxy Note 2.jpg', 'Samsung Galaxy Note 3.jpg', 'Samsung Galaxy Note 4.jpg', 'Samsung Galaxy Note 5.jpg', 'Samsung Galaxy Note 6.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `inventoryId` varchar(255) NOT NULL,
  `productId` varchar(255) NOT NULL,
  `sellerId` varchar(255) NOT NULL,
  `totalStock` int(255) NOT NULL,
  `stock` int(255) NOT NULL,
  `spaceInventory` int(255) NOT NULL,
  `recordDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`inventoryId`, `productId`, `sellerId`, `totalStock`, `stock`, `spaceInventory`, `recordDate`) VALUES
('5f3ced330762a', '5f3ced3307627', '1', 1, 0, 0, '2020-08-19 09:13:23'),
('5f3ced58618e3', '5f3ced58618df', '1', 1, 0, 0, '2020-08-19 09:14:00'),
('5f3ced81bbe8f', '5f3ced81bbe8c', '1', 1, 0, 0, '2020-08-19 09:14:41'),
('5f3cedbb4eec7', '5f3cedbb4eec4', '1', 1, 0, 0, '2020-08-19 09:15:39'),
('5f4b73ac69ffc', '5f4b73ac69ff9', '1', 1, 0, 0, '2020-08-30 09:38:52'),
('5f4bab92de8dc', '5f4bab92de8da', '1', 196, 176, 20, '2020-12-03 01:25:46'),
('5f4bacacca94a', '5f4bacacca947', '1', 49, 44, 5, '2020-08-30 13:42:05'),
('5f4bae2e30c21', '5f4bae2e30c1e', '1', 50, 45, 5, '2020-08-30 13:48:30'),
('5f4baea96ae73', '5f4baea96ae71', '1', 50, 45, 5, '2020-08-30 13:50:33'),
('5f4baf84af9ce', '5f4baf84af9cb', '1', 50, 45, 5, '2020-08-30 13:54:13'),
('5f4baf9c7c178', '5f4baf9c7c165', '1', 50, 45, 5, '2020-08-30 13:54:36'),
('5f4bafe900e04', '5f4bafe900e00', '1', 50, 45, 5, '2020-08-30 13:55:53'),
('5f4bb00c58454', '5f4bb00c58451', '1', 50, 45, 5, '2020-08-30 13:56:28'),
('5f4bb0a9ca8ad', '5f4bb0a9ca8a9', '1', 50, 45, 5, '2020-08-30 13:59:06'),
('5f4bb0cb5123e', '5f4bb0cb5123c', '1', 50, 45, 5, '2020-08-30 13:59:39'),
('5f4bb1a3ac62e', '5f4bb1a3ac62c', '1', 50, 45, 5, '2020-08-30 14:03:15'),
('5f4bb2113bd72', '5f4bb2113bd6f', '1', 50, 45, 5, '2020-08-30 14:05:05'),
('5f4bb2324d44c', '5f4bb2324d449', '1', 50, 45, 5, '2020-08-30 14:05:38'),
('5f4bb6ff16400', '5f4bb6ff163fc', '1', 50, 45, 5, '2020-08-30 14:26:07'),
('5f4bb76242866', '5f4bb76242863', '1', 50, 45, 5, '2020-08-30 14:27:46'),
('5f4bb7bf6a049', '5f4bb7bf6a044', '1', 50, 45, 5, '2020-08-30 14:29:19'),
('5f4bb917c6153', '5f4bb917c6150', '1', 50, 45, 5, '2020-08-30 14:35:04'),
('5f4bba11ae029', '5f4bba11ae026', '1', 50, 45, 5, '2020-08-30 14:39:14'),
('5f4bc4ad14751', '5f4bc4ad14736', '1', 49, 44, 5, '2020-08-30 15:24:29'),
('5f4bc6c7d9df3', '5f4bc6c7d9df0', '1', 21, 19, 2, '2020-12-06 18:05:11'),
('5f4bc8579d024', '5f4bc8579d021', '1', 21, 19, 2, '2020-12-16 14:45:20'),
('5f4bca07ce4f0', '5f4bca07ce4ed', '1', 48, 43, 5, '2020-08-30 15:47:20'),
('5f4c7cc46ecc4', '5f4c7cc46ecc1', '1', 49, 44, 5, '2020-08-31 04:29:57'),
('5f4c7e4b105f7', '5f4c7e4b105f3', '1', 25, 22, 3, '2020-12-18 02:14:18'),
('5f4c8428880ff', '5f4c8428880fc', '1', 19, 17, 2, '2020-08-31 05:01:29'),
('5f4c85cad22a9', '5f4c85cad22a6', '1', 30, 27, 3, '2020-08-31 05:08:27'),
('5f4c873f1e7c9', '5f4c873f1e7c6', '1', 278, 250, 28, '2020-08-31 05:14:39'),
('5f4c89ada1972', '5f4c89ada196f', '1', 49, 44, 5, '2020-08-31 05:25:01'),
('5f4c908adca09', '5f4c908adca06', '1', 10, 9, 1, '2020-08-31 05:54:19'),
('5f4c928888bd8', '5f4c928888bd5', '1', 499, 449, 50, '2020-08-31 06:02:48'),
('5f4c935ae0618', '5f4c935ae05df', '1', 25, 23, 3, '2020-12-03 03:06:23'),
('5f4c94e4b85d3', '5f4c94e4b85d0', '1', 499, 449, 50, '2020-08-31 06:12:53'),
('5f4c9629431a1', '5f4c96294319d', '1', 499, 449, 50, '2020-08-31 06:18:17'),
('5f4c98b5e36ea', '5f4c98b5e36e7', '1', 60, 54, 6, '2020-08-31 06:29:10'),
('5f4c9a1065185', '5f4c9a1065182', '1', 60, 54, 6, '2020-08-31 06:34:56'),
('5f4c9ab931b58', '5f4c9ab931b56', '1', 10, 9, 1, '2020-12-06 18:05:20'),
('5f4c9bd15cd65', '5f4c9bd15cd5f', '1', 35, 32, 4, '2020-08-31 06:42:25'),
('5f4c9cf7adf72', '5f4c9cf7adf70', '1', 260, 234, 26, '2020-08-31 06:47:19'),
('5f4c9e34ce28d', '5f4c9e34ce270', '1', 45, 41, 5, '2020-08-31 06:52:37'),
('5f4ca33f217a7', '5f4ca33f217a4', '1', 499, 449, 50, '2020-08-31 07:14:07'),
('5f4ca4a96339c', '5f4ca4a963399', '1', 999, 899, 100, '2020-08-31 07:20:09'),
('5f4ca778894da', '5f4ca778894d1', '1', 500, 450, 50, '2020-08-31 07:32:08'),
('5f4ca85947501', '5f4ca859474fe', '1', 239, 215, 24, '2020-08-31 07:35:53'),
('5f4caa5a59f14', '5f4caa5a59f11', '1', 198, 178, 20, '2020-08-31 07:44:26'),
('5f4cabee19083', '5f4cabee19080', '1', 249, 224, 25, '2020-08-31 07:51:10'),
('5f4cae4b7f97b', '5f4cae4b7f977', '1', 10, 9, 1, '2020-08-31 08:01:15'),
('5f4cb042d2156', '5f4cb042d2153', '1', 349, 314, 35, '2020-08-31 08:09:39'),
('5f4cb176e00eb', '5f4cb176e00e9', '1', 75, 68, 8, '2020-08-31 08:14:47'),
('5f4cba82bacbf', '5f4cba82bacbc', '1', 349, 314, 35, '2020-08-31 08:53:23'),
('5f4cbb8233c63', '5f4cbb8233c60', '1', 256, 230, 26, '2020-08-31 08:57:38'),
('5f4cbcbe8f2c2', '5f4cbcbe8f2bf', '1', 1244, 1119, 125, '2020-08-31 09:02:55'),
('5f4cbe043ef82', '5f4cbe043ef7e', '1', 2498, 2248, 250, '2020-08-31 09:08:20'),
('5f4cbef97e299', '5f4cbef97e297', '1', 795, 715, 80, '2020-08-31 09:12:25'),
('5f4cc04f3dd41', '5f4cc04f3dd3e', '1', 599, 539, 60, '2020-08-31 09:18:07'),
('5f4cc1785bcbd', '5f4cc1785bcba', '1', 328, 295, 33, '2020-08-31 09:23:05'),
('5f4cc2f6208b8', '5f4cc2f6208ad', '1', 165, 149, 17, '2020-08-31 09:29:26'),
('5f4cc41b21399', '5f4cc41b21396', '1', 589, 530, 59, '2020-08-31 09:34:19'),
('5f4cc4f75301c', '5f4cc4f753019', '1', 3590, 3231, 359, '2020-08-31 09:37:59'),
('5f4cc66a84e10', '5f4cc66a84dfd', '1', 583, 524, 59, '2020-08-31 09:44:11'),
('5f4ce7eb993a6', '5f4ce7eb993a3', '1', 1, 0, 0, '2020-08-31 12:07:07'),
('5f4ce967cfd1b', '5f4ce967cfd18', '1', 0, 0, 0, '2020-08-31 12:13:27'),
('5f4ceada58542', '5f4ceada5853d', '1', 1, 0, 0, '2020-08-31 12:19:38'),
('5f4cec2522464', '5f4cec2522462', '1', 1, 0, 0, '2020-08-31 12:25:09'),
('5f4cee9e56a3d', '5f4cee9e56a3a', '1', 1, 0, 0, '2020-08-31 12:35:42'),
('5f4cf849524ca', '5f4cf849524c3', '1', 1, 0, 0, '2020-08-31 13:16:57'),
('5f4cf9f8e0543', '5f4cf9f8e053b', '1', 1, 0, 0, '2020-08-31 13:24:09'),
('5f4cfb3dac68c', '5f4cfb3dac68a', '1', 1, 0, 0, '2020-08-31 13:29:33'),
('5fc61250ae9a5', '5fc61250ae9a3', '5fc5f446e800e', 30, 27, 3, '2020-12-02 22:58:11'),
('5fc742e1c9088', '5fc742e1c9087', '1', 50, 45, 5, '2020-12-17 03:23:46'),
('5fc786dbc5c69', '5fc786dbc5c61', '1', 500, 450, 50, '2020-12-03 01:33:44'),
('5fc8f46b0603e', '5fc8f46b0603c', '5fc5f446e800e', 20, 18, 2, '2020-12-03 02:21:31'),
('5fdb734b188b7', '5fdb734b188b5', '5fc5f446e800e', 110, 98, 12, '2020-12-17 03:14:20'),
('5fdc1019d82f2', '5fdc1019d82f0', '1', 500, 450, 50, '2020-12-18 02:12:41');

-- --------------------------------------------------------

--
-- Table structure for table `orderlist`
--

CREATE TABLE `orderlist` (
  `orderId` varchar(255) NOT NULL,
  `userId` varchar(255) NOT NULL,
  `cartId` varchar(255) NOT NULL,
  `shipId` varchar(255) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderlist`
--

INSERT INTO `orderlist` (`orderId`, `userId`, `cartId`, `shipId`, `amount`, `status`, `created_time`, `update_time`) VALUES
('OrderID-5fba0ce9b87c8', '5f3cdcd7b7c99', '5fba0ce6a18ca', '5fa50bd9c407a', 30.00, 'closed', '2020-11-22 07:02:01', '2020-11-22 07:02:01'),
('OrderID-5fba0e59f1896', '5f3cdcd7b7c99', '5fba0e567b032', '5fa50bd9c407a', 40.00, 'waiting pay', '2020-11-22 07:08:09', '2020-11-22 07:08:09'),
('OrderID-5fba1246ef400', '5f3cdcd7b7c99', '5fba12426ddaf', '5fa50bd9c407a', 10.50, 'waiting comfirm', '2020-11-22 07:24:54', '2020-11-22 07:24:54'),
('OrderID-5fba12f457234', '5f3cdcd7b7c99', '5fba12e26c825', '5fa50bd9c407a', 16.00, 'waiting receive', '2020-11-22 07:27:48', '2020-12-13 15:09:18'),
('OrderID-5fba7a1479b4f', '5f3cdcd7b7c99', '5fba7a1142a82', '5fa50bd9c407a', 244.00, 'waiting receive', '2020-11-22 14:47:48', '2020-12-14 04:57:15'),
('OrderID-5fbe03025a662', '5f3cdcd7b7c99', '5fbe0255388e1', '5fa50bd9c407a', 361.00, 'closed', '2020-11-25 07:08:50', '2020-11-26 15:12:04'),
('OrderID-5fbe59494796e', '5f3cdcd7b7c99', '5fbe58d3bf0aa', '5fa50bd9c407a', 15.50, 'closed', '2020-11-25 13:16:57', '2020-12-04 15:31:01'),
('OrderID-5fbfc95133e07', '5f3cdcd7b7c99', '5fbfc94c92759', '5fa50bd9c407a', 76.60, 'closed', '2020-11-26 15:27:13', '2020-12-14 09:22:58'),
('OrderID-5fc25eb76a8bb', '5f3cdcd7b7c99', '5fc25ea0b1201', '5fa6606d00a4b', 1004.00, 'waiting ship', '2020-11-28 14:29:11', '2020-12-04 14:22:06'),
('OrderID-5fc25f90a8f48', '5f3cdcd7b7c99', '5fc25f59ba38e', '5fbe02af147b0', 79.90, 'closed', '2020-11-28 14:32:48', '2020-11-28 14:37:57'),
('OrderID-5fcf81e515c22', '5f3cdcd7b7c99', '5fcf81cc9e19f', '5fa6606d00a4b', 45.00, 'waiting pay', '2020-12-08 13:38:45', '2020-12-21 06:00:01'),
('OrderID-5fcf82154c4cd', '5f3cdcd7b7c99', '5fcf821224562', '5fa50bd9c407a', 361.00, 'waiting comfirm', '2020-12-08 13:39:33', '2020-12-08 13:39:33'),
('OrderID-5fd082af9c73c', '5faf8b9b1d929', '5fd07c124cf5a', '5fd0829c2c666', 114.95, 'closed', '2020-12-09 07:54:23', '2020-12-09 07:54:23'),
('OrderID-5fd5ea9277c64', '5f3cdcd7b7c99', '5fd5ea8f4ec14', '5fa50bd9c407a', 30.00, 'waiting receive', '2020-12-13 10:18:58', '2020-12-12 22:19:43'),
('OrderID-5fd76a2001aa0', '5f3cdcd7b7c99', '5fd769fea1385', '5fa6606d00a4b', 70.00, 'closed', '2020-12-14 13:35:28', '2020-12-14 13:49:35'),
('OrderID-5fd76df0bb0c3', '5f3cdcd7b7c99', '5fd76dec8a106', '5fa50bd9c407a', 28.70, 'waiting receive', '2020-12-14 13:51:44', '2020-12-16 12:56:32'),
('OrderID-5fd9b8c7255de', '5fd99a5ae4946', '5fd9b8bfed85e', '5fd9b0d56ddb5', 6.40, 'waiting comfirm', '2020-12-16 07:35:35', '2020-12-16 07:35:35'),
('OrderID-5fd9bd03cf5cf', '5fd99a5ae4946', '5fd9bcf5a3342', '5fd9b0d56ddb5', 70.00, 'waiting pay', '2020-12-16 07:53:39', '2020-12-16 07:53:39'),
('OrderID-5fd9bf2f4bc23', '5fd99a5ae4946', '5fd9bf276acdb', '5fd9b0d56ddb5', 1130.00, 'waiting receive', '2020-12-16 08:02:55', '2020-12-16 12:57:25'),
('OrderID-5fda1ab73b4e5', '5fda1972e9060', '5fda19fc78e62', '5fda1a3459c27', 6.40, 'closed', '2020-12-16 14:33:27', '2020-12-16 14:36:59'),
('OrderID-5fda1bb2d3875', '5fda1972e9060', '5fda1ba7543ec', '5fda1a3459c27', 8.50, 'closed', '2020-12-16 14:37:38', '2020-12-16 14:58:40'),
('OrderID-5fda24bd3730f', '5fda1972e9060', '5fda24aeb7be2', '5fda1a3459c27', 82.80, 'waiting comfirm', '2020-12-16 15:16:13', '2020-12-16 15:16:13'),
('OrderID-5fda2b16ed2cd', '5fda29b6c63e4', '5fda2ae250932', '5fda2b08dcf2b', 82.80, 'waiting receive', '2020-12-16 15:43:18', '2020-12-16 15:44:23'),
('OrderID-5fdab96548903', '5f3cdcd7b7c99', '5fdab95d6793d', '5fa50bd9c407a', 244.00, 'waiting receive', '2020-12-17 01:50:29', '2020-12-17 02:10:47'),
('OrderID-5fdc0e8e75901', '5fdb5ff082420', '5fdc0e4996bff', '5fdc0e7d22e23', 29.50, 'closed', '2020-12-18 02:06:06', '2020-12-18 02:08:34'),
('OrderID-5fdc0f4f577b5', '5fdb5ff082420', '5fdc0f3d8e00a', '5fdc0e7d22e23', 24.99, 'closed', '2020-12-18 02:09:19', '2020-12-18 02:25:19'),
('OrderID-5fe6ce2e15df3', '5f3cdcd7b7c99', '5fe6ce28f3298', '5fa50bd9c407a', 140.00, 'waiting comfirm', '2020-12-26 05:46:22', '2020-12-26 05:46:22'),
('OrderID-5fe6ce6356e16', '5f3cdcd7b7c99', '5fe6ce60608f1', '5fa50bd9c407a', 220.13, 'waiting comfirm', '2020-12-26 05:47:15', '2020-12-26 05:47:15');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` varchar(255) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `paymentMethod` varchar(255) NOT NULL,
  `order_item` int(255) NOT NULL,
  `subtotal` double(10,2) NOT NULL,
  `subtotal_Fee` double(10,2) NOT NULL,
  `Discount_Delivery` double(10,2) NOT NULL,
  `Total` double(10,2) NOT NULL,
  `paypal_payer_id` varchar(255) NOT NULL,
  `paypal_payment_id` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `order_id`, `paymentMethod`, `order_item`, `subtotal`, `subtotal_Fee`, `Discount_Delivery`, `Total`, `paypal_payer_id`, `paypal_payment_id`, `status`, `created_time`, `update_time`) VALUES
('PaymentID-5fba0ce9b87c9', 'OrderID-5fba0ce9b87c8', 'Cash On Delivery', 1, 25.00, 5.00, 0.00, 30.00, '', '', 'unpaid', '2020-11-22 07:02:01', '2020-11-22 07:02:01'),
('PaymentID-5fba0e59f1897', 'OrderID-5fba0e59f1896', 'PayPal', 1, 35.00, 5.00, 0.00, 40.00, '', '', '', '2020-11-22 07:08:09', '2020-11-22 07:08:09'),
('PaymentID-5fba1246ef401', 'OrderID-5fba1246ef400', 'Cash On Delivery', 1, 5.50, 5.00, 0.00, 10.50, '', '', 'unpaid', '2020-11-22 07:24:54', '2020-11-22 07:24:54'),
('PaymentID-5fba12f457235', 'OrderID-5fba12f457234', 'Cash On Delivery', 2, 6.00, 10.00, 0.00, 16.00, '', '', 'unpaid', '2020-11-22 07:27:48', '2020-11-22 07:27:48'),
('PaymentID-5fba7a1479b50', 'OrderID-5fba7a1479b4f', 'Cash On Delivery', 1, 239.00, 5.00, 0.00, 244.00, '', '', 'paid', '2020-11-22 14:47:48', '2020-12-18 02:23:17'),
('PaymentID-5fbe03025a663', 'OrderID-5fbe03025a662', 'Cash On Delivery', 1, 356.00, 5.00, 0.00, 361.00, '', '', 'unpaid', '2020-11-25 07:08:50', '2020-11-25 07:08:50'),
('PaymentID-5fbe59494796f', 'OrderID-5fbe59494796e', 'Cash On Delivery', 1, 10.50, 5.00, 0.00, 15.50, '', '', 'unpaid', '2020-11-25 13:16:57', '2020-11-25 13:16:57'),
('PaymentID-5fbfc95133e08', 'OrderID-5fbfc95133e07', 'Cash On Delivery', 2, 66.60, 10.00, 0.00, 76.60, '', '', 'paid', '2020-11-26 15:27:13', '2020-12-14 05:42:17'),
('PaymentID-5fc25eb76a8bd', 'OrderID-5fc25eb76a8bb', 'Cash On Delivery', 1, 999.00, 5.00, 0.00, 1004.00, '', '', 'unpaid', '2020-11-28 14:29:11', '2020-11-28 14:29:11'),
('PaymentID-5fc25f90a8f49', 'OrderID-5fc25f90a8f48', 'PayPal', 1, 74.90, 5.00, 0.00, 79.90, 'ZL2LBG6HQ436E', 'PAYID-L7BF7QI1Y909320WG336400S', 'paid', '2020-11-28 14:32:48', '2020-11-28 14:34:32'),
('PaymentID-5fcf81e515c23', 'OrderID-5fcf81e515c22', 'PayPal', 1, 35.00, 5.00, 0.00, 40.00, '', '', '', '2020-12-08 13:38:45', '2020-12-21 06:00:01'),
('PaymentID-5fcf82154c4ce', 'OrderID-5fcf82154c4cd', 'Cash On Delivery', 1, 356.00, 5.00, 0.00, 361.00, '', '', 'unpaid', '2020-12-08 13:39:33', '2020-12-08 13:39:33'),
('PaymentID-5fd082af9c73d', 'OrderID-5fd082af9c73c', 'Cash On Delivery', 1, 109.95, 5.00, 0.00, 114.95, '', '', 'unpaid', '2020-12-09 07:54:23', '2020-12-09 07:54:23'),
('PaymentID-5fd5ea9277c65', 'OrderID-5fd5ea9277c64', 'Cash On Delivery', 1, 25.00, 5.00, 0.00, 30.00, '', '', 'unpaid', '2020-12-13 10:18:58', '2020-12-13 10:18:58'),
('PaymentID-5fd76a2001aa3', 'OrderID-5fd76a2001aa0', 'PayPal', 1, 65.00, 5.00, 0.00, 70.00, 'ZL2LBG6HQ436E', 'PAYID-L7LWUQY36D74671CJ764650P', 'paid', '2020-12-14 13:35:28', '2020-12-14 13:36:41'),
('PaymentID-5fd76df0bb0c5', 'OrderID-5fd76df0bb0c3', 'Cash On Delivery', 1, 23.70, 5.00, 0.00, 28.70, '', '', 'unpaid', '2020-12-14 13:51:44', '2020-12-14 13:51:44'),
('PaymentID-5fd9b8c7255e0', 'OrderID-5fd9b8c7255de', 'Cash On Delivery', 1, 1.40, 5.00, 0.00, 6.40, '', '', 'unpaid', '2020-12-16 07:35:35', '2020-12-16 07:35:35'),
('PaymentID-5fd9bd03cf5d1', 'OrderID-5fd9bd03cf5cf', 'PayPal', 1, 65.00, 5.00, 0.00, 70.00, '', '', '', '2020-12-16 07:53:39', '2020-12-16 07:53:39'),
('PaymentID-5fd9bf2f4bc24', 'OrderID-5fd9bf2f4bc23', 'PayPal', 2, 1120.00, 10.00, 0.00, 1130.00, 'ZL2LBG6HQ436E', 'PAYID-L7M43HI56B84788AH931234P', 'paid', '2020-12-16 08:02:55', '2020-12-16 09:52:34'),
('PaymentID-5fda1ab73b4e6', 'OrderID-5fda1ab73b4e5', 'PayPal', 1, 1.40, 5.00, 0.00, 6.40, 'ZL2LBG6HQ436E', 'PAYID-L7NBVVA4N51105220607654J', 'paid', '2020-12-16 14:33:27', '2020-12-16 14:35:08'),
('PaymentID-5fda1bb2d3876', 'OrderID-5fda1bb2d3875', 'Cash On Delivery', 1, 4.00, 5.00, 0.50, 8.50, '', '', 'paid', '2020-12-16 14:37:38', '2020-12-16 14:57:30'),
('PaymentID-5fda24bd37311', 'OrderID-5fda24bd3730f', 'Cash On Delivery', 1, 77.80, 5.00, 0.00, 82.80, '', '', 'unpaid', '2020-12-16 15:16:13', '2020-12-16 15:16:13'),
('PaymentID-5fda2b16ed2ce', 'OrderID-5fda2b16ed2cd', 'Cash On Delivery', 1, 77.80, 5.00, 0.00, 82.80, '', '', 'unpaid', '2020-12-16 15:43:18', '2020-12-16 15:43:18'),
('PaymentID-5fdab96548904', 'OrderID-5fdab96548903', 'Cash On Delivery', 1, 239.00, 5.00, 0.00, 244.00, '', '', 'unpaid', '2020-12-17 01:50:29', '2020-12-17 01:50:29'),
('PaymentID-5fdc0e8e75902', 'OrderID-5fdc0e8e75901', 'PayPal', 1, 25.00, 5.00, 0.50, 29.50, 'ZL2LBG6HQ436E', 'PAYID-L7OA5MQ22G809054L642611J', 'paid', '2020-12-18 02:06:06', '2020-12-18 02:07:13'),
('PaymentID-5fdc0f4f577b6', 'OrderID-5fdc0f4f577b5', 'Cash On Delivery', 1, 19.99, 5.00, 0.00, 24.99, '', '', 'paid', '2020-12-18 02:09:19', '2020-12-18 02:25:00'),
('PaymentID-5fe6ce2e15df4', 'OrderID-5fe6ce2e15df3', 'Cash On Delivery', 3, 125.00, 15.00, 0.00, 140.00, '', '', 'unpaid', '2020-12-26 05:46:22', '2020-12-26 05:46:22'),
('PaymentID-5fe6ce6356e17', 'OrderID-5fe6ce6356e16', 'Cash On Delivery', 2, 210.13, 10.00, 0.00, 220.13, '', '', 'unpaid', '2020-12-26 05:47:15', '2020-12-26 05:47:15');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` double(10,2) NOT NULL,
  `description` text NOT NULL,
  `coverImage` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `material` varchar(255) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `soldRecord` int(255) NOT NULL,
  `sellerId` varchar(255) NOT NULL,
  `InventoryId` varchar(255) NOT NULL,
  `categoryId` varchar(255) NOT NULL,
  `auctionStatus` varchar(255) NOT NULL,
  `auctionId` varchar(255) NOT NULL,
  `auctionDueDate` datetime NOT NULL,
  `date` date NOT NULL,
  `imagesId` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `auctionEnd` varchar(255) NOT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `uploadTime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `description`, `coverImage`, `color`, `brand`, `material`, `gender`, `soldRecord`, `sellerId`, `InventoryId`, `categoryId`, `auctionStatus`, `auctionId`, `auctionDueDate`, `date`, `imagesId`, `status`, `auctionEnd`, `created_time`, `uploadTime`) VALUES
('5f4bab92de8da', 'Hush Puppies Ladies Logo V Neck Tee | HLT003009', 25.00, '<p><span style=\"font-family: \'arial black\', sans-serif;\"><em><strong>Hush Puppies </strong></em></span></p>\r\n<p><span style=\"font-family: \'times new roman\', times, serif;\">- Ladies V Neck Tee A perfect, clean-fitting staple in soft and comfortable cotton jersey. Works great with a variety of everyday looks 1 piece pack <strong>100%</strong> cotton Trendy relaxed fit Wash Instructions Shipping Size Guide Machine wash cold with like colours. Do not bleach. Tumble dry no heat.</span></p>', 'Hush Puppies - Ladies Signature Logo Polo Tee1.png', 'red', 'Hush Puppies', 'Cotton', 'female', 3, '1', '5f4bab92de8dc', '4', 'no', '', '0000-00-00 00:00:00', '0000-00-00', '5f4bab92de8db', '', '', '2020-11-13 06:51:03', '2020-12-16 14:44:50'),
('5f4bacacca947', 'Hush Puppies - Ladies Signature Logo Polo Tee | HLP008889', 65.00, 'Hush Puppies - Ladies Signature Logo Polo Tee\r\n1 piece of polo tee\r\n100% Cotton\r\nOur essential staple in soft & comfortable cotton.  This updated design is great for dressy occasions or casual wear.\r\n\r\nMachine wash cold with like colours. Do not bleach. Tumble dry no heat.\r\n\r\nDISCLAIMER\r\nActual colours may vary. This is due to the fact that every computer monitor has a different capability to display colours and that everyone sees these colours differently. We try to edit our photos to show the samples as life-like as possible, but please understand the actual colour may vary slightly from your monitor. We cannot guarantee that the colour you see accurately portrays the true colour of the product.', 'Hush Puppies - Ladies Signature Logo Polo Tee  3.png', 'yellow', 'Hush Puppies', 'Cotton', 'female', 0, '1', '5f4bacacca94a', '4', 'no', '', '0000-00-00 00:00:00', '0000-00-00', '5f4bacacca949', '', '', '2020-11-13 06:51:03', '2020-12-26 06:03:07'),
('5f4bc4ad14736', 'Levi\'s Women\'s Slim Crewneck Tee 32223-0144', 79.00, 'Welcome to Levi\'s Outlet Official Store where we strive to provide our customers an array of products that satisfy demand for quality and efficiency. Buy our products from Masamon Mall in a worry-free manner as we guarantee 100% authenticity. Shopping can\'t get any easier than this, so start today!\r\n  \r\n  A slim-fitting tee shows off your shape every day.\r\n  \r\n  Slim fit\r\n  Crew neck\r\n  Short sleeves\r\n  Jersey\r\n  100% Cotton', 'Levi\'s Women\'s Slim Crewneck Tee 1.jpg', 'white', 'Levi\'s', 'cotton', 'female', 1, '1', '5f4bc4ad14751', '4', 'no', '', '0000-00-00 00:00:00', '0000-00-00', '5f4bc4ad14750', '', '', '2020-11-13 06:51:03', '2020-08-30 15:24:29'),
('5f4bc6c7d9df0', 'Levi\'s Women\'s Slim Crew Logo Tee 32223-0457', 79.00, 'Levi\'sÂ® t-shirts and denim were made for each other. This slim-fitting crew features a logo graphic at the front.\r\n\r\n- Slim fit\r\n- Crewneck\r\n- Short sleeves\r\n- Screen-printed logo graphic at front\r\n- 100% Cotton', 'Levi\'s Women\'s Slim Crew Logo Tee 1.jpg', 'white', 'Levi\'s', 'Cotton', 'female', 0, '1', '5f4bc6c7d9df3', '4', 'no', '', '0000-00-00 00:00:00', '0000-00-00', '5f4bc6c7d9df2', '', '', '2020-11-13 06:51:03', '2020-08-30 15:33:28'),
('5f4bc8579d021', 'G2000 Suit Jacket Women OL Office Stylish Plain Blazer Polyester 00710002', 409.00, 'Product Information:\r\n1. Brand: G2000\r\n2. Color: Black/99, Dark Grey/98\r\n3. Size: XS, S, M, L, XL, XXL\r\n4. What\'s in the box: 1 PC Women\'s Suit Jacket  \r\n5. Material: Polyester 75% Viscose fibre 19% Polyurethane elastic fiber (Spandex) 6%\r\n\r\n\r\nNotes:\r\n1. The pictures of G2000 are all taken by professional photographers. Due to the color difference of different display equipments and the color difference caused by shooting lights, etc., color difference cannot be avoided. This is not a quality issue.Hope your understanding.\r\n2. We are the official flagship store of G2000, and all the products we sell are genuine products.\r\n\r\nShipping:\r\n1) We will ship items from China;\r\n2) We use Shopee Standard Express to deliver the parcels to you, it will take around 7-15 days to ship it to you.\r\n3) We will ship your parcels to Shopee sorting centre within 3 working days.\r\n4) If you have some questions about the shipping, please contact us! Thank you!\r\n\r\n#G2000 #G2000Suit', 'G2000 Suit Jacket Women OL Office Stylish Plain Blazer Polyester 1.jpg', 'Black', 'G2000', ' Polyester', 'female', 0, '1', '5f4bc8579d024', '4', 'no', '', '0000-00-00 00:00:00', '0000-00-00', '5f4bc8579d023', '', '', '2020-11-13 06:51:03', '2020-12-02 23:59:43'),
('5f4bca07ce4ed', 'New Balance Women\'s Apparel - Graphic Heathertech Tee-Shirt (Peach)', 131.13, 'Break out in style in our Graphic Heathertech Tee. Made with smooth, sweat-wicking fabric, it delivers the superior softness, the performance features you need and a modern race day look. Plus, a colorful design and reflective logo helps you feel seen on race day.', 'New Balance Women\'s Apparel - Graphic Heathertech Tee-Shirt 1.jpg', 'Brown', 'New Balance', ' Polyester', 'female', 1, '1', '5f4bca07ce4f0', '4', 'no', '', '0000-00-00 00:00:00', '0000-00-00', '5f4bca07ce4ef', '', '', '2020-11-13 06:51:03', '2020-08-30 15:47:20'),
('5f4c7cc46ecc1', 'HYPE Seasonal Rebel Tee', 74.90, 'Established back in 2012 in Malaysia, HYPE Clothing CO. found its name based on the rich variant of evergreen classic-modern American subculture and also the ambitious people behind the brand.  HYPE fosters its definition by the quick widespread of the classic American subculture to the whole wide world during the founding and the prime of its era.  Parallel to the nature of the subculture popularity with the huge and lasting effect on the followers, the label cultivates the ambition to grow as big, spread as quickly and stays as timeless as the aforementioned subculture.\r\n\r\n100% Cotton\r\nSignature Label\r\nRegular Fit\r\nAsian Cutting', 'HYPE Seasonal Rebel Tee 6.jpg', 'Black', 'HYPE', 'cotton', 'men', 0, '1', '5f4c7cc46ecc4', '0', 'no', '', '0000-00-00 00:00:00', '0000-00-00', '<br />\r\n<b>Notice</b>:  Undefined variable: goodsImagesId in <b>C:xampphtdocs	estProjectsellercreateProduct.php</b> on line <b>727</b><br />\r\n', '', '', '2020-11-13 06:51:03', '2020-08-31 04:29:56'),
('5f4c7e4b105f3', 'Navy & Navy Men\'s Basic Polo Tees', 35.00, 'Welcome to F.O.S where we strive to provide our customers with an array of products that satisfy the demand for quality and efficiency. Buy our products from the F.O.S website in a worry-free manner as we guarantee 100% authenticity. Shopping cant get any easier than this, so start today!!!\r\n\r\nSoft & comfortable cotton\r\nShort sleeve\r\nCollared neck\r\nFitted through body\r\nHave button placket at the front panel', 'Navy & Navy Men\'s Basic Polo Tees 1.jpg', 'DarkBlue', 'Navy & Navy', 'cotton', 'men', 1, '1', '5f4c7e4b105f7', '0', 'no', '', '0000-00-00 00:00:00', '0000-00-00', '5f4c7e4b105f6', '', '', '2020-11-13 06:51:03', '2020-08-31 04:36:27'),
('5f4c8428880fc', 'Embroidery Small Polo Logo Polo T-Shirt for Men/Women with regular cutting', 19.99, 'ondition -New without tags\r\nHoney comb Material\r\n100% PREMIUM COTTON\r\nSIZE XS-XXXL\r\nUNISEX\r\nSUPERIOR EMBROIDERY\r\n200GSM premium\r\nMETALI THREAD\r\nDOUBLE STITCHING\r\nShort Sleeve Length\r\nSolid pattern', 'Embroidery Small Polo Logo Polo 1.jpg', 'Black', 'No Brand', 'cotton', 'men', 1, '1', '5f4c8428880ff', '0', 'no', '', '0000-00-00 00:00:00', '0000-00-00', '5f4c8428880fe', '', '', '2020-11-13 06:51:03', '2020-08-31 05:01:29'),
('5f4c85cad22a6', 'Fashion Men\'S Korean Slim Fit Men Long Jeans Skinny Denim Jeans Pant', 19.83, '100% New Brand.\r\nGood Quality with Competitive Price.\r\nPls choose size and color in variety selection parts.\r\nAny other thing I can do to help pls do not hesitate to contact me!\r\nThank you !!!\r\nHere is the product description for your reference.\r\n\r\nSize --- as picture\r\n\r\nFit Type: Skinny\r\nSeason: All-Year\r\nClosure Type: Zipper Fly\r\n\r\n\r\n Note:\r\n 1. Due to the difference between different monitors, the picture may not reflect the actual color of the item. We guarantee the style is the same as shown in the pictures, but not the same performance on different bodies as on the model.\r\n 2. Compare the detail sizes with yours,please allow 1-3cm differs due to manual measurement, thanks. \r\n \r\n 3. We suggest that clients take the measurement chart as a reference to choose the most suitable size according to the specific size of the product.\r\n\r\n\r\n#men #man #male #menswear #work #business #office #working #adult #leather #ootd #clothing #wallet #hot #sale #hotselling #promotion', 'Fashion Men\'S Korean Slim Fit Men Long Jeans Skinny 1.jpg', 'Blue', 'No Brand', 'Denim', 'men', 0, '1', '5f4c85cad22a9', '0', 'no', '', '0000-00-00 00:00:00', '0000-00-00', '5f4c85cad22a8', '', '', '2020-11-13 06:51:03', '2020-08-31 05:08:27'),
('5f4c873f1e7c6', 'Men Formal Business Meeting Straight Solid Slacks Pants Mid Rise Slim Fit', 28.79, '*Soft, breathable and skin friendly. Wrinkle and Pilling resistant. \r\n*Not easily fade. Straight Leg, Mid Rise.\r\n*Bussiness/casual pants perfectly matched with casual / formal polo , T-shirt and etc\r\n\r\nMaterial:Cotton Blend\r\nColorï¼šKhaki/ Black/  Gray\r\nPackage Included:1 Ã— Men\'s Trousers\r\n\r\nNote:\r\nPlease Allow 2-3 cm Difference Due To Manual Measurement.\r\nBesides Different Computers Display Colors Differently, The\r\nColor Of The Actual Item May Vary Slightly From The Below\r\nImages, Thanks For Your Understanding(1 inch = 2.54 cm)', 'Men Formal Business Meeting Straight Solid Slacks Pants 1.jpg', 'Brown', 'No Brand', ' Cotton', 'men', 0, '1', '5f4c873f1e7c9', '0', 'no', '', '0000-00-00 00:00:00', '0000-00-00', '5f4c873f1e7c8', '', '', '2020-11-13 06:51:03', '2020-08-31 05:14:39'),
('5f4c89ada196f', 'Calvin Klein CK Men Monogram Texture Square Billfold Wallet HP1432U8400001 BLACK BLACK', 210.00, 'This billfold wallet from Calvin Klein Jeans features a sophisticated grain texture and multiple card and bill slots. Finished with an embossed logo clip at the top.Calvin Klein Jeans billfold wallet  . Multiple card and bill slots  . Tonal topstitching  . Smooth CK monogram applique .  SHELL:100% SHEEP LEATHER TRIM:100% SHEEP . 10L x 8.5W x 1.5H cm .3.9L x 3.3W x 0.6H inch', 'Calvin Klein CK Men Monogram 1.jpg', 'Black', 'Calvin Klein CK', 'Leather', 'men', 0, '1', '5f4c89ada1972', '5', 'no', '', '0000-00-00 00:00:00', '0000-00-00', '5f4c89ada1971', '', '', '2020-11-13 06:51:03', '2020-08-31 05:25:01'),
('5f4c908adca06', 'Renoma Men\'s Chest Bag 1965022-02', 119.50, 'Renoma Men\'s Chest Bag 1965022-02\r\n\r\nColor: Black and Blue\r\nMaterial: Nylon\r\nMeasurement: (L) 18cm X (W) 8cm  X (H) 32cm \r\n\r\n- Lining : Polyester\r\n- 1 Exterior front zip pocket\r\n- 1 interior slip pocket \r\n- 1 interior zip pocket\r\n- Adjustable shoulder strap can move left or right to wear on either shoulder\r\n- Non Detachable shoulder strap', 'Renoma Men\'s Chest Bag 1.jpg', 'Blue', 'Renoma', 'Nylon', 'men', 0, '1', '5f4c908adca09', '5', 'no', '', '0000-00-00 00:00:00', '0000-00-00', '5f4c908adca08', '', '', '2020-11-13 06:51:03', '2020-08-31 05:54:19'),
('5f4c928888bd5', 'Bonia Chariot Messenger Bag M - Black', 942.00, 'Aside from a cavernous body, both soft, and pliable leather from BONIA Chariot Collection is a burst of high-street fashion. Versatile and seasonally appropriate in classic black; nothing beats leather when it comes to sophistication. But when presented with a stealth design motif of a chariot; the overall collection is a welcome change for this season! Fingers crossed that it stays!\r\n\r\n2 Pockets\r\n2 Zip Pockets\r\nLeather Type: Top Grain Calf Leather \r\nMaterial Type: Soft\r\nLogo Type: Metal Logo\r\nAccessories Type: Nickle \r\nLining Type: Monogram\r\n24.5cm (L) x 27.5cm (H) x 6cm (W)', 'Bonia Chariot Messenger Bag 1.jpg', 'Black', 'Bonia', ' Leather', 'men', 90, '1', '5f4c928888bd8', '5', 'no', '', '0000-00-00 00:00:00', '0000-00-00', '5f4c928888bd7', '', '', '2020-11-13 06:51:03', '2020-08-31 06:02:48'),
('5f4c935ae05df', 'Bonia Aria Backpack S - Black', 779.40, '<p>The dramatic mix of high arias and a tribal beat was the perfect pairing for BONIA\'s Aria collection. Capturing vast swathes of melody across multiples genres, oratorios, cantatas and musicals; the Aria collection is classically rhythmic. In particular, this design range encompasses a divergent of swoon-worthy colors. Defined by the emotional content rather than their musical form; either independent of forming part of an Opera, the collection is also charismatically designed to display the virtues of an Opera singer. All in all, the collection is a stylish extension from the Aria Monogram Collection. 2 Pockets 1 Zip Pocket 1 Key Hook 1 Card Slot 2 External Zipper Compartment Leather Type: Top Grain Calf Leather Material Type: Soft Logo Type: Metal Logo Accessories Type: Gold Lining Type: Logo Straps: Single Handle &amp; Non-Detachable, Adjustable Shoulder Strap 20.4cm (L) x 23.5cm (H) x 9cm (W)</p>', 'Bonia Aria Backpack 1.jpg', 'Black', 'Bonia', 'Leather', 'female', 0, '1', '5f4c935ae0618', '17', 'no', '', '0000-00-00 00:00:00', '0000-00-00', '5f4c935ae0617', '', '', '2020-11-13 06:51:03', '2020-12-03 03:06:23'),
('5f4c94e4b85d0', 'Case Valker Fashion Gorgeous ABS Hard Case 3 in 1 Luggage Bag Set (28', 259.00, '\"A Trolley luggage is a travelerâ€™s best friend.\"\r\nThey are an easy convenient way to carry your belongings around without having to lug it around in an unhealthy manner. The trolley enables you to move from one place to another without having to lift your luggage. All you need is a little effort to pull it around without hurting your spine.\r\n\r\nRetractable Handle\r\nProvide easy maneuverability when extended out from our suitcase, and store neatly inside when not in use. Locks in place in both the fully extended and stored positions for secure travelling.\r\n\r\n360 Silent Spinner Wheels\r\nQuiet-rolling dual spinner wheels offers effortless maneuverability while travelling.\r\n\r\n3 Digit Combination Lock\r\nProvides luggage additional peace of mind when checking belongings.\r\n\r\nSide Carry Handle\r\nSelf-retracting side carry handles stays flush to the case to protect against damage.\r\n\r\nPremium Compartment Design\r\nSpacious packing compartments feature elastic cross straps custom designed to match exterior and zipped divider panel.\r\n\r\nSpecifications:\r\nSize\r\n20\"(inches) -- Â± 39cm(L) X 23cm(W) X 56cm(H)\r\n24\"(inches) -- Â± 46cm(L) X 26cm(W) X 66cm(H)\r\n28\"(inches) -- Â± 52cm(L) X 30cm(W) X 78cm(H)\r\n \r\nWeight\r\n20\"(inches) -- Â± 2.6kg\r\n24\"(inches) -- Â± 3.1kg\r\n28\"(inches) -- Â± 4.1kg\r\n20\"+24\"+28\"(inches) -- Â± 9.8kg\r\n\r\nWarranty by Case Valker\r\n\r\n1 year parts warranty [Wheel, Lock and Handle] upon manufacturing defect from date of receive.\r\nFor warranty claims:\r\nSTEP 1: Email Voxtera at warranty@voxtera.com and provide the following details:\r\n- Name\r\n- Contact number\r\n- Delivery address\r\n- Purchase Order number\r\n- Problem\r\nSTEP 2: Upon confirmation, a mailing address will be provided.\r\nSTEP 3: Faulty products must be delivered in its original packaging (including accessories, manuals, and documentation) to Voxtera.\r\nDelivery costs for warranty claim / return / repair covered by customer.\r\nCase Valker will cover delivery costs of replacement or repaired product to customer.\r\nPrinted receipt will be required as proof of purchase.\r\nWarranty claims which do not fulfil the steps above will not be processed due to missing information.\r\n\r\nContact us:\r\nTel : 03-8066 9555\r\nWhatsapp : 016-666 0918\r\nAddress: 576, Jalan 2C\r\nKampung Baru Subang \r\nSeksyen U6, 40150 Shah Alam\r\nSelangor.\r\n\r\n#casevalker #luggage #Suitecase #lugageSet #Travel #luggagebag #bag #pouch #accessories #freeknight #backpackStylish\r\nProduct Ratings\r\nNo ratings yet\r\nShop Vouchers\r\nRM2 off Min. Spend RM30\r\nValid Till 09-09-2020\r\nClaim\r\nRM2 off Min. Spend RM30\r\nValid Till 09-09-2020\r\nClaim\r\n10% off Min. Spend RM60 Capped at RM10\r\nValid Till 09-09-2020\r\nClaim\r\nSee More', 'Case Valker Fashion Gorgeous 1.jpg', 'orange', 'Case Valker', 'ABS', 'none', 0, '1', '5f4c94e4b85d3', '13', 'no', '', '0000-00-00 00:00:00', '0000-00-00', '<br />\r\n<b>Notice</b>:  Undefined variable: goodsImagesId in <b>C:xampphtdocs	estProjectsellercreateProduct.php</b> on line <b>727</b><br />\r\n', '', '', '2020-11-13 06:51:03', '2020-08-31 06:12:53'),
('5f4c96294319d', ' AR by Alfio Raldo Black Lattice Diamond Shape Quilted Shoulder Bag with Adjustable Handle Strap', 95.00, 'Welcome to Alfio Raldo where we strive to provide our customers an array of products that satisfy demand for quality and efficiency. Buy our products in a worry-free manner as we guarantee 100% authenticity. All products are directly shipped from Alfio Raldo Warehouse in Kajang, Malaysia. Shopping can\'t get any easier than this, so shop today!\r\n\r\nQuilted bag by Alfio Raldo help you to look stylish throught out of the day.  Suit both casual and formal wear with Alfio Raldo durable, valuable and long-lasting bag for working or gathering with you closer friends and family.\r\n\r\nPRODUCT CODE: <AB-2553>\r\nâ˜…â˜…Ready Stockâ˜…â˜…\r\nâ˜…All our products are genuine and authentic Alfio Raldo Brand.â˜…\r\nâ˜…Directly shipped from Alfio Raldo Warehouse in Kajang, Malaysia.â˜…\r\n\r\nHANDBAG TYPE\r\nQuilted bag, Shoulder bag, Casual bag\r\n\r\nCOLOR\r\n Black, Khaki\r\n\r\nSIZE \r\n28cm (L) x 11cm (W) x 28cm (H)\r\n\r\nWEIGHT\r\n600g\r\n\r\nMATERIAL\r\nSynthetic Leather\r\n\r\nCAPACITY\r\nMobile phone, wallet, cosmetics, keys, glasses, lipstick, bottle\r\n\r\nSTYLE\r\nCasual, Elegant, Formal\r\n\r\nOCCASION\r\nCasual, Beaches, Shopping, Dating, Party, Office\r\n\r\nFeature:\r\n1. Magazine Pocket with gold twist lock.\r\n2. Detachable and adjustable leather strap.\r\n3. Flat bottom and roomy interior\r\n4. 1 fully zipper compartment\r\n5. 1 front slot\r\n6. 1 small bag.\r\n\r\nNote:\r\n1. Colour may vary from actual due to lighting and different monitor\r\n2. All measurements are approximate and for reference only.\r\n3. Any inaccuracy is regretted.\r\n\r\n#new #readystore #girl #women #bag #shoulderbag #shopperbag #casualbag #black #casual #beaches #shopping #dating #party #office #ootd #ootdwomen #elegant #formal\r\n\r\nALFIO RALDO offers a wide range of stylish handbag to suit every age group. You can choose Stylish tote bag, sling bag, shopper bag, crossbody bag, shoulder bag, backpack bag, quilted bag, travel bag, clutch and match them with our comfortable heels, sandals, casual shoes, office shoes,kitten heels, block heels, mule heels, cut-out heels, platform heels, wedge heels, loafers, pump shoes, slip-on, sneakers, sparkly shoes and wedding shoes.\r\n\r\nYou can also find our products on online stores such as Masamon,Shopee, Zalora, Lazada, LazMall, PrestoMall, Youbeli and Goshop. You want to try out our products?? Try them in Parkson, Isetan or MetroJaya at popular malls like MidValley, One Utama, The Garden, Brem Mall, Kluang Parade, Square One Mall, OUG Plaza, IOI City Mall, Da Men, Aman Central, Subang Parade, Setapak Central, Kuantan City Mall, Suria Sabah KK.\r\n\r\nAbout Us: \r\nALFIO RALDO is one of Malaysiaâ€™s Top Favourite Brands in Fashionable and Elegant Ladies HandBags and Footwear. \r\nALFIO RALDO was established in 1989 and since then ALFIO RALDO has been striving to deliver the best fashionable products to make our customers look their best. \r\nFollow our Facebook page @alfio.raldo.the.italian.elemgance\r\nFollow us on Instagram @alfio.raldo.official', 'Alfio Raldo Black Lattice Diamond 2.jpg', 'Brown', 'Alfio Raldo', ' Synthetic Leather', 'female', 0, '1', '5f4c9629431a1', '17', 'no', '', '0000-00-00 00:00:00', '0000-00-00', '5f4c9629431a0', '', '', '2020-11-13 06:51:03', '2020-08-31 06:18:17'),
('5f4c98b5e36e7', 'Alfio Raldo Women Fashion Stylish Black Kitten Pump Heel with Single Buckle Detail', 68.00, 'Welcome to Alfio Raldo where we strive to provide our customers an array of products that satisfy demand for quality and efficiency. Buy our products from Masamon Online Mall in a worry-free manner as we guarantee 100% authenticity. Shopping can\'t get any easier than this, so start today!\r\n\r\nAll day comfortable and fashion kitten heel shoes by Alfio Raldo help you to look stylish throught out the day. Fit with casual clothes or stylish and fashion dresses or either business attire while working.\r\n\r\nPRODUCT CODE: <SL 12669>\r\nâ˜…â˜…Ready Stockâ˜…â˜…\r\nâ˜…All our products are genuine and authentic Alfio Raldo Brand.â˜…\r\nâ˜…Directly shipped from Alfio Raldo Warehouse in Kajang, Malaysia.â˜…\r\n\r\nSHOES TYPE\r\nKitten heel\r\n\r\nCOLOR\r\nBlack, Beige, Yellow\r\n\r\nSIZE AVAILABLE\r\n35, 36, 37, 38, 39, 40 (35 - 40)\r\n\r\nHEEL HEIGHT\r\n3 cm\r\n\r\nMATERIAL\r\nSynthetic (Inner), PU Leather (Outer), Polyurethane (Sole)\r\n\r\nTOE SHAPE\r\nPointed toe\r\n\r\nSTYLE\r\nCasual, Elegant, Formal, Simple, Plain, Sweet\r\n\r\nFUNCTION\r\nBreathable, Soft, Comfortable, Durable\r\n\r\nOCCASION\r\nCasual, Leisure, Office\r\n \r\n1. Measurement in centimeter (cm) in size of UK, US and Europe as it offer higher accuracy.\r\n2. Start measure from the tip of your longest toe till the back of your heel.\r\nFor getting the right size, please click on the size guides link: https://shopee.com.my/m/shoes-size-guides\r\n\r\nNote:\r\n1. Colour may vary from actual due to lighting and different monitor\r\n2. Measurement may vary due to different producting batches.\r\n3. All measurements are approximate and for reference only.\r\n4. Any inaccuracy is regretted.\r\n\r\n#new #readystore #girl #shoes #sandal #women #casual #leisure #office #heel #kittenheels #pumpheels #pointedtoe #outdoorshoes #fashion #elegant #formal #simple #plain #sweet #koreanstyle #comfortable #soft #durable \r\n\r\nALFIO RALDO offers a wide range of stylish handbag to suit every age group. You can choose Stylish tote bag, sling bag, shopper bag, crossbody bag, shoulder bag, backpack bag, quilted bag, travel bag, clutch and match them with our comfortable heels, sandals, casual shoes, office shoes,kitten heels, block heels, mule heels, cut-out heels, platform heels, wedge heels, loafers, pump shoes, slip-on, sneakers, sparkly shoes and wedding shoes.\r\n\r\nYou can also find our products on online stores such as Masamon, Shopee, Zalora, Lazada, LazMall, PrestoMall, Youbeli and Goshop. You want to try out our products?? Try them in Parkson, Isetan or MetroJaya at popular malls like MidValley, One Utama, The Garden, Brem Mall, Kluang Parade, Square One Mall, OUG Plaza, IOI City Mall, Da Men, Aman Central, Subang Parade, Setapak Central, Kuantan City Mall, Suria Sabah KK.\r\n\r\nAbout Us: \r\nALFIO RALDO is one of Malaysiaâ€™s Top Favourite Brands in Fashionable and Elegant Ladies HandBags and Footwear. \r\nALFIO RALDO was established in 1989 and since then ALFIO RALDO has been striving to deliver the best fashionable products to make our customers look their best. \r\nFollow our Facebook page @alfio.raldo.the.italian.elemgance\r\nFollow us on Instagram @alfio.raldo.official', 'Alfio Raldo Women Fashion Stylish 2.jpg', 'white', 'Alfio Raldo', 'PU Leather', 'men', 0, '1', '5f4c98b5e36ea', '10', 'no', '', '0000-00-00 00:00:00', '0000-00-00', '5f4c98b5e36e9', '', '', '2020-11-13 06:51:03', '2020-08-31 06:29:10'),
('5f4c9a1065182', 'Bonia Black Milagros Crossbody Bag', 674.25, 'The Milagros Collection is a true beauty as exemplified by its black and brown monogram faÃ§ade. Most importantly, they add a fresh elegance to your everyday bag and give out a great fashion forward appeal thatâ€™s distinctively reflected by its immaculate design. For a timeless look and heirloom-quality construction, you can opt for either a satchel, sling bag or even a crossbody bag.\r\n\r\n4 Pockets\r\n1 Zip Pocket\r\n1 Key Hook\r\n1 Card Slot\r\nLeather Type: Top Grain Calf Leather \r\nMaterial Type: Soft\r\nLogo Type: Metal Logo\r\nAccessories Type: Gold \r\nLining Type: Logo \r\nStraps: Detachable &amp; Adjustable Shoulder Strap\r\n31cm (L) Ã— 17cm (H) Ã— 7.5cm (W)\r\nBonia-860250-011a-08', 'Bonia Black Milagros Crossbody 3.jpg', 'Brown', 'Bonia', 'Leather', 'female', 0, '1', '5f4c9a1065185', '17', 'no', '', '0000-00-00 00:00:00', '0000-00-00', '5f4c9a1065184', '', '', '2020-11-13 06:51:03', '2020-08-31 06:34:56'),
('5f4c9ab931b56', 'Bonia Rose Gold And Silver White Chiaro Men\'s Watch', 598.00, 'Designed to uplift, BONIA\'s Chiaro Collection is a mesmerizing blend of impeccable design and fashionable watchmaking. Gently gracing your wrist is its elegant fine mesh strap, offset by the luxurious Sapphire Crystal glass. Uncompromisingly beautiful, this timepiece is made to be gifted, and worn with love.\r\n\r\nCase Material: Stainless Steel \r\nBracelet Material: Stainless Steel \r\nDial: 12-Hour Dial  \r\nBuckle: Stainless Steel\r\nCrystal: Sapphire Crystal\r\nFunction: 3 Hands (Hour, Minute &amp; Second) + Date \r\nMovement: GM10- S0Z \r\nWater Resistance: 3 ATM\r\nCase Dimension: 41mm (3-9)/47.5mm (12-6)\r\nBracelet Size: 20x18mm \r\nDial Opening: 34.5mm\r\nCrown Size: 4.5mm\r\nTB10548-1512', 'Bonia Rose Gold And Silver 5.jpg', 'white', 'Bonia', 'Stainless Steel', 'female', 0, '1', '5f4c9ab931b58', '11', 'no', '', '0000-00-00 00:00:00', '0000-00-00', '5f4c9ab931b57', '', '', '2020-11-13 06:51:03', '2020-08-31 06:37:45'),
('5f4c9bd15cd5f', 'PLAYBOY GENUINE LEATHER RFID BI-FOLD WALLET PW 230-3 BLACK', 109.95, 'Welcome to PLAYBOY OFFICIAL SHOP where we strive to provide our customers an array of products that satisfy demand for quality and efficiency. Buy our products from Masamon Online Mall in a worry-free manner as we guarantee 100% authenticity. Shopping can\'t get any easier than this, so start today!\r\n\r\n- Genuine Leather\r\n- 2 Cash compartments\r\n- 2 Receipt slots\r\n- 8 Card slots\r\n- RFID Blocking Technology\r\n- SIZE (L x H x W) : 12 x 9.7 x 2.5\r\n\r\n**Please allow 1-2cm variance for the measurements as it\'s manually measured. =) **', 'PLAYBOY GENUINE LEATHER 1.jpg', 'Black', 'PLAYBOY', 'Genuine Leather', 'men', 0, '1', '5f4c9bd15cd65', '5', 'no', '', '0000-00-00 00:00:00', '0000-00-00', '5f4c9bd15cd64', '', '', '2020-11-13 06:51:03', '2020-08-31 06:42:25'),
('5f4c9cf7adf70', 'Rav Design Men\'s Genuine Leather with Canvas Multi Compartment Travel Pouch |RVP417C0', 39.90, 'RAV an abbreviation for â€˜Rugged, Adventurous and Vibrantâ€™, was designed to be tough, durable and everlasting. RAV DESIGN is a fashion brand founded in MALAYSIA back in year 2000, we promised quality and affordability in all our products.\r\nBuy our products from Masamon Online Mall in a worry-free manner as we guarantee 100% authenticity. Shopping can\'t get any easier than this, so start today! All our product is ready stock.\r\n\r\nSize:\r\nLength: 21cm X Height: 15cm X Width: 3cm\r\n\r\nNotes: \r\n1. The product pictures are taken according to the actual objects. Due to the lighting reasons, there may be some color errors.. We guarantee the style is structure the same as shown in the pictures. \r\n2. Due to personal measurement technique is different, there may be 1-3 cm error of the physical.Thank you!\r\n\r\n#manfashion #men #largevolume #clutch #waterresistance #shoppingroll #ravdesign #sale #brand #pouch', 'Rav Design Men\'s Genuine Leather 1.jpg', 'Brown', 'Rav', 'Canvas', 'men', 0, '1', '5f4c9cf7adf72', '5', 'no', '', '0000-00-00 00:00:00', '0000-00-00', '5f4c9cf7adf71', '', '', '2020-11-13 06:51:03', '2020-08-31 06:47:19'),
('5f4c9e34ce270', 'Renoma Men - Business 19648-0014', 199.50, '-Code: 19648-0014-08\r\n-Color: Black\r\n-Upper Material: Microfiber\r\n-Insole Material: PU\r\n-Outsole Material: Renoma Outsole Design\r\n\r\n\r\n1X PRS Renoma Men\'s Shoes\r\n\r\nFast Shipping\r\nReady Stock in Malaysia\r\n100% Local Malaysia Company', 'Renoma Men - Business 1.jpg', 'Black', 'Renoma', 'Microfiber', 'men', 0, '1', '5f4c9e34ce28d', '12', 'no', '', '0000-00-00 00:00:00', '0000-00-00', '5f4c9e34ce28c', '', '', '2020-11-13 06:51:03', '2020-08-31 06:52:37'),
('5f4ca33f217a4', 'TARGUS BP SOL-LITE 15.6 Inch - BLACK + + 3 FREEGIFTS', 239.00, '15.6\" Sol-Lite Backpack (Black)\r\nA light weight lifestyle E.D.C. (Every Day Carry) backpack range for daily city commute and travel. With new energetic CMF, the range offers a lightweight, ergonomic and easy access solution.\r\n\r\nErgonomics\r\nWide adjustable padded shoulder straps design helps to evenly distribute the load and fits various body sizes\r\nSmart breathable air channel foam structure design improves air circulation, resulting in optimum back ventilation as well as back support\r\nAdjustable sternum strap keeps shoulder straps in comfortable position while the backpack is loaded\r\n\r\nLightweight \r\nPolyester Ripstop\r\nWater repellent finish with TPE backing\r\nWeighs less than 0.90kg\r\n\r\nEasy Access \r\nTwo EASY ACCESS concept designs for different preference\r\nAllow main compartment to open wide for easy retrieval of personal items\r\nMultiple zippered pocket for quick access to your tech and gear\r\n\r\nUsage Convenience\r\nDual handle design as an alternative carrying solution\r\nHidden Trolley Strap systemâƒ°  and side pockets for convenient travel\r\nTrolley strap secure shoulder straps to avoid falling out during duffle bag carrying mode\r\nAllow side zippered access as needed\r\n\r\nFeatures\r\nStreamline lightweight design with wide opening access to main compartment\r\nSecurity hood design\r\nDual handle design as an alternative carrying solution\r\nErgonomic padded adjustable shoulder straps and adjustable sternum straps for best support during travel\r\nHidden Trolley system and side pockets for convenient travel\r\nContoured padded mesh back panel with air channel for carrying comfort\r\nAir mesh back panel with air flow design helps keeps you cool on the go\r\nWeather-resistant material helps protect from the elements\r\n\r\nSpecifications\r\nCOLOR	Black\r\nWORKS WITH	15.6\" Laptops\r\nSTYLE	Backpack\r\nPROTECTION LEVEL	Best\r\nWEIGHT	0.9 kg\r\nWARRANTY	Limited Lifetime Warranty', 'TARGUS BP SOL-LITE 1.jpg', 'Black', 'TARGUS', 'Polyester', 'men', 1, '1', '5f4ca33f217a7', '5', 'no', '', '0000-00-00 00:00:00', '0000-00-00', '5f4ca33f217a6', '', '', '2020-11-13 06:51:03', '2020-08-31 07:14:07'),
('5f4ca4a963399', 'Vaseline Petroleum Jelly (50g)', 5.50, 'Description:Protects and locks in moisture to help restore dry skin.-100% pure petroleum jelly. Triple-purified. Purity guaranteed- Gentle on your skin, hypoallergenic and non-comedogenic (won t clog pores)- Reduces the appearance of fine, dry lines- Helps protect minor cuts, scrapes and burns- Protects your skin from sunburn and chapping- Relieves skin discomfort and irritation- Softens rough skin areas like elbows and knees- Moisturises lips to relieve chapping', 'Vaseline Petroleum Jelly 4.jpg', 'white', 'None', '-', 'none', 0, '1', '5f4ca4a96339c', '3', 'no', '', '0000-00-00 00:00:00', '0000-00-00', '5f4ca4a96339b', '', '', '2020-11-13 06:51:03', '2020-08-31 07:20:09'),
('5f4ca778894d1', '[GWP] L\'Oreal Paris Revitalift Crystal Micro Essence 22ml [NOT FOR SALE] - gimmick', 99.00, 'SKINCARE REVOLUTION\r\nL\'Oreal Paris Revitalift Crystal Micro Essence\r\nFor Crystal Clear Skin\r\nNever stop at just clear skin, go for Crystal Clear! Because you\'re worth it.\r\n\r\n\r\nWith time, skinâ€™s original glow gradually fades away. It becomes\r\ndull and rough as fine lines become more visible.\r\nTo help preserve youthful skin and reveal ultimate radiant skin,\r\nLâ€™Oreal Paris Advanced Research present its new generation of\r\nskin essence: REVITALIFT Crystal Micro-Essence\r\nPowered by micronized technology**: REVITALIFT Crystal\r\nMicro-Essence penetrates deep into skin layers* to boost skin\r\nmoisture retention, plump and smoothen skin and deeply bring\r\nkey ingredients into the skin:\r\n\r\nSKIN BRIGHTENING ACTIVES\r\nSALICYLIC ACID mildly exfoliates to help refine pores and\r\nskin texture.\r\nMILD EXFOLIATING HEPES removes dead skin cells\r\nand accelerate skin renewal.\r\nLEGENDARY CENTELLA ASIATICA\r\nKnown for its healing power to deeply repair, boost skin\r\nelasticity, and smooth out lines and wrinkles.\r\nBREAKTHROUGH TEXTURE\r\nLight and watery texture allows quick absorption yet\r\nstill leaves skin highly moisturized\r\n\r\n*10 stripping layers on stratum corneum, instrumental test\r\n**micronized ingredient', 'L\'Oreal Paris Revitalift 1.jpg', 'Brown', 'L\'Oreal', '-', 'female', 0, '1', '5f4ca778894da', '3', 'no', '', '0000-00-00 00:00:00', '0000-00-00', '5f4ca778894d8', '', '', '2020-11-13 06:51:03', '2020-08-31 07:32:08'),
('5f4ca859474fe', 'Hada Labo Premium Whitening Essence 30g', 61.10, 'New Packaging Of Premium Whitening Essence\r\nExp 2022\r\nâ€¢ Contains 2 types of Hyaluronic Acid to provide intense and long lasting hydration\r\nâ€¢ Enriched with multiple intensive brightening ingredients to fight dark spots, relief\r\nvisible redness and re-balance skin tone.\r\nâ€¢ Contains high purity of Arbutin and Vitamin C to help improve skin dullness and\r\nbrighten skin, leaving skin perfectly luminous, translucent, smooth and silky white\r\nâ€¢ Skin pH balanced. Low irritation. Suitable for all skin types.\r\nâ€¢ Free of fragrances, mineral oil, alcohol and colorant.\r\n\r\nIngredients: Water, PEG-400, Pentylene Glycol, Glycereth-26, PPG-10 Methyl Glucose Ether, 3-O- Ethyl Ascorbic Acid, Methylparaben, Dehydroxanthan\r\nGum, Xanthan Gum, Ammonium Acryloyl- dimethyltaurate/Beheneth-25 Methacrylate Crosspolymer, Styrene/VP Copolymer /Water/ Sorbic\r\nAcid, Disodium EDTA, Glycerin/ Glycine Soja (Soybean) Seed Extract, Water / Polyquaternium-51/\r\nPhenoxyethanol / Disodium EDTA, Phenylethyl Resorcinol, Sodium Bisulfite, Sodium Citrate, Citric Acid, Hydroxyethylpiperazine Ethane Sulfonic Acid,\r\nSodium Benzotriazolyl Butylphenol Sulfonate / Buteth-3 / Tributyl Citrate, Sodium Hyaluronate (Medium-sized HA), Arbutin, Carnosine, Sodium\r\nHyaluronate (Nano HA), Vaccinium Myrtillus Leaf Extract', 'Hada Labo Premium Whitening Essence 5.jpg', 'white', 'Hada Labo', '-', 'none', 0, '1', '5f4ca85947501', '3', 'no', '', '0000-00-00 00:00:00', '0000-00-00', '5f4ca85947500', '', '', '2020-11-13 06:51:03', '2020-08-31 07:35:53'),
('5f4caa5a59f11', 'Huawei Nova 7I (8GB + 128GB)', 999.00, 'GENERAL\r\nMODEL NAME	HUAWEI Nova 7i\r\nCOLOR	Midnight Black, Crush Green, Sakura Pink\r\nDIMENSIONS	159.2 mm (H) x 76.3 mm (W) x 8.7 mm (D)\r\nIN THE BOX	Handset(with Built-in battery), Charger, Type-C Cable, Headset, Quick Start Guide, Warranty Card, Eject Tool, TPU Protective Cover & TP Protective film\r\nITEM WEIGHT	Approx. 183 g (including the battery)\r\nCAMERA\r\nFRONT CAMERA (SECONDARY CAMERA)	16 MP, F/2.0 aperture\r\nREAR CAMERA (MAIN CAMERA)	48 MP (F/1.8 aperture) + 8 MP + 2 MP + 2 MP\r\nVIDEO SHOOTING	Front Camera : up to 1920 x 1080 || Rear Camera : up to 1920 x 1080\r\nSHOOTING MODE	Rear camera: Wide angle lens, Night, Portrait, Pro, Slow-mo, Panorama, Light painting, HDR, Time-Lapse, Stickers, Documents, Ultra snapshot, Capture smiles, Audio control, Timer. || Front camera: Portrait, AR lens, Time-Lapse, Filter, Stickers, Capture smiles, Mirror reflection, Audio control, Timer.\r\nDISPLAY\r\nSCREEN SIZE	6.4 inches\r\nSCREEN COLOR	16.7M\r\nSCREEN TYPE	LCD\r\nRESOLUTION	2310 x 1080 pixels\r\nSCREEN PIXEL DENSITY PPI	398\r\nTOUCH SCREEN	Multi-touch, Supporting a maximum of 10 touch points\r\nBATTERY\r\nTYPE OF BATTERY	Lithium Polymer\r\nBATTERY CAPACITY	4200mAh (Typical value)\r\nNETWORK\r\nNETWORK TYPE	4G VOLTE, 3G, 2G\r\nSUPPORTED NETWORKS	4G LTE TDD, 4G LTE FDD, 3G TD-SCDMA, 3G WCDMA, 3G/2G CDMA & 2G GSM\r\nINTERNET CONNECTIVITY	4G, 3G, 2G, GPRS, EDGE, Wi-Fi\r\nWIFI	802.11 b/g/n/a/ac 2.4G/5G Hz\r\nWI-FI HOTSPOT	Yes\r\nBLUETOOTH	BT5.0, BLE, SBC and AAC are supported\r\nNFC	Not Supported\r\nUSB	USB 2.0\r\nUSB FUNCTION	USB OTG, USB Tethering & USB Charging\r\nMAP SUPPORT	Yes\r\nGPS	GPS, AGPS, GLONASS, QZSS & Galileo\r\nSTORAGE & HARDWARE\r\nINTERNAL STORAGE	128 GB\r\nRAM	8 GB\r\nEXPANDABLE STORAGE	Up to 256 GB\r\nSUPPORTED MEMORY CARD TYPE	NM Card\r\nOPERATING SYSTEM	EMUI 10.0.1 (Based on Android 10.0)\r\nPROCESSOR TYPE	Kirin 810\r\nPROCESSOR CORE	Octa-Core\r\nPROCESSOR FREQUENCY	2xCortex-A76 2.27GHz+6xCortex-A55 1.88GHz\r\nOTHER INFORMATION\r\nTYPES OF SENSORS	Fingerprint Sensor, Proximity Sensor, Ambient Light Sensor, Digital Compass, Gravity Sensor\r\nFM	Supported\r\nMESSAGING	SMS/MMS\r\nEMAIL	Support(POP3/IMAP/Exchange)\r\nSIM SIZE	Card Slot 1: Nano-SIM card || Card slot 2: Nano-SIM card or NM card\r\nAUDIO JACK	3.5mm\r\nMULTI-MEDIA	Audio file format: mp3, mp4, 3gp, ogg, amr, aac, flac, midi || Video file format: 3gp, mp4 || Image file format: *.png, *.gif(Static only), *.jpg, *.bmp, *.webp, *.wbmp\r\nSOUND EFFECT	Noise Reduction: Dual-microphone noise reduction || Sound Effect: Histen', 'Huawei Nova 7I  3.jpg', 'Black', 'HUAWEI', '', 'none', 0, '1', '5f4caa5a59f14', '2', 'no', '', '0000-00-00 00:00:00', '0000-00-00', '5f4caa5a59f13', '', '', '2020-11-13 06:51:03', '2020-08-31 07:44:26'),
('5f4cabee19080', 'Huawei Band 4 Smartwatch', 139.00, '1. HUAWEI Watch Face Store is available only on Android and availability may vary by region.\r\n\r\n2. Clear the charging port of any water, sweat of dirt before charging to guarantee normal charging. A general USB charger is required.\r\n\r\n3. Based on results from HUAWEI lab tests. Battery life depends on actual usage situation.\r\n\r\n4. Users can manually adjust this setting.\r\n\r\n5. Features may not be available depending on the country or region.\r\n\r\n6. Outdoor cycle is only supported on Huawei EMUI 5.0 or later, and iOS 9.0 or later.\r\n\r\n7. Supported only on phones running EMUI 8.1 or later.\r\n\r\nThis product is not intended to be used as medical instrument, data are for reference only.', 'Huawei Band 4 Smartwatch 4.jpg', 'Black', 'Huawei', 'Rubber', 'none', 0, '1', '5f4cabee19083', '11', 'no', '', '0000-00-00 00:00:00', '0000-00-00', '5f4cabee19082', '', '', '2020-11-13 06:51:03', '2020-08-31 07:51:10'),
('5f4cae4b7f977', 'OPPO A91 Smartphone (8GB RAM+128GB ROM/VOOC Flash Charge 3.0)', 998.00, 'KEY FEATURES\r\nðŸ“Œ48MP+8MP+2MP+2MP AI Quad Camera\r\nðŸ“Œ16 MP (F2.0) AI Selfie Lens\r\nðŸ“Œ1080 x 2400 pixels (FHD+)\r\nðŸ“Œ8GB RAM+128GB ROM\r\nðŸ“ŒNon-removable Li-Po 4025 mAh battery\r\nðŸ“ŒFast charging 20W, 50% in 30 min, VOOC 3.0\r\nðŸ“ŒMediatek MT6771V Helio P70 (12nm), Octa-Core\r\n\r\n\r\nSPECIFICATIONS\r\n\r\nBASIC PARAMETERS\r\nColor			 : Lightening Black, Blazing Blue\r\nOperating System : ColorOS 6.1.2, based on Android 9\r\nCPU			 : MTK MT6771V\r\nGPU			 : AARM Mali G72 MP3 900MHz\r\nRAM			 : 8 GB\r\nStorage		         : 128 GB\r\nBattery                    : 4025 mAh \r\n\r\nDISPLAY\r\nSize				: 6.4\' Inches\r\nTouchscreen		: Multi-touch, Capacitive Screen\r\nResolution		: 2400 by 1080 pixels at 408 ppi\r\nColors			: 16 million colors\r\nScreen Ratio		: 90.7%\r\nContrast			: 1000000:1\r\nType			: Amoled\r\nBrightness		:  Typical Value 430nit\r\n\r\nCAMERA\r\nRear Sensor		: 48MP & 8MP & 2MP & 2MP\r\nFront Sensor		: 16MP\r\nCamera Aperture	\r\nRear			: Main f/1.79, Wide Angle f/2.25, Portrait & Mono f/2.4\r\nFront			: f/2.0\r\nCamera Sensor Size\r\nRear			: 1/2\'\'/0.8um+1/4\', 1.12um 2M 1/5\', 1.75um\r\nFront			: 1/3.1\'\'/1um\r\nCamera Mode	: Photo, video, professional mode, panorama, portrait, night scene, time-lapse photography, slow motion, etc.\r\n\r\nVIDEO\r\nRear			: 1080P@30fps\r\nFront Camera        : 720P@30fps\r\n\r\nCONNECTIVITY\r\nFrequencies\r\nGSM			: 850/900/1800/1900MHz\r\nWCDMA			: Bands 1/5/8\r\nFDD-LTE		        : Bands 1/3/5/7/8\r\nTD-LTE			: Bands 38/40/41\r\nSIM Card Type	: Nano-SIM / Nano-USIM\r\nGPS			: Built-in GPS; supports A-GPS, Beidou, Glonass, \r\nBluetooth		: 4.2\r\nWLAN Function	: 2.4/5GHz 802.11 a/b/g/n/ac\r\nOTG			: Supported\r\nNFC			: Supported\r\nVOOC flash charge: Supported\r\n\r\nSENSORS\r\nFingerprint (under display, optical)\r\nGyro\r\nProximity Sensor\r\nCompass\r\nG-sensor/Acceleration sensor\r\n\r\nDIMENSIONS/WEIGHT\r\nHeight			: 160.2mm\r\nWidth			: 73.3mm\r\nThickness		: 7.9mm\r\nWeight			: About 172g\r\n\r\nWHAT\'S IN THE BOX\r\nOPPO A91			x1\r\nCharger 				x1\r\nEarphone 			x1\r\nUSB line 			x1\r\nWarranty Card		x1\r\nQuick Guide 			x1\r\nSIM Card Needle	 	x1\r\nScreen Protect Film 	x1\r\nCase 				x1', 'OPPO A91 Smartphone 2.jpg', 'white', 'OPPO', '-', 'none', 0, '2', '5f4cae4b7f97b', '2', 'no', '', '0000-00-00 00:00:00', '0000-00-00', '<br />\r\n<b>Notice</b>:  Undefined variable: goodsImagesId in <b>C:xampphtdocs	estProjectsellercreateProduct.php</b> on line <b>727</b><br />\r\n', '', '', '2020-11-13 06:51:03', '2020-08-31 08:01:15'),
('5f4cb042d2153', 'HP LaserJet Pro M12a Printer', 356.00, 'Product Features:\r\nâ€¢ Claim your Rewards via the Following Link: https://h41201.www4.hp.com/WMCF.Web/my/en/landing/\r\nâ€¢ Outstanding, reliable quality without compromises\r\nâ€¢ Time after time, count on documents with sharp black text from the industry leader in laser printing\r\nâ€¢ Help save energy with HP Auto-On/Auto-Off Technology\r\nâ€¢ Start printing right out of the box, using a preinstalled Original HP LaserJet toner cartridge.\r\nâ€¢ Efficient printing for small workspaces\r\nâ€¢ Stay productive with print speeds up to 19 pages per minute\r\nâ€¢ Make the most of limited workspace with this compact HP LaserJet Proâ€”the smallest laser printer HP offers\r\nâ€¢ Get high-quality pages and the performance you can count on with Original HP toner cartridges.\r\nâ€¢ Well-connected printing to match the way you work\r\nâ€¢ Connect this laser printer directly to your PC via the included Hi-Speed USB 2.0 port.\r\nâ€¢ Print speeds up to 19 ppm\r\nâ€¢ Connect via USB\r\n\r\nProduct Specifications:\r\nâ€¢ Functions: Print\r\nâ€¢ Print speed black (ISO, A4): Up to 18 ppm\r\nâ€¢ First page out black (A4, ready): Up to 9.2 sec\r\nâ€¢ Duty cycle (monthly, A4): Up to 5000 pages\r\nâ€¢ Recommended monthly page volume: 100 to 1000\r\nâ€¢ Number of users: 1-3 Users\r\nâ€¢ Print technology: Laser\r\nâ€¢ Print quality black (best): Up to 600 x 600 x 2 dpi\r\nâ€¢ Processor speed: 266 MHz\r\nâ€¢ Print languages: Host-based printing\r\nâ€¢ Print colors: No\r\nâ€¢ Number of print cartridges: 1 Black\r\nâ€¢ Mac compatible: Yes\r\nâ€¢ Printer Management: HP Status and Alerts; (CD install only)\r\nâ€¢ HP ePrint capability: No\r\nâ€¢ Mobile printing capability: Mobile Print Capability not supported\r\nâ€¢ Wireless capability: No\r\nâ€¢ Connectivity, standard: 1 Hi-Speed USB 2.0\r\nâ€¢ Minimum System Requirements: WindowsÂ® 7, 8, 8.1,10 (32-bit/64-bit): 2 GB RAM for 64-bit, 1 GB RAM for 32-bit, 400 MB Free HD space; Windows VistaÂ® (32-bit/64-bit): 1 GB RAM (32-bit); WindowsÂ® XP: Intel PentiumÂ® II, CeleronÂ® or 233 MHz compatible processor, 750 MB Free HD space; WindowsÂ® Server 2008 (32-bit/64-bit), WindowsÂ® Server 2003: 512 MB RAM, 400 MB free HD space; all systems: CD-ROM/DVD drive or Internet connection, USB port\r\nâ€¢ Minimum System Requirements for Macintosh: Mac OS X 10.9, 10.10, 10.11; 1 GB available hard disk space; CD-ROM drive; USB port; Internet\r\nâ€¢ Compatible Operating Systems: WindowsÂ® 7, 8, 8.1, 10 (32-bit/64-bit), Windows VistaÂ® (32-bit/64-bit), WindowsÂ® XP (32-bit/64-bit), WindowsÂ® Server 2008 (32-bit/64-bit), WindowsÂ® Server 2003 (32-bit/64-bit), Mac OS X v 10.9, v 10.10, v 10.11\r\nâ€¢ Compatible Network Operating Systems: WindowsÂ® 7, 8, 8.1,10 (32-bit/64-bit), Windows VistaÂ® (32-bit/64-bit), WindowsÂ® XP (32-bit/64-bit), WindowsÂ® Server 2008 (32-bit/64-bit), WindowsÂ® Server 2003 (32-bit/64-bit), Mac OS X v 10.9, v 10.10, v 10.11\r\nâ€¢ Memory: 2 MB\r\nâ€¢ Maximum Memory: 2 MB\r\nâ€¢ Memory Slots: Not expandable\r\nâ€¢ Memory card compatibility: No\r\n\r\nâ€¢ What\'s in the box: \r\n1. HP LaserJet Pro M12a Printer\r\n2. Preinstalled HP Original Introductory Black LaserJet Toner Cartridge (~500 pages)\r\n3. Installation guide, Setup Poster, Support flyer, Warranty guide\r\n4. Software drivers and documentation on CD-ROM\r\n5. Power cord\r\n6. USB cable\r\n\r\nâ€¢ Cable included: Yes. 1 USB\r\nâ€¢ Replacement cartridges: HP 79A Original Black LaserJet Toner Cartridge CF279A\r\n\r\nâ€¢ Software included: \r\n1. HP Status and Alerts\r\n2. CD Launch Pad\r\n3. Print Driver\r\n4. Software Installer/Uninstaller\r\n\r\nâ€¢ Warranty: 3 Years Limited Warranty (3 Year 3-5WD 1 -1 Exchange )', 'HP LaserJet Pro M12a Printer 1.png', 'white', 'HP', '-', 'none', 0, '1', '5f4cb042d2156', '6', 'no', '', '0000-00-00 00:00:00', '0000-00-00', '5f4cb042d2155', '', '', '2020-11-13 06:51:03', '2020-08-31 08:09:38'),
('5f4cb176e00e9', '[PRE-ORDER] [ONLINE EXCLUSIVE] HP Laptop 14s-dq1029tu [FREE Upgrade to 3 Years Warranty Delivery & Backpack]', 2.00, '[PRE-ORDER] (ETA: 2020-09-13)\r\n\r\nProduct Features:\r\nâ€¢ Take it anywhere. See more.\r\nâ€¢ With its thin and light design, 6.5 mm micro-edge bezel display, with its 78% screen to body ratio â€“ take this PC anywhere and see and do more\r\nâ€¢ Reliable performance for every day\r\nâ€¢ Powerful enough for your busiest days, this PC features an IntelÂ® processor and reliable flash-based storage at a great value.\r\nâ€¢ Powered up and productive. All day long.\r\nâ€¢ With a long battery life and fast-charge technology, this laptop lets you work, watch, and stay connected all day\r\nâ€¢ Integrated precision touchpad with multi-touch support speeds up both navigation and productivity.\r\nâ€¢ Windows 10\r\nâ€¢ 10th Generation IntelÂ® Coreâ„¢ processor\r\nâ€¢ Experience power and responsive performance to boost your productivity. Enjoy immersive entertainment and game, stream and create content with accelerated performance\r\nâ€¢ PCIe SSD storage\r\nâ€¢ Available in capacities up to 512 GB, PCIe-based flash storage is up to 17x faster than a traditional 5400-rpm laptop hard drive\r\nâ€¢ FHD IPS display\r\nâ€¢ Enjoy crystal-clear images from any angle\r\nâ€¢ 178Â° wide-viewing angles and a vibrant 1920 x 1080 resolution\r\nâ€¢ DDR4 RAM\r\nâ€¢ Designed to run more efficiently and more reliably at faster speeds\r\nâ€¢ Everything from multi-tasking to playing games gets a performance boost.	\r\nâ€¢ 802.11 a/c (1x1) WLAN & BluetoothÂ® 4.2\r\nâ€¢ Stay connected to Wi-Fi and to BluetoothÂ® accessories with wireless technology\r\n\r\nProduct Specifications\r\nâ€¢ Operating system: Windows 10 Home 64\r\nâ€¢ Processor family: 10th Generation IntelÂ® Coreâ„¢ i5 processor\r\nâ€¢ Processor: IntelÂ® Coreâ„¢ i5-1035G1 (1.0 GHz base frequency, up to 3.6 GHz with IntelÂ® Turbo Boost Technology, 6 MB L3 cache, 4 cores)\r\nâ€¢ MDA key selling point: Windows 10 Home or other operating systems available\r\nâ€¢ Security management: Fingerprint reader\r\nâ€¢Memory: 4 GB DDR4-2666 SDRAM (1 x 4 GB)\r\nâ€¢ Memory layout (slots & size): 1 x 4 GB\r\nâ€¢ Internal Storage: 512 GB PCIeÂ® NVMeâ„¢ M.2 SSD\r\nâ€¢ Cloud service: Dropbox\r\nâ€¢ Display: 35.6 cm (14\") diagonal FHD IPS BrightView micro-edge WLED-backlit, 250 nits, 45% NTSC (1920 x 1080)\r\nâ€¢ Display size (diagonal): 35.6 cm (14\")\r\nâ€¢ Graphics: Integrated\r\nâ€¢  Graphics (integrated): IntelÂ® UHD Graphics\r\nâ€¢ Ports: 1 USB 3.1 Gen 1 Type-Câ„¢ (Data Transfer Only, 5 Gb/s signaling rate); 2 USB 3.1 Gen 1 Type-A (Data Transfer Only); 1 AC smart pin; 1 HDMI 1.4b; 1 headphone/microphone combo\r\nâ€¢ Expansion slots: 1 multi-format SD media card reader\r\nâ€¢ Webcam: HP Wide Vision HD Camera with integrated dual array digital microphone\r\nâ€¢ Audio features: Dual speakers\r\nâ€¢ Pointing device: HP Imagepad with multi-touch gesture support\r\nâ€¢ Keyboard: Full-size island-style natural silver backlit keyboard\r\nâ€¢ Wireless: 802.11ac (1x1) Wi-FiÂ® and BluetoothÂ® 4.2 combo\r\nâ€¢ Power supply type: 45 W Smart AC power adapter\r\nâ€¢ Battery type: 3-cell, 41 Wh Li-ion\r\nâ€¢ Energy efficiency: ENERGY STARÂ® certified; EPEATÂ® Silver registered\r\nâ€¢ Product color: Natural Silver\r\nâ€¢ Software included: McAfee LiveSafeâ„¢\r\nâ€¢ Pre-installed software: Netflix (30-day free trial offer)\r\nâ€¢ Warranty: 1 year limited parts and labour', 'HP Laptop 14s-dq1029tu 1.jpg', 'white', ' HP', '-', 'none', 0, '1', '5f4cb176e00eb', '6', 'no', '', '0000-00-00 00:00:00', '0000-00-00', '5f4cb176e00ea', '', '', '2020-11-13 06:51:03', '2020-08-31 08:14:47');
INSERT INTO `product` (`id`, `name`, `price`, `description`, `coverImage`, `color`, `brand`, `material`, `gender`, `soldRecord`, `sellerId`, `InventoryId`, `categoryId`, `auctionStatus`, `auctionId`, `auctionDueDate`, `date`, `imagesId`, `status`, `auctionEnd`, `created_time`, `uploadTime`) VALUES
('5f4cba82bacbc', 'ASUS TUF A15/A17 Gaming Laptop (AMD | 8GB/16GB | SSD | GTX /RTX / W10) Free Gaming Backpack', 4.00, 'FA506I-VHN248T: Processor: AMD Ryzenâ„¢ 9-4900H, Memory: DDR4 3200 16G (8G*2), PCIE NVME 1TB M.2 SSD, Display: 15.6\" FHD//IPS Panel//144Hz//67% sRGB//170 Wide View//Anti-glare, Graphic card: NVIDIA GeForce RTX2060, VRAM: GDDR6 6GB, OS: Windows 10 (64bit), Battery: 48WHrs, 3S1P, 3-cell Li-ion, Warranty: 2 Year, Free [TUF GAMING BACKPACK INSIDE]\r\n\r\n\r\nFA506I-VAL118T: Processor: AMD Ryzenâ„¢ 7-4800H, Memory: DDR4 3200 16G (8G*2),  PCIE NVME 1TB M.2 SSD, Display: 15.6\" FHD//IPS Panel//144Hz//67% sRGB//170 Wide View//Anti-glare, Graphic card: NVIDIA GeForce RTX2060, VRAM: GDDR6 6GB, OS: Windows 10 (64bit), Battery: 48WHrs, 3S1P, 3-cell Li-ion, Warranty: 2 Year, Free  [TUF GAMING BACKPACK INSIDE]\r\n\r\n\r\nFA706I-UH7078T: Processor: AMD Ryzenâ„¢ 9-4900H, Memory: DDR4 3200 8G*1, PCIE NVME PCIE NVME 512GB M.2 SSD, Display: 17.3\" FHD//IPS Panel//120Hz//67% sRGB//170 Wide View//Anti-glare, Graphic card: NVIDIA GeForce GTX1660Ti, VRAM: GDDR6 6GB, OS: Windows 10 (64bit), Battery: 48WHrs, 3S1P, 3-cell Li-ion, Warranty: 2 Year, Free [TUF GAMING BACKPACK INSIDE]\r\n\r\n\r\nFA506I-UHN204T: Processor: AMD Ryzenâ„¢ 9-4900H, Memory: DDR4 3200 8G*1, PCIE NVME 512GB M.2 SSD, Display: 15.6\" FHD//IPS Panel//144Hz//67% sRGB//170 Wide View//Anti-glare, Graphic card: NVIDIA GeForce GTX1660Ti, VRAM: GDDR6 6GB, OS: Windows 10 (64bit), Battery: 48WHrs, 3S1P, 3-cell Li-ion, Warranty: 2 year, Free  [TUF GAMING BACKPACK INSIDE]\r\n\r\n\r\nFA506I-UHN203T: Processor: AMD Ryzenâ„¢ 7-4800H, Memory: DDR4 3200 8G*1, PCIE NVME 512GB M.2 SSD, Display:15.6\" FHD//IPS Panel//144Hz//67% sRGB//170 Wide View//Anti-glare, Graphic card: NVIDIA GeForce GTX1660Ti, VRAM: GDDR6 6GB, OS: Windows 10 (64bit), Battery: 48WHrs, 3S1P, 3-cell Li-ion, Warranty: 2 year, Free  [TUF GAMING BACKPACK INSIDE]\r\n\r\n\r\n FA706I-IH7079T: Processor: AMD Ryzenâ„¢ 7-4800H, Memory: DDR4 3200 8G*1, PCIE NVME 512GB M.2 SSD, Display: 17.3\" FHD//IPS Panel//120Hz//67% sRGB//170 Wide View//Anti-glare, Graphic card: NVIDIA GeForce GTX 1650Ti, VRAM: GDDR6 4GB, OS: Windows 10 (64bit), Battery: 48WHrs, 3S1P, 3-cell Li-ion, Warranty: 2 year, Free  [TUF GAMING BACKPACK INSIDE]\r\n\r\n\r\nFA506I-IHN241T: Processor: AMD Ryzenâ„¢ 7-4800H, Memory: DDR4 3200 8G*1, PCIE NVME 512GB M.2 SSD, Display: 15.6\" FHD//IPS Panel//144Hz//67% sRGB//170 Wide View//Anti-glare, Graphic card: NVIDIA GeForce GTX 1650Ti, VRAM: GDDR6 4GB, OS: Windows 10 (64bit), Battery: 48WHrs, 3S1P, 3-cell Li-ion, Warranty: 2 year, Free [TUF GAMING BACKPACK INSIDE]\r\n\r\n\r\nFA506I-IHN240T: Processor: AMD Ryzenâ„¢ 5-4600H, Memory: DDR4 3200 8G*1, PCIE NVME 512GB M.2 SSD, Display: 15.6\" FHD//IPS Panel//144Hz//67% sRGB//170 Wide View//Anti-glare, Graphic card: NVIDIA GeForce GTX 1650Ti, VRAM: GDDR6 4GB, OS: Windows 10 (64bit), Battery: 48WHrs, 3S1P, 3-cell Li-ion, Warranty: 2 year, Free [TUF GAMING BACKPACK INSIDE]\r\n\r\n\r\nFA506I-HHN137T: Processor: AMD Ryzenâ„¢ 5-4600H, Memory: DDR4 3200 8G*1, PCIE NVME 512GB M.2 SSD, Display: 15.6\" FHD//IPS Panel//144Hz//67% sRGB//170 Wide View//Anti-glare, Graphic card: NVIDIA GeForce GTX 1650, VRAM: GDDR6 4GB, OS: Windows 10 (64bit), Battery: 48WHrs, 3S1P, 3-cell Li-ion, Warranty: 2 year, Free [TUF GAMING BACKPACK INSIDE]', 'ASUS TUF A15 Gaming Laptop 1.jpg', 'Black', 'ASUS', '-', 'none', 0, '1', '5f4cba82bacbf', '6', 'no', '', '0000-00-00 00:00:00', '0000-00-00', '5f4cba82bacbe', '', '', '2020-11-13 06:51:03', '2020-08-31 08:53:23'),
('5f4cbb8233c60', 'Acer Predator Helios 300 PH315-53-5462 15.6\" FHD IPS 144Hz Gaming Laptop', 4.00, '======================\r\nHighlights\r\n======================\r\n\r\nIntel Core i5-10300H processor\r\n8GB DDR4 2933MHz RAM (1*8GB)\r\n512GB PCIe NVMe SSD\r\nNVIDIA GeForce RTX 2060 with 6 GB of dedicated GDDR6\r\n15.6\" 144Hz Slim Bezel Display with IPS technology, Full HD 1920 x 1080, high-brightness LED-backlit TFT LCD NTSC 72%\r\nWindows 10 Home 64-bit\r\n2-Year Local Onsite Warranty +Accidental Damage / Theft\r\n\r\n\r\n======================\r\nSpecification\r\n======================\r\n[CPU / Processor]: Intel Core i5-10300H processor\r\n\r\n[Memory]: 8GB DDR4 2933MHz RAM (1*8GB)\r\n[Memory Slot]: Total 2 slots\r\n[Storage]: 512GB PCIe NVMe SSD (1 extra M.2 slot and extra HDD Slot)\r\n[Graphic Card]: NVIDIA GeForce RTX 2060 with 6 GB of dedicated GDDR6 VRAM\r\n[Display Screen / Design / Resolution]: 15.6\" 144Hz Slim Bezel Display with IPS technology, Full HD 1920 x 1080, high-brightness LED-backlit TFT LCD NTSC 72%\r\n[Camera]: Acer HD Webcam, 1280 x 720 resolution\r\n[Operation System]: Windows 10 Home 64-bit\r\n[Optical Drive]: -\r\n[Audio & Video]: DTSÂ® X:Ultra Audio, featuring optimized Bass, Loudness, Speaker\r\n[Network / Connectivity Technology]: Killer Wi-Fi 6 AX1650\r\nâ€¢ 802.11 a/b/g/n+ac+ax wireless LAN\r\nâ€¢ Dual Band (2.4 GHz and 5 GHz)\r\nKillerTM Ethernet E2500\r\nBluetoothÂ® 5.0\r\n[Keyboard Feature]: 4 Zone RGB Keyboard\r\n[Interface]: SD card reader\r\n1 USB Type C port (USB 3.1 Gen2 10 Gbps)\r\n1 USB3.1 Gen2 port featuring power off charging,\r\n2 USB 3.1 Gen1 ports\r\n1 HDMIâ„¢ 2.0 port with HDCP support\r\n1 Mini Display Portâ„¢ 1.4\r\n[Battery / Power Supply]: 58.7 Wh 3815 mAh 15.4 V 4-cell Li-ion battery pack\r\n\r\n[Dimensions]: 363.4 (W) x 255 (D) x 22.9 (H) mm\r\n[Weight]: 2.2 kg \r\n[Remark]: 2-Year Local Onsite Warranty + Accidental Damage / Theft', 'Acer Predator Helios 1.jpg', 'Black', 'Acer', '-', 'none', 0, '1', '5f4cbb8233c63', '6', 'no', '', '0000-00-00 00:00:00', '0000-00-00', '5f4cbb8233c62', '', '', '2020-11-13 06:51:03', '2020-08-31 08:57:38'),
('5f4cbcbe8f2bf', 'Kingston Micro SD Card 128GB / 64GB / 32GB / 16GB Memory Card 100MB/s Canvas Select Plus Class 10 UHS-I Card SDCS2', 10.50, 'Lifetime Warranty By Kingston Malaysia\r\n \r\nWhat\'s In The Box :-\r\n1x Canvas Select Plus microSD Card\r\n\r\nPowerful performance, speed, and durability\r\nKingstonâ€™s Canvas Select Plus microSD is compatible with Android devices and designed with A1 rated performance. It offers improved speed and capacity for loading apps faster and capturing images and videos in multiple capacities up to 512GB. Powerful in performance, speed, and durability, the Canvas Select Plus microSD is designed for\r\nreliability when shooting and developing high-resolution photos or Filming and editing full HD videos. Kingston Canvas cards are tested to be durable in the harshest environments and conditions so you can take\r\nthem anywhere with confidence that your photos, videos, and files will be protected. Available with a lifetime warranty. \r\n\r\n> Class 10 UHS-I speeds up to 100MB/s\r\n> Optimized for use with Android devices\r\n> Capacities up to 512GB\r\n> Durable\r\n> Lifetime Warranty\r\n\r\nFEATURES/ BENEFITS\r\n> Faster speeds â€” Class 10 UHS-I speeds up to 100MB/s.\r\n> Optimized for use with Android devices â€” Improved performance when used with an Android smartphone or tablet.\r\n> Multiple capacities â€” Up to 512GB to store all your memorable photos and videos.\r\n>Durable â€” For your peace of mind, the card has been extensively tested and proven to be waterproof, temperature\r\nproof, shock and vibration proof and X-ray proof\r\n\r\nSPECIFICATIONS\r\n> Capacities : 16GB, 32GB, 64GB, 128GB, 256GB, 512GB\r\n> Performance :\r\nâ€¢ 100MB/s Read (16GB-128GB)\r\nâ€¢ 100/85MB/s Read/Write (256GB-512GB)\r\n>Dimensions : \r\nâ€¢ 11mm x 15mm x 1mm (microSD)\r\nâ€¢ 24mm x 32mm x 2.1mm (with SD adapter)\r\n> Format : FAT32 (16GB-32GB), exFAT (64GB-512GB)\r\n> Operating temperature : -25Â°C~85Â°C\r\n> Storage temperature : -40Â°C~85Â°C\r\n> Voltage : 3.3V\r\n> Warranty/Support : Lifetime', 'Kingston Micro SD Card  2.jpg', 'Black', 'Kingston', '-', 'none', 0, '1', '5f4cbcbe8f2c2', '6', 'no', '', '0000-00-00 00:00:00', '0000-00-00', '5f4cbcbe8f2c1', '', '', '2020-11-13 06:51:03', '2020-08-31 09:02:54'),
('5f4cbe043ef7e', 'Victor Shuttlecocks Master Classic - Single Pack One Dozen', 77.80, 'Welcome to Victor Official Store where we strive to provide our customers an array of products that satisfy demand for quality and efficiency. Buy our products from Shopee Mall in a worry-free manner as we guarantee 100% authenticity. Shopping can\'t get any easier than this, so start today!\r\n\r\nSpecifications: Model: Master Classic Feather Material: Goose Feather Head Material: Composite Cork (Softwood) Quantity: 1 Doz', 'Victor Shuttlecocks 3.jpg', 'white', 'Victor', 'Composition Cork + Goose Feather', 'none', 0, '1', '5f4cbe043ef82', '8', 'no', '', '0000-00-00 00:00:00', '0000-00-00', '5f4cbe043ef81', '', '', '2020-11-13 06:51:03', '2020-08-31 09:08:20'),
('5f4cbef97e297', 'Molten Basketball Rubber - Size 7 B7G2010 FIBA', 65.00, 'Basketball\r\nNumber of Panels : 12\r\nCover Material: Rubber\r\nBladder: Butyl\r\nCountry of Origin: Thailand\r\nSize 7\r\nConstruction: Molded\r\nFIBA APPROVED\r\nColor : Orange & Ivory\r\n\r\n\r\nKindly,please take note.\r\nNew launching ball will replace old model balls.\r\nThe replacement list as below ; \r\n\r\nSize 7\r\nB7G4500 > BGG7X\r\nB7G3800 > BGM7X\r\nB7G3200 > BGN7X\r\nB7G3000 > BGH7X\r\nB7G2000 > BGR7\r\nB7G2010 > BGR7D\r\n\r\nSize 6\r\nB6G4500 > BGG6X\r\nB6G3800 > BGM6X\r\nB6G3200 > BGN7X\r\nB6G3000 > BGH6X\r\nB6G2000 > BGR6\r\n\r\nSize 5\r\nB5G3800 > BGM5X\r\nB5G3200 > BGN5X\r\nB5G3000 > BGH5X\r\nB5G2000 > BGR5\r\n\r\n* We guarantee our products are 100% original\r\n* All Molten MY products are manufactured according to the highest quality and safety standards.\r\n* Authentic Molten products are sold and distributed by Molten Malaysia directly or through authorized resellers â€“ including dealers and retailers.\r\n* Occasionally Molten receive reports of counterfeit products being sold through unauthorized resellers', 'Molten Basketball Rubber 1.jpg', 'red', 'Molten', 'Rubber', 'none', 1, '1', '5f4cbef97e299', '8', 'no', '', '0000-00-00 00:00:00', '0000-00-00', '5f4cbef97e298', '', '', '2020-11-13 06:51:03', '2020-08-31 09:12:25'),
('5f4cc04f3dd3e', 'MAXX Fashion Sport Shirt MXFT057', 23.70, 'Welcome to Maxx Official Store where we strive to provide our customers an array of active llifestyle apparel and badminton products that satisfy your demand for quality and value buy!\r\n\r\n#maxxsports #unleashyourmaximum\r\n\r\nMAXX Genuine Fashion Sport Shirt:\r\n\r\n- DRY FIT & QUICK DRY- providing you superior comfort even in heavy sweating\r\n- 100% EXTRA DURABLE Polyester\r\n- COMFORTABLE CUTTING- suits your every movement\r\n- LIGHT- You won\'t feel the weight\r\n- UNISEX- Ladies and gentlemen, we\'ve got you covered\r\n- ALL SPORTS- from jogging to tabata, from badminton to pilate, its suitable for all activities!', 'MAXX Fashion Sport Shirt 1.jpg', 'LightBlue', 'MAXX', '-', 'none', 0, '1', '5f4cc04f3dd41', '8', 'no', '', '0000-00-00 00:00:00', '0000-00-00', '5f4cc04f3dd40', '', '', '2020-11-13 06:51:03', '2020-08-31 09:18:07'),
('5f4cc1785bcba', 'Yonex Astrox 99 Badminton Racquet Frame - Sunshine 3UG5 (Free BG66UM String & AC102EX Grip Tape)', 559.00, 'ðŒð€ðƒð„ ðˆð ð‰ð€ðð€ð ð¥  ðŒð€ðƒð„ ðˆð ð‰ð€ðð€ð ð¥ ðŒð€ðƒð„ ðˆð ð‰ð€ðð€ð\r\nPlayer\'s model: Used by World No. 1 menâ€™s singles player, Kento Momota (JPN)\r\nOverwhelm the opposition with the fast and powerful ASTROX. For players who demand a steep angled and devastating smash, taking the point to their opponent.\r\n\r\n--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------\r\n\r\nðƒðžð­ðšð¢ð¥ð¬ : \r\nâ€¢	Flex: STIFF\r\nâ€¢	Frame: H.M. Graphite / Namd / NANOMETRIC / Tungsten\r\nâ€¢	Shaft: H.M. Graphite, Namd\r\nâ€¢	Length : 10mm longer\r\nâ€¢	Weight/Grip : 4U (Ave.83g) G4,5  3U (Ave.88g) G4,5\r\nâ€¢	String Advice:  4U 20-28lbs, 3U 21-29lbs\r\n\r\n--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------\r\n\r\nð“ðžðœð¡ð§ð¨ð¥ð¨ð ð² :\r\nâ€¢	Super Slim Long Shaft: The slimmest racquet ever produced by YONEX vastly reduces air resistance whilst providing maximum feel.\r\nâ€¢	Solid Feel Core: The built-in solid feel core cuts harmful miscellaneous vibration at impact. Solid feel core is carried in all racquets manufactured in Japan.\r\nâ€¢	Full Frame Namd: Until now, the Astrox serious has utilized next-generation graphite \"*Namd\" in the shaft, which results in a large increase in the snapback speed of the shaft, producing greater smash speeds. Butt the ASTROX 99 has adopted Namd in the entire body of the racquet., including the frame, doubling contact time with the shuttle, resulting in an explosive shot as the racquet returns from flexed to straight at the end of the swing.\r\n\r\n--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------\r\n\r\nð–ð¡ðšð­\'ð¬ ðˆð§ðœð¥ð®ððžð?\r\nâ€¢	1 unit of unstrung racquet \r\nâ€¢	1 unit of single racquet bag\r\nâ€¢	1 unit of BG66 Brilliant String \r\nâ€¢	1 unit of AC102EX Grip tape   \r\n\r\n#Yonex #Badminton #Badmintonracquet', 'Yonex Astrox 99 Badminton 3.jpg', 'orange', 'Yonex', 'H.M. Graphite / Namd / NANOMETRIC / Tung', 'men', 0, '1', '5f4cc1785bcbd', '8', 'no', '', '0000-00-00 00:00:00', '0000-00-00', '5f4cc1785bcbc', '', '', '2020-11-13 06:51:03', '2020-08-31 09:23:04'),
('5f4cc2f6208ad', 'ðŸ”¥HOTðŸ”¥ AVENT Natural Bottle 4 oz / 9 oz / 11 oz Clear / Blue / Pink / Decorated (Assorted Size 4oz 9oz & 11oz Botol )', 23.20, 'PHILIPS AVENT Natural Bottle 4 oz/9 oz/11 oz Clear/Blue/Pink Bottle - loose pack/ no box. \r\nFor 4oz Blue/Pink,  9oz Clear/Blue/Pink bottles, kindly buy two bottles  and you will get them in its original box.\r\nOne bottle Flamingo, Tiger, Hippo, Elephant Pink and Elephant Blue comes with box. \r\n\r\nYou can choose to buy made in the UK or Indonesia for Clear, Blue and Pink Bottles. Both made in UK and Indonesia bottles are original, just different manufacturing country. \r\n\r\nFREE shipping for order over RM19. Please apply Shopee shipping voucher upon checkout.\r\n\r\nðŸ‘‰Please choose your shipping option, either by DHL, Poslaju, Ninja Van or J&T upon checkout. ðŸ˜\r\n\r\nPHILIPS AVENT 4 oz bottle comes with teat newborn flow, 0m+, size 1.\r\nPHILIPS AVENT 9 oz bottle comes with teat slow flow, 1m+,m, size 2.\r\nPHILIPS AVENT 11 oz bottle comes with teat fast flow, 6m+, size 4.\r\n\r\nKey Features:\r\n-Natural latch on\r\n-Unique comfort petals\r\n-Advanced anti-colic system\r\n-Ergonomic shape\r\n-BPA free\r\n\r\nProduct Description\r\nOur new bottle helps to make bottle feeding more natural for your baby and you. The teat features an innovative petal design for natural latch on similar to the breast, making it easy for your baby to combine breast and bottle feeding.\r\n\r\nEasy to combine breast and bottle feeding â€¢ Natural latch on due to the wide breast-shaped teat\r\n\r\nA more comfortable and contented feed for baby â€¢ Unique comfort petals for an extra soft and flexible teat\r\n\r\nAir goes into the bottle, not baby\'s tummy â€¢ Advanced anti colic system with innovative twin valve\r\n\r\nEasy to hold and grip in any direction â€¢ Ergonomic shape for maximum comfort\r\n\r\nNatural latch on The wide breast-shaped teat promotes natural latch on similar to the breast, making it easy for your baby to combine breast and bottle feeding.\r\n\r\nUnique comfort petals Petals inside the teat increase softness and flexibility without teat collapse. Your baby will enjoy a more comfortable and contented feed.\r\n\r\nAdvanced anti-colic system Innovative twin valve design reduces colic and discomfort by venting air into the bottle and not baby\'s tummy.\r\n\r\nThis bottle is BPA free* The new Philips AVENT Natural bottle is made of BPA free* material (polypropylene).\r\n\r\nCompatibility across the range The new Philips AVENT Natural bottle is compatible with the Philips AVENT range, excluding Classic bottles and cup handles. We advise using the Natural bottles with Natural feeding teats only.', 'AVENT Natural Bottle 1.jpg', 'white', 'Philips Avent', 'BPA Free', 'none', 0, '1', '5f4cc2f6208b8', '9', 'no', '', '0000-00-00 00:00:00', '0000-00-00', '5f4cc2f6208b7', '', '', '2020-11-13 06:51:03', '2020-08-31 09:29:26'),
('5f4cc41b21396', 'Nestle Nankid Optipro HA Stage 3 Hypoallergenic (800g x 5) FOC 800g', 346.90, 'NestlÃ©Â® NANKIDÂ® OPTIPROÂ® HA 3 800g is a formulated milk powder for children 1 year and above \r\n\r\nIt\'s formulated with partially hydrolysed 100% whey protein, that has been broken down into two NestlÃ©Â®\'s unique hydrolysis processes.\r\n\r\nThese proteins are easier to digest and absorb, and is much less allergenic than regular cow\'s milk proteins.\r\n\r\nSupplemented with 100 million of probiotics to help in improving intestinal and gut function with average consumption of 100g powder a day.\r\n\r\nDHA and ARA, found abundantly in brain and eyes.\r\n\r\n Formulated and manufactured in Switzerland', 'Nestle Nankid Optipro HA 2.jpg', 'white', 'Nestle', '-', 'none', 0, '1', '5f4cc41b21399', '9', 'no', '', '0000-00-00 00:00:00', '0000-00-00', '5f4cc41b21398', '', '', '2020-11-13 06:51:03', '2020-08-31 09:34:19'),
('5f4cc4f753019', 'Drypers Baby Head to Toe Refill pack (500ml)', 7.90, 'One product to cleanse every part of your baby from head to toe. Enriched with Oat Kernel extract, Pro vitamin B5 and with a mild baby friendly fragrance this is a great value product. Donâ€™t forget to make small talk while bathing your baby. These moments are precious.\r\n\r\nHow to use: Apply on a soft washcloth, massage gently onto skin and hair. Lather then rinse with water. Also suitable for newborns.', 'Drypers Baby Head 2.jpg', 'white', 'Drypers', '-', 'none', 0, '1', '5f4cc4f75301c', '9', 'no', '', '0000-00-00 00:00:00', '0000-00-00', '5f4cc4f75301b', '', '', '2020-11-13 06:51:03', '2020-08-31 09:37:59'),
('5f4cc66a84dfd', 'WHISKAS CAT WET FOOD-85g', 1.40, '****************Important Note***********************\r\nCanned,Fragile and liquid products,purchase at buyer own risks.Our team assure to pack and ship out all product in good condition(otherwise stated like dented tin/dented box).No claim is allow for fragile and liquid products. \r\n\r\n\r\nSpecially formulated for cats aged 1 year old and above.\r\n100% complete and balanced, with 41 essential nutrients.\r\nMade with fresh, nutritious and delicious fish that your cat will love.\r\nFormulated with omega 3 & 6 fats and zinc for a healthy and shiny coat.\r\nComplete with vitamin A and taurine for healthy eyesight.\r\nFilled with proteins from real fish, including fats, vitamins and minerals, so your cat stays fit and happy.', 'WHISKAS CAT 2.jpg', 'Purple', 'WHISKAS', '-', 'none', 0, '1', '5f4cc66a84e10', '7', 'no', '', '0000-00-00 00:00:00', '0000-00-00', '5f4cc66a84e0f', '', '', '2020-11-13 06:51:03', '2020-08-31 09:44:10'),
('5f4ce7eb993a3', 'Fossil Explorist Gen 4 HR Smartwatch FTW4018', 639.50, '<p>WANT TO KNOW MORE? Classic design with modern technology, this Fossil touchscreen smartwatch features a black silicone strap, and let\'s you track your heart rate, receive notifications, customize your dial and more. Smartwatches powered with Wear OS by Google are compatible with iPhone and Android phones. Stay in the know with messages and notifications delivered directly to your watch and stay in style with a customizable watch face that can be changed to match your look. SPECS: Case Case Size: 45MM Case Color: Black Case Shape: Round Case Thickness: 13MM Case Material: Stainless Steel Strap Closure: Single Prong Strap Buckle Circumference: 200+/- 5MM Strap Color: Black Strap Width: 22MM Strap Material: Silicone Tech Details Storage: 4GB Compatibility: Android OS 6.0+ (EXCLUDING GO EDITION), iOS 10.0+ Connectivity: Bluetooth&reg; Smart Enabled / 4.1 Low Energy, Wi-Fi 802.11 b/g/n Battery Life: 1-2 DAYS **BASED ON USAGE** Additional Details Activity Tracking: Built In Fitness Tracker Functions: Heart Rate Tracking / GPS / Swimproof / Notifications / Personalize Your Dial / Control Your Music / Interchangeable Watch Band Notifications: Text / Email / Social Media / App Alerts / Multiple Time Zones / Alarm Clock / Calendar Alerts Warranty: 2 Years Local Manufacturer Included Accessories: Watch Charger Water Resistant: 3 ATM</p>', 'Fossil Explorist Gen 1.jpg', 'Black', 'Fossil', 'Stainless Steel', 'men', 0, '1', '5f4ce7eb993a6', '11', 'yes', '5f4ce7eb993a7', '2020-11-30 00:00:00', '2020-11-30', '5f4ce7eb993a5', '', 'no winner', '2020-11-13 06:51:03', '2020-12-05 17:12:08'),
('5f4ce967cfd18', 'PLAYBOY GENUINE LEATHER RFID BI-FOLD WALLET PW 230-3 BLACK', 109.95, 'Welcome to PLAYBOY OFFICIAL SHOP where we strive to provide our customers an array of products that satisfy demand for quality and efficiency. Buy our products from Shopee Mall in a worry-free manner as we guarantee 100% authenticity. Shopping can\'t get any easier than this, so start today!\r\n\r\n- Genuine Leather\r\n- 2 Cash compartments\r\n- 2 Receipt slots\r\n- 8 Card slots\r\n- RFID Blocking Technology\r\n- SIZE (L x H x W) : 12 x 9.7 x 2.5\r\n\r\n**Please allow 1-2cm variance for the measurements as it\'s manually measured. =) **', 'PLAYBOY GENUINE LEATHER 2.jpg', 'Black', 'PLAYBOY ', 'Genuine Leather', 'men', 0, '1', '5f4ce967cfd1b', '5', 'yes', '5f4ce967cfd1c', '2020-11-30 12:17:00', '2020-11-30', '5f4ce967cfd1a', '', '5faf8c8a30a94', '2020-11-13 06:51:03', '2020-08-31 12:13:27'),
('5f4ceada5853d', 'Victor Badminton Bag BR9607 FP - Blue', 139.00, 'Welcome to Victor Official Store where we strive to provide our customers an array of products that satisfy demand for quality and efficiency. Buy our products from Shopee Mall in a worry-free manner as we guarantee 100% authenticity. Shopping can\'t get any easier than this, so start today!', 'Victor Badminton Bag 2.jpg', 'Blue', 'Victor', 'Polyester + PU +PVC', 'none', 0, '1', '5f4ceada58542', '9', 'yes', '5f4ceada58543', '2021-01-21 20:21:00', '2021-01-21', '5f4ceada58541', '', '', '2020-11-13 06:51:03', '2020-08-31 12:19:38'),
('5f4cec2522462', 'Sony WH-1000XM4 Bluetooth Active Noise Cancelling 30 Hours Battery Life Ambient Mode Over-Ear Headphones [Jaben]', 1.00, '<p><strong>Sony\'s latest WH-1000XM4</strong> headphones take you even deeper into silence with further improvements to our industry-leading noise cancellation, and smart listening that adjusts to your situation.</p>\r\n<p><em><strong>Key Features and Benefits: </strong></em></p>\r\n<p style=\"line-height: 1.2;\">ðŸŒŸ Industry-leading digital noise cancellation</p>\r\n<p style=\"line-height: 1.2;\">ðŸŒŸ Industry-leading noise cancellation technology means you hear every word, note, and tune with incredible clarity, no matter your environment. Additional microphones also assist in isolating sound while talking on the phone, resulting in improved phone call quality and the reduction of even more high and mid frequency sounds.</p>\r\n<p style=\"line-height: 1.2;\">ðŸŒŸ Ambient sound control</p>\r\n<p style=\"line-height: 1.2;\">ðŸŒŸ Adjust ambient sound with the Sony Headphones Connect app to cancel noise while still allowing through essential sounds, like transport announcements, when you\'re listening on the move.</p>\r\n<p style=\"line-height: 1.2;\">ðŸŒŸ Proprietary technology for premium sound</p>\r\n<p style=\"line-height: 1.2;\">ðŸŒŸ LDAC transmits approximately three times more data (at the maximum transfer rate of 990 kbps) than conventional Bluetooth audio, allowing you to enjoy high-resolution audio content in exceptional quality, as close as possible to that of a dedicated wired connection. Powered by DSEE Extreme technology, the 40mm drivers with Liquid Crystal Polymer (LCP) diaphragms are Hi-Res Audio Compatible, reproducing a full range of frequencies up to 40 kHz.</p>\r\n<p style=\"line-height: 1.2;\">ðŸŒŸ Real-time restoration of all your compressed files</p>\r\n<p style=\"line-height: 1.2;\">ðŸŒŸ Using Edge-AI (Artificial Intelligence) co-developed with Sony Music Entertainment, DSEE Extreme (Digital Sound Enhancement Engine) upscales compressed digital music files in real time. Dynamically recognizing instrumentation, musical genres, and individual elements of each song, such as vocals or interludes, it restores the high-range sound lost in compression for a richer, more complete listening experience.</p>\r\n<p style=\"line-height: 1.2;\">ðŸŒŸ All-day power with quick charging</p>\r\n<p style=\"line-height: 1.2;\">ðŸŒŸ The WH-1000XM4 headphones are made to last all day and then some, whether you\'re focused on your work or flying around the globe. Up to 30 hours of battery life on a single charge keeps you listening instead of charging. Low on battery? No problem - 10 minutes of charge time gives you an amazing up to 5 hours of playback.</p>\r\n<p style=\"line-height: 1.2;\">ðŸŒŸ Touch control</p>\r\n<p style=\"line-height: 1.2;\">ðŸŒŸ Change the track, turn the volume up or down, activate your phone\'s voice assistant, and take or make calls by tapping or swiping the panel with your fingertip. ðŸŒŸ Clear hands-free calling</p>\r\n<p style=\"line-height: 1.2;\">ðŸŒŸ Conversation flows freely with easy, hands-free calling. Leave your phone where it is, just speak with a double tap. Thanks to Precise Voice Pickup Technology, which combines five built-in microphones with advanced audio signal processing, WH-1000XM4 delivers clearer voice quality to the other person on the phone. Precise voice pickup technology implemented in WH-1000XM4 optimally controls the five microphones built into the headphones and performs advanced audio signal processing to pick up your voice clearly and precisely for hands-free calls.</p>\r\n<p style=\"line-height: 1.2;\">ðŸŒŸ Multipoint connection</p>\r\n<p style=\"line-height: 1.2;\">ðŸŒŸ For total convenience, the WH-1000XM4 headphones can be paired with two Bluetooth devices at the same time. So, when a call comes in, your headphones know which device is ringing and will automatically connect to the right one. You\'ll also be able to quickly and smoothly switch your headphones to either of the two devices at the touch of a button.</p>\r\n<p style=\"line-height: 1.2;\">ðŸŒŸ Adaptive Sound Control</p>\r\n<p style=\"line-height: 1.2;\">ðŸŒŸ Adaptive Sound Control is a smart function that can learn to recognize locations you frequently visit, such as your workplace or favorite cafe and tailor sound for the ideal listening experience. In addition, it automatically detects what you\'re up to - for example, walking, waiting, or traveling - then adjusts ambient sound settings to best suit the situation.</p>\r\n<p style=\"line-height: 1.2;\">ðŸŒŸ Wearing comfort</p>\r\n<p style=\"line-height: 1.2;\">ðŸŒŸ WH-1000XM4 headphones blend sophisticated styling with exceptional comfort. Super-soft, pressure-relieving earpads in foamed urethane evenly distribute pressure and increase ear/pad contact for a stable fit. And with a lighter- weight design, you\'ll barely notice you\'re wearing them.</p>', 'ony WH-1000XM4 Bluetooth 3.jpg', 'Black', 'Sony', ' Microphone Present', 'none', 0, '1', '5f4cec2522464', '2', 'yes', '5f4cec2522465', '2021-01-29 22:00:00', '2021-01-29', '5f4cec2522463', '', '', '2020-11-13 06:51:03', '2020-12-03 00:58:01'),
('5f4cee9e56a3a', 'Microsoft Surface Go Signature Type Cover', 499.00, 'Supported Platform: Surface Go\r\nDimensions: 9.65\" x 6.9\" x 0.33\" (245 mm x 175 mm x 8.3 mm)\r\nWeight: 245 g (0.54 lb)\r\nKeys: Activation: Moving (mechanical) keys\r\nLayout: QWERTY, full row of function keys (F1-F12)\r\nWindows key and dedicated buttons for media controls\r\nscreen brightness\r\nRight click button, 1.0 mm travel, Backlight\r\nTrackpad: Mechanical click pad, Synaptics solution, Glass face sheet\r\nDimensions: 99.2 mm x 56.5 mm (height)\r\nMaterial: Black: Microfiber, Platinum, Burgundy, Cobalt Blue: Alcantara\r\nColors: Black, Platinum, Burgundy, Cobalt Blue\r\nInterface: Magnetic\r\nSensor: Accelerometer\r\nWarranty: 1-year limited hardware warranty', 'Microsoft Surface Go 3.jpg', 'LightBlue', 'Microsoft', 'Black: Microfiber, Platinum, Burgundy, Cobalt Blue: Alcantara', 'none', 0, '1', '5f4cee9e56a3d', '6', 'yes', '5f4cee9e56a3e', '2020-12-03 22:30:00', '2020-12-03', '5f4cee9e56a3c', '', 'no winner', '2020-11-13 06:51:03', '2020-08-31 12:35:42'),
('5f4cf849524c3', 'Acer Predator Aethon 300 Gaming Keyboard (PKB910)', 399.00, 'THE BEST SWITCHES\r\nThe worldâ€™s best switches give you an audible tactile accuracy in your game play.\r\n\r\nPRECISION CONTROL\r\nDonâ€™t miss a single keypress as you utilize the100% anti-ghosting in six-key rollover or choose full N-key rollover for total accuracy in the heat of battle.\r\n\r\nLIGHT IT UP\r\nLight the way with the single teal blue backlight and its four levels of brightness and 10 preset lighting modes.\r\n\r\nMiscellaneous\r\n\r\nPlatform Supported\r\n\r\nWindows\r\n\r\nAdditional Information\r\n\r\nSwitch Type: Cherry Switches (MX Blue)\r\nBattery / power comsumption:< 100mA\r\nPalm Rest: N/A\r\nCable Type: Braided Fiber, golden-plated USB\r\nKey Switch Durability: 50M actuations\r\nMCU Processor: 32 bit MCU\r\nOn board memory / profile setting: 1\r\nReport Rate: 1ms/1000Hz\r\nKeyboard backlighting: single color(Teal Blue) 10 lighting effects : Lightened/ Breathing/wave / Spin/ Trigger Ripple 1/ Trigger Single /Trigger Laser Beam/Rain Drop/Trigger Ripple 2/ Rectangle Grid /Trigger Laser Beam/Rain Drop/Trigger Ripple 2/ Rectangle Grid\r\nLED indicators: Win key lock, Num Lock, Caps Lock\r\nN key rollover: 100% anti-ghosting\r\nProfile Switch Keys: N/A\r\nIndividual Media Keys: Combo Multimedia Keys\r\nAdditional Combo Keys: Combo Multimedia Keys\r\nFingerprint: N/A\r\nUSP passthrough: N/A\r\nLighting Synchronization: N/A\r\nSoftware: N/A\r\nCertifications & Standards\r\n\r\nCE\r\nFCC\r\nBSMI\r\nCountry of Origin\r\n\r\nChina\r\n\r\nPhysical Characteristics\r\n\r\nColour\r\n\r\nBlack\r\n\r\nWeight (Approximate)\r\n\r\n1.12 kg\r\n\r\nGeneral Information\r\n\r\nProduct Name\r\n\r\nAethon 300 Keyboard\r\n\r\nProduct Model\r\n\r\nPKB910\r\n\r\nPackaged Quantity\r\n\r\n1\r\n\r\nPackage Type\r\n\r\nRetail\r\n\r\nProduct Type\r\n\r\nGaming Keyboard\r\n\r\nWarranty\r\n\r\nWarranty', 'Acer Predator 5.jpg', 'Blue', 'Acer', 'Certifications & Standards', 'none', 0, '1', '5f4cf849524ca', '6', 'yes', '5f4cf849524cb', '2021-02-01 23:30:00', '2021-02-01', '5f4cf849524c9', '', '', '2020-11-13 06:51:03', '2020-08-31 13:16:57'),
('5f4cf9f8e053b', 'Asus Zenbook Duo UX481 Laptop (Intel/Nvidia MX 250/512GB)', 2244.00, 'UX481--LBM068T-RM4699\r\n-:IntelÂ® Coreâ„¢ i5-10210U Processor 1.6 GHz (6M Cache, up to 4.2 GHz)\r\n-:8GB on board\r\n-:PCIEG3x2 NVME 512GB M.2 SSD\r\n-:14.0\' FHD 1920x1080 16:9//Anti-Glare//WV\r\n-:NVIDIA GeForce MX250, GDDR5 2GB\r\n-:802.11ax+Bluetooth 5.0 (Dual band) 2*2\r\n-:Windows 10 (64bit)\r\n-:70WHrs, 4S1P, 4-cell Li-ion\r\n-:2 Year Warranty\r\n-:Free Sleeve\r\n\r\nUX481F-LBM069T- RM5699\r\n-:IntelÂ® Coreâ„¢ i7-10510U Processor 1.8 GHz (8M Cache, up to 4.9 GHz)\r\n-:16GB on board\r\n-:PCIEG3x2 NVME 512GB M.2 SSD\r\n-:14.0\' FHD 1920x1080 16:9//Anti-Glare//WV\r\n-:NVIDIA GeForce MX250\r\n-:GDDR5 2GB\r\n-:802.11ax+Bluetooth 5.0 (Dual band) 2*2\r\n-:Windows 10 (64bit)\r\n-:71WHrs, 4S2P, 8-cell Li-ion\r\n-:2 Year Warranty\r\n-:Free Sleeve', 'Asus Zenbook Duo 1.jpg', 'Blue', 'Asus ', '-', 'men', 0, '1', '5f4cf9f8e0543', '6', 'yes', '5f4cf9f8e0544', '2021-02-10 00:00:00', '2021-02-10', '5f4cf9f8e0542', '', '', '2020-11-13 06:51:03', '2020-08-31 13:24:08'),
('5f4cfb3dac68a', 'Samsung Galaxy Note 10 Lite (N770) (Aura Black / Aura Red/ Aura Silver) - 8GB RAM - 128GB ROM - 6.7 inch - Android Handp', 2.00, '1 Year Samsung Malaysia Warranty\r\n\r\nHighlights\r\n\r\n- 6.7\" FHD+ (1080 x 2400) Super AMOLED Infinity-O Display\r\n- Octa Core (2.7GHz Quad + 1.7GHz Quad)\r\n- Exynos 9810\r\n- 8GB RAM + 128GB Storage\r\n- micorSD up to 1TB\r\n- Rear Camera : 12MP (F1.7)+ 12MP (F2.2) + 12MP (F2.4)\r\n- Front Camera : 32MP (F2.2)\r\n- 4,500mAh\r\n- Bluetooth v5.0\r\n- Wi-Fi 802.11 a/b/g/n/ac, Wi-Fi Direct\r\n- Dual Hybrid SIM\r\n- Accelerometer, Fingerprint, Gyro, Geomagnetic, Hall, RGB Light, Proximity\r\n- Box will be unsealed for warranty activation and quality check purposes.\r\n\r\nWhat\'s In The Box\r\n\r\n- 1 x Samsung Galaxy Note 10 Lite (N770)\r\n- 1 x Travel Adapter\r\n- 1 x Data Cable (Type-C)\r\n- 1 x Headset', 'Samsung Galaxy Note 1.jpg', 'Blue', 'Samsung', '-', 'none', 0, '1', '5f4cfb3dac68c', '6', 'yes', '5f4cfb3dac68d', '2021-02-20 12:00:00', '2021-02-20', '5f4cfb3dac68b', '', '', '2020-11-13 06:51:03', '2020-08-31 13:29:33'),
('5fc61250ae9a3', 'Iphone 11', 3000.99, '<h2 style=\"text-align: center;\">Apple Iphone 11&nbsp;</h2>\r\n<table style=\"margin: 0px; padding: 1px 0px; border-width: 5px 0px 0px; border-image: initial; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; line-height: inherit; font-family: Arimo, Arial, sans-serif; vertical-align: baseline; width: 727px; background-color: #fafafa; border-color: #eeeeee initial initial initial; border-style: solid initial initial initial;\" cellspacing=\"0\">\r\n<tbody style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font: inherit; vertical-align: baseline;\">\r\n<tr style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font: inherit; vertical-align: baseline;\">\r\n<th style=\"box-sizing: border-box; margin: 0px; padding: 2px 10px; border-width: 0px medium 0px 0px; border-color: initial; border-image: initial; font-variant-numeric: normal; font-variant-east-asian: normal; font-weight: normal; font-stretch: normal; line-height: normal; font-family: Google-Oswald, Arial; vertical-align: top; text-align: left; text-transform: uppercase; width: 86px; color: #d50000; border-style: initial none initial initial;\" rowspan=\"5\" scope=\"row\">DISPLAY</th>\r\n<td class=\"ttl\" style=\"box-sizing: border-box; margin: 0px; padding: 2px 10px; border-width: 0px 0px 1px; border-image: initial; font-variant-numeric: normal; font-variant-east-asian: normal; font-weight: bold; font-stretch: normal; font-size: 14px; line-height: 16px; font-family: Arimo, Arial; vertical-align: top; color: #7d7464; width: 110px; border-color: initial initial #f0f0f0 initial; border-style: initial initial solid initial;\"><a style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font: inherit; vertical-align: baseline; color: #555555; text-decoration-line: none;\" href=\"https://www.gsmarena.com/glossary.php3?term=display-type\">Type</a></td>\r\n<td class=\"nfo\" style=\"box-sizing: border-box; margin: 0px; padding: 2px 10px; border-width: 0px 0px 1px; border-image: initial; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 14px; line-height: 16px; font-family: Arimo, Arial; vertical-align: top; position: relative; border-color: initial initial #f0f0f0 initial; border-style: initial initial solid initial;\" data-spec=\"displaytype\">Super Retina OLED, HDR10, 625 nits (typ)</td>\r\n</tr>\r\n<tr style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font: inherit; vertical-align: baseline;\">\r\n<td class=\"ttl\" style=\"box-sizing: border-box; margin: 0px; padding: 2px 10px; border-width: 0px 0px 1px; border-image: initial; font-variant-numeric: normal; font-variant-east-asian: normal; font-weight: bold; font-stretch: normal; font-size: 14px; line-height: 16px; font-family: Arimo, Arial; vertical-align: top; color: #7d7464; width: 110px; border-color: initial initial #f0f0f0 initial; border-style: initial initial solid initial;\"><a style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font: inherit; vertical-align: baseline; color: #555555; text-decoration-line: none;\" href=\"https://www.gsmarena.com/apple_iphone_x-8858.php\">Size</a></td>\r\n<td class=\"nfo\" style=\"box-sizing: border-box; margin: 0px; padding: 2px 10px; border-width: 0px 0px 1px; border-image: initial; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 14px; line-height: 16px; font-family: Arimo, Arial; vertical-align: top; position: relative; border-color: initial initial #f0f0f0 initial; border-style: initial initial solid initial;\" data-spec=\"displaysize\">5.8 inches, 84.4 cm<sup style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: 0.8em; line-height: 0.8em; font-family: inherit;\">2</sup>&nbsp;(~82.9% screen-to-body ratio)</td>\r\n</tr>\r\n<tr style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font: inherit; vertical-align: baseline;\">\r\n<td class=\"ttl\" style=\"box-sizing: border-box; margin: 0px; padding: 2px 10px; border-width: 0px 0px 1px; border-image: initial; font-variant-numeric: normal; font-variant-east-asian: normal; font-weight: bold; font-stretch: normal; font-size: 14px; line-height: 16px; font-family: Arimo, Arial; vertical-align: top; color: #7d7464; width: 110px; border-color: initial initial #f0f0f0 initial; border-style: initial initial solid initial;\"><a style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font: inherit; vertical-align: baseline; color: #555555; text-decoration-line: none;\" href=\"https://www.gsmarena.com/glossary.php3?term=resolution\">Resolution</a></td>\r\n<td class=\"nfo\" style=\"box-sizing: border-box; margin: 0px; padding: 2px 10px; border-width: 0px 0px 1px; border-image: initial; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 14px; line-height: 16px; font-family: Arimo, Arial; vertical-align: top; position: relative; border-color: initial initial #f0f0f0 initial; border-style: initial initial solid initial;\" data-spec=\"displayresolution\">1125 x 2436 pixels, 19.5:9 ratio (~458 ppi density)</td>\r\n</tr>\r\n<tr style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font: inherit; vertical-align: baseline;\">\r\n<td class=\"ttl\" style=\"box-sizing: border-box; margin: 0px; padding: 2px 10px; border-width: 0px 0px 1px; border-image: initial; font-variant-numeric: normal; font-variant-east-asian: normal; font-weight: bold; font-stretch: normal; font-size: 14px; line-height: 16px; font-family: Arimo, Arial; vertical-align: top; color: #7d7464; width: 110px; border-color: initial initial #f0f0f0 initial; border-style: initial initial solid initial;\"><a style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font: inherit; vertical-align: baseline; color: #555555; text-decoration-line: none;\" href=\"https://www.gsmarena.com/glossary.php3?term=screen-protection\">Protection</a></td>\r\n<td class=\"nfo\" style=\"box-sizing: border-box; margin: 0px; padding: 2px 10px; border-width: 0px 0px 1px; border-image: initial; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 14px; line-height: 16px; font-family: Arimo, Arial; vertical-align: top; position: relative; border-color: initial initial #f0f0f0 initial; border-style: initial initial solid initial;\" data-spec=\"displayprotection\">Scratch-resistant glass, oleophobic coating</td>\r\n</tr>\r\n<tr style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font: inherit; vertical-align: baseline;\">\r\n<td class=\"ttl\" style=\"box-sizing: border-box; margin: 0px; padding: 2px 10px; border-width: 0px 0px medium; border-color: initial; border-image: initial; font-variant-numeric: normal; font-variant-east-asian: normal; font-weight: bold; font-stretch: normal; font-size: 14px; line-height: 16px; font-family: Arimo, Arial; vertical-align: top; color: #7d7464; width: 110px; border-style: initial initial none initial;\">&nbsp;</td>\r\n<td class=\"nfo\" style=\"box-sizing: border-box; margin: 0px; padding: 2px 10px; border-width: 0px 0px medium; border-color: initial; border-image: initial; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 14px; line-height: 16px; font-family: Arimo, Arial; vertical-align: top; position: relative; border-style: initial initial none initial;\" data-spec=\"displayother\">Dolby Vision<br style=\"box-sizing: border-box;\" />Wide color gamut<br style=\"box-sizing: border-box;\" />3D Touch<br style=\"box-sizing: border-box;\" />True-tone</td>\r\n</tr>\r\n</tbody>\r\n</table>', 'iphone11.jpg', 'Black', 'Apple', 'Gold', 'none', 0, '5fc5f446e800e', '5fc61250ae9a5', '2', 'no', '', '0000-00-00 00:00:00', '0000-00-00', '5fc61250ae9a6', 'remove', '', '2020-11-30 21:52:16', '2020-12-26 04:59:10'),
('5fc61f6709274', 'iphone combo 1', 345345.00, '<p style=\"text-align: center;\">&nbsp;<strong>New Iphone Combo</strong></p>\r\n<p style=\"line-height: 1;\"><strong>i. Iphone 10</strong></p>\r\n<p style=\"line-height: 1;\"><strong>ii. ipod 2</strong></p>\r\n<p style=\"line-height: 1;\"><strong>iii. airpods mini</strong></p>', 'A1001.jpg', 'DarkBlue', 'Apple ', '', 'none', 0, '5fc5f446e800e', '5fc61f6709276', '2', 'yes', '5fc61f6709278', '2020-12-16 06:25:00', '2020-12-17', '5fc61f6709277', '', '5fd9a54b3fb2e', '2020-11-30 22:48:07', '2020-12-02 23:46:36'),
('5fc742e1c9087', 'Keyboard 10', 700.00, '<p>This is my textarea to be replaced with HTML editor.</p>', 'Acer Predator 1.png', 'Black', 'Apple', 'apple', 'none', 0, '1', '5fc742e1c9088', '2', 'no', '', '0000-00-00 00:00:00', '0000-00-00', '5fc742e1c9089', 'remove', '', '2020-12-01 19:31:45', '2020-12-17 15:24:03');
INSERT INTO `product` (`id`, `name`, `price`, `description`, `coverImage`, `color`, `brand`, `material`, `gender`, `soldRecord`, `sellerId`, `InventoryId`, `categoryId`, `auctionStatus`, `auctionId`, `auctionDueDate`, `date`, `imagesId`, `status`, `auctionEnd`, `created_time`, `uploadTime`) VALUES
('5fc786dbc5c61', 'Iphone 11', 4000.00, '<div class=\"techspecs-section section-capacity\" style=\"padding-top: 3.58824em; padding-bottom: 3.29412em; border-top: 1px solid #d2d2d7; margin-top: 0.4em; margin-bottom: 0.4em; color: #1d1d1f; font-family: \'SF Pro Text\', \'SF Pro Icons\', \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 17px; letter-spacing: -0.374px; background-color: #ffffff;\" role=\"rowgroup\" data-analytics-activitymap-region-id=\"capacity\">\r\n<div class=\"techspecs-row\" style=\"margin-top: 0px; margin-bottom: 0px;\" role=\"row\">\r\n<div class=\"techspecs-rowheader\" style=\"float: left; width: 215.594px; font-size: 24px; line-height: 1.16667; font-weight: 600; letter-spacing: 0.009em; font-family: \'SF Pro Display\', \'SF Pro Icons\', \'Helvetica Neue\', Helvetica, Arial, sans-serif; position: relative; margin-top: 0px; border-color: #d2d2d7;\" role=\"rowheader\">Capacity<span class=\"footnote\" style=\"position: relative; font-size: 0.6em; vertical-align: baseline; top: -0.5em;\"><a style=\"letter-spacing: inherit; text-decoration-line: none; vertical-align: inherit;\" href=\"https://www.apple.com/my/iphone-11/specs/#footnote-2\" aria-label=\"Footnote 1\">1</a></span></div>\r\n<div class=\"techspecs-column\" style=\"float: left; margin-left: 29.3906px; width: 735px;\" role=\"cell\">\r\n<ul class=\"techspecs-list\" style=\"margin: 0px; padding: 0px; list-style: none;\" role=\"list\">\r\n<li style=\"margin: 0px; padding: 0px;\" role=\"listitem\"><span style=\"font-weight: 600;\">64GB</span></li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\"><span style=\"font-weight: 600;\">128GB</span></li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\"><span style=\"font-weight: 600;\">256GB</span></li>\r\n</ul>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"techspecs-section section-size-and-weight\" style=\"padding-top: 3.58824em; padding-bottom: 3.29412em; border-top: 1px solid #d2d2d7; margin-top: 0.4em; margin-bottom: 0.4em; color: #1d1d1f; font-family: \'SF Pro Text\', \'SF Pro Icons\', \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 17px; letter-spacing: -0.374px; background-color: #ffffff;\" role=\"rowgroup\" data-analytics-activitymap-region-id=\"size-weight\">\r\n<div class=\"techspecs-row\" style=\"margin-top: 0px; margin-bottom: 0px;\" role=\"row\">\r\n<div class=\"techspecs-rowheader\" style=\"float: left; width: 215.594px; font-size: 24px; line-height: 1.16667; font-weight: 600; letter-spacing: 0.009em; font-family: \'SF Pro Display\', \'SF Pro Icons\', \'Helvetica Neue\', Helvetica, Arial, sans-serif; position: relative; margin-top: 0px; border-color: #d2d2d7;\" role=\"rowheader\">Size and Weight<span class=\"footnote\" style=\"position: relative; font-size: 0.6em; vertical-align: baseline; top: -0.5em;\"><a style=\"letter-spacing: inherit; text-decoration-line: none; vertical-align: inherit;\" href=\"https://www.apple.com/my/iphone-11/specs/#footnote-3\" aria-label=\"Footnote 2\">2</a></span></div>\r\n<div class=\"techspecs-column\" style=\"float: left; margin-left: 29.3906px; width: 735px;\" role=\"cell\">\r\n<figure class=\"image-dimensions diagram\" style=\"margin: 80px 0px 46px -32px; padding: 0px 0px 1.1em; position: relative; z-index: 1; width: 491px; height: 230px; background-size: 491px 230px; background-repeat: no-repeat; background-image: url(\'../../v/iphone-11/d/images/specs/dimensions__bij3m9nm5kia_large.jpg\');\">\r\n<figcaption class=\"size-diagram-text diagram-text-width\" style=\"font-size: 1em; bottom: 250px; right: -37px; position: absolute; z-index: 2; width: 7.05882em; margin: 0px;\"><span style=\"font-weight: 600;\">Width:</span>\r\n<ul class=\"techspecs-list\" style=\"margin: 0px; padding: 0px; list-style: none;\" role=\"list\">\r\n<li style=\"margin: 0px; padding: 0px;\" role=\"listitem\">75.7mm</li>\r\n</ul>\r\n</figcaption>\r\n<figcaption class=\"size-diagram-text diagram-text-height\" style=\"font-size: 1em; left: 30px; bottom: 180px; position: absolute; z-index: 2; width: 7.05882em; margin: 0px;\"><span style=\"font-weight: 600;\">Height:</span>\r\n<ul class=\"techspecs-list\" style=\"margin: 0px; padding: 0px; list-style: none;\" role=\"list\">\r\n<li style=\"margin: 0px; padding: 0px;\" role=\"listitem\">150.9mm</li>\r\n</ul>\r\n</figcaption>\r\n<figcaption class=\"size-diagram-text diagram-text-depth\" style=\"font-size: 1em; left: 346px; top: 188px; position: absolute; z-index: 2; width: 7.05882em; margin: 0px;\"><span style=\"font-weight: 600;\">Depth:</span>\r\n<ul class=\"techspecs-list\" style=\"margin: 0px; padding: 0px; list-style: none;\" role=\"list\">\r\n<li style=\"margin: 0px; padding: 0px;\" role=\"listitem\">8.3mm</li>\r\n</ul>\r\n</figcaption>\r\n</figure>\r\n<div class=\"weight-wrapper\" style=\"margin-top: 22px;\"><span class=\"weight-copy\" style=\"font-weight: 600; display: inline-block;\">Weight:</span>&nbsp;\r\n<p class=\"weight-copy\" style=\"margin: 0px; padding: 0px; display: inline-block;\">194g</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"techspecs-section section-display\" style=\"padding-top: 3.58824em; padding-bottom: 3.29412em; border-top: 1px solid #d2d2d7; margin-top: 0.4em; margin-bottom: 0.4em; color: #1d1d1f; font-family: \'SF Pro Text\', \'SF Pro Icons\', \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 17px; letter-spacing: -0.374px; background-color: #ffffff;\" role=\"rowgroup\">\r\n<div class=\"techspecs-row\" style=\"margin-top: 0px; margin-bottom: 0px;\" role=\"row\">\r\n<div class=\"techspecs-rowheader\" style=\"float: left; width: 215.594px; font-size: 24px; line-height: 1.16667; font-weight: 600; letter-spacing: 0.009em; font-family: \'SF Pro Display\', \'SF Pro Icons\', \'Helvetica Neue\', Helvetica, Arial, sans-serif; position: relative; margin-top: 0px; border-color: #d2d2d7;\" role=\"rowheader\">Display</div>\r\n<div class=\"techspecs-column\" style=\"float: left; margin-left: 29.3906px; width: 735px;\" role=\"cell\">\r\n<figure class=\"image-display\" style=\"margin: 0px 0px 29px; padding: 0px; width: 165px; height: 320px; background-size: 165px 320px; background-repeat: no-repeat; background-image: url(\'../../v/iphone-11/d/images/specs/display__e8t4vcfxxguq_large.jpg\');\"></figure>\r\n<ul class=\"techspecs-list\" style=\"margin: 0px; padding: 0px; list-style: none; max-width: 350px;\" role=\"list\">\r\n<li style=\"margin: 0px; padding: 0px;\" role=\"listitem\">Liquid&nbsp;Retina HD display</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">6.1-inch (diagonal) all-screen LCD Multiâ€‘Touch display with IPS&nbsp;technology</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">1792x828-pixel resolution at 326&nbsp;ppi</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">1,400:1 contrast ratio (typical)</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">True Tone display</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Wide colour display (P3)</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Haptic Touch</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">625&nbsp;nits max brightness (typical)</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Fingerprintâ€‘resistant oleophobic coating</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Support for display of multiple languages and characters&nbsp;simultaneously</li>\r\n</ul>\r\n<p class=\"typography-caption\" style=\"margin: 0.8em 0px 0px; padding: 0px; font-size: 12px; line-height: 1.33337; letter-spacing: -0.01em;\">The iPhone 11 display has rounded corners that follow a beautiful curved design, and these corners are within a standard rectangle. When measured as a standard rectangular shape, the screen is 6.06 inches diagonally (actual viewable area is less).</p>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"techspecs-section section-splash-water-resistance\" style=\"padding-top: 3.58824em; padding-bottom: 3.29412em; border-top: 1px solid #d2d2d7; margin-top: 0.4em; margin-bottom: 0.4em; color: #1d1d1f; font-family: \'SF Pro Text\', \'SF Pro Icons\', \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 17px; letter-spacing: -0.374px; background-color: #ffffff;\" role=\"rowgroup\" data-analytics-activitymap-region-id=\"water-resistance\">\r\n<div class=\"techspecs-row\" style=\"margin-top: 0px; margin-bottom: 0px;\" role=\"row\">\r\n<div class=\"techspecs-rowheader\" style=\"float: left; width: 215.594px; font-size: 24px; line-height: 1.16667; font-weight: 600; letter-spacing: 0.009em; font-family: \'SF Pro Display\', \'SF Pro Icons\', \'Helvetica Neue\', Helvetica, Arial, sans-serif; position: relative; margin-top: 0px; border-color: #d2d2d7;\" role=\"rowheader\">Splash, Water and Dust Resistance<span class=\"footnote\" style=\"position: relative; font-size: 0.6em; vertical-align: baseline; top: -0.5em;\"><a style=\"letter-spacing: inherit; text-decoration-line: none; vertical-align: inherit;\" href=\"https://www.apple.com/my/iphone-11/specs/#footnote-4\" aria-label=\"Footnote 3\">3</a></span></div>\r\n<div class=\"techspecs-column\" style=\"float: left; margin-left: 29.3906px; width: 735px;\" role=\"cell\">\r\n<ul class=\"techspecs-list\" style=\"margin: 0px; padding: 0px; list-style: none;\" role=\"list\">\r\n<li style=\"margin: 0px; padding: 0px;\" role=\"listitem\">Rated IP68 (maximum depth of 2&nbsp;metres up to 30&nbsp;minutes) under IEC standard 60529</li>\r\n</ul>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"techspecs-section section-chip\" style=\"padding-top: 3.58824em; padding-bottom: 3.29412em; border-top: 1px solid #d2d2d7; margin-top: 0.4em; margin-bottom: 0.4em; color: #1d1d1f; font-family: \'SF Pro Text\', \'SF Pro Icons\', \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 17px; letter-spacing: -0.374px; background-color: #ffffff;\" role=\"rowgroup\" data-analytics-activitymap-region-id=\"chip\">\r\n<div class=\"techspecs-row\" style=\"margin-top: 0px; margin-bottom: 0px;\" role=\"row\">\r\n<div class=\"techspecs-rowheader\" style=\"float: left; width: 215.594px; font-size: 24px; line-height: 1.16667; font-weight: 600; letter-spacing: 0.009em; font-family: \'SF Pro Display\', \'SF Pro Icons\', \'Helvetica Neue\', Helvetica, Arial, sans-serif; position: relative; margin-top: 0px; border-color: #d2d2d7;\" role=\"rowheader\">Chip</div>\r\n<div class=\"techspecs-column\" style=\"float: left; margin-left: 29.3906px; width: 735px;\" role=\"cell\">\r\n<div class=\"row\" style=\"display: flex; flex-flow: row wrap; -webkit-box-orient: horizontal; -webkit-box-direction: normal; width: 735px;\">\r\n<div class=\"column large-2 medium-3 small-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; min-width: 0px; flex-basis: 16.6667%; max-width: 16.6667%;\">&nbsp;</div>\r\n<div class=\"column copy large-10 medium-9 small-12 small-push-0\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 0px 60px; min-width: 0px; flex-basis: 83.3333%; max-width: 83.3333%;\">\r\n<ul class=\"techspecs-list\" style=\"margin: 0px; padding: 0px; list-style: none;\" role=\"list\">\r\n<li style=\"margin: 0px; padding: 0px;\" role=\"listitem\">A13&nbsp;Bionic chip</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Thirdâ€‘generation Neural Engine</li>\r\n</ul>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"techspecs-section section-camera\" style=\"padding-top: 3.58824em; padding-bottom: 3.29412em; border-top: 1px solid #d2d2d7; margin-top: 0.4em; margin-bottom: 0.4em; color: #1d1d1f; font-family: \'SF Pro Text\', \'SF Pro Icons\', \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 17px; letter-spacing: -0.374px; background-color: #ffffff;\" role=\"rowgroup\">\r\n<div class=\"techspecs-row\" style=\"margin-top: 0px; margin-bottom: 0px;\" role=\"row\">\r\n<div class=\"techspecs-rowheader\" style=\"float: left; width: 215.594px; font-size: 24px; line-height: 1.16667; font-weight: 600; letter-spacing: 0.009em; font-family: \'SF Pro Display\', \'SF Pro Icons\', \'Helvetica Neue\', Helvetica, Arial, sans-serif; position: relative; margin-top: 0px; border-color: #d2d2d7;\" role=\"rowheader\">Camera</div>\r\n<div class=\"techspecs-column\" style=\"float: left; margin-left: 29.3906px; width: 735px;\" role=\"cell\">\r\n<ul class=\"techspecs-list\" style=\"margin: 0px; padding: 0px; list-style: none;\" role=\"list\">\r\n<li style=\"margin: 0px; padding: 0px;\" role=\"listitem\">Dual 12MP Ultra Wide and Wide cameras</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Ultra Wide: &fnof;/2.4 aperture and 120&deg; field of view</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Wide: &fnof;/1.8 aperture</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">2x optical zoom</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Digital zoom up to 5x</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Portrait mode with advanced bokeh and Depth&nbsp;Control</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Portrait&nbsp;Lighting with six effects (Natural, Studio, Contour, Stage, Stage Mono, High-Key&nbsp;Mono)</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Optical image stabilisation (Wide)</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Fiveâ€‘element lens (Ultra Wide); sixâ€‘element lens (Wide)</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Brighter True&nbsp;Tone flash with Slow&nbsp;Sync</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Panorama (up to 63MP)</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Sapphire crystal lens cover</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">100% Focus Pixels (Wide)</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Night mode (Wide)</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Deep Fusion (Wide)</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Next-generation Smart&nbsp;HDR for photos</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Wide colour capture for photos and Live&nbsp;Photos</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Advanced redâ€‘eye correction</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Auto image stabilisation</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Burst mode</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Photo geotagging</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Image formats captured: HEIF and JPEG</li>\r\n</ul>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"techspecs-section section-video-recording\" style=\"padding-top: 3.58824em; padding-bottom: 3.29412em; border-top: 1px solid #d2d2d7; margin-top: 0.4em; margin-bottom: 0.4em; color: #1d1d1f; font-family: \'SF Pro Text\', \'SF Pro Icons\', \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 17px; letter-spacing: -0.374px; background-color: #ffffff;\" role=\"rowgroup\">\r\n<div class=\"techspecs-row\" style=\"margin-top: 0px; margin-bottom: 0px;\" role=\"row\">\r\n<div class=\"techspecs-rowheader\" style=\"float: left; width: 215.594px; font-size: 24px; line-height: 1.16667; font-weight: 600; letter-spacing: 0.009em; font-family: \'SF Pro Display\', \'SF Pro Icons\', \'Helvetica Neue\', Helvetica, Arial, sans-serif; position: relative; margin-top: 0px; border-color: #d2d2d7;\" role=\"rowheader\">Video Recording</div>\r\n<div class=\"techspecs-column\" style=\"float: left; margin-left: 29.3906px; width: 735px;\" role=\"cell\">\r\n<ul class=\"techspecs-list\" style=\"margin: 0px; padding: 0px; list-style: none;\" role=\"list\">\r\n<li style=\"margin: 0px; padding: 0px;\" role=\"listitem\">4K video recording at 24&nbsp;fps, 30&nbsp;fps or 60&nbsp;fps</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">1080p HD video recording at 30&nbsp;fps or 60&nbsp;fps</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">720p HD video recording at 30&nbsp;fps</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Extended dynamic range for video up to 60&nbsp;fps</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Optical image stabilisation for video (Wide)</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">2x optical zoom out</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Digital zoom up to&nbsp;3x</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Audio zoom</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Brighter True&nbsp;Tone flash</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">QuickTake video</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Slow-motion video support for 1080p at 120&nbsp;fps or 240&nbsp;fps</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Time-lapse video with stabilisation</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Cinematic video stabilisation (4K, 1080p and 720p)</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Continuous autofocus video</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Take 8MP still photos while recording 4K video</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Playback zoom</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Video formats recorded: HEVC and H.264</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Stereo recording</li>\r\n</ul>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"techspecs-section section-truedepth-camera\" style=\"padding-top: 3.58824em; padding-bottom: 3.29412em; border-top: 1px solid #d2d2d7; margin-top: 0.4em; margin-bottom: 0.4em; color: #1d1d1f; font-family: \'SF Pro Text\', \'SF Pro Icons\', \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 17px; letter-spacing: -0.374px; background-color: #ffffff;\" role=\"rowgroup\">\r\n<div class=\"techspecs-row\" style=\"margin-top: 0px; margin-bottom: 0px;\" role=\"row\">\r\n<div class=\"techspecs-rowheader\" style=\"float: left; width: 215.594px; font-size: 24px; line-height: 1.16667; font-weight: 600; letter-spacing: 0.009em; font-family: \'SF Pro Display\', \'SF Pro Icons\', \'Helvetica Neue\', Helvetica, Arial, sans-serif; position: relative; margin-top: 0px; border-color: #d2d2d7;\" role=\"rowheader\">TrueDepth Camera</div>\r\n<div class=\"techspecs-column\" style=\"float: left; margin-left: 29.3906px; width: 735px;\" role=\"cell\">\r\n<ul class=\"techspecs-list\" style=\"margin: 0px; padding: 0px; list-style: none;\" role=\"list\">\r\n<li style=\"margin: 0px; padding: 0px;\" role=\"listitem\">12MP camera</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">&fnof;/2.2 aperture</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Portrait mode with advanced bokeh and Depth&nbsp;Control</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Portrait&nbsp;Lighting with six effects (Natural, Studio, Contour, Stage, Stage Mono, High-Key&nbsp;Mono)</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Animoji and Memoji</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">4K video recording at 24&nbsp;fps, 30&nbsp;fps or 60&nbsp;fps</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">1080p HD video recording at 30&nbsp;fps or 60&nbsp;fps</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Slow-motion video support for 1080p at 120 fps</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Next-generation Smart&nbsp;HDR for photos</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Extended dynamic range for video at 30&nbsp;fps</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Cinematic video stabilisation (4K, 1080p and 720p)</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">QuickTake video</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Wide colour capture for photos and Live&nbsp;Photos</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Retina Flash</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Auto image stabilisation</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Burst mode</li>\r\n</ul>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"techspecs-section section-face-id\" style=\"padding-top: 3.58824em; padding-bottom: 3.29412em; border-top: 1px solid #d2d2d7; margin-top: 0.4em; margin-bottom: 0.4em; color: #1d1d1f; font-family: \'SF Pro Text\', \'SF Pro Icons\', \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 17px; letter-spacing: -0.374px; background-color: #ffffff;\" role=\"rowgroup\">\r\n<div class=\"techspecs-row\" style=\"margin-top: 0px; margin-bottom: 0px;\" role=\"row\">\r\n<div class=\"techspecs-rowheader\" style=\"float: left; width: 215.594px; font-size: 24px; line-height: 1.16667; font-weight: 600; letter-spacing: 0.009em; font-family: \'SF Pro Display\', \'SF Pro Icons\', \'Helvetica Neue\', Helvetica, Arial, sans-serif; position: relative; margin-top: 0px; border-color: #d2d2d7;\" role=\"rowheader\">Face&nbsp;ID</div>\r\n<div class=\"techspecs-column\" style=\"float: left; margin-left: 29.3906px; width: 735px;\" role=\"cell\">\r\n<ul class=\"techspecs-list\" style=\"margin: 0px; padding: 0px; list-style: none;\" role=\"list\">\r\n<li style=\"margin: 0px; padding: 0px;\" role=\"listitem\">Enabled by TrueDepth&nbsp;camera for facial&nbsp;recognition</li>\r\n</ul>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"techspecs-section section-cellular-and-wireless\" style=\"padding-top: 3.58824em; padding-bottom: 3.29412em; border-top: 1px solid #d2d2d7; margin-top: 0.4em; margin-bottom: 0.4em; color: #1d1d1f; font-family: \'SF Pro Text\', \'SF Pro Icons\', \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 17px; letter-spacing: -0.374px; background-color: #ffffff;\" role=\"rowgroup\" data-analytics-activitymap-region-id=\"cellular-wireless\">\r\n<div class=\"techspecs-row\" style=\"margin-top: 0px; margin-bottom: 0px;\" role=\"row\">\r\n<div class=\"techspecs-rowheader\" style=\"float: left; width: 215.594px; font-size: 24px; line-height: 1.16667; font-weight: 600; letter-spacing: 0.009em; font-family: \'SF Pro Display\', \'SF Pro Icons\', \'Helvetica Neue\', Helvetica, Arial, sans-serif; position: relative; margin-top: 0px; border-color: #d2d2d7;\" role=\"rowheader\">Mobile and Wireless</div>\r\n<div class=\"techspecs-column\" style=\"float: left; margin-left: 29.3906px; width: 735px;\" role=\"cell\">\r\n<div class=\"row\" style=\"display: flex; flex-flow: row wrap; -webkit-box-orient: horizontal; -webkit-box-direction: normal; width: 735px;\">\r\n<div class=\"column large-3 medium-4 small-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; min-width: 0px; flex-basis: 25%; max-width: 25%;\">\r\n<p style=\"margin: 0px; padding: 0px;\"><span style=\"font-weight: 600;\">Model A2221<span class=\"footnote footnote-supglyph\" style=\"position: relative; vertical-align: baseline;\"><a style=\"letter-spacing: inherit; text-decoration-line: none; vertical-align: inherit;\" href=\"https://www.apple.com/my/iphone-11/specs/#footnote-1\" aria-label=\"footnote * symbol\">*</a></span><br class=\"small-hide\" />(GSM)</span></p>\r\n</div>\r\n<div class=\"column large-9 medium-8 small-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; min-width: 0px; flex-basis: 75%; max-width: 75%;\">\r\n<ul class=\"techspecs-list\" style=\"margin: 0px; padding: 0px; list-style: none;\" role=\"list\">\r\n<li style=\"margin: 0px; padding: 0px;\" role=\"listitem\">FDD-LTE (Bands 1, 2, 3, 4, 5, 7, 8, 11, 12, 13, 17, 18, 19, 20, 21, 25, 26, 28, 29, 30, 32, 66)</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">TD-LTE (Bands 34, 38, 39, 40, 41, 42, 46, 48)</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">UMTS/HSPA+/DC-HSDPA (850, 900, 1700/2100, 1900, 2100 MHz)</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">GSM/EDGE (850, 900, 1800, 1900 MHz)</li>\r\n</ul>\r\n</div>\r\n</div>\r\n<div class=\"row model-group\" style=\"display: flex; flex-flow: row wrap; -webkit-box-orient: horizontal; -webkit-box-direction: normal; width: 735px; margin-top: 40px;\">\r\n<div class=\"column large-3 medium-4 small-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; min-width: 0px; flex-basis: 25%; max-width: 25%;\">\r\n<p style=\"margin: 0px; padding: 0px;\"><span style=\"font-weight: 600;\">All models</span></p>\r\n</div>\r\n<div class=\"column large-9 medium-8 small-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; min-width: 0px; flex-basis: 75%; max-width: 75%;\">\r\n<ul class=\"techspecs-list\" style=\"margin: 0px; padding: 0px; list-style: none;\" role=\"list\">\r\n<li style=\"margin: 0px; padding: 0px;\" role=\"listitem\">Gigabit-class LTE with 2x2 MIMO and LAA<span class=\"footnote\" style=\"position: relative; font-size: 0.6em; vertical-align: baseline; top: -0.5em;\"><a style=\"letter-spacing: inherit; text-decoration-line: none; vertical-align: inherit;\" href=\"https://www.apple.com/my/iphone-11/specs/#footnote-5\" aria-label=\"Footnote 4\">4</a></span></li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">802.11ax Wiâ€‘Fi 6 with 2x2 MIMO</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Bluetooth 5.0 wireless technology</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Ultra Wideband chip for spatial awareness<span class=\"footnote\" style=\"position: relative; font-size: 0.6em; vertical-align: baseline; top: -0.5em;\"><a style=\"letter-spacing: inherit; text-decoration-line: none; vertical-align: inherit;\" href=\"https://www.apple.com/my/iphone-11/specs/#footnote-6\" aria-label=\"Footnote 5\">5</a></span></li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">NFC with reader mode</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Express Cards with power reserve</li>\r\n</ul>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"techspecs-section section-location\" style=\"padding-top: 3.58824em; padding-bottom: 3.29412em; border-top: 1px solid #d2d2d7; margin-top: 0.4em; margin-bottom: 0.4em; color: #1d1d1f; font-family: \'SF Pro Text\', \'SF Pro Icons\', \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 17px; letter-spacing: -0.374px; background-color: #ffffff;\" role=\"rowgroup\" data-analytics-activitymap-region-id=\"location\">\r\n<div class=\"techspecs-row\" style=\"margin-top: 0px; margin-bottom: 0px;\" role=\"row\">\r\n<div class=\"techspecs-rowheader\" style=\"float: left; width: 215.594px; font-size: 24px; line-height: 1.16667; font-weight: 600; letter-spacing: 0.009em; font-family: \'SF Pro Display\', \'SF Pro Icons\', \'Helvetica Neue\', Helvetica, Arial, sans-serif; position: relative; margin-top: 0px; border-color: #d2d2d7;\" role=\"rowheader\">Location</div>\r\n<div class=\"techspecs-column\" style=\"float: left; margin-left: 29.3906px; width: 735px;\" role=\"cell\">\r\n<ul class=\"techspecs-list\" style=\"margin: 0px; padding: 0px; list-style: none;\" role=\"list\">\r\n<li style=\"margin: 0px; padding: 0px;\" role=\"listitem\">Built-in GPS/GNSS</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Digital compass</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Wi-Fi</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Mobile data</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">iBeacon micro-location</li>\r\n</ul>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"techspecs-section section-video-calling\" style=\"padding-top: 3.58824em; padding-bottom: 3.29412em; border-top: 1px solid #d2d2d7; margin-top: 0.4em; margin-bottom: 0.4em; color: #1d1d1f; font-family: \'SF Pro Text\', \'SF Pro Icons\', \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 17px; letter-spacing: -0.374px; background-color: #ffffff;\" role=\"rowgroup\" data-analytics-activitymap-region-id=\"video-calling\">\r\n<div class=\"techspecs-row\" style=\"margin-top: 0px; margin-bottom: 0px;\" role=\"row\">\r\n<div class=\"techspecs-rowheader\" style=\"float: left; width: 215.594px; font-size: 24px; line-height: 1.16667; font-weight: 600; letter-spacing: 0.009em; font-family: \'SF Pro Display\', \'SF Pro Icons\', \'Helvetica Neue\', Helvetica, Arial, sans-serif; position: relative; margin-top: 0px; border-color: #d2d2d7;\" role=\"rowheader\">Video Calling<span class=\"footnote\" style=\"position: relative; font-size: 0.6em; vertical-align: baseline; top: -0.5em;\"><a style=\"letter-spacing: inherit; text-decoration-line: none; vertical-align: inherit;\" href=\"https://www.apple.com/my/iphone-11/specs/#footnote-7\" aria-label=\"Footnote 6\">6</a></span></div>\r\n<div class=\"techspecs-column\" style=\"float: left; margin-left: 29.3906px; width: 735px;\" role=\"cell\">\r\n<ul class=\"techspecs-list\" style=\"margin: 0px; padding: 0px; list-style: none;\" role=\"list\">\r\n<li style=\"margin: 0px; padding: 0px;\" role=\"listitem\">FaceTime video calling over a mobile network or Wiâ€‘Fi</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">FaceTime HD (1080p) video calling over Wi-Fi</li>\r\n</ul>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"techspecs-section section-audio-calling\" style=\"padding-top: 3.58824em; padding-bottom: 3.29412em; border-top: 1px solid #d2d2d7; margin-top: 0.4em; margin-bottom: 0.4em; color: #1d1d1f; font-family: \'SF Pro Text\', \'SF Pro Icons\', \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 17px; letter-spacing: -0.374px; background-color: #ffffff;\" role=\"rowgroup\" data-analytics-activitymap-region-id=\"audio-calling\">\r\n<div class=\"techspecs-row\" style=\"margin-top: 0px; margin-bottom: 0px;\" role=\"row\">\r\n<div class=\"techspecs-rowheader\" style=\"float: left; width: 215.594px; font-size: 24px; line-height: 1.16667; font-weight: 600; letter-spacing: 0.009em; font-family: \'SF Pro Display\', \'SF Pro Icons\', \'Helvetica Neue\', Helvetica, Arial, sans-serif; position: relative; margin-top: 0px; border-color: #d2d2d7;\" role=\"rowheader\">Audio Calling<span class=\"footnote\" style=\"position: relative; font-size: 0.6em; vertical-align: baseline; top: -0.5em;\"><a style=\"letter-spacing: inherit; text-decoration-line: none; vertical-align: inherit;\" href=\"https://www.apple.com/my/iphone-11/specs/#footnote-7\" aria-label=\"Footnote 6\">6</a></span></div>\r\n<div class=\"techspecs-column\" style=\"float: left; margin-left: 29.3906px; width: 735px;\" role=\"cell\">\r\n<ul class=\"techspecs-list\" style=\"margin: 0px; padding: 0px; list-style: none;\" role=\"list\">\r\n<li style=\"margin: 0px; padding: 0px;\" role=\"listitem\">FaceTime audio</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Voice over LTE (VoLTE)<span class=\"footnote\" style=\"position: relative; font-size: 0.6em; vertical-align: baseline; top: -0.5em;\"><a style=\"letter-spacing: inherit; text-decoration-line: none; vertical-align: inherit;\" href=\"https://www.apple.com/my/iphone-11/specs/#footnote-5\">4</a></span></li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Wiâ€‘Fi calling<span class=\"footnote\" style=\"position: relative; font-size: 0.6em; vertical-align: baseline; top: -0.5em;\"><a style=\"letter-spacing: inherit; text-decoration-line: none; vertical-align: inherit;\" href=\"https://www.apple.com/my/iphone-11/specs/#footnote-5\">4</a></span></li>\r\n</ul>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"techspecs-section section-audio-playback\" style=\"padding-top: 3.58824em; padding-bottom: 3.29412em; border-top: 1px solid #d2d2d7; margin-top: 0.4em; margin-bottom: 0.4em; color: #1d1d1f; font-family: \'SF Pro Text\', \'SF Pro Icons\', \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 17px; letter-spacing: -0.374px; background-color: #ffffff;\" role=\"rowgroup\">\r\n<div class=\"techspecs-row\" style=\"margin-top: 0px; margin-bottom: 0px;\" role=\"row\">\r\n<div class=\"techspecs-rowheader\" style=\"float: left; width: 215.594px; font-size: 24px; line-height: 1.16667; font-weight: 600; letter-spacing: 0.009em; font-family: \'SF Pro Display\', \'SF Pro Icons\', \'Helvetica Neue\', Helvetica, Arial, sans-serif; position: relative; margin-top: 0px; border-color: #d2d2d7;\" role=\"rowheader\">Audio Playback</div>\r\n<div class=\"techspecs-column\" style=\"float: left; margin-left: 29.3906px; width: 735px;\" role=\"cell\">\r\n<ul class=\"techspecs-list\" style=\"margin: 0px; padding: 0px; list-style: none;\" role=\"list\">\r\n<li style=\"margin: 0px; padding: 0px;\" role=\"listitem\">Audio formats supported: AACâ€‘LC, HEâ€‘AAC, HEâ€‘AAC v2, Protected AAC, MP3, Linear PCM, Apple Lossless, FLAC, Dolby Digital (ACâ€‘3), Dolby Digital Plus (Eâ€‘ACâ€‘3), Dolby Atmos and Audible (formats 2, 3, 4, Audible Enhanced Audio, AAX and AAX+)</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Spatial audio playback</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">User-configurable maximum volume limit</li>\r\n</ul>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"techspecs-section section-video-playback\" style=\"padding-top: 3.58824em; padding-bottom: 3.29412em; border-top: 1px solid #d2d2d7; margin-top: 0.4em; margin-bottom: 0.4em; color: #1d1d1f; font-family: \'SF Pro Text\', \'SF Pro Icons\', \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 17px; letter-spacing: -0.374px; background-color: #ffffff;\" role=\"rowgroup\" data-analytics-activitymap-region-id=\"video-playback\">\r\n<div class=\"techspecs-row\" style=\"margin-top: 0px; margin-bottom: 0px;\" role=\"row\">\r\n<div class=\"techspecs-rowheader\" style=\"float: left; width: 215.594px; font-size: 24px; line-height: 1.16667; font-weight: 600; letter-spacing: 0.009em; font-family: \'SF Pro Display\', \'SF Pro Icons\', \'Helvetica Neue\', Helvetica, Arial, sans-serif; position: relative; margin-top: 0px; border-color: #d2d2d7;\" role=\"rowheader\">Video Playback</div>\r\n<div class=\"techspecs-column\" style=\"float: left; margin-left: 29.3906px; width: 735px;\" role=\"cell\">\r\n<ul class=\"techspecs-list\" style=\"margin: 0px; padding: 0px; list-style: none;\" role=\"list\">\r\n<li style=\"margin: 0px; padding: 0px;\" role=\"listitem\">Video formats supported: HEVC, H.264, MPEGâ€‘4 Part 2 and Motion&nbsp;JPEG</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Supports Dolby Vision, HDR10 and HLG â€¨</li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Up to 4K HDR AirPlay for mirroring, photos and video out to Apple TV (2nd generation or later) or AirPlay 2&ndash;enabled smart TV<span class=\"footnote\" style=\"position: relative; font-size: 0.6em; vertical-align: baseline; top: -0.5em;\"><a style=\"letter-spacing: inherit; text-decoration-line: none; vertical-align: inherit;\" href=\"https://www.apple.com/my/iphone-11/specs/#footnote-8\">7</a></span></li>\r\n<li style=\"margin: 0.4em 0px 0px; padding: 0px;\" role=\"listitem\">Video mirroring and video out support: up to 1080p through Lightning Digital AV Adapter and Lightning to VGA Adapter (adapters sold separately)<span class=\"footnote\" style=\"position: relative; font-size: 0.6em; vertical-align: baseline; top: -0.5em;\"><a style=\"letter-spacing: inherit; text-decoration-line: none; vertical-align: inherit;\" href=\"https://www.apple.com/my/iphone-11/specs/#footnote-8\">7</a></span></li>\r\n</ul>\r\n</div>\r\n</div>\r\n</div>', 'iphone11.jpg', 'Black', 'Apple', '', 'none', 0, '1', '5fc786dbc5c69', '2', 'no', '', '0000-00-00 00:00:00', '0000-00-00', '5fc786dbc5c6a', '', '', '2020-12-02 00:21:47', '2020-12-26 04:59:28'),
('5fc8afd710cc3', 'iphone 11 pro max', 3599.99, '<h4 style=\"text-align: center;\">New Iphone 11 Pro Max</h4>\r\n<p>New design for future, now sale start with<span style=\"text-decoration: underline;\"> 3599.99</span>!</p>\r\n<p>Limit <span style=\"color: #e03e2d;\"><em><strong>1 </strong></em></span>Stock</p>', 'iphone11.jpg', 'Black', 'Apple', 'Black', 'none', 0, '5fc5f446e800e', '5fc8afd710cc5', '2', 'yes', '5fc8afd710cc7', '2021-01-08 17:27:00', '2021-01-08', '5fc8afd710cc6', '', '', '2020-12-02 21:28:55', '2020-12-02 21:28:55'),
('5fc8bf02a9bde', 'iphone 13', 211.99, '<p style=\"text-align: center;\"><strong>This is New Iphone 13.</strong></p>\r\n<p style=\"text-align: left;\">sadasdsad</p>\r\n<p style=\"text-align: left;\"><span style=\"font-family: \'courier new\', courier, monospace; color: #e03e2d;\"><strong><em>Limit 12</em></strong></span></p>', 'Acer Predator Helios 6.jpg', 'Blue', 'dsa', 'sadsa', 'none', 0, '5fc5f446e800e', '5fc8bf02a9be0', '6', 'yes', '5fc8bf02a9be2', '2020-12-26 18:33:00', '2020-12-26', '5fc8bf02a9be1', '', 'no winner', '2020-12-02 22:33:38', '2020-12-05 17:14:58'),
('5fc8f46b0603c', 'ipad', 264.50, '<p style=\"box-sizing: border-box; hyphens: none; margin-top: 0rem; margin-bottom: 1rem; color: #333333; font-family: Nunito, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 13px; background-color: #ffffff;\"><strong>iPad mini</strong> is beloved for its size and capability. And now there are even more reasons to love it. The A12 Bionic chip with Neural Engine. A 7.9-inch Retina display with True Tone. And Apple Pencil support,<span style=\"box-sizing: border-box; hyphens: none; position: relative; font-size: 9.28572px; line-height: 0; vertical-align: baseline; top: -0.5em;\">1</span>&nbsp;so you can capture your biggest ideas, wherever they come to you.</p>\r\n<p style=\"box-sizing: border-box; hyphens: none; margin-top: 0rem; margin-bottom: 1rem; color: #333333; font-family: Nunito, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 13px; background-color: #ffffff;\"><span style=\"text-decoration: underline;\">Feature copy</span><br style=\"box-sizing: border-box; hyphens: none;\" />The beloved 7.9-inch iPad mini is more capable than ever. It features the A12 Bionic chip with Neural Engine, which uses real-time machine learning to transform the way you experience photos, gaming, augmented reality (AR) and more. A beautiful Retina display with True Tone for easier viewing in all kinds of lighting environments. Support for Apple Pencil.<span style=\"box-sizing: border-box; hyphens: none; position: relative; font-size: 9.28572px; line-height: 0; vertical-align: baseline; top: -0.5em;\">1</span>&nbsp;Wi-Fi and LTE.<span style=\"box-sizing: border-box; hyphens: none; position: relative; font-size: 9.28572px; line-height: 0; vertical-align: baseline; top: -0.5em;\">2</span>&nbsp;An 8MP back camera and 7MP FaceTime HD camera. As well as all-day battery life,<span style=\"box-sizing: border-box; hyphens: none; position: relative; font-size: 9.28572px; line-height: 0; vertical-align: baseline; top: -0.5em;\">3</span>&nbsp;Touch ID and access to over a million iPad apps on the App Store &mdash; in an iPad that fits in one hand.</p>\r\n<p style=\"box-sizing: border-box; hyphens: none; margin-top: 0rem; margin-bottom: 1rem; color: #333333; font-family: Nunito, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 13px; background-color: #ffffff;\"><span style=\"text-decoration: underline;\">Key feature bullets</span><br style=\"box-sizing: border-box; hyphens: none;\" />&bull; 7.9-inch Retina display with True Tone and wide colour<br style=\"box-sizing: border-box; hyphens: none;\" />&bull; A12 Bionic chip<br style=\"box-sizing: border-box; hyphens: none;\" />&bull; Touch ID fingerprint sensor<br style=\"box-sizing: border-box; hyphens: none;\" />&bull; 8MP back camera, 7MP FaceTime HD front camera<br style=\"box-sizing: border-box; hyphens: none;\" />&bull; Stereo speakers<br style=\"box-sizing: border-box; hyphens: none;\" />&bull; 802.11ac Wi-Fi and Gigabit-class LTE mobile data<span style=\"box-sizing: border-box; hyphens: none; position: relative; font-size: 9.28572px; line-height: 0; vertical-align: baseline; top: -0.5em;\">2</span><br style=\"box-sizing: border-box; hyphens: none;\" />&bull; Up to 10 hours of battery life<span style=\"box-sizing: border-box; hyphens: none; position: relative; font-size: 9.28572px; line-height: 0; vertical-align: baseline; top: -0.5em;\">3</span><br style=\"box-sizing: border-box; hyphens: none;\" />&bull; Lightning connector for charging and accessories<br style=\"box-sizing: border-box; hyphens: none;\" />&bull; Support for Apple Pencil<span style=\"box-sizing: border-box; hyphens: none; position: relative; font-size: 9.28572px; line-height: 0; vertical-align: baseline; top: -0.5em;\">1</span><br style=\"box-sizing: border-box; hyphens: none;\" />&bull; iPadOS with intuitive multitasking and all the great features of iOS 13</p>\r\n<p style=\"box-sizing: border-box; hyphens: none; margin-top: 0rem; margin-bottom: 1rem; color: #333333; font-family: Nunito, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 13px; background-color: #ffffff;\"><span style=\"text-decoration: underline;\">Legal</span><br style=\"box-sizing: border-box; hyphens: none;\" /><span style=\"box-sizing: border-box; hyphens: none; position: relative; font-size: 9.28572px; line-height: 0; vertical-align: baseline; top: -0.5em;\">1</span>Accessories are sold separately. Compatibility varies by generation.<br style=\"box-sizing: border-box; hyphens: none;\" /><span style=\"box-sizing: border-box; hyphens: none; position: relative; font-size: 9.28572px; line-height: 0; vertical-align: baseline; top: -0.5em;\">2</span>Data plan is required. Gigabit-class LTE, 4G LTE Advanced, 4G LTE and Wi-Fi calling are available in selected markets and through selected carriers. Speeds are based on theoretical throughput and vary based on site conditions and carrier. For details on LTE support, contact your carrier and see apple.com/ipad/LTE.<br style=\"box-sizing: border-box; hyphens: none;\" /><span style=\"box-sizing: border-box; hyphens: none; position: relative; font-size: 9.28572px; line-height: 0; vertical-align: baseline; top: -0.5em;\">3</span>Battery life varies by use and configuration. See apple.com/batteries for more information.</p>\r\n<p style=\"box-sizing: border-box; hyphens: none; margin-top: 0rem; margin-bottom: 1rem; color: #333333; font-family: Nunito, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 13px; background-color: #ffffff;\"><span style=\"text-decoration: underline;\">Technical specifications</span><br style=\"box-sizing: border-box; hyphens: none;\" />Go to apple.com/ipad-mini/specs for a complete set.</p>\r\n<p style=\"box-sizing: border-box; hyphens: none; margin-top: 0rem; margin-bottom: 1rem; color: #333333; font-family: Nunito, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 13px; background-color: #ffffff;\">For further information on the Apple Watch or other Apple products please refer to the&nbsp;<a style=\"box-sizing: border-box; hyphens: none; color: #1979c3; text-decoration-line: none; background-color: transparent;\" href=\"https://www.senheng.com.my/brands-corner/apple-online-store.html\">/brands-corner/apple-online-store</a></p>', 'A555.jpg', 'white', 'Apple', '', 'none', 0, '5fc5f446e800e', '5fc8f46b0603e', '2', 'no', '', '0000-00-00 00:00:00', '0000-00-00', '5fc8f46b0603f', 'remove', '', '2020-12-03 02:21:31', '2020-12-03 02:22:27');
INSERT INTO `product` (`id`, `name`, `price`, `description`, `coverImage`, `color`, `brand`, `material`, `gender`, `soldRecord`, `sellerId`, `InventoryId`, `categoryId`, `auctionStatus`, `auctionId`, `auctionDueDate`, `date`, `imagesId`, `status`, `auctionEnd`, `created_time`, `uploadTime`) VALUES
('5fdb734b188b5', 'YONEX TEAM Backpack S', 350.59, '<p style=\"line-height: 1;\"><span style=\"color: rgba(0, 0, 0, 0.8); font-family: Roboto, \'Helvetica Neue\', Helvetica, Arial, æ–‡æ³‰é©›æ­£é»‘, \'WenQuanYi Zen Hei\', \'Hiragino Sans GB\', \'å„·é»‘ Pro\', \'LiHei Pro\', \'Heiti TC\', å¾®è»Ÿæ­£é»‘é«”, \'Microsoft JhengHei UI\', \'Microsoft JhengHei\', sans-serif; font-size: 14px; white-space: pre-wrap; background-color: #ffffff;\">Welcome to<strong> Yonex Official Store </strong>where we strive to provide our customers an array of products that satisfy the demand for quality and efficiency. Buy our products from Shopee Mall in a worry-free manner as we guarantee 100% authenticity. Shopping can\'t get any easier than this, so start today</span></p>\r\n<p style=\"line-height: 1;\"><span style=\"text-decoration: underline;\"><strong><span style=\"color: rgba(0, 0, 0, 0.8); font-family: Roboto, \'Helvetica Neue\', Helvetica, Arial, æ–‡æ³‰é©›æ­£é»‘, \'WenQuanYi Zen Hei\', \'Hiragino Sans GB\', \'å„·é»‘ Pro\', \'LiHei Pro\', \'Heiti TC\', å¾®è»Ÿæ­£é»‘é«”, \'Microsoft JhengHei UI\', \'Microsoft JhengHei\', sans-serif; font-size: 14px; white-space: pre-wrap; background-color: #ffffff; text-decoration: underline;\">! ll Ready Stock ll!</span></strong></span></p>\r\n<p style=\"line-height: 1;\"><span style=\"color: rgba(0, 0, 0, 0.8); font-family: Roboto, \'Helvetica Neue\', Helvetica, Arial, æ–‡æ³‰é©›æ­£é»‘, \'WenQuanYi Zen Hei\', \'Hiragino Sans GB\', \'å„·é»‘ Pro\', \'LiHei Pro\', \'Heiti TC\', å¾®è»Ÿæ­£é»‘é«”, \'Microsoft JhengHei UI\', \'Microsoft JhengHei\', sans-serif; font-size: 14px; white-space: pre-wrap; background-color: #ffffff;\"> - Order placed before 112pm will be dispatched on the same working day (Mon - Fri, except weekend &amp; Public Holiday) </span></p>\r\n<p style=\"line-height: 1;\"><span style=\"color: rgba(0, 0, 0, 0.8); font-family: Roboto, \'Helvetica Neue\', Helvetica, Arial, æ–‡æ³‰é©›æ­£é»‘, \'WenQuanYi Zen Hei\', \'Hiragino Sans GB\', \'å„·é»‘ Pro\', \'LiHei Pro\', \'Heiti TC\', å¾®è»Ÿæ­£é»‘é«”, \'Microsoft JhengHei UI\', \'Microsoft JhengHei\', sans-serif; font-size: 14px; white-space: pre-wrap; background-color: #ffffff;\">- Order normally arrive to your door step within 1-3 working days for West Msia and 5-6 working days for East Msia. </span></p>\r\n<p style=\"line-height: 1;\">&nbsp;</p>\r\n<p style=\"line-height: 1;\"><span style=\"text-decoration: underline;\"><strong><span style=\"color: rgba(0, 0, 0, 0.8); font-family: Roboto, \'Helvetica Neue\', Helvetica, Arial, æ–‡æ³‰é©›æ­£é»‘, \'WenQuanYi Zen Hei\', \'Hiragino Sans GB\', \'å„·é»‘ Pro\', \'LiHei Pro\', \'Heiti TC\', å¾®è»Ÿæ­£é»‘é«”, \'Microsoft JhengHei UI\', \'Microsoft JhengHei\', sans-serif; font-size: 14px; white-space: pre-wrap; background-color: #ffffff; text-decoration: underline;\">ll Feedback &amp; Rating ll</span></strong></span></p>\r\n<p style=\"line-height: 1;\"><span style=\"color: rgba(0, 0, 0, 0.8); font-family: Roboto, \'Helvetica Neue\', Helvetica, Arial, æ–‡æ³‰é©›æ­£é»‘, \'WenQuanYi Zen Hei\', \'Hiragino Sans GB\', \'å„·é»‘ Pro\', \'LiHei Pro\', \'Heiti TC\', å¾®è»Ÿæ­£é»‘é«”, \'Microsoft JhengHei UI\', \'Microsoft JhengHei\', sans-serif; font-size: 14px; white-space: pre-wrap; background-color: #ffffff;\"> - We are incredibly grateful for your awesome review and feedback as it is important for us to do further improve ourself.</span></p>\r\n<p style=\"line-height: 1;\"><span style=\"color: rgba(0, 0, 0, 0.8); font-family: Roboto, \'Helvetica Neue\', Helvetica, Arial, æ–‡æ³‰é©›æ­£é»‘, \'WenQuanYi Zen Hei\', \'Hiragino Sans GB\', \'å„·é»‘ Pro\', \'LiHei Pro\', \'Heiti TC\', å¾®è»Ÿæ­£é»‘é«”, \'Microsoft JhengHei UI\', \'Microsoft JhengHei\', sans-serif; font-size: 14px; white-space: pre-wrap; background-color: #ffffff;\"> - Please rate us 5 stars if you are satisfy with our product(s) and service(s).</span></p>\r\n<p style=\"line-height: 1;\"><span style=\"color: rgba(0, 0, 0, 0.8); font-family: Roboto, \'Helvetica Neue\', Helvetica, Arial, æ–‡æ³‰é©›æ­£é»‘, \'WenQuanYi Zen Hei\', \'Hiragino Sans GB\', \'å„·é»‘ Pro\', \'LiHei Pro\', \'Heiti TC\', å¾®è»Ÿæ­£é»‘é«”, \'Microsoft JhengHei UI\', \'Microsoft JhengHei\', sans-serif; font-size: 14px; white-space: pre-wrap; background-color: #ffffff;\"> - If you are experience something wasn\'t expected on our store, please do not hesitate to [CONTACT US] before leaving any feedback. We will try our best to resolve the issue for you, to your best satisfaction. </span></p>\r\n<p style=\"line-height: 1;\">&nbsp;</p>\r\n<p style=\"line-height: 1;\"><span style=\"text-decoration: underline;\"><strong><span style=\"color: rgba(0, 0, 0, 0.8); font-family: Roboto, \'Helvetica Neue\', Helvetica, Arial, æ–‡æ³‰é©›æ­£é»‘, \'WenQuanYi Zen Hei\', \'Hiragino Sans GB\', \'å„·é»‘ Pro\', \'LiHei Pro\', \'Heiti TC\', å¾®è»Ÿæ­£é»‘é«”, \'Microsoft JhengHei UI\', \'Microsoft JhengHei\', sans-serif; font-size: 14px; white-space: pre-wrap; background-color: #ffffff; text-decoration: underline;\">ll Product Details ll </span></strong></span></p>\r\n<p style=\"line-height: 1;\"><span style=\"color: rgba(0, 0, 0, 0.8); font-family: Roboto, \'Helvetica Neue\', Helvetica, Arial, æ–‡æ³‰é©›æ­£é»‘, \'WenQuanYi Zen Hei\', \'Hiragino Sans GB\', \'å„·é»‘ Pro\', \'LiHei Pro\', \'Heiti TC\', å¾®è»Ÿæ­£é»‘é«”, \'Microsoft JhengHei UI\', \'Microsoft JhengHei\', sans-serif; font-size: 14px; white-space: pre-wrap; background-color: #ffffff;\">YONEX RACQUET BAG 8722MS2</span></p>\r\n<p style=\"line-height: 1;\"><span style=\"color: rgba(0, 0, 0, 0.8); font-family: Roboto, \'Helvetica Neue\', Helvetica, Arial, æ–‡æ³‰é©›æ­£é»‘, \'WenQuanYi Zen Hei\', \'Hiragino Sans GB\', \'å„·é»‘ Pro\', \'LiHei Pro\', \'Heiti TC\', å¾®è»Ÿæ­£é»‘é«”, \'Microsoft JhengHei UI\', \'Microsoft JhengHei\', sans-serif; font-size: 14px; white-space: pre-wrap; background-color: #ffffff;\"> Dimension:33 X 20 X 72 CM </span></p>\r\n<p style=\"line-height: 1;\"><span style=\"color: rgba(0, 0, 0, 0.8); font-family: Roboto, \'Helvetica Neue\', Helvetica, Arial, æ–‡æ³‰é©›æ­£é»‘, \'WenQuanYi Zen Hei\', \'Hiragino Sans GB\', \'å„·é»‘ Pro\', \'LiHei Pro\', \'Heiti TC\', å¾®è»Ÿæ­£é»‘é«”, \'Microsoft JhengHei UI\', \'Microsoft JhengHei\', sans-serif; font-size: 14px; white-space: pre-wrap; background-color: #ffffff;\">Compartments: 1 X </span></p>\r\n<p style=\"line-height: 1;\"><span style=\"color: rgba(0, 0, 0, 0.8); font-family: Roboto, \'Helvetica Neue\', Helvetica, Arial, æ–‡æ³‰é©›æ­£é»‘, \'WenQuanYi Zen Hei\', \'Hiragino Sans GB\', \'å„·é»‘ Pro\', \'LiHei Pro\', \'Heiti TC\', å¾®è»Ÿæ­£é»‘é«”, \'Microsoft JhengHei UI\', \'Microsoft JhengHei\', sans-serif; font-size: 14px; white-space: pre-wrap; background-color: #ffffff;\">Main Compartment,</span></p>\r\n<p style=\"line-height: 1;\"><span style=\"color: rgba(0, 0, 0, 0.8); font-family: Roboto, \'Helvetica Neue\', Helvetica, Arial, æ–‡æ³‰é©›æ­£é»‘, \'WenQuanYi Zen Hei\', \'Hiragino Sans GB\', \'å„·é»‘ Pro\', \'LiHei Pro\', \'Heiti TC\', å¾®è»Ÿæ­£é»‘é«”, \'Microsoft JhengHei UI\', \'Microsoft JhengHei\', sans-serif; font-size: 14px; white-space: pre-wrap; background-color: #ffffff;\"> 1x front compartment,</span></p>\r\n<p style=\"line-height: 1;\"><span style=\"color: rgba(0, 0, 0, 0.8); font-family: Roboto, \'Helvetica Neue\', Helvetica, Arial, æ–‡æ³‰é©›æ­£é»‘, \'WenQuanYi Zen Hei\', \'Hiragino Sans GB\', \'å„·é»‘ Pro\', \'LiHei Pro\', \'Heiti TC\', å¾®è»Ÿæ­£é»‘é«”, \'Microsoft JhengHei UI\', \'Microsoft JhengHei\', sans-serif; font-size: 14px; white-space: pre-wrap; background-color: #ffffff;\"> 1 x accessories compartment,</span></p>\r\n<p style=\"line-height: 1;\"><span style=\"color: rgba(0, 0, 0, 0.8); font-family: Roboto, \'Helvetica Neue\', Helvetica, Arial, æ–‡æ³‰é©›æ­£é»‘, \'WenQuanYi Zen Hei\', \'Hiragino Sans GB\', \'å„·é»‘ Pro\', \'LiHei Pro\', \'Heiti TC\', å¾®è»Ÿæ­£é»‘é«”, \'Microsoft JhengHei UI\', \'Microsoft JhengHei\', sans-serif; font-size: 14px; white-space: pre-wrap; background-color: #ffffff;\"> 1 x shoes compartment ,</span></p>\r\n<p style=\"line-height: 1;\"><span style=\"color: rgba(0, 0, 0, 0.8); font-family: Roboto, \'Helvetica Neue\', Helvetica, Arial, æ–‡æ³‰é©›æ­£é»‘, \'WenQuanYi Zen Hei\', \'Hiragino Sans GB\', \'å„·é»‘ Pro\', \'LiHei Pro\', \'Heiti TC\', å¾®è»Ÿæ­£é»‘é«”, \'Microsoft JhengHei UI\', \'Microsoft JhengHei\', sans-serif; font-size: 14px; white-space: pre-wrap; background-color: #ffffff;\"> 1 x bottle pocket </span></p>\r\n<p style=\"line-height: 1;\">&nbsp;</p>\r\n<p style=\"line-height: 1;\"><strong><span style=\"text-decoration: underline;\"><span style=\"color: rgba(0, 0, 0, 0.8); font-family: Roboto, \'Helvetica Neue\', Helvetica, Arial, æ–‡æ³‰é©›æ­£é»‘, \'WenQuanYi Zen Hei\', \'Hiragino Sans GB\', \'å„·é»‘ Pro\', \'LiHei Pro\', \'Heiti TC\', å¾®è»Ÿæ­£é»‘é«”, \'Microsoft JhengHei UI\', \'Microsoft JhengHei\', sans-serif; font-size: 14px; white-space: pre-wrap; background-color: #ffffff; text-decoration: underline;\">ll Features ll </span></span></strong></p>\r\n<p style=\"line-height: 1;\"><span style=\"color: rgba(0, 0, 0, 0.8); font-family: Roboto, \'Helvetica Neue\', Helvetica, Arial, æ–‡æ³‰é©›æ­£é»‘, \'WenQuanYi Zen Hei\', \'Hiragino Sans GB\', \'å„·é»‘ Pro\', \'LiHei Pro\', \'Heiti TC\', å¾®è»Ÿæ­£é»‘é«”, \'Microsoft JhengHei UI\', \'Microsoft JhengHei\', sans-serif; font-size: 14px; white-space: pre-wrap; background-color: #ffffff;\">1. Backpack Adjustable, padded backpack straps allow the bag to be carried comfortably.</span></p>\r\n<p style=\"line-height: 1;\"><span style=\"color: rgba(0, 0, 0, 0.8); font-family: Roboto, \'Helvetica Neue\', Helvetica, Arial, æ–‡æ³‰é©›æ­£é»‘, \'WenQuanYi Zen Hei\', \'Hiragino Sans GB\', \'å„·é»‘ Pro\', \'LiHei Pro\', \'Heiti TC\', å¾®è»Ÿæ­£é»‘é«”, \'Microsoft JhengHei UI\', \'Microsoft JhengHei\', sans-serif; font-size: 14px; white-space: pre-wrap; background-color: #ffffff;\"> 2. Accessories Compartment Easily accessible storage for extra grips, strings, sweatbands and other accessories. </span></p>\r\n<p style=\"line-height: 1;\"><span style=\"color: rgba(0, 0, 0, 0.8); font-family: Roboto, \'Helvetica Neue\', Helvetica, Arial, æ–‡æ³‰é©›æ­£é»‘, \'WenQuanYi Zen Hei\', \'Hiragino Sans GB\', \'å„·é»‘ Pro\', \'LiHei Pro\', \'Heiti TC\', å¾®è»Ÿæ­£é»‘é«”, \'Microsoft JhengHei UI\', \'Microsoft JhengHei\', sans-serif; font-size: 14px; white-space: pre-wrap; background-color: #ffffff;\">3. Racquets Compartment Foam-Lined Compartment designed to hold a number of racquets.</span></p>\r\n<p style=\"line-height: 1;\"><span style=\"color: rgba(0, 0, 0, 0.8); font-family: Roboto, \'Helvetica Neue\', Helvetica, Arial, æ–‡æ³‰é©›æ­£é»‘, \'WenQuanYi Zen Hei\', \'Hiragino Sans GB\', \'å„·é»‘ Pro\', \'LiHei Pro\', \'Heiti TC\', å¾®è»Ÿæ­£é»‘é«”, \'Microsoft JhengHei UI\', \'Microsoft JhengHei\', sans-serif; font-size: 14px; white-space: pre-wrap; background-color: #ffffff;\">4. Shoe Pocket Shoes can also be packed in shoe packet within the bag.</span></p>\r\n<p style=\"line-height: 1;\"><span style=\"color: rgba(0, 0, 0, 0.8); font-family: Roboto, \'Helvetica Neue\', Helvetica, Arial, æ–‡æ³‰é©›æ­£é»‘, \'WenQuanYi Zen Hei\', \'Hiragino Sans GB\', \'å„·é»‘ Pro\', \'LiHei Pro\', \'Heiti TC\', å¾®è»Ÿæ­£é»‘é«”, \'Microsoft JhengHei UI\', \'Microsoft JhengHei\', sans-serif; font-size: 14px; white-space: pre-wrap; background-color: #ffffff;\"> 5. Main Compartment Foam-lined compartment designed for storage of delicate articles. </span></p>\r\n<p style=\"line-height: 1;\"><span style=\"color: rgba(0, 0, 0, 0.8); font-family: Roboto, \'Helvetica Neue\', Helvetica, Arial, æ–‡æ³‰é©›æ­£é»‘, \'WenQuanYi Zen Hei\', \'Hiragino Sans GB\', \'å„·é»‘ Pro\', \'LiHei Pro\', \'Heiti TC\', å¾®è»Ÿæ­£é»‘é«”, \'Microsoft JhengHei UI\', \'Microsoft JhengHei\', sans-serif; font-size: 14px; white-space: pre-wrap; background-color: #ffffff;\">6. Bottle Pocket Separate storage pocket for a water bottle. </span></p>\r\n<p style=\"line-height: 1;\"><span style=\"color: rgba(0, 0, 0, 0.8); font-family: Roboto, \'Helvetica Neue\', Helvetica, Arial, æ–‡æ³‰é©›æ­£é»‘, \'WenQuanYi Zen Hei\', \'Hiragino Sans GB\', \'å„·é»‘ Pro\', \'LiHei Pro\', \'Heiti TC\', å¾®è»Ÿæ­£é»‘é«”, \'Microsoft JhengHei UI\', \'Microsoft JhengHei\', sans-serif; font-size: 14px; white-space: pre-wrap; background-color: #ffffff;\">7. Retroreflection While carrying the bag, retroreflection allows it to be illuminated from behind.</span></p>', 'yonex_badminton_ba42112sex_r.png', 'red', 'Yonex', 'PU', 'none', 10, '5fc5f446e800e', '5fdb734b188b7', '8', 'no', '', '0000-00-00 00:00:00', '0000-00-00', '5fdb734b188b8', 'remove', '', '2020-12-17 03:03:39', '2020-12-26 04:59:08'),
('5fdb748e3f658', 'Iphone 12 Pro Max', 2599.00, '<p><span style=\"font-family: \'arial black\', sans-serif;\">Super Retina XDR display</span></p>\r\n<p><span style=\"font-family: \'arial black\', sans-serif;\">6.7â€‘inch (diagonal) allâ€‘screen OLED display</span></p>\r\n<p><span style=\"font-family: \'arial black\', sans-serif;\">2778â€‘byâ€‘1284-pixel resolution at 458 ppi</span></p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-family: \'arial black\', sans-serif;\">HDR display</span></p>\r\n<p><span style=\"font-family: \'arial black\', sans-serif;\">True Tone</span></p>\r\n<p><span style=\"font-family: \'arial black\', sans-serif;\">Wide color (P3)</span></p>\r\n<p><span style=\"font-family: \'arial black\', sans-serif;\">Haptic Touch</span></p>\r\n<p><span style=\"font-family: \'arial black\', sans-serif;\">2,000,000:1 contrast ratio (typical)</span></p>\r\n<p><span style=\"font-family: \'arial black\', sans-serif;\">800 nits max brightness (typical); 1200 nits max brightness (HDR)</span></p>\r\n<p><span style=\"font-family: \'arial black\', sans-serif;\">Fingerprint-resistant oleophobic coating</span></p>\r\n<p><span style=\"font-family: \'arial black\', sans-serif;\">Support for display of multiple languages and characters simultaneously</span></p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-family: \'arial black\', sans-serif;\">A14 Bionic chip</span></p>\r\n<p><span style=\"font-family: \'arial black\', sans-serif;\">Nextâ€‘generation Neural Engine</span></p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-family: \'arial black\', sans-serif;\">Made with better materials</span></p>\r\n<p><span style=\"font-family: \'arial black\', sans-serif;\">100% recycled tungsten in the Taptic Engine, representing 99% of the tungsten in the device</span></p>\r\n<p><span style=\"font-family: \'arial black\', sans-serif;\">100% recycled rare earth elements in all magnets, representing 98% of the rare earth elements in the device</span></p>\r\n<p><span style=\"font-family: \'arial black\', sans-serif;\">100% recycled tin in the solder of the main logic board</span></p>\r\n<p><span style=\"font-family: \'arial black\', sans-serif;\">35% or more recycled plastic in multiple components</span></p>\r\n<p><span style=\"font-family: \'arial black\', sans-serif;\">Energy efficient</span></p>\r\n<p><span style=\"font-family: \'arial black\', sans-serif;\">Meets U.S. Department of Energy requirements for battery charger systems</span></p>\r\n<p><span style=\"font-family: \'arial black\', sans-serif;\">Smarter chemistry16</span></p>\r\n<p><span style=\"font-family: \'arial black\', sans-serif;\">Arsenic-free display glass</span></p>\r\n<p><span style=\"font-family: \'arial black\', sans-serif;\">Mercury-free</span></p>\r\n<p><span style=\"font-family: \'arial black\', sans-serif;\">BFR-, PVC-, and beryllium-free</span></p>\r\n<p><span style=\"font-family: \'arial black\', sans-serif;\">Green manufacturing</span></p>\r\n<p><span style=\"font-family: \'arial black\', sans-serif;\">Apple&rsquo;s Zero Waste Program helps suppliers eliminate waste sent to landfill</span></p>\r\n<p><span style=\"font-family: \'arial black\', sans-serif;\">All final assembly supplier sites are transitioning to 100% renewable energy for Apple production</span></p>', 'iphone-12-pro-max1.jpg', 'Blue', 'Apple', 'Super Retina XDR display', 'none', 0, '5fc5f446e800e', '5fdb748e3f659', '2', 'yes', '5fdb748e3f65b', '2021-01-12 22:00:00', '2021-01-12', '5fdb748e3f65a', '', '', '2020-12-17 03:09:02', '2020-12-17 03:09:02'),
('5fdc1019d82f0', 'ADICOLOE CLASSISC 3-STRIPES LONG SLEEVE TEE', 199.00, '<p><strong>ADICOLOR CLASSICS 3-STRIPES LONG SLEEVE TEE</strong></p>\r\n<p>&nbsp;</p>\r\n<p>A LONG SLEEVE TEE WITH A CLASSIC VIBE.</p>\r\n<p>Street style all day, every day. Even when it comes to the basics. This long sleeve tee gets a full makeover with adidas details. A signature Trefoil. Iconic 3-Stripes down the arms. Soft cotton keeps you comfy so you can focus on looking your best.</p>\r\n<p>&nbsp;</p>\r\n<p>Our cotton products support sustainable cotton farming. This is part of our ambition to end plastic waste.</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Specification</strong></p>\r\n<p>-----------------------------</p>\r\n<p>-Slim fit&nbsp; &nbsp; &nbsp; -Raglan sleeves&nbsp; -Ribbed cuffs</p>\r\n<p>-Ribbed crewneck&nbsp; -Single jersey,1x1 rib</p>\r\n<p>-100% cotton single jersey&nbsp; &nbsp;-color</p>\r\n<p>- Sift feel - Product code: GN3478</p>', 'Adicolor_Classics_3-Stripes_Long_Sleeve_Tee_Black_GN3478_01_laydown3.jpg', 'Black', 'Adidas', '', 'male', 0, '1', '5fdc1019d82f2', '0', 'no', '', '0000-00-00 00:00:00', '0000-00-00', '5fdc1019d82f3', 'delete', '', '2020-12-18 02:12:41', '2020-12-18 02:13:42');

-- --------------------------------------------------------

--
-- Table structure for table `productmedia`
--

CREATE TABLE `productmedia` (
  `mediaId` varchar(255) NOT NULL,
  `productId` varchar(255) NOT NULL,
  `filePath` varchar(255) NOT NULL,
  `fileType` varchar(255) NOT NULL,
  `update_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `productmedia`
--

INSERT INTO `productmedia` (`mediaId`, `productId`, `filePath`, `fileType`, `update_time`) VALUES
('Media-5fc612510c56b', '5fc61250ae9a3', 'A1001.jpg', 'image', '2020-11-30 21:52:16'),
('Media-5fc61f672cbff', '5fc61f6709274', 'A333.jpg', 'image', '2020-11-30 22:48:07'),
('Media-5fc61f67357a3', '5fc61f6709274', 'A555.jpg', 'image', '2020-11-30 22:48:07'),
('Media-5fc7befb3d74c', '5fc61250ae9a3', 'A001.jpg', 'image', '2020-12-03 04:21:14'),
('Media-5fc7befb50eb0', '5fc61250ae9a3', 'A003.jpg', 'image', '2020-12-03 04:21:14'),
('Media-5fc7befb5c72f', '5fc61250ae9a3', 'A1001.jpg', 'image', '2020-12-03 04:21:14'),
('Media-5fc8afd787d34', '5fc8afd710cc3', 'A001.jpg', 'image', '2020-12-02 21:28:55'),
('Media-5fc8afd798af4', '5fc8afd710cc3', 'A003.jpg', 'image', '2020-12-02 21:28:55'),
('Media-5fc8afd7ac2b5', '5fc8afd710cc3', 'A1001.jpg', 'image', '2020-12-02 21:28:55'),
('Media-5fc8afd7bfe0c', '5fc8afd710cc3', 'A1002.jpg', 'image', '2020-12-02 21:28:55'),
('Media-5fc8afd7dc0e4', '5fc8afd710cc3', 'Acer Predator 1.png', 'image', '2020-12-02 21:28:55'),
('Media-5fc8c4c3df4bb', '5fc61250ae9a3', 'A1001.jpg', 'image', '2020-12-02 22:58:11'),
('Media-5fc8ced2ea346', '5fc61f6709274', 'A1001.jpg', 'image', '2020-12-02 23:41:06'),
('Media-5fc8ced301828', '5fc61f6709274', 'A1002.jpg', 'image', '2020-12-02 23:41:06'),
('Media-5fc8cf4d341c5', '5fc61f6709274', 'A003.jpg', 'image', '2020-12-02 23:43:09'),
('Media-5fdb748e648ac', '5fdb748e3f658', 'iphone-12-pro-max3.jpg', 'image', '2020-12-17 03:09:02'),
('Media-5fdb748e80da0', '5fdb748e3f658', 'iphone-12-pro-max4.jpg', 'image', '2020-12-17 03:09:02'),
('Media-5fdb748e9fe20', '5fdb748e3f658', 'iphone-12-pro-max5.jpg', 'image', '2020-12-17 03:09:02'),
('Media-5fdb748eb371e', '5fdb748e3f658', 'iphone-12-pro-max6.jpg', 'image', '2020-12-17 03:09:02'),
('Media-5fdb748ec9bbd', '5fdb748e3f658', 'iphone-12-pro-max-gold-hero2.png', 'image', '2020-12-17 03:09:02'),
('Media-5fdc101a2c382', '5fdc1019d82f0', 'Adicolor_Classics_3-Stripes_Long_Sleeve_Tee_Black_GN3478_21_model1.jpg', 'image', '2020-12-18 02:12:41'),
('Media-5fdc101a45ce9', '5fdc1019d82f0', 'Adicolor_Classics_3-Stripes_Long_Sleeve_Tee_Black_GN3478_23_hover_model2.jpg', 'image', '2020-12-18 02:12:41'),
('Media-5fdc101a53f53', '5fdc1019d82f0', 'Adicolor_Classics_3-Stripes_Long_Sleeve_Tee_Black_GN3478_25_outfit4.jpg', 'image', '2020-12-18 02:12:41'),
('Media-5fdc101a5f772', '5fdc1019d82f0', 'Adicolor_Classics_3-Stripes_Long_Sleeve_Tee_Black_GN3478_41_detail5.jpg', 'image', '2020-12-18 02:12:41'),
('Media-5fdc101a70410', '5fdc1019d82f0', 'Adicolor_Classics_3-Stripes_Long_Sleeve_Tee_Black_GN3478_42_detail6.jpg', 'image', '2020-12-18 02:12:41');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `ratingId` varchar(255) NOT NULL,
  `userId` varchar(255) NOT NULL,
  `commentId` varchar(255) NOT NULL,
  `cartIntegrationId` varchar(255) NOT NULL,
  `productId` varchar(255) NOT NULL,
  `ratingValue` int(5) NOT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`ratingId`, `userId`, `commentId`, `cartIntegrationId`, `productId`, `ratingValue`, `created_time`, `update_time`) VALUES
('Rating-5fbe03d178ec2', '5f3cdcd7b7c99', 'Comment-5fbe03d178ec3', '5fba7a0b0b489', '5f4ca33f217a4', 4, '2020-11-25 07:12:17', '2020-11-25 07:12:17'),
('Rating-5fcb4fd97f906', '5f3cdcd7b7c99', 'Comment-5fcb4fd97f907', '5fba0ad859e6a', '5f4bab92de8da', 2, '2020-12-05 09:16:09', '2020-12-05 09:16:09'),
('Rating-5fd0842fd04ad', '5faf8b9b1d929', 'Comment-5fd0842fd04ae', '5fc60b00b504b', '5f4ce967cfd18', 4, '2020-12-09 08:00:47', '2020-12-09 08:00:47'),
('Rating-5fda20f75355e', '5fda1972e9060', 'Comment-5fda20f75355f', '5fda1ba3a7696', '5f4cba82bacbc', 4, '2020-12-16 15:00:07', '2020-12-16 15:00:07'),
('Rating-5fdc1332b8561', '5fdb5ff082420', 'Comment-5fdc1332b8563', '5fdc0f3a859ef', '5f4c8428880fc', 4, '2020-12-18 02:25:54', '2020-12-18 02:25:54');

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE `seller` (
  `sellerId` varchar(255) NOT NULL,
  `sellerName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phoneNo` varchar(255) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `image` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `postalCode` int(5) NOT NULL,
  `businessType` varchar(255) NOT NULL,
  `bankName` varchar(255) NOT NULL,
  `accountNo` int(17) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `lastLogin` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`sellerId`, `sellerName`, `email`, `phoneNo`, `gender`, `image`, `address`, `city`, `state`, `postalCode`, `businessType`, `bankName`, `accountNo`, `password`, `created_time`, `lastLogin`) VALUES
('1', 'Tom', 'tom2580@gmail.com', '0', 'male', 'userman.jpg', 'fweferfr23123', 'selangor', 'audi', 24342, 'business', 'MayBank2U', 2147483647, '$2y$10$hEhOKJZZQw9ZQ71jgczE9OqTEYA3FBI7fub1osrfK4ajMyUbsG/A.', '0000-00-00 00:00:00', '2020-12-31 03:11:31'),
('5fc5f446e800e', 'seller1', 'seller1@gmail.com', '123456789', '', '', '', '', '', 0, '', '', 0, '$2y$10$aCDYOAIY2Mt5IY6JyB1gjeWgwjlfvpjz2RPL7C8rk2YMNde.EGguC', '2020-11-30 19:44:06', '2020-12-26 04:59:15');

-- --------------------------------------------------------

--
-- Table structure for table `track`
--

CREATE TABLE `track` (
  `trackId` varchar(255) NOT NULL,
  `orderId` varchar(255) NOT NULL,
  `trackIntegrationId` varchar(255) NOT NULL,
  `unifiedDelivery` varchar(255) NOT NULL,
  `userReceiverName` varchar(255) NOT NULL,
  `adminReceiveName` varchar(255) NOT NULL,
  `shipId` varchar(255) NOT NULL,
  `currentLocation` varchar(255) NOT NULL,
  `userReceiverDate` timestamp NULL DEFAULT NULL,
  `adminPickUpDate` timestamp NULL DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `estimate_Arrived` timestamp NULL DEFAULT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `track`
--

INSERT INTO `track` (`trackId`, `orderId`, `trackIntegrationId`, `unifiedDelivery`, `userReceiverName`, `adminReceiveName`, `shipId`, `currentLocation`, `userReceiverDate`, `adminPickUpDate`, `status`, `estimate_Arrived`, `created_time`, `update_time`) VALUES
('Track5fd62e9f0b9bc', 'OrderID-5fba12f457234', '5fba12ddd525e', 'Disagree', 'ali', 'Admin5fd30496d366e8.94018912', '5fa50bd9c407a', 'No1,Tman Selantan,Jalan Selantan, Johor Bahru, Johor, 82000,Malaysia', '0000-00-00 00:00:00', '2020-12-13 15:12:15', 'Closed', '2020-12-13 10:09:18', '2020-12-13 15:09:18', '2020-12-13 15:59:39'),
('Track5fd62fb425bdc', 'OrderID-5fbfc95133e07', '5fbfc857b89d7', 'Agree', 'End ', 'Admin5fd30496d366e8.94018912', '5fa50bd9c407a', 'No1,Tman Selantan,Jalan Selantan, Johor Bahru, Johor, 82000,Malaysia', '2020-12-14 09:22:58', '2020-12-13 15:22:55', 'Closed', '2020-12-13 11:20:56', '2020-12-13 15:13:55', '2020-12-14 05:42:17'),
('Track5fd6f0ab5a98c', 'OrderID-5fba7a1479b4f', '5fba7a0b0b489', 'Disagree', 'woonxun', 'Admin5fd30496d366e8.94018912', '5fa50bd9c407a', 'No1,Tman Selantan,Jalan Selantan, Johor Bahru, Johor, 82000,Malaysia', '0000-00-00 00:00:00', '2020-12-18 02:21:23', 'Closed', '2020-12-17 04:57:15', '2020-12-14 04:57:15', '2020-12-18 02:23:17'),
('Track5fd76a979b528', 'OrderID-5fd76a2001aa0', '5fd0995b471d4', 'Disagree', 'woonxun', 'Admin5fd30496d366e8.94018912', '5fa6606d00a4b', 'No1,Tman Selantan,Jalan Selantan, Johor Bahru, Johor, 82000,Malaysia', '2020-12-14 13:49:35', '2020-12-14 13:39:19', 'Closed', '2020-12-14 10:37:27', '2020-12-14 13:37:27', '2020-12-14 13:40:24'),
('Track5fd9f9c6531d6', 'OrderID-5fd9bf2f4bc23', '5fd9bf016eaa0', 'Disagree', '', 'admin1', '5fd9b0d56ddb5', 'warehousre', '0000-00-00 00:00:00', '2020-12-26 06:18:30', 'pending', '2020-12-23 12:12:54', '2020-12-16 12:12:54', '2020-12-26 06:18:30'),
('Track5fda040101660', 'OrderID-5fd76df0bb0c3', '5fd76de20d290', 'Disagree', '', 'admin1', '5fa50bd9c407a', 'warehousre', '0000-00-00 00:00:00', '2020-12-26 06:18:30', 'pending', '2020-12-23 12:56:32', '2020-12-16 12:56:32', '2020-12-26 06:18:30'),
('Track5fda0435766fb', 'OrderID-5fd9bf2f4bc23', '5fd9bf2293708', 'Disagree', '', 'admin1', '5fd9b0d56ddb5', 'warehousre', '0000-00-00 00:00:00', '2020-12-26 06:18:30', 'pending', '2020-12-23 12:57:25', '2020-12-16 12:57:25', '2020-12-26 06:18:30'),
('Track5fda1e832fc52', 'OrderID-5fda1bb2d3875', '5fda1ba3a7696', 'Agree', 'woonxun', 'Admin5fd30496d366e8.94018912', '5fda1a3459c27', 'No a123, Johor Bahru, Johor, 83000,Malaysia', '2020-12-16 14:58:40', '2020-12-16 14:55:39', 'Closed', '2020-12-16 10:49:38', '2020-12-16 14:49:38', '2020-12-16 14:57:30'),
('Track5fda2b57861c5', 'OrderID-5fda2b16ed2cd', '5fda2aa096537', 'Disagree', '', 'admin1', '5fda2b08dcf2b', 'warehousre', '0000-00-00 00:00:00', '2020-12-26 06:18:30', 'pending', '2020-12-23 15:44:23', '2020-12-16 15:44:23', '2020-12-26 06:18:30'),
('Track5fdabe2820ca8', 'OrderID-5fdab96548903', '5fdab959b0ba1', 'Disagree', '', 'admin1', '5fa50bd9c407a', 'warehousre', '0000-00-00 00:00:00', '2020-12-26 06:18:30', 'pending', '2020-12-24 02:10:47', '2020-12-17 02:10:47', '2020-12-26 06:18:30'),
('Track5fdb769e2f63f', 'OrderID-5fdb765d474ca', '5fdb75e85aef1', 'Disagree', '', 'Admin5fd30496d366e8.94018912', '5fdb761948aeb', 'warehousre', '0000-00-00 00:00:00', '2020-12-26 06:23:20', 'Out Of Delivery', '2020-12-24 15:17:50', '2020-12-17 15:17:50', '2020-12-26 06:26:13'),
('Track5fdc10edd1622', 'OrderID-5fdc0f4f577b5', '5fdc0f3a859ef', 'Disagree', 'woonxun', 'Admin5fd30496d366e8.94018912', '5fdc0e7d22e23', 'No 1 Jalan 1, Johor Bahru, Johor, 82000,Malaysia', '2020-12-18 02:25:19', '2020-12-18 02:24:42', 'Closed', '2020-12-18 00:16:13', '2020-12-18 02:16:13', '2020-12-18 02:25:00'),
('Track5fe6d50a00cf5', 'OrderID-5fe6ce6356e16', '5fe6ce5d8d38f', 'Disagree', '', 'Admin5fd30496d366e8.94018912', '5fa50bd9c407a', 'warehousre', '0000-00-00 00:00:00', '2020-12-26 06:20:52', 'picked up', '2020-12-26 06:15:37', '2020-12-26 06:15:37', '2020-12-26 06:20:52');

-- --------------------------------------------------------

--
-- Table structure for table `trackhistory`
--

CREATE TABLE `trackhistory` (
  `trackHistoryId` varchar(255) NOT NULL,
  `trackOrderId` varchar(255) NOT NULL,
  `trackCartIntegrationId` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trackhistory`
--

INSERT INTO `trackhistory` (`trackHistoryId`, `trackOrderId`, `trackCartIntegrationId`, `location`, `status`, `created_time`, `update_time`) VALUES
('TrackHistory5fd62e9f0b9bd0.40676960', 'OrderID-5fba12f457234', 'Track5fd62e9f0b9bc', 'audi', 'In Transit', '2020-12-13 15:09:18', '2020-12-13 15:09:18'),
('TrackHistory5fd62f319c21f6.77447282', 'OrderID-5fba12f457234', 'Track5fd62e9f0b9bc', 'warehouse', 'pending', '2020-12-13 15:11:45', '2020-12-13 15:11:45'),
('TrackHistory5fd62f4fb7e535.74039035', 'OrderID-5fba12f457234', 'Track5fd62e9f0b9bc', 'warehouse', 'picked up', '2020-12-13 15:12:15', '2020-12-13 15:12:15'),
('TrackHistory5fd62fb425bdd9.65924990', 'OrderID-5fbfc95133e07', 'TrackIntegration5fd62fb425bc58.99646482', 'audi', 'In Transit', '2020-12-13 15:13:55', '2020-12-13 15:13:55'),
('TrackHistory5fd6307e0f2719.16172939', 'OrderID-5fbfc95133e07', 'Track5fd62fb425bdc', 'warehouse', 'pending', '2020-12-13 15:17:18', '2020-12-13 15:17:18'),
('TrackHistory5fd6307f47d341.00540495', 'OrderID-5fbfc95133e07', 'Track5fd62fb425bdc', 'warehouse', 'pending', '2020-12-13 15:17:19', '2020-12-13 15:17:19'),
('TrackHistory5fd6308d0aaa77.23918027', 'OrderID-5fbfc95133e07', 'Track5fd62fb425bdc', 'warehouse', 'pending', '2020-12-13 15:17:33', '2020-12-13 15:17:33'),
('TrackHistory5fd630b6bc5c32.73422531', 'OrderID-5fbfc95133e07', 'Track5fd62fb425bdc', 'warehouse', 'pending', '2020-12-13 15:18:14', '2020-12-13 15:18:14'),
('TrackHistory5fd630b7345117.51803838', 'OrderID-5fbfc95133e07', 'Track5fd62fb425bdc', 'warehouse', 'pending', '2020-12-13 15:18:15', '2020-12-13 15:18:15'),
('TrackHistory5fd630b76ed0f7.59536150', 'OrderID-5fbfc95133e07', 'Track5fd62fb425bdc', 'warehouse', 'pending', '2020-12-13 15:18:15', '2020-12-13 15:18:15'),
('TrackHistory5fd630b7964339.27345915', 'OrderID-5fbfc95133e07', 'Track5fd62fb425bdc', 'warehouse', 'pending', '2020-12-13 15:18:15', '2020-12-13 15:18:15'),
('TrackHistory5fd630b7ba04b8.85762809', 'OrderID-5fbfc95133e07', 'Track5fd62fb425bdc', 'warehouse', 'pending', '2020-12-13 15:18:15', '2020-12-13 15:18:15'),
('TrackHistory5fd630b7e3ca19.65493853', 'OrderID-5fbfc95133e07', 'Track5fd62fb425bdc', 'warehouse', 'pending', '2020-12-13 15:18:15', '2020-12-13 15:18:15'),
('TrackHistory5fd630dcb00f16.50667504', 'OrderID-5fbfc95133e07', 'Track5fd62fb425bdc', 'warehouse', 'pending', '2020-12-13 15:18:52', '2020-12-13 15:18:52'),
('TrackHistory5fd630dda8dfd6.50250005', 'OrderID-5fbfc95133e07', 'Track5fd62fb425bdc', 'warehouse', 'pending', '2020-12-13 15:18:53', '2020-12-13 15:18:53'),
('TrackHistory5fd630ddec6077.16597623', 'OrderID-5fbfc95133e07', 'Track5fd62fb425bdc', 'warehouse', 'pending', '2020-12-13 15:18:53', '2020-12-13 15:18:53'),
('TrackHistory5fd630de21a479.93930083', 'OrderID-5fbfc95133e07', 'Track5fd62fb425bdc', 'warehouse', 'pending', '2020-12-13 15:18:54', '2020-12-13 15:18:54'),
('TrackHistory5fd630edeafb66.21391525', 'OrderID-5fbfc95133e07', 'Track5fd62fb425bdc', 'warehouse', 'pending', '2020-12-13 15:19:09', '2020-12-13 15:19:09'),
('TrackHistory5fd630fd3b8988.98955339', 'OrderID-5fbfc95133e07', 'Track5fd62fb425bdc', 'warehouse', 'pending', '2020-12-13 15:19:25', '2020-12-13 15:19:25'),
('TrackHistory5fd630fda172a4.47541210', 'OrderID-5fbfc95133e07', 'Track5fd62fb425bdc', 'warehouse', 'pending', '2020-12-13 15:19:25', '2020-12-13 15:19:25'),
('TrackHistory5fd630fde85bf3.45819194', 'OrderID-5fbfc95133e07', 'Track5fd62fb425bdc', 'warehouse', 'pending', '2020-12-13 15:19:25', '2020-12-13 15:19:25'),
('TrackHistory5fd63117197a55.79628370', 'OrderID-5fbfc95133e07', 'Track5fd62fb425bdc', 'warehouse', 'pending', '2020-12-13 15:19:51', '2020-12-13 15:19:51'),
('TrackHistory5fd6314f370840.52433471', 'OrderID-5fbfc95133e07', 'Track5fd62fb425bdc', 'warehouse', 'pending', '2020-12-13 15:20:47', '2020-12-13 15:20:47'),
('TrackHistory5fd63158e7c850.94579413', 'OrderID-5fbfc95133e07', 'TrackIntegration5fd63158e7c7c2.06603081', 'audi', 'In Transit', '2020-12-13 15:20:56', '2020-12-13 15:20:56'),
('TrackHistory5fd631c370f849.68744201', 'OrderID-5fbfc95133e07', 'Track5fd62fb425bdc', 'warehouse', 'pending', '2020-12-13 15:22:43', '2020-12-13 15:22:43'),
('TrackHistory5fd631cf7c45f4.77435529', 'OrderID-5fbfc95133e07', 'Track5fd62fb425bdc', 'warehouse', 'picked up', '2020-12-13 15:22:55', '2020-12-13 15:22:55'),
('TrackHistory5fd63a39c80632.42098979', 'OrderID-5fba12f457234', 'Track5fd62e9f0b9bc', 'warehouse', 'Out Of Delivery', '2020-12-13 15:58:49', '2020-12-13 15:58:49'),
('TrackHistory5fd63a6b4f0425.16438711', 'OrderID-5fba12f457234', 'Track5fd62e9f0b9bc', 'No1,Tman Selantan,Jalan Selantan, Johor Bahru, Johor, 82000,Malaysia', 'Closed', '2020-12-13 15:59:39', '2020-12-13 15:59:39'),
('TrackHistory5fd6f0ab5a98d9.06965225', 'OrderID-5fba7a1479b4f', 'Track5fd6f0ab5a98c', 'audi', 'In Transit', '2020-12-14 04:57:15', '2020-12-14 04:57:15'),
('TrackHistory5fd6f98ca0bf43.14621347', 'OrderID-5fbfc95133e07', 'Track5fd62fb425bdc', 'warehouse', 'Out Of Delivery', '2020-12-14 05:35:08', '2020-12-14 05:35:08'),
('TrackHistory5fd6f994d6a4a7.11439632', 'OrderID-5fbfc95133e07', 'Track5fd62fb425bdc', 'No1,Tman Selantan,Jalan Selantan, Johor Bahru, Johor, 82000,Malaysia', 'Closed', '2020-12-14 05:35:16', '2020-12-14 05:35:16'),
('TrackHistory5fd6f9d4c62ac2.42625477', 'OrderID-5fbfc95133e07', 'Track5fd62fb425bdc', 'warehouse', 'Out Of Delivery', '2020-12-14 05:36:20', '2020-12-14 05:36:20'),
('TrackHistory5fd6f9dbd8dad9.27110031', 'OrderID-5fbfc95133e07', 'Track5fd62fb425bdc', 'No1,Tman Selantan,Jalan Selantan, Johor Bahru, Johor, 82000,Malaysia', 'Closed', '2020-12-14 05:36:27', '2020-12-14 05:36:27'),
('TrackHistory5fd6fa11f17412.45278633', 'OrderID-5fbfc95133e07', 'Track5fd62fb425bdc', 'No1,Tman Selantan,Jalan Selantan, Johor Bahru, Johor, 82000,Malaysia', 'Closed', '2020-12-14 05:37:21', '2020-12-14 05:37:21'),
('TrackHistory5fd6fb324d4d73.24667515', 'OrderID-5fbfc95133e07', 'Track5fd62fb425bdc', 'warehouse', 'Out Of Delivery', '2020-12-14 05:42:10', '2020-12-14 05:42:10'),
('TrackHistory5fd6fb39a5a9a2.17109512', 'OrderID-5fbfc95133e07', 'Track5fd62fb425bdc', 'No1,Tman Selantan,Jalan Selantan, Johor Bahru, Johor, 82000,Malaysia', 'Closed', '2020-12-14 05:42:17', '2020-12-14 05:42:17'),
('TrackHistory5fd76a979b5293.23879376', 'OrderID-5fd76a2001aa0', 'Track5fd76a979b528', 'audi', 'In Transit', '2020-12-14 13:37:27', '2020-12-14 13:37:27'),
('TrackHistory5fd76afda8b3f2.06389654', 'OrderID-5fd76a2001aa0', 'Track5fd76a979b528', 'warehouse', 'pending', '2020-12-14 13:39:09', '2020-12-14 13:39:09'),
('TrackHistory5fd76b07655f45.51336761', 'OrderID-5fd76a2001aa0', 'Track5fd76a979b528', 'warehouse', 'picked up', '2020-12-14 13:39:19', '2020-12-14 13:39:19'),
('TrackHistory5fd76b2d4ffb91.43236013', 'OrderID-5fd76a2001aa0', 'Track5fd76a979b528', 'warehouse', 'Out Of Delivery', '2020-12-14 13:39:57', '2020-12-14 13:39:57'),
('TrackHistory5fd76b48b48805.33105165', 'OrderID-5fd76a2001aa0', 'Track5fd76a979b528', 'No1,Tman Selantan,Jalan Selantan, Johor Bahru, Johor, 82000,Malaysia', 'Closed', '2020-12-14 13:40:24', '2020-12-14 13:40:24'),
('TrackHistory5fd9f9c6531d71.67002398', 'OrderID-5fd9bf2f4bc23', 'Track5fd9f9c6531d6', 'audi', 'In Transit', '2020-12-16 12:12:54', '2020-12-16 12:12:54'),
('TrackHistory5fda0401016615.00451526', 'OrderID-5fd76df0bb0c3', 'Track5fda040101660', 'audi', 'In Transit', '2020-12-16 12:56:32', '2020-12-16 12:56:32'),
('TrackHistory5fda0435766fd8.86397278', 'OrderID-5fd9bf2f4bc23', 'Track5fda0435766fb', 'audi', 'In Transit', '2020-12-16 12:57:25', '2020-12-16 12:57:25'),
('TrackHistory5fda1e832fc537.27971981', 'OrderID-5fda1bb2d3875', 'TrackIntegration5fda1e832fc492.10619013', 'audi', 'In Transit', '2020-12-16 14:49:38', '2020-12-16 14:49:38'),
('TrackHistory5fda1fdda75536.17507432', 'OrderID-5fda1bb2d3875', 'Track5fda1e832fc52', 'warehouse', 'pending', '2020-12-16 14:55:25', '2020-12-16 14:55:25'),
('TrackHistory5fda1febcc2ee7.24515789', 'OrderID-5fda1bb2d3875', 'Track5fda1e832fc52', 'warehouse', 'picked up', '2020-12-16 14:55:39', '2020-12-16 14:55:39'),
('TrackHistory5fda20365a1dd7.51654303', 'OrderID-5fda1bb2d3875', 'Track5fda1e832fc52', 'warehouse', 'Out Of Delivery', '2020-12-16 14:56:54', '2020-12-16 14:56:54'),
('TrackHistory5fda205a4e41c8.54349971', 'OrderID-5fda1bb2d3875', 'Track5fda1e832fc52', 'No a123, Johor Bahru, Johor, 83000,Malaysia', 'Closed', '2020-12-16 14:57:30', '2020-12-16 14:57:30'),
('TrackHistory5fda2b57861c69.11147374', 'OrderID-5fda2b16ed2cd', 'Track5fda2b57861c5', 'audi', 'In Transit', '2020-12-16 15:44:23', '2020-12-16 15:44:23'),
('TrackHistory5fdabe2820ca97.32682113', 'OrderID-5fdab96548903', 'Track5fdabe2820ca8', 'audi', 'In Transit', '2020-12-17 02:10:47', '2020-12-17 02:10:47'),
('TrackHistory5fdb5d6415c7e3.07770287', 'OrderID-5fba7a1479b4f', 'Track5fd6f0ab5a98c', 'warehouse', 'pending', '2020-12-17 13:30:12', '2020-12-17 13:30:12'),
('TrackHistory5fdb769e2f6409.97967463', 'OrderID-5fdb765d474ca', 'Track5fdb769e2f63f', '', 'In Transit', '2020-12-17 15:17:50', '2020-12-17 15:17:50'),
('TrackHistory5fdc10edd16236.14051664', 'OrderID-5fdc0f4f577b5', 'Track5fdc10edd1622', 'audi', 'In Transit', '2020-12-18 02:16:13', '2020-12-18 02:16:13'),
('TrackHistory5fdc1223a1d087.94564264', 'OrderID-5fba7a1479b4f', 'Track5fd6f0ab5a98c', 'warehouse', 'picked up', '2020-12-18 02:21:23', '2020-12-18 02:21:23'),
('TrackHistory5fdc12601c73a1.85396905', 'OrderID-5fba7a1479b4f', 'Track5fd6f0ab5a98c', 'warehouse', 'Out Of Delivery', '2020-12-18 02:22:24', '2020-12-18 02:22:24'),
('TrackHistory5fdc1295714ed0.47956729', 'OrderID-5fba7a1479b4f', 'Track5fd6f0ab5a98c', 'No1,Tman Selantan,Jalan Selantan, Johor Bahru, Johor, 82000,Malaysia', 'Closed', '2020-12-18 02:23:17', '2020-12-18 02:23:17'),
('TrackHistory5fdc12e07f4692.73650215', 'OrderID-5fdc0f4f577b5', 'Track5fdc10edd1622', 'warehouse', 'pending', '2020-12-18 02:24:32', '2020-12-18 02:24:32'),
('TrackHistory5fdc12ea45fa48.82275976', 'OrderID-5fdc0f4f577b5', 'Track5fdc10edd1622', 'warehouse', 'picked up', '2020-12-18 02:24:42', '2020-12-18 02:24:42'),
('TrackHistory5fdc12f7a90555.83875388', 'OrderID-5fdc0f4f577b5', 'Track5fdc10edd1622', 'warehouse', 'Out Of Delivery', '2020-12-18 02:24:55', '2020-12-18 02:24:55'),
('TrackHistory5fdc12fc9a1766.63155132', 'OrderID-5fdc0f4f577b5', 'Track5fdc10edd1622', 'No 1 Jalan 1, Johor Bahru, Johor, 82000,Malaysia', 'Closed', '2020-12-18 02:25:00', '2020-12-18 02:25:00'),
('TrackHistory5fe6d50a00cf61.15762219', 'OrderID-5fe6ce6356e16', 'Track5fe6d50a00cf5', 'audi', 'In Transit', '2020-12-26 06:15:37', '2020-12-26 06:15:37'),
('TrackHistory5fe6d5b64a2e22.07600887', 'OrderID-5fd9bf2f4bc23', 'Track5fd9f9c6531d6', 'warehouse', 'pending', '2020-12-26 06:18:30', '2020-12-26 06:18:30'),
('TrackHistory5fe6d5b66c65d7.24918700', 'OrderID-5fd76df0bb0c3', 'Track5fda040101660', 'warehouse', 'pending', '2020-12-26 06:18:30', '2020-12-26 06:18:30'),
('TrackHistory5fe6d5b685e063.69610504', 'OrderID-5fd9bf2f4bc23', 'Track5fda0435766fb', 'warehouse', 'pending', '2020-12-26 06:18:30', '2020-12-26 06:18:30'),
('TrackHistory5fe6d5b6a7a198.70480225', 'OrderID-5fda2b16ed2cd', 'Track5fda2b57861c5', 'warehouse', 'pending', '2020-12-26 06:18:30', '2020-12-26 06:18:30'),
('TrackHistory5fe6d5b6c14ba8.87005947', 'OrderID-5fdab96548903', 'Track5fdabe2820ca8', 'warehouse', 'pending', '2020-12-26 06:18:30', '2020-12-26 06:18:30'),
('TrackHistory5fe6d5b6d82e20.91507702', 'OrderID-5fdb765d474ca', 'Track5fdb769e2f63f', 'warehouse', 'pending', '2020-12-26 06:18:30', '2020-12-26 06:18:30'),
('TrackHistory5fe6d5b70302c0.29322462', 'OrderID-5fe6ce6356e16', 'Track5fe6d50a00cf5', 'warehouse', 'pending', '2020-12-26 06:18:30', '2020-12-26 06:18:30'),
('TrackHistory5fe6d644391956.42101850', 'OrderID-5fe6ce6356e16', 'Track5fe6d50a00cf5', 'warehouse', 'picked up', '2020-12-26 06:20:52', '2020-12-26 06:20:52'),
('TrackHistory5fe6d6d8e0ede4.93620980', 'OrderID-5fdb765d474ca', 'Track5fdb769e2f63f', 'warehouse', 'picked up', '2020-12-26 06:23:20', '2020-12-26 06:23:20'),
('TrackHistory5fe6d78528ef80.04233072', 'OrderID-5fdb765d474ca', 'Track5fdb769e2f63f', 'warehouse', 'Out Of Delivery', '2020-12-26 06:26:13', '2020-12-26 06:26:13');

-- --------------------------------------------------------

--
-- Table structure for table `trackintegration`
--

CREATE TABLE `trackintegration` (
  `trackIntegrationId` varchar(255) NOT NULL,
  `cartIntegrationId` varchar(255) NOT NULL,
  `orderId` varchar(255) NOT NULL,
  `shipId` varchar(255) NOT NULL,
  `currentLocation` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `estimate_Arrived` timestamp NULL DEFAULT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trackintegration`
--

INSERT INTO `trackintegration` (`trackIntegrationId`, `cartIntegrationId`, `orderId`, `shipId`, `currentLocation`, `status`, `estimate_Arrived`, `created_time`, `update_time`) VALUES
('TrackIntegration5fd62fb425bc58.99646482', '5fbfc857b89d7', 'OrderID-5fbfc95133e07', '5fa50bd9c407a', 'warehouse', 'closed', '2020-12-20 03:13:55', '2020-12-13 15:13:55', '2020-12-13 15:22:55'),
('TrackIntegration5fd63158e7c7c2.06603081', '5fbfc9348dbf5', 'OrderID-5fbfc95133e07', '5fa50bd9c407a', 'warehouse', 'closed', '2020-12-20 15:20:56', '2020-12-13 15:20:56', '2020-12-13 15:22:55'),
('TrackIntegration5fda1e832fc492.10619013', '5fda1ba3a7696', 'OrderID-5fda1bb2d3875', '5fda1a3459c27', 'warehouse', 'closed', '2020-12-23 14:49:38', '2020-12-16 14:49:38', '2020-12-16 14:55:39');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` varchar(255) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phoneNo` varchar(255) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `birthday` date NOT NULL,
  `image` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `create_date` timestamp NULL DEFAULT NULL,
  `lastLogin` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `userName`, `firstName`, `lastName`, `email`, `phoneNo`, `gender`, `birthday`, `image`, `password`, `create_date`, `lastLogin`) VALUES
('5f3cdcd7b7c99', 'wx', 'l', 'x', 'woonxun@gmail.com', '012-3458790', 'male', '2020-08-04', 'userman.jpg', '$2y$10$3McT6NIjIghhJ9dwpQ/wPehDW9fPiPUixeNvHWditzgH72NMsZcKG', NULL, '0000-00-00 00:00:00'),
('5f4dba8f0962d', 'ali', '', '', 'ali@hotmail.com', '0', '', '0000-00-00', '', '$2y$10$3McT6NIjIghhJ9dwpQ/wPehDW9fPiPUixeNvHWditzgH72NMsZcKG', NULL, '0000-00-00 00:00:00'),
('5faf8b9b1d929', 'testing1', '', '', 'test@gmail.com', '0', 'male', '0000-00-00', '', '$2y$10$3McT6NIjIghhJ9dwpQ/wPehDW9fPiPUixeNvHWditzgH72NMsZcKG', '2020-11-13 19:47:39', '2020-11-13 19:47:39'),
('5faf8cbdc723a', 'testing2', '', '', 'test2@gmail.com', '0', '', '0000-00-00', '', '$2y$10$3McT6NIjIghhJ9dwpQ/wPehDW9fPiPUixeNvHWditzgH72NMsZcKG', '2020-11-13 19:52:29', '2020-11-13 19:52:29'),
('5fd8defb6cd53', 'user', '', '', 'user@gmail.com', '0', 'male', '0000-00-00', 'pexels1.jpeg', '$2y$10$wVRwS6x/DpBu3x91XwM7p.cLgRn4clJ2sz0BMo0.EDSgVxQgpJeS.', '2020-12-16 04:06:19', '2020-12-16 04:06:19'),
('5fd99a5ae4946', 'user1', '', '', 'user1@gmail.com', '0', '', '0000-00-00', '', '$2y$10$SdF9jSJlvePWoRYxjgphGu/pymlWrpgHVt4e4PgcaQ94R.mCJbMOO', '2020-12-15 17:25:46', '2020-12-15 17:25:46'),
('5fda1972e9060', 'user2', '', '', 'user2@gmail.com', '0', 'male', '0000-00-00', 'A1002.jpg', '$2y$10$RhAS4wE4JewxIpHVoQ4p0uOWUInkqybjm4ZUoPsjz1.qPoiEfxcMO', '2020-12-16 02:28:02', '2020-12-16 02:28:02'),
('5fda29b6c63e4', 'user3', '', '', 'user3@gmail.com', '0', '', '0000-00-00', '', '$2y$10$NKD4WoNpzTv3x3optJhXnO4GEQ.jyurJo.Z2bifSwXUhgTcohCUzi', '2020-12-16 03:37:26', '2020-12-16 03:37:26'),
('5fdb5ff082420', 'woonxun', '', '', 'woonxun@gmail.com', '0', '', '0000-00-00', '', '$2y$10$CJEAN9QkV468IEJet3QHCe9G7YN02qqY/2jcf02oKYWnJzJvPO2LS', '2020-12-17 01:41:04', '2020-12-17 01:41:04');

-- --------------------------------------------------------

--
-- Table structure for table `variation`
--

CREATE TABLE `variation` (
  `variationId` varchar(255) NOT NULL,
  `productId` varchar(255) NOT NULL,
  `variation` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `variation`
--

INSERT INTO `variation` (`variationId`, `productId`, `variation`) VALUES
('5f4bab92de8f2', '5f4bab92de8da', 'S'),
('5f4bab9302ffc', '5f4bab92de8da', 'M'),
('5f4bab931bdbf', '5f4bab92de8da', 'L'),
('5f4bab933ae36', '5f4bab92de8da', 'XL'),
('5f4bacacca96d', '5f4bacacca947', 'S'),
('5f4bacaceddf4', '5f4bacacca947', 'M'),
('5f4bacad0de40', '5f4bacacca947', 'L'),
('5f4bacad16abb', '5f4bacacca947', 'XL'),
('5f4bae2e30c46', '5f4bae2e30c1e', 'XS'),
('5f4bae2e3fc35', '5f4bae2e30c1e', 'S'),
('5f4bae2e58348', '5f4bae2e30c1e', 'M'),
('5f4bae2e6433d', '5f4bae2e30c1e', 'L'),
('5f4bae2e6ceeb', '5f4bae2e30c1e', 'XL'),
('5f4baea96ae8e', '5f4baea96ae71', 'XS'),
('5f4baea980365', '5f4baea96ae71', 'S'),
('5f4baea996788', '5f4baea96ae71', 'M'),
('5f4baea99f2e5', '5f4baea96ae71', 'L'),
('5f4baea9b57bd', '5f4baea96ae71', 'XL'),
('5f4baf84af9ed', '5f4baf84af9cb', 'XS'),
('5f4baf84c7cb8', '5f4baf84af9cb', 'S'),
('5f4baf84de234', '5f4baf84af9cb', 'M'),
('5f4baf8502dd0', '5f4baf84af9cb', 'L'),
('5f4baf8524fbd', '5f4baf84af9cb', 'XL'),
('5f4baf9c7c191', '5f4baf9c7c165', 'XS'),
('5f4baf9ca5319', '5f4baf9c7c165', 'S'),
('5f4baf9cadfa6', '5f4baf9c7c165', 'M'),
('5f4baf9cbc221', '5f4baf9c7c165', 'L'),
('5f4baf9cc4ccb', '5f4baf9c7c165', 'XL'),
('5f4bafe900e3b', '5f4bafe900e00', 'XS'),
('5f4bafe910ca7', '5f4bafe900e00', 'S'),
('5f4bafe9198e2', '5f4bafe900e00', 'M'),
('5f4bafe924f75', '5f4bafe900e00', 'L'),
('5f4bafe93066c', '5f4bafe900e00', 'XL'),
('5f4bb00c5846c', '5f4bb00c58451', 'S'),
('5f4bb0a9ca8e3', '5f4bb0a9ca8a9', 'XS'),
('5f4bb0a9d717d', '5f4bb0a9ca8a9', 'S'),
('5f4bb0a9eb41e', '5f4bb0a9ca8a9', 'M'),
('5f4bb0aa13710', '5f4bb0a9ca8a9', 'L'),
('5f4bb0aa2196f', '5f4bb0a9ca8a9', 'XL'),
('5f4bb0cb51249', '5f4bb0cb5123c', 'S'),
('5f4bb1a3ac645', '5f4bb1a3ac62c', 'S'),
('5f4bb2113bd8d', '5f4bb2113bd6f', 'S'),
('5f4bb2324d46d', '5f4bb2324d449', 'S'),
('5f4bb6ff16428', '5f4bb6ff163fc', 'XS'),
('5f4bb6ff285a7', '5f4bb6ff163fc', 'S'),
('5f4bb6ff3e984', '5f4bb6ff163fc', 'M'),
('5f4bb6ff49fb3', '5f4bb6ff163fc', 'L'),
('5f4bb6ff5827b', '5f4bb6ff163fc', 'XL'),
('5f4bb7624287b', '5f4bb76242863', 'XS'),
('5f4bb76250c78', '5f4bb76242863', 'S'),
('5f4bb7625c34e', '5f4bb76242863', 'M'),
('5f4bb76275cd5', '5f4bb76242863', 'L'),
('5f4bb7628cbed', '5f4bb76242863', 'XL'),
('5f4bb7bf6a091', '5f4bb7bf6a044', 'XS'),
('5f4bb7bf78745', '5f4bb7bf6a044', 'S'),
('5f4bb7bf8c235', '5f4bb7bf6a044', 'M'),
('5f4bb7bf9f9c5', '5f4bb7bf6a044', 'L'),
('5f4bb7bfb0855', '5f4bb7bf6a044', 'XL'),
('5f4bb917c6169', '5f4bb917c6150', 'XS'),
('5f4bb917d2302', '5f4bb917c6150', 'S'),
('5f4bb917e653c', '5f4bb917c6150', 'M'),
('5f4bb91803a60', '5f4bb917c6150', 'L'),
('5f4bb91811d1b', '5f4bb917c6150', 'XL'),
('5f4bba11ae03a', '5f4bba11ae026', 'XS'),
('5f4bba11c6de8', '5f4bba11ae026', 'S'),
('5f4bba11d7c79', '5f4bba11ae026', 'M'),
('5f4bba11e3323', '5f4bba11ae026', 'L'),
('5f4bba11ebeb9', '5f4bba11ae026', 'XL'),
('5f4bc4ad1477f', '5f4bc4ad14736', 'XS'),
('5f4bc4ad1dd11', '5f4bc4ad14736', 'S'),
('5f4bc4ad2c7e6', '5f4bc4ad14736', 'M'),
('5f4bc4ad3dfe4', '5f4bc4ad14736', 'L'),
('5f4bc4ad46b91', '5f4bc4ad14736', 'XL'),
('5f4bc6c7d9e23', '5f4bc6c7d9df0', 'XS'),
('5f4bc6c7e6162', '5f4bc6c7d9df0', 'S'),
('5f4bc6c819632', '5f4bc6c7d9df0', 'M'),
('5f4bc6c82a6de', '5f4bc6c7d9df0', 'L'),
('5f4bc6c833234', '5f4bc6c7d9df0', 'XL'),
('5f4bc8579d06d', '5f4bc8579d021', 'XS'),
('5f4bc857bdd28', '5f4bc8579d021', 'S'),
('5f4bc857cc830', '5f4bc8579d021', 'M'),
('5f4bc857dab6e', '5f4bc8579d021', 'L'),
('5f4bc857e3627', '5f4bc8579d021', 'XL'),
('5f4bc857f2365', '5f4bc8579d021', 'XXL'),
('5f4bca07ce530', '5f4bca07ce4ed', 'XS'),
('5f4bca07e549a', '5f4bca07ce4ed', 'S'),
('5f4bca0800f36', '5f4bca07ce4ed', 'M'),
('5f4bca080c666', '5f4bca07ce4ed', 'L'),
('5f4c7cc46ecf0', '5f4c7cc46ecc1', 'XS'),
('5f4c7cc4b5783', '5f4c7cc46ecc1', 'S'),
('5f4c7cc4be2d0', '5f4c7cc46ecc1', 'M'),
('5f4c7cc4c6e3f', '5f4c7cc46ecc1', 'L'),
('5f4c7cc4d2554', '5f4c7cc46ecc1', 'XL'),
('5f4c7e4b1061e', '5f4c7e4b105f3', 'S'),
('5f4c7e4b28f27', '5f4c7e4b105f3', 'M'),
('5f4c7e4b3c8ca', '5f4c7e4b105f3', 'L'),
('5f4c7e4b4aba7', '5f4c7e4b105f3', 'XL'),
('5f4c842888135', '5f4c8428880fc', 'XS'),
('5f4c842896026', '5f4c8428880fc', 'S'),
('5f4c8428aa226', '5f4c8428880fc', 'M'),
('5f4c8428b85d1', '5f4c8428880fc', 'L'),
('5f4c8428c6702', '5f4c8428880fc', 'XL'),
('5f4c8428cc777', '5f4c8428880fc', '2XL'),
('5f4c8428daa7b', '5f4c8428880fc', '3XL'),
('5f4c8428e6195', '5f4c8428880fc', '4XL'),
('5f4c85cad22fd', '5f4c85cad22a6', '28'),
('5f4c85cae4f2d', '5f4c85cad22a6', '29'),
('5f4c85cb044ed', '5f4c85cad22a6', '30'),
('5f4c85cb0fcaa', '5f4c85cad22a6', '31'),
('5f4c85cb188c8', '5f4c85cad22a6', '32'),
('5f4c85cb29664', '5f4c85cad22a6', '33'),
('5f4c85cb34d9a', '5f4c85cad22a6', '34'),
('5f4c873f1e84f', '5f4c873f1e7c6', '29'),
('5f4c873f2cb25', '5f4c873f1e7c6', '30'),
('5f4c873f3acbb', '5f4c873f1e7c6', '31'),
('5f4c873f49023', '5f4c873f1e7c6', '32'),
('5f4c873f57313', '5f4c873f1e7c6', '33'),
('5f4c89ada19a0', '5f4c89ada196f', ''),
('5f4c908adcced', '5f4c908adca06', ''),
('5f4c928888c22', '5f4c928888bd5', ''),
('5f4c94e4b8612', '5f4c94e4b85d0', 'Orang-3in1'),
('5f4c94e4d89a6', '5f4c94e4b85d0', 'Orang-28\''),
('5f4c94e4f2b1f', '5f4c94e4b85d0', 'Orang-24\''),
('5f4c94e5073d0', '5f4c94e4b85d0', 'Orang-20\''),
('5f4c9629431e7', '5f4c96294319d', ''),
('5f4c98b5e3737', '5f4c98b5e36e7', '35'),
('5f4c98b602bac', '5f4c98b5e36e7', '36'),
('5f4c98b60e2fe', '5f4c98b5e36e7', '37'),
('5f4c98b61c53e', '5f4c98b5e36e7', '38'),
('5f4c98b627c0e', '5f4c98b5e36e7', '39'),
('5f4c98b638a55', '5f4c98b5e36e7', '40'),
('5f4c9a10651d0', '5f4c9a1065182', ''),
('5f4c9ab931b82', '5f4c9ab931b56', ''),
('5f4c9bd15cd90', '5f4c9bd15cd5f', ''),
('5f4c9cf7adfa2', '5f4c9cf7adf70', ''),
('5f4c9e34ce2ba', '5f4c9e34ce270', '39'),
('5f4c9e34dc530', '5f4c9e34ce270', '40'),
('5f4c9e34e4ff5', '5f4c9e34ce270', '41'),
('5f4c9e34f32cc', '5f4c9e34ce270', '42'),
('5f4c9e3512982', '5f4c9e34ce270', '43'),
('5f4ca33f217d5', '5f4ca33f217a4', '15.6 Inch - BLACK'),
('5f4ca4a9633c3', '5f4ca4a963399', '50g'),
('5f4ca77889572', '5f4ca778894d1', 'Micro Essence 22ml'),
('5f4ca85947537', '5f4ca859474fe', 'Whitening Essence 30g'),
('5f4caa5a59f41', '5f4caa5a59f11', 'Crush Green'),
('5f4caa5a71c07', '5f4caa5a59f11', 'Midnight Black'),
('5f4caa5a7fe9c', '5f4caa5a59f11', 'Sakura Pink'),
('5f4cabee190af', '5f4cabee19080', 'Black'),
('5f4cabee274b4', '5f4cabee19080', 'Pink'),
('5f4cabee38263', '5f4cabee19080', 'Red'),
('5f4cae4b7f9ab', '5f4cae4b7f977', 'Lightening Black'),
('5f4cae4b8a119', '5f4cae4b7f977', 'Unicorn White'),
('5f4cb042d218e', '5f4cb042d2153', 'M12a Printer'),
('5f4cb176e012b', '5f4cb176e00e9', 'Laptop 14s-dq1029tu'),
('5f4cba82bacf4', '5f4cba82bacbc', 'FA506I-HHN137T'),
('5f4cba82d223b', '5f4cba82bacbc', 'FA506I-IHN240T'),
('5f4cba82e0318', '5f4cba82bacbc', 'FA506I-IHN241T'),
('5f4cba82ee5df', '5f4cba82bacbc', 'FA506I-VHN248T'),
('5f4cba8305adb', '5f4cba82bacbc', 'FA506I-VAL118T'),
('5f4cba830e72a', '5f4cba82bacbc', 'FA706I-UH7078T'),
('5f4cba83171aa', '5f4cba82bacbc', 'FA506I-UHN203T'),
('5f4cba8325533', '5f4cba82bacbc', ' FA706I-IH7079T'),
('5f4cba8330c31', '5f4cba82bacbc', 'A506I-IHN241T'),
('5f4cbb8233c8d', '5f4cbb8233c60', '15.6\" FHD IPS 144Hz '),
('5f4cbcbe8f2ef', '5f4cbcbe8f2bf', '16 GB'),
('5f4cbcbeac69e', '5f4cbcbe8f2bf', '32 GB'),
('5f4cbcbec7efc', '5f4cbcbe8f2bf', '64 GB'),
('5f4cbcbed614b', '5f4cbcbe8f2bf', '128 GB'),
('5f4cbe043efb0', '5f4cbe043ef7e', 'Single Pack One Dozen'),
('5f4cbef97e2c1', '5f4cbef97e297', 'Size 7 B7G2010 FIBA'),
('5f4cc04f3dd69', '5f4cc04f3dd3e', 'XXS'),
('5f4cc04f5fe59', '5f4cc04f3dd3e', 'XS'),
('5f4cc04f76c8d', '5f4cc04f3dd3e', 'S'),
('5f4cc04f905ad', '5f4cc04f3dd3e', 'M'),
('5f4cc04fa13ae', '5f4cc04f3dd3e', 'L'),
('5f4cc04fa9f63', '5f4cc04f3dd3e', 'XL'),
('5f4cc04fb81a7', '5f4cc04f3dd3e', 'XXL'),
('5f4cc04fbe204', '5f4cc04f3dd3e', 'XXXL'),
('5f4cc1785bceb', '5f4cc1785bcba', '3UG5'),
('5f4cc1788ac10', '5f4cc1785bcba', '4UG5'),
('5f4cc2f6208f6', '5f4cc2f6208ad', '4 oz Clear'),
('5f4cc2f642db6', '5f4cc2f6208ad', '4 oz Pink'),
('5f4cc2f65381c', '5f4cc2f6208ad', '4 oz Blue'),
('5f4cc2f66199c', '5f4cc2f6208ad', '9 oz Clear'),
('5f4cc2f66a522', '5f4cc2f6208ad', '9 oz Pink'),
('5f4cc2f6730b4', '5f4cc2f6208ad', '9 oz Blue'),
('5f4cc2f68734f', '5f4cc2f6208ad', '11 oz Clear'),
('5f4cc41b213c0', '5f4cc41b21396', '800g x 5'),
('5f4cc4f753040', '5f4cc4f753019', '500ml'),
('5f4cc66a84e2f', '5f4cc66a84dfd', 'Seafood Cocktail 1+'),
('5f4cc66a9162d', '5f4cc66a84dfd', 'Tune & White Fish 1+'),
('5f4cc66aa2580', '5f4cc66a84dfd', 'Tune +1'),
('5f4cc66ab32d9', '5f4cc66a84dfd', 'Ocean Fish 1+'),
('5f4cc66abe86b', '5f4cc66a84dfd', 'Mackerel 1+'),
('5fc61250d616d', '5fc61250ae9a3', '64 GB'),
('5fc742e216488', '5fc742e1c9087', '64 GB'),
('5fc786dc44b50', '5fc786dbc5c61', '128 GB'),
('5fc7befb18593', '5fc61250ae9a3', '128 GB'),
('5fc7befb34b60', '5fc61250ae9a3', '256 GB'),
('5fc8562f3d498', '5f4c935ae05df', 'none'),
('5fc8afd72f751', '5fc8afd710cc3', '64 GB'),
('5fc8afd74664a', '5fc8afd710cc3', '128 GB'),
('5fc8afd768b74', '5fc8afd710cc3', '258 GB'),
('5fc8afd776d9c', '5fc8afd710cc3', '528 GB'),
('5fc8bf02ea300', '5fc8bf02a9bde', '123 GB'),
('5fc8ced2cb1c0', '5fc61f6709274', '20 kg'),
('5fc8e8b3430a3', '5f4ce7eb993a3', 'none'),
('5fc8e8f7140e4', '5fc786dbc5c61', '258 GB'),
('5fc8f46b5d2d4', '5fc8f46b0603c', '7 - 7.9 Inches'),
('5fcc68d244422', '5fc8bf02a9bde', '1 TB '),
('5fdb734bdd3ff', '5fdb734b188b5', '29x18x50cm 2^L'),
('5fdb748e569e4', '5fdb748e3f658', '218 GB'),
('5fdc101a04a4a', '5fdc1019d82f0', 'XS'),
('5fdc101a0ffdc', '5fdc1019d82f0', 'S'),
('5fdc101a20c23', '5fdc1019d82f0', 'M');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actioncenter`
--
ALTER TABLE `actioncenter`
  ADD PRIMARY KEY (`actionId`);

--
-- Indexes for table `address_shipping`
--
ALTER TABLE `address_shipping`
  ADD PRIMARY KEY (`ship_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `auctionrecord`
--
ALTER TABLE `auctionrecord`
  ADD PRIMARY KEY (`auctionRecordId`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartId`);

--
-- Indexes for table `cartintegration`
--
ALTER TABLE `cartintegration`
  ADD PRIMARY KEY (`cartIntegrationId`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryId`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`commentId`);

--
-- Indexes for table `feedback_image`
--
ALTER TABLE `feedback_image`
  ADD PRIMARY KEY (`feedbackId`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`imagesId`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`inventoryId`);

--
-- Indexes for table `orderlist`
--
ALTER TABLE `orderlist`
  ADD PRIMARY KEY (`orderId`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productmedia`
--
ALTER TABLE `productmedia`
  ADD PRIMARY KEY (`mediaId`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`ratingId`);

--
-- Indexes for table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`sellerId`);

--
-- Indexes for table `track`
--
ALTER TABLE `track`
  ADD PRIMARY KEY (`trackId`);

--
-- Indexes for table `trackhistory`
--
ALTER TABLE `trackhistory`
  ADD PRIMARY KEY (`trackHistoryId`);

--
-- Indexes for table `trackintegration`
--
ALTER TABLE `trackintegration`
  ADD PRIMARY KEY (`trackIntegrationId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `variation`
--
ALTER TABLE `variation`
  ADD PRIMARY KEY (`variationId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
