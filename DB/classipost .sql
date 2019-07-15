-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2019 at 11:44 AM
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
(8, 'building 2, jos st. ', 'new york', 'USA', '63521'),
(9, 'uyf', 'ytf', 'ytf', '564654');

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
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `city_id` int(11) NOT NULL,
  `city_name` varchar(30) NOT NULL,
  `country_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `country_id` int(11) NOT NULL,
  `country` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `payment_method` varchar(20) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `grand_total` int(11) NOT NULL,
  `order_status` varchar(20) NOT NULL,
  `address_line` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  `country` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `payment_method`, `order_date`, `grand_total`, `order_status`, `address_line`, `city`, `country`, `user_id`) VALUES
(000012, 'cash', '2019-07-14 23:34:28', 5002, 'pending', 'yajouz st.', 'Zarqa', 'jordan', '4'),
(000013, 'cash', '2019-07-14 23:35:42', 8103, 'pending', 'yajouz st.', 'Zarqa', 'sdfg', '4'),
(000014, 'paypal', '2019-07-15 00:34:18', 8103, 'approved', 'sfg', 'daf', 'asf', '4'),
(000015, 'cash', '2019-07-15 00:35:31', 9600, 'pending', 'sfg', 'daf', 'jordan', '4'),
(000016, 'cash', '2019-07-15 11:34:57', 5002, 'pending', 'yajouz st.', 'Zarqa', 'jordan', '4');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_details_id` int(11) NOT NULL,
  `order_id` varchar(20) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_details_id`, `order_id`, `product_id`, `quantity`) VALUES
(1, '12', '35', 2),
(2, '13', '35', 3),
(3, '13', '30', 2),
(4, '14', '35', 3),
(5, '14', '30', 2),
(6, '15', '27', 32),
(7, '16', '35', 2);

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
(27, 'Dog', '300', '', '', 'Blue', '0', '28', '5', '', 0),
(30, 'Toys', '320', '300', '', 'White', '1', '29', '5', 'test', 1),
(35, 'Test', '2501', '', '', 'Red', '3', '25', '5', '<ol><li>adfnsfjngkjsndfgjkndfg</li><li>fdsgdsfdsfh</li></ol>fdgdfsgdsfgdsfg<br><span style=\"font-family: Impact,Charcoal,sans-serif;\">fsdgdsfgdfsgdsfgsdfg</span><br>dsfgsdfg<br><strong><em><u><span style=\"font-family: Arial, Helvetica, sans-serif; font-size: 60px;\">noor</span></u></em></strong><br><br>', 0),
(36, 'Sonata', '2500', '2450', 'Hundau', 'Black', '2', '26', '5', '', 1);

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
(19, '27', 'upload/product/product9.png'),
(23, '30', 'upload/product/product12.png'),
(24, '30', 'upload/product/product19.png'),
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
(54, '35', 'upload/product/35background.jpg'),
(55, '27', 'upload/product/27background.jpg'),
(56, '35', 'upload/product/353.jpg'),
(60, '27', 'upload/product/272.jpg');

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
(4, 'Steve', 'Apple', 'apple@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0786532154', 'upload/company_logo/3.jpg', '25', '8'),
(5, 'ghdfd', 'ghcgfx', 'gdxtd@gfx', 'e10adc3949ba59abbe56e057f20f883e', '65465465', 'upload/company_logo/2.jpg', '25', '9');

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
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_email`, `user_password`, `user_fname`, `user_lname`, `user_gender`, `user_phone`) VALUES
(3, 'dlkgfn@lncv.com', 'e10adc3949ba59abbe56e057f20f883e', 'Test', 'test', 'male', '01796354'),
(4, 'sdv@sv', '25f9e794323b453885f5181f1b624d0b', 'adg', 'sdv', 'female', '64546');

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
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_details_id`);

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
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `product_image`
--
ALTER TABLE `product_image`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `provider`
--
ALTER TABLE `provider`
  MODIFY `provider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
