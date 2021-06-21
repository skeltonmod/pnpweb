-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 21, 2021 at 01:11 PM
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
-- Table structure for table `stations_coverage`
--

CREATE TABLE `stations_coverage` (
  `barangay_id` int(11) NOT NULL,
  `station_id` int(11) NOT NULL,
  `barangay_name` varchar(255) NOT NULL,
  `canonical_name` varchar(255) NOT NULL,
  `lat` varchar(255) NOT NULL,
  `long` varchar(255) NOT NULL,
  `remarks` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stations_coverage`
--

INSERT INTO `stations_coverage` (`barangay_id`, `station_id`, `barangay_name`, `canonical_name`, `lat`, `long`, `remarks`) VALUES
(1, 1, 'Barangay 1 (Pob.) Gaston Park', 'Barangay 1', '8.4766796', '124.6425511', '855-2555, 0917-848-9327 and0998-598-6977'),
(2, 1, 'Barangay 2 (Pob.) City Hall', 'Barangay 2', '8.4766796', '124.6425511', '855-2555, 0917-848-9327 and0998-598-6977'),
(3, 1, 'Barangay 3 (Pob.) Phil. National Bank', 'Barangay 3', '8.4766796', '124.6425511', '855-2555, 0917-848-9327 and0998-598-6977'),
(4, 1, 'Barangay 4 (Pob.) CEPALCO–Main', 'Barangay 4', '8.4766796', '124.6425511', '855-2555, 0917-848-9327 and0998-598-6977'),
(5, 1, 'Barangay 5 (Pob.) Rizal Park', 'Barangay 5', '8.4766796', '124.6425511', '855-2555, 0917-848-9327 and0998-598-6977'),
(6, 1, 'Barangay 6 (Pob.) D.V. Soria', 'Barangay 6', '8.4766796', '124.6425511', '855-2555, 0917-848-9327 and0998-598-6977'),
(7, 1, 'Barangay 7 (Pob.) UCPB-D.V. Soria Branch', 'Barangay 7', '8.4766796', '124.6425511', '855-2555, 0917-848-9327 and0998-598-6977'),
(8, 1, 'Barangay 8 (Pob.) MetroBank-D.V. Soria Branch', 'Barangay 8', '8.4766796', '124.6425511', '855-2555, 0917-848-9327 and0998-598-6977'),
(9, 1, 'Barangay 9 (Pob.) DBP –D.V. Soria Branch', 'Barangay 9', '8.4766796', '124.6425511', '855-2555, 0917-848-9327 and0998-598-6977'),
(10, 1, 'Barangay 10 (Pob.) SM Savemore - Capistrano', 'Barangay 10', '8.4766796', '124.6425511', '855-2555, 0917-848-9327 and0998-598-6977'),
(11, 1, 'Barangay 11 (Pob.) LBP - Capistrano', 'Barangay 11', '8.4766796', '124.6425511', '855-2555, 0917-848-9327 and0998-598-6977'),
(12, 1, 'Barangay 12 (Pob.) Wadhus Quality Store', 'Barangay 12', '8.4766796', '124.6425511', '855-2555, 0917-848-9327 and0998-598-6977'),
(13, 1, 'Barangay 13 (Pob.) D’Original La Paz Batchoy', 'Barangay 13', '8.4766796', '124.6425511', '855-2555, 0917-848-9327 and0998-598-6977'),
(14, 1, 'Barangay 14 (Pob.) Polymedic General Hospital', 'Barangay 14', '8.4766796', '124.6425511', '855-2555, 0917-848-9327 and0998-598-6977'),
(15, 1, 'Barangay 15 (Pob.) Philippine Charity Sweepstakes Office', 'Barangay 15', '8.4766796', '124.6425511', '855-2555, 0917-848-9327 and0998-598-6977'),
(16, 1, 'Barangay 16 (Pob.) Philtown Hotel and Restaurant', 'Barangay 16', '8.4766796', '124.6425511', '855-2555, 0917-848-9327 and0998-598-6977'),
(17, 1, 'Barangay 17 (Pob.) Gugma sa Kabataan Foundation Inc.', 'Barangay 17', '8.4766796', '124.6425511', '855-2555, 0917-848-9327 and0998-598-6977'),
(18, 1, 'Barangay 18 (Pob.) Oro Savings and Sharing Cooperative', 'Barangay 17', '8.4766796', '124.6425511', '855-2555, 0917-848-9327 and0998-598-6977'),
(19, 1, 'Barangay 19 (Pob.) Marianne Suites', 'Barangay 18', '8.4766796', '124.6425511', '855-2555, 0917-848-9327 and0998-598-6977'),
(20, 1, 'Barangay 20 (Pob.) NEDA-10', 'Barangay 20', '8.4766796', '124.6425511', '855-2555, 0917-848-9327 and0998-598-6977'),
(21, 2, 'Barangay 24 (Pob.) Centrio Mall', 'Barangay 24', '8.4766947', '124.6400141', '852-1620, 0926-592-2662 and0998-598-6980'),
(22, 2, 'Barangay 27 (Pob.) Capitol Grounds', 'Barangay 27', '8.4766947', '124.6400141', '852-1620, 0926-592-2662 and0998-598-6980'),
(23, 2, 'Barangay 28 (Pob.) MICHIBA Marketing', 'Barangay 27', '8.4766947', '124.6400141', '852-1620, 0926-592-2662 and0998-598-6980'),
(24, 2, 'Barangay 29 (Pob.) MOGCHS', 'Barangay 29', '8.4766947', '124.6400141', '852-1620, 0926-592-2662 and0998-598-6980'),
(25, 2, 'Barangay 30 (Pob.) Lokal Grill and Seafood', 'Barangay 30', '8.4766947', '124.6400141', '852-1620, 0926-592-2662 and0998-598-6980'),
(26, 2, 'Barangay 31 (Pob.) Lim Ket Kai Center', 'Barangay 31', '8.4766947', '124.6400141', '852-1620, 0926-592-2662 and0998-598-6980'),
(27, 2, 'Barangay 32 (Pob.) PAG-IBIG Fund', 'Barangay 32', '8.4766947', '124.6400141', '852-1620, 0926-592-2662 and0998-598-6980'),
(28, 2, 'Barangay 33 (Pob.) Cogon Market', 'Barangay 33', '8.4766947', '124.6400141', '852-1620, 0926-592-2662 and0998-598-6980'),
(29, 2, 'Barangay 34 (Pob.) RD Pawnshop', 'Barangay 34', '8.4766947', '124.6400141', '852-1620, 0926-592-2662 and0998-598-6980'),
(30, 2, 'Barangay 35 (Pob.) Pearlmont Inn', 'Barangay 35', '8.4766947', '124.6400141', '852-1620, 0926-592-2662 and0998-598-6980'),
(31, 2, 'Barangay 36 (Pob.) Ma. Reyna Hospital', 'Barangay 36', '8.4766947', '124.6400141', '852-1620, 0926-592-2662 and0998-598-6980'),
(32, 2, 'Barangay 37 (Pob.) Motormate Group of Companies', 'Barangay 37', '8.4766947', '124.6400141', '852-1620, 0926-592-2662 and0998-598-6980'),
(33, 2, 'Barangay 38 (Pob.) Gaisano - Osmeña', 'Barangay 38', '8.4766947', '124.6400141', '852-1620, 0926-592-2662 and0998-598-6980'),
(34, 2, 'Barangay 39 (Pob.) Ororama – Cogon Branch', 'Barangay 39', '8.4766947', '124.6400141', '852-1620, 0926-592-2662 and0998-598-6980'),
(35, 2, 'Barangay 40 (Pob.) Xavier University', 'Barangay 40', '8.4766947', '124.6400141', '852-1620, 0926-592-2662 and0998-598-6980'),
(36, 2, 'Camaman-an – Bolonsiri Public Cemetery', 'Camaman-an', '8.4766947', '124.6400141', '852-1620, 0926-592-2662 and0998-598-6980'),
(37, 2, 'Indahag – Iglesia ni Cristo', 'Indahag', '8.4766947', '124.6400141', '852-1620, 0926-592-2662 and0998-598-6980'),
(38, 3, 'Gusa – Phil Statistics Authority 10', 'Gusa', '8.4888351', '124.6570074', '881-1007, 0905-214-9550 and 0998-598-6982'),
(39, 3, 'Barangay 22 (Pob.) Capitol University', 'Barangay 22', '8.4888351', '124.6570074', '881-1007, 0905-214-9550 and 0998-598-6982'),
(40, 3, 'Barangay 26 (Pob.) Gaisano Mall', 'Barangay 26', '8.4888351', '124.6570074', '881-1007, 0905-214-9550 and 0998-598-6982'),
(41, 3, 'Lapasan - University of Science and Technology of Southern Philippines', 'Lapasan', '8.4888351', '124.6570074', '881-1007, 0905-214-9550 and 0998-598-6982'),
(42, 4, 'Bayabas – Seventh Day Adventist Church', 'Bayabas', '8.4804567', '124.6323172', '855-0735, 0997-380-7386 and 0998-598-6983'),
(43, 4, 'Balulang – Xavier Estates', 'Balulang', '8.4804567', '124.6323172', '855-0735, 0997-380-7386 and 0998-598-6983'),
(44, 4, 'Bonbon - DPWH', 'Bonbon', '8.4804567', '124.6323172', '855-0735, 0997-380-7386 and 0998-598-6983'),
(45, 4, 'Carmen – SM - Mastersons, Avenue', 'Carmen', '8.4804567', '124.6323172', '855-0735, 0997-380-7386 and 0998-598-6983'),
(46, 4, 'Kauswagan – Polymedic Medical Plaza', 'Kauswagan', '8.4804567', '124.6323172', '855-0735, 0997-380-7386 and 0998-598-6983'),
(47, 4, 'Patag – Camp Evangelista', 'Patag', '8.4804567', '124.6323172', '855-0735, 0997-380-7386 and 0998-598-6983'),
(48, 5, 'Macabalan – Philippine Ports Authority', 'Macabalan', '8.4984066', '124.6580137', '856-2482, 0906-580-2453 and 0998-598-6985'),
(49, 5, 'Barangay 21 (Pob.) – Bureau of Immigration', 'Barangay 21', '8.4984066', '124.6580137', '856-2482, 0906-580-2453 and 0998-598-6985'),
(50, 5, 'Barangay 23 (Pob.) – Lifestyle District', 'Barangay 23', '8.4984066', '124.6580137', '856-2482, 0906-580-2453 and 0998-598-6985'),
(51, 5, 'Barangay 25 (Pob.) Gaisano City', 'Barangay 25', '8.4984066', '124.6580137', '856-2482, 0906-580-2453 and 0998-598-6985'),
(52, 5, 'Consolacion Magic 89.3', 'Consolacion', '8.4984066', '124.6580137', '856-2482, 0906-580-2453 and 0998-598-6985'),
(53, 5, 'Puntod - DENR', 'Puntod', '8.4984066', '124.6580137', '856-2482, 0906-580-2453 and 0998-598-6985'),
(54, 6, 'Agusan – Pepsi Cola Bottlers', 'Agusan', '8.474952', '124.6417003', '855-1917, 0915-969-4189 and 0998-598-6988'),
(55, 6, 'Balubal - Nuestra Señora Santisima Virgen De La Medalla Milagrosa', 'Balubal', '8.474952', '124.6417003', '855-1917, 0915-969-4189 and 0998-598-6988'),
(56, 6, 'Bugo – Del Monte', 'Bugo', '8.474952', '124.6417003', '855-1917, 0915-969-4189 and 0998-598-6988'),
(57, 6, 'Puerto – Gaisano Puerto', 'Puerto', '8.474952', '124.6417003', '855-1917, 0915-969-4189 and 0998-598-6988'),
(58, 7, 'Bulua – LTO -10', 'Bulua', '8.4834382', '124.6219592', '880-8610, 0905-482-2050, 0998-598-6989 and  0998-598-6990'),
(59, 7, 'Baikingon - Glonwicks Highland Resort', 'Baikingon', '8.4834382', '124.6219592', '880-8610, 0905-482-2050, 0998-598-6989 and  0998-598-6990'),
(60, 7, 'Canito-an - SEVENTH-DAY ADVENTIST CHURCH', 'Canito-an', '8.4834382', '124.6219592', '880-8610, 0905-482-2050, 0998-598-6989 and  0998-598-6990'),
(61, 7, 'Iponan - Colonia Hidden Valley Park', 'Iponan', '8.4834382', '124.6219592', '880-8610, 0905-482-2050, 0998-598-6989 and  0998-598-6990'),
(62, 7, 'Pagatpat - Bacal\'s Organic Farm', 'Pagatpat', '8.4834382', '124.6219592', '880-8610, 0905-482-2050, 0998-598-6989 and  0998-598-6990'),
(63, 7, 'San Simon - Glorious Turning Point of the Philippines Foundation, Incorporated', 'San Simon', '8.4834382', '124.6219592', '880-8610, 0905-482-2050, 0998-598-6989 and  0998-598-6990'),
(64, 8, 'Pigsag-an - Pigsag-an Elementary School', 'Pigsag-an', '8.3976457', '124.5916312', '882-0375, 0917-169-7548 and 0998-598-6992'),
(65, 8, 'Taglimao – Taglimao Elementary School', 'Taglimao', '8.3976457', '124.5916312', '882-0375, 0917-169-7548 and 0998-598-6992'),
(66, 8, 'Tagpangi - Tagpangi Elementary School', 'Tagpangi', '8.3976457', '124.5916312', '882-0375, 0917-169-7548 and 0998-598-6992'),
(67, 8, 'Tignapoloan – Sinulom Falls', 'Tignapoloan', '8.3976457', '124.5916312', '882-0375, 0917-169-7548 and 0998-598-6992'),
(68, 8, 'Tuburan - Tuburan Elementary School', 'Tuburan', '8.3976457', '124.5916312', '882-0375, 0917-169-7548 and 0998-598-6992'),
(69, 8, 'Tumpagon –Tumpagon Elementary School', 'Tumpagon', '8.3976457', '124.5916312', '882-0375, 0917-169-7548 and 0998-598-6992'),
(70, 9, 'Macasandig – High Ridge', 'Macasandig', '8.4653298', '124.6439823', '851-1235, 0977-012-8666 and 0998-598-6993'),
(71, 9, 'Nazareth – TESDA 10', 'Nazareth', '8.4653298', '124.6439823', '851-1235, 0977-012-8666 and 0998-598-6993'),
(72, 10, 'Cugman – Mapawa Nature Park', 'Cugman', '8.4721362', '124.7045312', '881-6225, 0917-326-3995 and 0998-598-6995'),
(73, 10, 'F. S. Catanico - San Isidro Labrador Parish Catholic Church', 'F. S. Catanico', '8.4721362', '124.7045312', '881-6225, 0917-326-3995 and 0998-598-6995'),
(74, 10, 'Tablon - MINERGY', 'Tablon', '8.4721362', '124.7045312', '881-6225, 0917-326-3995 and 0998-598-6995');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `stations_coverage`
--
ALTER TABLE `stations_coverage`
  ADD PRIMARY KEY (`barangay_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `stations_coverage`
--
ALTER TABLE `stations_coverage`
  MODIFY `barangay_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
