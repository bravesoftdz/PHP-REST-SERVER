-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2017 at 05:18 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `salesrest`
--

-- --------------------------------------------------------

--
-- Table structure for table `pricelist`
--

CREATE TABLE `pricelist` (
  `id` int(11) NOT NULL,
  `sku` varchar(20) DEFAULT NULL,
  `skusize` varchar(20) DEFAULT NULL,
  `barcode` varchar(25) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `price` float(30,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pricelist`
--

INSERT INTO `pricelist` (`id`, `sku`, `skusize`, `barcode`, `description`, `price`) VALUES
(1, 'MEA001', '1 X 6', '3458945985078', 'Tinned Meat 200g', 145.67),
(2, 'CAT023', '1 X 6', '6348976967485', 'Pet Edables 300g ', 102.99),
(3, 'CAT032', '1 X 6 ', '4355665698565', 'Pet Cats Tinned Food 200g ', 302.92),
(4, 'TAS022', '1 X 6 ', '2345569856929', 'Lead Cat Silver/Clasp ', 22.92),
(5, 'TAS012', '1 X 6 ', '5698656985692', 'Lead Cat Black/Clasp ', 22.92),
(6, 'DOG001', '1 X 12', '5485923902390', 'Tinned Dog Food 300g', 116.89);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pricelist`
--
ALTER TABLE `pricelist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pricelist`
--
ALTER TABLE `pricelist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
