-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 27, 2024 at 07:40 PM
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

CREATE TABLE `admin` (
                         `admin_ID` int NOT NULL,
                         `admin_level` int NOT NULL,
                         `user_ID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_ID`, `admin_level`, `user_ID`) VALUES
    (2, 2, 100);

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
                                                                                  (89, '123 Tallaght Springfield', 0, 95),
                                                                                  (93, '1234', 0, 99),
                                                                                  (94, '123 Tallaght Springfield', 0, 101);

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
... (390 lines left)