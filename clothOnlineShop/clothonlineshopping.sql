-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2021 at 10:04 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clothonlineshopping`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `user` varchar(100) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `user`, `password`) VALUES
(1, 'admin', 'YW5pc2gwMDE=');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(100) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `cart_quantity` int(30) DEFAULT NULL,
  `cart_totalprice` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` int(100) NOT NULL,
  `item_name` varchar(100) DEFAULT NULL,
  `item_price` int(255) DEFAULT NULL,
  `item_category` text DEFAULT NULL,
  `item_qty` int(255) NOT NULL,
  `item_description` text DEFAULT NULL,
  `item_image` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `item_name`, `item_price`, `item_category`, `item_qty`, `item_description`, `item_image`) VALUES
(1, 'Leather Jackets', 4000, 'jacket', 4, 'Trending Jacket loved by all.', 'e50f272380d4d9ac7537e2ca9bf44d4f5mxkYb5h18ueQIesTZJG.jpg'),
(2, 'BlackPant', 3000, 'pant', 8, 'styling pant for outing.', '1e1c22f0037979cfbd4b49ec7afb08b2la3PlCAvL7ZL4v9TR6NX.jpg'),
(3, 'BlueShirt', 4000, 'shirt', 17, 'trended shirt like by every boys', '995dc7fac1e7c69ae4c5802a4fb4f760ftxhbfNHEuIRoLeg1CqU.jpg'),
(4, 'Half Shirt', 2500, 'shirt', 12, 'cool shirt for young sylish boys.', '5caaffcd4725e5ec69122cd29b17b0c5hb93QH5DAis1uTTo57mb.jpg'),
(5, 'Black Shirt', 3500, 'Shirt', 0, 'trended shirt liked by many boys nowadays.', 'f50205c4c361b2f748c372a7af6ee0d0b3DsqcKA5Y2MZ8Qg1mqt.jpg'),
(14, 'awesome shirt', 5000, 'shirt', 7, 'this is amazing shirt', '14bd58b98aee3305b2aae17108f712e1O7FjY4AqxrcYA9dFmVUZ.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `order_id` int(100) NOT NULL,
  `confirmation_code` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `phone` int(14) NOT NULL,
  `address` varchar(64) NOT NULL,
  `city` varchar(64) NOT NULL,
  `postalcode` int(10) NOT NULL,
  `total_price` int(244) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`order_id`, `confirmation_code`, `user_id`, `phone`, `address`, `city`, `postalcode`, `total_price`, `date`) VALUES
(13, 'tok_1Iy7jjFJL6UcB80pV258iwGo', 5, 2147483647, 'chtwn', 'Kathmandu', 20021, 9150, '2021-06-03 04:00:54');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `user_id` int(100) NOT NULL,
  `username` varchar(25) NOT NULL,
  `nickname` varchar(7) NOT NULL,
  `email` varchar(255) NOT NULL,
  `biodata` text DEFAULT NULL,
  `image` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`user_id`, `username`, `nickname`, `email`, `biodata`, `image`, `password`) VALUES
(1, 'gokul', 'ans', 'ansghimire321@gmail.com', '		 	\r\n		 			 	\r\n		 			 	\r\n		 	 developer.                           ', 'MTYyMjEwNzMwNA==.jpg', '$2y$10$yMI7cNM.VDRC3a/xsU2CgOQn.WvpNbSkWaeMvyCRChNvt8uElhuMq'),
(5, 'anush ghimire', 'anush g', 'ghimireanish321@gmail.com', NULL, '', '$2y$10$Gvgw6n/2V/oIpabn1uRQd.dKNWCTu1LE6raHGcONr4kLemcYCa1BK');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` int(100) NOT NULL,
  `item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `review_star` int(10) NOT NULL,
  `comment` text NOT NULL,
  `date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`review_id`, `item_id`, `user_id`, `review_star`, `comment`, `date`) VALUES
(1, 1, 1, 2, 'coolllllllllll\r\n', '2021-05-06 16:22:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`);
ALTER TABLE `item` ADD FULLTEXT KEY `item_name` (`item_name`,`item_category`);
ALTER TABLE `item` ADD FULLTEXT KEY `item_name_2` (`item_name`,`item_category`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `order_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `register` (`user_id`);

--
-- Constraints for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `orderdetails_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `register` (`user_id`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `register` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
