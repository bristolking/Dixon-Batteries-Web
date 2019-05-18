-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 18, 2019 at 02:39 PM
-- Server version: 5.7.25
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dixonbat_dixon_batteries`
--

-- --------------------------------------------------------

--
-- Table structure for table `battery_analysis`
--

CREATE TABLE `battery_analysis` (
  `battery_analysis_id` int(11) NOT NULL,
  `battery_sno` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `ocv` varchar(255) NOT NULL,
  `physical_status` varchar(255) NOT NULL,
  `acid_level` varchar(255) NOT NULL,
  `cell_wise_acid_sp_gr` varchar(255) DEFAULT NULL,
  `charge_details` varchar(255) DEFAULT NULL,
  `test_details` varchar(255) DEFAULT NULL,
  `battery_resend_on` varchar(255) DEFAULT NULL,
  `replaced_battery_sno` varchar(255) DEFAULT NULL,
  `dealer_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `battery_analysis`
--

INSERT INTO `battery_analysis` (`battery_analysis_id`, `battery_sno`, `product_id`, `ocv`, `physical_status`, `acid_level`, `cell_wise_acid_sp_gr`, `charge_details`, `test_details`, `battery_resend_on`, `replaced_battery_sno`, `dealer_id`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(3, '1', 5, '1', 'good', 'good', '1234', 'good', 'good', '23-04-2019', '11', 2, 1, 1, '2019-04-19 17:15:48', '2019-04-24 14:49:33'),
(4, '3423', 41, '3', 'good', 'good', NULL, NULL, NULL, NULL, NULL, 15, 1, 1, '2019-04-24 17:17:49', '2019-04-24 17:17:57'),
(5, '123', 43, '1', 'good', 'good', '1', 'good', 'good', '2019-02-18', '345', 15, 1, 15, '2019-04-25 12:05:23', '2019-04-25 12:05:23'),
(6, '1234', 43, '2', 'good', 'good', '2', 'good', 'good', '2019-04-26', '22344555', 15, 1, 15, '2019-04-25 13:30:19', '2019-04-25 13:30:19'),
(7, '126', 35, '2', 'good', 'good', 'good', 'good', 'good', '2019-04-25', '45', 15, 1, 15, '2019-04-26 15:04:04', '2019-04-26 15:04:04'),
(8, '12', 5, '12', 'good', 'good', 'good', 'good', 'good', '26-04-2019', '123', 15, 1, 15, '2019-04-26 17:54:10', '2019-04-26 17:54:10');

-- --------------------------------------------------------

--
-- Table structure for table `battery_complaints`
--

CREATE TABLE `battery_complaints` (
  `battery_complaint_id` int(11) NOT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `battery_serial_no` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `complaint_date` varchar(255) NOT NULL,
  `complaint` varchar(255) NOT NULL,
  `dealer_id` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `battery_complaints`
--

INSERT INTO `battery_complaints` (`battery_complaint_id`, `customer_name`, `battery_serial_no`, `product_id`, `complaint_date`, `complaint`, `dealer_id`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(4, NULL, '3', 35, '', 'not happening', 15, 1, 1, '2019-04-19 13:17:21', '2019-04-19 14:18:21'),
(5, 'Tester', '12345678910', 43, '16-04-2019', 'This is some content', 15, 1, 1, '2019-04-25 12:45:38', '2019-04-25 14:21:51'),
(6, 'one customer', '34234', 14, '02-04-2019', 'acid level', 2, 1, 1, '2019-04-25 14:23:14', '2019-04-25 14:23:14'),
(7, 'Tester', '9876543210', 43, '26-04-2019', 'this is some content', 15, 1, 15, '2019-04-26 15:33:36', '2019-04-26 15:33:36'),
(8, 'Tester', '9876543210', 43, '26-04-2019', 'this is some content', 15, 1, 15, '2019-04-26 15:34:20', '2019-04-26 15:34:20'),
(9, 'tester', '12000', 43, '26-04-2019', 'this ', 15, 1, 15, '2019-04-26 15:35:47', '2019-04-26 15:35:47'),
(10, 'Tester', '1230000', 7, '26-04-2019', 'this is ', 15, 1, 15, '2019-04-26 16:44:13', '2019-04-26 16:44:13'),
(11, 'nag', '1230', 9, '26-04-2019', 'this is test msg', 15, 1, 15, '2019-04-26 17:48:47', '2019-04-26 17:48:47');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_desc` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_desc`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Inverter Batteries', NULL, 1, 15, '2019-02-18 05:59:28', '2019-04-09 13:27:27'),
(2, 'Automotive Batteries', NULL, 1, 15, '2019-02-27 08:41:38', '2019-04-09 13:28:14'),
(3, 'Bike Batteries', NULL, 1, 15, '2019-04-09 13:28:31', '2019-04-09 13:28:31'),
(4, 'Solor Batteries', NULL, 1, 15, '2019-04-09 13:28:44', '2019-04-09 13:28:44'),
(5, 'Automotive Green Batteries', NULL, 1, 15, '2019-04-09 13:29:02', '2019-04-09 13:29:02');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_number` varchar(255) DEFAULT '0',
  `dealer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `lr_number` varchar(255) DEFAULT NULL,
  `accepted_date` varchar(255) DEFAULT NULL,
  `dispatched_date` varchar(255) DEFAULT NULL,
  `pending_date` varchar(255) DEFAULT NULL,
  `declined_date` varchar(255) DEFAULT NULL,
  `delivered_date` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_number`, `dealer_id`, `product_id`, `quantity`, `lr_number`, `accepted_date`, `dispatched_date`, `pending_date`, `declined_date`, `delivered_date`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(3, 'Perfect orders', 2, 5, 10, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2019-03-17 13:11:14', '2019-04-17 13:16:28'),
(4, 'tst', 2, 6, 5, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2019-04-17 15:31:23', '2019-04-17 15:31:23'),
(5, 'sample', 4, 7, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2019-04-17 15:32:09', '2019-04-17 15:32:09'),
(6, 'First Order', 2, 5, 3, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2019-04-17 15:33:31', '2019-04-17 15:33:31'),
(7, '4343434432', 2, 8, 100, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2019-04-17 18:32:38', '2019-04-23 16:58:58'),
(8, '1', 2, 37, 123, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2019-04-18 18:28:02', '2019-04-18 18:46:54'),
(9, '1234', 15, 43, 12, NULL, NULL, NULL, NULL, NULL, NULL, 1, 15, '2019-03-19 12:33:24', '2019-04-19 12:33:24'),
(10, '1234', 15, 43, 12, NULL, NULL, NULL, NULL, NULL, NULL, 1, 15, '2019-04-19 12:43:37', '2019-04-19 12:43:37'),
(11, '1234', 15, 43, 4, NULL, NULL, NULL, NULL, NULL, NULL, 2, 1, '2019-04-23 17:56:43', '2019-04-24 12:34:03'),
(12, '0215', 15, 43, 4, NULL, NULL, NULL, NULL, NULL, NULL, 1, 15, '2019-04-23 17:57:06', '2019-04-23 17:57:06'),
(13, '13', 15, 43, 2, NULL, NULL, NULL, NULL, NULL, NULL, 1, 15, '2019-04-23 18:15:13', '2019-04-23 18:15:13'),
(14, '14', 15, 43, 2, NULL, NULL, NULL, NULL, NULL, NULL, 5, 1, '2019-04-23 18:15:48', '2019-04-24 12:23:19'),
(15, '15', 15, 43, 2, NULL, NULL, NULL, NULL, NULL, NULL, 4, 1, '2019-04-23 18:16:48', '2019-04-24 12:23:10'),
(16, '16', 15, 43, 2, NULL, NULL, NULL, NULL, NULL, NULL, 3, 1, '2019-04-23 18:17:14', '2019-04-24 12:22:50'),
(17, '17', 15, 43, 4, NULL, NULL, NULL, NULL, NULL, NULL, 2, 1, '2019-04-23 18:18:24', '2019-04-24 12:22:37'),
(18, '16', 15, 5, 15, NULL, NULL, NULL, NULL, NULL, NULL, 1, 15, '2019-04-24 17:03:14', '2019-04-24 17:03:14'),
(19, '17', 15, 6, 20, NULL, NULL, NULL, NULL, NULL, NULL, 1, 15, '2019-04-24 17:05:06', '2019-04-24 17:05:06'),
(20, '18', 15, 5, 120, NULL, NULL, NULL, NULL, NULL, NULL, 1, 15, '2019-04-26 10:19:37', '2019-04-26 10:19:37'),
(21, '19', 15, 19, 123, NULL, NULL, NULL, NULL, NULL, NULL, 1, 15, '2019-04-26 17:30:32', '2019-04-26 17:30:32'),
(22, '20', 15, 28, 12, NULL, NULL, NULL, NULL, NULL, NULL, 1, 15, '2019-04-26 17:34:55', '2019-04-26 17:34:55'),
(23, '21', 15, 28, 13, NULL, NULL, NULL, NULL, NULL, NULL, 1, 15, '2019-04-26 17:35:27', '2019-04-26 17:35:27'),
(24, '22', 15, 5, 10, 'DE1234', NULL, NULL, NULL, NULL, NULL, 1, 1, '2019-04-27 13:18:32', '2019-04-29 16:03:14'),
(25, '32323231', 17, 8, 5, 'eqw32321', '29-04-2019', '30-04-2019', '01-05-2019', '02-05-2019', '03-05-2019', 5, 1, '2019-04-29 16:14:23', '2019-04-29 16:42:15'),
(26, '34224', 16, 7, 2, 'DE123433', '29-04-2019', '30-04-2019', '30-04-2019', '31-05-2019', NULL, 4, 1, '2019-04-29 17:25:44', '2019-04-29 19:09:02');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('info@cancri.in', '$2y$10$tPJUQbLxX2x6c1KJh3dJl.djgQ01NqiZsnjvfqH.Sn3j9.EVfP0wq', '2019-02-27 01:25:41'),
('ramu.bandarupalli@cancri.in', '$2y$10$zFTLKB/Q6hCTNcQIZa9me.Gkl/K/DDe5V0vGGk/Xomt0EMXZ4E0Xi', '2019-03-01 01:31:10');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `model` varchar(255) NOT NULL,
  `container` varchar(255) NOT NULL,
  `capacity` varchar(255) NOT NULL,
  `length` varchar(255) NOT NULL,
  `width` varchar(255) NOT NULL,
  `height` varchar(255) NOT NULL,
  `charging_current` varchar(255) NOT NULL,
  `filled_weight` varchar(255) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `points` varchar(5) NOT NULL DEFAULT '0',
  `price` float NOT NULL DEFAULT '0',
  `image_paths` longtext,
  `status` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `model`, `container`, `capacity`, `length`, `width`, `height`, `charging_current`, `filled_weight`, `sub_category_id`, `points`, `price`, `image_paths`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(5, 'DTTB-1100', 'IT 500', '110 AH', '498', '186', '498', '11', '50', 1, '2', 1, '[\"http:\\/\\/app.dixonbattery.com\\/public\\/uploads\\/images\\/11310220191804_Dixon.jpg\"]', 1, 1, '2019-04-10 11:54:11', '2019-04-23 13:03:53'),
(6, 'DTTB-1300', 'IT 500', '130 AH', '498', '186', '498', '13', '53', 1, '1', 0, NULL, 1, 1, '2019-04-10 12:06:39', '2019-04-23 13:03:30'),
(7, 'DTTB-1600', 'IT 500', '150 Ah', '498', '186', '498', '19', '57', 1, '0', 0, NULL, 1, 1, '2019-04-10 12:10:19', '2019-04-23 13:03:12'),
(8, 'DTTB-1800', 'IT 500', '180 AH', '498', '186', '498', '18', '61', 1, '1', 0, NULL, 1, 1, '2019-04-10 12:24:44', '2019-04-23 13:09:31'),
(9, 'DTTB-2000', 'IT 500', '200 AH', '498', '186', '498', '20', '64', 1, '0', 0, NULL, 1, 1, '2019-04-10 12:25:22', '2019-04-23 13:02:55'),
(10, 'DTTB-1650', 'IT 500', '165 AH', '498', '186', '498', '16', '16', 2, '0', 0, NULL, 1, 1, '2019-04-10 12:26:16', '2019-04-23 13:02:38'),
(11, 'DTTB-1900', 'IT 500', '190 AH', '498', '186', '498', '18', '18', 2, '0', 0, NULL, 1, 1, '2019-04-10 12:26:56', '2019-04-23 13:02:21'),
(12, 'DTTB-2200', 'IT 500', '220 AH', '498', '186', '498', '20', '20', 2, '0', 0, NULL, 1, 1, '2019-04-10 12:31:31', '2019-04-23 13:02:05'),
(13, 'DTTB-1650', 'IT 500', '165 AH', '498', '186', '498', '18', '62', 3, '0', 0, NULL, 1, 1, '2019-04-10 12:32:32', '2019-04-23 13:01:49'),
(14, 'DTTB-2200', 'IT 500', '220 AH', '498', '186', '498', '20', '69', 3, '0', 0, NULL, 1, 1, '2019-04-10 12:35:10', '2019-04-23 13:01:31'),
(15, 'DB-44B 20R/L', 'NS-40', '35 AH', '195', '127', '220', '3', '9', 4, '1', 0, NULL, 1, 1, '2019-04-10 12:54:29', '2019-04-23 13:04:43'),
(16, 'DB-650 60R/L', 'N-50', '50 AH', '260', '172', '225', '5', '16', 4, '1', 0, NULL, 1, 1, '2019-04-10 13:01:05', '2019-04-23 13:01:00'),
(17, 'DB-800 80R/L', 'N-70', '80 AH', '303', '173', '225', '7', '19', 4, '1', 0, NULL, 1, 1, '2019-04-10 13:03:53', '2019-04-23 13:07:07'),
(18, 'DB-900 90', 'N-100', '90 AH', '408', '172', '232', '9', '25.6', 4, '1', 0, NULL, 1, 1, '2019-04-10 13:05:18', '2019-04-23 13:00:43'),
(19, 'DB-115D 31', 'N-100', '95 AH', '408', '172', '232', '9', '26.3', 5, '1', 0, NULL, 1, 1, '2019-04-10 13:06:19', '2019-04-23 13:00:25'),
(20, 'DB-1000', 'N-100', '100 AH', '408', '172', '232', '10', '27', 4, '1', 0, NULL, 1, 1, '2019-04-10 13:07:08', '2019-04-23 13:00:04'),
(21, 'DB-1200', 'N-120', '120 AH', '515', '185', '230', '12', '33', 4, '1', 0, NULL, 1, 1, '2019-04-10 13:08:06', '2019-04-23 12:59:44'),
(22, 'DB-1500', 'N-150', '150 AH', '515', '212', '230', '15', '36.4', 4, '1', 0, NULL, 1, 1, '2019-04-10 13:09:36', '2019-04-23 12:59:27'),
(23, 'DB-1800', 'N-200', '180 AH', '519', '273', '230', '15', '45', 4, '1', 0, NULL, 1, 1, '2019-04-10 13:10:30', '2019-04-23 12:59:11'),
(24, 'DB-44 0R/L', 'NS-40', '35 AH', '195', '127', '220', '3.5', '10.1', 5, '1', 0, NULL, 1, 1, '2019-04-10 13:11:27', '2019-04-23 12:58:53'),
(25, 'DB-65D 26R/L', 'N-50', '60 AH', '260', '172', '255', '6', '17', 5, '1', 0, NULL, 1, 1, '2019-04-10 13:12:44', '2019-04-23 12:58:30'),
(26, 'DB-80D 26R', 'N-50', '65 AH', '260', '172', '225', '6.5', '17.5', 5, '1', 0, NULL, 1, 1, '2019-04-10 13:13:34', '2019-04-23 12:58:14'),
(27, 'DB-95D 31R', 'N-70', '80 AH', '303', '173', '225', '8', '20', 5, '1', 0, NULL, 1, 1, '2019-04-10 13:14:26', '2019-04-23 12:57:53'),
(28, 'DB-105D 31R/L', 'N-70', '85 AH', '303', '173', '225', '8.5', '21', 5, '1', 0, NULL, 1, 1, '2019-04-10 13:15:13', '2019-04-23 12:57:35'),
(29, 'DB-950', 'N-100', '95 AH', '408', '172', '232', '9', '26.5', 5, '1', 0, NULL, 1, 1, '2019-04-10 13:16:10', '2019-04-23 12:57:17'),
(30, 'DB-226E41', 'N-100', '105 AH', '408', '172', '232', '10', '27.5', 5, '1', 0, NULL, 1, 1, '2019-04-10 13:16:54', '2019-04-23 12:56:58'),
(31, 'DB-1350', 'N-120', '135 AH', '515', '185', '230', '13', '36', 5, '1', 0, NULL, 1, 1, '2019-04-10 13:18:03', '2019-04-23 12:55:36'),
(32, 'DB-165G51', 'N-150', '160 AH', '515', '212', '230', '16', '42', 5, '1', 0, NULL, 1, 1, '2019-04-10 13:19:00', '2019-04-23 12:54:58'),
(33, 'DB-2000', 'N-200', '200 AH', '519', '273', '230', '20', '48', 5, '1', 0, NULL, 1, 1, '2019-04-10 13:20:21', '2019-04-23 12:54:39'),
(34, 'DJB-1000', 'JUM-200', '100', '519', '273', '275', '10', '42', 6, '1', 0, NULL, 1, 1, '2019-04-10 14:53:01', '2019-04-23 12:53:55'),
(35, 'DJB-1200', 'DJB-1200', '120', '519', '273', '275', '12', '46', 6, '1', 0, NULL, 1, 1, '2019-04-10 14:56:44', '2019-04-23 12:53:36'),
(36, 'DJB-1500', 'JUM-200', '150', '519', '273', '275', '15', '51', 6, '1', 0, NULL, 1, 1, '2019-04-10 14:57:29', '2019-04-23 12:53:16'),
(37, 'DJB-2000', 'JUM-200', '200', '519', '273', '275', '20', '54', 6, '1', 0, NULL, 1, 1, '2019-04-10 14:58:20', '2019-04-23 12:52:50'),
(38, 'DSB-20', 'N-70', '20', '303', '173', '225', '2', '18', 7, '1', 0, NULL, 1, 1, '2019-04-10 14:59:55', '2019-04-23 12:52:29'),
(39, 'DSB-40', 'N-100', '40', '408', '172', '232', '4', '26', 7, '1', 0, NULL, 1, 1, '2019-04-10 15:00:47', '2019-04-23 12:52:11'),
(40, 'DSB-60', 'N-120', '60', '515', '185', '230', '6', '40', 7, '1', 0, NULL, 1, 1, '2019-04-10 15:01:39', '2019-04-23 12:51:45'),
(41, 'DSB-175', 'N-150', '75', '515', '212', '230', '8', '54', 7, '1', 0, NULL, 1, 1, '2019-04-10 15:02:24', '2019-04-23 12:51:28'),
(42, 'DTTB-1650', 'IT 500', '165 AH', '498', '186', '498', '18', '62', 8, '1', 0, NULL, 1, 1, '2019-04-10 15:03:18', '2019-04-23 12:51:05'),
(43, 'DTTB-2200', 'IT 500', '220 AH', '498', '186', '498', '20', '69', 8, '1', 0, NULL, 1, 1, '2019-04-10 15:04:04', '2019-04-23 13:11:03');

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE `promotions` (
  `promotion_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `expiry_date` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `promotions`
--

INSERT INTO `promotions` (`promotion_id`, `title`, `content`, `image_path`, `expiry_date`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(3, 'Lorem Ipsum', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'http://app.dixonbattery.com/public/uploads/images/03413320192004_Dixon.jpg', '30-04-2019', 1, 1, '2019-04-20 15:41:33', '2019-04-26 17:51:08');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `sub_cat_id` int(11) NOT NULL,
  `sub_category_name` varchar(255) NOT NULL,
  `sub_category_desc` varchar(255) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`sub_cat_id`, `sub_category_name`, `sub_category_desc`, `category_id`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'IT battery specification chart 60 months (30+30)', NULL, 1, 1, 15, '2019-03-14 11:26:34', '2019-04-09 14:15:43'),
(2, 'IT battery specification chart 72 months (30+30)', NULL, 1, 1, 15, '2019-04-09 14:16:03', '2019-04-09 14:16:03'),
(3, 'IT battery specification chart 72 months (42+30)', NULL, 1, 1, 15, '2019-04-09 14:16:24', '2019-04-09 14:16:24'),
(4, 'Automotive battery specification chart (18 Months: 12+6)', NULL, 2, 1, 15, '2019-04-09 14:18:24', '2019-04-09 14:18:24'),
(5, 'Automotive battery specification chart (24 Months: 18+6)', NULL, 2, 1, 15, '2019-04-09 14:18:41', '2019-04-09 14:18:41'),
(6, 'Jumbo Battery specification chart (36 Months: 18+18)', NULL, 4, 1, 15, '2019-04-09 14:22:43', '2019-04-09 14:22:43'),
(7, 'Solar Battery specification chart (60 Months: 36+24)', NULL, 4, 1, 15, '2019-04-09 14:22:56', '2019-04-09 14:22:56'),
(8, 'Solar IT Battery specification chart (72 Months: 42+30)', NULL, 4, 1, 15, '2019-04-09 14:32:53', '2019-04-09 14:32:53');

-- --------------------------------------------------------

--
-- Table structure for table `targets`
--

CREATE TABLE `targets` (
  `target_id` int(11) NOT NULL,
  `dealer_id` int(11) NOT NULL,
  `month` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `target_amount` varchar(255) NOT NULL,
  `target_qty` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `targets`
--

INSERT INTO `targets` (`target_id`, `dealer_id`, `month`, `year`, `target_amount`, `target_qty`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(3, 15, '4', '2019', '10', 5, 1, 1, '2019-04-25 12:09:24', '2019-04-29 14:53:54'),
(4, 15, '5', '2019', '100000', 3, 1, 1, '2019-04-26 16:50:04', '2019-04-26 16:50:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firm_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_number` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dealer_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gst_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vat_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` int(11) DEFAULT '1',
  `user_type` int(11) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `firm_name`, `email`, `email_verified_at`, `password`, `mobile_number`, `dealer_code`, `gst_no`, `vat_no`, `address`, `location`, `rating`, `user_type`, `remember_token`, `otp`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', '', 'info@cancri.in', NULL, '$2y$10$bWtHzHf398LDTW9etznX5eFiIZZZdU.ziq5Rp2ZMtyEfZeVNJOGOq', '8008210957', NULL, NULL, '345', 'hyd', NULL, NULL, 1, 'qmZG6sPvVhlaJyWkTEws72qIU3VgPE1fWVfdQ3TIHIwHhU3qSKOpBjWjOkXg', NULL, NULL, '2019-02-18 00:25:18', '2019-02-18 00:25:18'),
(2, 'one dealer', 'one Dealer', 'onedealer@gmail.com', NULL, NULL, '8044234342', 'D1', '123456', '34567', 'one address', 'HYD', 1, 2, NULL, NULL, 1, '2019-02-18 00:26:46', '2019-04-20 10:45:48'),
(4, 'two dealer', 'two  Dealer', 'twodealer@gmail.com', NULL, NULL, '+918019855330', 'D2', '123456', '34567', NULL, 'DAD', 2, 2, NULL, NULL, 1, '2019-02-27 02:17:55', '2019-04-20 10:47:07'),
(15, 'Nagarjuna', 'Nagarjuna', 'nagarjuna@gmail.com', NULL, '$2y$10$2YmGnq2brH0OQvnNI/gKrekRQqNgTKdueSsJmbPFNDNwNGqeCCmpS', '8008210957', '44070', '9876540', '12345670', 'Secunderbad', 'Secunderbad', 4, 2, 'EjF9NGlr3cV7MWF8TrmOJind3MGd0EkpmmhsdatJHOgxbFeH5p70MMJPaRHh', 459857, 1, '2019-04-09 05:59:17', '2019-04-24 12:24:45'),
(16, 'sample', 'DS', 'fdsf@gmail.com', NULL, '$2y$10$6kxX2BIBAh5w.QyrdRpFfOMeQgzxX/uKBQihjW2BibCeksGxY0r9a', '9989228262', 'dasd', '4567', '33244', 'DSA', 'DSA', 3, 2, NULL, NULL, 1, '2019-04-20 11:02:29', '2019-04-20 11:02:29'),
(17, 'Raam', 'Ram tech', 'ram@gmail.com', NULL, '$2y$10$gjRTOhf8rBgjX3Ex3HgGQ.VbtRxq8qTrBhVDv30Mn87CQFolpS.Le', '8019855330', '123', '645', '867', 'hyd', 'jublee hills', 5, 2, 'laYNjp4JRqdBlfhbgPNkqJfuId5Fa77Bb8fFDNEpl57piNTTUKBPb0l4fYSE', NULL, 1, '2019-04-23 10:58:56', '2019-05-01 06:12:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `battery_analysis`
--
ALTER TABLE `battery_analysis`
  ADD PRIMARY KEY (`battery_analysis_id`);

--
-- Indexes for table `battery_complaints`
--
ALTER TABLE `battery_complaints`
  ADD PRIMARY KEY (`battery_complaint_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`promotion_id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`sub_cat_id`);

--
-- Indexes for table `targets`
--
ALTER TABLE `targets`
  ADD PRIMARY KEY (`target_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `battery_analysis`
--
ALTER TABLE `battery_analysis`
  MODIFY `battery_analysis_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `battery_complaints`
--
ALTER TABLE `battery_complaints`
  MODIFY `battery_complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `promotions`
--
ALTER TABLE `promotions`
  MODIFY `promotion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `sub_cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `targets`
--
ALTER TABLE `targets`
  MODIFY `target_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
