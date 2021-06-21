-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 21, 2021 at 01:12 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pnp`
--

-- --------------------------------------------------------

--
-- Table structure for table `stations`
--

CREATE TABLE `stations` (
  `station_id` int(15) NOT NULL,
  `station_name` varchar(255) NOT NULL,
  `latitude` varchar(20) NOT NULL,
  `longitude` varchar(20) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `isDefault` int(2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stations`
--

INSERT INTO `stations` (`station_id`, `station_name`, `latitude`, `longitude`, `remarks`, `isDefault`) VALUES
(1, 'Police Station 1', '8.4766796', '124.6425511', '855-2555, 0917-848-9327 and0998-598-6977', NULL),
(2, 'Police Station 2', '8.4766947', '124.6400141', '852-1620, 0926-592-2662 and0998-598-6980', NULL),
(3, 'Police Station 3', '8.4888351', '124.6570074', '881-1007, 0905-214-9550 and 0998-598-6982', NULL),
(4, 'Police Station 4', '8.4804567', '124.6323172', '855-0735, 0997-380-7386 and 0998-598-6983', NULL),
(5, 'Police Station 5', '8.4984066', '124.6580137', '856-2482, 0906-580-2453 and 0998-598-6985', NULL),
(6, 'Police Station 6', '8.474952', '124.6417003', '855-1917, 0915-969-4189 and 0998-598-6988', NULL),
(7, 'Police Station 7', '8.4834382', '124.6219592', '880-8610, 0905-482-2050, 0998-598-6989 and  0998-598-6990', NULL),
(8, 'Police Station 8', '8.3976457', '124.5916312', '882-0375, 0917-169-7548 and 0998-598-6992', NULL),
(9, 'Police Station 9', '8.4653298', '124.6439823', '851-1235, 0977-012-8666 and 0998-598-6993', NULL),
(10, 'Police Station 10', '8.4721362', '124.7045312', '881-6225, 0917-326-3995 and 0998-598-6995', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `stations`
--
ALTER TABLE `stations`
  ADD PRIMARY KEY (`station_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `stations`
--
ALTER TABLE `stations`
  MODIFY `station_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
