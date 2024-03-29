-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2019 at 03:37 PM
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
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `ads_id` int(10) NOT NULL,
  `ads_img` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`ads_id`, `ads_img`) VALUES
(5, 'upload/pubg-android-game-4k-eh.jpg'),
(6, 'upload/Sunset_at_Tiergarten_UHD.jpg'),
(7, 'upload/4K-HD-Desktop-Wallpapers.jpg');

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
(27, 'Overseas Jobs', 'Ø§Ù„Ø¹Ù…Ù„ ', 'upload/category/service3.png'),
(28, 'Pets & Animals', 'Ø­ÙŠÙˆØ§Ù†Ø§Øª ', 'upload/category/service4.png'),
(29, 'Hobby, Sport & Kids', '', 'upload/category/service5.png'),
(31, 'House & Apartment', 'Ø§Ù„Ù…Ù†Ø§Ø²Ù„ ÙˆØ§Ù„Ø¹Ù…Ø§Ø±Ø§Øª', 'upload/category/service6.png'),
(32, 'Education', 'Ø§Ù„ØªØ¹Ù„ÙŠÙ…', 'upload/category/service7.png'),
(33, 'Home & Garden', '', 'upload/category/service8.png'),
(34, 'test', 'ØªØ¬Ø±Ø¨Ø©', 'upload/category/service1.png'),
(35, 'Interests', 'Ø£Ù‡ØªÙ…Ø§Ù…Ø§Øª', 'upload/category/service4.png');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `city_id` int(11) NOT NULL,
  `city_name` varchar(30) NOT NULL,
  `country_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_id`, `city_name`, `country_id`) VALUES
(3, 'Texas', '2'),
(5, 'Oran', '3'),
(11, 'Amman', '5'),
(12, 'Zarqa', '5'),
(13, 'Irbid', '5'),
(14, 'Aqaba', '5');

-- --------------------------------------------------------

--
-- Table structure for table `company_image`
--

CREATE TABLE `company_image` (
  `img_id` int(11) NOT NULL,
  `provider_id` varchar(20) NOT NULL,
  `url` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company_image`
--

INSERT INTO `company_image` (`img_id`, `provider_id`, `url`) VALUES
(25, '12', 'upload/company_images/122.JPG'),
(26, '12', 'upload/company_images/123.jpg'),
(27, '12', 'upload/company_images/129.JPG'),
(28, '12', 'upload/company_images/1210.JPG'),
(29, '12', 'upload/company_images/12example.png'),
(30, '12', 'upload/company_images/12login.JPG'),
(43, '15', 'upload/company_images/15images1.jpg'),
(44, '15', 'upload/company_images/15images2.jpg'),
(45, '15', 'upload/company_images/15images3.jpg'),
(46, '15', 'upload/company_images/15images4.jpg'),
(48, '3', 'upload/company_images/3background.jpg'),
(49, '3', 'upload/company_images/33.jpg'),
(50, '3', 'upload/company_images/32.jpg'),
(51, '3', 'upload/company_images/31.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `country_id` int(11) NOT NULL,
  `country_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`country_id`, `country_name`) VALUES
(2, 'USA'),
(3, 'Algeria'),
(5, 'Jordan');

-- --------------------------------------------------------

--
-- Table structure for table `new_provider`
--

CREATE TABLE `new_provider` (
  `new_id` int(11) NOT NULL,
  `new_name` varchar(30) DEFAULT NULL,
  `new_email` varchar(50) DEFAULT NULL,
  `new_mobile` varchar(50) DEFAULT NULL,
  `new_message` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `new_provider`
--

INSERT INTO `new_provider` (`new_id`, `new_name`, `new_email`, `new_mobile`, `new_message`) VALUES
(1, 'test', 'test@test.com', '0135654', NULL),
(2, 'fg', 'fsb@f', '864654', 'slkgjlkhfgoi');

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
  `city_id` varchar(20) NOT NULL,
  `country_id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `payment_method`, `order_date`, `grand_total`, `order_status`, `address_line`, `city_id`, `country_id`, `user_id`) VALUES
(000017, 'cash', '2020-07-15 16:55:32', 5002, 'completed', 'aldnfjadf', '12', '5', '4'),
(000018, 'cash', '2019-07-18 14:19:06', 600, 'completed', 'ertyui', '13', '5', '4'),
(000019, 'cash', '2019-08-18 15:40:50', 5002, 'completed', 'adjbjdb', '5', '3', '4'),
(000020, 'paypal', '2019-08-24 11:18:02', 30020, 'completed', 'adjbjdb', '13', '5', '4'),
(000021, 'paypal', '2019-07-24 11:18:14', 30020, 'completed', 'adjbjdb', '13', '5', '4'),
(000022, 'cash', '2019-07-24 12:46:41', 1440, 'completed', 'adjbjdb', '13', '5', '4');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_details_id` int(11) NOT NULL,
  `order_id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_details_id`, `order_id`, `product_id`, `quantity`) VALUES
(8, 000017, '35', 2),
(9, 000018, '30', 2),
(10, 000019, '35', 2),
(11, 000020, '39', 20),
(12, 000021, '39', 20),
(13, 000022, '37', 12);

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
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `video_url` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `title`, `price`, `special_price`, `brand`, `color`, `warranty`, `category_id`, `provider_id`, `description`, `featured`, `video_url`) VALUES
(30, 'Toys', '320', '300', '', 'White', '1', '29', '5', 'test', 1, ''),
(35, 'Test', '2501', '', '', 'Red', '3', '25', '5', '<ol><li>adfnsfjngkjsndfgjkndfg</li><li>fdsgdsfdsfh</li></ol>fdgdfsgdsfgdsfg<br><span style=\"font-family: Impact,Charcoal,sans-serif;\">fsdgdsfgdfsgdsfgsdfg</span><br>dsfgsdfg<br><strong><em><u><span style=\"font-family: Arial, Helvetica, sans-serif; font-size: 60px;\">noor</span></u></em></strong><br><br>', 0, 'https://www.youtube.com/embed/bj1DSRsEBXQ'),
(36, 'Sonata', '2500', '2450', 'Hundau', 'Black', '2', '26', '5', '', 1, 'https://www.youtube.com/embed/NlYNX5TQbv4'),
(37, 'test', '215', '120', 'test', 'white', '0', '31', '15', 'test<br><span style=\"font-size: 30px; font-family: Georgia, serif;\">test</span>', 1, ''),
(38, 'Test', '6541', '864', 'Test', 'Test', '0', '29', '5', '<a href=\"https://www.youtube.com/watch?v=UZwi9SHgzGY\">https://www.youtube.com/watch?v=UZwi9SHgzGY</a><br>Test', 1, 'https://www.youtube.com/embed/UZwi9SHgzGY'),
(39, 'Test', '2501', '1501', 'test', 'black', '0', '33', '12', '<a href=\"https://www.youtube.com/watch?v=svGnb9Gcza0\"><u><em><span style=\"font-size: 18px;\">https://www.youtube.com/watch?v=svGnb9Gcza0</span></em></u></a><br><u><em></em></u><br><u><em><span style=\"font-size: 18px;\">test</span></em></u>', 1, 'https://www.youtube.com/embed/svGnb9Gcza0');

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
(56, '35', 'upload/product/353.jpg'),
(68, '30', 'upload/product/30images3.jpg'),
(69, '37', 'upload/product/372.JPG'),
(70, '37', 'upload/product/372.png'),
(71, '37', 'upload/product/379.JPG'),
(72, '37', 'upload/product/3710.JPG'),
(73, '37', 'upload/product/37download.png'),
(74, '37', 'upload/product/37example.png'),
(75, '38', 'upload/product/38download.png'),
(76, '38', 'upload/product/38images2.jpg'),
(77, '38', 'upload/product/38images3.jpg'),
(78, '39', 'upload/product/391.jpg'),
(79, '39', 'upload/product/392.jpg'),
(80, '39', 'upload/product/393.jpg'),
(81, '39', 'upload/product/39background.jpg');

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
  `location_map` text NOT NULL,
  `category_id` varchar(20) NOT NULL,
  `address_line` varchar(100) NOT NULL,
  `postal_code` varchar(20) NOT NULL,
  `country_id` varchar(20) NOT NULL,
  `city_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `provider`
--

INSERT INTO `provider` (`provider_id`, `owner_full_name`, `company_name`, `provider_email`, `password`, `phone_number`, `logo`, `location_map`, `category_id`, `address_line`, `postal_code`, `country_id`, `city_id`) VALUES
(3, 'Mohammad Ali', 'test', 'test1@gmail.com', '25f9e794323b453885f5181f1b624d0b', '132465798', 'upload/company_logo/background.jpg', 'https://goo.gl/maps/Js19SrgBhBdAx5c28', '25', 'building 2', '45612', '5', '11'),
(4, 'Steve', 'Apple', 'apple@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0786532154', 'upload/company_logo/3.jpg', 'https://goo.gl/maps/Js19SrgBhBdAx5c28', '25', '8', '45632', '5', '12'),
(5, 'ghdfd', 'ghcg', 'gdxtd@gfx.com', '202cb962ac59075b964b07152d234b70', '6546546589', 'upload/company_logo/2.jpg', 'https://goo.gl/maps/ofzVsffanEDvaZZ6A', '25', 'building 2, Maca st.', '65412', '5', '11'),
(6, 'test', 'test', 'test@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0798654145', 'upload/company_logo/4.JPG', 'https://goo.gl/maps/6SAkKBqL7D3LZ1C58', '32', 'sjfdb', '98745', '2', '3'),
(7, 'test2', 'test2', 'test2@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '789465', 'upload/company_logo/11.JPG', 'https://goo.gl/maps/6SAkKBqL7D3LZ1C58', '28', 'sjfbgsd', '46589', '3', '5'),
(12, 'test carousal', 'test carousal', 'ekg@sfkgm.com', '202cb962ac59075b964b07152d234b70', '9784651320', 'upload/company_logo/login.JPG', 'keldnglkrgwn', '33', 'aegnwg', '45632', '2', '3'),
(15, 'Mhammad', 'Stores', 'store@store.com', 'e10adc3949ba59abbe56e057f20f883e', '7894651320', 'upload/company_logo/download.png', 'https://goo.gl/maps/dgwf2HdPc9fm5JvR9', '31', 'wrt sdg', '79456', '3', '5');

-- --------------------------------------------------------

--
-- Table structure for table `subscribe`
--

CREATE TABLE `subscribe` (
  `subscribe_id` int(11) NOT NULL,
  `subscribe_email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subscribe`
--

INSERT INTO `subscribe` (`subscribe_id`, `subscribe_email`) VALUES
(1, 'noor@gmail.com'),
(5, 'yazan@gmail.com'),
(7, 'salameh.yasin@yahoo.com');

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
  `user_phone` varchar(15) NOT NULL,
  `address_line` varchar(20) NOT NULL,
  `city_id` varchar(20) NOT NULL,
  `country_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_email`, `user_password`, `user_fname`, `user_lname`, `user_gender`, `user_phone`, `address_line`, `city_id`, `country_id`) VALUES
(3, 'dlkgfn@lncv.com', 'e10adc3949ba59abbe56e057f20f883e', 'Test', 'test', 'male', '01796354', '', '', ''),
(4, 'sdv@sv', '25f9e794323b453885f5181f1b624d0b', 'adg', 'sdv', 'female', '64546', 'adjbjdb', '13', '5'),
(5, 'noor@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'noor', 'alazzeh', 'male', '0796340653', 'aserd', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`ads_id`);

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
-- Indexes for table `company_image`
--
ALTER TABLE `company_image`
  ADD PRIMARY KEY (`img_id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `new_provider`
--
ALTER TABLE `new_provider`
  ADD PRIMARY KEY (`new_id`);

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
-- Indexes for table `subscribe`
--
ALTER TABLE `subscribe`
  ADD PRIMARY KEY (`subscribe_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `ads_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `company_image`
--
ALTER TABLE `company_image`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `new_provider`
--
ALTER TABLE `new_provider`
  MODIFY `new_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `product_image`
--
ALTER TABLE `product_image`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `provider`
--
ALTER TABLE `provider`
  MODIFY `provider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `subscribe`
--
ALTER TABLE `subscribe`
  MODIFY `subscribe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
