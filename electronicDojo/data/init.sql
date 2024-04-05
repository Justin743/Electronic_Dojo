-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/

    CREATE DATABASE electronic_dojo;
-- Host: localhost:3306
-- Generation Time: Mar 18, 2024 at 11:23 PM
-- Server version: 8.0.34
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `electronic_dojo`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

USE Electronic_dojo;

CREATE TABLE `admin` (
  `admin_ID` int NOT NULL,
  `admin_level` int NOT NULL,
  `user_ID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_ID`, `admin_level`, `user_ID`) VALUES
(1, 2, 11);

-- --------------------------------------------------------

--
-- Table structure for table `card`
--

CREATE TABLE `card` (
  `card_ID` int NOT NULL,
  `type` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `card_number` double NOT NULL,
  `payment_ID_card` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `card`
--

INSERT INTO `card` (`card_ID`, `type`, `name`, `card_number`, `payment_ID_card`) VALUES
(1, 'Card', 'Justas', 1919191919191, 2);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_ID` int NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `loyaltyPoints` int NOT NULL,
  `user_ID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_ID`, `address`, `loyaltyPoints`, `user_ID`) VALUES
(1, 'dasdasdasdad', 10, 1),
(2, 'Tallght 123', 0, 6),
(5, 'Tallght 123', 0, 9);

-- --------------------------------------------------------

--
-- Table structure for table `laptop`
--

CREATE TABLE `laptop` (
  `laptop_ID` int NOT NULL,
  `manufacturer` varchar(255) NOT NULL,
  `image` varchar(500) NOT NULL,
  `product_ID_laptop` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `laptop`
--

INSERT INTO `laptop` (`laptop_ID`, `manufacturer`, `image`, `product_ID_laptop`) VALUES
(1, 'Compal', 'image/dell.jpg', 4),
(2, 'Compal', 'image/asus.jpg', 5),
(3, 'The Hewlett-Packard Company', 'image/hp.jpg', 6);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `order_ID` int NOT NULL,
  `product_ID_order` int NOT NULL,
  `date_of_order` date NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `payment_ID_order` int NOT NULL,
  `customer_ID_order` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`order_ID`, `product_ID_order`, `date_of_order`, `total`, `payment_ID_order`, `customer_ID_order`) VALUES
(1, 1, '2024-03-17', 1239, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `paymentmethod`
--

CREATE TABLE `paymentmethod` (
  `payment_ID` int NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `paymentmethod`
--

INSERT INTO `paymentmethod` (`payment_ID`, `amount`) VALUES
(1, 1239),
(2, 23131);

-- --------------------------------------------------------

--
-- Table structure for table `phones`
--

CREATE TABLE `phones` (
  `phone_ID` int NOT NULL,
  `manufacturer` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `product_ID_phone` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `phones`
--

INSERT INTO `phones` (`phone_ID`, `manufacturer`, `image`, `product_ID_phone`) VALUES
(1, 'Foxconn', 'image/Iphone.jpg', 1),
(2, 'Foxconn', 'image/Samsung1.jpg', 2),
(3, 'Foxconn', 'image/Huawei.jpg', 3);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_ID` int NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `bio` varchar(255) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `loyalty_points` int NOT NULL,
  `brand` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_ID`, `product_name`, `bio`, `price`, `loyalty_points`, `brand`, `category`) VALUES
(1, 'Iphone 15', 'IPhone 15 features a durable colour-infused glass and aluminium design. It’s splash, water and dust resistant. The Ceramic Shield front is super-tough. And the 6.1” Super Retina XDR display is up to 2x brighter in the sun compared with iPhone 14.', 1239, 20, 'Apple', 'Phone'),
(2, 'Galaxy S24 Ultra', 'Ready for the fastest network speeds aroundUltra-sharp Quadruple 12, 200, 10 and 10 Megapixel rear camera & 12 Megapixel selfie camera6.8” QHD+ 120Hz DisplaySuper fast Snapdragon 8 Gen 2 Octa Core Processor ', 1050, 20, 'Samsung', 'Phone'),
(3, 'Huawei P Smart S', 'The phone is powered by the Kirin 710F, which is an eight-core processor produced with a 12 nm production process and running at 2.2 GHz and has the Mali-G51 MP4 graphic unit.', 1000, 15, 'Huawei', 'Phone'),
(4, 'Precision 7670 ', 'Get the Dell Precision 7670 Laptop with a massive 64GB RAM and 2TB SSD storage. The laptop is powered by an I7-12850HX processor and comes with RTX A2000 graphics card, making it perfect for heavy-duty tasks like video editing or gaming.', 1500, 25, 'DELL', 'Laptop'),
(5, 'ROG Zephyrus', 'ASUS ROG Zephyrus G16 GU603ZU-N3003W notebook i7-12700H 40.6 cm (16\") WUXGA Intel Core i7 16 GB DDR4-SDRAM 512 GB SSD NVIDIA GeForce RTX 4050 Wi-Fi 6E (802.11ax) Windows 11 Home White', 2500, 40, 'Asus', 'Laptop'),
(6, 'ProBook 450 ', 'G9 15.6-inch Laptop (Intel Core i5-1235U (12th Gen), 16 GB RAM, 512 GB SSD, Windows 11 Pro)', 1000, 20, 'HP', 'Laptop'),
(7, 'QE50Q60CAUXXU 50', 'Smart 4K Ultra HD HDR QLED TV with Bixby & Alexa', 650, 5, 'Samsung', 'Television'),
(8, 'BRAVIA XR-48A90KU.YG', '48\" Smart 4K Ultra HD HDR OLED TV with Google TV & Assistant', 1300, 20, 'SONY', 'Television'),
(9, '43NANO766QA.AEK', '43\" Smart 4K Ultra HD HDR LED TV with Google Assistant & Amazon Alexa', 500, 5, 'LG', 'Television');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `profile_ID` int NOT NULL,
  `customer_ID_profile` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`profile_ID`, `customer_ID_profile`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `revolut`
--

CREATE TABLE `revolut` (
  `revolut_ID` int NOT NULL,
  `type` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `card_number` double NOT NULL,
  `payment_ID_revolut` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `revolut`
--

INSERT INTO `revolut` (`revolut_ID`, `type`, `name`, `card_number`, `payment_ID_revolut`) VALUES
(1, 'Revolut', 'Justas', 12121212, 1);

-- --------------------------------------------------------

--
-- Table structure for table `television`
--

CREATE TABLE `television` (
  `television_ID` int NOT NULL,
  `manufacturer` varchar(255) NOT NULL,
  `image` varchar(500) NOT NULL,
  `product_ID_television` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `television`
--

INSERT INTO `television` (`television_ID`, `manufacturer`, `image`, `product_ID_television`) VALUES
(1, 'Samsung Electronics', 'image/samsungTV.jpg', 7),
(2, 'BRAVIA', 'image/sonyTV.jpg', 8),
(3, 'LG Electronics', 'image/LGTV.jpg', 9);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int NOT NULL,
  `firstname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `lastname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `firstname`, `lastname`, `email`, `password`) VALUES
(1, 'Justas', 'Juozaitis', 'b00155152@mytudublin.ie', 'Hello123'),
(5, 'Ryan', 'Dunne', 'HELLO.99@gmail.com', '1234'),
(6, 'Ryan', 'Dunne', 'HELLO.99@gmail.com', '1234'),
(9, 'Justas', 'Juozaitis', 'HELLO.99@gmail.com', '1234'),
(10, 'Ryan', 'Dunne', 'adminElDojo@gmail.com', 'admin_RD2234?'),
(11, 'Ryan', 'Dunne', 'adminElDojo@gmail.com', 'admin_RD2234?');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_ID`),
  ADD KEY `admin_user_ID(FK)` (`user_ID`);

--
-- Indexes for table `card`
--
ALTER TABLE `card`
  ADD PRIMARY KEY (`card_ID`),
  ADD KEY `payment_ID_card(FK)` (`payment_ID_card`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_ID`),
  ADD KEY `customer_user_id(FK)` (`user_ID`);

--
-- Indexes for table `laptop`
--
ALTER TABLE `laptop`
  ADD PRIMARY KEY (`laptop_ID`),
  ADD KEY `product_ID_laptop(FK)` (`product_ID_laptop`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_ID`),
  ADD KEY `order_payment_id(FK)` (`payment_ID_order`),
  ADD KEY `order_product_id(FK)` (`product_ID_order`),
  ADD KEY `customer_ID_order(FK)` (`customer_ID_order`);

--
-- Indexes for table `paymentmethod`
--
ALTER TABLE `paymentmethod`
  ADD PRIMARY KEY (`payment_ID`);

--
-- Indexes for table `phones`
--
ALTER TABLE `phones`
  ADD PRIMARY KEY (`phone_ID`),
  ADD KEY `product_ID_phone(FK)` (`product_ID_phone`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_ID`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`profile_ID`),
  ADD KEY `customer_ID_profile(FK)` (`customer_ID_profile`);

--
-- Indexes for table `revolut`
--
ALTER TABLE `revolut`
  ADD PRIMARY KEY (`revolut_ID`),
  ADD KEY `payment_ID_revolut(FK)` (`payment_ID_revolut`);

--
-- Indexes for table `television`
--
ALTER TABLE `television`
  ADD PRIMARY KEY (`television_ID`),
  ADD KEY `product_ID_television(FK)` (`product_ID_television`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_user_ID(FK)` FOREIGN KEY (`user_ID`) REFERENCES `user` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `card`
--
ALTER TABLE `card`
  ADD CONSTRAINT `payment_ID_card(FK)` FOREIGN KEY (`payment_ID_card`) REFERENCES `paymentmethod` (`payment_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_user_ID` FOREIGN KEY (`user_ID`) REFERENCES `user` (`ID`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `laptop`
--
ALTER TABLE `laptop`
  ADD CONSTRAINT `product_ID_laptop(FK)` FOREIGN KEY (`product_ID_laptop`) REFERENCES `products` (`product_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `customer_ID_order(FK)` FOREIGN KEY (`customer_ID_order`) REFERENCES `customer` (`customer_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `payment_ID_order(FK)` FOREIGN KEY (`payment_ID_order`) REFERENCES `paymentmethod` (`payment_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `product_ID_order(FK)` FOREIGN KEY (`product_ID_order`) REFERENCES `products` (`product_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `phones`
--
ALTER TABLE `phones`
  ADD CONSTRAINT `product_ID_phone(FK)` FOREIGN KEY (`product_ID_phone`) REFERENCES `products` (`product_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `customer_ID_profile(FK)` FOREIGN KEY (`customer_ID_profile`) REFERENCES `customer` (`customer_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `revolut`
--
ALTER TABLE `revolut`
  ADD CONSTRAINT `payment_ID_revolut(FK)` FOREIGN KEY (`payment_ID_revolut`) REFERENCES `paymentmethod` (`payment_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `television`
--
ALTER TABLE `television`
  ADD CONSTRAINT `product_ID_television(FK)` FOREIGN KEY (`product_ID_television`) REFERENCES `products` (`product_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
