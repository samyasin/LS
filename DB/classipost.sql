-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2019 at 03:32 PM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `classipost`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `address_id` int(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(20) NOT NULL,
  `country` varchar(20) NOT NULL,
  `postal_code` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`address_id`, `address`, `city`, `country`, `postal_code`) VALUES
(7, 'asfladf', 'amman', 'Jordan', '65412'),
(8, 'building 2, jos st. ', 'new york', 'USA', '63521');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `email` text NOT NULL,
  `password` varchar(50) NOT NULL,
  `full_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `email`, `password`, `full_name`) VALUES
(5, 'yara99@hotmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Hala Ahmad'),
(6, 'yb@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'yasmen abd'),
(7, 'afnan96@gmail.com', '25f9e794323b453885f5181f1b624d0b', 'afnan ahmad'),
(8, 'noor@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'noor aldeen'),
(11, 'salameh@google.com', 'e10adc3949ba59abbe56e057f20f883e', 'salameh '),
(14, 'o.m@gmail.com', '25f9e794323b453885f5181f1b624d0b', 'Omar');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `name_en` text NOT NULL,
  `name_ar` text NOT NULL,
  `url` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `name_en`, `name_ar`, `url`) VALUES
(25, ' Electronics', 'Ø§Ù„Ø§Ù„ÙƒØªØ±ÙˆÙ†ÙŠØ§Øª', 'upload/category/service1.png'),
(26, 'Cars & Vehicles', 'Ø³ÙŠØ§Ø±Ø§Øª Ùˆ Ø´Ø§Ø­Ù†Ø§Øª', 'upload/category/service2.png'),
(27, 'Overseas Jobs', 'Ø§Ù„Ø¹Ù…Ù„ ', 'upload/category/service3.png'),
(28, 'Pets & Animals', '', 'upload/category/service4.png'),
(29, 'Hobby, Sport & Kids', '', 'upload/category/service5.png'),
(31, 'House & Apartment', 'Ø§Ù„Ù…Ù†Ø§Ø²Ù„ ÙˆØ§Ù„Ø¹Ù…Ø§Ø±Ø§Øª', 'upload/category/service6.png'),
(32, 'Education', 'Ø§Ù„ØªØ¹Ù„ÙŠÙ…', 'upload/category/service7.png'),
(33, 'Home & Garden', '', 'upload/category/service8.png'),
(34, 'test', 'ØªØ¬Ø±Ø¨Ø©', 'upload/category/service1.png'),
(35, 'Interests', 'Ø£Ù‡ØªÙ…Ø§Ù…Ø§Øª', 'upload/category/service4.png'),
(36, 'test1', 'ØªØ¬Ø±Ø¨Ø©1', 'upload/category/service8.png');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `order_id` int(11) NOT NULL,
  `quantity` float NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `provider_id` varchar(20) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `price` varchar(10) NOT NULL,
  `special_price` varchar(10) NOT NULL,
  `brand` varchar(20) NOT NULL,
  `color` varchar(10) NOT NULL,
  `warranty` varchar(20) NOT NULL,
  `category_id` varchar(10) NOT NULL,
  `provider_id` varchar(10) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `title`, `price`, `special_price`, `brand`, `color`, `warranty`, `category_id`, `provider_id`, `description`, `featured`) VALUES
(25, 'phone', '250', '200', 'iphone', 'red', '', '25', '5', '<u>This </u><strong><span style=\"font-size: 18px;\">Phone</span></strong><ul><li><span style=\"font-family: Times New Roman,Times,serif,-webkit-standard;\">is very fast</span></li><li><span style=\"font-family: Verdana,Geneva,sans-serif;\">easy to use</span></li></ul>', 1),
(27, 'Dog', '300', '', '', '', '', '28', '5', '', 0),
(30, 'Toys', '320', '300', '', '', '', '29', '5', 'test', 1),
(35, '', 'test', '', '', '', '', '25', '5', '<ol><li>adfnsfjngkjsndfgjkndfg</li><li>fdsgdsfdsfh</li></ol>fdgdfsgdsfgdsfg<br><span style=\"font-family: Impact,Charcoal,sans-serif;\">fsdgdsfgdfsgdsfgsdfg</span><br>dsfgsdfg<br><strong><em><u><span style=\"font-family: Arial, Helvetica, sans-serif; font-size: 60px;\">noor</span></u></em></strong><br><br>', 0),
(36, 'Sonata', '2500', '2450', 'Hundau', 'Blach', '2', '26', '5', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE `product_image` (
  `img_id` int(11) NOT NULL,
  `product_id` varchar(10) NOT NULL,
  `url` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`img_id`, `product_id`, `url`) VALUES
(15, '25', 'upload/product/product8.png'),
(16, '25', 'upload/product/sidebar-img1.png'),
(19, '27', 'upload/product/product9.png'),
(23, '30', 'upload/product/product12.png'),
(24, '30', 'upload/product/product19.png'),
(25, '30', 'upload/product/sidebar-img3.png'),
(26, '30', 'upload/product/single-product1.jpg'),
(27, '31', 'upload/product/product1.png'),
(28, '32', 'upload/product/product1.png'),
(29, '33', 'upload/product/product1.png'),
(30, '34', 'upload/product/product8.png'),
(31, '34', 'upload/product/product18.png'),
(32, '34', 'upload/product/sidebar-img1.png'),
(34, '35', 'upload/product/product2.png'),
(35, '35', 'upload/product/product3.png'),
(36, '36', 'upload/product/ctg3.png'),
(37, '36', 'upload/product/product14.png'),
(38, '36', 'upload/product/product16.png'),
(43, '25', 'upload/product/2.jpg'),
(44, '35', 'upload/product/3.jpg'),
(45, '35', 'upload/product/background.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `provider`
--

CREATE TABLE `provider` (
  `provider_id` int(11) NOT NULL,
  `owner_full_name` varchar(30) NOT NULL,
  `company_name` varchar(30) NOT NULL,
  `provider_email` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `category_id` varchar(20) NOT NULL,
  `address_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `provider`
--

INSERT INTO `provider` (`provider_id`, `owner_full_name`, `company_name`, `provider_email`, `password`, `phone_number`, `logo`, `category_id`, `address_id`) VALUES
(3, 'Mohammad Ali', 'test', 'test1@gmail.com', '25f9e794323b453885f5181f1b624d0b', '132465798', 'upload/company_logo/background.jpg', '25', '7'),
(4, 'Steve', 'Apple', 'apple@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0786532154', 'upload/company_logo/3.jpg', '25', '8');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_email` text NOT NULL,
  `user_password` varchar(40) NOT NULL,
  `user_fname` text NOT NULL,
  `user_lname` text NOT NULL,
  `user_gender` text NOT NULL,
  `user_phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`img_id`);

--
-- Indexes for table `provider`
--
ALTER TABLE `provider`
  ADD PRIMARY KEY (`provider_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `product_image`
--
ALTER TABLE `product_image`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `provider`
--
ALTER TABLE `provider`
  MODIFY `provider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
